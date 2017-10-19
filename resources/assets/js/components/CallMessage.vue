<template>
	<li class="messages">
		<p class="text-left"
			v-if="user_id == message.author.id">
			<strong>Você:</strong> {{ message.body }}
		</p>
		<p class="text-left" v-else><strong>{{ message.author.name  }}:</strong> {{ message.body }}</p>
	</li>
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
