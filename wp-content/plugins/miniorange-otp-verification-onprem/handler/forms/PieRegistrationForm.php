<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoMessages;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
class PieRegistrationForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::PIE_REG;
        $this->_typePhoneTag = "\x6d\x6f\137\x70\x69\145\137\x70\x68\x6f\x6e\x65\137\x65\156\x61\x62\154\x65";
        $this->_typeEmailTag = "\155\x6f\x5f\x70\151\145\x5f\x65\x6d\x61\151\x6c\x5f\145\x6e\141\142\x6c\x65";
        $this->_typeBothTag = "\x6d\157\137\160\151\x65\x5f\x62\x6f\164\150\x5f\145\x6e\x61\x62\x6c\x65";
        $this->_formKey = "\120\x49\105\x5f\x46\117\122\x4d";
        $this->_formName = mo_("\120\x49\x45\x20\x52\x65\x67\x69\163\x74\162\141\x74\151\x6f\x6e\x20\106\x6f\162\x6d");
        $this->_isFormEnabled = get_mo_option("\x70\x69\x65\137\144\x65\x66\141\165\154\x74\x5f\x65\156\141\x62\x6c\x65");
        $this->_formDocuments = MoOTPDocs::PIE_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x70\151\x65\x5f\145\x6e\141\x62\x6c\x65\137\x74\x79\160\x65");
        $this->_phoneKey = get_mo_option("\x70\x69\145\137\160\150\x6f\156\145\137\153\145\x79");
        $this->_phoneFormId = $this->getPhoneFieldKey();
        add_action("\160\151\x65\137\x72\145\147\151\x73\164\145\162\x5f\142\145\x66\x6f\x72\x65\x5f\x72\x65\147\151\x73\x74\x65\162\x5f\166\x61\154\151\144\x61\164\x65", array($this, "\155\x69\x6e\151\157\x72\141\156\147\x65\x5f\x70\x69\x65\137\165\163\x65\162\137\162\145\147\151\163\164\x72\x61\x74\x69\x6f\156"), 99, 1);
    }
    function isPhoneVerificationEnabled()
    {
        $Jw = $this->getVerificationType();
        return $Jw === VerificationType::PHONE || $Jw === VerificationType::BOTH;
    }
    function miniorange_pie_user_registration()
    {
        global $errors;
        if (empty($errors->errors)) {
            goto hV;
        }
        return;
        hV:
        if (!$this->checkIfVerificationIsComplete()) {
            goto WP;
        }
        return;
        WP:
        if (!(empty($_POST[$this->_phoneFormId]) && $this->isPhoneVerificationEnabled())) {
            goto wp;
        }
        $errors->add("\x6d\x6f\137\157\164\160\137\166\x65\x72\151\146\x79", MoMessages::showMessage(MoMessages::ENTER_PHONE_DEFAULT));
        return;
        wp:
        $this->startTheOTPVerificationProcess($_POST["\x65\x5f\155\141\x69\x6c"], "\53" . $_POST[$this->_phoneFormId]);
        if ($this->checkIfVerificationIsComplete()) {
            goto eS;
        }
        $errors->add("\155\x6f\x5f\157\164\x70\137\x76\x65\162\151\146\171", MoMessages::showMessage(MoMessages::ENTER_VERIFY_CODE));
        eS:
    }
    function checkIfVerificationIsComplete()
    {
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $this->getVerificationType())) {
            goto Td;
        }
        $this->unsetOTPSessionVariables();
        return TRUE;
        Td:
        return FALSE;
    }
    function startTheOTPVerificationProcess($I4, $lr)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto b8;
        }
        if (strcasecmp($this->_otpType, $this->_typeBothTag) == 0) {
            goto vv;
        }
        $this->sendChallenge('', $I4, null, $lr, VerificationType::EMAIL);
        goto Q9;
        vv:
        $this->sendChallenge('', $I4, null, $lr, VerificationType::BOTH);
        Q9:
        goto Cf;
        b8:
        $this->sendChallenge('', $I4, null, $lr, VerificationType::PHONE);
        Cf:
    }
    function getPhoneFieldKey()
    {
        $hn = get_option("\160\151\x65\137\146\151\x65\154\144\163");
        if (!empty($hn)) {
            goto BE;
        }
        return '';
        BE:
        $TH = maybe_unserialize($hn);
        foreach ($TH as $xl) {
            if (!(strcasecmp(trim($xl["\x6c\141\142\145\x6c"]), $this->_phoneKey) == 0)) {
                goto D1;
            }
            return str_replace("\55", "\x5f", sanitize_title($xl["\x74\x79\x70\145"] . "\137" . (isset($xl["\x69\x64"]) ? $xl["\x69\144"] : '')));
            D1:
            vp:
        }
        i8:
        return '';
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
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->isPhoneVerificationEnabled())) {
            goto K3;
        }
        array_push($lP, "\x69\156\x70\165\164\43" . $this->_phoneFormId);
        K3:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto x_;
        }
        return;
        x_:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\160\151\145\x5f\x64\x65\146\141\165\154\164\137\x65\156\141\142\x6c\145");
        $this->_otpType = $this->sanitizeFormPOST("\160\x69\x65\137\x65\156\x61\142\154\145\x5f\164\x79\x70\145");
        $this->_phoneKey = $this->sanitizeFormPOST("\x70\x69\145\137\160\150\x6f\x6e\x65\x5f\146\151\145\154\144\x5f\153\145\x79");
        update_mo_option("\160\x69\x65\137\144\x65\x66\x61\x75\x6c\164\137\145\156\141\142\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\x70\151\145\137\145\x6e\x61\142\154\145\137\x74\171\x70\x65", $this->_otpType);
        update_mo_option("\x70\x69\145\137\160\150\157\156\x65\x5f\x6b\x65\171", $this->_phoneKey);
    }
}
