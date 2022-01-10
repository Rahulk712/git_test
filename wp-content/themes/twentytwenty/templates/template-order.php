<?php
/**
 * Template Name: Order Now - Home Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

//get_header();
global $product;
$product_id = $product->get_id();
$product_attr =  get_post_meta($product_id);
$shippingClass = $product->get_shipping_class();
$shipp_classname= get_term_by('slug',$shippingClass ,'product_shipping_class');
$free_shipping = ($shipp_classname->name=='Free Delivery')?1:0;
?>	
<div class="container order_now_price">
	<div class="row cure_free">
		<div class="col-md-6">
			<img class="pocket_ordr" src="<?php echo wp_get_attachment_image_url( $product->get_image_id(), 'full' ); ?>">
		</div>
		<div class="col-md-6">				
			<div class="order_price">
				<h5><?php echo $product->get_name(); ?></h5>
				<!--  <h6>1 Month Cure</h6>-->
				<p><span><?php if(isset($product_attr['pack_description']['0']) && $product_attr['pack_description']['0']!=''){ echo $product_attr['pack_description']['0']; }?></span></p>
				<ul>
					<?php if(isset($product_attr['give_more_energy']['0']) && $product_attr['give_more_energy']['0']=='1'){ ?><li> Gives more Energy</li><?php }?>
					<?php if(isset($product_attr['burns_fat']['0']) && $product_attr['burns_fat']['0']=='1'){ ?><li> Burns Fat</li><?php }?>
					<?php if(isset($product_attr['100%_money_back_guarantee']['0']) && $product_attr['100%_money_back_guarantee']['0']=='1'){ ?><li> 100% Money Back Guarantee!</li><?php }?>
				</ul>
				<article><?php echo get_woocommerce_currency_symbol().$product->get_price();?></article>
				<div class="save">
					<small><strike><?php echo get_woocommerce_currency_symbol().$product->get_regular_price();?></strike></small>
					<p><small> You Save <?php echo get_woocommerce_currency_symbol().($product->get_regular_price() - $product->get_price());?></small></p>
				</div>
				<?php if(isset($product_attr['offer_image']['0']) && $product_attr['offer_image']['0']!=''){  ?>
				<div class="gift">
					<!--  <span>+</span>--> 
					<img src="<?php echo wp_get_attachment_image_url($product_attr['offer_image']['0']); ?>">
				</div>
				<?php } ?>
				<div class="energy">
					<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/price-layer.png">
				</div>
			</div>
		</div>
	</div>
	<div class="row sixty_days">
		<div class="<?php if($free_shipping=='1'){?>col-md-8<?php }else{?>col-md-10<?php }?>">
			<p><?php if(isset($product_attr['short_description']['0']) && $product_attr['short_description']['0']!=''){ echo $product_attr['short_description']['0']; }?></p>
		</div>
		<?php if($free_shipping=='1'){?>
		<div class="col-md-2">
			<div class="delivery">
				<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Group 1459.svg">
				<p>Free Delivery</p>
			</div>
		</div>
		<?php }?>
		<div class="col-md-2">
			<button type="button" class="fst_btn" onclick="add_to_cart(<?php echo $product_id;?>)">Order Now</button>
		</div>
	</div>
</div>