/* global $*/

$(document).ready(function() {
  $('.icone-down').click(function(){
    $(this).find('i').toggleClass('fa fa-caret-up fa fa-caret-down');
  });


/*falha no script*/
/*
  $('.icone-down').click(function(){
    $('.status-periodo').hide('slow');
  });
});
