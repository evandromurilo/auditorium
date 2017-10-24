<template>
	<div>
		<label>Título: </label><input type="text" v-model="title"><br>
		<label>Membros:</label><br>
		<ul>
			<li>{{ user.name }}</li>
			<span v-for="member in members">
				<li v-if="member.email != user.email">
					<a v-on:click="remove(member)">-{{ member.name }}</a>
				</li>
			</span>
		</ul>
		<ul v-for="user in users">
			<li v-if="!added(user.email)">
				<a
					v-on:click="insert(user.name, user.email)">+{{ user.name }}</a>
			</li>
		</ul>
		<button v-on:click="send">Criar chamada</button>
	</div>
</template>

<script>
export default {
	props:['user', 'users'],
	data() {
		return {
			post_url: "/calls?from=create_call",
			csrf_token: $('meta[name=csrf-token]').attr('content'),
			members: [{name: this.user.name, email: this.user.email}],
			title: '',
			request : false,
		}
	},
	methods: {
		added: function(email) {
			return this.members.some(function(el) {
				return el.email == email;
			});
		},

		insert: function(n, m) {
			this.members.push({name: n, email: m});
		},

		remove: function(member) {
			this.members.splice(this.members.indexOf(member));
		},

		send: function() {
			if (this.request) {
				return;
			}

			var inputs = {
				_token: this.csrf_token,
				title: this.title,
				members: this.members,
				user_id: this.user.id,
			}

			this.request = $.post(this.post_url, inputs);

			this.request.done(function (response, textStatus, jqXHR) {
				console.log('Call criada!');
				window.location.replace(response);
			});


			this.request.fail(function (response, textStatus, errorThrown) {
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
body {
  margin: 0;
  padding: 0;
}

.well-perfil {
  width: 120px;
  height: 120px;
  border-radius: 100%;
}

.well-chat {
  margin-top: 70px;
  height: 400px;
  overflow: auto;

}

.well-assunto {}
</style>
