<template>
	<div>
		<label>Título: </label><input type="text" v-model="title"><br>
		<label>Membros:</label><br>
		<ul>
			<li v-for="member in members">
				<p>{{ member.email }}</p>
			</li>
		</ul>
		<input type="text" size="30" maxlength="30" v-model="email">
		<button v-on:click="insert">Add</button>
		<button v-on:click="send">Criar chamada</button>
	</div>
</template>

<script>
export default {
	props:['user'],
	data() {
		return {
			post_url: "/calls?from=create_call",
			csrf_token: $('meta[name=csrf-token]').attr('content'),
			members: [this.user],
			email: '',
			title: '',
		}
	},
	methods: {
		insert: function() {
			//$.get("/users/json?email="+this.email);
			self = this;

			var user = {
				email: self.email
			};

			this.members.push(user);
			this.email = '';
		},

		send: function() {
			var inputs = {
				_token: this.csrf_token,
				title: this.title,
				members: this.members,
				user_id: this.user.id,
			}

			var request = $.post(this.post_url, inputs);

			request.done(function (response, textStatus, jqXHR) {
				console.log('Call criada!');
				window.location.replace(response);
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
		console.log('NewCall: Component mounted.');
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
