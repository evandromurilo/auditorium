<template>



			<a :href="unread.data.n_url">
			 <div class="text-justify notification" style="height: 45px;">{{ unread.data.n_message }}<br>

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
