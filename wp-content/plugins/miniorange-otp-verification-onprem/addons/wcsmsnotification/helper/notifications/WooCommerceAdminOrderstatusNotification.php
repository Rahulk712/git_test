<?php


namespace OTP\Addons\WcSMSNotification\Helper\Notifications;

use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnUtility;
use OTP\Addons\WcSMSNotification\Helper\WcOrderStatus;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;
class WooCommerceAdminOrderstatusNotification extends SMSNotification
{
    public static $instance;
    public static $statuses;
    function __construct()
    {
        parent::__construct();
        $this->title = "\x4f\162\x64\145\x72\40\123\x74\141\x74\x75\x73";
        $this->page = "\x77\143\137\x61\x64\155\x69\x6e\x5f\x6f\162\144\145\162\137\163\x74\x61\164\x75\x73\137\x6e\157\164\x69\x66";
        $this->isEnabled = FALSE;
        $this->tooltipHeader = "\x4e\105\x57\x5f\117\x52\x44\x45\x52\137\116\117\x54\x49\x46\x5f\x48\105\101\x44\x45\122";
        $this->tooltipBody = "\x4e\x45\x57\x5f\x4f\x52\104\105\122\x5f\x4e\x4f\x54\111\106\137\102\x4f\x44\x59";
        $this->recipient = MoWcAddOnUtility::getAdminPhoneNumber();
        $this->smsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ADMIN_STATUS_SMS);
        $this->defaultSmsBody = MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ADMIN_STATUS_SMS);
        $this->availableTags = "\x7b\163\151\164\x65\x2d\x6e\141\155\145\x7d\54\173\x6f\x72\x64\x65\x72\x2d\x6e\165\155\x62\145\x72\x7d\x2c\173\157\x72\144\145\162\x2d\163\x74\x61\x74\165\163\175\54\173\165\163\145\x72\x6e\141\155\145\x7d\x7b\157\x72\x64\145\x72\55\144\x61\164\x65\x7d";
        $this->pageHeader = mo_("\x4f\122\104\105\x52\x20\101\104\115\111\x4e\x20\x53\124\101\x54\125\x53\x20\116\x4f\124\111\x46\111\x43\101\124\x49\117\116\x20\x53\105\x54\124\x49\x4e\107\123");
        $this->pageDescription = mo_("\123\115\123\x20\156\157\164\x69\146\x69\143\141\164\151\157\156\163\x20\x73\x65\164\x74\151\156\x67\163\x20\146\x6f\x72\40\x4f\x72\144\x65\x72\x20\123\x74\141\x74\165\x73\40\x53\115\123\40\163\x65\156\x74\40\x74\157\40\x74\x68\x65\40\141\144\x6d\x69\x6e\163");
        $this->notificationType = mo_("\101\x64\155\151\x6e\x69\x73\164\162\141\164\x6f\x72");
        self::$instance = $this;
        self::$statuses = WcOrderStatus::getAllStatus();
    }
    public static function getInstance()
    {
        return self::$instance === null ? new self() : self::$instance;
    }
    function sendSMS(array $mx)
    {
        if ($this->isEnabled) {
            goto de;
        }
        return;
        de:
        $KO = $mx["\157\x72\144\145\x72\104\x65\164\141\151\x6c\163"];
        $Y8 = $mx["\x6e\x65\167\137\163\x74\x61\164\x75\163"];
        if (!MoUtility::isBlank($KO)) {
            goto LF;
        }
        return;
        LF:
        if (in_array($Y8, self::$statuses)) {
            goto Q4;
        }
        return;
        Q4:
        $M0 = get_userdata($KO->get_customer_id());
        $VI = get_bloginfo();
        $Iv = MoUtility::isBlank($M0) ? '' : $M0->user_login;
        $iR = maybe_unserialize($this->recipient);
        $oF = $KO->get_date_created()->date_i18n();
        $jk = $KO->get_order_number();
        $hQ = array("\x73\151\164\x65\x2d\x6e\x61\155\145" => $VI, "\x75\x73\x65\x72\x6e\141\x6d\x65" => $Iv, "\x6f\x72\144\145\x72\x2d\x64\141\x74\x65" => $oF, "\x6f\162\144\145\162\55\x6e\165\155\142\x65\162" => $jk, "\157\x72\144\145\x72\55\x73\x74\141\164\x75\x73" => $Y8);
        $hQ = apply_filters("\x6d\x6f\x5f\167\143\137\141\144\155\151\x6e\137\157\162\x64\x65\x72\137\x6e\x6f\164\151\146\137\163\x74\162\x69\x6e\x67\x5f\162\x65\160\154\x61\143\145", $hQ);
        $D2 = MoUtility::replaceString($hQ, $this->smsBody);
        if (!MoUtility::isBlank($iR)) {
            goto Vd;
        }
        return;
        Vd:
        foreach ($iR as $mF) {
            MoUtility::send_phone_notif($mF, $D2);
            Rp:
        }
        uP:
    }
}
