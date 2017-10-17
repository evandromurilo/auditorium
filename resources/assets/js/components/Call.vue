<template>
	<div>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<h1>{{ call.title }}</h1>
				</div>

				<div class="col-md-8 well">
					<ul class="messages">
						<call-message v-for="message in n_messages" :message="message"></call-message>
					</ul>

					<input type="hidden" name="_token" :value="csrf_token">
					<input type="text" v-model="body">
					<button v-on:click="send">Enviar</button>

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

			self = this;

			request.done(function (response, textStatus, jqXHR) {
				console.log('Mensagem enviada!');

				var message = {
					body: self.body,
					author: self.members_lookup[self.user_id],
				}

				self.n_messages.push(message);
				self.body = '';
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

		Echo.private(`App.User.${this.user_id}`)
			.notification((notification) => {
				if (notification.type == 'App\\Notifications\\NewMessage') {
					console.log('Calls: New message!');

					var message = notification.data.message;
					message.author = this.members_lookup[notification.data.message.user_id];

					this.n_messages.push(message);
				}
			});
	}
}
</script>


<style>
h1{
	color: green;
}
</style>
