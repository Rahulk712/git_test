<?php
/*
Plugin Name: ZeroBounce
Plugin URI: http://www.wordpress.org/plugins/zerobounce
Description: ZeroBounce E-mail Validation Plugin
Version: 1.0.0 
Author: ZeroBounce
Author URI: https://www.zerobounce.net/
License: GPL2 or later
*/ 
if ( !function_exists( 'add_action' ) ) {
	echo 'Do not access the plugin files directly.';
	exit;
}
register_uninstall_hook( __FILE__, array( 'Zerobounce_Admin', 'zerobounce_plugin_uninstall' ) );
define( 'ZEROBOUNCE_VERSION', '1.0.0' );
define( 'ZEROBOUNCE__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
if ( is_admin() ) {
	require_once( ZEROBOUNCE__PLUGIN_DIR . 'class.zerobounce-admin.php' );
	add_action( 'init', array( 'Zerobounce_Admin', 'init' ) );
	require_once( ZEROBOUNCE__PLUGIN_DIR . 'class.zerobounce-single-page.php' );
	add_action(	'init', array( 'Zerobounce_App', 'init' ) );
}
?>