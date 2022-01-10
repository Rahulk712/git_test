<?php


namespace OTP\Objects;

interface IGatewayFunctions
{
    public function registerAddOns();
    public function showAddOnList();
    public function flush_cache();
    public function _vlk($post);
    public function hourlySync();
    public function mclv();
    public function isMG();
    public function getApplicationName();
    public function custom_wp_mail_from_name($ni);
    public function _mo_configure_sms_template($A2);
    public function _mo_configure_email_template($A2);
    public function showConfigurationPage($ke);
    public function mo_send_otp_token($Ft, $xX, $lr);
    public function mo_send_notif(NotificationSettings $El);
    public function mo_validate_otp_token($Js, $Le);
    public function getConfigPagePointers();
}
