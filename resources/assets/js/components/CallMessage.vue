<template>
	<div class="messages">
		<link rel="stylesheet" href="/css/style-callmessage-vue.css">
		<div>
			<p class="text-right msg-user"
				v-if="user_id == message.author.id">
				<strong>Você:</strong> {{ message.body }}
			</p>
			<p class="msg-secundario" v-else><strong>{{ message.author.name  }}:</strong> {{ message.body }}</p>
		</div>
<div class="clearfix"></div>

	</div>
</template>

<script>
export default {
	props:['message', 'user_id'],
	mounted() {
		console.log("Message: mounted");
	}
}
</script>
<style>

body{
	margin: 0;
	padding: 0;
	  font-family: 'Roboto', sans-serif;
}
</style>
