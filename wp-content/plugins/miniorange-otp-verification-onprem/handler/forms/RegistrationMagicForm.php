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
class RegistrationMagicForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::CRF_DEFAULT_REG;
        $this->_typePhoneTag = "\155\x6f\137\x63\x72\146\137\160\150\157\156\145\137\x65\x6e\141\x62\x6c\x65";
        $this->_typeEmailTag = "\x6d\157\x5f\x63\x72\x66\x5f\x65\155\x61\x69\x6c\137\x65\x6e\x61\142\154\145";
        $this->_typeBothTag = "\x6d\157\137\x63\x72\x66\137\x62\x6f\x74\x68\x5f\x65\156\x61\x62\154\x65";
        $this->_formKey = "\103\x52\106\137\106\x4f\122\x4d";
        $this->_formName = mo_("\103\x75\163\164\x6f\155\x20\125\163\145\162\40\x52\x65\147\151\x73\164\162\x61\164\x69\157\156\x20\x46\157\162\155\x20\x42\165\x69\154\x64\x65\x72\x20\x28\x52\145\x67\151\x73\x74\x72\141\x74\x69\157\x6e\40\x4d\141\x67\151\x63\51");
        $this->_isFormEnabled = get_mo_option("\143\162\x66\x5f\144\145\x66\x61\165\154\164\x5f\x65\156\x61\142\x6c\145");
        $this->_phoneFormId = array();
        $this->_formDocuments = MoOTPDocs::CRF_FORM_ENABLE;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\143\162\x66\x5f\x65\156\x61\x62\x6c\x65\137\164\x79\160\x65");
        $this->_formDetails = maybe_unserialize(get_mo_option("\x63\x72\x66\x5f\157\164\x70\137\x65\156\141\142\154\x65\144"));
        if (!empty($this->_formDetails)) {
            goto IE;
        }
        return;
        IE:
        foreach ($this->_formDetails as $xl => $sA) {
            array_push($this->_phoneFormId, "\151\x6e\x70\165\x74\x5b\x6e\x61\155\145\75" . $this->getFieldID($sA["\x70\x68\x6f\156\145\153\145\171"], $xl) . "\135");
            fb:
        }
        KK:
        if ($this->checkIfPromptForOTP()) {
            goto v5;
        }
        return;
        v5:
        $this->_handle_crf_form_submit($_REQUEST);
    }
    private function checkIfPromptForOTP()
    {
        if (!(array_key_exists("\x6f\x70\164\x69\157\156", $_POST) || !array_key_exists("\x72\x6d\137\146\157\x72\155\x5f\x73\x75\x62\137\x69\x64", $_POST))) {
            goto No;
        }
        return FALSE;
        No:
        foreach ($this->_formDetails as $xl => $sA) {
            if (!(strpos($_POST["\162\x6d\x5f\146\x6f\x72\155\137\x73\x75\x62\137\x69\x64"], "\x66\x6f\162\x6d\x5f" . $xl . "\137") !== FALSE)) {
                goto Ga;
            }
            MoUtility::initialize_transaction($this->_formSessionVar);
            SessionUtils::setFormOrFieldId($this->_formSessionVar, $xl);
            return TRUE;
            Ga:
            jE:
        }
        Hz:
        return FALSE;
    }
    private function isPhoneVerificationEnabled()
    {
        $Jw = $this->getVerificationType();
        return $Jw === VerificationType::PHONE || $Jw === VerificationType::BOTH;
    }
    private function isEmailVerificationEnabled()
    {
        $Jw = $this->getVerificationType();
        return $Jw === VerificationType::EMAIL || $Jw === VerificationType::BOTH;
    }
    private function _handle_crf_form_submit($tE)
    {
        $xX = $this->isEmailVerificationEnabled() ? $this->getCRFEmailFromRequest($tE) : '';
        $lr = $this->isPhoneVerificationEnabled() ? $this->getCRFPhoneFromRequest($tE) : '';
        $this->miniorange_crf_user($xX, isset($tE["\165\x73\145\x72\x5f\x6e\x61\155\145"]) ? $tE["\x75\x73\x65\x72\137\156\141\155\145"] : NULL, $lr);
        $this->checkIfValidated();
    }
    private function checkIfValidated()
    {
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $this->getVerificationType())) {
            goto dj;
        }
        $this->unsetOTPSessionVariables();
        dj:
    }
    private function getCRFEmailFromRequest($tE)
    {
        $u5 = SessionUtils::getFormOrFieldId($this->_formSessionVar);
        $IP = $this->_formDetails[$u5]["\145\x6d\141\151\x6c\x6b\x65\x79"];
        return $this->getFormPostSubmittedValue($this->getFieldID($IP, $u5), $tE);
    }
    private function getCRFPhoneFromRequest($tE)
    {
        $u5 = SessionUtils::getFormOrFieldId($this->_formSessionVar);
        $JL = $this->_formDetails[$u5]["\x70\150\157\x6e\x65\x6b\145\171"];
        return $this->getFormPostSubmittedValue($this->getFieldID($JL, $u5), $tE);
    }
    private function getFormPostSubmittedValue($e_, $tE)
    {
        return isset($tE[$e_]) ? $tE[$e_] : '';
    }
    private function getFieldID($xl, $we)
    {
        global $wpdb;
        $bB = $wpdb->prefix . "\x72\x6d\137\x66\151\x65\x6c\144\x73";
        $qd = $wpdb->get_row("\123\x45\x4c\x45\103\x54\40\x2a\x20\x46\x52\x4f\x4d\40{$bB}\40\x77\150\145\162\145\x20\146\x6f\162\x6d\x5f\x69\144\40\75\40\x27" . $we . "\47\40\x61\156\144\40\146\x69\x65\154\144\137\x6c\141\x62\145\154\x20\x3d\x27" . $xl . "\x27");
        return isset($qd) ? ($qd->field_type == "\x4d\157\x62\x69\154\x65" ? "\x54\145\170\164\x62\x6f\170" : $qd->field_type) . "\137" . $qd->field_id : "\156\165\x6c\154";
    }
    private function miniorange_crf_user($Kc, $s4, $t2)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        $errors = new WP_Error();
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto y0;
        }
        if (strcasecmp($this->_otpType, $this->_typeBothTag) == 0) {
            goto C8;
        }
        $this->sendChallenge($s4, $Kc, $errors, $t2, VerificationType::EMAIL);
        goto ZJ;
        C8:
        $this->sendChallenge($s4, $Kc, $errors, $t2, VerificationType::BOTH);
        ZJ:
        goto Wm;
        y0:
        $this->sendChallenge($s4, $Kc, $errors, $t2, VerificationType::PHONE);
        Wm:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto wx;
        }
        return;
        wx:
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
            goto vH;
        }
        $lP = array_merge($lP, $this->_phoneFormId);
        vH:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto ec;
        }
        return;
        ec:
        $form = $this->parseFormDetails();
        $this->_formDetails = !empty($form) ? $form : '';
        $this->_isFormEnabled = $this->sanitizeFormPOST("\143\x72\x66\137\x64\145\146\141\165\x6c\164\137\x65\x6e\x61\x62\x6c\145");
        $this->_otpType = $this->sanitizeFormPOST("\x63\162\146\137\x65\156\x61\142\154\145\137\x74\171\160\x65");
        update_mo_option("\143\162\146\x5f\x64\145\146\x61\x75\154\x74\137\145\x6e\141\x62\x6c\145", $this->_isFormEnabled);
        update_mo_option("\143\x72\x66\137\145\156\141\x62\154\x65\137\164\171\160\145", $this->_otpType);
        update_mo_option("\x63\x72\x66\137\x6f\164\x70\137\x65\156\141\x62\154\145\x64", maybe_serialize($this->_formDetails));
    }
    function parseFormDetails()
    {
        $form = array();
        if (!(!array_key_exists("\x63\162\x66\137\x66\157\162\x6d", $_POST) && empty($_POST["\x63\x72\146\x5f\x66\x6f\x72\x6d"]["\x66\157\162\x6d"]))) {
            goto Pk;
        }
        return $form;
        Pk:
        foreach (array_filter($_POST["\143\162\146\x5f\146\157\x72\155"]["\146\157\162\155"]) as $xl => $sA) {
            $form[$sA] = array("\145\155\141\x69\x6c\153\145\x79" => $_POST["\x63\162\x66\137\x66\x6f\162\x6d"]["\145\155\141\151\x6c\153\x65\171"][$xl], "\160\150\157\156\x65\x6b\145\171" => $_POST["\x63\x72\x66\137\x66\x6f\162\155"]["\160\x68\157\156\x65\x6b\145\x79"][$xl], "\145\x6d\141\151\154\137\x73\x68\157\x77" => $_POST["\x63\162\x66\137\146\157\x72\155"]["\145\155\x61\151\154\x6b\145\x79"][$xl], "\x70\x68\x6f\x6e\x65\x5f\x73\150\x6f\167" => $_POST["\x63\162\x66\137\x66\157\162\155"]["\160\150\157\x6e\x65\153\x65\171"][$xl]);
            Py:
        }
        OQ:
        return $form;
    }
}
