<?php
/**
 * Template Name: Main Website Home Page - Home Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();

?>

<main id="site-content" role="main">	

<div class="container-fluid">
	<div class="banner">
		<div class="container">
			<div class="row">			
				<!--<div class="banner-model-image">
					<div class="frst_img">
						<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Gwp.png">
					</div>					
				</div>-->
				<?php $my_query = new WP_Query('post_type=home_template');
				if ( $my_query->have_posts() ) {
					while ( $my_query->have_posts() ) {
						$my_query->the_post();
						$post_id = get_the_ID() ;
					}
				}
				$mypost =  get_post_meta($post_id);
				?>
				<div class="banner-content" id="formcont"  url(<?php //echo wp_get_attachment_image_url($mypost['banner_image_lw']['0']);?>)>
					<!--<div class="top_section">
						<article></article>
						
						<p><span></span></p>
					</div>
					<div class="bottom_section">
						
						
					</div>-->
				</div>
				<div class="mobilebanner" style="display: none;">
					<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/mobile-banner.jpg" alt="" >
					<div class="bottom_section">
						<button type="button"class="calculate_bmi bmi_redirect">Calculate Your BMI for Free</button>
						<div class="sml_text"><span>*</span>BMI=Body Mass Index</div>
					</div> 
				</div>
                <div class="ban_head col-md-12">
				
                    <div class="ban_cont ban_text col-md-6">
                    	<img src="<?php echo wp_get_attachment_image_url($mypost['feature_grp_msn_image_1_msn']['0']); ?>" alt=" ">
						
                    </div>
                    <div class="ban_head ban_form  col-md-6">
                        <div class="banner-registration-form">
					<div class="right_section">
						<div class="icon_image">
							<div class="row">
								
									<div class="col-md-12">
									
									<?php /*<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/feat_FAS.png" alt="" > */?>
								</div>

								<?php /* <div class="col-md-4">
									<div class="logo_fssai">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/FSSAI_logo.png" alt="" >
									</div>
								</div>
								<div class="col-md-4">
									<div class="logo_hundred">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/money_backnew.svg" alt="">
									</div>
								</div>
								*/ ?>
								
							</div>
						</div>
						<div class="nature_img" >
							<?php /* <img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/hundred.png" alt="Image" height="50" width="150"> */ ?>
						</div>	
						<div class="row rushmyorder">
							<div class="col-md-12">
								<?php if(is_user_logged_in()){ ?>
									<div class="rush_my_order_mobile"> <input type="submit" value="Subscribe Now" class="animate_button" onclick="window.location.href='/order-now';"></div>
							
								<?php }else{ ?><div class="rush_my_order_mobile"> <input type="submit" value="Subscribe" class="animate_button"></div><?php }?> 
							
								<?php if(is_user_logged_in()){ ?>
								<form id="without_risk"class="no_risk" action="/MasalaTea/shop" method="post">
									<button class="close-btn animate_button">+</button>
								  
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
											<input type="submit" value="Subscribe Now" class="um-button" id="um-submit-btn">
										</div>
									<div class="um-clear"></div>
								</div>
								  <p><span>*</span> Check that your mobile and your email is correctly written. It will allows us to contact you and get your shipping information to send your product.</p>
								 
								</form>
								<?php }else{ echo do_shortcode( '[ultimatemember form_id="361"]' ); } ?>
								 
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

<?php 
$args = array(
        'post_type'      => 'product',
        'posts_per_page' => 10,
		
    );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
global $product;
echo '<br /><a '.get_permalink().'>' . woocommerce_get_product_thumbnail().' '.get_the_title().'</a>';
echo $product->get_price_html();
echo $product ->get_short_description();
$regular_price = (float) $product->get_regular_price(); 
$sale_price = (float) $product->get_price();
$saving_price = wc_price( $regular_price - $sale_price );
echo  sprintf( __('<p class="saved-sale">You Save: %s</p>', 'woocommerce' ), $saving_price );

echo get_post_meta( get_the_ID(), 'short_description', true );
echo apply_filters(
           'woocommerce_loop_add_to_cart_link',
            sprintf(
           '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
             esc_url( $product->add_to_cart_url() ),
             esc_attr( $product->get_id() ),
             esc_attr( $product->get_sku() ),
             $product->is_purchasable() ? 'add_to_cart_button' : '',
             esc_attr( $product->product_type ),
             esc_html( $product->add_to_cart_text() )
              ),
           $product
       );

endwhile;

wp_reset_query();


?>


<div class="container-fluid aboutmasala">
	<div class="organic">
		<div class="container">
			<div class="row">
                    <div class="ban_head col-md-12">
                    <div class="col-md-6">
                        <h1> <?php echo $mypost['masala_shape_now_title']['0'];?></h1>
                        <p><?php echo $mypost['description_mfs']['0'];?></p>
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo wp_get_attachment_image_url($mypost['banner_image_msn']['0']); ?>" alt=" ">
                    </div>
                    
                </div>
			</div>
			</div>
			
			</div>
		</div>

