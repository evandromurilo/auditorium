<template>
		 <a :href="request_url">
			 <div class="text-justify notification" style="height: 45px;">Sua requisição do {{ unread.data.auditorium_name }} mudou de status.<br>

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
			request_url: ''
		}
	},
	mounted() {
		this.request_url = "/requests/"+this.unread.data.request_id+"?from=notification";
	}
}
</script>
