<template>
	<li class="messages">
		<p><strong>{{ message.author.name  }}:</strong> {{ message.body }}</p>
	</li>
</template>

<script>
export default {
	props:['message'],
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
