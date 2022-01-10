<?php


namespace OTP\Helper;

if (defined("\101\x42\x53\120\x41\x54\110")) {
    goto qi;
}
die;
qi:
use OTP\Objects\IGatewayFunctions;
use OTP\Objects\NotificationSettings;
use OTP\Traits\Instance;
class GatewayFunctions implements IGatewayFunctions
{
    use Instance;
    private $gateway;
    private $pluginTypeToClass = array("\115\151\156\x69\117\162\141\x6e\147\145\107\141\164\x65\167\141\x79" => "\x4f\124\120\x5c\x48\145\154\160\145\x72\134\x4d\151\x6e\x69\117\x72\x61\156\x67\145\107\141\x74\145\x77\141\x79", "\x43\x75\163\x74\157\155\x47\141\164\145\167\x61\171\127\x69\x74\x68\101\144\144\x6f\x6e\163" => "\117\124\120\134\110\145\x6c\x70\x65\x72\134\x43\165\163\x74\157\x6d\x47\x61\164\145\167\x61\171\x57\x69\164\x68\101\x64\144\157\156\x73", "\x43\x75\x73\164\x6f\x6d\107\141\x74\145\x77\x61\171\x57\x69\164\x68\x6f\x75\164\x41\144\x64\157\x6e\x73" => "\117\x54\x50\134\x48\x65\154\160\145\x72\x5c\103\165\x73\164\157\155\107\x61\164\x65\167\x61\x79\x57\x69\164\x68\157\165\164\x41\x64\x64\x6f\156\x73");
    public function __construct()
    {
        $jC = $this->pluginTypeToClass[MOV_TYPE];
        $this->gateway = $jC::instance();
    }
    public function isMG()
    {
        return $this->gateway->isMG();
    }
    public function loadAddons($Qf)
    {
        $this->gateway->loadAddons($Qf);
    }
    function registerAddOns()
    {
        $this->gateway->registerAddOns();
    }
    public function showAddOnList()
    {
        $this->gateway->showAddOnList();
    }
    function hourlySync()
    {
        $this->gateway->hourlySync();
    }
    public function custom_wp_mail_from_name($ni)
    {
        return $this->gateway->custom_wp_mail_from_name($ni);
    }
    public function flush_cache()
    {
        $this->gateway->flush_cache();
    }
    public function _vlk($post)
    {
        $this->gateway->_vlk($post);
    }
    public function _mo_configure_sms_template($A2)
    {
        $this->gateway->_mo_configure_sms_template($A2);
    }
    public function _mo_configure_email_template($A2)
    {
        $this->gateway->_mo_configure_email_template($A2);
    }
    public function mo_send_otp_token($Ft, $xX, $lr)
    {
        return $this->gateway->mo_send_otp_token($Ft, $xX, $lr);
    }
    public function mclv()
    {
        return $this->gateway->mclv();
    }
    public function showConfigurationPage($ke)
    {
        $this->gateway->showConfigurationPage($ke);
    }
    public function mo_validate_otp_token($Js, $Le)
    {
        return $this->gateway->mo_validate_otp_token($Js, $Le);
    }
    public function mo_send_notif(NotificationSettings $El)
    {
        return $this->gateway->mo_send_notif($El);
    }
    public function getApplicationName()
    {
        return $this->gateway->getApplicationName();
    }
    public function getConfigPagePointers()
    {
        return $this->gateway->getConfigPagePointers();
    }
}
