<?php
/**
 * Template Name: myaccount - Home Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
?>

<main id="site-content" role="main">

	<?php /*

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content-cover' );
		}
	}           www/MasalaTea/wp-content/themes/twentytwenty/assets/images/BG.jpg
*/
	?>
	<div class="tit-breadcrumbs"><div class="container"><?php echo get_the_title();?></div></div>
	
	<div class="container myaccount">
	<div class="">
		<div class=" ">
			<div class="row rushmyorder">
				<?php echo do_shortcode( '[ultimatemember form_id="367"]' ); ?>
			</div>
		</div>
		
		
	</div>
	
	</div>
	   
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
