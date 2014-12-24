
jQuery(function(j$) {

j$('.slider1').bxSlider({
    pager: false,
    infiniteLoop: false,
    hideControlOnEnd: true
});

j$('.slider2').bxSlider({
    pager: false,
    infiniteLoop: false,
    hideControlOnEnd: true,
    adaptiveHeight: true
});

j$('.brand-slider').bxSlider({
    slideWidth: 183,
    minSlides: 1,
    maxSlides: 6,
    moveSlides: 1,
    slideMargin: 0,
    pager: false,
    infiniteLoop: false,
    hideControlOnEnd: true
});



});