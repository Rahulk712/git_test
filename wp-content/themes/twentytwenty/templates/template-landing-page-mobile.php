<?php
/**
 * Template Name: Landing Page Mobile - Home Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
?>
<style>
html body.page-template-template-landing-page-mobile  .rushmyorder .um form input[type="submit"]{background: transparent linear-gradient(271deg, #FC9604 0%, #FC9604 1%, #FCBF04 100%) 0% 0% no-repeat!important;  animation-name: angry-animation;
    animation-duration: 1s;
    animation-timing-function: linear;
    animation-delay: 0s;
    animation-iteration-count: infinite;
    animation-direction: normal;}
</style>
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
	<?php 
	$my_query = new WP_Query('post_type=mobile_landing');
	    if ( $my_query->have_posts() ) {
		while ( $my_query->have_posts() ) {
		$my_query->the_post();
		$post_id = get_the_ID() ;
		}
	   }
	  $mypost =  get_post_meta($post_id);
	//print_r($mypost);
	//echo wp_get_attachment_image_url($mypost['banner_image']['0']);
				?>
<div>
<div class="container landing_page_mobile">
	<div class="top_view">
	 <img src="<?php echo wp_get_attachment_image_url($mypost['lose_the_weight_image']['0']); ?>">
	 <img class="animate" src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/giphy.gif">
	</div>
	<div class="hurry_to_get">
		<img class="topheader" src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Hurry.png">
		<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/offer_price.png">
	</div>
		<div class="row rushmyorder" id="mobile_webiste">
			<div class="col-md-12">
			<?php  if(is_user_logged_in()){ ?>
			<div class="um um-register " style="opacity: 1;">
				<div class="um-form">
						<form id="without_risk" class="no_risk " action="/MasalaTea/shop" method="post">
								
							  <input type="text" name="firstname" value="<?php  echo do_shortcode( '[get_user_login]' );?>" placeholder="Name*" readonly>
							  <br>
							  <div class="email-otp">
							  <input type="text" name="email" value="<?php echo do_shortcode( '[get_user_email]' );?>" placeholder="Email*" readonly>
							  </div>
							  <br>
							  <input type="text" name="phone" value="<?php echo do_shortcode( '[get_user_phone_number]' ); ?>"  placeholder="Phone*" readonly>
							  <br>	
							  <div class="um-col-alt">		
									<div class="um-center">
										<input type="submit" value="Rush My Order" class="um-button" id="um-submit-btn">
									</div>
								<div class="um-clear"></div>
							</div>
							</form>
							</div>
						</div>
							<?php }else{ echo do_shortcode( '[ultimatemember form_id="361"]' ); } ?>
			
		</div>
	</div>
	<div class="star_rating">
		<p>Masala For Shape Reviews</p>
		<div class="row stars">
			<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/star.svg">
		</div>
	</div>
	<div class="media_block">
		<div class="top_header">
			 <img src="<?php echo wp_get_attachment_image_url($mypost['finally_image_fwm']['0']); ?>">
		</div>
		<div class="mbn_image">
			 <img src="<?php echo wp_get_attachment_image_url($mypost['cluster_image_fwm']['0']); ?>">
		</div>
		<div class="mbn_content">
			<h1> <?php echo $mypost['title_fwm']['0'];?></h1>
			<p> <?php echo $mypost['description_fwm']['0'];?></p>
		</div>
	</div>	
	<div class="holy_grail_block">
		<div class="top_header">
			 <img src="<?php echo wp_get_attachment_image_url($mypost['burn_fat_image_fwm']['0']); ?>">
		</div>
		<div class="learnmore">
			<div class=" row burn_fat_mobile">
				<div class="burn_fat_left">
				
					<img src="<?php echo wp_get_attachment_image_url($mypost['image1_rbf']['0']); ?>">
				</div>
				<div class="burn_fat_right">
					<div class="copyContainer txt1">
						<h1><?php echo $mypost['title_1_rbf']['0'];?></h1>
						<p><?php echo $mypost['article_1_rbf']['0'];?></p>
					</div>
				</div>
			</div>
			<div class=" row burn_fat_mobile">
				<div class="burn_fat_left">
					<img src="<?php echo wp_get_attachment_image_url($mypost['image_2_rbf']['0']); ?>">
				</div>
				<div class="burn_fat_right">
					<div class="copyContainer txt1">
						<h1><?php echo $mypost['title_2_rbf']['0'];?></h1>
						<p><?php echo $mypost['article_2_rbf']['0'];?></p>
					</div>
				</div>
			</div>
			<div class=" row burn_fat_mobile">
				<div class="burn_fat_left">
					<img src="<?php echo wp_get_attachment_image_url($mypost['image_3_rbf']['0']); ?>">
				</div>
				<div class="burn_fat_right">
					<div class="copyContainer txt1">
						<h1><?php echo $mypost['title_3_rbf']['0'];?></h1>
						<p><?php echo $mypost['article_3_rbf']['0'];?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="real_results">
		<div class="topheader">
			<img src="<?php echo wp_get_attachment_image_url($mypost['win_image']['0']); ?>">
		</div>
		<div class="benefitsImage">
			<img src="<?php echo wp_get_attachment_image_url($mypost['feature_image']['0']); ?>">
		</div>
	</div>
	<div class="work_block">
		<div class="topheader">
			<img src="<?php echo wp_get_attachment_image_url($mypost['main_image']['0']); ?>">
		</div>
		<div class="benefits">
			<img src="<?php echo wp_get_attachment_image_url($mypost['number_1_hnb']['0']); ?>">
			<div class="rrbCopy">
				<h1><?php echo $mypost['title_1_hnb']['0'];?></h1>
				<p><?php echo $mypost['article_1_hnb']['0'];?></p>
			</div>
		</div>
	</div>
		<div class="benefits">
			<img src="<?php echo wp_get_attachment_image_url($mypost['number_2_hnb']['0']); ?>">
			<div class="rrbCopy">
				<h1><?php echo $mypost['title_2_hnb']['0'];?></h1>
				<p><?php echo $mypost['article_2_hnb']['0'];?></p>
			</div>
		</div>
		<div class="benefits">
			<img src="<?php echo wp_get_attachment_image_url($mypost['number_3_hnb']['0']); ?>">
			<div class="rrbCopy">
				<h1><?php echo $mypost['title_3_hnb']['0'];?></h1>
				<p><?php echo $mypost['article_3_hnb']['0'];?></p>
			</div>
			
		</div>
		<img class="final_banner" src="<?php echo wp_get_attachment_image_url($mypost['leaf_image_hnb']['0']); ?>">
	<div class="stick_bar" id="stick_bar">
		<img src="<?php echo wp_get_attachment_image_url($mypost['garcinia_image']['0']); ?>" class="mobile-bot-img">
		<img src="<?php echo wp_get_attachment_image_url($mypost['order_image']['0']); ?>">
	</div>
	<div class="testimonial-con mobile_view_landing_page">
		<div class="container">
			<h3>Real Testimonial</h3>
			<p>from satisfied users</p>
			<?php echo do_shortcode( '[testimonial_view id="1"] ' ); ?> 
		</div>
	</div>
	<div class="final_mobile_view_banner">
		<img class="last_banner" src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/last_banner.jpg">
	</div>
	<div class="final_mobile_content">
		<p>DISCLAIMER |PRIVACY POLICY | TERMS & CONDITIONS FOR ANY QUESTION EMAIL US: CONTACTMASALA@GMAIL.COM OPEN MONDAY - FRIDAY 9:00 AM TO 6:00 PM IST MASALA FOR SHAPE. ©2020. ALL RIGHTS RESERVED.</p>
	</div>
</div>

	
<script type="text/javascript">
    document.getElementById("stick_bar").onclick = function () {
         jQuery('html, body').animate({
        scrollTop: jQuery("#mobile_webiste").offset().top
    });
    };
</script>	   
</main><!-- #site-content -->

<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
