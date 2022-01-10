<?php


namespace OTP\Addons\WcSMSNotification\Helper\Notifications;

use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnUtility;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;
class WooCommerceOrderCompletedNotification extends SMSNotification
{
    public static $instance;
    function __construct()
    {
        parent::__construct();
        $this->title = "\117\x72\x64\145\162\x20\x43\157\x6d\x70\154\x65\164\145\x64";
        $this->page = "\x77\x63\137\157\162\144\145\162\x5f\143\x6f\x6d\x70\154\x65\164\x65\144\137\x6e\157\x74\x69\x66";
        $this->isEnabled = FALSE;
        $this->tooltipHeader = "\x4f\x52\x44\105\122\x5f\x43\x41\116\103\105\114\114\105\104\137\116\117\x54\111\x46\x5f\110\105\101\104\x45\122";
        $this->tooltipBody = "\x4f\x52\104\x45\x52\x5f\103\101\x4e\103\x45\114\x4c\x45\x44\137\x4e\x4f\x54\111\106\137\x42\x4f\104\x59";
        $this->recipient = "\143\165\163\x74\x6f\x6d\145\162";
        $this->smsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ORDER_COMPLETED_SMS);
        $this->defaultSmsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ORDER_COMPLETED_SMS);
        $this->availableTags = "\x7b\163\151\164\145\55\x6e\x61\155\x65\175\x2c\173\x6f\162\x64\x65\x72\x2d\156\165\155\142\145\162\175\54\x7b\165\163\145\162\156\141\155\x65\x7d\x7b\157\162\144\145\162\x2d\x64\141\164\145\x7d";
        $this->pageHeader = mo_("\117\x52\x44\x45\x52\x20\x43\x4f\x4d\120\114\x45\124\105\x44\x20\116\117\124\111\x46\111\x43\101\124\x49\x4f\x4e\x20\x53\x45\x54\x54\x49\116\107\x53");
        $this->pageDescription = mo_("\123\115\x53\x20\x6e\x6f\x74\x69\146\x69\143\141\164\x69\x6f\156\x73\x20\163\x65\164\164\151\x6e\147\x73\x20\x66\x6f\x72\x20\x4f\162\x64\x65\162\40\x43\x6f\x6d\160\154\x65\x74\x69\157\156\40\x53\115\123\x20\163\x65\x6e\x74\x20\164\x6f\x20\164\150\x65\x20\x75\163\x65\162\163");
        $this->notificationType = mo_("\103\165\x73\164\157\155\145\x72");
        self::$instance = $this;
    }
    public static function getInstance()
    {
        return self::$instance === null ? new self() : self::$instance;
    }
    function sendSMS(array $mx)
    {
        if ($this->isEnabled) {
            goto q4;
        }
        return;
        q4:
        $KO = $mx["\x6f\x72\x64\x65\162\x44\x65\164\141\x69\154\163"];
        if (!MoUtility::isBlank($KO)) {
            goto L8;
        }
        return;
        L8:
        $M0 = get_userdata($KO->get_customer_id());
        $VI = get_bloginfo();
        $Iv = MoUtility::isBlank($M0) ? '' : $M0->user_login;
        $mF = MoWcAddOnUtility::getCustomerNumberFromOrder($KO);
        $oF = $KO->get_date_created()->date_i18n();
        $jk = $KO->get_order_number();
        $hQ = array("\x73\x69\x74\x65\x2d\x6e\x61\155\145" => $VI, "\165\163\145\x72\x6e\x61\155\x65" => $Iv, "\x6f\x72\x64\145\162\55\x64\141\x74\x65" => $oF, "\x6f\162\x64\x65\162\55\156\165\155\x62\145\x72" => $jk);
        $hQ = apply_filters("\155\157\x5f\x77\x63\x5f\x63\165\163\164\x6f\155\x65\162\x5f\157\x72\x64\x65\162\137\x63\x6f\155\x70\154\x65\164\x65\144\137\156\157\x74\151\x66\137\163\164\x72\x69\156\147\137\162\145\x70\x6c\141\143\145", $hQ);
        $D2 = MoUtility::replaceString($hQ, $this->smsBody);
        if (!MoUtility::isBlank($mF)) {
            goto qD;
        }
        return;
        qD:
        MoUtility::send_phone_notif($mF, $D2);
    }
}
