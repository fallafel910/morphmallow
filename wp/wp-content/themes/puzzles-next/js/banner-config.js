
jQuery(function(j$) {
	
j$('.bxslider').bxSlider({
	mode: vMode,
	useCSS: false,
	easing: vEffect,
	speed: vSlide,
	pause: vPause,
	auto: true,
	controls: false,
	pager: true,
	adaptiveHeight: true,
	onSliderLoad: function(){
		j$('.flex-container').addClass('active');		
	},
	onSlideAfter: function(){
		j$('.flex-container').addClass('active');			
	},
	onSlideBefore:function(){
		j$('.flex-container').removeClass('active');
	}
	
});

});