/* global $*/

$(document).ready(function() {
  $('.icone-down').click(function(){
    $(this).find('i').toggleClass('fa fa-caret-up fa fa-caret-down');
  });
});
/*

$('.icone-down').click(function(){
  $('.status-periodo').hide('slow');
});*/
