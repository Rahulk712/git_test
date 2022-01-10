<?php


namespace OTP\Addons\WcSMSNotification;

use OTP\Addons\WcSMSNotification\Handler\WooCommerceNotifications;
use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Addons\WcSMSNotification\Helper\WooCommerceNotificationsList;
use OTP\Helper\AddOnList;
use OTP\Objects\AddOnInterface;
use OTP\Objects\BaseAddOn;
use OTP\Traits\Instance;
if (defined("\x41\102\123\120\x41\124\110")) {
    goto I5;
}
die;
I5:
include "\137\141\165\x74\x6f\x6c\157\141\x64\x2e\x70\150\x70";
final class WooCommerceSmsNotification extends BaseAddon implements AddOnInterface
{
    use Instance;
    public function __construct()
    {
        parent::__construct();
        add_action("\x61\144\155\151\156\x5f\x65\x6e\161\x75\145\165\x65\x5f\163\x63\162\151\160\164\163", array($this, "\155\157\x5f\163\x6d\163\137\156\x6f\164\x69\146\137\163\x65\164\164\x69\x6e\147\x73\137\163\x74\171\x6c\x65"));
        add_action("\x61\x64\x6d\151\x6e\137\145\x6e\161\165\x65\165\x65\137\x73\143\x72\151\x70\164\x73", array($this, "\x6d\157\x5f\163\x6d\x73\x5f\x6e\x6f\164\x69\146\137\163\x65\x74\164\151\156\x67\163\137\x73\143\x72\151\160\164"));
        add_action("\x6d\x6f\x5f\x6f\164\x70\x5f\166\x65\162\151\146\x69\x63\141\x74\x69\157\x6e\x5f\x64\145\x6c\145\164\145\137\x61\144\x64\157\x6e\x5f\157\x70\x74\151\157\156\163", array($this, "\x6d\157\x5f\x73\155\163\x5f\x6e\157\x74\151\x66\x5f\144\x65\x6c\145\x74\x65\x5f\x6f\160\x74\151\x6f\156\163"));
    }
    function mo_sms_notif_settings_style()
    {
        wp_enqueue_style("\x6d\157\137\163\155\x73\x5f\156\157\x74\151\146\137\141\144\155\x69\156\x5f\163\x65\x74\164\151\156\147\x73\137\x73\164\x79\154\145", MSN_CSS_URL);
    }
    function mo_sms_notif_settings_script()
    {
        wp_register_script("\x6d\x6f\x5f\163\155\163\137\156\157\x74\x69\x66\x5f\x61\x64\155\151\x6e\x5f\x73\145\164\164\x69\156\x67\163\x5f\x73\x63\162\x69\160\164", MSN_JS_URL, array("\152\x71\x75\145\162\171"));
        wp_localize_script("\155\x6f\137\163\x6d\163\x5f\156\x6f\164\x69\x66\x5f\141\144\x6d\x69\156\x5f\163\145\164\x74\151\156\x67\163\137\163\143\162\x69\160\164", "\155\157\x63\165\163\x74\157\x6d\x6d\x73\x67", array("\163\151\164\x65\125\122\114" => admin_url()));
        wp_enqueue_script("\155\157\137\x73\155\163\x5f\x6e\157\x74\x69\146\x5f\141\x64\155\151\x6e\x5f\163\145\x74\x74\151\156\147\163\x5f\x73\x63\162\x69\160\x74");
    }
    function initializeHandlers()
    {
        $rz = AddOnList::instance();
        $Sw = WooCommerceNotifications::instance();
        $rz->add($Sw->getAddOnKey(), $Sw);
    }
    function initializeHelpers()
    {
        MoWcAddOnMessages::instance();
        WooCommerceNotificationsList::instance();
    }
    function show_addon_settings_page()
    {
        include MSN_DIR . "\x2f\x63\x6f\x6e\164\x72\x6f\154\154\145\162\x73\x2f\155\141\151\156\x2d\143\x6f\156\x74\162\x6f\154\154\x65\x72\x2e\160\150\x70";
    }
    function mo_sms_notif_delete_options()
    {
        delete_site_option("\x6d\x6f\137\x77\x63\137\163\x6d\x73\137\x6e\x6f\164\x69\x66\151\143\x61\164\x69\x6f\x6e\137\163\145\164\164\151\156\x67\163");
    }
}
