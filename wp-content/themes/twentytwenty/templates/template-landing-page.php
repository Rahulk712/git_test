<?php
/**
 * Template Name: Landing Page - Home Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */
//if(wp_is_mobile()){
//wp_redirect('/mobile-landing');
//exit;
//}
get_header();
?>
<style>


</style>
<div class="top_most_banner">

<p> <img src="https://www.masalateaforshape.in/wp-content/themes/twentytwenty/assets/images/top_most_banner.png">  Call to Order  080-46235201 </p>
</div>
<main id="site-content" role="main" class="landingpage-con">

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
// 	$my_query = new WP_Query('post_type=home_template');
	$my_query = new WP_Query('post_type=desktop_landing');
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
<?php /*<div class="top-sec">
    <div class="">
        <marquee><p><span><!--translate-->WARNING:</span> - Due to extremely high media demand, there is limited supply of Masala Tea in stock as of <span id="warning-date" data-format="LL">January 16, 2020</span><span class="av-warning-hurry" style="color: #fff;font-size: 14px;    margin-left: 5px;    margin-right: 5px;font-weight: bold;">HURRY!</span><span class="av-warning-timer" style="color: #fff;font-size: 14px;font-weight: bold;"></span><!--/translate--> </p>
    </marquee><span class="landing-call-order"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/top_most_banner.png">  Call to Order  080-46235201 </span></div>
</div>
*/?>
<div class="container-fluid">
	<div class="nutrafy_banner ">
		<div class="container nutrafy_sec">
			<div class="row nutrafy_top">
				<div class="col-md-1 logo">
					<div class="nutrafy_banner_content"url(<?php echo wp_get_attachment_image_url($mypost['banner_image_lw']['0']);?>)">
						<img class="index-sec1-logo" src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Masala_picto copy 2.png">
						<img class="logo-divider" src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/logo-divider.png">
					</div>
				</div>
				<div class="col-md-5 top-cont">
					<p><?php echo $mypost['small_title_lw']['0'];?> </p>
				</div>
				<div class="col-md-6 usa">
					<img class="tea_cup" src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/tea_cup.png">
					<span><?php echo $mypost['paragraph_lw']['0'];?>
				</div>
			</div>
			
			<div class="row nutrafy_bottom">
			<img class="bg-mod" src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/desktopbg.png">
				<div class="col-md-8">
					<div class="bnr-txt1">
						<h1><?php echo $mypost['lose_weight_title']['0'];?></h1>
					</div>
					<div class="bnr-txt2">
						<h2><?php echo $mypost['without_work_lw_title']['0'];?></h2>
					</div>
					<div class="bnr-txt3">
						<h3><?php echo $mypost['box_title']['0'];?></h3>
					</div>
					<div class="bnr-txt4">
						<h4><?php echo $mypost['feature_title_lw']['0'];?><span><?php echo $mypost['feature_sub_title_lw']['0'];?></span></h4>
					</div>
					<ul class="sec1-list-item">
						<li><span><span>+</span><?php echo $mypost['feature_grp_lw_feature_1_lw']['0'];?></span> <?php echo $mypost['feature_grp_lw_feature_sub_title_1']['0'];?></li>
						<li><span><span>+</span><?php echo $mypost['feature_grp_lw_feature_2_lw']['0'];?> </span> <?php echo $mypost['feature_grp_lw_feature_sub_title_2']['0'];?></li>
						<li><span><span>+</span><?php echo $mypost['feature_grp_lw_feature_3_lw']['0'];?> </span><?php echo $mypost['feature_grp_lw_feature_sub_title_3']['0'];?> </li>
						<li><span><span>+</span><?php echo $mypost['feature_grp_lw_feature_4_lw']['0'];?> </span><?php echo $mypost['feature_grp_lw_feature_sub_title_4']['0'];?></li>
						<li><span><span>+</span><?php echo $mypost['feature_grp_lw_feature_5_lw']['0'];?> </span> <?php echo $mypost['feature_grp_lw_feature_sub_title_5']['0'];?></li>
					</ul>
						<img class="rnd-txt" src="<?php echo wp_get_attachment_image_url($mypost['notrafy_image_lw']['0']); ?>">
						<img class="index-sec1-arrow" src="<?php echo wp_get_attachment_image_url($mypost['choose_image_lw']['0']); ?>">
						<img class="index-prd" src=<?php echo wp_get_attachment_image_url($mypost['text_image_lw']['0']); ?>" style="display:none;">
					<div class="offer">
						<div class="flag">
							<img src="<?php echo wp_get_attachment_image_url($mypost['flag_image']['0']); ?>">
							<p><?php echo $mypost['flag_title']['0'];?></p>
						</div>
						<img src="<?php echo wp_get_attachment_image_url($mypost['grpou_image_lw']['0']); ?>">
					</div>
					
				</div>
				
				<div class="col-md-4">
					<div id="order_free" class="nutrify_banner-registration-form_desktop_landing_page">
						<div class="right_section">
						<div class="icon_image">
							<div class="row">
								<div class="col-md-4">
								</div>
								<div class="col-md-4">
									<div class="logo_fssai">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/FSSAI_logo.png" alt="" >
									</div>
								</div>
								<div class="col-md-4">
									<div class="logo_hundred">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Vector.png" alt="">
									</div>
								</div>
								
							</div>
						</div>
						<div class="nature_img">
							<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/hundred.png" alt="Image" height="50" width="150">
						</div>
						<div class="row rushmyorder">
						<img class="offer_price" src="<?php echo wp_get_attachment_image_url($mypost['top_register_image']['0']); ?>">
						<img class="offer_money_back" src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/money_back.png" alt="Image" >
							<div class="col-md-12">
								<?php /*<form class="no_risk nutrafy">
									  <button class="close-btn animate_button">+</button>
									  <h5>Try Without any risk</h5>
									  <input type="text" name="firstname" value="" placeholder="Name*">
									  <br>
									  <div class="email-otp">
									  <input type="text" name="email" value="" placeholder="Email*">
									  </div>
									  <br>
									  <input type="text" name="phone" value="" placeholder="Phone*">
									  <br>
									  <input type="submit" value="Rush My Order">
									  <p><span>*</span> Check that your mobile and your email is correctly written. It will allows us to contact you and get your shipping information to send your product.</p>
								</form>*/?>
							<?php  if(is_user_logged_in()){ ?>
							<form id="without_risk" class="no_risk " action="/MasalaTea/shop" method="post">
									<button class="close-btn animate_button">+</button>
								  <h5>Try Without any risk</h5>
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
								  <p><span>*</span> Check that your mobile and your email is correctly written. It will allows us to contact you and get your shipping information to send your product.</p>
								 
								</form>
							<?php }else{ echo do_shortcode( '[ultimatemember form_id="361"]' ); } ?>
								<div class="bottom_img">
									<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Layer.png" alt="Image" >
								</div>
								<div class="bottom_img2">
									<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/flower.png" alt="Image" >
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="clear_all">
</div>
<div class="container-fluid">
	<div class="nutrafy_masala">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="nutrafy_content">
						<div class="row">
							<div class="col-md-12">
								<h1><?php echo $mypost['question_title']['0'];?><br><span><?php echo $mypost['masala_title_wmfs']['0'];?></span></h1>
								<h3><?php echo $mypost['title_wfms']['0'];?></h3>
							</div>
							<img class="enlarge" src="<?php echo wp_get_attachment_image_url($mypost['small_image_wmfs']['0']); ?>">
						</div>
					</div>
					<div class="nutrafy_msg">
						<p><?php echo $mypost['description_wmfs']['0'];?></p>
						<p><?php echo $mypost['description_2_wmfs']['0'];?></p>
					</div>
					<div class="row">
					<div class="col-md-12">
						<div class="nutrafy_news_img">
								<div class="star-images">
									<div class="row">
										<div class="col-md-3 col-sm-3">
											<div class="star">
												<img src="<?php echo wp_get_attachment_image_url($mypost['box_2_image_grp_image_1_wmfs']['0']); ?>">
											</div>
										</div>
										<div class="col-md-3 col-sm-3">
											<div class="NDTV">
												<img src="<?php echo wp_get_attachment_image_url($mypost['box_2_image_grp_image_2_wmfs']['0']); ?>">
											</div>
										</div>
										<div class="col-md-3 col-sm-3">
											<div class="zee">
												<img src="<?php echo wp_get_attachment_image_url($mypost['box_2_image_grp_image_3_wmfs']['0']); ?>">
											</div>
										</div>
										<div class="col-md-3 col-sm-3">
											<div class="indian">
											<img src="<?php echo wp_get_attachment_image_url($mypost['box_2_image_grp_image_4_wmfs']['0']); ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="nutrafy_img_size">
								<h5><?php echo $mypost['result_title_wmfs']['0'];?></h5>
								<p><?php echo $mypost['result_description_wmfs']['0'];?></p>
							</div>
						</div>
						<div class="col-md-4">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="nutra_pocket">
						 <img src="<?php echo wp_get_attachment_image_url($mypost['banner_wmfs']['0']); ?>" alt=" " style="display:none;">
                         <img src="<?php echo wp_get_attachment_image_url($mypost['nutrify_image_wmfs']['0']); ?>" alt=" " class="model-img"> 
						 <img src="<?php echo wp_get_attachment_image_url($mypost['result_image']['0']); ?>" alt=" " class="showre"> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="nutrafy_natural measure_scale">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<p><?php echo $mypost['box_title_2_wmfs']['0'];?></p>
					<article><?php echo $mypost['box_article_wmfs']['0'];?></article>
				</div>
				<div class="col-md-4">
					<a href="#order_free"><button type="button" class="animate_button"> <?php echo $mypost['box_button']['0'];?> </button></a>
				</div>
			</div>				
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="nutrafy_french_form">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					 <img src="<?php echo wp_get_attachment_image_url($mypost['banner_image_smfs']['0']); ?>" alt=" "> 
					<div class="nutrafy_fade_img">
						<img src="<?php echo wp_get_attachment_image_url($mypost['doctor_image_smfs']['0']); ?>" alt=" " class="doc-re"> 
						 <img src="<?php echo wp_get_attachment_image_url($mypost['nutrafy_image_smfs']['0']); ?>" alt=" " class="masal-pa"> 
						<img src="<?php echo wp_get_attachment_image_url($mypost['nutrafy_grp_image']['0']); ?>" alt=" " class="doc-re-ico"> 
					</div>
				</div>
				<div class="col-md-6">
					<div class="nutrafy_fat">
						<h2><?php echo $mypost['title_smfs']['0'];?> <span><?php echo $mypost['subtitle_smfs']['0'];?></span></h2>
						<p<?php echo $mypost['description_1_smfs']['0'];?></p>
						<p><?php echo $mypost['description_2_smfs']['0'];?></p>
						<div class="nutrafy_burn">
							<div class="row">
								<div class="col-md-1">
								</div>
								<div class="col-md-11 burnfatx">
									<img src="<?php echo wp_get_attachment_image_url($mypost['burn_image_1_smfs']['0']); ?>" alt=" "> 
									<p><?php echo $mypost['burn_description_smfs']['0'];?></p>
									<img src="<?php echo wp_get_attachment_image_url($mypost['burn_image_2_smfs']['0']); ?>" alt=" "> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="nutrafy_natural">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<p><?php echo $mypost['box_title_smfs']['0'];?></p>
					<article><?php echo $mypost['box_article_smfs']['0'];?></article>
				</div>
				<div class="col-md-4">
					<a href="#order_free"> <button type="button" class="animate_button"><?php echo $mypost['box_button']['0'];?></button></a>
				</div>
			</div>				
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="nutrafy_burn_fat">
		<div class="container">
			<h2> <?php echo $mypost['title_hdmfs']['0'];?></h2>
			<h3> <?php echo $mypost['sub_title_hdmfs']['0'];?></h3>
			<h4> <?php echo $mypost['box_title_grp_hdmfs_title_1']['0'];?> <span> <?php echo $mypost['box_title_grp_hdmfs_title_2']['0'];?></span>  <?php echo $mypost['box_title_grp_hdmfs_title_3']['0'];?></h4>
				<div class="row">
				  <div class="col-md-4">
					<div class="card">
					  <h3><?php echo $mypost['des_box_1_grp_hdmfs_title_1_hdmfs']['0'];?> <span><?php echo $mypost['des_box_1_grp_hdmfs_subtitle_1']['0'];?></span></h3>
					  <p><?php echo $mypost['des_box_1_grp_hdmfs_description_1']['0'];?></p>
					  <section class="burn"><?php echo $mypost['des_box_1_grp_hdmfs_number_1']['0'];?></section>
					</div>
				  </div>

				  <div class="col-md-4">
					<div class="card block">
					  <h3><?php echo $mypost['des_box_2_grp_hdmfs_title_2_']['0'];?> <span><?php echo $mypost['des_box_2_grp_hdmfs_sub_title_2']['0'];?></span></h3>
					  <p><?php echo $mypost['des_box_2_grp_hdmfs_description_2']['0'];?></p>
					  <section><?php echo $mypost['des_box_2_grp_hdmfs_number_2']['0'];?></section>
					</div>
				  </div>
				  
				  <div class="col-md-4">
					<div class="card app">
					  <h3><?php echo $mypost['des_box_3_grp_hdmfs_title_3']['0'];?> <span><?php echo $mypost['des_box_3_grp_hdmfs_title_3']['0'];?></span></h3>
					  <p><?php echo $mypost['des_box_3_grp_hdmfs_description_3']['0'];?>
					  </p>
					  <section><?php echo $mypost['des_box_3_grp_hdmfs_number_3']['0'];?></section>
					</div>
				  </div>
				</div>
			<h5><?php echo $mypost['fact_title_hdmfs']['0'];?></h5>
				<div class="row melt">
					<div class="col-md-4">
						<h6><?php echo $mypost['natural_title_hdmfs']['0'];?></h6>
						<ul class="sec4-left">
							<li class="bg-left1 lazy green-yerba"><h2>Green Tea and Yerba Matte</h2><?php echo $mypost['nutrafy_des_grp_nutrafy_dec_1']['0'];?></li>
							<li class="bg-left2 lazy"><h2>Nettle</h2><?php echo $mypost['nutrafy_des_grp_nutrafy_dec_2']['0'];?></li>
						</ul>				
					</div>
					<div class="col-md-4">
						<img class="triple" src="<?php echo wp_get_attachment_image_url($mypost['nutrafy_image']['0']); ?>">
						<img class="triple_safe" src="<?php echo wp_get_attachment_image_url($mypost['natural_image']['0']); ?>">
					</div>
					<div class="col-md-4">
						<p><?php echo $mypost['natural_paragraph']['0'];?></p>
						<ul class="sec4-right">
							<li class="bg-rgt1 lazy"><h2>Dandelion</h2><?php echo $mypost['nutrafy_des_grp_nutrafy_dec_3']['0'];?></li>
							<li class="bg-rgt2 lazy"><h2>Desmodium</h2><?php echo $mypost['nutrafy_des_grp_nutrafy_dec_4']['0'];?></li>
							<li class="bg-rgt2 lazy"><h2>Guarana</h2>Natural stimulant to support your weight loss. Guarana seeds are still used as medicine. Guarana is used for weight loss, to enhance athletic performance as a stimulant.</li>
						</ul>
					</div>
				</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="nutrafy_natural">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<p><?php echo $mypost['button_boxt_title']['0'];?></p>
					<article><?php echo $mypost['button_boxt_article']['0'];?></article>
				</div>
				<div class="col-md-4">
					<a href="#order_free"><button type="button" class="animate_button"><?php echo $mypost['button_hdmfs']['0'];?></button></a>
				</div>
			</div>				
		</div>
	</div>
