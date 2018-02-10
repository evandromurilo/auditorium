<template>

<a v-on:click="markAsRead" href="#">
	<link rel="stylesheet" href="/css/style-notification-item-vue.css">

  <div class="text-justify notification" style="height: 45px;">

    <span v-if="unread.type == 'App\\Notifications\\RequestResolved'">
					<i class="fa fa-bell icon-notification" aria-hidden="true"></i>
					 {{ unread.data.n_message }}
	 </span>
    <span v-else-if="unread.type == 'App\\Notifications\\NewRequest'">
					<i class="fa fa-bell icon-notification" aria-hidden="true"></i>
					 {{ unread.data.n_message }}
	 </span>
    <span v-else>
					<i class="fa fa-bell icon-notification" aria-hidden="true"></i>
					 {{ unread.data.n_message }}
	 </span>

    <br>
    <span class="date-hora">
				 <i class="fa fa-clock-o" aria-hidden="true"></i> {{ unread.created_at }}
			 </span>
  </div>
</a>
</template>

<script>
export default {
  props: ['unread'],
  data() {
    return {}
  },
  methods: {
    markAsRead: function() {
			var self = this;
			$.get("/notifications/" + this.unread.id + "?read=true", function() {
				window.location.replace(self.unread.data.n_url);
			});
    }
  },
  mounted() {}
}
</script>
