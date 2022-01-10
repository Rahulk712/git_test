<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>
			<footer id="site-footer" role="contentinfo" class="header-footer-group">

				<div class="section-inner">

					<div class="footer-credits">

						<p class="footer-copyright">&copy;
							<?php
							echo date_i18n(
								/* translators: Copyright date format, see https://secure.php.net/date */
								_x( 'Y', 'copyright date format', 'twentytwenty' )
							);
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						</p><!-- .footer-copyright -->

					

					</div><!-- .footer-credits -->

					<a class="to-the-top" href="#site-header">
						<span class="to-the-top-long">
							<?php
							/* translators: %s: HTML character for up arrow */
							printf( __( 'To the top %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
							?>
						</span><!-- .to-the-top-long -->
						<span class="to-the-top-short">
							<?php
							/* translators: %s: HTML character for up arrow */
							printf( __( 'Up %s', 'twentytwenty' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
							?>
						</span><!-- .to-the-top-short -->
					</a><!-- .to-the-top -->

				</div><!-- .section-inner -->

			</footer><!-- #site-footer -->

		<?php wp_footer(); ?>
<!-- Mgid Sensor -->  
 <script type="text/javascript"> (function() { var d = document, w = window; w.MgSensorData = w.MgSensorData || []; w.MgSensorData.push({ cid:213608, lng:"us", nosafari:true, project: "a.mgid.com" }); var l = "a.mgid.com"; var n = d.getElementsByTagName("script")[0]; var s = d.createElement("script"); s.type = "text/javascript"; s.async = true; var dt = !Date.now?new Date().valueOf():Date.now(); s.src = "//" + l + "/mgsensor.js?d=" + dt; n.parentNode.insertBefore(s, n); })();  
 </script>  
 <!-- /Mgid Sensor --> 
<script>
		function add_to_cart(id){
			location.href="?add-to-cart="+id;
		}
		jQuery(document).ready(function(){
			jQuery('.no_risk').attr('onsubmit','return check_email_val()');
			jQuery("#bmi").click(function(){
				 location.href = "<?php echo get_site_url(); ?>/bmi/";
		  	});
			jQuery(".bmi_redirect").click(function(){
				 location.href = "<?php echo get_site_url(); ?>/bmi/";
		  	});
			jQuery("#rush_order").click(function(){
				 location.href = "<?php echo get_site_url(); ?>/order-now/";
		  	});
			jQuery('.um-register .um-form form h5').html('Subscription Form');
		});
		function check_email_val(){
			var emId = jQuery("#user_email-361").attr("value");
			if(emId!=''){
				jQuery.ajax({
					url : "<?php echo get_site_url(); ?>/EmailValidation.php",
		            type: "get",
		            dataType: 'json',
		            data: {email: emId},
		            async: false,
					success:function(result){
		            	if (result == 1) {
		            		jQuery('.um-field-user_email .um-field-error').remove();
			            	jQuery('#um-submit-btn').removeAttr('disabled');
			            	jQuery('.no_risk').removeAttr('onsubmit');
			            	jQuery('.no_risk').submit();
							return true;
						} else {
							jQuery('.um-field-user_email .um-field-error').remove();
							jQuery('.um-field-user_email .um-field-area').after('<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>You must provide valid email address</div>');
							jQuery('#um-submit-btn').removeAttr('disabled');
							return false;
		                }
					}
				});
				return false;
			}
		}
//////////////Zero bounce validation////////////////////////////////////////////-

jQuery(document).on('blur', "#user_email-361,#user_email-828,#user_email-1000", function () {
	jQuery(".um-field-error").remove();
	if(jQuery(".zeroBouncsStatus").length >0){
		jQuery(".zeroBouncsStatus").remove();
	}
	var emailStatus='';
	if(jQuery(this).val() !=''){
		checkEmail(jQuery(this).val(),jQuery(this).attr('id'));
	}	
});

function checkEmail(emailId,Flag=null)
{
	var responseStatus='';
	if(jQuery(".zeroBouncsStatus").length >0){
		jQuery(".zeroBouncsStatus").remove();
	}
	jQuery(".um-field-error").remove();
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(re.test(emailId)) {
    	jQuery.ajax({
			 url:"<?php echo get_site_url();?>/EmailValidation.php",
			 type: "get",
			 dataType: 'json',
			 data: {email: emailId},
			 async: false,
			 success:function(result){ 
				if (result == 1){
					responseStatus="zeroBouncsStatus emailSuccess";
				}else{
					responseStatus="zeroBouncsStatus emailFailed";
					jQuery("#"+Flag).parent().append('<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>This is not a valid email</div>');
					jQuery(".email-otp").append('<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>This is not a valid email</div>');
				}
				if(Flag != ''){
					jQuery("#"+Flag).parent().append('<div class="'+responseStatus+'"></div>');
					
				}else{
					jQuery(".email-otp").append('<div class="'+responseStatus+'"></div>');
				}
			 }
		 });
    }else{
		if(Flag != ''){
			jQuery("#"+Flag).parent().append('<div class="zeroBouncsStatus emailFailed"></div>');
			jQuery("#"+Flag).parent().append('<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>This is not a valid email</div>');
		}else{
			jQuery(".email-otp").parent().append('<div class="zeroBouncsStatus emailFailed"></div>');
			jQuery(".email-otp").append('<div class="um-field-error"><span class="um-field-arrow"><i class="um-faicon-caret-up"></i></span>This is not a valid email</div>');
		}
    }
}
</script>
     <!--  //////////////Zero bounce validation end for registration////////////////////////////////////////////-->
	</body>
</html>
