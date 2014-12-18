<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
/*
Template Name: old_other_page
*/
?>
<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package puzzles
 */

//get_header();
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>Spaghetti Headz</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,500,500italic,700' rel='stylesheet' type='text/css'>
	<link href='../wp-content/specific-files/css/style.css' rel='stylesheet' type='text/css'>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
	<!--<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox-1.3.4.pack.js"></script>-->
	<!--<link href='<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox-1.3.4.css' rel='stylesheet' type='text/css'>-->
	<!--<script src="<?php echo get_template_directory_uri(); ?>/js/js.js" type="text/javascript"></script>-->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54473441-1', 'auto');
  ga('send', 'pageview');
</script>

<script type="text/javascript">
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
        $('.info-slide.desktop').html("<h2>Short, Long, Curly  or Straight</h2><p>Short hair? No problem! With the help of a grown up, cut your Spaghetti Headz to any size!</p><a href='/spaghetti-headz.html'>View Collections</a>");
        $('h2.sl').html("The Original Hair Twist").css({'color':'#000'});
        $('.large-banners img.banner').attr({
           'src':'<?php echo get_template_directory_uri(); ?>/images/slider/slider-img-4.jpg',
           'alt':'The Original Hair Twist',
        });
        $('.info-slide.desktop, .large-banners img.banner').fadeIn(600);
        $('#content .slider ul li a').removeClass('active-tab-block');
        $(this).children('a').addClass('active-tab-block');
        event.preventDefault();
    });
    $(".holidays").click(function(event){
        $('.info-slide.desktop, .large-banners img.banner').fadeOut(0); 
        $('.info-slide.desktop').html("<h2>Great Gift Idea!</h2><p>Check out our Christmas and Hannukah Packages!</p><a href='/spaghetti-headz.html'>View Collections</a>");
        $('h2.sl').html("The Original Hair Twist").css({'color':'#fff'});
        $('.large-banners img.banner').attr({
           'src':'<?php echo get_template_directory_uri(); ?>/images/slider/slider-img-6.jpg',
           'alt':'The Original Hair Twist',
        });
        $('.info-slide.desktop, .large-banners img.banner').fadeIn(600);
        $('#content .slider ul li a').removeClass('active-tab-block');
        $(this).children('a').addClass('active-tab-block');
        event.preventDefault();
    });
     $(".eco").click(function(event){
        $('.info-slide.desktop, .large-banners img.banner').fadeOut(0);
        
        $('.info-slide.desktop').html("<h2>Back to School with  a Twist (and Shout!)</h2><p>Spin heads with Spaghetti Headz  in your classroom!</p><a href='/spaghetti-headz.html'>View Collections</a>");
        $('h2.sl').html("The Original Hair Twist").css({'color':'#fff'});
        $('.large-banners img.banner').attr({
           'src':'<?php echo get_template_directory_uri(); ?>/images/slider/slider-img-2.jpg',
           'alt':'The Original Hair Twist',
        });
        $('.info-slide.desktop, .large-banners img.banner').fadeIn(600);
        $('#content .slider ul li a').removeClass('active-tab-block');
        $(this).children('a').addClass('active-tab-block');
        event.preventDefault();
    });
     $(".ages").click(function(event){
        $('.info-slide.desktop, .large-banners img.banner').fadeOut(0);
        
        $('.info-slide.desktop').html("<h2>Creative Play</h2><p>It’s not just a fashion accessory, it’s an activity, where girls can spend quality time styling each others hair.</p><a href='/spaghetti-headz.html'>View Collections</a>");
        $('h2.sl').html("The Original Hair Twist").css({'color':'#fff'});
        $('.large-banners img.banner').attr({
           'src':'<?php echo get_template_directory_uri(); ?>/images/slider/slider-img-1.jpg',
           'alt':'The Original Hair Twist',
        });
        $('.info-slide.desktop, .large-banners img.banner').fadeIn(600);
        $('#content .slider ul li a').removeClass('active-tab-block');
        $(this).children('a').addClass('active-tab-block');
        event.preventDefault();
    });

    //---------------/
    $(".one").click(function(){
        $('.banner-text ul').show();
        $('#content .banner-text ul.mobile').fadeOut(600);
        return false;
    });
    $(".two").click(function(){
        $('.banner-text ul').show();
        $('#content .banner-text ul.mobile').fadeOut(600);
        return false;
    });
    $(".three").click(function(){
        $('.banner-text ul').show();
        $('#content .banner-text ul.mobile').fadeOut(600);
        return false;
    });
    $(".four").click(function(){
        $('.banner-text ul').show();
        $('#content .banner-text ul.mobile').fadeOut(600);
        return false;
    });
    $(".dots a").click(function(){
      $('.small-banners img').animate({
         //'opacity':'0',
        'height':'384px',
      }, 600);
      $('h2.sl').css({color: '#000', 'text-align':'center', 'padding-left':'0'});
      $('.banner-text ul').hide();
      $('#content .banner-text ul.mobile').fadeIn(600);
      return false;
    });
    $('.banner-text .mobile .one').click(function(){
      $('.info-slide.small').html("<h2>Back to School with  a Twist (and Shout!)</h2><p>Spin heads with Spaghetti Headz  in your classroom!</p><a href='/spaghetti-headz.html'>View Collections</a>");
      $('.small-banners img').attr({
           'src':'<?php echo get_template_directory_uri(); ?>/images/slider/slider-img-2.jpg',
           'alt':'The Original Hair Twist',
        });
      return false;
    });
    $('.banner-text .mobile .two').click(function(){
      $('.info-slide.small').html("<h2>Creative Play</h2><p>It’s not just a fashion accessory, it’s an activity, where girls can spend quality time styling each others hair.</p><a href='/spaghetti-headz.html'>View Collections</a>");
      $('.small-banners img').attr({
           'src':'<?php echo get_template_directory_uri(); ?>/images/slider/slider-img-1.jpg',
           'alt':'The Original Hair Twist',
        });
      return false;
    });
    $('.banner-text .mobile .three').click(function(){
      $('.info-slide.small').html("<h2>Short, Long, Curly  or Straight</h2><p>Short hair? No problem! With the help of a grown up, cut your Spaghetti Headz to any size!</p><a href='/spaghetti-headz.html'>View Collections</a>");
      $('.small-banners img').attr({
           'src':'<?php echo get_template_directory_uri(); ?>/images/slider/slider-img-4.jpg',
           'alt':'The Original Hair Twist',
        });
      return false;
    });
    $('.banner-text .mobile .four').click(function(){
      $('.info-slide.small').html("<h2>Great Gift Idea!</h2><p>Check out our Christmas and Hannukah Packages!</p><a href='/spaghetti-headz.html'>View Collections</a>");
      $('.small-banners img').attr({
           'src':'<?php echo get_template_directory_uri(); ?>/images/slider/slider-img-6.jpg',
           'alt':'The Original Hair Twist',
        });
      return false;
    });
    $('.video-show').click(function(){
      $('.video-popup iframe').attr('src','https://www.youtube.com/embed/5-ww_MRSodY?autoplay=1&controls=0');
      $('.video-popup').fadeIn(1000);
      return false;
    });
    $('.video-popup').click({});
    $('.video-popup a, .video-popup .html5-video-player, .video-close, .video-close-button').click(function(){
      $('.video-popup iframe').attr('src','video-closed');
      $('.video-popup').fadeOut(1000);
      return false;
    });



  });
  </script>
	<link href='<?php echo get_template_directory_uri(); ?>/max.css' rel='stylesheet' type='text/css'>

