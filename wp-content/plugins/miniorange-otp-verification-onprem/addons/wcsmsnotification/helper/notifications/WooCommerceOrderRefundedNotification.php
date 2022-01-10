<?php


namespace OTP\Addons\WcSMSNotification\Helper\Notifications;

use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnUtility;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;
class WooCommerceOrderRefundedNotification extends SMSNotification
{
    public static $instance;
    function __construct()
    {
        parent::__construct();
        $this->title = "\117\x72\x64\x65\162\x20\122\145\146\165\x6e\144\145\x64";
        $this->page = "\x77\143\137\x6f\x72\144\145\162\137\x72\145\x66\165\x6e\x64\x65\x64\x5f\x6e\157\x74\x69\x66";
        $this->isEnabled = FALSE;
        $this->tooltipHeader = "\117\122\x44\105\122\x5f\x52\x45\106\125\116\x44\x45\x44\137\116\117\124\x49\106\137\110\105\101\x44\x45\122";
        $this->tooltipBody = "\117\122\x44\x45\122\x5f\x52\x45\x55\x4e\104\105\104\137\x4e\117\x54\111\x46\137\102\117\x44\131";
        $this->recipient = "\143\165\163\x74\x6f\x6d\x65\x72";
        $this->smsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ORDER_REFUNDED_SMS);
        $this->defaultSmsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ORDER_REFUNDED_SMS);
        $this->availableTags = "\x7b\x73\151\164\x65\55\156\141\x6d\x65\x7d\x2c\173\157\x72\144\145\x72\55\156\165\x6d\x62\145\162\x7d\54\173\x75\163\145\x72\x6e\x61\155\x65\175\173\157\162\144\x65\x72\55\144\141\x74\145\175";
        $this->pageHeader = mo_("\117\122\x44\x45\x52\40\122\x45\x46\125\116\104\105\104\x20\116\117\124\x49\x46\x49\x43\x41\124\111\x4f\x4e\40\123\105\124\124\111\116\107\x53");
        $this->pageDescription = mo_("\x53\x4d\x53\40\156\157\164\x69\x66\x69\143\141\x74\151\x6f\156\x73\40\x73\x65\x74\164\151\156\147\163\x20\x66\157\x72\x20\x4f\x72\x64\x65\x72\x20\x52\145\146\165\x6e\144\145\144\40\123\115\123\x20\x73\x65\x6e\x74\40\164\x6f\x20\x74\x68\145\x20\x75\163\145\162\163");
        $this->notificationType = mo_("\103\165\x73\164\157\x6d\x65\162");
        self::$instance = $this;
    }
    public static function getInstance()
    {
        return self::$instance === null ? new self() : self::$instance;
    }
    function sendSMS(array $mx)
    {
        if ($this->isEnabled) {
            goto AZ;
        }
        return;
        AZ:
        $KO = $mx["\x6f\162\x64\x65\162\x44\x65\164\x61\x69\x6c\163"];
        if (!MoUtility::isBlank($KO)) {
            goto TJ;
        }
        return;
        TJ:
        $M0 = get_userdata($KO->get_customer_id());
        $VI = get_bloginfo();
        $Iv = MoUtility::isBlank($M0) ? '' : $M0->user_login;
        $mF = MoWcAddOnUtility::getCustomerNumberFromOrder($KO);
        $oF = $KO->get_date_created()->date_i18n();
        $jk = $KO->get_order_number();
        $hQ = array("\x73\x69\164\x65\x2d\156\141\155\x65" => $VI, "\165\x73\145\162\x6e\x61\155\x65" => $Iv, "\x6f\162\144\145\x72\x2d\144\x61\x74\145" => $oF, "\x6f\x72\x64\145\x72\55\x6e\165\155\142\145\x72" => $jk);
        $hQ = apply_filters("\x6d\x6f\x5f\167\x63\137\x63\x75\x73\164\157\x6d\145\162\x5f\x6f\x72\144\x65\x72\137\162\145\146\x75\x6e\144\x65\144\137\156\157\x74\151\146\137\163\x74\x72\x69\x6e\147\x5f\x72\145\x70\154\141\143\x65", $hQ);
        $D2 = MoUtility::replaceString($hQ, $this->smsBody);
        if (!MoUtility::isBlank($mF)) {
            goto Yh;
        }
        return;
        Yh:
        MoUtility::send_phone_notif($mF, $D2);
    }
}
