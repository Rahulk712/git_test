<?php


namespace OTP\Addons\CustomMessage\Handler;

use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;
use OTP\Objects\BaseAddOnHandler;
use OTP\Objects\BaseMessages;
use OTP\Traits\Instance;
class CustomMessages extends BaseAddOnHandler
{
    use Instance;
    public $_adminActions = array("\155\157\x5f\143\x75\163\164\x6f\155\x65\162\137\166\141\154\x69\x64\141\x74\151\157\x6e\x5f\x61\x64\x6d\151\156\x5f\x63\165\163\164\157\x6d\137\160\x68\157\156\x65\x5f\156\x6f\164\x69\x66" => "\x5f\x6d\157\137\x76\x61\154\151\x64\141\x74\x69\157\x6e\x5f\x73\x65\x6e\x64\137\163\155\163\x5f\156\x6f\164\151\146\137\x6d\x73\147", "\x6d\157\x5f\143\x75\163\x74\157\x6d\x65\162\x5f\x76\141\x6c\x69\x64\x61\164\x69\x6f\x6e\x5f\x61\x64\155\151\156\137\x63\165\x73\164\x6f\x6d\137\x65\x6d\x61\151\x6c\x5f\x6e\157\x74\x69\146" => "\x5f\x6d\x6f\x5f\x76\141\x6c\x69\x64\141\x74\x69\x6f\x6e\x5f\x73\145\x6e\x64\x5f\145\155\x61\151\154\x5f\x6e\x6f\x74\151\146\x5f\155\x73\147");
    function __construct()
    {
        parent::__construct();
        $this->_nonce = "\x6d\157\137\141\144\155\x69\156\x5f\141\x63\x74\151\157\x6e\x73";
        if ($this->moAddOnV()) {
            goto P1;
        }
        return;
        P1:
        foreach ($this->_adminActions as $bW => $e0) {
            add_action("\x77\x70\137\x61\152\x61\170\137{$bW}", array($this, $e0));
            add_action("\141\x64\x6d\x69\x6e\x5f\x70\x6f\163\x74\137{$bW}", array($this, $e0));
            X4:
        }
        O6:
    }
    public function _mo_validation_send_sms_notif_msg()
    {
        $wQ = MoUtility::sanitizeCheck("\x61\x6a\x61\x78\x5f\155\x6f\144\x65", $_POST);
        $wQ ? $this->isValidAjaxRequest("\163\x65\x63\x75\x72\x69\164\x79") : $this->isValidRequest();
        $bi = explode("\73", $_POST["\155\157\137\160\x68\157\156\145\137\x6e\x75\x6d\x62\x65\162\163"]);
        $bJ = $_POST["\155\157\137\143\165\x73\164\157\x6d\145\x72\137\x76\x61\x6c\x69\x64\141\164\151\x6f\x6e\137\x63\x75\163\164\x6f\x6d\137\x73\155\x73\137\x6d\x73\147"];
        $zv = null;
        foreach ($bi as $lr) {
            $zv = MoUtility::send_phone_notif($lr, $bJ);
            ku:
        }
        Hj:
        $wQ ? $this->checkStatusAndSendJSON($zv) : $this->checkStatusAndShowMessage($zv);
    }
    public function _mo_validation_send_email_notif_msg()
    {
        $wQ = MoUtility::sanitizeCheck("\141\x6a\141\170\x5f\x6d\x6f\x64\x65", $_POST);
        $wQ ? $this->isValidAjaxRequest("\x73\x65\x63\165\x72\151\x74\x79") : $this->isValidRequest();
        $cX = explode("\x3b", $_POST["\164\157\x45\x6d\x61\151\154"]);
        $zv = null;
        foreach ($cX as $xX) {
            $zv = MoUtility::send_email_notif($_POST["\x66\162\157\x6d\x45\155\141\151\154"], $_POST["\x66\x72\x6f\155\x4e\141\x6d\145"], $xX, $_POST["\163\x75\x62\x6a\x65\143\164"], stripslashes($_POST["\143\x6f\x6e\x74\145\x6e\164"]));
            Yp:
        }
        sc:
        $wQ ? $this->checkStatusAndSendJSON($zv) : $this->checkStatusAndShowMessage($zv);
    }
    private function checkStatusAndShowMessage($zv)
    {
        if (!is_null($zv)) {
            goto eF;
        }
        return;
        eF:
        $Vh = $zv ? MoMessages::showMessage(BaseMessages::CUSTOM_MSG_SENT) : MoMessages::showMessage(BaseMessages::CUSTOM_MSG_SENT_FAIL);
        $dd = $zv ? MoConstants::SUCCESS : MoConstants::ERROR;
        do_action("\x6d\x6f\137\x72\145\x67\x69\x73\x74\x72\141\x74\x69\x6f\156\137\x73\150\157\167\x5f\x6d\x65\x73\x73\141\147\x65", $Vh, $dd);
        wp_safe_redirect(wp_get_referer());
    }
    private function checkStatusAndSendJSON($zv)
    {
        if (!is_null($zv)) {
            goto Mk;
        }
        return;
        Mk:
        if ($zv) {
            goto WG;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(BaseMessages::CUSTOM_MSG_SENT_FAIL), MoConstants::ERROR_JSON_TYPE));
        goto Wu;
        WG:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(BaseMessages::CUSTOM_MSG_SENT), MoConstants::SUCCESS_JSON_TYPE));
        Wu:
    }
    function setAddonKey()
    {
        $this->_addOnKey = "\143\165\x73\164\157\x6d\x5f\155\x65\163\x73\141\x67\145\x73\x5f\x61\x64\144\x6f\x6e";
    }
    function setAddOnDesc()
    {
        $this->_addOnDesc = mo_("\x53\x65\156\144\x20\103\x75\x73\164\x6f\155\x69\x7a\145\x64\x20\155\x65\163\x73\141\147\x65\x20\x74\x6f\x20\x61\x6e\x79\40\160\150\157\156\145\40\157\162\x20\145\155\141\x69\154\x20\x64\151\x72\145\x63\164\154\x79\40\x66\162\157\x6d\40\x74\x68\x65\x20\x64\141\x73\x68\x62\157\141\162\144\56");
    }
    function setAddOnName()
    {
        $this->_addOnName = mo_("\103\x75\x73\164\157\155\40\115\145\163\163\x61\147\145\163");
    }
    function setSettingsUrl()
    {
        $this->_settingsUrl = add_query_arg(array("\141\144\144\157\156" => "\x63\x75\163\164\157\155"), $_SERVER["\122\105\121\x55\x45\x53\x54\137\x55\122\x49"]);
    }
}
