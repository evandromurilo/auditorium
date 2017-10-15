if ($("#user-id".length)) {
	Echo.private(`user.${$("#user-id").val()}`)
	.listen('RequestStatusChanged', (e) => {
		console.log(e.request.user_id);
	});
}

// Echo.channel('test')
// .listen('RequestStatusChanged', (e) => {
// 	console.log(e.request.user_id);
// });
