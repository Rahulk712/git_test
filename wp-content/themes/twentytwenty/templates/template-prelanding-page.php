<?php
/**
 * Template Name: Pre Landing Page - Home Template
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
    left: 180px;
    z-index: 999999;
    background: #fff;
    width: 47%;
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
	<div class="container-fluid">
		<div class="header">
			<div class="container">
				<div class="row">
					<h3 class="hidemob">Advertorial</h3>
					<div class="options">
						<div class="mail hidemob">
							
						</div>
						<div class="phone hidemob">
							<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/phone.svg" alt="Image">
							<p>080 46235223</p>
						</div>
						<button type="button" class="animate_button" onclick="window.location.href='<?php echo $external_link; ?>';" >Order Now</button>
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
						<p>The first all-natural weight loss solution!</p>
						<h3>AIIMS Doctor Discovers Shockingly Simple Way To</h3>
						<h5>Lose Weight Without Diet or Exercise</h5>
						<?php /*<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/cal.svg" alt="Image">
						<div class="short-cut">
							<p>January 28,2020
						</div> */?>
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
						<h6>Featured in</h6>
					</div>
					<div class="col-md-2">
						<div class="feature_star">
							<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/feature_star.png">
						</div>
					</div>
					<div class="col-md-3">
						<div class="feature_ndtv">
							<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/feature_ndtv.png">
						</div>
					</div>
					<div class="col-md-3">
						<div class="feature_ndtv">
							<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/feature_zee.png">
						</div>
					</div>
					<div class="col-md-2">
						<div class="feature_indian">
							<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/feature_indian.png">
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
						<p>We have been getting hundreds of emails from our readers who are losing 1kg per day using this weird new trick. At first we didn’t  believe it and decided to ignore it like every other magical weight loss trick out there, but the results were so truly shocking we decided to investigate! Many of our readers have lost 28kg in as little as 30 days, without dieting, exercise, expensive surgery or cutting out their favorite foods! Health Reports decided to track down the man who invented this revolutionary solution and learn his story.</p>
						<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/doctor.png">
						<p>Renowned bio-medicine doctor Siddharth Kumail is credited with creating this trick and exposing the HUGE lie the weight loss industry has been trying to hide for years. Dr. Kumail stumbled upon this revolutionary weight loss solution while working at AIIMS New Delhi's prestigious Research Department, and pharmaceutical companies are desperately trying to get this simple remedy banned. Before this trick is dragged through the court system, read on now to find out how you can naturally lose weight without diet, exercise, expensive or painful surgery!</p>
						<h3>Dr. Kumail’s  Shocking Discovery...</h3>
						<p>It seemed like just another day at AIIMS when my life completely changed. I was in between teaching bioengineering classes and doing my rotations at the AIIMS Teaching Hospital when I got a call from my mother. She knew I was working so she wouldn’t have called unless it was really important. When I saw her name on my cell phone I was instantly nervous and took the call.</P> <p>What she told me next completely destroyed me. My younger brother Kapil, who was just 33, suffered a major heart attack and was being driven in an ambulance to the very hospital I worked in.</p> <p> I excused myself from my class and rushed downstairs. Emotions were rushing through my mind. Would my brother be okay? How bad was the heart attack? Would he need surgery? I knew I  couldn’t  operate on my own brother. I was too emotional to go through with the surgery. I started mentally listing which of my colleagues could perform the operation in my place, but what happened next was even worse than I imagined. As soon as they brought Kapil into the emergency room, I saw him on the stretcher and I froze. He wasn't breathing.</p> <p>We rushed him into a private room and I desperately tried reviving him for 10 minutes which felt like eternity. I only gave up after the nurse pulled me off him and softly  said, “It’s over.”</p> <p>I was completely heartbroken. My brother was dead at the age of 33.</p> <p>I never got over the feelings I felt that day. My whole world came crashing down in front of me. I felt as if all my education had gone to waste. If I could not save my own younger brother, what was the point of being a doctor? My mother was in a state of shock when I gave her the news. It took weeks for her to accept that he was really gone.</p> <p>In fact, she refused to talk to me. She thought I could have saved him but in my heart I knew there was nothing I could have done.</p> <p>While my brother’s death was a horrible shock, it wasn’t a mystery. The main reason for Kapil’s death was obesity. He had a clogged artery and all he needed was a simple stent to save his life. At first all I could think was that we were 8 minutes too late. If he had come in 8 minutes earlier I could have saved him. But in reality, we were years late. If only Kapil had taken his obesity seriously. If only we realized how unhealthy we was because of his extreme weight. Afterall, I've had 100's of patients die in my arms because of complications of obesity like heart attack, stroke and cancer.</p> <p>After that day, I could not go back to being a surgeon. Whenever I tried I could not keep my hands from shaking. Every time I looked at a body on the operating table I saw my brother Kapil. I knew I was not psychologically fit to perform surgery. However, I knew I had to do something about obesity and find a solution and save the countless people who die everyday because of their extreme weight.</p> <p>I decided to quit practicing medicine and become a full time professor and research scholar at AIIMS. I dedicated myself to studying the impact of different natural extracts on the production of fat cells. My goal was to find an easier way for obese men and women to save their own lives. Millions of people all over the world struggle with their weight, but most diets are too hard to follow. In addition, most weight loss programmes being promoted by spa-clinics cost Rs. 40,000-50,000, and despite the high cost, the results are painfully disappointing. They only get rid of water weight, and you gain the weight back in under a month.That is why losing weight often feels like an impossible challenge.</p> <p>After Kapil’s funeral, I went straight to my lab at AIIMS. I promised myself I would use my expert knowledge of biology to find a solution to obesity, and prevent any more pointless deaths. Every day I got into the lab at 6am and before I did anything I looked at a picture of my brother, and remembered why I was there.</p> <p>My experiment focused on the most stubborn abnormal fat on the belly, buttocks and in the waist area. I knew that years of weight gain results in a slow metabolism, making it difficult for people to burn fat effectively. I wanted to create an organic solution that targeted this tough fat while accelerating the body’s metabolism at the same time.</p> <p>I launched experiment after experiment, dissolving, filtering, precipitating, crystallising and recrystallising fat cells, trying to solve this mystery. The work was heavy and physically demanding. I would spend all day researching experimental weight loss techniques, and all night testing them in the lab. My only motivation was that picture of my brother. It reminded me what was at stake.</p> <p>Two years into my experiment, I still had no concrete solution to obesity and I began to feel hopeless. My colleagues began to doubt my abilities, and I was worried that unless I found a solution millions more would die like my brother did. I tested hundreds of unusual tonics, fungal strains and herbs from all over the world only to have zero results. I just had one last fruit to test, and then I planned to give up completely and move on to an easier field of study.</p> <p>That final fruit was a delicious African berry from deep in the Congo. In medical school, I took a class on ancient medicines, and I recalled my professor telling me how this one specific African tribe would ritually eat these fruits to raise their metabolism before they went out hunting so that they had higher agility and energy.</p> <p>The tribe was known for its hunting skills and had survived for centuries without being threatened by another tribe. I knew for a tribe to survive this long they probably had some ace up their sleeves. My colleagues thought I was crazy when I mentioned this final experiment. “You’re actually trying to cure obesity with  magic fruit?” They all laughed, “You’re living in a fantasy!”</p> <p>When the shipment of the rare fruit arrived, I was nervous but I knew I had nothing to lose. I dried the fruit using my oven, crushed it and then mixed it with a saline solution. I poured this saline solution on fat tissue we had grown in the lab and went home hoping for the best.</p> <p>The next morning I walked into the lab half prepared to be disappointed. However, I was shocked to see more than half the fat had literally melted away. I couldn’t believe my eyes. This simple fruit had literally melted the same type of fat once considered impossible to lose! In all my years of research and medicine I'd never seen something like this. On a chemical level the fruit had accelerated the breakdown of fat into energy and boosted the metabolism of the cells in the fat tissue which is why the tribal men going for hunting were so full of energy. Their fat was being converted into energy almost instantly!</p> <p>I began to jump for joy. This was the solution I had been looking for! I knew if I went to the university to run human trials it will take me months to get permission but I didn’t want to wait so long so I decided to be the guinea pig and test it on myself.</p> <p>I knew I had no time to lose so I started eating a spoonful of the extract daily and recorded my results.</p> <p>After one week, I was totally shocked. My energy levels were up, and I wasn't even hungry. I got on the scale and couldn't believe my eyes. I had lost 5.7 Kg. I was impressed but still not convinced. Afterall, I could just be losing water weight as you do at the beginning of any diet. I continued taking the fruit extract and every day I woke up with even more energy. I was also sleeping more soundly than ever before. I was no longer waking up during the night and tossing and turning because my body was actually able to relax (I suspect this is a result of getting rid of toxins). After another week passed I managed to lose an additional 6.3 Kg, putting me at an unbelievable 4 Kg of weight loss, in just 2 weeks.</p> <p>Once I found out my solution really worked I knew I had to bring it to the world. Over the next few months I perfected my organic fruit extract blend and converted it into a easy-to-swallow capsule. Then, I collaborated with MIT scientist Peter Molnar to prove once and for all that my weight loss solution really worked. In a clinical trial we conducted with 1200 patients from around the world, 97% of patients lost at least 15kg in as little as 30 Days. The men and women who participated in the trial were equally shocked by their results. They were healthier, more confident and more attractive to the opposite sex. (Some of their families didn’t even recognize them!)</p> <p>I felt vindicated and successful, but I wasn’t satisfied until I made things right with my mother. It had been 3 years since Kapil died, and we still hadn’t spoke. I called her and after she hung up on me several times, I finally got her to come to my lab. I showed her the data from my experiment and even introduced her to my newly-thin patients. She didn’t speak, so at first I thought she was angry. I started to apologize, when she wrapped me in a big hug. I heard her cry into my shoulder and she squeezed me tighter. When she let go, she took a great sigh of relief. “I’m so proud of you,” she said. “I really hope no other mother like me has to lose their sons to obesity.” I started to cry too. It was the best moment of my life.</p> <p>Since then, my weight loss solution has only gotten more popular. Major Hollywood and Bollywood celebrities have lost a significant amount of body fat using my formula and I receive letters every day from people all over the world thanking me for saving their lives. My solution is the only all-natural, affordable solution that’s guaranteed to make you lose weight. It’s even been featured in several highly regarded medical journals and national publications.</p>
						<button type="button" onclick="window.location.href='<?php echo $external_link;?>';"> Order Now</button>
						<?php /*<div class="weight">
							<a href="<?php echo $external_link;?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/NewspaperHeadlinesRipped2.png"></a>
							<div class="weight1">
								<a href="<?php echo $external_link;?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/NewspaperHeadlinesRipped2.png"></a>
							</div>
						</div> */?>
						<h2>How Does This Trick Eliminate Fat?</h2>
						<p>While this might sound odd and unbelievable, let me explain how this miracle cure works.</p> <p>By combining this magic fruit with a natural antioxidant, Wild Masala Tea FOR SHAPE, this amazing solution increases your metabolism, cleanses your body, increases energy tenfold and literally melts stubborn fat overnight. Together, these natural agents rid you of harmful toxins and allow your body to burn calories more efficiently for the long term. Flushing your body clean of toxins and kickstarting your metabolism allows for a “perfect storm” of natural synergy and the fat simply melts away!</p> <p>Multiple studies have proven that overweight men and women have trouble finding well-paying jobs and attracting the opposite sex. They experience higher rates of depression, social anxiety and a lack of self confidence. Put simply: being overweight can negatively impact every aspect of your life.</p> <p>But don’t worry: the first step in reversing years of weight gain is kick-starting your slow metabolism, and that’s exactly how my Weight Loss Solution works its cellular magic! With a precise calibration of nutrients, it accelerates your metabolism at the cellular level, and reverses years of fat storage-so you can get thinner and stay that way!</p> <p>That means reversing years of weight gain- permanently!</p> <p>Determined to bring this solution to everyone who has felt the mental pain of obesity, I extracted the essence of that magic fruit, condensed it into a pill and came up with Masala Tea. I know I did the right thing, helping millions of men and women find a natural cure to being overweight, but I was unaware of how angry this would make greedy doctors, hospitals and pharmaceutical companies. There’s no doubt my all natural weight loss trick is better than their expensive and harmful treatments, but isn’t stopping them from trying to shut us down. Masala Tea is a protest of everything the medical industry stands for. It’s the cheaper, all-natural alternative to liposuction or toxic weight loss supplements.</p> <p>The secret is natural synergy. In addition to that obscure African fruit, Masala Tea contains Wild Masala Tea FOR SHAPE which is proven to encourage weight loss and increase your energy tenfold. Together, these two natural cleansing agents rid your body of toxins and allow you to work and burn calories more efficiently for the long term. Utilizing the best natural ingredients and the best scientific methodology, Masala Tea is scientifically proven to target and eliminate fat cells. That means you lose weight quickly, easily and permanently. Guaranteed.</p> <p>It’s a fact: Masala Tea was chemically engineered to help men and women lose weight and live fuller, happier lives.</p>
						<!-- <h4>Social Media Posts</h4>
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
						</div>!-->
						<h2>Putting Masala Tea To The Test...</h2>
						<p>We wanted to find out for ourselves if this product could actually do everything that it claimed. Most of the success stories talk about Masala Tea's effectiveness, how patients can lose 6kg in as little as 30 days. They also mention how Masala Tea's precise calibration of nutrients reverses years of fat storage and improves your metabolism, effectively improving your overall health.</p> <p>This product is backed by a 100% satisfaction guarantee.</P>
						<div class="product">
							<h1>Here's how to use the product in order to lose weight:</h1>
							<ul>
								<li><span></span>Take per Cup of Masala Tea For Shape every morning before breakfast and every night before dinner.</li>
								<li><span></span>Then, simply watch the Kgs melt away!</li>
							</ul>
						</div>
						<p>Some of us were still skeptical¦ until our own reporter tried it.</p> <p>After hearing so much talk about Masala Tea's amazing results we at LifeStyle Hub decided to put it to the test. Reporter Rohan Kapoor volunteered to be the guinea pig for this experiment because he had been suffering from unrestricted weight gain for more than 10 years now. He dreamed of not being nervous around women and not worrying about how we looked in a bathing suit. In order to try Masala Tea, he ordered the product online. He chose Masala Tea on the basis that it had been clinically tested and approved at GNP Labs in Los Angeles, California - an organization renowned for their strict guidelines on supplements.</p> <p>" Masala Tea was extremely hard to come by" says Rohan. "If you can get your hands on this pill - get it right away. I had to wait 2 weeks before I got to test as it was sold out almost everywhere. People are desperately trying to stock it constantly so it's almost always sold out."</p> <p>Rohan added, "The discounted pack of Masala Tea was delivered in a few days after ordering and shipping was free, which was a nice bonus.”  (But keep reading-there is now actually a risk-free trial offer that wasn't previously available).</p>
						<h2>Check out Rohan’s amazing results¦</h2>
						<div class="results">						
							<h5>30 Day Summary - Rohan’s Masala Tea Results:</h5>						
							<div class="summary">
								<p>Day 7</p>
							</div>
							<p>After one week of using Masala Tea I was surprised at the dramatic results. My energy levels were up, and I wasn't even hungry.</p> <p>I honestly felt fantastic!</p> <p>Best of all, I didn't even change anything about my daily routine. I went about my day as I normally did, eating what I normally ate. On Day 7, I got on the weighing scale and couldn't believe my eyes. I had lost 5kg. But I still wasn't convinced. I wanted to wait and see the results in the upcoming weeks.</p>
							<div class="summary">
								<p>Day 15</p>
							</div>
							<p>I started the week off with even more energy, and actually sleeping more soundly than before. I was no longer waking up during the night and tossing and turning because my body was actually able to relax. My knees and ankles stopped aching at the end of every day. Plus I still managed to lose another 8kg, putting me at an unbelievable 13kg of weight loss, in just 2 weeks. I hadn’t exercised or dieted at all, and I was the thinnest I’ve been in years!</p>
							<div class="summary">
								<p>Day 30</p>
							</div>
							<p>After finishing my 30 trial of Masala Tea, all my doubts and skepticism had absolutely vanished! I am down 2 full pant sizes after losing another 6kg. And I still have a ton of energy. Quite often, around the third week of other diets, you tend to run out of steam. But with Masala Tea my energy levels didn't dip, instead they remain steady throughout the day. In total I lost 19kg and I am definitely going to continue taking Masala Tea. I feel healthy, I look great and I wake up every day with a new sense of energy and purpose. I was skeptical at first, but I’m totally convinced. Masala Tea really works! I couldn't be any happier with the results.</p>
							<?php /*<a href=<?php echo $external_link;?>><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/slimnow-before-after-22.png"></a> 
							<h6>Look how great Rohan looks after only 1 month of Masala Tea!</h6> */?>
						</div>
						<h2>My thoughts on Masala Tea?</h2>
						<p>Masala Tea is the real deal. I’ve tried so many other so called "weight loss supplements" but this is by far the only thing on the market that will actually change your metabolism and eliminate fat at the source. I hear very few people can get a hold of it. If you happen to come across Masala Tea, either continue with your current life (without enjoying the benefits of having a body everyone admires) or you can spare 2 minutes and take what is the most important step to becoming the confident, self-assured person you want to be.</p>
						<h2>Proving to the world it works:</h2>
						<p>Masala Tea customers are unanimous, without all that extra weight they look years younger and feel much better about their overall appearance.</p> <p>Dr. Kumail admits it's going to be a tough fight with the medical community and the pharmaceutical industry which is trying to get it banned, but it's imperative that the millions of overweight Indians suffering from low self-confidence and exhaustion be given the chance to lose weight naturally.</p> <p>After several years and multiple clinical trials at AIIMS, Masala Tea is in production in full force. You can and will lose weight with Masala Tea. You will become the good-looking, healthy, and true version of yourself. It's only a matter of time before Masala Tea is dragged through the courts by the major pharmaceutical companies and expensive spa-clinics that are seeing a decline in their profits. There are quite a few celebrities who use Masala Tea to lose weight, all while living a life of perfect social and professional balance.**Because of recent coverage in the media, supplies are running very low. You can check to see if Masala Tea is still available here** Masala Tea was recently given honorary mention in INDIA TODAY printed and online magazine editions as being the pill that can 'shrink your waist and turn your life around'</p>
						<h2>Special Offer For Our Readers:</h2>
						<p>The result of several years of painstaking clinical research, Masala Tea is being tightly controlled in its distribution. But for a limited time, the makers of Masala Tea are offering our readers an incredible 60% discount! They believe that readers like you, those able to find Masala Tea despite limited advertising, are the sort of influential insiders they need to reach out to. So, to you and others like you, they are offering a limited-time, introductory price. All they ask is that, after you use Masala Tea and spread the word and tell others about your amazing results! So, get in on this great deal soon! But realize, this offer allows for only one pack per customer. So, hurry, join the others who have tried-and loved Masala Tea-before the stock runs out!</p>
						<?php /*<div class="update">
							<p>Update: Risk Free Trials Still Available. This Promotion Ends Monday, December 30, 2019</p>
						</div> */ ?>
						<div class="cutting">
							<p>SPECIAL FREE SHIPPING OFFER FOR OUR READERS</p>
							<a href="<?php echo $external_link;?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/cutting-with-a-scissor-on-broken-line.svg"></a>
						</div>
						<div class="promo">
							<div class="row">
								<div class="col-md-3">
								</div>
								<div class="col-md-6">
									<a href="<?php echo $external_link;?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/masala.png"></a>
								</div>
								<div class="col-md-3">
								</div>
							</div>
							<h4>Use our Exclusive Promo Link to claim your pack.</h4>
							<div class="row">
								<div class="col-md-2">
								</div>
								<div class="col-md-7">
									<ul>
										<li>100% Pure Masala Tea FOR SHAPE </li>
										<li>100% Natural, Herbal </li>
										<li>All-Natural Appetite Suppressor </li>
										<li>Formulated in INDIA - FSSAI/GMP Certified Laboratory </li>
										<li>Comes With a 100% Satisfaction Guarantee!</li>
									</ul>
								</div>
								<div class="col-md-3">
								</div>
								<button type="button" onclick="window.location.href='<?php echo $external_link;?>';">Click here to get a pack of masala tea</button>
							</div>
						</div>
						<div class="feedback" style="display:none">
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
						</div>
					</div>
					<div class="col-md-4">
						<div class="sale">
						<a href="<?php echo $external_link;?>">
							<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Image 8.png">
							</a>
						</div>
						<h6>What others are saying</h6>
						<div class="comments">
							<?php /* <div class="row">
								<div class="col-md-6">
									<div class="before_cmnt">
									<a href="<?php echo $external_link;?>">
										<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/feature_Mask Group 11.png">
										</a>
										<p>Before</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="after_cmnt">
										<a href="<?php echo $external_link;?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Mask Group 10.png"></a>
										<p><span>After</span></p>
									</div>
								</div>
							</div> */?>
								<article>A couple of years ago, I listened to a friend who tried this trick. It has changed my life completely. I am now married with a son. I have been able to keep the weight off by continuing a maintenance dose as well. Please do this for yourself.</article>
								<h5>-Aisha Agarwal - Delhi </h5>
						</div>
						<div class="comments">
							<?php /*<div class="row">
								<div class="col-md-6">
									<div class="before_cmnt">
										<a href="<?php echo $external_link;?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Mask Group 16.png"></a>
										<p>Before</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="after_cmnt">
										<a href="<?php echo $external_link;?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Mask Group 15.png"></a>
										<p>After</p>
									</div>
								</div>
							</div> */?>
							<article>I had some health issues in the past, so it has been very difficult for me to focus on losing weight. My sister actually tried this trick based on a friend of her having good results. I was happy she did. I have now been on Masala Tea for 18 weeks and so far have lost 24 Kg! I am delighted and my family is very happy for me.</article>
							<h5>-Kabir Patel - Bengalaru </h5>
						</div>
						<div class="comments">
							<?php /*<div class="row">
								<div class="col-md-6">
									<div class="before_cmnt">
										<a href="<?php echo $external_link;?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Mask Group 18.png"></a>
										<p>Before</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="after_cmnt">
										<a href="<?php echo $external_link;?>">	<img src="<?php echo get_site_url(); ?>/wp-content/themes/twentytwenty/assets/images/Mask Group 17.png"></a>
										<p><span>After</span></p>
									</div> 
								</div>
							</div> */ ?>
							<article>I had some health issues in the past, so it has been very difficult for me to focus on losing weight. My sister actually tried this trick based on a friend of her having good results. I was happy she did. I have now been on Masala Tea for 18 weeks and so far have lost 24 Kg! I am delighted and my family is very happy for me.</article>
							<h5>-Noyonika Chatterjee - Mumbai </h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	   
</main><!-- #site-content -->

<?php //get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
