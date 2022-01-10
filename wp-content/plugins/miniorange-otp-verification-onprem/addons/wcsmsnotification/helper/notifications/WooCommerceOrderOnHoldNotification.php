<?php


namespace OTP\Addons\WcSMSNotification\Helper\Notifications;

use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnUtility;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;
class WooCommerceOrderOnHoldNotification extends SMSNotification
{
    public static $instance;
    function __construct()
    {
        parent::__construct();
        $this->title = "\117\162\144\145\x72\x20\157\156\x2d\150\x6f\x6c\144";
        $this->page = "\x77\x63\x5f\157\x72\x64\145\x72\x5f\157\156\137\x68\x6f\154\144\x5f\x6e\x6f\164\151\146";
        $this->isEnabled = FALSE;
        $this->tooltipHeader = "\117\x52\104\x45\x52\x5f\x4f\116\137\110\x4f\x4c\x44\x5f\116\117\124\x49\106\x5f\x48\x45\101\104\x45\x52";
        $this->tooltipBody = "\117\x52\x44\x45\x52\x5f\x4f\116\137\x48\x4f\114\104\137\x4e\117\124\111\106\x5f\102\x4f\104\x59";
        $this->recipient = "\x63\x75\x73\x74\x6f\155\145\x72";
        $this->smsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ORDER_ON_HOLD_SMS);
        $this->defaultSmsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ORDER_ON_HOLD_SMS);
        $this->availableTags = "\173\x73\151\x74\x65\55\x6e\x61\x6d\145\175\x2c\x7b\157\x72\144\145\x72\55\156\165\155\x62\145\162\x7d\54\x7b\165\x73\145\162\156\x61\x6d\x65\x7d\173\x6f\162\x64\x65\x72\55\x64\x61\164\145\175";
        $this->pageHeader = mo_("\117\122\x44\105\122\40\117\116\x2d\110\117\x4c\104\40\116\x4f\x54\x49\106\x49\x43\x41\124\x49\117\116\40\123\105\x54\124\111\116\107\x53");
        $this->pageDescription = mo_("\x53\115\123\40\x6e\157\x74\151\x66\151\x63\141\164\x69\x6f\x6e\163\40\163\x65\x74\x74\151\156\147\163\x20\x66\x6f\x72\40\117\x72\144\x65\162\x20\157\156\55\x68\157\x6c\x64\x20\x53\115\123\40\163\x65\x6e\x74\x20\164\157\x20\x74\x68\x65\40\165\163\x65\x72\163");
        $this->notificationType = mo_("\x43\165\x73\164\157\155\145\162");
        self::$instance = $this;
    }
    public static function getInstance()
    {
        return self::$instance === null ? new self() : self::$instance;
    }
    function sendSMS(array $mx)
    {
        if ($this->isEnabled) {
            goto XH;
        }
        return;
        XH:
        $KO = $mx["\157\162\144\145\x72\x44\145\x74\141\151\154\x73"];
        if (!MoUtility::isBlank($KO)) {
            goto NG;
        }
        return;
        NG:
        $M0 = get_userdata($KO->get_customer_id());
        $VI = get_bloginfo();
        $Iv = MoUtility::isBlank($M0) ? '' : $M0->user_login;
        $mF = MoWcAddOnUtility::getCustomerNumberFromOrder($KO);
        $oF = $KO->get_date_created()->date_i18n();
        $jk = $KO->get_order_number();
        $hQ = array("\x73\x69\164\145\55\x6e\141\155\x65" => $VI, "\x75\163\145\x72\x6e\141\155\145" => $Iv, "\157\162\x64\145\162\55\x64\x61\x74\145" => $oF, "\x6f\162\x64\x65\x72\55\x6e\x75\x6d\x62\x65\x72" => $jk);
        $hQ = apply_filters("\155\x6f\x5f\x77\x63\137\x63\165\x73\x74\157\x6d\x65\162\x5f\157\162\x64\145\x72\137\x6f\156\150\157\154\x64\137\156\x6f\x74\151\146\137\x73\164\162\151\x6e\147\x5f\162\x65\160\x6c\141\143\x65", $hQ);
        $D2 = MoUtility::replaceString($hQ, $this->smsBody);
        if (!MoUtility::isBlank($mF)) {
            goto Ri;
        }
        return;
        Ri:
        MoUtility::send_phone_notif($mF, $D2);
    }
}
