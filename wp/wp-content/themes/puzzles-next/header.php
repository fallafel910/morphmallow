<?php
/**
 * The Header for our theme.
 *
 * @package puzzles
 */

// AJAX Queries settings
global $THEMEREX_ajax_nonce, $THEMEREX_ajax_url;
$THEMEREX_ajax_nonce = wp_create_nonce('ajax_nonce');
$THEMEREX_ajax_url = admin_url('admin-ajax.php');

// Theme custom settings from current post and category
global $THEMEREX_cat_options, $THEMEREX_post_options, $THEMEREX_custom_options, $THEMEREX_shop_options, $wp_query;
// Current post & category custom options
$THEMEREX_post_options = $THEMEREX_cat_options = $THEMEREX_custom_options = $THEMEREX_shop_options = array();
if (is_woocommerce_page() && ($page_id=get_option('woocommerce_shop_page_id'))>0)
	$THEMEREX_shop_options = get_post_meta($page_id, 'post_custom_options', true);
if (is_category()) {
	$cat = (int) get_query_var( 'cat' );
	if (empty($cat)) $cat = get_query_var( 'category_name' );
	$THEMEREX_cat_options = getCategoryInheritedProperties($cat);
} else if ((is_day() || is_month() || is_year()) && ($page_id=getTemplatePageId('archive'))>0) {
	$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
} else if (is_search() && ($page_id=getTemplatePageId('search'))>0) {
	$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
} else if (is_404() && ($page_id=getTemplatePageId('404'))>0) {
	$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
} else if (function_exists('is_bbpress') && is_bbpress() && ($page_id=getTemplatePageId('bbpress'))>0) {
	$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
} else if (function_exists('is_buddypress') && is_buddypress() && ($page_id=getTemplatePageId('buddypress'))>0) {
	$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
} else if (is_single() || is_page() || is_singular() || $wp_query->is_posts_page==1) {
	// Current post custom options
	$page_id = is_single() || is_page() ? get_the_ID() : (isset($wp_query->queried_object_id) ? $wp_query->queried_object_id : getTemplatePageId('template-blog'));
	$THEMEREX_post_options = get_post_meta($page_id, 'post_custom_options', true);
	$THEMEREX_cat_options = getCategoriesInheritedProperties(getCategoriesByPostId($page_id));
}

