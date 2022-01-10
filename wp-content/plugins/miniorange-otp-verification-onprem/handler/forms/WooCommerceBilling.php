<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\BaseMessages;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
class WooCommerceBilling extends FormHandler implements IFormHandler
{
    use Instance;
    function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::WC_BILLING;
        $this->_typePhoneTag = "\155\157\137\167\143\x62\x5f\160\x68\157\156\x65\137\145\x6e\141\142\x6c\x65";
        $this->_typeEmailTag = "\155\157\x5f\x77\143\142\137\x65\x6d\x61\x69\154\137\x65\156\141\x62\154\145";
        $this->_phoneFormId = "\43\x62\x69\154\154\x69\156\147\137\x70\150\x6f\156\145";
        $this->_formKey = "\x57\x43\x5f\x42\111\x4c\114\111\x4e\x47\x5f\106\x4f\x52\x4d";
        $this->_formName = mo_("\x57\157\x6f\x63\x6f\155\155\x65\162\143\145\40\x42\151\x6c\x6c\x69\156\x67\x20\101\144\144\162\x65\163\x73\x20\106\157\x72\x6d");
        $this->_isFormEnabled = get_mo_option("\x77\143\137\142\x69\154\154\151\x6e\x67\x5f\145\x6e\x61\x62\x6c\145");
        $this->_buttonText = get_mo_option("\167\x63\x5f\142\151\x6c\x6c\x69\156\x67\137\x62\x75\164\x74\157\156\x5f\x74\145\x78\164");
        $this->_buttonText = !MoUtility::isBlank($this->_buttonText) ? $this->_buttonText : mo_("\103\154\151\x63\x6b\x20\x48\x65\162\145\x20\164\x6f\40\163\x65\156\x64\x20\117\124\x50");
        $this->_formDocuments = MoOTPDocs::WC_BILLING_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_restrictDuplicates = get_mo_option("\167\143\x5f\x62\151\154\x6c\x69\x6e\x67\x5f\x72\x65\163\164\162\x69\x63\164\x5f\x64\x75\160\x6c\151\x63\141\x74\145\x73");
        $this->_otpType = get_mo_option("\167\143\137\142\151\154\154\x69\156\147\137\x74\171\x70\x65\x5f\x65\x6e\x61\x62\x6c\x65\x64");
        if ($this->_otpType === $this->_typeEmailTag) {
            goto pQ;
        }
        add_filter("\167\157\157\143\x6f\155\x6d\145\162\143\x65\x5f\160\x72\x6f\143\145\163\163\137\x6d\x79\141\x63\x63\x6f\165\x6e\164\137\146\151\145\154\144\x5f\x62\x69\x6c\154\151\x6e\x67\x5f\160\150\157\156\145", array($this, "\x5f\167\143\137\165\163\x65\x72\x5f\141\143\x63\x6f\x75\x6e\x74\137\x75\x70\144\x61\164\x65"), 99, 1);
        goto au;
        pQ:
        add_filter("\x77\x6f\x6f\143\x6f\x6d\155\x65\x72\143\x65\137\160\162\157\143\145\163\x73\x5f\155\x79\x61\143\x63\x6f\x75\x6e\x74\x5f\x66\x69\x65\154\144\x5f\x62\x69\154\x6c\151\156\x67\137\145\x6d\x61\x69\154", array($this, "\x5f\x77\143\137\165\163\145\x72\x5f\x61\143\143\x6f\165\x6e\x74\137\x75\160\144\141\x74\145"), 99, 1);
        au:
    }
    function _wc_user_account_update($sA)
    {
        $sA = $this->_otpType === $this->_typePhoneTag ? MoUtility::processPhoneNumber($sA) : $sA;
        $WP = $this->getVerificationType();
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $WP)) {
            goto uT;
        }
        $this->unsetOTPSessionVariables();
        return $sA;
        uT:
        if (!$this->userHasNotChangeData($sA)) {
            goto u1;
        }
        return $sA;
        u1:
        if (!($this->_restrictDuplicates && $this->isDuplicate($sA, $WP))) {
            goto DT;
        }
        return $sA;
        DT:
        MoUtility::initialize_transaction($this->_formSessionVar);
        $this->sendChallenge(null, $_POST["\x62\x69\154\154\151\156\147\x5f\145\155\x61\x69\154"], null, $_POST["\142\x69\154\x6c\x69\x6e\x67\x5f\160\x68\x6f\156\145"], $WP);
        return $sA;
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        $Jw = $this->getVerificationType();
        $aG = $Jw === VerificationType::BOTH ? TRUE : FALSE;
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $Jw, $aG);
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
    }
    private function userHasNotChangeData($sA)
    {
        $Jf = $this->getUserData();
        return strcasecmp($Jf, $sA) == 0;
    }
    private function getUserData()
    {
        global $wpdb;
        $current_user = wp_get_current_user();
        $xl = $this->_otpType === $this->_typePhoneTag ? "\x62\151\x6c\x6c\x69\x6e\147\x5f\160\x68\x6f\x6e\x65" : "\x62\x69\x6c\154\x69\x6e\147\137\x65\155\x61\151\154";
        $yp = "\123\105\114\105\103\x54\40\155\x65\x74\x61\137\x76\x61\154\165\145\x20\x46\x52\117\115\40\140{$wpdb->prefix}\x75\163\x65\x72\155\x65\164\141\x60\x20\127\x48\105\122\105\40\140\x6d\x65\x74\141\137\x6b\145\171\x60\x20\75\x20\47{$xl}\47\40\x41\116\104\40\x60\x75\163\x65\162\x5f\151\x64\140\40\75\40{$current_user->ID}";
        $D5 = $wpdb->get_row($yp);
        return isset($D5) ? $D5->meta_value : '';
    }
    private function isDuplicate($sA, $WP)
    {
        global $wpdb;
        $xl = "\142\151\x6c\x6c\x69\156\147\137" . $WP;
        $D5 = $wpdb->get_row("\x53\105\x4c\x45\x43\x54\40\140\x75\x73\145\162\137\151\x64\140\40\x46\x52\117\115\40\x60{$wpdb->prefix}\x75\x73\145\x72\x6d\145\x74\x61\140\40\127\110\105\x52\105\40\140\155\x65\x74\x61\137\x6b\145\x79\140\40\75\40\x27{$xl}\x27\x20\x41\x4e\104\40\140\x6d\x65\x74\x61\x5f\x76\141\x6c\x75\145\140\x20\x3d\40\x20\47{$sA}\x27");
        if (!isset($D5)) {
            goto VG;
        }
        if ($WP === VerificationType::PHONE) {
            goto yK;
        }
        if (!($WP === VerificationType::EMAIL)) {
            goto MQ;
        }
        wc_add_notice(MoMessages::showMessage(MoMessages::EMAIL_EXISTS), MoConstants::ERROR_JSON_TYPE);
        MQ:
        goto yz;
        yK:
        wc_add_notice(MoMessages::showMessage(MoMessages::PHONE_EXISTS), MoConstants::ERROR_JSON_TYPE);
        yz:
        return TRUE;
        VG:
        return FALSE;
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->_isFormEnabled && $this->_otpType == $this->_typePhoneTag)) {
            goto MG;
        }
        array_push($lP, $this->_phoneFormId);
        MG:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto Tz;
        }
        return;
        Tz:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x77\143\x5f\142\x69\x6c\x6c\151\156\x67\x5f\x65\156\141\142\x6c\x65");
        $this->_otpType = $this->sanitizeFormPOST("\x77\x63\137\x62\151\154\x6c\x69\156\147\137\x74\x79\160\x65\137\145\156\141\142\x6c\x65\144");
        $this->_restrictDuplicates = $this->sanitizeFormPOST("\167\143\x5f\x62\151\154\154\151\156\147\137\162\145\x73\164\162\x69\143\x74\137\144\165\160\154\x69\x63\x61\164\x65\x73");
        if (!$this->basicValidationCheck(BaseMessages::WC_BILLING_CHOOSE)) {
            goto XX;
        }
        update_mo_option("\167\x63\x5f\142\151\154\154\x69\156\147\137\145\x6e\x61\142\154\x65", $this->_isFormEnabled);
        update_mo_option("\167\143\137\142\x69\154\154\x69\156\147\137\164\x79\160\145\x5f\145\x6e\x61\142\154\145\144", $this->_otpType);
        update_mo_option("\167\x63\x5f\142\151\x6c\x6c\151\x6e\147\137\x72\x65\x73\164\162\151\x63\164\x5f\144\165\x70\x6c\x69\143\141\x74\x65\163", $this->_restrictDuplicates);
        XX:
    }
}
