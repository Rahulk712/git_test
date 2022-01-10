<?php
/**
 * Plugin Name: Email Verification / SMS verification / Mobile Verification
 * Plugin URI: http://miniorange.com
 * Description: Email & SMS OTP verification for all forms. Passwordless Login. SMS Notifications. Support for External Gateway Providers. Enterprise grade. Active Support
 * Version: 3.4.2
 * Author: miniOrange
 * Author URI: http://miniorange.com
 * Text Domain: miniorange-otp-verification
 * Domain Path: /lang
 * WC requires at least: 2.0.0
 * WC tested up to: 3.7
 * License: miniOrange
 */


use OTP\MoOTP;
if (defined("\101\102\123\120\x41\x54\110")) {
    goto F0;
}
die;
F0:
define("\x4d\117\x56\x5f\120\x4c\x55\x47\111\x4e\x5f\x4e\101\115\x45", plugin_basename(__FILE__));
$gv = substr(MOV_PLUGIN_NAME, 0, strpos(MOV_PLUGIN_NAME, "\57"));
define("\115\117\x56\137\116\101\115\105", $gv);
include "\x5f\141\165\x74\157\x6c\157\x61\x64\56\x70\x68\160";
MoOTP::instance();
