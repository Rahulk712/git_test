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
use XooUserRegister;
use XooUserRegisterLite;
class UserUltraRegistrationForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::UULTRA_REG;
        $this->_typePhoneTag = "\x6d\157\137\165\165\x6c\x74\x72\141\x5f\x70\x68\157\x6e\x65\137\145\x6e\x61\x62\154\145";
        $this->_typeEmailTag = "\155\157\x5f\x75\x75\x6c\x74\x72\x61\137\145\155\x61\151\x6c\137\145\x6e\x61\x62\154\x65";
        $this->_typeBothTag = "\x6d\157\x5f\x75\x75\154\x74\162\141\137\142\x6f\x74\x68\137\145\156\x61\142\x6c\x65";
        $this->_formKey = "\x55\x55\x4c\x54\122\101\x5f\x46\117\x52\115";
        $this->_formName = mo_("\125\163\x65\162\40\125\154\x74\x72\x61\x20\x52\145\147\x69\x73\x74\x72\141\164\151\x6f\156\x20\x46\x6f\x72\155");
        $this->_isFormEnabled = get_mo_option("\165\165\x6c\164\162\x61\x5f\144\145\x66\141\165\154\x74\x5f\x65\156\x61\142\x6c\145");
        $this->_formDocuments = MoOTPDocs::UULTRA_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_phoneKey = get_mo_option("\x75\x75\x6c\x74\162\x61\x5f\x70\150\x6f\156\x65\x5f\153\145\x79");
        $this->_otpType = get_mo_option("\165\x75\154\x74\162\141\x5f\x65\x6e\141\142\x6c\145\137\x74\171\160\x65");
        $this->_phoneFormId = "\151\x6e\x70\x75\x74\133\x6e\141\x6d\x65\75" . $this->_phoneKey . "\x5d";
        $Jw = $this->getVerificationType();
        if (MoUtility::sanitizeCheck("\x78\157\157\x75\163\145\162\165\154\164\x72\141\55\162\145\147\x69\163\x74\x65\162\x2d\x66\x6f\x72\155", $_POST)) {
            goto bP;
        }
        return;
        bP:
        $lr = $this->isPhoneVerificationEnabled() ? $_POST[$this->_phoneKey] : NULL;
        $this->_handle_uultra_form_submit($_POST["\165\x73\x65\162\137\x6c\157\147\x69\156"], $_POST["\x75\163\x65\162\x5f\x65\x6d\141\x69\x6c"], $lr);
    }
    function isPhoneVerificationEnabled()
    {
        $Jw = $this->getVerificationType();
        return $Jw == VerificationType::PHONE || $Jw === VerificationType::BOTH;
    }
    function _handle_uultra_form_submit($s4, $Kc, $lr)
    {
        $Ur = class_exists("\130\157\x6f\125\x73\145\162\x52\x65\x67\151\x73\x74\x65\x72\x4c\151\x74\x65") ? new XooUserRegisterLite() : new XooUserRegister();
        if (!SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto Yg;
        }
        return;
        Yg:
        $Ur->uultra_prepare_request($_POST);
        $Ur->uultra_handle_errors();
        if (!MoUtility::isBlank($Ur->errors)) {
            goto ye;
        }
        $_POST["\x6e\157\x5f\143\x61\160\x74\x63\x68\141"] = "\171\x65\163";
        $this->_handle_otp_verification_uultra($s4, $Kc, null, $lr);
        ye:
        return;
    }
    function _handle_otp_verification_uultra($s4, $Kc, $errors, $lr)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto IA;
        }
        if (strcasecmp($this->_otpType, $this->_typeBothTag) == 0) {
            goto ft;
        }
        $this->sendChallenge($s4, $Kc, $errors, $lr, VerificationType::EMAIL);
        goto ue;
        ft:
        $this->sendChallenge($s4, $Kc, $errors, $lr, VerificationType::BOTH);
        ue:
        goto ij;
        IA:
        $this->sendChallenge($s4, $Kc, $errors, $lr, VerificationType::PHONE);
        ij:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        $Jw = $this->getVerificationType();
        $aG = $Jw === VerificationType::BOTH ? TRUE : FALSE;
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $Jw, $aG);
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
            goto Ye;
        }
        array_push($lP, $this->_phoneFormId);
        Ye:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto cl;
        }
        return;
        cl:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\165\x75\154\164\162\141\x5f\144\145\x66\141\165\x6c\x74\x5f\x65\x6e\141\142\x6c\145");
        $this->_otpType = $this->sanitizeFormPOST("\165\165\x6c\x74\x72\x61\137\145\x6e\x61\142\x6c\145\137\164\x79\160\x65");
        $this->_phoneKey = $this->sanitizeFormPOST("\165\x75\x6c\x74\162\x61\137\x70\x68\157\156\x65\x5f\x66\x69\x65\x6c\x64\137\153\x65\171");
        update_mo_option("\165\165\154\164\x72\x61\x5f\144\145\146\x61\x75\154\164\137\x65\x6e\141\142\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\165\x75\x6c\164\x72\141\x5f\145\156\x61\x62\154\x65\x5f\164\171\160\x65", $this->_otpType);
        update_mo_option("\165\165\154\164\162\141\137\160\x68\x6f\156\x65\137\153\145\x79", $this->_phoneKey);
    }
}
