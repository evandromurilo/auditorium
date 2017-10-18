<template>
	<li class="messages">
		<p class="text-left"><strong>{{ message.author.name  }}:</strong> {{ message.body }}</p>
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
<style media="screen">
	
</style>
