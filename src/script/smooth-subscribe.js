import $ from 'jquery';

$('#subscribe-link').on('click', function (e) {
  if (this.hash !== "") {
    e.preventDefault();
    $('html,body').animate({
      scrollTop: $(this.hash).offset().top - 61, // 61 is roughly the size of the navbar
    }, 900);
  }
});
