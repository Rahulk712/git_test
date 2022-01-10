<?php


namespace OTP\Addons\WcSMSNotification\Helper\Notifications;

use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Helper\MoUtility;
use OTP\Objects\SMSNotification;
class WooCommerceNewCustomerNotification extends SMSNotification
{
    public static $instance;
    function __construct()
    {
        parent::__construct();
        $this->title = "\x4e\x65\167\40\x41\143\x63\x6f\x75\x6e\x74";
        $this->page = "\167\x63\x5f\x6e\145\167\x5f\x63\165\x73\164\157\155\x65\x72\x5f\x6e\x6f\x74\151\x66";
        $this->isEnabled = FALSE;
        $this->tooltipHeader = "\116\x45\127\x5f\x43\125\123\x54\x4f\x4d\x45\122\137\116\117\124\x49\x46\137\x48\x45\101\104\x45\x52";
        $this->tooltipBody = "\x4e\105\x57\137\103\125\x53\x54\x4f\x4d\x45\122\137\116\117\x54\x49\106\x5f\102\117\104\131";
        $this->recipient = "\x63\165\163\164\157\155\145\162";
        $this->smsBody = get_wc_option("\167\157\157\x63\x6f\x6d\155\145\x72\143\145\x5f\x72\x65\147\x69\x73\x74\162\141\164\x69\x6f\156\137\x67\x65\156\x65\x72\141\x74\145\x5f\160\x61\x73\x73\x77\x6f\162\x64", '') === "\171\x65\x73" ? MoWcAddOnMessages::showMessage(MoWcAddOnMessages::NEW_CUSTOMER_SMS_WITH_PASS) : MoWcAddOnMessages::showMessage(MoWcAddOnMessages::NEW_CUSTOMER_SMS);
        $this->defaultSmsBody = get_wc_option("\167\157\x6f\x63\x6f\155\155\145\162\143\145\x5f\x72\145\147\x69\163\164\162\x61\164\151\x6f\x6e\x5f\147\x65\x6e\x65\162\x61\164\x65\x5f\x70\141\x73\x73\167\x6f\162\x64", '') === "\171\145\163" ? MoWcAddOnMessages::showMessage(MoWcAddOnMessages::NEW_CUSTOMER_SMS_WITH_PASS) : MoWcAddOnMessages::showMessage(MoWcAddOnMessages::NEW_CUSTOMER_SMS);
        $this->availableTags = "\173\x73\151\164\145\x2d\x6e\141\155\x65\x7d\x2c\x7b\165\163\145\162\156\x61\155\x65\175\54\173\160\x61\x73\x73\x77\157\162\x64\x7d\x2c\x7b\x61\143\143\x6f\x75\x6e\x74\160\x61\147\x65\55\165\162\154\175";
        $this->pageHeader = mo_("\116\105\127\x20\101\x43\x43\x4f\125\x4e\124\40\116\x4f\124\x49\x46\111\x43\x41\124\x49\117\x4e\x20\x53\105\x54\x54\111\116\107\x53");
        $this->pageDescription = mo_("\x53\x4d\123\x20\156\157\x74\151\x66\x69\143\x61\x74\x69\x6f\156\163\x20\x73\145\x74\x74\151\x6e\x67\x73\x20\146\157\x72\40\x4e\145\x77\x20\x41\x63\143\157\x75\x6e\164\40\x63\162\x65\x61\x74\151\x6f\156\40\x53\115\123\x20\x73\x65\x6e\164\x20\164\157\x20\x74\x68\x65\x20\165\163\145\162\163");
        $this->notificationType = mo_("\103\165\x73\x74\x6f\x6d\145\162");
        self::$instance = $this;
    }
    public static function getInstance()
    {
        return self::$instance === null ? new self() : self::$instance;
    }
    function sendSMS(array $mx)
    {
        if ($this->isEnabled) {
            goto eD;
        }
        return;
        eD:
        $jT = $mx["\x63\x75\x73\x74\x6f\155\x65\162\x5f\x69\x64"];
        $vo = $mx["\x6e\145\167\x5f\143\165\163\x74\157\x6d\145\x72\137\144\141\x74\x61"];
        $VI = get_bloginfo();
        $Iv = get_userdata($jT)->user_login;
        $mF = get_user_meta($jT, "\142\151\154\154\x69\x6e\147\x5f\160\x68\x6f\x6e\x65", TRUE);
        $ap = MoUtility::sanitizeCheck("\142\x69\x6c\154\x69\x6e\147\137\x70\150\157\156\x65", $_POST);
        $mF = MoUtility::isBlank($mF) && $ap ? $ap : $mF;
        $wh = !empty($vo["\x75\163\145\162\137\x70\x61\x73\x73"]) ? $vo["\165\x73\x65\162\137\x70\141\x73\163"] : '';
        $C_ = wc_get_page_permalink("\155\x79\141\x63\143\157\x75\x6e\x74");
        $hQ = array("\x73\151\164\145\55\x6e\141\155\145" => get_bloginfo(), "\x75\163\x65\162\156\x61\155\x65" => $Iv, "\x70\x61\163\x73\167\157\162\144" => $wh, "\141\143\x63\157\165\x6e\x74\160\141\147\145\x2d\x75\x72\154" => $C_);
        $hQ = apply_filters("\x6d\x6f\x5f\x77\143\137\156\x65\167\137\143\165\x73\x74\157\155\x65\x72\137\156\157\164\x69\146\137\163\x74\162\x69\156\x67\137\x72\145\160\154\141\x63\145", $hQ);
        $D2 = MoUtility::replaceString($hQ, $this->smsBody);
        if (!MoUtility::isBlank($mF)) {
            goto KA;
        }
        return;
        KA:
        MoUtility::send_phone_notif($mF, $D2);
    }
}