<div class="container-fluid">
	<div class="natural">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<p><?php echo $mypost['natural_title__mfs']['0'];?></p>
					<article><?php echo $mypost['natural_article']['0'];?></article>
				</div>
				<div class="col-md-4">
					<a href="#formcont" ><button type="button" class="animate_button">  <?php echo $mypost['masala_for_shape_button']['0'];?> </button></a>
				</div>
			</div>				
		</div>
	</div>
</div>
<div class="container-fluid bor-bot">
	<div class="burn_fat">
		<div class="composition">
			<h3><?php echo $mypost['burn_fat_&_feel_great_title']['0'];?></h3>
			<h5><?php echo $mypost['sub_title_bffg']['0'];?></h5>
			<div class="green_img row">
				<div class="card" style="width: 25%;">
					 <img src="<?php echo wp_get_attachment_image_url($mypost['group_masala_bffg_image1_bffg']['0']); ?>" alt="Image">
					 <div class="card-body">
					<h5 class="card-title"><?php echo $mypost['group_masala_bffg_title1_bffg']['0'];?></h5>
					<p class="card-text"><?php echo $mypost['group_masala_bffg_description1_bffg']['0'];?>.</p></div>
				</div>
				<div class="card" style="width: 25%;">
					 <img src="<?php echo wp_get_attachment_image_url($mypost['group_masala_bffg_image_2_bffg']['0']); ?>" alt="Image">
					 <div class="card-body">
					<h5 class="card-title"><?php echo $mypost['group_masala_bffg_title_2_bffg']['0'];?></h5>
					<p class="card-text"><?php echo $mypost['group_masala_bffg_description_2_bffg']['0'];?>.</p></div>
				</div>
				<div class="card" style="width: 25%;">
					<img src="<?php echo wp_get_attachment_image_url($mypost['group_masala_bffg_image_3_bffg']['0']); ?>" alt="Image">
					 <div class="card-body">
					<h5 class="card-title"><?php echo $mypost['group_masala_bffg_title_3_bffg']['0'];?></h5>
					<p class="card-text"><?php echo $mypost['group_masala_bffg_description_3_bffg']['0'];?>.</p></div>
				</div>
				<div class="card" style="width: 25%;">
					 <img src="<?php echo wp_get_attachment_image_url($mypost['group_masala_bffg_image_4_bffg']['0']); ?>" alt="Image">
					 <div class="card-body">
					<h5 class="card-title"><?php echo $mypost['group_masala_bffg_title_4_bffg']['0'];?></h5>
					<p class="card-text"><?php echo $mypost['group_masala_bffg_description_4_bffg']['0'];?>.</p></div>
				</div>
				<?php /*<div class="card" style="width: 20%;">
					 <img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/gauq.png">
					 <div class="card-body">
					<h5 class="card-title">Guarana</h5>
					<p class="card-text">Natural stimulant to support your weight loss. Guarana seeds are still used as medicine. Guarana is used for weight loss, to enhance athletic performance as a stimulant.</p></div>
				</div> */ ?>
			</div>
		</div>
	</div>
</div>

    
    
									
						

<div class="container-fluid">
	<div class="french_form">
		<div class="container organic">
			<div class="row">
			        <div class="ban_head col-md-12">
                     <div class="col-md-6">
                        <img src="<?php echo wp_get_attachment_image_url($mypost['banner_image_fm']['0']); ?>" alt=" ">
    	                <img src="<?php echo wp_get_attachment_image_url($mypost['formula_img_fm']['0']); ?>" alt=" ">
                    </div>
                    <div class="col-md-6">
                        <h1> <?php echo $mypost['french_formula_title']['0'];?></h1>
                        	<p><?php echo $mypost['description_fm']['0'];?></p>		
                        <a href="#formcont" ><button type="button"><?php echo $mypost['sub_title_fm']['0'];?></button></a>
                    </div>
                  
                    
                </div>
			</div>
		</div>
	</div>
</div>
 <?php /* <div class="container-fluid">
	<div class="final">
		 <div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3><?php echo $mypost['finally_work_title']['0'];?></h3>
					<a href="#formcont" ><button type="button">  <?php echo $mypost['finally_work_button']['0'];?></button></a>
				</div>
			</div>
		</div>
	</div>
</div> */ ?>
<div class="container-fluid">
	<?php /* <div class="testimonial-con">
		<div class="container">
			<h3>Real Testimonial</h3>
			<p>from satisfied users</p>
			<?php echo do_shortcode( '[testimonial_view id="1"] ' ); ?> 
		</div>
	</div> */ ?>
</div>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