</head>
<body>
<div class="video-popup">
  <a href="#">Close</a>
  <div class="video-close"></div>
  <div class="video-close-button"><span>Close</span></div>
  <iframe src="video-href" rel="0" hd="1" showinfo="0" loop="0" iv_load_policy="3" egm="0"></iframe>
</div>
<div class="menu-bg">
  <div class="menu-popup">
    <a href="#" class="close-menu"><img src="<?php echo get_template_directory_uri(); ?>/images/close-menu.gif" alt="x"></a>
    <div class="clear"></div>
    <ul class="top-m">
      <!--li><a href="<?php bloginfo('url'); ?>/../send-gift">Send as Gift</a></li-->
      <!-- <li><a href="/newproducts">New Headz</a></li> -->
      <li class="wide"><a href="/wp/use-spaghetti-headz/" >How They Work</a></li>
    </ul>
    <div class="clear"></div>

    <div class="morf-logo"><a href="https://vimeo.com/99872603" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/morph_logo_01.gif" alt="Morph logo"></a></div>

    <ul  class="bottom-m">
      <li><a href="<?php bloginfo('url'); ?>/../">Home</a></li>
      <li><a href="<?php bloginfo('url'); ?>/../tech.html">Tech</a></li>
      <li><a href="<?php bloginfo('url'); ?>/../gift.html">Gift</a></li>
      <li><a href="<?php bloginfo('url'); ?>/../toy.html">Toy</a></li>
    </ul>

  </div>
