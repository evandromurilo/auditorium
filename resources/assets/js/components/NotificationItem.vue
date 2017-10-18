<template>
		 <a :href="unread.data.n_url">
			 <div class="text-justify notification"
				 style="height: 45px;">

				 <span v-if="unread.type == 'App\\Notifications\\NewMessage'">
					 {{ unread.data.n_message }}
				 </span>
				 <span v-else-if="unread.type == 'App\\Notifications\\RequestResolved'">
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
	props:['unread'],
	data() {
		return {
		}
	},
	mounted() {
	}
}
</script>