// Reject old browsers support
global $THEMEREX_jreject;
$THEMEREX_jreject = false;
if (!isset($_COOKIE['jreject'])) {
	wp_enqueue_style(  'jquery_reject-style',  get_template_directory_uri() . '/js/jreject/css/jquery.reject.css', array(), null );
	wp_enqueue_script( 'jquery_reject', get_template_directory_uri() . '/js/jreject/jquery.reject.js', array('jquery'), null, true );
	setcookie('jreject', 1, 0, '/');
	$THEMEREX_jreject = true;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" type="image/x-icon" />

	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="stylesheet" href="https://morphmallow.com/skin/frontend/metros/default/css/styles.css"> 

	<link rel="stylesheet" href="https://morphmallow.com/skin/frontend/metros/jack/css/jack.css"> 

	<link rel="stylesheet" href="https://morphmallow.com/skin/frontend/metros/default/webandpeople/custommenu/custommenu.css"> 
	<link rel="stylesheet" href="https://morphmallow.com/skin/frontend/metros/jack/css/mobile.css">
	<link media="all" type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/themeoption.css.php"> 
								 
	<script src="<?php echo get_template_directory_uri(); ?>/js/prototype.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/ccard.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/validation.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/builder.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/effects.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/dragdrop.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/controls.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/slider.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/js.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/form.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/translate.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/cookies.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/custommenu.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.7.2.min.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox-1.3.4.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/ajaxcart.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.bxslider.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/homeslider-config.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/script2.js" type="text/javascript"></script>

	<meta content="addshoppers:product" property="og:type">
	<script type="text/javascript">
	    //<![CDATA[
	    Searchanise = {};
	    Searchanise.host = 'http://www.searchanise.com';
	    Searchanise.api_key = '4P9V4q5s6Z';
	    Searchanise.SearchInput = '#search';
	    Searchanise.AutoCmpParams = {};
	    Searchanise.AutoCmpParams.union = {}; Searchanise.AutoCmpParams.union.price = {}; Searchanise.AutoCmpParams.union.price.min = 'se_price_0';
	    Searchanise.AutoCmpParams.restrictBy = {};
	    Searchanise.AutoCmpParams.restrictBy.status = '1';
	    Searchanise.AutoCmpParams.restrictBy.visibility = '3|4';
	    Searchanise.AutoCmpParams.restrictBy.is_in_stock = '1';
	    Searchanise.options = {};
	    Searchanise.options.LabelSuggestions = 'Popular suggestions';
	    Searchanise.options.LabelProducts = 'Products';
	    Searchanise.AdditionalSearchInputs = '#name,#description,#sku';
	    Searchanise.options.PriceFormat = {
	    decimals_separator: '.',
	    thousands_separator: ',',
	    symbol: '$',
	    decimals: '2',
	    rate: '1',
	    after: false
	    };
	    (function() {
	    var __se = document.createElement('script');
	    __se.src = 'http://www.searchanise.com/widgets/v1.0/init.js';
	    __se.setAttribute('async', 'true');
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(__se, s);
	    })();
	    //]]>
	  </script>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-54473441-1', 'auto');
  ga('send', 'pageview');
</script>
	
	<script>
		function successMessage(message,message1,message2)
		{
		    jQuery('body').append('<div class="alert"></div>');
		    var $alert = jQuery('.alert');
		    $alert.fadeIn(400);
		    $alert.html(message).append('<button class="close"><i class="fa fa-times"></i></button>');
		    $alert.html(message1).append('<a class="close cart" href="http://sukkahlights.com/nextrendz/checkout/cart/">GO TO CART</a>');
		    $alert.html(message2).append('<a class="close continue">CONTINUE SHOPPING</a>');
		    jQuery('.close').click(function () {
			$alert.fadeOut(400);
		    });
		    $alert.fadeIn('400', function () {
			setTimeout(function () {
			    $alert.fadeOut('400', function () {
				jQuery(this).fadeOut(400, function(){ jQuery(this).detach(); })
			    });
			}, 10000)
		    });
		}
	</script>
	
<script>
  jQuery(document).ready(function()
  {
    //jQuery('.top-link-cart').text(jQuery('.top-link-cart').text() + " " + jQuery('.amount span.count').children().text());
  });
</script>
	
    <?php if (($favicon = get_theme_option('favicon'))) { ?>
		<link rel="icon" type="image/x-icon" href="<?php echo $favicon; ?>" />
    <?php
	}
	?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_enqueue_script('jquery'); ?>
	<?php wp_head(); ?>
  <link href="//fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet" type="text/css">

<script type="text/javascript">
//<![CDATA[
var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.comodo.com/" : "http://www.trustlogo.com/");
document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]>
</script>

</head>

<body <?php 
	$class = $style = '';
	if (($body_style=get_custom_option('body_style'))=='boxed') {
		$customizer = get_theme_option('show_theme_customizer') == 'yes';
		if ($customizer && ($img = (int) getValueGPC('bg_image', 0)) > 0)
			$class = 'bg_image_'.$img;
		else if ($customizer && ($img = (int) getValueGPC('bg_pattern', 0)) > 0)
			$class = 'bg_pattern_'.$img;
		else if ($customizer && ($img = getValueGPC('bg_color', '')) != '')
			$style = 'background-color: '.$img.';';
		else {
			if (($img = get_custom_option('bg_custom_image')) != '')
				$style = 'background: url('.$img.') ' . str_replace('_', ' ', get_custom_option('bg_custom_image_position')) . ' no-repeat fixed;';
			else if (($img = get_custom_option('bg_custom_pattern')) != '')
				$style = 'background: url('.$img.') 0 0 repeat fixed;';
			else if (($img = get_custom_option('bg_image')) > 0)
				$class = 'bg_image_'.$img;
			else if (($img = get_custom_option('bg_pattern')) > 0)
				$class = 'bg_pattern_'.$img;
			if (($img = get_custom_option('bg_color')) != '')
				$style .= 'background-color: '.$img.';';
		}
	}
	body_class(
		'theme_' . get_custom_option('blog_theme')
		. ' puzzles_' . get_custom_option('puzzles_style')
		. ' reviews_' . max(5, (int) get_custom_option('reviews_max_level'))
		. (get_custom_option('puzzles_animations')=='yes' ? ' puzzles_animations' : '')
		. ' ' . $body_style
		. ($class!='' ? ' ' . $class : '')
	//	. 'cms-index-index cms-home'
	);
	if ($style!='') echo ' style="'.$style.'"';
	?>