</div>
<div id="wrapper">
	<a href="/spaghetti-headz.html/" class="buy-top-r700">Buy Now</a>
  <ul class="top-menu-mobile">
    <li class="hz"><a href="#">Menu</a></li>
    <li class="account"><a href="<?php bloginfo('url'); ?>/../customer/account/">My account</a></li>
    <li class="list"><a href="<?php bloginfo('url'); ?>/../wishlist/">My Wishlist</a></li>
    <li class="cart"><a href="<?php bloginfo('url'); ?>/../checkout/cart/">My Cart</a></li>
    <li class="login"><a href="<?php bloginfo('url'); ?>/../customer/account/login/">Login</a></li>
    <!-- <li class="logo"><a href="https://vimeo.com/99872603" target="_blank">Logo</a></li> -->
    <li class="logo"><span>Logo</span></li>
  </ul>
  <!-- <a href="<?php bloginfo('url'); ?>/../" class="logo-big">Nextrendz</a> -->
  <a href="/spaghetti-headz.html" class="logo-big">Nextrendz</a>
	<header>
		<?php // echo get_ilightbox( array( "id" => 0 ), "<a class='ilightbox_inline_gallery_next' href='#'>Show Inline Gallery!!!</a>" ); ?>
		<img src="<?php echo get_template_directory_uri(); ?>/images/video-prev-img.png" alt="NextTrendz" class="bg-img">
		<img src="<?php echo get_template_directory_uri(); ?>/images/tagline_vector_(1).svg" alt="NextTrendz" class="header-slogan">
		<img src="<?php echo get_template_directory_uri(); ?>/images/video-prev-img.png" alt="NextTrendz" class="bg-img-640">
    <div class="play desktop">Play</div>
		<div class="top-nav">
			<div class="left-nav">
			<ul>
				<!--li><a href="<?php bloginfo('url'); ?>/../send-gift/">Send as Gift</a></li-->
				<!-- <li><a href="/newproducts">New Headz</a></li> -->
				<!--li><a href="http://www.youtube.com/embed/nSxq-eJ0VvY?autoplay=1"  rel="ilightbox">How They Work</a></li-->
				<li><a href="/wp/use-spaghetti-headz/" rel="ilightbox">How They Work</a></li>
        <!-- <li class="desktop"><a href="<?php bloginfo('url'); ?>/../tech.html" class="buy-top">Buy Now</a></li> -->
        <li class="desktop"><a href="/spaghetti-headz.html/" class="buy-top">Buy Now</a></li>

			</ul>
			</div>
			<div class="right-nav">
				<?php the_block('top.links'); ?>

				<!--ul class="right-top">
					<li><a href="#">My account</a></li>
					<li><a href="#">My wishlist</a></li>
					<li><a href="#">My cart</a></li>
					<li><a href="#">Log in</a></li>
				</ul-->
				<?php the_block('catalog.topnav'); ?>
				<!--ul class="right-bottom">
					<li><a href="#">Home</a></li>
					<li><a href="#">Tech</a></li>
					<li><a href="#">Gift</a></li>
					<li><a href="#">Toy</a></li>
				</ul-->
				<!-- <a  href="https://vimeo.com/99872603" target="_blank" class="logo-small">Morphmallow</a> -->
        <span class="logo-small">Morphmallow</span>
			</div>
		</div>
		<a href="#" class="popup iframe video-show"></a>

		<img src="../wp-includes/images/specific-page/images/spagetti_girl.png" alt="title" class="spagetti-girl">

	</header>
	<div id="content">
	<?php //echo do_shortcode('[mwi_product sku="Sample Product 2"/]'); ?>
	    <?php
		if (have_posts()) : while (have_posts()) : the_post();
		the_content();
		endwhile; endif;
	    ?>
	</div>
</div>
</body>
<?php //get_footer(); ?>