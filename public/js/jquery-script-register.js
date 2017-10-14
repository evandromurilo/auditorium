jQuery(function($){
  $('#cel').mask('(99) 99999-9999');
});

function updateColor() {
  var content = $('#color').val();
  $('#cor').css('background-color', content);
}

jQuery(function($) {
	updateColor();
});

$("body").on('input', '#color', function() {
	updateColor();
});

$("body").on('click', '#cor', function() {
  $("#color").val(randomColor());
	updateColor();
});

jQuery(function($) {
  $("#atualiza").click(function() {
  });
});
