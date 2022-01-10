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
class WPClientRegistration extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::WP_CLIENT_REG;
        $this->_phoneKey = "\x77\x70\x5f\143\157\x6e\x74\x61\x63\x74\137\160\150\157\x6e\145";
        $this->_phoneFormId = "\43\167\x70\143\137\143\157\x6e\164\141\143\x74\137\160\x68\157\156\145";
        $this->_formKey = "\127\x50\137\103\x4c\x49\x45\x4e\x54\137\x52\105\x47";
        $this->_typePhoneTag = "\x6d\x6f\x5f\x77\160\x5f\x63\x6c\151\145\156\x74\137\160\x68\x6f\156\145\x5f\x65\156\x61\x62\154\145";
        $this->_typeEmailTag = "\x6d\157\x5f\x77\160\137\143\154\151\x65\156\x74\x5f\x65\155\x61\x69\x6c\137\145\156\x61\x62\x6c\x65";
        $this->_typeBothTag = "\x6d\157\137\x77\160\x5f\x63\x6c\151\145\156\164\x5f\x62\157\x74\x68\137\145\156\141\142\x6c\145";
        $this->_formName = mo_("\x57\x50\x20\x43\x6c\151\145\x6e\x74\x20\x52\145\x67\151\163\164\x72\x61\164\x69\x6f\x6e\x20\x46\157\x72\x6d");
        $this->_isFormEnabled = get_mo_option("\x77\x70\137\x63\x6c\151\x65\156\x74\137\x65\x6e\x61\x62\x6c\x65");
        $this->_formDocuments = MoOTPDocs::WP_CLIENT_FORM;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\167\x70\137\x63\x6c\151\x65\x6e\x74\x5f\x65\156\x61\142\154\145\x5f\x74\171\x70\x65");
        $this->_restrictDuplicates = get_mo_option("\167\160\137\x63\x6c\x69\x65\x6e\x74\137\162\145\x73\164\x72\151\x63\164\x5f\x64\165\160\154\x69\143\x61\x74\145\163");
        add_filter("\167\160\143\x5f\143\154\151\x65\156\164\x5f\162\x65\x67\x69\163\x74\162\141\x74\151\x6f\156\137\146\157\x72\155\137\x76\x61\154\151\144\x61\x74\x69\157\156", array($this, "\155\151\x6e\x69\157\x72\141\x6e\x67\145\137\x63\154\x69\x65\156\164\x5f\162\145\147\151\163\164\162\x61\164\151\157\x6e\x5f\x76\x65\162\151\146\x79"), 99, 1);
    }
    function isPhoneVerificationEnabled()
    {
        $m5 = $this->getVerificationType();
        return $m5 === VerificationType::PHONE || $m5 === VerificationType::BOTH;
    }
    function miniorange_client_registration_verify($errors)
    {
        $m5 = $this->getVerificationType();
        $t2 = MoUtility::sanitizeCheck("\x63\157\156\164\141\x63\164\x5f\160\150\157\156\145", $_POST);
        $Kc = MoUtility::sanitizeCheck("\x63\x6f\156\164\x61\143\164\x5f\145\x6d\x61\151\x6c", $_POST);
        $Vy = MoUtility::sanitizeCheck("\143\157\x6e\164\141\143\164\x5f\x75\x73\x65\x72\156\141\x6d\x65", $_POST);
        if (!($this->_restrictDuplicates && $this->isPhoneNumberAlreadyInUse($t2, $this->_phoneKey))) {
            goto aU;
        }
        $errors .= mo_("\120\x68\x6f\156\x65\40\x6e\165\x6d\142\145\x72\40\141\154\x72\x65\141\x64\x79\x20\151\156\40\165\163\x65\x2e\x20\x50\154\145\x61\163\x65\x20\x45\156\x74\145\x72\40\141\x20\144\151\146\x66\145\x72\x65\156\x74\40\x50\150\x6f\156\145\x20\156\x75\155\142\145\162\x2e");
        aU:
        if (MoUtility::isBlank($errors)) {
            goto rS;
        }
        return $errors;
        rS:
        if (!SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto rL;
        }
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $m5)) {
            goto V_;
        }
        goto d9;
        rL:
        MoUtility::initialize_transaction($this->_formSessionVar);
        goto d9;
        V_:
        $this->unsetOTPSessionVariables();
        return $errors;
        d9:
        return $this->startOTPTransaction($Vy, $Kc, $errors, $t2);
    }
    function startOTPTransaction($Vy, $Kc, $errors, $t2)
    {
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) === 0) {
            goto YL;
        }
        if (strcasecmp($this->_otpType, $this->_typeBothTag) === 0) {
            goto vU;
        }
        $this->sendChallenge($Vy, $Kc, $errors, $t2, VerificationType::EMAIL);
        goto Bt;
        vU:
        $this->sendChallenge($Vy, $Kc, $errors, $t2, VerificationType::BOTH);
        Bt:
        goto MI;
        YL:
        $this->sendChallenge($Vy, $Kc, $errors, $t2, VerificationType::PHONE);
        MI:
        return $errors;
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
    function isPhoneNumberAlreadyInUse($lr, $xl)
    {
        global $wpdb;
        $lr = MoUtility::processPhoneNumber($lr);
        $D5 = $wpdb->get_row("\x53\x45\114\105\x43\124\40\140\165\x73\x65\162\137\151\x64\x60\x20\106\x52\117\x4d\40\140{$wpdb->prefix}\x75\163\145\x72\x6d\x65\x74\141\140\x20\127\110\x45\122\x45\40\140\x6d\x65\164\x61\x5f\153\145\171\x60\x20\x3d\x20\x27{$xl}\47\x20\x41\116\104\x20\140\x6d\x65\164\x61\137\166\141\x6c\165\x65\x60\x20\75\40\40\x27{$lr}\47");
        return !MoUtility::isBlank($D5);
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->isPhoneVerificationEnabled())) {
            goto xw;
        }
        array_push($lP, $this->_phoneFormId);
        xw:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto il;
        }
        return;
        il:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x77\160\x5f\x63\x6c\x69\x65\156\164\x5f\x65\x6e\141\x62\x6c\145");
        $this->_otpType = $this->sanitizeFormPOST("\167\x70\x5f\x63\154\x69\145\x6e\164\137\145\156\141\142\154\x65\x5f\x74\171\160\145");
        $this->_restrictDuplicates = $this->getVerificationType() === VerificationType::PHONE ? $this->sanitizeFormPOST("\x77\160\137\x63\x6c\151\145\156\x74\137\x72\x65\x73\164\162\151\x63\x74\137\x64\165\x70\x6c\x69\143\x61\164\x65\163") : false;
        update_mo_option("\x77\160\137\x63\154\151\x65\x6e\164\137\x65\x6e\x61\142\x6c\145", $this->_isFormEnabled);
        update_mo_option("\x77\x70\x5f\143\x6c\151\145\x6e\164\x5f\145\156\141\142\x6c\x65\137\x74\x79\x70\x65", $this->_otpType);
        update_mo_option("\167\x70\x5f\x63\154\151\145\x6e\164\137\x72\145\x73\164\162\x69\x63\x74\x5f\144\165\x70\x6c\151\143\x61\164\x65\163", $this->_restrictDuplicates);
    }
}
