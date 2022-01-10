<?php


namespace OTP\Addons\UmSMSNotification\Helper\Notifications;

use OTP\Addons\UmSMSNotification\Helper\UltimateMemberSMSNotificationMessages;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;
class UltimateMemberNewCustomerNotification extends SMSNotification
{
    public static $instance;
    function __construct()
    {
        parent::__construct();
        $this->title = "\116\x65\x77\40\101\143\x63\157\165\156\164";
        $this->page = "\165\155\x5f\156\x65\167\137\143\165\x73\164\x6f\x6d\145\x72\137\x6e\x6f\x74\x69\146";
        $this->isEnabled = FALSE;
        $this->tooltipHeader = "\116\105\x57\x5f\125\x4d\137\103\x55\x53\x54\117\x4d\x45\122\x5f\x4e\x4f\124\111\106\137\x48\105\x41\104\105\x52";
        $this->tooltipBody = "\116\x45\127\137\125\115\137\103\125\x53\124\117\115\x45\x52\137\x4e\x4f\124\x49\106\x5f\x42\117\104\x59";
        $this->recipient = "\155\157\142\x69\154\145\137\x6e\165\155\x62\x65\162";
        $this->smsBody = UltimateMemberSMSNotificationMessages::showMessage(UltimateMemberSMSNotificationMessages::NEW_UM_CUSTOMER_SMS);
        $this->defaultSmsBody = UltimateMemberSMSNotificationMessages::showMessage(UltimateMemberSMSNotificationMessages::NEW_UM_CUSTOMER_SMS);
        $this->availableTags = "\x7b\x73\151\164\x65\x2d\156\141\155\x65\x7d\x2c\173\165\x73\145\x72\156\x61\x6d\145\x7d\x2c\x7b\141\x63\x63\x6f\165\x6e\164\160\x61\x67\x65\x2d\165\x72\x6c\x7d\54\173\160\141\163\163\167\x6f\162\144\175\x2c\173\154\x6f\147\151\x6e\55\x75\x72\x6c\175\54\x7b\x65\x6d\x61\x69\154\175\x2c\173\x66\151\x72\x74\156\141\x6d\145\x7d\x2c\173\x6c\141\163\164\x6e\x61\x6d\145\x7d";
        $this->pageHeader = mo_("\116\105\127\x20\x41\x43\x43\x4f\125\x4e\x54\40\116\x4f\124\x49\x46\111\x43\x41\x54\111\117\x4e\x20\x53\105\124\124\111\x4e\x47\x53");
        $this->pageDescription = mo_("\123\115\123\40\156\x6f\164\151\146\x69\143\x61\164\151\x6f\156\x73\x20\x73\x65\164\x74\x69\x6e\147\x73\40\x66\157\x72\40\116\145\167\40\x41\143\x63\x6f\x75\x6e\164\40\x63\x72\x65\x61\164\151\x6f\156\40\x53\x4d\x53\x20\163\145\x6e\x74\x20\x74\157\40\164\150\145\x20\165\x73\x65\162\163");
        $this->notificationType = mo_("\103\x75\163\x74\157\155\145\162");
        self::$instance = $this;
    }
    public static function getInstance()
    {
        return self::$instance === null ? new self() : self::$instance;
    }
    function sendSMS(array $mx)
    {
        if ($this->isEnabled) {
            goto Do1;
        }
        return;
        Do1:
        $Iv = um_user("\x75\163\145\162\x5f\x6c\157\x67\x69\156");
        $mF = $mx[$this->recipient];
        $U1 = um_user_profile_url();
        $wh = um_user("\x5f\165\x6d\137\x63\x6f\x6f\154\x5f\142\165\x74\137\x68\x61\x72\144\137\164\157\137\x67\165\145\x73\163\x5f\x70\154\141\x69\x6e\137\160\x77");
        $lu = um_get_core_page("\x6c\x6f\x67\151\156");
        $eD = um_user("\146\151\x72\x73\164\x5f\156\141\x6d\145");
        $UU = um_user("\154\x61\x73\164\x5f\x6e\x61\x6d\145");
        $xX = um_user("\165\x73\x65\x72\137\x65\x6d\141\151\x6c");
        $hQ = array("\163\151\x74\x65\55\156\141\155\x65" => get_bloginfo(), "\x75\x73\x65\162\x6e\141\155\x65" => $Iv, "\x61\143\143\157\x75\x6e\164\160\141\x67\x65\55\165\162\154" => $U1, "\160\141\163\x73\x77\157\162\144" => $wh, "\154\x6f\147\151\156\x2d\165\162\x6c" => $lu, "\x66\x69\x72\x73\164\x6e\x61\x6d\x65" => $eD, "\x6c\x61\163\x74\x6e\141\x6d\145" => $UU, "\145\x6d\x61\x69\154" => $xX);
        $hQ = apply_filters("\x6d\157\x5f\165\x6d\x5f\156\x65\x77\x5f\x63\x75\x73\x74\157\155\x65\x72\137\x6e\157\x74\151\146\x5f\163\164\162\151\x6e\147\137\162\x65\x70\154\141\x63\145", $hQ);
        $D2 = MoUtility::replaceString($hQ, $this->smsBody);
        if (!MoUtility::isBlank($mF)) {
            goto qc;
        }
        return;
        qc:
        MoUtility::send_phone_notif($mF, $D2);
    }
}
