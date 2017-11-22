<template>
<div>
  <link rel="stylesheet" href="/css/style-call-vue.css">
  <div class="container">
    <div class="row">

      <!-- User Perfil -->
      <div class="col-md-3">
        <div class="well well-pessoa">
          <h3 class="text-center user-relacionado">Pessoas Relacionadas</h3>
          <div v-for="member in members">
            <call-member :member="member"></call-member>
          </div>
        </div>
      </div>

      <!-- well do chat center-->
      <div class="col-md-6">
        <h2 class="text-justify altura-title"> {{ call.title }}</h2>
        <div class="well well-chat">
          <div class="messages">
            <call-message v-for="message in messages" :user_id="user_id" :message="message"></call-message>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="input-group fixed-bottom input-fixo">
                <input type="hidden" name="_token" :value="csrf_token">

                <input type="text" class="form-control" autofocus v-model="body">
                <span class="input-group-btn">
										<button v-on:click="send" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
									</span>

              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Assuntos do chat

    -->
      <div class="col-md-3">
        <div class="well well-assunto">
          <h3 class="text-center user-assunto">Assuntos</h3>
					<div v-for="call in calls">
              <div style="margin: auto;" id="teste" class="description-assunto">
                <a style="cursor: pointer;" class="text-justify text-assunto" v-on:click="refreshCall(call.id)"><span class="uni">{{ call.title}}</span></a>
                  <i class="trash-assunto fa fa-trash-o"
										aria-hidden="true"
										v-if="!call.user_to_user && call.id != 1"
										v-on:click="exit(call.id)"></i>
              </div>
					</div>
					<a class="btn btn-chamada" href="/calls/create">
						Nova Chamada
            <i class="fa fa-plus-square" aria-hidden="true"></i>
					</a>
        </div>
      </div>
    </div>
  </div>
	<!--<a class="btn btn-danger"  v-if="!call.user_to_user && call.id != 1"
		v-on:click="exit">Sair</a>-->
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
    }
  },
  methods: {
		exit: function(id) {
			var request = $.get("/calls/"+id+"/exit");
			var self = this;

			request.done(function () {
				if (self.call.id == id) {
					self.refreshCall(1);
				}
				else {
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

			$.getJSON("/calls/"+id, function (data) {
				window.history.pushState({}, "Call", "/calls?id="+id);
				self.call = data;
				self.refreshMembers();
				self.refreshMessages();
			});

		},

		refreshCalls: function() {
			self = this;

			$.getJSON("/users/"+this.user_id+"/calls", function (data) {
				self.calls = data;
			});
		},

		refreshMembers: function() {
			self = this;

			$.getJSON("/calls/"+this.call.id+"/members", function (data) {
				self.members = data;
			});
		},

		refreshMessages: function() {
			self = this;

			$.getJSON("/calls/"+this.call.id+"/messages", function(data) {
				self.messages = data;

				for (var i = 0, len = self.messages.length; i < len; i++) {
					self.messages[i].author = self.users_lookup[self.messages[i].user_id];
				}
			});
		},

		loadMessage: function(id) {
			self = this;

			$.getJSON("/messages/"+id, function(data) {
				var message = data;
				message.author = self.users_lookup[message.user_id];
				self.messages.push(message);
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


    Echo.private(`App.Call.${1}`)
      .listen('MessageCreated', (e) => {
        if (e.user_id != this.user_id) {
          console.log('Calls: New message!');

					self.loadMessage(e.message_id);

          $.get('/notifications/newmessage/' + this.call.id + '?markasread');
        }
      });
  }

}
</script>
