 //3segundos
/*
setTimeout(function(){
  $('#texto').fadeIn();
}, 3000)
*/
$(document).ready(function() {
  $('p').css('color', 'red');
});

$(document).ready(function() {
	setTimeout(function () {
		$('#texto').hide(); // "foo" é o id do elemento que seja manipular.
	}, 2500); // O valor é representado em milisegundos.
});
