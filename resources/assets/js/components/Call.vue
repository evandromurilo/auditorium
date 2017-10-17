<template>
	<h1>{{ call.title }}</h1>
	<div>
		<ul class="messages">
			<call-message v-for="message in messages" :message="message"></call-message>
	</div>
</template>

<script>
export default {
	props:['call', 'messages'],
	mounted() {
		console.log('Notifications: Component mounted.');

		var self = this;

		function reloadNotifications() {
				$.get("/notifications", function (data, status) {
					if (status == 'success') {
						console.log('Notifications: Reloading notifications');
						self.unreadNotifications = data;
					}
				});
		}

		reloadNotifications();

		Echo.private(`App.User.${this.user_id}`)
			.notification((notification) => {
				console.log('Notifications: ' + notification.type);
				reloadNotifications();
			})
			.listen('NotificationRead', (e) => {
				console.log('Notifications: App\\Events\\NotificationRead');
				reloadNotifications();
			});
	}
}
</script>
