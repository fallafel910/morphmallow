<?php
/*
Template Name Posts: single-other
*/
?>
<?php
/**
 * The Template for displaying all single posts.
 *
 * @package AccesspressLite
 */

get_header();
global $accesspresslite_options, $post;
$accesspresslite_settings = get_option( 'accesspresslite_options', $accesspresslite_options );
$cat_blog = $accesspresslite_settings['blog_cat'];
$post_class = get_post_meta( $post -> ID, 'accesspresslite_sidebar_layout', true );
?>

<div class="ak-container">
	<?php 
		if ($post_class=='both-sidebar') { ?>
			<div id="primary-wrap" class="clearfix"> 
		<?php }
	?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php // accesspresslite_post_nav(); ?>

            <?php
			if(has_category( $cat_blog, $post )):
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
	<?php 
	get_sidebar('left'); 

		if ($post_class=='both-sidebar') { ?>
			</div> 
		<?php }

	get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>