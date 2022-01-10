<?php
	class Zerobounce_App{
		private static $initialised = false;
		public static function init(){
			if ( ! self::$initialised ) {
				self::init_hooks();
			}
		}
		public static function init_hooks(){
			self::$initialised = true; 
			add_action( 'admin_menu', array('Zerobounce_App', 'zerobounce_add_menu_page' )); 
			add_action( 'admin_enqueue_scripts', array('Zerobounce_App','load_zerobounce_wp_app_style') );			
			add_action( 'admin_footer',  array('Zerobounce_App','zerobounce_ajax_submit_hook') );
			add_action( 'admin_footer',  array('Zerobounce_App','zerobounce_ajax_credits_hook') );
			add_action( 'wp_ajax_zerobounce_ajax_submit', array('Zerobounce_App', 'zerobounce_submit_function'));
			add_action( 'wp_ajax_zerobounce_ajax_credits', array('Zerobounce_App', 'zerobounce_credits_function'));
		}
		public static function zerobounce_add_menu_page(){ 
			add_menu_page('ZeroBounce', 'ZeroBounce', 'manage_options', 'zero-bounce-app', array('Zerobounce_App','zerobounce_app_page'), 'dashicons-shield'); 
		} 
		public static function zerobounce_app_page(){
			?>
			<div>
				<h2 class="zerobounce_title">ZeroBounce - E-mail Validation</h2>
				<p id="zerobounce_credits"></p> 
				<h3>Single address validation</h3> 
				<h4>Insert an e-mail address in the input below and we'll send the results your way!</h4>  
				<div class="row">
					<input id="zerobounce_email_field" name="zerobounce_email_field" type="email" class="form-control">
					<button type="button" id="zerobounce_submit_emails" class="button button-primary">Check Address</button>
				</div>
				<div class="zerobounce_result" id="zerobounce_result_error"></div>
				<div class="zerobounce_result" id="zerobounce_result"></div>
			</div> 
			<?php 
		} 
		public static function zerobounce_ajax_submit_hook() {
			  $submitNonce = wp_create_nonce( 'zerobounce-submit-nonce' );
			  $creditsNonce = wp_create_nonce( 'zerobounce-credits-nonce' );
			  ?>
			  <script>
			  	(function ($) {
					$(document).ready(function () {
						$('#zerobounce_submit_emails').click(function () {
							var email_text = $('#zerobounce_email_field').val();
							if(!email_text.trim()){
								$("#zerobounce_result_error").html("<p class='text-red'>Please enter an e-mail address in the field.<p>");
								$("#zerobounce_result").removeClass("zerobounce_boxed");
								$("#zerobounce_result").html("");
							}else{
								$("#zerobounce_result_error").html("");
								$("#zerobounce_result").removeClass("zerobounce_boxed");
								$("#zerobounce_result").html("Loading...");
								$.post(
										ajaxurl,
										{
									    	action: 'zerobounce_ajax_submit',
											emails: email_text,
											submitNonce: '<?php echo $submitNonce;?>'
										},
										function (response) { 
											$("#zerobounce_result").html(response.data);
											$("#zerobounce_result").addClass("zerobounce_boxed"); 
											$.post(
												ajaxurl,
												{ 
											    	action: 'zerobounce_ajax_credits', 
													creditsNonce: '<?php echo $creditsNonce;?>'
												},
												function (response) {
													$("#zerobounce_credits").html(response.credits);													
												}
											);
										}
								);
							} 
							return false;
						}); 
					});
				})(jQuery);	 
			  </script>
			<?php }
		public static function zerobounce_ajax_credits_hook() {
			  $creditsNonce = wp_create_nonce( 'zerobounce-credits-nonce' );
			  ?>
			  <script>
			  	(function ($) {
					$(document).ready(function () { 
							$.post(
									ajaxurl,
									{ 
								    	action: 'zerobounce_ajax_credits', 
										creditsNonce: '<?php echo $creditsNonce;?>'
									},
									function (response) {
										$("#zerobounce_credits").html(response.credits);
										if(response.message == "invalid"){
											$("#zerobounce_email_field").attr("disabled", "disabled");
											$("#zerobounce_submit_emails").attr("disabled", "disabled");
										}
									}
							);
							return false;
						 });
				})(jQuery);	 
			  </script>
		<?php }
		public static function zerobounce_submit_function() {  
			$nonce = $_POST['submitNonce'];
			if ( ! wp_verify_nonce( $nonce, 'zerobounce-submit-nonce' ) ) {
				die ( 'Denied' );
			}
			$emailToValidate = sanitize_email($_POST['emails']); 
			if(is_email($emailToValidate)){
				$options = get_option('zerobounce_plugin_options');			
				$apiKey = $options['api_key'];				
				$url = 'https://api.zerobounce.net/services.asmx/validate?apikey='.$apiKey.'&email='.urlencode($emailToValidate);  
				$response = wp_remote_get( esc_url_raw( $url ), array( "timeout"=>150 ) );
				$body = wp_remote_retrieve_body( $response );
				$json = json_decode($body, true);
				if(!empty($json)){ 
					$response = "<ul><h4>Here are your results:</h4>";
					foreach($json as $key=>$value){
						$key = ucfirst($key);
						if(is_null($value)){
							$response .= "<li><strong>".esc_html($key)."</strong>: - </li>";
						}elseif($key == 'Disposable' || $key == 'Toxic'){
							$class = ( $value ? "class='text-red'" :  "");
							$response .= "<li><strong>".esc_html($key)."</strong>: <span ".esc_html($class).">".esc_html(var_export($value, true))."</span></li>";
						}else{
							$class = ( $key == 'Status' && $value == 'Invalid' ? "class='text-red'" :  "" );
							$response .= "<li><strong>".esc_html($key)."</strong>: <span ".esc_html($class).">".esc_html($value)."</span></li>";
						}
					}
					$response .= "<ul>";	
					$response = json_encode(array("data"=>$response));
				}else{
					$response = json_encode(array("data"=>"<h4 class='text-red'>Something went wrong. No credits were used. Please try again.</h4>"));
				}  
			}else{
				$response = json_encode(array("data"=>"<h4 class='text-red'>Please enter an e-mail address in correct format. No credits were used.</h4>"));
			}  
			header( "Content-Type: application/json" );
			echo $response;	 
			exit;	 
		}
		public static function zerobounce_credits_function() {  
			$nonce = $_POST['creditsNonce'];
			if ( ! wp_verify_nonce( $nonce, 'zerobounce-credits-nonce' ) ) {
				die ( 'Denied' );
			}   
			$options = get_option('zerobounce_plugin_options');			
			$apiKey = $options['api_key'];				
			$url = "https://api.zerobounce.net/services.asmx/getcredits?apikey=".$apiKey; 			 
			$response = wp_remote_get( esc_url_raw( $url ), array( "timeout"=>150 ) );
			$body = wp_remote_retrieve_body( $response );
			$json = json_decode($body, true);
			if(!is_null($json['Credits'])){
				if($json['Credits'] == -1){
					$response = "<span class='text-red'>Invalid API Key. Please go to Settings->ZeroBounce and enter a valid key.</span>";
					$message = "invalid";
				}else{
					$response = "You have <strong>".esc_html($json['Credits'])."</strong> available e-mail validation(s).";
					$message = "ok";	
				}
			}else{
				$response = "<span class='text-red'>Credit information unavailable at this time.</span>";
				$message = "unavailable";
			}  
			$response = json_encode(array("credits"=>$response, "message"=>$message));  
			header( "Content-Type: application/json" );
			echo $response;	 
			exit; 
		}
		public static function load_zerobounce_wp_app_style($hook) {  
	        if($hook != 'toplevel_page_zero-bounce-app') {
	                return;
	        }
	        wp_enqueue_style( 'zerobounce_wp_app_css', plugins_url( 'css/zerobounce_app.css', __FILE__ ) );
		}
	}
?>