</div>
<div class="container-fluid">
<div class="masala" style="margin-bottom: 179px;">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<h5>Why should you buy</h5>
					<h3>Masala For Shape Now ?</h3>
				<div class="small_img">
					<div class="row buy">
						<div class="col-md-6">
							<div class="shape_now">
								<div class="row">
										<div class="col-md-3 shape_icons">
											<div class="circle_img">
												<img src="http://masalatea.baryons.net/wp-content/uploads/2020/01/1-1.png" alt=" " data-pagespeed-url-hash="3413197855" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
											</div>
										</div>
										<div class="col-md-9 shape_text">
											<div class="pleasant">
												<p>Pleasant to drink</p>
											</div>
										</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="shape_now">
								<div class="row">
									<div class="col-md-3 shape_icons">
										<div class="circle_img">
											<img src="http://masalatea.baryons.net/wp-content/uploads/2020/01/4.png" alt=" " data-pagespeed-url-hash="2729309690" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
										</div>
									</div>
									<div class="col-md-9 shape_text">
										<p>Natural and without any contraindication</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="shape_now">
								<div class="row">
									<div class="col-md-3 shape_icons">
										<div class="circle_img">
											<img src="http://masalatea.baryons.net/wp-content/uploads/2020/01/2.png" alt=" " data-pagespeed-url-hash="2140309848" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
										</div>
									</div>
									<div class="col-md-9 shape_text">
										<p>Recommended for both men &amp; women</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="shape_now">
								<div class="row">
									<div class="col-md-3 shape_icons">
										<div class="circle_img">
											<img src="http://masalatea.baryons.net/wp-content/uploads/2020/01/6.png" alt=" " data-pagespeed-url-hash="3318309532" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
										</div>
									</div>
									<div class="col-md-9 shape_text">
										<p>Partly neutralizes absorbed sugars</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="shape_now">
								<div class="row">
									<div class="col-md-3 shape_icons">
										<div class="circle_img">
										<img src="http://masalatea.baryons.net/wp-content/uploads/2020/01/3.png" alt=" " data-pagespeed-url-hash="2434809769" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
										</div>
									</div>
									<div class="col-md-9 shape_text">
										<p>Helps clean your liver for better fat removal</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="shape_now">
								<div class="row">
									<div class="col-md-3 shape_icons">
										<div class="circle_img">
											<img src="http://masalatea.baryons.net/wp-content/uploads/2020/01/7.png" alt=" " data-pagespeed-url-hash="3612809453" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
										</div>
									</div>
									<div class="col-md-9 shape_text">
										<p>Contributes to the elimination of fats</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="shape_now">
								<div class="row">
									<div class="col-md-3 shape_icons">
										<div class="circle_img">
											<img src="http://masalatea.baryons.net/wp-content/uploads/2020/01/4.png" alt=" " data-pagespeed-url-hash="2729309690" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
										</div>
									</div>
									<div class="col-md-9 shape_text">
										<p>Fights off paunchy stomachs</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="shape_now">
								<div class="row">
									<div class="col-md-3 shape_icons">
										<div class="circle_img">
											<img src="http://masalatea.baryons.net/wp-content/uploads/2020/01/8.png" alt=" " data-pagespeed-url-hash="3907309374" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
										</div>
									</div>
									<div class="col-md-9 shape_text">
										<div class="pleasant">
											<p>Reduces hunger pangs</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<button type="button">  Rush My Order</button>
					</div>
					</div>
				</div>
				<div class="col-md-5 col-xs-5">
				<div class="tall_img">
					<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/landing-masalapomo.png" alt=" " data-pagespeed-url-hash="1056508746" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
				</div>
			</div>
			</div>
		</div>
	</div>
	<div class="nutrfy_masala" style="display:none;">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<img class="ladygirl_img" src="<?php echo wp_get_attachment_image_url($mypost['banner_image_wmfs']['0']); ?>" alt=" "> 
				</div>
				<div class="col-md-8 nutrfy_premium">
					<div class="row">
					
						<h3><?php echo $mypost['why_title_wmfs']['0'];?></h3>
						<h4><?php echo $mypost['main_title_wmfs']['0'];?></h4>
						<h5><span><?php echo $mypost['box_title_wmfs']['0'];?></span><?php echo $mypost['box_sub_title_wmfs']['0'];?></h5>
						<section class="norm">Not all supplements are created equal! There are a number of weight loss products that overcommit and underdeliver. Nutrafy Garcinia Cambogia contains pure fruit extract which has clinically proven weight loss benefits. What makes it better than any other Garcinia supplement out there is the fact that it <strong>contains 60% HCA</strong>, the highest concentration of the core weight loss ingredient, ensuring instant weight loss and sustainable results.</section>	
						<article><?php echo $mypost['article']['0'];?></article>		
						<section><?php echo $mypost['descriptions_2__wmfs']['0'];?></section>
					</div>
					<div class="row">
						<div class="col-md-1">
							<img class="single_bot "src="<?php echo wp_get_attachment_image_url($mypost['nutrafy_image_wmfs']['0']); ?>" alt=" "> 
						</div>
						<div class="col-md-11">
							<img class="two_grls" src="<?php echo wp_get_attachment_image_url($mypost['small_image_1_wmfs']['0']); ?>" alt=" "> 
							<img class="pure_two_grls" src="<?php echo wp_get_attachment_image_url($mypost['natural_image_wmfs']['0']); ?>" alt=" "> 
							<ul class="sec5-list-item">
								<li class="lazy img_1"><?php echo $mypost['advantage_wmfs_advantage_1']['0'];?> </li>
								<li class="lazy img_2"><?php echo $mypost['advantage_wmfs_advantage_2']['0'];?></li>
								<li class="lazy img_3"><?php echo $mypost['advantage_wmfs_advantage_3']['0'];?></li>
								<li class="lazy img_4"><?php echo $mypost['advantage_wmfs_advantage_4']['0'];?></li>
								<li class="lazy img_5"><?php echo $mypost['advantage_wmfs_advantage_5']['0'];?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="nutrafy_natural">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<p><?php echo $mypost['button_box_title_wmfs']['0'];?></p>
					<article><?php echo $mypost['box_article']['0'];?></article>
				</div>
				<div class="col-md-4">
				<a href="#order_free"><button type="button" class="animate_button"> <?php echo $mypost['button_wmfs']['0'];?></button></a>
				</div>
			</div>				
		</div>
	</div>
</div>		

	
	   
</main><!-- #site-content -->

<!-- Mobile Landing Page starts here -->

<div class="page-template-template-landing-page-mobile page-template-templatestemplate-landing-page-mobile-php template-landing-page-mobile"> 

<main id="site-content" role="main" class="mobilelandingcontent">

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

</div>

 <!-- Mobile Landing Page Ends here -->



<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
