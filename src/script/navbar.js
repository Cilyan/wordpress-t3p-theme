import $ from 'jquery';

// Collapse Navbar
function navbarCollapse() {
  if ($("#site-navigation").offset().top > 100) {
    $("#site-navigation").addClass("navbar-shrink");
  } else {
    $("#site-navigation").removeClass("navbar-shrink");
  }
};
// Collapse now if page is not at top
navbarCollapse();
// Collapse the navbar when page is scrolled
$(window).scroll(navbarCollapse);
