<?php
/**

 * Template Name: blog-details - Home Template
 * Template Post Type: post, page,blog
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();
?>

<main id="site-content" role="main">
<?php 
$postid = get_the_ID();
$post = get_post( $postid );
$title = $post->post_title;
$desc = $post->post_content;
$category_detail=get_the_category($postid);
$src = wp_get_attachment_image_src( get_post_thumbnail_id($postid),'thumbnail_size' );
$url = $src[0];
$mypost =  get_post_meta($postid);
?>

<div class="tit-breadcrumbs"><div class="container"><?php //echo get_the_title();?></div></div>
     <div class="container-fluid">
         <div class="blog_details_header">
             <div class="container">
                 <div class="row">
                    <div class="col-md-12 blog-det-ban"> <img src="<?php echo $url;?>"></div>
                     <div class="col-md-6">
                         <div class="details_banner">
                             <p><?php  echo ($category_detail['0']->cat_name);?></p>
                             <h6><?php  echo $title; ?></h6>
                         </div>
                     </div>
                     <div class="col-md-2">
                     </div>
                     <div class="col-md-4">
                         <div class="first_tea">
                         <img src="<?php echo get_site_url();?>/wp-content/themes/twentytwenty/assets/images/blog_deatils_1.png">
                             <article>The first tea that makes you slim without fitness.</article>
                             <button type="button">Order Now</button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="details_coach">
             <div class="container">
                 <?php echo $desc; ?>
             </div>
         </div>
     </div>
     <div class="container">
     	<?php echo do_shortcode( '[ssba-buttons]' ); ?>
     	</div>
</main><!-- #site-content -->
<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>