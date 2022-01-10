<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\BaseMessages;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationLogic;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
use WP_Error;
class MemberPressRegistrationForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::MEMBERPRESS_REG;
        $this->_typePhoneTag = "\x6d\x6f\x5f\x6d\162\160\137\x70\x68\x6f\x6e\145\x5f\145\x6e\141\x62\x6c\x65";
        $this->_typeEmailTag = "\155\157\137\155\x72\x70\x5f\x65\155\x61\151\154\137\x65\x6e\141\142\154\145";
        $this->_typeBothTag = "\x6d\x6f\x5f\155\x72\x70\137\x62\157\x74\150\137\x65\156\141\x62\x6c\x65";
        $this->_formName = mo_("\115\145\155\x62\x65\162\x50\x72\145\x73\163\x20\x52\x65\x67\x69\x73\164\x72\x61\x74\x69\157\x6e\x20\x46\157\x72\x6d");
        $this->_formKey = "\115\105\115\x42\x45\122\x50\x52\x45\123\123";
        $this->_isFormEnabled = get_mo_option("\x6d\x72\160\137\x64\145\x66\141\x75\154\164\x5f\145\x6e\x61\142\x6c\x65");
        $this->_formDocuments = MoOTPDocs::MRP_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_byPassLogin = get_mo_option("\155\x72\160\137\141\x6e\157\156\137\x6f\156\154\x79");
        $this->_phoneKey = get_mo_option("\x6d\162\x70\137\x70\150\x6f\x6e\x65\137\153\145\x79");
        $this->_otpType = get_mo_option("\155\x72\160\x5f\145\x6e\141\142\154\x65\x5f\164\x79\x70\x65");
        $this->_phoneFormId = "\x69\156\x70\x75\x74\133\156\x61\155\x65\75" . $this->_phoneKey . "\x5d";
        add_filter("\x6d\145\160\162\x2d\x76\141\x6c\151\x64\141\164\145\x2d\163\x69\147\156\165\x70", array($this, "\x6d\151\x6e\151\x6f\x72\141\x6e\147\145\137\163\151\x74\x65\x5f\x72\x65\x67\x69\163\x74\145\162\137\146\x6f\162\155"), 99, 1);
    }
    function miniorange_site_register_form($errors)
    {
        if (!($this->_byPassLogin && is_user_logged_in())) {
            goto pe;
        }
        return $errors;
        pe:
        $lF = $_POST;
        $t2 = '';
        if (!$this->isPhoneVerificationEnabled()) {
            goto hR;
        }
        $t2 = $_POST[$this->_phoneKey];
        $errors = $this->validatePhoneNumberField($errors);
        hR:
        if (!(is_array($errors) && !empty($errors))) {
            goto By;
        }
        return $errors;
        By:
        if (!$this->checkIfVerificationIsComplete()) {
            goto hl;
        }
        return $errors;
        hl:
        MoUtility::initialize_transaction($this->_formSessionVar);
        $errors = new WP_Error();
        foreach ($_POST as $xl => $sA) {
            if ($xl == "\x75\x73\145\162\x5f\146\x69\x72\x73\164\x5f\x6e\x61\155\x65") {
                goto mC;
            }
            if ($xl == "\165\163\145\162\137\x65\x6d\x61\151\154") {
                goto IZ;
            }
            if ($xl == "\x6d\145\x70\162\137\x75\163\x65\x72\137\160\x61\x73\x73\x77\157\x72\x64") {
                goto dP;
            }
            $SU[$xl] = $sA;
            goto wV;
            mC:
            $Iv = $sA;
            goto wV;
            IZ:
            $xX = $sA;
            goto wV;
            dP:
            $wh = $sA;
            wV:
            G1:
        }
        m0:
        $SU["\165\163\145\x72\155\x65\x74\x61"] = $lF;
        $this->startVerificationProcess($Iv, $xX, $errors, $t2, $wh, $SU);
        return $errors;
    }
    function validatePhoneNumberField($errors)
    {
        global $phoneLogic;
        if (!MoUtility::sanitizeCheck($this->_phoneKey, $_POST)) {
            goto mF;
        }
        if (MoUtility::validatePhoneNumber($_POST[$this->_phoneKey])) {
            goto A3;
        }
        $errors[] = $phoneLogic->_get_otp_invalid_format_message();
        A3:
        goto CW;
        mF:
        $errors[] = mo_("\x50\x68\x6f\156\145\40\x6e\x75\x6d\142\145\162\x20\146\x69\x65\x6c\x64\40\143\x61\x6e\40\x6e\157\x74\40\142\x65\40\142\154\141\x6e\x6b");
        CW:
        return $errors;
    }
    function startVerificationProcess($Iv, $xX, $errors, $t2, $wh, $SU)
    {
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto xF;
        }
        if (strcasecmp($this->_otpType, $this->_typeBothTag) == 0) {
            goto Jb;
        }
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::EMAIL, $wh, $SU);
        goto Z5;
        xF:
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::PHONE, $wh, $SU);
        goto Z5;
        Jb:
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::BOTH, $wh, $SU);
        Z5:
    }
    function checkIfVerificationIsComplete()
    {
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $this->getVerificationType())) {
            goto Fh;
        }
        $this->unsetOTPSessionVariables();
        return TRUE;
        Fh:
        return FALSE;
    }
    function moMRPgetphoneFieldId()
    {
        global $wpdb;
        return $wpdb->get_var("\x53\x45\114\x45\103\x54\x20\x69\144\x20\x46\x52\x4f\115\40{$wpdb->prefix}\142\x70\x5f\x78\160\162\157\146\151\x6c\x65\137\x66\x69\145\154\x64\163\40\x77\x68\145\x72\x65\x20\156\141\155\145\40\75\x27" . $this->_phoneKey . "\x27");
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto JO;
        }
        return;
        JO:
        $Jw = $this->getVerificationType();
        $aG = $Jw === VerificationType::BOTH ? TRUE : FALSE;
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $Jw, $aG);
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!(self::isFormEnabled() && $this->isPhoneVerificationEnabled())) {
            goto oe;
        }
        array_push($lP, $this->_phoneFormId);
        oe:
        return $lP;
    }
    function isPhoneVerificationEnabled()
    {
        $m5 = $this->getVerificationType();
        return $m5 === VerificationType::PHONE || $m5 === VerificationType::BOTH;
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto tn;
        }
        return;
        tn:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\155\x72\x70\x5f\144\145\x66\x61\x75\x6c\x74\x5f\145\x6e\141\x62\x6c\145");
        $this->_otpType = $this->sanitizeFormPOST("\x6d\162\160\137\x65\156\141\142\154\x65\137\164\x79\x70\145");
        $this->_phoneKey = $this->sanitizeFormPOST("\155\162\160\x5f\x70\x68\157\156\x65\x5f\146\151\x65\x6c\144\x5f\x6b\145\171");
        $this->_byPassLogin = $this->sanitizeFormPOST("\155\x70\x72\137\x61\x6e\157\x6e\137\157\x6e\x6c\171");
        if (!$this->basicValidationCheck(BaseMessages::MEMBERPRESS_CHOOSE)) {
            goto lV;
        }
        update_mo_option("\x6d\162\x70\137\144\145\x66\x61\x75\154\x74\x5f\x65\x6e\x61\x62\154\x65", $this->_isFormEnabled);
        update_mo_option("\x6d\162\160\137\145\x6e\x61\x62\x6c\x65\137\x74\x79\160\x65", $this->_otpType);
        update_mo_option("\155\162\160\x5f\160\x68\157\156\x65\137\153\x65\x79", $this->_phoneKey);
        update_mo_option("\x6d\x72\x70\x5f\x61\156\157\156\x5f\x6f\x6e\x6c\x79", $this->_byPassLogin);
        lV:
    }
}
