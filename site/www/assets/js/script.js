$(document).scroll(function () {
    if ($(document).width() < 1024)
        return false;

    if ($(document).scrollTop() > $('.content').height() / 2)
        $("header").addClass("fixed");
    else
        $("header").removeClass("fixed");
});

// Идев в начало
$(".up-btn").on("click", function () {
    $("html, body").animate({
        scrollTop: 0
    }, 'slow');
});

$("#show-menu").on("click", function () {
   $("#hidden-menu").animate({
       "right": 0
   }, 500)
});

$(".close").on("click", function () {
    $("#hidden-menu").animate({
        "right": -300
    }, 200)
});

$(document).ready(function () {
    $("#slider").slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        centerMode: true,
        focusOnSelect: true,
		autoplay: true,
        slidesToScroll: 1//Сколько слайдов пропустить
    });
});
