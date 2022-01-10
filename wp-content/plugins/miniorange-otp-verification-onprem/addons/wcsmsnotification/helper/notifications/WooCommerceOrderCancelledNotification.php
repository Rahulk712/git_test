<?php


namespace OTP\Addons\WcSMSNotification\Helper\Notifications;

use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnUtility;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;
class WooCommerceOrderCancelledNotification extends SMSNotification
{
    public static $instance;
    function __construct()
    {
        parent::__construct();
        $this->title = "\117\162\144\145\x72\40\103\x61\x6e\143\145\154\154\145\144";
        $this->page = "\x77\143\137\157\162\144\145\162\x5f\143\141\x6e\143\x65\x6c\154\x65\144\137\156\x6f\164\x69\146";
        $this->isEnabled = FALSE;
        $this->tooltipHeader = "\x4f\x52\104\105\122\x5f\x43\101\x4e\x43\105\x4c\x4c\105\104\137\x4e\117\124\x49\x46\137\x48\x45\x41\104\105\122";
        $this->tooltipBody = "\117\x52\x44\x45\x52\x5f\x43\101\116\103\x45\114\x4c\x45\x44\x5f\x4e\x4f\x54\111\106\137\x42\117\x44\131";
        $this->recipient = "\x63\x75\x73\x74\x6f\155\x65\x72";
        $this->smsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ORDER_CANCELLED_SMS);
        $this->defaultSmsBodsy = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ORDER_CANCELLED_SMS);
        $this->availableTags = "\x7b\163\x69\164\x65\x2d\x6e\141\x6d\145\x7d\x2c\173\x6f\x72\x64\x65\x72\x2d\x6e\x75\155\142\145\162\x7d\x2c\173\x75\x73\x65\x72\156\141\155\145\x7d\173\157\162\x64\145\x72\55\144\141\164\x65\x7d";
        $this->pageHeader = mo_("\x4f\x52\104\x45\x52\40\x43\x41\116\103\105\114\x4c\105\104\x20\116\x4f\124\111\106\x49\x43\101\x54\x49\x4f\x4e\40\x53\x45\x54\x54\111\x4e\107\x53");
        $this->pageDescription = mo_("\123\x4d\x53\x20\x6e\157\x74\x69\146\x69\x63\x61\164\151\157\x6e\163\40\163\x65\164\164\x69\156\147\x73\x20\146\157\x72\40\117\x72\144\x65\x72\x20\x43\141\156\143\145\x6c\154\141\164\151\x6f\156\x20\123\115\123\x20\x73\x65\156\164\40\x74\157\40\x74\150\x65\x20\165\x73\x65\x72\x73");
        $this->notificationType = mo_("\x43\x75\163\164\157\x6d\x65\x72");
        self::$instance = $this;
    }
    public static function getInstance()
    {
        return self::$instance === null ? new self() : self::$instance;
    }
    function sendSMS(array $mx)
    {
        if ($this->isEnabled) {
            goto ND;
        }
        return;
        ND:
        $KO = $mx["\157\x72\144\145\x72\x44\145\x74\141\x69\154\163"];
        if (!MoUtility::isBlank($KO)) {
            goto xB;
        }
        return;
        xB:
        $M0 = get_userdata($KO->get_customer_id());
        $VI = get_bloginfo();
        $Iv = MoUtility::isBlank($M0) ? '' : $M0->user_login;
        $mF = MoWcAddOnUtility::getCustomerNumberFromOrder($KO);
        $oF = $KO->get_date_created()->date_i18n();
        $jk = $KO->get_order_number();
        $hQ = array("\x73\151\x74\145\55\x6e\141\x6d\145" => $VI, "\165\x73\x65\x72\x6e\141\155\x65" => $Iv, "\x6f\x72\x64\145\162\x2d\x64\x61\164\x65" => $oF, "\157\162\x64\x65\x72\55\x6e\165\x6d\142\x65\x72" => $jk);
        $hQ = apply_filters("\x6d\x6f\x5f\167\143\137\x63\165\x73\164\157\155\x65\162\137\x6f\162\144\x65\x72\137\143\x61\x6e\x63\x65\154\x6c\145\144\137\x6e\x6f\164\151\146\137\x73\x74\x72\x69\x6e\147\137\162\145\x70\154\x61\x63\145", $hQ);
        $D2 = MoUtility::replaceString($hQ, $this->smsBody);
        if (!MoUtility::isBlank($mF)) {
            goto Am;
        }
        return;
        Am:
        MoUtility::send_phone_notif($mF, $D2);
    }
}
