<?php
	class Zerobounce_Admin{
		private static $initialised = false;
		public static function init(){
			if ( ! self::$initialised ) {
				self::init_hooks();
			}
		}
		public static function init_hooks(){
			self::$initialised = true; 
			add_action( 'admin_menu', array('Zerobounce_Admin', 'zerobounce_add_menu_page' ));
			add_action(	'admin_init', array('Zerobounce_Admin', 'zerobounce_plugin_admin_init'));
			$options = get_option('zerobounce_plugin_options'); 
			$apiKey = $options['api_key'];	
			if(!empty($apiKey)){
				add_action( 'admin_footer',  array('Zerobounce_Admin','zerobounce_ajax_credits_hook') );
				add_action( 'wp_ajax_zerobounce_ajax_credits', array('Zerobounce_App', 'zerobounce_credits_function'));
			}
			add_action( 'admin_enqueue_scripts', array('Zerobounce_Admin','load_zerobounce_wp_admin_style') );			
		}
		public static function zerobounce_add_menu_page(){ 
			add_options_page('ZeroBounce Settings', 'ZeroBounce', 'manage_options', 'zero-bounce-settings', array('Zerobounce_Admin','zerobounce_add_settings_options')); 
		}
		public static function zerobounce_plugin_admin_init(){
			register_setting( 'zerobounce_plugin_options', 'zerobounce_plugin_options', array('Zerobounce_Admin','zerobounce_plugin_options_validate') );
			add_settings_section('zerobounce_plugin_main', 'API Settings', 'zerobounce_plugin_section_text', 'zero-bounce-settings');
			add_settings_field('zerobounce_plugin_api_key_field', 'API Key', array('Zerobounce_Admin','zerobounce_plugin_setting_string'), 'zero-bounce-settings', 'zerobounce_plugin_main');
		}
		public static function zerobounce_plugin_setting_string() {
			$options = get_option('zerobounce_plugin_options');
			echo "<input id='zerobounce_plugin_api_key_field' name='zerobounce_plugin_options[api_key]' size='40' type='password' value='".esc_attr($options['api_key'])."'/>";
		} 
		public static function zerobounce_plugin_options_validate($input) {
			$newinput['api_key'] = sanitize_text_field($input['api_key']); 
			return $newinput;
		}
		public static function zerobounce_add_settings_options(){
			?>
			<div>
				<h2 class="zerobounce_title">ZeroBounce - Plugin Options</h2> 
				<form action="options.php" method="post">
					<?php settings_fields('zerobounce_plugin_options'); ?>
					<?php do_settings_sections('zero-bounce-settings'); ?> 
					<input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
				</form>
				<p id="zerobounce_credits"></p> 
			</div> 
			<?php 
		} 		
 		public static function zerobounce_plugin_uninstall( ) {
			 delete_option( 'zerobounce_plugin_options' );
		}
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
							});
							return false;
						 });
				})(jQuery);	 
			</script>
		<?php
	}
		public static function load_zerobounce_wp_admin_style($hook) {  
	        if($hook != 'settings_page_zero-bounce-settings') { 
	                return;
	        }
	        wp_enqueue_style( 'zerobounce_wp_admin_css', plugins_url( 'css/zerobounce_admin.css', __FILE__ ) );
		}		  
	} 
?>