<?php
/**
 * Template Name: BMI - Home Template
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
	<div class="fluid-container">
		<div class="BMI_banner">
			<div class="container">
				<div class="row">
					<div class="col-md-5">
						<img class="result" src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Group 1485.png">
					</div>
					<div class="col-md-7">
						<article>Body mass index, or BMI, is used to determine whether you are in a healthy weight range for your height.</article> <article>It is useful to consider BMI alongside waist circumference, as waist measurement helps to assess risk by measuring the amount of fat carried around your middle.</article>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="fields" style="margin-bottom:0;">
							<?php //echo do_shortcode( '[bmibmr]' ); ?>
							<?php echo do_shortcode( '[ninja_form id=5]' ); ?>
						</div> 
				
					</div>
				</div>
			</div>
		</div>
	</div>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>


