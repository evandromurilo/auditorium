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
            <call-message v-for="message in n_messages" :user_id="user_id" :message="message"></call-message>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <div class="input-group">
                <input type="hidden" name="_token" :value="csrf_token">
                <input type="text" class="form-control" v-model="body">
                <span class="input-group-btn">
										<button v-on:click="send" class="btn btn-primary">Enviar</button>
									</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Assuntos do chat
      Parei Aqui
    -->
      <div class="col-md-3">
        <div class="well well-assunto">
          <h3 class="text-center user-assunto">Assuntos</h3>
					<div v-for="call in calls">
            <div class="well well-list-assunto">
              <div class="description-assunto">
                <a class="text-justify" :href="'/calls/'+call.id">{{ call.title}}</a>
              </div>
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
  props: ['user_id', 'call', 'messages', 'members', 'calls'],
  data() {
    return {
      post_url: "/messages",
      csrf_token: $('meta[name=csrf-token]').attr('content'),
      members_lookup: {},
      n_messages: [],
      body: '',
    }
  },
  methods: {
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
        author: this.members_lookup[this.user_id],
      }

      this.n_messages.push(message);
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
    }
  },
  mounted() {
    console.log('Calls: Component mounted.');

    var self = this;

    for (var i = 0, len = this.members.length; i < len; i++) {
      this.members_lookup[this.members[i].id] = this.members[i];
    }

    for (var i = 0, len = this.messages.length; i < len; i++) {
      this.messages[i].author = this.members_lookup[this.messages[i].user_id];
      this.n_messages.push(this.messages[i]);
    }

    Echo.private(`App.Call.${this.call.id}`)
      .listen('MessageCreated', (e) => {
        if (e.message.user_id != this.user_id) {
          console.log('Calls: New message!');

          var message = e.message;
          message.author = this.members_lookup[message.user_id];
          this.n_messages.push(message);

          $.get('/notifications/newmessage/' + this.call.id + '?markasread');
        }
      });
  }
}
</script>
