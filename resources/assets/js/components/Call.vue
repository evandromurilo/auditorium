<template>
	<div>
		<div class="container">
			<div class="row">
				<!-- User Perfil -->
				<div class="col-md-3">
					<h1>{{ call.title }}</h1>
					<div class="well well-perfil">

					</div>
				</div>

				<div class="col-md-6"> well well-chat">
					<div class="well well-chat">
						<ul class="messages text-right">
							<call-message  v-for="message in n_messages" :message="message"></call-message>
						</ul>

						<input type="hidden" name="_token" :value="csrf_token">
						<input type="text" class="input-group" v-model="body">
						<button v-on:click="send" class="btn btn-primary">Enviar</button>

					</div>
				</div>


				<div class="col-md-3">
					<div class="well well-assunto">
						<h2>Assuntos</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props:['user_id', 'call', 'messages', 'members'],
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
		send: function () {
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

			request.done(function (response, textStatus, jqXHR) {
				console.log('Mensagem enviada!');
			});


			request.fail(function (response, textStatus, errorThrown) {
				console.error(
            "The following error occurred: "+
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

					$.get('/notifications/newmessage/'+this.call.id+'?markasread');
				}
			});
	}
}
</script>

<!-- CSS por aqui ate ver o que fazer-->
<style >

body{
	margin: 0;
	padding: 0;
}

.well-perfil{
	width: 120px;
	height: 120px;
	border-radius: 100%;
}
.well-chat{
	margin-top: 70px;
	height: 400px;
	overflow: auto;

}
.well-assunto{

}

</style>
