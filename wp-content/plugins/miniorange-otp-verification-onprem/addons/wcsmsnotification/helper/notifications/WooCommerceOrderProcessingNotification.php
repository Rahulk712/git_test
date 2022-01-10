<?php


namespace OTP\Addons\WcSMSNotification\Helper\Notifications;

use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnUtility;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;
class WooCommerceOrderProcessingNotification extends SMSNotification
{
    public static $instance;
    function __construct()
    {
        parent::__construct();
        $this->title = "\120\162\x6f\x63\145\163\x73\151\156\147\40\117\162\144\x65\162";
        $this->page = "\x77\143\x5f\x6f\162\144\145\162\x5f\x70\x72\x6f\143\x65\x73\163\151\156\x67\x5f\156\x6f\x74\x69\x66";
        $this->isEnabled = FALSE;
        $this->tooltipHeader = "\x4f\x52\104\105\122\x5f\x50\122\x4f\103\105\123\x53\111\x4e\107\x5f\x4e\x4f\x54\111\x46\137\110\105\x41\104\x45\x52";
        $this->tooltipBody = "\117\122\x44\x45\122\137\120\122\x4f\103\x45\123\123\111\x4e\107\x5f\116\x4f\124\x49\x46\137\102\117\104\x59";
        $this->recipient = "\143\x75\x73\x74\x6f\155\x65\162";
        $this->smsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::PROCESSING_ORDER_SMS);
        $this->defaultSmsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::PROCESSING_ORDER_SMS);
        $this->availableTags = "\173\163\151\x74\145\55\x6e\x61\x6d\x65\x7d\54\173\157\162\144\145\162\x2d\x6e\165\x6d\142\x65\162\x7d\x2c\x7b\x75\x73\145\x72\156\141\x6d\x65\175\173\x6f\x72\144\145\162\55\x64\x61\x74\145\175";
        $this->pageHeader = mo_("\x4f\122\104\105\122\x20\x50\122\x4f\x43\x45\x53\123\111\x4e\x47\40\x4e\x4f\124\111\x46\x49\x43\x41\124\x49\x4f\x4e\40\x53\105\124\124\111\116\x47\x53");
        $this->pageDescription = mo_("\x53\115\x53\40\156\x6f\x74\151\146\x69\x63\x61\164\151\157\x6e\x73\40\163\x65\x74\164\x69\156\147\x73\x20\146\x6f\x72\40\117\x72\144\x65\x72\x20\x50\x72\157\143\x65\x73\163\151\x6e\x67\40\123\115\123\x20\163\x65\156\x74\x20\x74\157\x20\x74\150\145\40\165\163\x65\162\163");
        $this->notificationType = mo_("\x43\165\163\164\157\155\x65\162");
        self::$instance = $this;
    }
    public static function getInstance()
    {
        return self::$instance === null ? new self() : self::$instance;
    }
    function sendSMS(array $mx)
    {
        if ($this->isEnabled) {
            goto K6;
        }
        return;
        K6:
        $KO = $mx["\157\x72\x64\x65\x72\x44\145\x74\141\x69\154\163"];
        if (!MoUtility::isBlank($KO)) {
            goto yb;
        }
        return;
        yb:
        $M0 = get_userdata($KO->get_customer_id());
        $VI = get_bloginfo();
        $Iv = MoUtility::isBlank($M0) ? '' : $M0->user_login;
        $mF = MoWcAddOnUtility::getCustomerNumberFromOrder($KO);
        $oF = $KO->get_date_created()->date_i18n();
        $jk = $KO->get_order_number();
        $hQ = array("\x73\151\x74\145\55\x6e\141\155\x65" => $VI, "\x75\163\x65\162\x6e\141\x6d\x65" => $Iv, "\x6f\x72\x64\145\162\55\144\141\164\x65" => $oF, "\157\x72\144\145\x72\x2d\x6e\x75\x6d\142\145\x72" => $jk);
        $hQ = apply_filters("\155\x6f\x5f\x77\143\x5f\x63\165\163\164\157\155\x65\x72\137\x6f\162\144\x65\162\137\160\162\x6f\x63\x65\163\x73\x69\x6e\x67\137\x6e\157\x74\151\146\137\x73\164\162\151\x6e\x67\x5f\162\145\160\x6c\x61\x63\145", $hQ);
        $D2 = MoUtility::replaceString($hQ, $this->smsBody);
        if (!MoUtility::isBlank($mF)) {
            goto Zc;
        }
        return;
        Zc:
        MoUtility::send_phone_notif($mF, $D2);
    }
}
