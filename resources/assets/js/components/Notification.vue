<template>

	<li class="dropdown">
		<link rel="stylesheet" href="css/style-notification.css">
		<a href="#" id="notification-menu" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
			Notificações <span class="badge">{{ unreadNotifications.length }}</span>
		</a>

		<ul class="dropdown-menu" role="menu">
			<li class="erro">
				<notification-item v-for="unread in unreadNotifications" :unread="unread"></notification-item>
			</li>
			<li v-if="unreadNotifications.length > 0">
				<a class="btn btn-limpa" v-on:click="markAllAsRead" href="#">Limpar Notificações</a>
			</li>
			<li v-else>
				<span>Sem notificações.</span>
			</li>
		</ul>
	</li>
</template>

<script>
export default {
	props:['user_id'],
	data() {
		return {
			unreadNotifications:[],
		}
	},
	methods: {
		markAllAsRead: function() {
			$.get("/notifications/clear");
		}
	},
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
