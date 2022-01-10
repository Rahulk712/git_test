<?php
/**
 * Template Name: Pre Landing Hindi Page - Home Hindi Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */
global $post;
$post_slug = $post->post_name;
$page_url = $_SERVER["REQUEST_URI"];
$get_query_strings = str_replace('/','',str_replace($post_slug,'',$page_url));
$external_link = 'https://www.masalateaforshape.in/lptea/'.$get_query_strings;

get_header();
?>
<style>
body .header h3 {
    text-align: left;
    font: bold 14px/45px Raleway;
    letter-spacing: 0;
    color: #fff;
    opacity: 1;
    margin: 25px 0;
    margin-left: 15px;
}
.doctor {
    background-color: #fff;
}
.doctor p {
    color: #191919;
    background: #f2f2f2 0% 0% no-repeat padding-box;
    border-radius: 3px;
    opacity: 1;
    margin-top: 100px;
    padding: 5px;
    width: 63%;
}
/* sarath css styles start here */

.header{
	background-color: #2B3847;
	color:#FFFFFF;
	box-shadow: 0px 3px 6px #00000029;
	opacity: 1;
	width: 100%;
	height: auto;
}
.header h3 {
    text-align: left;
    font: Bold 14px/45px Raleway;
    letter-spacing: 0;
    color: #FFFFFF;
    opacity: 1;
    margin: 25px 0px;
    margin-left: 15px;
}
.options {
    display: flex;
    margin-top: 20px;
    margin-left: 200px;
}
.phone {
    display: flex;
    position: relative;
    left: 267px;
    top: -8px;
}
.phone p{
    font-size: 14px;
    font-family: urbane, sans-serif;
    font-weight: 500;
    color: #FFFFFF;
    margin-top: 22px;
    margin-left: 20px;
}
.header button {
    background: #FEAC4F 0% 0% no-repeat padding-box;
    border-radius: 6px;
    opacity: 1;
    font-size: 14px;
    font-family: urbane, sans-serif;
    font-weight: 600;
    margin: 15px 0px;
    padding: 10px 51px;
    position: relative;
	left: 300px;
    top: -8px;
}
.mail {
    display: flex;
    position: relative;
    left: 226px;
    top: 18px;
}
.mail img {
    max-width: 31px;
    max-height: 30px;
    position: relative;
    top: -5px;
}
.phone img {
    max-width: 31px;
    max-height: 30px;
    margin-top: 20px;
}
.mail p {
    font-size: 14px;
    font-family: urbane, sans-serif;
    font-weight: 500;
    color: #FFFFFF;
    margin-left: 20px;
}
.phone p {
    font-size: 14px;
    font-family: urbane, sans-serif;
    font-weight: 500;
    color: #FFFFFF;
    margin-top: 26px;
}
.doctor{
	background-color: #fff;
}
.doctor p {
    color: #191919;
    background: #F2F2F2 0% 0% no-repeat padding-box;
    border-radius: 3px;
    opacity: 1;
        margin-top: 100px;
    padding: 5px;
    width: 63%;
}
.doctor h3 {
    font-size: 40px;
    color: #191919;
    margin: 0px;
}
.doctor h5 {
    font-size: 20px;
    color: #FC1375;
    margin-top: 20px;
}
.short-cut p{
    display: flex;
    background-color: transparent;
    position: relative;
    margin: 0px;
	top: -19px;
    left: 10px;
	font-size:12px;
}
.view {
    display: flex;
    position: relative;
    top: -42px;
    left: 139px;
}
.view article {
    font-size: 12px;
    margin-left: 5px;
}
.social img{
	position: relative;
    top: -61px;
    left: 269px;
}
.feature{
	display: flex;
	background-color: #F1F2F6;
}
.feature h6{
	margin-left: 22px;
	text-transform: capitalize;
	font-size: 20px;
	color: #FC2E73;
}
.feature_star{
	margin-top: 14px;
}
.feature_indian{
	margin-top: 15px;
}
.discover p{
	color: #191919;
	font-size: 14px;
	font-family: urbane, sans-serif;
	font-weight: 500;
	margin-top: 40px;
	margin-bottom: 40px;
}
.sale img{
	margin-top: 40px;
}
.before_cmnt img{
	display: inline-block;
}
.after_cmnt p{
	margin: 0px;
    padding: 5px 40px;
    background: #FC1375;
    position: relative;
    top: -20px;
    color: #fff;
}
.before_cmnt p {
    background: #2C2C2C 0% 0% no-repeat padding-box;
    border-radius: 0px 0px 0px 0px;
    opacity: 1;
    font-size: 14px;
    color: white;
    margin: 0px;
    padding: 7px 34px;
    width: 100%;
    position: relative;
    top: -22px;
}
.comments{
	background-color:#F1F2F6;
	padding: 30px 45px;
	margin-bottom: 20px !important;
}
.comments article {
    font-size: 14px;
	font-family: urbane, sans-serif;
	font-weight: 300;
}
.comments h5 {
    font-size: 16px;
    margin: 0px;
    padding-top: 15px;
}
.discover h6{
	color: #FC1375;
	font-size: 20px;
	text-transform: capitalize;
}
.discover h3{
	color: #191919;
	font-size: 32px;
}
.discover button{
	background: transparent linear-gradient(180deg, #FEAC4F 0%, #FFAD4F 100%) 0% 0% no-repeat padding-box;
	box-shadow: 0px 3px 40px #0000004D;
	border-radius: 8px;
	opacity: 1;
	padding: 10px 25px;
}
.weight{
	background: #FFFFFF 0% 0% no-repeat padding-box;
	box-shadow: 0px 3px 6px #00000040;
	opacity: 1;
	padding: 40px;
	margin-top: 60px;
}
.weight1{
	padding: 40px;
	padding-top: 20px;
}
.discover h2{
	font-size: 32px;
    color: #191919;
    margin: 25px 0px;
}
.compare{
	background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000040;
    opacity: 1;
    padding: 20px;
}
.compare1{
	background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000040;
    opacity: 1;
    padding: 20px;
}
.compare h5, .compare1 h5{
	margin: 0px;
    padding-bottom: 20px;
	font-size: 20px;
}
.compare p, .compare1 p{
	margin-bottom: 10px;
}
.compare1 h5{
	margin: 0px;
    padding-bottom: 20px;
}
.compare, .compare1{
	color: #8A8A8A;
    font-size: 11px;
    margin: 0px;
}
.share img {
    position: relative;
    top: -10px;
	box-shadow: 0px 3px 6px #00000040;
}
.discover h1{
	font-size: 20px;
    color: #FC1375;
}
.discover ul li{

}
.discover ul li span{
	background: #BFBFBF 0% 0% no-repeat padding-box;
	opacity: 1;
}
.product{
    background: #F6F7F8 0% 0% no-repeat padding-box;
    opacity: 1;
    padding: 1px 35px;
}
.discover h1 {
    font-size: 20px;
    color: #FC1375;
    margin: 25px 0px;
}
.discover h5 {
    font-size: 20px;
}
.summary p {
    background: #FC1375 0% 0% no-repeat padding-box;
    border-radius: 12px;
    opacity: 1;
    margin: 0px;
    width: 11%;
    padding: 6px 10px;
    color: #fff;
}
.results{
	background: #F6F7F8 0% 0% no-repeat padding-box;
	opacity: 1;
    padding: 10px 30px;
}
.results h5{
	font-size: 20px;
    margin: 20px 0px;
}
.results h6 {
    color: #191919;
    font-size: 14px;
    margin: 15px 0px;
}
.update{
	background: #F6F7F8 0% 0% no-repeat padding-box;
	opacity: 1;
	margin-bottom: 85px;
}
.update p {
    font-weight: 600;
    font-size: 14px;
    padding: 20px 50px;
}
.cutting{
	border-top: 1px dashed #EA0066;
	opacity: 1;
}
.cutting p{
    position: relative;
    top: -50px;
    left: 220px;
    z-index: 999999;
    background: #fff;
    width: 33%;
}
.cutting img{
	position: relative;
    left: 700px;
    top: -127px;
}
.promo button {
    background: transparent linear-gradient(271deg, #FC9604 0%, #FC9604 1%, #FCBF04 100%) 0% 0% no-repeat padding-box;
    border-radius: 4px;
    opacity: 1;
    position: relative;
    top: 0;
    left: 173px;
    margin-bottom: 45px;;
}
.promo{
	background: #FFFFFF 0% 0% no-repeat padding-box;
	border: 1px dashed #EA0066;
	opacity: 1;
}
.promo img{
	margin-top: 40px;
}
.promo h4{
	font-size: 20px;
    text-align: center;
}
.feedback p{
	font-size: 12px;
	font-family: urbane, sans-serif;
	font-weight: 400;
}
.response h4{
	font-size: 14px;
	color: #191919;
	text-align: left;
	margin: 0px;
}
.response img{
    position: relative;
    left: 20px;
    top: 2px;
}
.response p{
	margin-top: 4px;
	font-size: 11px;
	margin-bottom:0px;
}
.response{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000029;
    border-radius: 5px;
    opacity: 1;
    padding: 20px 5px;
	margin-bottom:20px;
}

.pre-slider{margin-top: 60px;    margin-bottom: 55px;
}
.row.pre-slider-con {
    align-items: flex-end;
}

/* Responsive for Mobile sarath styles start here */
@media only screen and (min-width: 320px) and (max-width: 767px){
	.hidemob{display:none;}
	.options{margin-top: 1px;
    padding:5px 30px; margin-left:0; width:100%; padding-top:10px;}
	.options button{left:0; width:100%;}
	.feature {
		display: flex;
		background-color: #F1F2F6;
		max-height: 310px;
	}
	.feature h6 {
		text-align: left;
		text-transform: capitalize;
		font-size: 20px;
		color: #FC2E73;
		margin-left: 95px;
	}
	.feature_star {
		margin-top: 14px;
		position: relative;
		left: -25px;
	}
	.feature_ndtv img{
		position: relative;
		top: -105px;
		left: 138px;
	}
	.feature_indian {
		margin-top: 15px;
		position: relative;
		top: -218px;
	}
	.discover button {
		background: transparent linear-gradient(180deg, #FEAC4F 0%, #FFAD4F 100%) 0% 0% no-repeat padding-box;
		box-shadow: 0px 3px 40px #0000004D;
		border-radius: 8px;
		opacity: 1;
		padding: 10px 25px;
		position: relative;
		left: 94px;
	}
	.summary p {
		background: #FC1375 0% 0% no-repeat padding-box;
		border-radius: 12px;
		opacity: 1;
		margin: 0px;
		width: 25%;
		padding: 6px 10px;
		color: #fff;
	}
	.before_cmnt p {
		background: #2C2C2C 0% 0% no-repeat padding-box;
		border-radius: 0px 0px 0px 0px;
		opacity: 1;
		font-size: 14px;
		color: white;
		margin: 0px;
		padding: 7px 34px;
		position: relative;
		top: -22px;
		width: 45%;
	}
	.after_cmnt p {
		margin: 0px;
		padding: 5px 40px;
		background: #FC1375;
		position: relative;
		top: -265px;
		color: #fff;
		width: 45%;
		left: 152px;
	}
	.after_cmnt img{
		position: relative;
		top: -245px;
		left: 152px;
	}
	.comments article {
		font-size: 14px;
		font-family: urbane, sans-serif;
		font-weight: 300;
		position: relative;
		top: -240px;
	}

}
.pre-slider {
    margin-top: 60px;
    margin-bottom: 55px;
    background: #ccc;
    min-height: 330px;
	display: flex;
    align-items: center;
    justify-content: center;
}

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
	$my_query = new WP_Query('post_type=pre_landing_hindi');
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
	<div class="container-fluid">
		<div class="header">
			<div class="container">
				<div class="row">
					<h3 class="hidemob">विज्ञापनिका</h3>
					<div class="options">
						<div class="mail hidemob">
							
						</div>
						<div class="phone hidemob">
							<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/phone.svg" alt="Image">
							<p>080 46235223</p>
						</div>
						<button type="button" class="animate_button" onclick="window.location.href='<?php echo $external_link; ?>';" >अब आदेश दें</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="doctor">
			<div class="container">
				<div class="row pre-slider-con">
					<div class="col-md-5">
						<p><?php echo $mypost['main_title_title_1']['0'];?></p>
						<h3><?php echo $mypost['main_title_title_2']['0'];?></h3>
						<h5><?php echo $mypost ['main_title_title_3']['0'];?></h5>
						<?php /*<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/cal.svg" alt="Image">
						<div class="short-cut">
							<p>जनवरी 28,2020
						</div> */ ?>
						<div class="view">
							
							
						</div>
						<div class="social">
							
						</div>
					</div>
					<div class="col-md-7 pre-slider">
					<a>
					<?php echo do_shortcode( '[soliloquy slug="1004"]' ); ?>
					</a>
				</div>	
				</div>
				
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="container">
			<div class="feature">
				<div class="row">
					<div class="col-md-2">
						<h6><?php echo $mypost['feature_in_feature_title']['0'];?></h6>
					</div>
					<div class="col-md-2">
						<div class="feature_star">
							 <img src="<?php echo wp_get_attachment_image_url($mypost['feature_in_star']['0']); ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="feature_ndtv">
							 <img src="<?php echo wp_get_attachment_image_url($mypost['feature_in_ndtv']['0']); ?>">
						</div>
					</div>
					<div class="col-md-3">
						<div class="feature_ndtv">
							<img src="<?php echo wp_get_attachment_image_url($mypost['feature_in_zee']['0']); ?>">
						</div>
					</div>
					<div class="col-md-2">
						<div class="feature_indian">
							<img src="<?php echo wp_get_attachment_image_url($mypost['feature_in_indian']['0']); ?>">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="container">
			<div class="discover">
				<div class="row">
					<div class="col-md-8">
						<p><?php echo $mypost['descriptions_1']['0'];?></p>
						<img src="<?php echo wp_get_attachment_image_url($mypost['doctor_image']['0']); ?>">
						<p><?php echo $mypost['descriptions_2']['0'];?></p>
						<h3><?php echo $mypost['sub-title_1']['0'];?></h3>
						<p><?php echo nl2br($mypost['descriptions_3']['0']);?></p>
						<button type="button" onclick="window.location.href='<?php echo $external_link;?>';"> अब आदेश दें</button>
						<?php /*<div class="weight">
							<a href="<?php echo $external_link;?>"><img src="<?php echo wp_get_attachment_image_url($mypost['news_paper_image_1']['0']); ?>"></a>
							<div class="weight1">
								<a href="<?php echo $external_link;?>"><img src="<?php echo wp_get_attachment_image_url($mypost['news_paper_image_2']['0']); ?>"></a>
							</div>
						</div> */?>
						<h2><?php echo $mypost['sub-title_2']['0'];?></h2>
						<p><?php echo nl2br($mypost['descriptions_4']['0']);?></p>
						<?php /*<h4>Social Media Posts</h4>
						<div class="row">
							<div class="col-md-6">
								<div class="compare">
									<h5>Gautam Reddy</h5>
									<a href="<?php echo $external_link;?>"> <img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/before-after-22.png"></a>
									<p>I never watched what I ate. Then my doctor told me I was dangerously overweight, and on the verge of becoming diabetic. Thank heavens I found Masala Tea. lost all the extra weight and I feel amazing! (my doctor can’t believe it!)</p>
									<article>about 1 week ago . Delhi, India</article>
								</div>	
								<div class="share">
									<a href="<?php echo $external_link;?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Group 1466.png"></a>
								</div>
							</div>
							<div class="col-md-6">
								<div class="compare1">
									<h5>Gautam Reddy</h5>
									<a href="<?php echo $external_link;?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/slimnow-before-after-6.png"></a>
									<p>I’m so thankful my husband introduced me to Masala Tea. After our first child was born, I tried everything to lose the weight I gained during pregnancy. I almost gave up on myself, but with Masala Tea I lost 18kg! I’m even thinner before the baby!</p>
									<article>about 1 week ago . Delhi, India</article>
								</div>	
								<div class="share">
									<a href="<?php echo $external_link;?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Group 1466.png"></a>
								</div>
							</div>
						</div> */?>
						<h2><?php echo $mypost['sub-title_3']['0'];?></h2>
						<p><?php echo nl2br($mypost['descriptions_5']['0']);?></p>
						<div class="product">
							<h1><?php echo $mypost['sub-title_4']['0'];?></h1>
							<ul>
								<li><span></span><?php echo $mypost['lose_weight_method_1']['0'];?></li>
								<li><span></span><?php echo $mypost['lose_weight_method_2']['0'];?></li>
							</ul>
						</div>
						<p><?php echo nl2br($mypost['descriptions_6']['0']);?></p>
						<h2><?php echo $mypost['sub-title_5']['0'];?></h2>
						<div class="results">						
							<h5><?php echo $mypost['day_summary_title']['0'];?></h5>						
							<div class="summary">
								<p>दिन 7</p>
							</div>
							<p><?php echo nl2br($mypost['day_description_1']['0']);?></p>
							<div class="summary">
								<p>दिन 15</p>
							</div>
							<p><?php echo nl2br($mypost['day_description_2']['0']);?></p>
							<div class="summary">
								<p>दिन 30</p>
							</div>
							<p><?php echo nl2br($mypost['day_description_3']['0']);?></p>
							<?php /*<a href=<?php echo $external_link;?>><img src="<?php echo wp_get_attachment_image_url($mypost['day_image']['0']); ?>"></a>
							<h6><?php echo $mypost['image_descriptions']['0'];?></h6> */?>
						</div>
						<h2><?php echo $mypost['sub-title_6']['0'];?></h2>
						<p><?php echo nl2br($mypost['descriptions_7']['0']);?></p>
						<h2><?php echo $mypost['sub-title_7']['0'];?></h2>
						<p><?php echo nl2br($mypost['descriptions_8']['0']);?></p>
						<h2><?php echo $mypost['sub-title_8']['0'];?></h2>
						<p><?php echo nl2br($mypost['descriptions_9']['0']);?></p>
						<div class="update">
							<p><?php echo $mypost['update_article']['0'];?></p>
						</div>
						<div class="cutting">
							<p>हमारे पाठकों के लिए विशेष मुफ्त शिपिंग की पेशकश</p>
							<a href="<?php echo $external_link;?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/cutting-with-a-scissor-on-broken-line.svg"></a>
						</div>
						<div class="promo">
							<div class="row">
								<div class="col-md-3">
								</div>
								<div class="col-md-6">
									<a href="<?php echo $external_link;?>"><img src="<?php echo wp_get_attachment_image_url($mypost['product_image']['0']); ?>"></a>
								</div>
								<div class="col-md-3">
								</div>
							</div>
							<h4><?php echo $mypost['claim_title']['0'];?></h4>
							<div class="row">
								<div class="col-md-2">
								</div>
								<div class="col-md-7">
									<ul>
										<li><?php echo $mypost['advantage_adv_1']['0'];?> </li>
										<li><?php echo $mypost['advantage_adv_2']['0'];?> </li>
										<li><?php echo $mypost['advantage_adv_3']['0'];?> </li>
										<li><?php echo $mypost['advantage_adv_4']['0'];?> </li>
										<li><?php echo $mypost['advantage_adv_5']['0'];?> </li>
									</ul>
								</div>
								<div class="col-md-3">
								</div>
								<button type="button" onclick="window.location.href='<?php echo $external_link;?>';">मसाला टी का एक पैकेट पाने के लिए यहां क्लिक करें</button>
							</div>
						</div>
						<?php /*<div class="feedback">
							<p>Read Responses For: AIIMS Doctor Discovers Shockingly Simple Way To Lose 28kg in 30 Days Without Diet or Exercise. (20 out of 44)</p>
							<div class="response">
								<div class="row">
									<div class="col-md-1">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/in6.png">
									</div>
									<div class="col-md-11">
										<h4>Sunil</h4>
										<p>Guess what, I was that “fat kid” in school. I have used this for 4 months and have lost over 40 Kg. This stuff is awesome!!!</p>
									</div>
								</div>
							</div>
							<div class="response">
								<div class="row">
									<div class="col-md-1">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/in11.png">
									</div>
									<div class="col-md-11">
										<h4>Saanvi</h4>
										<p>Guess what, I was that “fat kid” in school. I have used this for 4 months and have lost over 40 Kg. This stuff is awesome!!!</p>
									</div>
								</div>
							</div>
							<div class="response">
								<div class="row">
									<div class="col-md-1">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/in3.png">
									</div>
									<div class="col-md-11">
										<h4>Roshini</h4>
										<p>Guess what, I was that “fat kid” in school. I have used this for 4 months and have lost over 40 Kg. This stuff is awesome!!!</p>
									</div>
								</div>
							</div>
							<div class="response">
								<div class="row">
									<div class="col-md-1">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/in3.png">
									</div>
									<div class="col-md-11">
										<h4>Roshini</h4>
										<p>Guess what, I was that “fat kid” in school. I have used this for 4 months and have lost over 40 Kg. This stuff is awesome!!!</p>
									</div>
								</div>
							</div>
							<div class="response">
								<div class="row">
									<div class="col-md-1">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/in4.png">
									</div>
									<div class="col-md-11">
										<h4>Sathvik</h4>
										<p>Guess what, I was that “fat kid” in school. I have used this for 4 months and have lost over 40 Kg. This stuff is awesome!!!</p>
									</div>
								</div>
							</div>
							<div class="response">
								<div class="row">
									<div class="col-md-1">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/in11.png">
									</div>
									<div class="col-md-11">
										<h4>Roshini</h4>
										<p>Guess what, I was that “fat kid” in school. I have used this for 4 months and have lost over 40 Kg. This stuff is awesome!!!</p>
									</div>
								</div>
							</div>
							<div class="response">
								<div class="row">
									<div class="col-md-1">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/in6.png">
									</div>
									<div class="col-md-11">
										<h4>Sunil</h4>
										<p>Guess what, I was that “fat kid” in school. I have used this for 4 months and have lost over 40 Kg. This stuff is awesome!!!</p>
									</div>
								</div>
							</div>
							<div class="response">
								<div class="row">
									<div class="col-md-1">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/in4.png">
									</div>
									<div class="col-md-11">
										<h4>Sathvik</h4>
										<p>Guess what, I was that “fat kid” in school. I have used this for 4 months and have lost over 40 Kg. This stuff is awesome!!!</p>
									</div>
								</div>
							</div>
							<div class="response">
								<div class="row">
									<div class="col-md-1">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/in3.png">
									</div>
									<div class="col-md-11">
										<h4>Roshini</h4>
										<p>Guess what, I was that “fat kid” in school. I have used this for 4 months and have lost over 40 Kg. This stuff is awesome!!!</p>
									</div>
								</div>
							</div>
							<div class="response">
								<div class="row">
									<div class="col-md-1">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/in11.png">
									</div>
									<div class="col-md-11">
										<h4>Lily</h4>
										<p>Guess what, I was that “fat kid” in school. I have used this for 4 months and have lost over 40 Kg. This stuff is awesome!!!</p>
									</div>
								</div>
							</div>
						</div> */?>
					</div>
					<div class="col-md-4">
						<div class="sale">
						<a href="<?php echo $external_link;?>">
							<img src="<?php echo wp_get_attachment_image_url($mypost['sale_image']['0']); ?>">
							</a>
						</div>
						<h6><?php echo $mypost['side_bar_title']['0'];?></h6>
						<div class="comments">
							<?php /*<div class="row">
								<div class="col-md-6">
									<div class="before_cmnt">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/feature_Mask Group 11.png">
										<p>पहले</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="after_cmnt">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Mask Group 10.png">
										<p><span>बाद में</span></p>
									</div>
								</div>
							</div> */?>
								<article>कुछ साल पहले, मैंने एक दोस्त से सुना था, जिसने इस तरकीब को आजमाया था। इससे मेरा जीवन पूरी तरह से बदल गया है। अब मैं शादीशुदा हूं और मेरा एक बेटा है। मैं खुराक रखरखाव के रूप में अच्छी तरह से जारी रखकर वजन बनाए रखने में सक्षम रहा हूँ। कृपया इसे अपने लिए करें।.</article>
								<h5>-आयशा अग्रवाल - दिल्ली </h5>
						</div>
						<div class="comments">
							<?php /*<div class="row">
								<div class="col-md-6">
									<div class="before_cmnt">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Mask Group 16.png">
										<p>पहले</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="after_cmnt">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Mask Group 15.png">
										<p>बाद में</p>
									</div>
								</div>
							</div> */ ?>
							<article>पिछले दिनों मेरे कुछ स्वास्थ्य मुद्दे थे, इसलिए वजन कम करने पर ध्यान केंद्रित करना मेरे लिए बहुत मुश्किल रहा है। मेरी बहन ने वास्तव में अपने अच्छे परिणाम रखने वाले दोस्त के आधार पर इस तरकीब को आजमाया है। मुझे खुशी थी कि उसने ऐसा किया। अब मैं 18 सप्ताह से मसाला टी उपयोग कर रहा हूँ और अब तक 24 किलो वजन घटा चुका हूं! मैं खुश हूं और मेरा परिवार मुझ से बहुत खुश है।</article>
							<h5>-कबीर पटेल - बेंगलुरु </h5>
						</div>
						<div class="comments">
							<?php /*<div class="row">
								<div class="col-md-6">
									<div class="before_cmnt">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Mask Group 18.png">
										<p>पहले</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="after_cmnt">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Mask Group 17.png">
										<p><span>बाद में</span></p>
									</div> 
								</div>
							</div> */?>
							<article>पिछले दिनों मेरे कुछ स्वास्थ्य मुद्दे थे, इसलिए वजन कम करने पर ध्यान केंद्रित करना मेरे लिए बहुत मुश्किल रहा है। मेरी बहन ने वास्तव में अपने अच्छे परिणाम रखने वाले दोस्त के आधार पर इस तरकीब को आजमाया है। मुझे खुशी थी कि उसने ऐसा किया। अब मैं 18 सप्ताह से मसाला टी उपयोग कर रहा हूँ और अब तक 24 किलो वजन घटा चुका हूं! मैं खुश हूं और मेरा परिवार मुझ से बहुत खुश है।</article>
							<h5>-नोयोनिका चटर्जी - मुंबई </h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	   
</main><!-- #site-content -->

<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>