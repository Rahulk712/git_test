<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<link rel="stylesheet" href="https://use.typekit.net/ypu5inu.css">

		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/bootstrap/css/bootstrap.min.css">
		<script src="<?php echo get_template_directory_uri(); ?>/bootstrap/js/bootstrap.min.js"></script>
		<?php wp_head(); ?>
		
		
		<script> 

		  jQuery(document).ready(function(){
			  jQuery('.rushmyorder .um-form form').addClass('no_risk');	
				jQuery('.rushmyorder .um-form form').prepend("<button class='close-btn'>+</button><h5>Registration Form</h5>");	
				jQuery('.rushmyorder .um-form form').append('<p><span>*</span> Check that your mobile and your email is correctly written. It will allows us to contact you and get your shipping information to send your product.</p>');
				jQuery(".veganimg").appendTo(jQuery(".rushmyorder .um-form form"));
			jQuery(".rush_my_order_mobile input").click(function(){
				jQuery(".no_risk").show();
				});
			jQuery("form.no_risk .close-btn").click(function(){
				jQuery(".no_risk").hide();
				});	
			
			
			  });
		</script>
		<style>
		.strong-view.default .testimonial {
    border: 0!important;

}
li.woocommerce-order-overview__email.email{display:none;}

.zeroBouncsStatus {
    position: absolute;
    top: 1px;
    width: 35px;
    height: 38px;
    right: 1px;
    background: #fff;
	    background-position: center;
}
.page-template-template-landing-page img.offer_money_back{display:none;}
.page-template-template-landing-page .rushmyorder img.offer_price {
    max-width: 92%;
}
.page-template-template-main-website .logo_hundred img {
    position: absolute;
    top: -28px;
    right: 0;
    width: 113px;
}
.page-template-template-prelanding-page .options {
    display: flex;
    margin-top: 20px;
    margin-left: 200px;
}
.page-template-template-prelanding-page .mail {
    display: flex;
    position: relative;
    left: 226px;
    top: 18px;
	    width: 100px;
}
.page-template-template-prelanding-page .phone img {
    max-width: 31px;
    max-height: 30px;
    margin-top: 20px;
}
.page-template-template-prelanding-page .phone p {
    font-size: 14px;
    font-family: urbane,sans-serif;
    font-weight: 500;
    color: #fff;
    margin-top: 26px;
	    margin-left: 20px;
}
.page-template-template-prelanding-page .header button {
    background: #feac4f 0% 0% no-repeat padding-box;
    border-radius: 6px;
    opacity: 1;
    font-size: 14px;
    font-family: urbane,sans-serif;
    font-weight: 600;
    margin: 15px 0;
    padding: 10px 51px;
    position: relative;
    left: 300px;
    top: -8px;
}
.page-template-template-prelanding-page .phone {
    display: flex;
    position: relative;
    left: 267px;
    top: -8px;
}
.page-template-template-prelanding-page header#site-header{display:none;}
.page-template-template-prelanding-page main .header {background-color: #2b3847;
    color: #fff;
    box-shadow: 0px 3px 6px #00000029;
    opacity: 1;
    width: 100%;
    height: auto;}
	.page-template-template-prelanding-page main .header h3 {
    text-align: left;
    font: bold 14px/45px Raleway;
    letter-spacing: 0;
    color: #fff;
    opacity: 1;
    margin: 25px 0;
    margin-left: 15px;
}
.woocommerce-orders main#site-content {
    min-height: 500px;
}
.u-columns.woocommerce-Addresses.col2-set.addresses{display:flex;}
.u-column1.col-1.woocommerce-Address{    min-width: 375px;}
.u-column2.col-2.woocommerce-Address{    min-width: 375px;}
.footer-nav-widgets-wrapper.header-footer-group {
    display: none;
}
.strong-view.default .testimonial-inner {
    border: none;
  
    background: #fff;
    border-radius: 10px;
}
.strong-view.default .testimonial-inner *{color:#000;}
.strong-view.default .testimonial-heading {
    background-position: center center !important;

}
.testimonial-field.testimonial_name { 
    margin-top: 25px;
}
.testimonial-field.testimonial_msg {
    margin-top: 18px; 
}
.page-template-template-main-website .final {
    
    text-align: center;
    background-repeat: no-repeat;
    background-size: contain;
    width: 100% !important;
    height: 420px;
    background-color: #aad5e5;
    background-position: right;
}
.page-template-template-main-website .final h3 {
    margin-top: 156px;
}
.landing_page_mobile .top_view{    padding-bottom: 0;}
		.page-template-template-landing-page-mobile .hurry_to_get{position:relative;}
		.page-template-template-landing-page-mobile .hurry_to_get img.topheader {top: -26px;}
		.page-template-template-landing-page-mobile .um.um-register	{margin-bottom: 0px!important; max-width: 100%;}	
		.page-template-template-landing-page-mobile .rushmyorder form.no_risk {
			margin-left: 0;
			border-radius: 0px!important;
			margin-top: 0;
		}
		.page-template-template-landing-page-mobile .rushmyorder form.no_risk {
			display: block!important;
			position: static!important;
			background: #efefef 0% 0% no-repeat padding-box!important;
			box-shadow: none;
			margin-left: 0;
			border-radius: 0px!important;
			margin-top: 0;
			padding: 19px;
			margin-right: 0;
			/* width: 100%; */
			box-sizing: border-box;
			width: 100%;
		}
		.page-template-template-landing-page-mobile  form.no_risk input[type="text"]{    background: #fff 0% 0% no-repeat padding-box!important;}
		.page-template-template-landing-page-mobile .star_rating .stars img{margin-left:0;}
		.page-template-template-landing-page-mobile .row.stars{justify-content:center;}
		.page-template-template-landing-page-mobile .media_block h1{text-align:center;}
		.page-template-template-landing-page-mobile .burn_fat_mobile img {
			width: auto;
		}
		.page-template-template-landing-page-mobile .row.burn_fat_mobile {margin-left:15px;}
		.page-template-template-landing-page-mobile .burn_fat_left{float:left;}
		.page-template-template-landing-page-mobile .burn_fat_right {
			float: right;
			max-width: 100%;
		
		}
		.page-template-template-landing-page-mobile .burn_fat_right {
			float: right;
			max-width: 64%;
			padding-left: 20px;
			padding-top: 0;
		}
		.page-template-template-landing-page-mobile div.benefits img {
		
		width: 21%;
		height: auto;
		object-fit: contain;
		padding-left: 13px;
	}
	.page-template-template-landing-page-mobile .final_mobile_content {
		padding: 20px;
		margin-bottom: 101px;
		text-align: center;
		padding-top:30px;
	}
	.page-template-template-landing-page-mobile div.stick_bar {
		position: fixed;
		bottom: -2px;
		z-index: 10000;
	}
	.page-template-template-landing-page-mobile  .testimonial-field {
       margin-top: 0!important;
	}
	.blog-template-template-blog-details main .container {
    max-width: 850px;
}
.blog-template-template-blog-details .details_coach {
    margin-top: 40px;
    font-size: 16px;
}
.top_most_banner p {
    background: #5d1435;
}
h3.bmi-h3 strong{background:transparent;}
.fields .bootstrap-scope{    margin-bottom: 30px;}
.blog-template-template-blog-details .first_tea {
    display: none;
}
.blog-det-ban:after {
    content: "";
    background: #0000008f;
    position: absolute;
    bottom: 20px;
    padding: 1px;
    width: 96%;
    height: 100px;
    z-index: 0;
    background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 100%);
}
.details_banner {
    left: 57px;
}
.final_mobile_view_banner img {width:100%;}
.page-template-template-landing-page-mobile div#stick_bar {
    width: 100%;
    background: #68002f;
       padding: 35px 20px;
    max-width: 640px;
}
.page-template-template-landing-page-mobile  div#stick_bar img+img {
    width: 100%;
	display:none;
}
.page-template-template-landing-page-mobile .landing_page_mobile img.animate {
    width: 10%!important;
    position: absolute;
    bottom: 22px;
}
.order_price .gift img {
    position: absolute;
    right: 0;
    bottom: -22px;
    width: 162px;
}
.page-template-template-landing-page-mobile div#stick_bar{text-align:right;}
.page-template-template-landing-page-mobile div#stick_bar button {background: #feac4f;    border-radius: 4px;
    border-bottom: 3px #98580f solid;
}
.page-template-template-landing-page-mobile img.mobile-bot-img {
  
}
li.wc_payment_method.payment_method_razorpay {
    margin-left: 0;
}
.zeroBouncsStatus.emailFailed{background-image:url(<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/emailfail.png); background-repeat:no-repeat;}
.zeroBouncsStatus.emailSuccess{background-image:url(<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/emailsuccess.png); background-repeat:no-repeat;}
@media only screen and (max-width: 767px) and (min-width: 320px){
	.order_price .gift img{position:initial; width: auto;}
.order-now .sixty_days button{  margin-left: 0px;}
.sixty_days .col-md-2{text-align:center;}
.order-now .delivery {  justify-content: center;}
.container.order_now_price:first-child .col-md-2 {
    padding-top: 20px;
}
}
		</style>
	</head>

	<body <?php body_class(); ?>>
