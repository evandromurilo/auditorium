

$(document).ready(function() {
  $('#edit').hide();

  $('.welll').mouseenter(function(){
    $('#edit').show();
  });
  $('.letra-perfill').mouseenter(function(){
    $('#edit').show();
  });
  $('.welll').mouseout(function(){
    $('#edit').hide();
  });
});
