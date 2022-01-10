<?php
/**
 * Template Name: Blogs - Home Template
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
	<div class="container-fluid">
		<div class="blog">
			<!--   <div class="bread_crumb">
				<h3>Blogs</h3>
				<p><span>Home</span>| Blogs </p>
			</div>-->
			<?php $my_query = new WP_Query('post_type=blog&posts_per_page=100');
			
				if ( $my_query->have_posts() ) {
					while ( $my_query->have_posts() ) {
						$my_query->the_post();
						$post_id = get_the_ID() ;
						$mypost =  get_post_meta($post_id);
						
					//if(get_post_meta($post->ID, 'show_on_slider', true) == '1') {
									$slider_title =  $post->post_title;
							$categories = get_the_category($post->ID);
							$slider_content = $categories['0']->cat_name;
							$src = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'thumbnail_size' );
							$url = $src[0];
			  				$post_link = get_permalink($post->ID);
			            }
						
					}
				
				?>
		<div class="container">
			<div class="real_food">
				<div class="row">
					<div class="left_content_blog">
							<?php /*<div class="col-md-10">
							<a href="<?php echo $post_link; ?>">
							<img src="<?php echo $url ?>"> 
							<div class="inside_content">
								<p><?php echo $slider_content;?></p>
								<h6><?php echo $slider_title;?></h6>
							</div>
							</a>
						</div>
					<div class="col-md-5">
							<div class="nutrition">
								<?php $my_query = new WP_Query('post_type=blog&posts_per_page=4');
								if ( $my_query->have_posts() ) {
									$count = 1;
									while ( $my_query->have_posts() ) {
										$my_query->the_post();
										$post_id = get_the_ID() ;
										$mypost =  get_post_meta($post_id);
										$categories = get_the_category($post->ID);	
											if($count == 1 || $count === 3){?>
												<div class="row">
											<?php }?>
											<div class="col-md-6">
												<a href="<?php echo get_permalink($post_id); ?>">
												<img src="<?php echo  wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'thumbnail_size' )['0']; ?>">
												<p><?php echo $categories['0']->cat_name;?></p>
												<h6><?php echo $post->post_title;?></h6>
												</a>
											</div>
											<?php 
											if($count==2 || $count==4){?>
												</div>
											<?php }
											$count++;
											
									 }
								}
								?>
								
							</div>
						</div>
							*/?>	
							
					
					</div>
				</div>
			<div class="nutrition">
				<div class = "row">
						<div class="col-md-10">
								<?php $my_query = new WP_Query('post_type=blog&posts_per_page=100');
								if ( $my_query->have_posts() ) {
									$count=1;
									$i=0;
									while ( $my_query->have_posts() ) {
										$i++; if($count%3==1){  ?><div class="row"> <?php  } 
											$my_query->the_post();
											$post_id = get_the_ID() ;
											$mypost =  get_post_meta($post_id);
											$categories = get_the_category($post->ID)
											?>
												<div class="col-md-4">
													<a href="<?php echo get_permalink($post_id); ?>">
														<img src="<?php echo  wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'thumbnail_size' )['0']; ?>">
														<p><?php  echo $categories['0']->cat_name;?></p>
														<h6><?php echo $post->post_title;?></h6>
													</a>
												</div>
											<?php 
											if($count%3==0){ echo "</div>"; }
											if($count%3!=0 && $my_query->post_count<=$i) {
												echo "</div>";
											}
											$count++;
										} 
								}
								?>
							</div>
						<div class="col-md-2 recent">
							<h2>Top stories</h2>
							<?php $my_query = new WP_Query('post_type=blog&posts_per_page=100');
							if ( $my_query->have_posts() ) {
								while ( $my_query->have_posts() ) {
									$my_query->the_post();
									$post_id = get_the_ID() ;
									$mypost =  get_post_meta($post_id);
									$categories = get_the_category($post->ID);
									if(get_post_meta($post->ID, 'show_on_feature', true) == '1') { ?>
										<div class="watch_stories">	
											<a href="<?php echo get_permalink($post_id); ?>">						
											<h3><span><?php echo $categories['0']->cat_name;?></span><?php echo $post->post_title;?></h3>
											<article><?php echo strip_tags($post->post_content);?></article>
											</a>
										</div>
								<?php }
										
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>