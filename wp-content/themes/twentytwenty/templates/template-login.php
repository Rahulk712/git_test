<?php
/**
 * Template Name: login - Home Template
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
	
	
	<div class="container-fluid login">
	<div class="login_page">
		<div class="col-md-12 float-right heading">
			<div class="row login-container">
			<div class="login-content">
			<div>
				<p>Login</p>
				<?php echo do_shortcode( '[ultimatemember form_id="362"]' ); ?>
				</div>
			</div>
			</div>
		</div>
		<?php /* <div class="col-md-5 float-left">
			<div class="login_img">
				<img class="loginmodel" src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Image 7.png">
				<img class="easy"src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/component.png">
				<img class="cup" src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Layer 7.png">
			</div>
		</div> */ ?>
		<div class="clear"></div>
	</div>
	
	</div>
	   
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
