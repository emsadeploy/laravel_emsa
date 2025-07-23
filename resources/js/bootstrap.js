


import $ from "jquery";
window.$ = $;





$(function() {$('#side-menu').metisMenu();});

  $(function () 
  {
    $('#vertical-menu-btn').on('click', function (event) {
        event.preventDefault();
        $('body').toggleClass('sidebar-enable');
        if ($(window).width() >= 992) 
            $('body').toggleClass('vertical-collpsed');
        else {
            $('body').removeClass('vertical-collpsed');
        }
    });
})
  