>

<div class="wrapper">
  <noscript> <div class="global-site-notice noscript"> <div class="notice-inner"> <p> <strong>JavaScript seems to be disabled in your browser.</strong><br /> You must have JavaScript enabled in your browser to utilize the functionality of this website. </p> </div> </div> </noscript>
</div>
<div class="menuwithlogo_holder"></div>
<div id="fb-root"></div>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

	<?php do_action( 'before' ); ?>

	<?php 
	global $THEMEREX_sidemenu;
	$THEMEREX_sidemenu = wp_nav_menu(array(
		'menu'              => '',
		'container'         => '',
		'container_class'   => '',
		'container_id'      => '',
		'items_wrap'      	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'menu_class'        => '',
		'menu_id'           => 'sidemenu',
		'echo'              => false,
		'fallback_cb'       => '',
		'before'            => '',
		'after'             => '',
		'link_before'       => '',
		'link_after'        => '',
		'depth'             => 11,
		'theme_location'    => 'sidemenu'
	));
	
	if ($THEMEREX_sidemenu) { 
	?>
		<nav id="sidemenu_area" class="sidemenu_area theme_accent_bg" role="navigation">
			<a href="#" id="sidemenu_link" class="icon-menu theme_accent_bg"></a>
			<div id="sidemenu_scroller_wrapper">
				<div id="sidemenu_scroller">
					<?php echo $THEMEREX_sidemenu; ?>
				</div>
			</div>
		</nav>
	<?php } ?>

	<!--[if lt IE 9]>
	<?php echo do_shortcode("[infobox style='error']<div style=\"text-align:center;\">".__("It looks like you're using an old version of Internet Explorer. For the best WordPress experience, please <a href=\"http://microsoft.com\" style=\"color:#191919\">update your browser</a> or learn how to <a href=\"http://browsehappy.com\" style=\"color:#222222\">browse happy</a>!", 'themerex')."</div>[/infobox]"); ?>
	<![endif]-->
    <div id="page" class="hfeed site theme_body">
		<?php
			if (($header_custom_image = get_header_image()) != '') {
				$header_style = ' style = "background: url('.$header_custom_image.');"';
			} else {
				$header_style = '';
			}
		?>
		
		<?php the_block('header'); ?>
		
		
		     <header id="header" class="site_header" role="banner" <?php echo $header_style; ?>>
<script type="text/javascript">
	jQuery(function($, undefined) {
		var bar = $('.mg-main');
		var top = bar.css('top');
		$(window).scroll(function() {

      if($(this).scrollTop() < 200) {
				bar.stop().animate({'opacity' : '1'}, 500);
        bar.removeClass("scrolled");
      }
      else if($(this).scrollTop() < 201) {
				bar.stop().animate({'opacity' : '0'}, 500);
			}
       else if($(this).scrollTop() > 202) {
				bar.stop().animate({'opacity' : '1'}, 500);
        bar.addClass("scrolled");
			}
		});
	});
