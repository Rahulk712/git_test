<?php


namespace OTP\Addons\UmSMSNotification\Handler;

use OTP\Addons\UmSMSNotification\Helper\UltimateMemberNotificationsList;
use OTP\Objects\BaseAddOnHandler;
use OTP\Traits\Instance;
class UltimateMemberSMSNotificationsHandler extends BaseAddOnHandler
{
    use Instance;
    private $notificationSettings;
    function __construct()
    {
        parent::__construct();
        if ($this->moAddOnV()) {
            goto CP;
        }
        return;
        CP:
        $this->notificationSettings = get_umsn_option("\x6e\x6f\x74\151\x66\x69\x63\x61\x74\151\x6f\156\137\x73\145\x74\164\x69\156\x67\x73") ? get_umsn_option("\x6e\x6f\164\151\146\x69\143\141\x74\x69\x6f\x6e\x5f\163\145\x74\164\151\x6e\147\163") : UltimateMemberNotificationsList::instance();
        add_action("\165\155\x5f\162\145\147\151\x73\x74\x72\x61\x74\x69\157\156\x5f\143\157\155\x70\154\145\x74\x65", array($this, "\x6d\157\137\163\x65\156\144\x5f\156\x65\167\x5f\x63\x75\x73\164\157\155\145\162\x5f\163\155\163\137\x6e\x6f\x74\x69\x66"), 1, 2);
    }
    function mo_send_new_customer_sms_notif($d2, array $mx)
    {
        $this->notificationSettings->getUmNewCustomerNotif()->sendSMS(array_merge(array("\x63\x75\163\164\157\155\x65\162\137\151\x64" => $d2), $mx));
        $this->notificationSettings->getUmNewUserAdminNotif()->sendSMS(array_merge(array("\x63\x75\163\x74\x6f\155\x65\162\x5f\151\144" => $d2), $mx));
    }
    function unhook()
    {
        remove_action("\165\x6d\137\x72\x65\x67\151\163\x74\x72\141\164\151\157\x6e\x5f\143\157\x6d\x70\154\x65\164\145", "\x75\155\x5f\x73\x65\156\x64\x5f\x72\x65\x67\151\x73\164\x72\141\164\151\157\156\137\x6e\157\164\151\146\151\x63\141\164\151\157\156");
    }
    function setAddonKey()
    {
        $this->_addOnKey = "\x75\x6d\x5f\163\x6d\x73\137\156\157\164\151\x66\151\x63\x61\x74\x69\x6f\156\137\141\x64\x64\x6f\x6e";
    }
    function setAddOnDesc()
    {
        $this->_addOnDesc = mo_("\x41\154\154\157\167\x73\x20\x79\157\x75\x72\40\163\151\x74\x65\x20\x74\x6f\x20\x73\x65\x6e\144\40\x63\165\163\x74\157\x6d\x20\x53\x4d\x53\x20\156\157\x74\x69\146\x69\x63\141\x74\x69\x6f\156\x73\x20\x74\157\x20\171\157\165\162\40\x63\165\x73\164\157\155\x65\162\163\x2e" . "\x43\154\151\x63\153\x20\x6f\156\40\x74\150\145\40\x73\145\x74\164\x69\x6e\147\163\x20\142\165\x74\164\x6f\x6e\x20\x74\157\x20\x74\x68\x65\40\162\151\147\x68\164\40\164\x6f\40\163\x65\145\40\164\x68\x65\40\154\x69\163\164\x20\157\x66\40\x6e\x6f\x74\151\146\x69\143\x61\x74\x69\x6f\x6e\x73\x20\164\150\141\164\40\147\x6f\40\157\165\164\x2e");
    }
    function setAddOnName()
    {
        $this->_addOnName = mo_("\125\154\x74\x69\155\141\164\145\x20\115\145\x6d\142\x65\x72\x20\x53\115\123\x20\x4e\157\164\151\x66\151\x63\x61\x74\x69\157\x6e");
    }
    function setSettingsUrl()
    {
        $this->_settingsUrl = add_query_arg(array("\141\144\x64\157\156" => "\x75\x6d\137\x6e\157\164\x69\x66"), $_SERVER["\x52\x45\121\125\105\x53\124\x5f\125\x52\111"]);
    }
}
