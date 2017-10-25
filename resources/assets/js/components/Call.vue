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
              <div class="input-group fixed-bottom input-fixo">
                <input type="hidden" name="_token" :value="csrf_token">
                <input type="text" class="form-control" v-model="body">
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
              <div id="teste" class="description-assunto">
                <a class="text-justify text-assunto" :href="'/calls/'+call.id">{{ call.title}}</a>
              </div>

					</div>
        </div>
      </div>
    </div>
  </div>
	<a v-if="!call.user_to_user"
		v-on:click="exit">Sair</a>
</div>
</template>

<script>
export default {
  props: ['user_id', 'call', 'messages', 'members', 'users', 'calls'],
  data() {
    return {
      post_url: "/messages",
      csrf_token: $('meta[name=csrf-token]').attr('content'),
      users_lookup: {},
      n_messages: [],
      body: '',
			//calls: this.r_calls.reverse(),
    }
  },
  methods: {
		exit: function() {
			var request = $.get("/calls/"+this.call.id+"/exit");

			request.done(function () {
				window.location.replace("/calls");
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

    for (var i = 0, len = this.users.length; i < len; i++) {
      this.users_lookup[this.users[i].id] = this.users[i];
    }

    for (var i = 0, len = this.messages.length; i < len; i++) {
      this.messages[i].author = this.users_lookup[this.messages[i].user_id];
      this.n_messages.push(this.messages[i]);
    }

    Echo.private(`App.Call.${this.call.id}`)
      .listen('MessageCreated', (e) => {
        if (e.message.user_id != this.user_id) {
          console.log('Calls: New message!');

          var message = e.message;
          message.author = this.users_lookup[message.user_id];
          this.n_messages.push(message);

          $.get('/notifications/newmessage/' + this.call.id + '?markasread');
        }
      });
  }
}
</script>
