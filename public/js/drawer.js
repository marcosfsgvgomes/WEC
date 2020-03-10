/*var a = document.getElementById('home-icon');
a.setAttribute = ("href", "/wec");*/

/*$("a").mouseover(function() {
    $(this).click();
});*/

$(function () {
    $('[data-toogle="tooltip"]').tooltip();
});

var content = $(".home-icon a").attr('href');
  $(".home-icon").parents("sidebar").eq(0).after(content);

