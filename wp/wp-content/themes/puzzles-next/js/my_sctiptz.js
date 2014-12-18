  jQuery(function($, undefined){
    $(".close-menu").click(function(event){
        $('.menu-bg').fadeOut(400);
        event.preventDefault();
    });
    $(".top-menu-mobile .hz a").click(function(event){
      //$(".menu-bg").css({
          //opacity: '0',
          //$('.menu-bg').hide(400);
          $('.menu-bg').fadeIn(400);
        //});
        event.preventDefault();
    });

     $(".hair").click(function(event){
        $('.info-slide.desktop,  .large-banners img.banner').fadeOut(0);
        $('.info-slide.desktop').html("<h2>Short, Long, Curly<br>or Straight</h2><p>Short hair? No problem! With the help of a grown up, cut your Spaghetti Headz to any size!</p><a href='#'>View Tutorial</a>");
        $('h2.sl').html("The Original Hair Twist").css({'color':'#000'});
        $('.large-banners img.banner').attr({
           'src':'../images/slider/slide1.jpg',
           'alt':'The Original Hair Twist',
        });
        $('.info-slide.desktop, .large-banners img.banner').fadeIn(600);
        event.preventDefault();
    });
    $(".holidays").click(function(event){
        $('.info-slide.desktop, .large-banners img.banner').fadeOut(0);
        $('.info-slide.desktop').html("<h2>Great Gift Idea!</h2><p>Check out our Christmas and Hannukah Packages!</p><a href='#'>View Collections</a>");
        $('h2.sl').html("The Original Hair Twist").css({'color':'#fff'});
        $('.large-banners img.banner').attr({
           'src':'../images/slider/slide2.jpg',
           'alt':'The Original Hair Twist',
        });
        $('.info-slide.desktop, .large-banners img.banner').fadeIn(600);
        event.preventDefault();
    });
     $(".eco").click(function(event){
        $('.info-slide.desktop, .large-banners img.banner').fadeOut(0);
        $('h2.sl').html("The Original Hair Twist").css({'color':'#fff'});
        $('.large-banners img.banner').attr({
           'src':'../images/slider/slide3.jpg',
           'alt':'The Original Hair Twist',
        });
        $('.info-slide.desktop, .large-banners img.banner').fadeIn(600);
        event.preventDefault();
    });
     $(".ages").click(function(event){
        $('.info-slide.desktop, .large-banners img.banner').fadeOut(0);
        $('h2.sl').html("The Original Hair Twist").css({'color':'#fff'});
        $('.large-banners img.banner').attr({
           'src':'../images/slider/slide4.jpg',
           'alt':'The Original Hair Twist',
        });
        $('.info-slide.desktop, .large-banners img.banner').fadeIn(600);
        event.preventDefault();
    });
    //---------------/
    $(".dots a").click(function(){
      $('.small-banners img').animate({
        'opacity':'0',
        'height':'384px',
      }, 600);
      $('h2.sl').css({color: '#000', 'text-align':'center', 'padding-left':'0'});
      $('.banner-text ul').hide();
      $('#content .banner-text ul.mobile').fadeIn(600);
      return false;
    });
    $('.banner-text .mobile .one').click(function(){
      $('.info-slide.small').html("<h2>Short, Long, Curly<br>or Straight</h2><p>Short hair? No problem! With the help of a grown up, cut your Spaghetti Headz to any size!</p><a href='#'>View Tutorial</a>");
      return false;
    });
    $('.banner-text .mobile .two').click(function(){
      $('.info-slide.small').html("<h2>Great Gift Idea!</h2><p>Check out our Christmas and Hannukah Packages!</p><a href='#'>View Collections</a>");
      return false;
    });
    $('.banner-text .mobile .three').click(function(){
      $('.info-slide.small').html("<h2>Short, Long, Curly<br>or Straight</h2><p>Short hair? No problem! With the help of a grown up, cut your Spaghetti Headz to any size!</p><a href='#'>View Tutorial</a>");
      return false;
    });
    $('.banner-text .mobile .four').click(function(){
      $('.info-slide.small').html("<h2>Great Gift Idea!</h2><p>Check out our Christmas and Hannukah Packages!</p><a href='#'>View Collections</a>");
      return false;
    });

  $('.banner-text .mobile .one').click(function(){
    $('.banner-text ul').addClass('active');

    })
  



  })(jQuery);