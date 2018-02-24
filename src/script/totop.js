import $ from 'jquery';

function totopReveal() {
  if ($(this).scrollTop() > 250) {
    $("#totop").fadeIn(300);
  } else {
    $("#totop").fadeOut(300);
  }
}

totopReveal();

$(window).scroll(totopReveal);

$('#totop').on('click', function (e) {
  e.preventDefault();
  $('html,body').animate({
    scrollTop: 0
  }, 700);
});
