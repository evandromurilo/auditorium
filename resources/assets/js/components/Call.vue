<template>
<div>
  <link rel="stylesheet" href="/css/style-call-vue.css">
  <div class="container">
    <div class="row">

      <!-- User Perfil -->
      <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="well well-pessoa">
          <h3 class="text-center user-relacionado">Pessoas Relacionadas</h3>
          <div v-for="member in members">
            <call-member :member="member"></call-member>
          </div>
        </div>
      </div>

      <!-- well do chat center-->
      <div class="col-xs-12 col-sm-12 col-md-6">
        <h2 class="text-justify altura-title"> {{ call.title }}</h2>
        <div class="well well-chat" id="chat-messages-container" v-on:scroll="scrollFunction">
          <div class="messages">
            <call-message v-for="message in messages" :user_id="user_id" :message="message"></call-message>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="">
                <input type="hidden" name="_token" :value="csrf_token">
              </div>
            </div>
          </div>
        </div>
        <div class="well well-input">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="painel-footer">
                <div class="input-group">
                  <input type="text" class="form-control" autofocus v-model="body" v-on:keyup.enter="send">
                  <span class="input-group-btn">
                        <button v-on:click="send" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Assuntos do chat

    -->
      <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="well well-assunto">
          <h3 class="text-center user-assunto">Assuntos</h3>

          <a class="btn btn-chamada" href="/calls/create">
            Nova Chamada
            <i class="fa fa-comments-o" aria-hidden="true"></i>
            </a>

          <div v-for="call in calls">
            <div style="margin: auto;" id="teste" class="description-assunto">
              <a style="cursor: pointer;" class="text-justify text-assunto" v-on:click="refreshCall(call.id)">
                <span class="uni">{{ call.title}}</span></a>
              <i class="trash-assunto fa fa-trash-o" aria-hidden="true" v-if="!call.user_to_user && call.id != 1" v-on:click="exit(call.id)"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: ['user_id', 'users', 'first_call_id'],
  data() {
    return {
      post_url: "/messages",
      csrf_token: $('meta[name=csrf-token]').attr('content'),
      users_lookup: {},
      n_messages: [],
      body: '',
      calls: [],
      members: [],
      messages: [],
      call: {},
      page: 1,
    }
  },
  methods: {
    exit: function(id) {
      var request = $.get("/calls/" + id + "/exit");
      var self = this;

      request.done(function() {
        if (self.call.id == id) {
          self.refreshCall(1);
        } else {
          self.refreshCalls();
        }
      });
    },

    send: function() {
      var inputs = {
        _token: this.csrf_token,
        body: this.body,
        call_id: this.call.id,
        user_id: this.user_id
      }

      var request = $.post(this.post_url, inputs);

      var message = {
        body: this.body,
        author: this.users_lookup[this.user_id],
      }

      this.messages.push(message);
      this.body = '';

			setTimeout(function() {
				var d = $("#chat-messages-container");
				d.scrollTop(d.prop("scrollHeight"));
			}, 100);

      request.done(function(response, textStatus, jqXHR) {
        console.log('Mensagem enviada!');
      });

      request.fail(function(response, textStatus, errorThrown) {
        console.error(
          "The following error occurred: " +
          textStatus, errorThrown
        );
      });
    },

    refreshCall: function(id) {
      self = this;

      Echo.leave(`App.Call.${this.call.id}`);

      $.getJSON("/calls/" + id, function(data) {
        window.history.replaceState({}, "Call", "/calls?id=" + id);
        self.call = data;
        self.refreshMembers();

        self.messages = [];
        self.refreshMessages();

        self.listenOnEcho();
      });
    },

    refreshCalls: function() {
      self = this;

      $.getJSON("/users/" + this.user_id + "/calls", function(data) {
        self.calls = data;
      });
    },

    refreshMembers: function() {
      self = this;

      $.getJSON("/calls/" + this.call.id + "/members", function(data) {
        self.members = data;
      });
    },

    refreshMessages: function() {
      self = this;
      self.messages = [];
      self.page = 1;

      $.getJSON("/calls/" + this.call.id + "/messages?page=" + this.page, function(data) {
        Object.keys(data).forEach(function(key, index) {
          var message = data[key];
          message.author = self.users_lookup[message.user_id];
          self.messages.push(message);
        });

        setTimeout(function() {
          var d = $("#chat-messages-container");
          d.scrollTop(d.prop("scrollHeight"));
        }, 100);
      });
    },

    loadMoreMessages: function() {
      self = this;

      $.getJSON("/calls/" + this.call.id + "/messages?page=" + this.page, function(data) {
        var d = $("#chat-messages-container");
        var old_height = d.prop("scrollHeight");

        var nmessages = [];
        Object.keys(data).forEach(function(key, index) {
          var message = data[key];
          message.author = self.users_lookup[message.user_id];
          nmessages.push(message);
        });

        self.messages = nmessages.concat(self.messages);

        setTimeout(function() {
          d.scrollTop(d.prop("scrollHeight") - old_height);
        }, 20);

      });
    },

    loadMessage: function(id) {
      self = this;

      $.getJSON("/messages/" + id, function(data) {
        var message = data;
        message.author = self.users_lookup[message.user_id];
        self.messages.push(message);
      });
    },

    scrollFunction: function() {
      var d = $("#chat-messages-container");

      if (d.scrollTop() == 0) {
        this.page += 1;
        this.loadMoreMessages();
      }
    },

    listenOnEcho: function() {
      console.log("Listening on App.call.${this.call.id}");
      Echo.private(`App.Call.${this.call.id}`)
        .listen('MessageCreated', (e) => {
          if (e.user_id != this.user_id) {
            console.log('Calls: New message!');

            self.loadMessage(e.message_id);

            $.get('/notifications/newmessage/' + this.call.id + '?markasread');
          }
        });
    }
  },
  mounted() {
    console.log('Calls: Component mounted.');

    this.refreshCalls();
    this.refreshCall(this.first_call_id);

    var self = this;

    for (var i = 0, len = this.users.length; i < len; i++) {
      this.users_lookup[this.users[i].id] = this.users[i];
    }
  }
}
</script>
