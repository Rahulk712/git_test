<?php


namespace OTP\Addons\UmSMSNotification;

use OTP\Addons\UmSMSNotification\Handler\UltimateMemberSMSNotificationsHandler;
use OTP\Addons\UmSMSNotification\Helper\UltimateMemberNotificationsList;
use OTP\Addons\UmSMSNotification\Helper\UltimateMemberSMSNotificationMessages;
use OTP\Helper\AddOnList;
use OTP\Objects\AddOnInterface;
use OTP\Objects\BaseAddOn;
use OTP\Traits\Instance;
if (defined("\101\x42\123\120\x41\124\x48")) {
    goto hd;
}
die;
hd:
include "\x5f\x61\x75\x74\x6f\154\x6f\x61\x64\56\x70\x68\x70";
final class UltimateMemberSmsNotification extends BaseAddon implements AddOnInterface
{
    use Instance;
    public function __construct()
    {
        parent::__construct();
        add_action("\141\x64\x6d\x69\156\137\x65\156\x71\x75\145\x75\145\137\x73\143\x72\151\x70\164\x73", array($this, "\x75\x6d\137\163\155\x73\x5f\156\157\164\x69\146\x5f\163\x65\164\x74\151\156\x67\x73\137\163\164\171\x6c\x65"));
        add_action("\x6d\157\x5f\x6f\x74\160\x5f\x76\145\162\151\146\x69\x63\x61\x74\x69\157\x6e\137\x64\x65\154\145\164\145\137\141\x64\144\157\156\x5f\157\160\x74\151\x6f\156\163", array($this, "\165\x6d\x5f\163\155\163\137\x6e\157\164\x69\x66\x5f\x64\145\154\x65\164\x65\x5f\x6f\x70\164\x69\157\156\163"));
    }
    function um_sms_notif_settings_style()
    {
        wp_enqueue_style("\165\x6d\137\x73\x6d\x73\137\156\x6f\164\151\x66\x5f\x61\x64\x6d\151\x6e\x5f\163\x65\164\164\151\156\x67\x73\137\x73\x74\171\154\x65", UMSN_CSS_URL);
    }
    function initializeHandlers()
    {
        $rz = AddOnList::instance();
        $Sw = UltimateMemberSMSNotificationsHandler::instance();
        $rz->add($Sw->getAddOnKey(), $Sw);
    }
    function initializeHelpers()
    {
        UltimateMemberSMSNotificationMessages::instance();
        UltimateMemberNotificationsList::instance();
    }
    function show_addon_settings_page()
    {
        include UMSN_DIR . "\57\x63\157\x6e\164\x72\x6f\154\x6c\x65\162\163\57\155\141\x69\156\x2d\143\157\156\164\162\x6f\x6c\x6c\145\162\x2e\x70\x68\x70";
    }
    function um_sms_notif_delete_options()
    {
        delete_site_option("\x6d\x6f\x5f\x75\155\137\x73\155\163\x5f\x6e\157\164\151\x66\x69\x63\141\x74\151\157\x6e\x5f\x73\145\164\x74\x69\156\147\x73");
    }
}
