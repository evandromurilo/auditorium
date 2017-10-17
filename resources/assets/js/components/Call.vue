<template>
	<div>
		<h1>{{ call.title }}</h1>
		<div>
			<ul class="messages">
				<call-message v-for="message in n_messages" :message="message"></call-message>
			</ul>
		</div>
		<form method="POST" :action="post_url">
			<input type="hidden" name="_method" value="post">
			<input type="hidden" name="_token" :value="csrf_token">
			<input type="hidden" name="call_id" :value="call.id">
			<input type="text" name="body">
			<input type="submit">
		</form>
	</div>
</template>

<script>
export default {
	props:['call', 'messages', 'members'],
	data() {
		return {
			post_url: "/messages",
			csrf_token: $('meta[name=csrf-token]').attr('content'),
			members_lookup: {},
			n_messages: [],
		}
	},
	mounted() {
		console.log('Calls: Component mounted.');

		for (var i = 0, len = this.members.length; i < len; i++) {
			this.members_lookup[this.members[i].id] = this.members[i];
		}

		for (var i = 0, len = this.messages.length; i < len; i++) {
			this.messages[i].author = this.members_lookup[this.messages[i].user_id];
			this.n_messages.push(this.messages[i]);
		}

		console.log(this.messages);
	}
}
</script>
