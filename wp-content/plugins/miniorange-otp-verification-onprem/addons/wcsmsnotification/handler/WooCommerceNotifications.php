<?php


namespace OTP\Addons\WcSMSNotification\Handler;

use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnUtility;
use OTP\Addons\WcSMSNotification\Helper\WcOrderStatus;
use OTP\Addons\WcSMSNotification\Helper\WooCommerceNotificationsList;
use OTP\Helper\MoConstants;
use OTP\Helper\MoUtility;
use OTP\Objects\BaseAddOnHandler;
use OTP\Objects\SMSNotification;
use OTP\Traits\Instance;
use WC_Emails;
use WC_Order;
class WooCommerceNotifications extends BaseAddOnHandler
{
    use Instance;
    private $notificationSettings;
    function __construct()
    {
        parent::__construct();
        if ($this->moAddOnV()) {
            goto cz;
        }
        return;
        cz:
        $this->notificationSettings = get_wc_option("\x6e\157\164\151\146\151\143\141\164\151\x6f\x6e\137\163\x65\164\164\x69\156\x67\x73") ? get_wc_option("\156\157\x74\151\x66\x69\143\x61\x74\151\157\x6e\137\163\x65\164\164\x69\x6e\x67\x73") : WooCommerceNotificationsList::instance();
        add_action("\x77\x6f\157\143\x6f\x6d\x6d\x65\x72\143\x65\x5f\x63\162\145\141\164\145\144\137\143\x75\x73\164\157\155\145\x72\137\156\x6f\164\x69\146\x69\x63\141\x74\151\x6f\x6e", array($this, "\155\x6f\x5f\x73\x65\156\144\x5f\x6e\145\167\137\143\x75\163\164\157\x6d\145\162\x5f\x73\x6d\x73\x5f\x6e\x6f\x74\x69\146"), 1, 3);
        add_action("\x77\x6f\157\x63\x6f\x6d\x6d\145\x72\x63\145\x5f\x6e\145\x77\137\x63\165\163\164\x6f\x6d\145\162\x5f\156\157\164\145\x5f\x6e\157\164\151\146\x69\x63\x61\x74\151\x6f\156", array($this, "\x6d\x6f\x5f\163\x65\x6e\x64\x5f\156\x65\167\137\x63\165\x73\164\157\155\x65\x72\x5f\163\x6d\163\x5f\x6e\x6f\x74\145"), 1, 1);
        add_action("\x77\157\x6f\x63\x6f\x6d\x6d\x65\162\143\x65\x5f\x6f\x72\144\145\162\x5f\x73\164\141\164\165\x73\137\143\150\x61\x6e\x67\x65\144", array($this, "\155\x6f\x5f\163\145\x6e\144\137\141\144\x6d\151\156\x5f\157\162\144\145\162\x5f\x73\155\x73\137\x6e\x6f\x74\151\146"), 1, 3);
        add_action("\167\x6f\157\143\x6f\x6d\155\x65\162\143\x65\137\x6f\x72\x64\145\162\137\x73\164\141\164\165\x73\x5f\x63\150\x61\156\147\x65\144", array($this, "\155\157\137\143\x75\x73\x74\x6f\155\145\162\x5f\157\162\144\145\162\x5f\150\157\x6c\144\x5f\163\155\x73\137\x6e\x6f\x74\x69\x66"), 1, 3);
        add_action("\x61\144\x64\x5f\155\145\164\x61\137\x62\157\x78\x65\x73", array($this, "\141\144\x64\x5f\143\165\163\x74\157\x6d\x5f\x6d\163\x67\x5f\155\x65\x74\141\x5f\x62\157\x78"), 1);
        add_action("\141\x64\155\x69\x6e\137\151\156\x69\x74", array($this, "\137\x68\x61\x6e\144\x6c\x65\x5f\x61\144\x6d\x69\x6e\137\x61\143\164\x69\x6f\x6e\x73"));
    }
    function _handle_admin_actions()
    {
        if (current_user_can("\155\141\156\141\147\145\x5f\157\160\164\151\157\156\x73")) {
            goto FX;
        }
        return;
        FX:
        if (!(array_key_exists("\x6f\160\x74\151\x6f\x6e", $_GET) && $_GET["\x6f\x70\x74\151\x6f\156"] == "\155\x6f\137\x73\x65\156\x64\137\157\x72\x64\x65\x72\137\x63\165\163\164\x6f\155\x5f\155\163\x67")) {
            goto uK;
        }
        $this->_send_custom_order_msg($_POST);
        uK:
    }
    function mo_send_new_customer_sms_notif($jT, $Sd = array(), $TO = false)
    {
        $this->notificationSettings->getWcNewCustomerNotif()->sendSMS(array("\x63\165\x73\164\x6f\x6d\x65\162\137\151\144" => $jT, "\x6e\x65\x77\x5f\143\x75\163\164\x6f\x6d\145\x72\x5f\x64\141\164\141" => $Sd, "\x70\x61\163\x73\167\157\x72\144\x5f\x67\145\156\145\162\x61\x74\x65\x64" => $TO));
    }
    function mo_send_new_customer_sms_note($mx)
    {
        $this->notificationSettings->getWcCustomerNoteNotif()->sendSMS(array("\x6f\162\x64\145\x72\x44\145\x74\x61\x69\x6c\x73" => wc_get_order($mx["\157\162\144\x65\162\x5f\x69\x64"])));
    }
    function mo_send_admin_order_sms_notif($kP, $sG, $Y8)
    {
        $qy = new WC_Order($kP);
        if (is_a($qy, "\x57\x43\137\x4f\x72\144\x65\x72")) {
            goto r9;
        }
        return;
        r9:
        $this->notificationSettings->getWcAdminOrderStatusNotif()->sendSMS(array("\157\x72\144\x65\162\x44\x65\164\141\151\x6c\x73" => $qy, "\156\145\167\x5f\x73\x74\x61\x74\165\163" => $Y8, "\157\154\x64\137\x73\x74\141\164\165\163" => $sG));
    }
    function mo_customer_order_hold_sms_notif($kP, $sG, $Y8)
    {
        $qy = new WC_Order($kP);
        if (is_a($qy, "\127\103\x5f\117\162\x64\145\162")) {
            goto CB;
        }
        return;
        CB:
        if (strcasecmp($Y8, WcOrderStatus::ON_HOLD) == 0) {
            goto aZ;
        }
        if (strcasecmp($Y8, WcOrderStatus::PROCESSING) == 0) {
            goto u7;
        }
        if (strcasecmp($Y8, WcOrderStatus::COMPLETED) == 0) {
            goto ds;
        }
        if (strcasecmp($Y8, WcOrderStatus::REFUNDED) == 0) {
            goto sf;
        }
        if (strcasecmp($Y8, WcOrderStatus::CANCELLED) == 0) {
            goto cT;
        }
        if (strcasecmp($Y8, WcOrderStatus::FAILED) == 0) {
            goto Jy;
        }
        if (strcasecmp($Y8, WcOrderStatus::PENDING) == 0) {
            goto xl;
        }
        goto iz;
        aZ:
        $hD = $this->notificationSettings->getWcOrderOnHoldNotif();
        goto iz;
        u7:
        $hD = $this->notificationSettings->getWcOrderProcessingNotif();
        goto iz;
        ds:
        $hD = $this->notificationSettings->getWcOrderCompletedNotif();
        goto iz;
        sf:
        $hD = $this->notificationSettings->getWcOrderRefundedNotif();
        goto iz;
        cT:
        $hD = $this->notificationSettings->getWcOrderCancelledNotif();
        goto iz;
        Jy:
        $hD = $this->notificationSettings->getWcOrderFailedNotif();
        goto iz;
        xl:
        $hD = $this->notificationSettings->getWcOrderPendingNotif();
        iz:
        $hD->sendSMS(array("\157\162\144\145\162\104\x65\164\141\151\x6c\x73" => $qy));
    }
    function unhook($nl)
    {
        $i5 = array($nl->emails["\127\x43\137\105\155\141\151\154\x5f\x4e\145\x77\137\x4f\162\x64\145\162"], "\164\x72\x69\147\x67\x65\162");
        $IC = array($nl->emails["\x57\103\137\105\155\141\151\154\x5f\103\x75\x73\x74\157\155\145\x72\x5f\x50\162\157\x63\145\163\x73\x69\156\147\137\117\162\144\145\x72"], "\164\162\151\147\x67\x65\162");
        $BG = array($nl->emails["\x57\x43\137\105\155\x61\151\x6c\137\x43\165\x73\164\x6f\155\145\x72\137\103\x6f\155\160\154\145\x74\x65\144\137\x4f\x72\x64\x65\x72"], "\x74\162\x69\x67\x67\x65\x72");
        $BU = array($nl->emails["\x57\103\137\x45\155\x61\x69\x6c\137\103\x75\163\x74\157\155\x65\162\x5f\116\157\x74\x65"], "\164\162\151\x67\147\x65\x72");
        remove_action("\x77\157\157\x63\157\x6d\x6d\x65\x72\143\x65\x5f\x6c\x6f\x77\x5f\163\x74\x6f\x63\x6b\x5f\x6e\157\x74\151\x66\x69\x63\141\164\x69\x6f\156", array($nl, "\154\157\x77\x5f\163\164\x6f\143\153"));
        remove_action("\x77\157\x6f\143\157\155\x6d\x65\162\x63\x65\x5f\156\157\137\163\164\x6f\x63\153\137\156\157\x74\x69\x66\x69\143\x61\164\151\157\156", array($nl, "\x6e\x6f\x5f\163\x74\157\x63\153"));
        remove_action("\167\x6f\157\143\157\x6d\155\x65\162\x63\x65\137\160\x72\x6f\x64\165\143\x74\x5f\x6f\156\137\x62\141\143\x6b\157\x72\x64\145\x72\x5f\156\157\164\151\146\x69\143\141\x74\x69\x6f\x6e", array($nl, "\142\x61\x63\153\157\162\x64\x65\x72"));
        remove_action("\x77\157\x6f\143\157\x6d\155\x65\x72\143\x65\x5f\157\162\144\x65\162\x5f\x73\x74\x61\164\165\x73\137\160\x65\156\x64\151\156\147\137\164\157\137\160\162\x6f\143\x65\163\163\x69\156\147\137\x6e\157\x74\x69\x66\x69\x63\141\x74\x69\157\x6e", $i5);
        remove_action("\x77\x6f\x6f\143\157\155\x6d\145\x72\143\x65\x5f\x6f\x72\144\x65\162\137\163\x74\141\164\165\x73\x5f\x70\x65\x6e\144\x69\x6e\x67\137\x74\x6f\137\x63\x6f\155\160\x6c\145\164\x65\144\x5f\156\157\164\151\x66\x69\143\x61\x74\151\x6f\x6e", $i5);
        remove_action("\x77\157\x6f\143\157\155\x6d\x65\162\x63\145\137\x6f\162\144\x65\162\137\x73\x74\x61\x74\165\163\x5f\x70\145\156\144\x69\156\147\x5f\164\x6f\137\157\x6e\55\x68\x6f\x6c\x64\137\x6e\x6f\164\x69\146\x69\x63\x61\164\x69\157\156", $i5);
        remove_action("\x77\157\x6f\143\x6f\x6d\155\145\162\143\145\x5f\x6f\x72\x64\145\162\x5f\x73\x74\141\x74\165\x73\137\x66\x61\151\154\x65\x64\137\x74\157\x5f\160\162\157\x63\145\163\x73\x69\x6e\x67\x5f\x6e\x6f\x74\151\x66\151\143\141\164\x69\x6f\x6e", $i5);
        remove_action("\x77\157\x6f\143\157\x6d\x6d\x65\162\143\145\137\x6f\162\x64\x65\x72\137\x73\x74\x61\164\165\163\137\146\141\x69\154\x65\x64\x5f\164\157\x5f\x63\x6f\x6d\x70\x6c\x65\164\x65\144\137\156\x6f\x74\x69\x66\x69\143\141\x74\151\x6f\x6e", $i5);
        remove_action("\167\157\x6f\x63\157\155\155\x65\162\x63\145\137\157\x72\x64\x65\x72\137\163\x74\x61\x74\x75\x73\x5f\x66\141\151\x6c\x65\144\x5f\164\x6f\x5f\x6f\156\x2d\x68\157\x6c\x64\137\156\x6f\164\151\x66\151\143\x61\x74\x69\x6f\156", $i5);
        remove_action("\x77\157\157\143\157\155\155\x65\x72\143\x65\137\x6f\x72\x64\145\x72\137\x73\164\141\x74\x75\163\137\160\x65\x6e\144\x69\156\147\137\x74\x6f\x5f\160\162\157\143\145\x73\163\x69\156\x67\137\156\157\164\x69\146\x69\143\x61\x74\151\x6f\x6e", $IC);
        remove_action("\x77\157\157\x63\x6f\x6d\155\145\x72\143\x65\137\157\x72\144\145\x72\137\163\164\141\x74\x75\x73\x5f\160\145\x6e\144\x69\x6e\x67\137\164\x6f\137\157\156\x2d\150\157\x6c\144\x5f\x6e\x6f\164\x69\146\151\x63\x61\164\151\x6f\x6e", $IC);
        remove_action("\x77\157\157\x63\157\x6d\155\145\162\143\145\x5f\157\x72\x64\145\162\x5f\163\x74\x61\164\x75\x73\137\x63\157\155\160\x6c\145\x74\x65\144\x5f\x6e\157\x74\x69\146\151\143\x61\x74\x69\157\156", $BG);
        remove_action("\x77\x6f\x6f\143\157\x6d\155\x65\x72\143\x65\137\156\x65\x77\137\143\x75\x73\164\x6f\x6d\145\x72\x5f\156\x6f\x74\145\137\156\x6f\x74\x69\x66\x69\143\141\x74\x69\x6f\156", $BU);
    }
    function add_custom_msg_meta_box()
    {
        add_meta_box("\155\157\x5f\x77\x63\137\143\x75\x73\x74\x6f\155\137\163\155\x73\x5f\x6d\145\164\141\x5f\x62\157\x78", "\x43\x75\x73\x74\x6f\x6d\x20\123\x4d\x53", array($this, "\x6d\157\137\x73\150\x6f\167\x5f\163\x65\x6e\x64\137\x63\165\x73\164\157\x6d\x5f\x6d\163\147\x5f\x62\157\x78"), "\163\x68\x6f\x70\x5f\157\x72\144\x65\162", "\x73\151\x64\x65", "\x64\x65\x66\141\x75\154\164");
    }
    function mo_show_send_custom_msg_box($Jf)
    {
        $KO = new WC_Order($Jf->ID);
        $bi = MoWcAddOnUtility::getCustomerNumberFromOrder($KO);
        include MSN_DIR . "\166\x69\x65\167\163\x2f\143\x75\163\164\157\x6d\55\157\162\x64\x65\162\x2d\155\163\x67\x2e\x70\150\x70";
    }
    function _send_custom_order_msg($sa)
    {
        if (!array_key_exists("\156\165\x6d\142\145\162\x73", $sa) || MoUtility::isBlank($sa["\156\165\x6d\142\145\x72\x73"])) {
            goto R3;
        }
        foreach (explode("\x3b", $sa["\x6e\x75\x6d\x62\x65\x72\x73"]) as $cf) {
            if (MoUtility::send_phone_notif($cf, $sa["\155\x73\x67"])) {
                goto HV;
            }
            wp_send_json(MoUtility::createJson(MoWcAddOnMessages::showMessage(MoWcAddOnMessages::ERROR_SENDING_SMS), MoConstants::ERROR_JSON_TYPE));
            goto lH;
            HV:
            wp_send_json(MoUtility::createJson(MoWcAddOnMessages::showMessage(MoWcAddOnMessages::SMS_SENT_SUCCESS), MoConstants::SUCCESS_JSON_TYPE));
            lH:
            po:
        }
        AQ:
        goto jW;
        R3:
        MoUtility::createJson(MoWcAddOnMessages::showMessage(MoWcAddOnMessages::INVALID_PHONE), MoConstants::ERROR_JSON_TYPE);
        jW:
    }
    function setAddonKey()
    {
        $this->_addOnKey = "\167\143\x5f\x73\x6d\163\x5f\156\x6f\164\151\x66\151\x63\x61\x74\x69\157\x6e\x5f\141\x64\x64\x6f\156";
    }
    function setAddOnDesc()
    {
        $this->_addOnDesc = mo_("\101\x6c\154\x6f\x77\x73\x20\171\x6f\165\162\40\x73\151\x74\145\40\x74\157\x20\163\x65\x6e\144\40\x6f\x72\x64\x65\162\x20\x61\156\x64\40\127\157\x6f\103\157\155\155\145\162\x63\x65\x20\156\x6f\x74\151\146\151\143\141\x74\x69\157\156\163\x20\164\x6f\40\142\x75\x79\145\162\x73\x2c\x20" . "\163\145\154\154\x65\x72\163\40\141\156\144\40\141\x64\155\151\156\x73\56\40\103\x6c\151\x63\x6b\40\x6f\x6e\40\164\150\145\40\163\145\x74\164\151\x6e\147\x73\40\x62\x75\164\164\157\156\40\164\157\40\164\x68\145\x20\162\x69\147\x68\164\40\x74\x6f\40\163\145\x65\40\164\150\145\x20\x6c\x69\163\164\40\x6f\x66\40\x6e\157\164\x69\146\151\x63\141\x74\x69\x6f\156\163\x20" . "\164\x68\141\x74\x20\x67\x6f\x20\157\x75\x74\56");
    }
    function setAddOnName()
    {
        $this->_addOnName = mo_("\x57\157\x6f\103\157\x6d\x6d\145\x72\x63\x65\x20\x53\115\x53\x20\116\157\164\x69\x66\x69\x63\141\x74\x69\x6f\x6e");
    }
    function setSettingsUrl()
    {
        $this->_settingsUrl = add_query_arg(array("\141\144\x64\157\156" => "\167\x6f\x6f\x63\157\x6d\155\145\162\x63\145\137\156\x6f\164\x69\x66"), $_SERVER["\122\x45\121\125\x45\123\x54\137\125\122\111"]);
    }
}