<script>//insert_event_code_here;</script>
		<?php
		wp_body_open();
		?>

		<header id="site-header" class="header-footer-group" role="banner">
<div class="top_most_banner">

<p> <img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/top_most_banner.png">  Call to Order  080-46235201 </p>
</div>
			<div class="header-inner section-inner">
				<div class="container">
				<div class="row">
				<div class="header-titles-wrapper col-md-2">

					<?php

					// Check whether the header search is activated in the customizer.
					$enable_header_search = get_theme_mod( 'enable_header_search', true );

					if ( true === $enable_header_search ) {

						?>

	
					<?php } ?>

					<div class="header-titles ">

						<?php
							// Site title or logo.
							twentytwenty_site_logo();

							// Site description.
							//twentytwenty_site_description();
						?>

					</div><!-- .header-titles -->

					<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
							</span>
							<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
						</span>
					</button><!-- .nav-toggle -->

				</div><!-- .header-titles-wrapper -->

				<div class="header-navigation-wrapper col-md-4">

					<?php
					if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
						?>

							<nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'twentytwenty' ); ?>" role="navigation">

								<ul class="primary-menu reset-list-style">

								<?php
								if ( has_nav_menu( 'primary' ) ) {

									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'primary',
										)
									);

								} elseif ( ! has_nav_menu( 'expanded' ) ) {

									wp_list_pages(
										array(
											'match_menu_classes' => true,
											'show_sub_menu_icons' => true,
											'title_li' => false,
											'walker'   => new TwentyTwenty_Walker_Page(),
										)
									);

								}
								?>

								</ul>

							</nav><!-- .primary-menu-wrapper -->

						<?php
					}

					if ( true === $enable_header_search || has_nav_menu( 'expanded' ) ) {
						?>

						<div class="header-toggles hide-no-js ">

						<?php
						if ( has_nav_menu( 'expanded' ) ) {
							?>

							<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

								<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
										<span class="toggle-icon">
											<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
										</span>
									</span>
								</button><!-- .nav-toggle -->

							</div><!-- .nav-toggle-wrapper -->

							<?php
						}

						if ( true === $enable_header_search ) {
							?>

							<?php
						}
						?>

						</div><!-- .header-toggles -->
						<?php
					}
					?>

				</div><!-- .header-navigation-wrapper -->
				<!-- header-navigation-user -->
				<div class="header-navigation-user col-md-6 text-right">
		
					<a href="<?php echo get_site_url(); ?>/shop" class="btn">Subscription Plan</a>
					
					<?php if(is_user_logged_in()){ ?>
						<!--  <a href="<?php echo get_site_url(); ?>/user">My Account</a>-->
						<a href="<?php echo get_site_url(); ?>/My-account/orders/">My Account</a>
						<a href="<?php echo wp_logout_url(); ?>">Logout</a>
					<?php }else{?>
						<a href="<?php echo get_site_url(); ?>/user-login">Login</a>
					<?php }?>
				
				</div>
				</div><!-- .header-row -->
				</div> <!-- .header-container -->
			</div><!-- .header-inner -->

			<?php
			// Output the search modal (if it is activated in the customizer).
			if ( true === $enable_header_search ) {
				get_template_part( 'template-parts/modal-search' );
			}
			?>

		</header><!-- #site-header -->

		<?php
		// Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );
