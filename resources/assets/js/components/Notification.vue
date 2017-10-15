<template>
	<li class="dropdown">
		<a href="#" id="notification-menu" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
			Notificações <span class="badge">{{ unreadNotifications.length }}</span>
		</a>

		<ul class="dropdown-menu" role="menu">
			<li class="erro">
				<notification-item v-for="unread in unreadNotifications" :unread="unread"></notification-item>
			</li>

			<!-- @foreach (Auth::user()->unreadNotifications as $notification) -->
			<!-- @include('partials.notifications.request_resolved') -->
			<!-- @endforeach -->
		</ul>
	</li>
</template>

<script>
export default {
	props:['unreads', 'user_id'],
	data() {
		return {
			unreadNotifications:this.unreads
		}
	},
	mounted() {
		console.log('Component mounted.');
		console.log(this.unreads);

		Echo.private(`App.User.${this.user_id}`)
			.notification((notification) => {
				console.log(notification.type);

				this.unreadNotifications.push(notification);
			});
	}
}
</script>