</script>

        <!-- /Header top-->
			<?php
			$menu = wp_nav_menu(array(
				'menu'              => '',
				'container'         => '',
				'container_class'   => '',
				'container_id'      => '',
				'items_wrap'      	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'menu_class'        => '',
				'menu_id'           => 'mainmenu',
				'echo'              => false,
				'fallback_cb'       => '',
				'before'            => '',
				'after'             => '',
				'link_before'       => '',
				'link_after'        => '',
				'depth'             => 11,
				'theme_location'    => 'mainmenu'
			));
			if ($menu) {
				if (($header_custom_image = get_header_image()) != '') {
					$header_style = ' style = "background: url('.$header_custom_image.');"';
				} else {
					$header_style = '';
				}
				?>
				<div id="header_middle_wrapper">
					<div id="header_middle" <?php echo $header_style; ?> <?php echo $body_style=='fullwidth' ? 'class="theme_menu"' : ''; ?>>
						<div id="header_middle_inner">
							<div class="search_form_area theme_body">
								<form class="search_form" action="<?php echo home_url(); ?>" method="get"><input class="field theme_accent_bg search_field" type="search" placeholder="<?php echo sprintf(htmlspecialchars(__('Type your search query and press "Enter" %s', 'themerex')), '&hellip;'); ?>" value="" name="s"></form>
								<a href="#" class="search_close"><span class="icon-cancel-circled"></span></a>
							</div>
							<nav id="mainmenu_area" class="mainmenu_area theme_menu" role="navigation">
								<?php echo $menu; ?>
								<a href="#" class="search_link"><span class="icon-search"></span></a>
							</nav>
						</div>
					</div>
				</div>
				<div id="header_middle_fixed"></div>
			<?php } ?>
	
	</header>


		<div id="main" class="<?php echo getSidebarClass(get_custom_option('show_sidebar_main')); ?>">
			<?php
			if (get_custom_option('slider_show')=='yes') { 
				$slider_display = $body_style=='fullwidth' ? 'fullscreen' : get_custom_option('slider_display');
				$slider = get_custom_option('slider_engine');
			?>
                <div id="main_slider" class="main_slider_<?php echo $slider_display; ?>">
                    <div id="main_slider_inner">
                        <?php
							if ($slider == 'revo' && is_plugin_active('revslider/revslider.php')) {
								$slider_alias = get_custom_option('slider_alias');
								if (!empty($slider_alias)) putRevSlider($slider_alias);
							} else if ($slider == 'flex') {
								$slider_cat = get_custom_option("slider_category");
								$slider_orderby = get_custom_option("slider_orderby");
								$slider_order = get_custom_option("slider_order");
								$slider_count = $slider_ids = get_custom_option("slider_posts");
								if (themerex_strpos($slider_ids, ',')!==false)
									$slider_count = 0;
								else {
									$slider_ids = '';
									if (empty($slider_count)) $slider_count = 3;
								}
								$slider_info_box = get_custom_option("slider_info_box");
								$slider_info_fixed = get_custom_option("slider_info_fixed");
								if ($slider_count>0 || !empty($slider_ids)) {
									echo do_shortcode('[slider engine="flex" controls="0"' 
										. ($slider_cat ? ' cat="'.$slider_cat.'"' : '') 
										. ($slider_ids ? ' ids="'.$slider_ids.'"' : '') 
										. ($slider_count ? ' count="'.$slider_count.'"' : '') 
										. ($slider_orderby ? ' orderby="'.$slider_orderby.'"' : '') 
										. ($slider_order ? ' order="'.$slider_order.'"' : '') 
										. ' titles="'.($slider_info_box=='yes' ? ($slider_info_fixed=='yes' ? 2 : 1) : 0)  .'"'
										. ']');
								}
							}
                        ?>
                    </div>
                </div>
			<?php } ?>

			<?php 
			if ( get_custom_option('googlemap_show')=='yes' ) { 
				$map_display = get_custom_option('googlemap_display');
				$map_height = get_custom_option('googlemap_height');
				$map_address = get_custom_option('googlemap_address');
				$map_latlng = get_custom_option('googlemap_latlng');
				if (!empty($map_address) || !empty($map_latlng)) {
			?>
					<div id="main_map" class="main_map_<?php echo $map_display; ?>">
						<div id="main_map_inner">
							<?php
							echo do_shortcode("[googlemap ".(!empty($map_latlng) ? "latlng='$map_latlng'" : "address='$map_address'")." zoom='" .get_custom_option('googlemap_zoom') ."' width='100%' height='$map_height']");
							?>
						</div>
					</div>
			<?php
				}
			} 
			?>
