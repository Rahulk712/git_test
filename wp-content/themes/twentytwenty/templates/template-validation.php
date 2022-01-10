<?php
/**

 * Template Name: validation - Home Template
 * Template Post Type: post, page,blog
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

//get_header();
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
Validation page for SMTP.com
<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php //get_footer(); ?>