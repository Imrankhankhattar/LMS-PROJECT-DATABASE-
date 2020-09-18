
var links = $(".vertical-menu a");
links.click(function(e) {
  $(".active").toggleClass("active");
  $(this).toggleClass("active");

  var newY = $(this).position().top;

  var animation = anime({
    targets: ".indicator",
    translateY: newY,
    duration: 600,
    easing: [0.68, -0.55, 0.265, 1.55]
  });
});
