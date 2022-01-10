<?php


namespace OTP\Addons\UmSMSNotification\Helper\Notifications;

use OTP\Addons\UmSMSNotification\Helper\UltimateMemberSMSNotificationMessages;
use OTP\Addons\UmSMSNotification\Helper\UltimateMemberSMSNotificationUtility;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;
class UltimateMemberNewUserAdminNotification extends SMSNotification
{
    public static $instance;
    function __construct()
    {
        parent::__construct();
        $this->title = "\x4e\x65\x77\40\101\x63\x63\x6f\165\156\164";
        $this->page = "\165\155\x5f\x6e\x65\x77\x5f\143\165\x73\x74\157\x6d\x65\x72\137\141\144\155\151\x6e\137\x6e\x6f\x74\151\146";
        $this->isEnabled = FALSE;
        $this->tooltipHeader = "\116\105\127\137\x55\x4d\x5f\x43\x55\123\x54\117\115\105\122\137\116\x4f\x54\x49\106\137\110\105\101\x44\x45\122";
        $this->tooltipBody = "\116\105\x57\137\x55\115\x5f\x43\125\x53\x54\117\115\105\x52\137\101\104\115\111\x4e\x5f\116\x4f\124\x49\x46\137\x42\117\x44\x59";
        $this->recipient = UltimateMemberSMSNotificationUtility::getAdminPhoneNumber();
        $this->smsBody = UltimateMemberSMSNotificationMessages::showMessage(UltimateMemberSMSNotificationMessages::NEW_UM_CUSTOMER_ADMIN_SMS);
        $this->defaultSmsBody = UltimateMemberSMSNotificationMessages::showMessage(UltimateMemberSMSNotificationMessages::NEW_UM_CUSTOMER_ADMIN_SMS);
        $this->availableTags = "\x7b\163\151\x74\x65\x2d\x6e\141\155\145\175\x2c\x7b\x75\x73\145\162\x6e\x61\x6d\145\x7d\54\173\141\x63\143\x6f\x75\156\164\160\x61\x67\x65\x2d\165\162\154\x7d\54\173\x65\x6d\141\151\x6c\175\x2c\x7b\x66\151\162\164\156\141\x6d\x65\x7d\54\x7b\x6c\141\x73\164\x6e\141\x6d\145\x7d";
        $this->pageHeader = mo_("\116\105\127\40\x41\x43\103\x4f\x55\x4e\x54\x20\101\104\x4d\x49\x4e\40\116\x4f\124\111\106\x49\x43\x41\x54\x49\117\x4e\x20\x53\105\124\x54\111\116\107\x53");
        $this->pageDescription = mo_("\123\x4d\123\40\156\157\164\151\x66\151\143\x61\x74\151\x6f\x6e\x73\x20\163\x65\164\x74\151\156\147\163\x20\x66\x6f\x72\40\116\145\167\x20\x41\x63\x63\x6f\165\156\164\x20\143\162\145\141\164\151\x6f\156\40\x53\x4d\123\x20\x73\x65\x6e\x74\40\x74\157\x20\x74\150\x65\x20\x61\x64\155\x69\156\163");
        $this->notificationType = mo_("\101\144\155\151\x6e\x69\163\x74\162\x61\x74\x6f\162");
        self::$instance = $this;
    }
    public static function getInstance()
    {
        return self::$instance === null ? new self() : self::$instance;
    }
    function sendSMS(array $mx)
    {
        if ($this->isEnabled) {
            goto Ta;
        }
        return;
        Ta:
        $iR = maybe_unserialize($this->recipient);
        $Iv = um_user("\165\x73\x65\x72\137\x6c\157\x67\151\156");
        $U1 = um_user_profile_url();
        $eD = um_user("\x66\x69\162\x73\x74\137\156\x61\155\145");
        $UU = um_user("\154\141\x73\x74\137\x6e\x61\x6d\x65");
        $xX = um_user("\165\163\145\x72\x5f\x65\x6d\x61\x69\x6c");
        $hQ = array("\163\151\x74\x65\55\156\141\x6d\145" => get_bloginfo(), "\165\x73\x65\162\x6e\x61\155\x65" => $Iv, "\x61\x63\x63\x6f\165\156\164\x70\x61\x67\x65\55\x75\162\x6c" => $U1, "\x66\151\162\x73\164\x6e\141\155\x65" => $eD, "\x6c\x61\x73\x74\156\x61\x6d\x65" => $UU, "\x65\155\141\151\154" => $xX);
        $hQ = apply_filters("\155\x6f\x5f\165\x6d\137\156\x65\167\x5f\x63\x75\x73\x74\157\155\x65\162\137\x61\144\x6d\x69\156\x5f\x6e\157\164\x69\146\x5f\163\x74\x72\151\156\147\x5f\162\145\x70\x6c\x61\x63\145", $hQ);
        $D2 = MoUtility::replaceString($hQ, $this->smsBody);
        if (!MoUtility::isBlank($iR)) {
            goto V0;
        }
        return;
        V0:
        foreach ($iR as $mF) {
            MoUtility::send_phone_notif($mF, $D2);
            NJ:
        }
        fh:
    }
}
