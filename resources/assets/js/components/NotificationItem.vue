<template>

<a v-on:click="markAsRead" href="#">
	<link rel="stylesheet" href="/css/style-notification-item-vue.css">

  <div class="text-justify notification" style="height: 45px;">

    <span v-if="unread.type == 'App\\Notifications\\NewMessage'">
					 <i class="fa fa-commenting icon-msg" aria-hidden="true"></i>{{ unread.data.n_message }}
				 </span>
    <span v-else-if="unread.type == 'App\\Notifications\\RequestResolved'">
					 {{ unread.data.n_message }}
				 </span>
    <span v-else>
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
      var request = $.get("/notifications/" + this.unread.id + "?read=true");

      self = this;

      request.always(function() {
        window.location.replace(self.unread.data.n_url);
      });
    }
  },
  mounted() {}
}
</script>
