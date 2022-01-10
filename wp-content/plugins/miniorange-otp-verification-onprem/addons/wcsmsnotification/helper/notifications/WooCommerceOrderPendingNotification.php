<?php


namespace OTP\Addons\WcSMSNotification\Helper\Notifications;

use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnUtility;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;
class WooCommerceOrderPendingNotification extends SMSNotification
{
    public static $instance;
    function __construct()
    {
        parent::__construct();
        $this->title = "\x4f\x72\144\145\x72\x20\x50\145\156\x64\151\x6e\x67\x20\120\141\171\x6d\x65\x6e\x74";
        $this->page = "\x77\143\x5f\157\x72\144\145\162\137\x70\x65\x6e\x64\151\x6e\147\x5f\x6e\x6f\164\151\146";
        $this->isEnabled = FALSE;
        $this->tooltipHeader = "\117\x52\x44\105\122\137\120\105\x4e\x44\x49\x4e\x47\137\x4e\117\x54\111\x46\137\110\105\101\x44\x45\122";
        $this->tooltipBody = "\117\x52\104\105\122\x5f\x50\105\116\104\111\x4e\107\137\x4e\x4f\124\x49\106\137\102\117\104\x59";
        $this->recipient = "\x63\165\x73\164\x6f\x6d\x65\162";
        $this->smsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ORDER_PENDING_SMS);
        $this->defaultSmsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ORDER_PENDING_SMS);
        $this->availableTags = "\x7b\x73\151\164\x65\55\156\141\155\x65\x7d\54\173\x6f\x72\x64\145\162\55\156\165\155\x62\x65\x72\x7d\54\173\x75\163\x65\162\156\141\x6d\x65\x7d\x7b\x6f\162\144\145\162\55\144\x61\x74\145\x7d";
        $this->pageHeader = mo_("\117\x52\104\105\x52\40\x50\105\x4e\x44\x49\x4e\x47\40\120\x41\x59\115\x45\116\x54\40\x4e\117\x54\111\x46\x49\103\x41\124\x49\117\116\x20\123\x45\124\x54\111\116\107\123");
        $this->pageDescription = mo_("\123\115\x53\x20\156\157\x74\151\146\x69\x63\x61\x74\x69\x6f\156\163\x20\163\x65\164\x74\x69\156\147\163\40\x66\157\162\x20\117\162\x64\145\x72\40\120\145\x6e\x64\151\156\x67\40\x50\x61\171\155\x65\x6e\x74\x20\x53\x4d\123\x20\163\145\x6e\164\40\x74\157\40\164\x68\x65\40\165\163\x65\162\x73");
        $this->notificationType = mo_("\x43\x75\163\164\157\155\x65\162");
        self::$instance = $this;
    }
    public static function getInstance()
    {
        return self::$instance === null ? new self() : self::$instance;
    }
    function sendSMS(array $mx)
    {
        if ($this->isEnabled) {
            goto IJ;
        }
        return;
        IJ:
        $KO = $mx["\157\x72\x64\145\162\104\145\x74\x61\151\154\x73"];
        if (!MoUtility::isBlank($KO)) {
            goto Lk;
        }
        return;
        Lk:
        $M0 = get_userdata($KO->get_customer_id());
        $VI = get_bloginfo();
        $Iv = MoUtility::isBlank($M0) ? '' : $M0->user_login;
        $mF = MoWcAddOnUtility::getCustomerNumberFromOrder($KO);
        $oF = $KO->get_date_created()->date_i18n();
        $jk = $KO->get_order_number();
        $hQ = array("\163\151\164\x65\x2d\156\x61\155\x65" => $VI, "\165\x73\x65\x72\156\x61\x6d\x65" => $Iv, "\157\x72\x64\x65\162\x2d\x64\141\164\145" => $oF, "\x6f\162\x64\145\x72\x2d\156\165\155\x62\x65\162" => $jk);
        $hQ = apply_filters("\x6d\157\137\x77\x63\137\x63\x75\x73\x74\157\155\145\x72\137\157\162\144\x65\x72\x5f\160\x65\x6e\x64\151\156\x67\137\156\x6f\x74\151\146\x5f\163\164\x72\151\156\147\x5f\x72\145\160\154\141\x63\x65", $hQ);
        $D2 = MoUtility::replaceString($hQ, $this->smsBody);
        if (!MoUtility::isBlank($mF)) {
            goto Ed;
        }
        return;
        Ed:
        MoUtility::send_phone_notif($mF, $D2);
    }
}
