<?php
/**
 * Template Name: Contact Us - Home Template
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
	
	<div class="container contactus">
	<div class="">
		<div class="col-md-6 float-right">
			<div class="row rushmyorder">
				<?php echo do_shortcode( '[contact-form-7 id="5" title="Contact form 1"]' ); ?>
			</div>
		</div>
		<div class="col-md-6 float-left">
			<div class="healthy">
				<h3>Reach us our support will reply as soon as possible</h3>
				<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/contact_us_img.png">
			</div>
			<hr>
			<div class="contact_us">
				<div class="row">
					<div class="top_write">
						<h6>write us</h6>
						<div class="write">
							<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/gmail.svg">
							<p><a href="mailto:contact@teamasala.in?Subject=Hello%20again" target="_blank">contact@teamasala.in</p>
						</div>
					</div>
					<div class="call">
						<h6>Call us</h6>
						<div class="masala_call">
							<a href="#"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/phone.svg"></a>
							<p><a href="tel:080 46235223">080 46235223</a></p>
						</div>
						<hr>						
					</div>
				</div>
				<hr>
			</div>	
		</div>
		
	</div>
	
	</div>
	   
</main><!-- #site-content -->

<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
