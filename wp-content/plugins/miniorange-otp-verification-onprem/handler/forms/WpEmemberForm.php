<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
use WP_Error;
class WpEmemberForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::EMEMBER;
        $this->_typePhoneTag = "\x6d\157\x5f\145\155\145\155\142\145\162\137\x70\150\157\156\145\137\x65\x6e\x61\x62\154\x65";
        $this->_typeEmailTag = "\x6d\x6f\137\145\155\x65\x6d\142\145\162\137\145\x6d\x61\151\154\137\x65\156\141\x62\x6c\x65";
        $this->_typeBothTag = "\x6d\157\x5f\x65\155\x65\155\142\x65\x72\x5f\142\x6f\x74\x68\x5f\145\x6e\141\x62\154\145";
        $this->_formKey = "\x57\120\x5f\x45\x4d\x45\x4d\x42\105\122";
        $this->_formName = mo_("\127\x50\40\x65\x4d\x65\155\142\x65\x72");
        $this->_isFormEnabled = get_mo_option("\x65\x6d\145\x6d\x62\145\x72\x5f\x64\145\x66\141\165\x6c\x74\137\145\x6e\141\x62\x6c\145");
        $this->_phoneKey = "\167\x70\x5f\145\155\145\155\x62\x65\162\137\160\150\157\x6e\x65";
        $this->_phoneFormId = "\151\156\x70\x75\x74\133\x6e\x61\155\145\75" . $this->_phoneKey . "\x5d";
        $this->_formDocuments = MoOTPDocs::EMEMBER_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\145\155\x65\155\x62\145\162\x5f\145\156\x61\x62\154\x65\x5f\164\171\160\145");
        if (!(array_key_exists("\145\155\x65\x6d\x62\x65\x72\137\x64\x73\x63\x5f\x6e\x6f\x6e\143\x65", $_POST) && !array_key_exists("\x6f\x70\164\x69\x6f\x6e", $_POST))) {
            goto HE;
        }
        $this->miniorange_emember_user_registration();
        HE:
    }
    function isPhoneVerificationEnabled()
    {
        $m5 = $this->getVerificationType();
        return $m5 === VerificationType::PHONE || $m5 === VerificationType::BOTH;
    }
    function miniorange_emember_user_registration()
    {
        if (!$this->validatePostFields()) {
            goto t5;
        }
        $lr = array_key_exists($this->_phoneKey, $_POST) ? $_POST[$this->_phoneKey] : NULL;
        $this->startTheOTPVerificationProcess($_POST["\x77\160\137\145\x6d\145\x6d\142\x65\162\137\x75\163\x65\162\137\x6e\141\155\145"], $_POST["\x77\160\x5f\145\x6d\145\155\x62\x65\162\137\x65\155\141\x69\154"], $lr);
        t5:
    }
    function startTheOTPVerificationProcess($Iv, $I4, $lr)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        $errors = new WP_Error();
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) === 0) {
            goto kr;
        }
        if (strcasecmp($this->_otpType, $this->_typeBothTag) === 0) {
            goto Uc;
        }
        $this->sendChallenge($Iv, $I4, $errors, $lr, VerificationType::EMAIL);
        goto CA;
        Uc:
        $this->sendChallenge($Iv, $I4, $errors, $lr, VerificationType::BOTH);
        CA:
        goto pX;
        kr:
        $this->sendChallenge($Iv, $I4, $errors, $lr, VerificationType::PHONE);
        pX:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        $Jw = $this->getVerificationType();
        $aG = $Jw === VerificationType::BOTH ? TRUE : FALSE;
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $Jw, $aG);
    }
    function validatePostFields()
    {
        if (!is_blocked_ip(get_real_ip_addr())) {
            goto hg;
        }
        return FALSE;
        hg:
        if (!(emember_wp_username_exists($_POST["\x77\x70\137\145\x6d\x65\x6d\x62\x65\x72\137\165\163\x65\x72\137\156\x61\155\x65"]) || emember_username_exists($_POST["\167\x70\137\145\155\145\x6d\x62\x65\162\x5f\x75\x73\x65\x72\137\156\x61\x6d\x65"]))) {
            goto TV;
        }
        return FALSE;
        TV:
        if (!(is_blocked_email($_POST["\x77\x70\x5f\145\x6d\x65\155\142\x65\x72\137\x65\155\x61\151\154"]) || emember_registered_email_exists($_POST["\x77\160\x5f\145\155\145\155\x62\145\x72\137\x65\x6d\141\151\154"]) || emember_wp_email_exists($_POST["\167\x70\137\x65\x6d\x65\x6d\x62\145\x72\137\145\x6d\141\x69\154"]))) {
            goto nx;
        }
        return FALSE;
        nx:
        if (!(isset($_POST["\145\x4d\145\x6d\x62\145\162\x5f\122\145\x67\x69\x73\164\x65\x72"]) && array_key_exists("\x77\160\x5f\x65\x6d\x65\155\x62\145\x72\x5f\x70\x77\x64\x5f\x72\x65", $_POST) && $_POST["\167\160\137\x65\155\145\155\142\x65\162\137\160\x77\144"] != $_POST["\x77\x70\x5f\145\x6d\x65\155\x62\x65\x72\x5f\160\x77\x64\x5f\162\145"])) {
            goto L9;
        }
        return FALSE;
        L9:
        return TRUE;
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        $this->unsetOTPSessionVariables();
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->isPhoneVerificationEnabled())) {
            goto e0;
        }
        array_push($lP, $this->_phoneFormId);
        e0:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto M8;
        }
        return;
        M8:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x65\x6d\x65\155\x62\145\162\137\144\145\146\x61\165\154\x74\x5f\x65\156\141\142\x6c\145");
        $this->_otpType = $this->sanitizeFormPOST("\145\155\145\155\142\x65\162\137\145\x6e\x61\142\154\145\137\x74\171\160\x65");
        update_mo_option("\x65\155\x65\x6d\x62\x65\162\137\144\x65\x66\141\x75\154\x74\137\145\x6e\141\x62\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\145\155\145\x6d\142\x65\162\137\x65\x6e\141\x62\154\145\x5f\x74\171\x70\x65", $this->_otpType);
    }
}
