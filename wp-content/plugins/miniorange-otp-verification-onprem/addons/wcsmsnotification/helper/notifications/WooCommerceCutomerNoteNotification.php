<?php


namespace OTP\Addons\WcSMSNotification\Helper\Notifications;

use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnUtility;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;
class WooCommerceCutomerNoteNotification extends SMSNotification
{
    public static $instance;
    function __construct()
    {
        parent::__construct();
        $this->title = "\103\165\163\x74\x6f\155\x65\162\40\116\x6f\x74\145";
        $this->page = "\x77\x63\x5f\x63\165\163\x74\x6f\x6d\145\x72\x5f\156\157\164\145\137\x6e\157\x74\x69\146";
        $this->isEnabled = FALSE;
        $this->tooltipHeader = "\x43\x55\x53\124\x4f\115\x45\x52\x5f\116\117\124\105\137\116\117\x54\x49\106\x5f\110\105\101\x44\x45\122";
        $this->tooltipBody = "\103\x55\123\124\117\115\105\122\x5f\x4e\x4f\124\105\137\x4e\117\x54\111\x46\137\102\117\x44\131";
        $this->recipient = "\x63\165\163\164\157\155\145\162";
        $this->smsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::CUSTOMER_NOTE_SMS);
        $this->defaultSmsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::CUSTOMER_NOTE_SMS);
        $this->availableTags = "\173\x6f\x72\144\145\x72\55\x64\x61\164\x65\175\54\173\157\162\x64\145\x72\x2d\156\165\155\142\x65\162\175\54\173\x75\163\145\162\x6e\141\x6d\145\175\54\173\163\151\x74\145\55\x6e\x61\155\x65\175";
        $this->pageHeader = mo_("\x43\x55\123\124\x4f\115\105\122\x20\x4e\117\124\105\x20\x4e\117\x54\x49\106\x49\103\x41\x54\111\x4f\x4e\40\123\x45\124\x54\x49\116\107\x53");
        $this->pageDescription = mo_("\123\x4d\x53\x20\x6e\157\x74\151\146\x69\143\x61\x74\x69\157\156\163\x20\163\145\x74\x74\151\x6e\147\163\x20\x66\x6f\x72\x20\103\165\x73\164\x6f\155\x65\162\40\116\157\164\145\40\x53\x4d\123\x20\163\x65\156\164\40\x74\157\x20\164\150\x65\x20\x75\x73\x65\162\x73");
        $this->notificationType = mo_("\x43\x75\x73\x74\x6f\x6d\145\162");
        self::$instance = $this;
    }
    public static function getInstance()
    {
        return self::$instance === null ? new self() : self::$instance;
    }
    function sendSMS(array $mx)
    {
        if ($this->isEnabled) {
            goto mr;
        }
        return;
        mr:
        $KO = $mx["\x6f\x72\x64\x65\x72\x44\x65\x74\x61\x69\154\x73"];
        if (!MoUtility::isBlank($KO)) {
            goto Cu;
        }
        return;
        Cu:
        $M0 = get_userdata($KO->get_customer_id());
        $VI = get_bloginfo();
        $Iv = MoUtility::isBlank($M0) ? '' : $M0->user_login;
        $mF = MoWcAddOnUtility::getCustomerNumberFromOrder($KO);
        $oF = $KO->get_date_created()->date_i18n();
        $jk = $KO->get_order_number();
        $hQ = array("\163\x69\x74\x65\55\156\x61\x6d\x65" => $VI, "\x75\x73\x65\162\156\x61\155\x65" => $Iv, "\157\162\144\145\162\55\144\141\x74\145" => $oF, "\157\162\144\145\162\x2d\156\x75\x6d\x62\x65\x72" => $jk);
        $hQ = apply_filters("\x6d\x6f\x5f\x77\143\137\x63\x75\x73\x74\157\155\x65\x72\x5f\156\x6f\164\145\x5f\163\x74\162\x69\156\147\x5f\x72\145\160\x6c\x61\143\145", $hQ);
        $D2 = MoUtility::replaceString($hQ, $this->smsBody);
        if (!MoUtility::isBlank($mF)) {
            goto YO;
        }
        return;
        YO:
        MoUtility::send_phone_notif($mF, $D2);
    }
}
