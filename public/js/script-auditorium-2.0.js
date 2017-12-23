/* global $*/

$(document).ready(function() {
  $('#down').click(function(){
    $(this).find('i').toggleClass('fa fa-caret-up fa fa-caret-down');
  });
});
