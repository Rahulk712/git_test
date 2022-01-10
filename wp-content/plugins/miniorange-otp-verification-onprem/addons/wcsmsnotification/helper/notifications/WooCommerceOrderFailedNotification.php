<?php


namespace OTP\Addons\WcSMSNotification\Helper\Notifications;

use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnUtility;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;
class WooCommerceOrderFailedNotification extends SMSNotification
{
    public static $instance;
    function __construct()
    {
        parent::__construct();
        $this->title = "\x4f\162\x64\x65\x72\40\x46\141\151\x6c\x65\144";
        $this->page = "\167\143\137\x6f\162\x64\x65\162\x5f\x66\141\151\154\x65\144\137\156\x6f\164\x69\x66";
        $this->isEnabled = FALSE;
        $this->tooltipHeader = "\x4f\122\104\105\122\137\x46\x41\x49\114\105\x44\x5f\116\x4f\124\111\106\137\110\x45\x41\104\x45\x52";
        $this->tooltipBody = "\x4f\122\x44\x45\122\137\x46\x41\111\x4c\x45\104\137\x4e\117\x54\111\x46\x5f\x42\117\x44\x59";
        $this->recipient = "\x63\x75\163\164\157\x6d\145\x72";
        $this->smsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ORDER_FAILED_SMS);
        $this->defaultSmsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ORDER_FAILED_SMS);
        $this->availableTags = "\173\163\x69\x74\145\55\156\141\x6d\x65\175\x2c\173\x6f\162\144\145\162\x2d\156\x75\x6d\142\145\x72\175\54\x7b\x75\163\145\x72\x6e\141\155\145\175\x7b\157\x72\144\x65\162\55\x64\141\x74\145\x7d";
        $this->pageHeader = mo_("\117\122\104\105\x52\x20\106\101\111\x4c\x45\104\x20\116\x4f\x54\x49\106\111\x43\101\x54\111\x4f\x4e\40\123\x45\x54\124\111\116\107\123");
        $this->pageDescription = mo_("\x53\115\x53\x20\156\157\x74\151\146\151\x63\x61\164\x69\x6f\x6e\x73\x20\163\145\x74\x74\x69\x6e\x67\x73\40\x66\x6f\x72\40\x4f\x72\x64\145\162\40\x66\x61\x69\x6c\x75\162\145\x20\123\115\x53\40\163\x65\x6e\164\40\164\x6f\40\164\150\145\x20\165\x73\x65\162\163");
        $this->notificationType = mo_("\x43\x75\x73\164\157\x6d\x65\x72");
        self::$instance = $this;
    }
    public static function getInstance()
    {
        return self::$instance === null ? new self() : self::$instance;
    }
    function sendSMS(array $mx)
    {
        if ($this->isEnabled) {
            goto d6;
        }
        return;
        d6:
        $KO = $mx["\157\x72\144\145\162\104\x65\164\x61\151\154\163"];
        if (!MoUtility::isBlank($KO)) {
            goto Zz;
        }
        return;
        Zz:
        $M0 = get_userdata($KO->get_customer_id());
        $VI = get_bloginfo();
        $Iv = MoUtility::isBlank($M0) ? '' : $M0->user_login;
        $mF = MoWcAddOnUtility::getCustomerNumberFromOrder($KO);
        $oF = $KO->get_date_created()->date_i18n();
        $jk = $KO->get_order_number();
        $hQ = array("\163\x69\x74\x65\x2d\x6e\x61\x6d\x65" => $VI, "\165\163\x65\x72\156\x61\x6d\x65" => $Iv, "\157\x72\x64\x65\x72\55\x64\x61\164\145" => $oF, "\x6f\162\144\x65\x72\55\156\x75\x6d\x62\145\x72" => $jk);
        $hQ = apply_filters("\x6d\x6f\137\167\143\137\x63\165\x73\x74\x6f\x6d\x65\x72\137\x6f\x72\x64\x65\162\x5f\x66\141\151\154\145\x64\x5f\x6e\157\x74\151\146\137\x73\x74\162\x69\156\x67\137\162\x65\160\x6c\x61\x63\x65", $hQ);
        $D2 = MoUtility::replaceString($hQ, $this->smsBody);
        if (!MoUtility::isBlank($mF)) {
            goto g9;
        }
        return;
        g9:
        MoUtility::send_phone_notif($mF, $D2);
    }
}
