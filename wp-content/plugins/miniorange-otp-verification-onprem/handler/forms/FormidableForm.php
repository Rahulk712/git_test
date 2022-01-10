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
class FormidableForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::FORMIDABLE_FORM;
        $this->_typePhoneTag = "\155\157\137\146\162\155\x5f\x66\157\x72\x6d\x5f\x70\150\x6f\x6e\x65\x5f\145\156\x61\142\x6c\145";
        $this->_typeEmailTag = "\x6d\157\137\x66\162\155\x5f\146\157\x72\155\137\x65\x6d\x61\151\154\137\145\156\141\142\x6c\x65";
        $this->_formKey = "\x46\117\122\x4d\111\104\101\x42\114\x45\x5f\x46\117\122\115";
        $this->_formName = mo_("\106\x6f\162\x6d\x69\x64\141\x62\154\x65\x20\x46\157\x72\155\x73");
        $this->_isFormEnabled = get_mo_option("\x66\x72\155\137\x66\157\162\155\x5f\145\156\141\142\x6c\x65");
        $this->_buttonText = get_mo_option("\x66\162\x6d\x5f\142\x75\x74\x74\x6f\x6e\137\164\145\170\164");
        $this->_buttonText = !MoUtility::isBlank($this->_buttonText) ? $this->_buttonText : mo_("\x43\154\x69\x63\x6b\x20\110\x65\x72\x65\40\x74\x6f\x20\163\145\x6e\144\x20\117\x54\x50");
        $this->_generateOTPAction = "\155\x69\156\151\157\162\x61\x6e\147\145\x5f\x66\162\155\137\147\x65\x6e\145\x72\141\x74\145\x5f\x6f\x74\160";
        $this->_formDocuments = MoOTPDocs::FORMIDABLE_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\146\162\x6d\x5f\146\157\162\x6d\137\145\156\141\142\x6c\145\x5f\164\x79\x70\145");
        $this->_formDetails = maybe_unserialize(get_mo_option("\146\x72\x6d\137\x66\157\x72\x6d\137\157\x74\x70\x5f\145\x6e\x61\142\154\145\x64"));
        $this->_phoneFormId = array();
        if (!(empty($this->_formDetails) || !$this->_isFormEnabled)) {
            goto EB;
        }
        return;
        EB:
        foreach ($this->_formDetails as $xl => $sA) {
            array_push($this->_phoneFormId, "\43" . $sA["\160\x68\x6f\156\145\153\x65\x79"] . "\40\151\156\160\165\164");
            iE:
        }
        mm:
        add_filter("\x66\x72\x6d\x5f\166\x61\154\151\x64\141\164\145\137\x66\151\x65\x6c\144\137\x65\156\164\x72\171", array($this, "\155\151\x6e\x69\x6f\162\x61\156\147\x65\137\157\164\160\137\166\141\x6c\151\144\x61\x74\151\x6f\x6e"), 11, 4);
        add_action("\167\x70\137\x61\x6a\x61\170\x5f{$this->_generateOTPAction}", array($this, "\x5f\x73\145\x6e\144\x5f\157\x74\160\137\x66\x72\155\137\141\152\x61\170"));
        add_action("\167\160\137\x61\152\x61\x78\137\156\x6f\160\162\151\166\x5f{$this->_generateOTPAction}", array($this, "\137\163\145\156\144\x5f\x6f\x74\x70\137\146\162\x6d\x5f\x61\x6a\x61\170"));
        add_action("\167\x70\137\x65\156\x71\x75\x65\165\145\137\x73\143\162\151\160\x74\x73", array($this, "\x6d\151\156\151\157\x72\141\x6e\147\145\x5f\162\145\x67\x69\163\x74\145\162\x5f\146\x6f\162\x6d\x69\144\x61\x62\x6c\x65\137\x73\143\162\151\x70\164"));
    }
    function miniorange_register_formidable_script()
    {
        wp_register_script("\155\x6f\x66\x6f\162\155\151\x64\x61\142\x6c\x65", MOV_URL . "\x69\x6e\x63\x6c\165\144\145\163\x2f\x6a\163\x2f\146\x6f\162\x6d\x69\x64\141\142\154\145\56\155\151\x6e\56\x6a\163", array("\152\161\x75\145\162\x79"));
        wp_localize_script("\x6d\157\146\x6f\162\x6d\x69\x64\141\x62\x6c\145", "\155\x6f\x66\x6f\x72\155\151\x64\141\x62\154\145", array("\x73\x69\164\145\125\122\114" => wp_ajax_url(), "\x6f\164\160\124\171\x70\145" => $this->_otpType, "\x66\157\x72\x6d\153\145\x79" => strcasecmp($this->_otpType, $this->_typePhoneTag) == 0 ? "\x70\x68\157\x6e\145\153\145\x79" : "\145\x6d\141\151\x6c\x6b\x65\171", "\156\157\x6e\x63\145" => wp_create_nonce($this->_nonce), "\x62\x75\164\164\x6f\156\164\x65\x78\x74" => mo_($this->_buttonText), "\x69\x6d\147\x55\122\x4c" => MOV_LOADER_URL, "\x66\157\x72\x6d\163" => $this->_formDetails, "\147\x65\x6e\x65\162\x61\164\145\x55\122\114" => $this->_generateOTPAction));
        wp_enqueue_script("\x6d\157\146\157\x72\x6d\x69\144\x61\x62\154\145");
    }
    function _send_otp_frm_ajax()
    {
        $this->validateAjaxRequest();
        if ($this->_otpType == $this->_typePhoneTag) {
            goto Lv;
        }
        $this->_send_frm_otp_to_email($_POST);
        goto JC;
        Lv:
        $this->_send_frm_otp_to_phone($_POST);
        JC:
    }
    function _send_frm_otp_to_phone($Jf)
    {
        if (!MoUtility::sanitizeCheck("\165\x73\x65\162\x5f\160\150\x6f\x6e\145", $Jf)) {
            goto vf;
        }
        $this->sendOTP(trim($Jf["\x75\163\145\x72\137\160\x68\157\156\145"]), NULL, trim($Jf["\165\163\145\x72\x5f\160\x68\x6f\x6e\145"]), VerificationType::PHONE);
        goto UY;
        vf:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_PHONE), MoConstants::ERROR_JSON_TYPE));
        UY:
    }
    function _send_frm_otp_to_email($Jf)
    {
        if (!MoUtility::sanitizeCheck("\165\163\x65\162\x5f\145\155\x61\x69\x6c", $Jf)) {
            goto Hq;
        }
        $this->sendOTP($Jf["\x75\x73\x65\x72\x5f\x65\155\141\151\154"], $Jf["\165\163\145\x72\x5f\145\155\x61\x69\x6c"], NULL, VerificationType::EMAIL);
        goto ts;
        Hq:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_EMAIL), MoConstants::ERROR_JSON_TYPE));
        ts:
    }
    private function sendOTP($Vf, $I4, $mF, $m5)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if ($m5 === VerificationType::PHONE) {
            goto za;
        }
        SessionUtils::addEmailVerified($this->_formSessionVar, $Vf);
        goto Oj;
        za:
        SessionUtils::addPhoneVerified($this->_formSessionVar, $Vf);
        Oj:
        $this->sendChallenge('', $I4, NULL, $mF, $m5);
    }
    function miniorange_otp_validation($errors, $uG, $sA, $mx)
    {
        if (!($this->getFieldId("\166\145\x72\x69\146\x79\x5f\x73\x68\x6f\167", $uG) !== $uG->id)) {
            goto PK;
        }
        return $errors;
        PK:
        if (MoUtility::isBlank($errors)) {
            goto Ug;
        }
        return $errors;
        Ug:
        if ($this->hasOTPBeenSent($errors, $uG)) {
            goto vg;
        }
        return $errors;
        vg:
        if (!$this->isMisMatchEmailOrPhone($errors, $uG)) {
            goto ej;
        }
        return $errors;
        ej:
        if ($this->isValidOTP($sA, $uG, $errors)) {
            goto qJ;
        }
        return $errors;
        qJ:
        return $errors;
    }
    private function hasOTPBeenSent(&$errors, $uG)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto FA;
        }
        $bJ = MoMessages::showMessage(BaseMessages::ENTER_VERIFY_CODE);
        if ($this->isPhoneVerificationEnabled()) {
            goto CE;
        }
        $errors["\146\151\x65\x6c\144" . $this->getFieldId("\x65\x6d\x61\151\x6c\x5f\163\x68\157\x77", $uG)] = $bJ;
        goto Eo;
        CE:
        $errors["\146\x69\145\154\x64" . $this->getFieldId("\160\150\157\x6e\x65\137\163\x68\x6f\x77", $uG)] = $bJ;
        Eo:
        return false;
        FA:
        return true;
    }
    private function isMisMatchEmailOrPhone(&$errors, $uG)
    {
        $rj = $this->getFieldId($this->isPhoneVerificationEnabled() ? "\x70\x68\157\156\145\x5f\x73\150\157\x77" : "\145\x6d\141\x69\154\x5f\163\x68\x6f\167", $uG);
        $Wx = $_POST["\x69\164\x65\155\x5f\x6d\x65\164\141"][$rj];
        if ($this->checkPhoneOrEmailIntegrity($Wx)) {
            goto Lw;
        }
        if ($this->isPhoneVerificationEnabled()) {
            goto Zt;
        }
        $errors["\146\x69\x65\x6c\x64" . $this->getFieldId("\x65\x6d\x61\x69\x6c\137\x73\x68\157\167", $uG)] = MoMessages::showMessage(BaseMessages::EMAIL_MISMATCH);
        goto Vo;
        Zt:
        $errors["\x66\151\x65\x6c\x64" . $this->getFieldId("\160\150\x6f\156\x65\137\163\150\x6f\x77", $uG)] = MoMessages::showMessage(BaseMessages::PHONE_MISMATCH);
        Vo:
        return true;
        Lw:
        return false;
    }
    private function isValidOTP($sA, $uG, &$errors)
    {
        $m5 = $this->getVerificationType();
        $this->validateChallenge($m5, NULL, $sA);
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $m5)) {
            goto QC;
        }
        $errors["\146\x69\x65\x6c\x64" . $this->getFieldId("\166\x65\x72\151\x66\x79\x5f\163\x68\157\x77", $uG)] = MoUtility::_get_invalid_otp_method();
        return false;
        goto Rk;
        QC:
        $this->unsetOTPSessionVariables();
        return true;
        Rk:
    }
    private function checkPhoneOrEmailIntegrity($Wx)
    {
        if ($this->isPhoneVerificationEnabled()) {
            goto LX;
        }
        return SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $Wx);
        goto Bk;
        LX:
        return SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $Wx);
        Bk:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VERIFICATION_FAILED, $m5);
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
    }
    function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->_isFormEnabled && $this->isPhoneVerificationEnabled())) {
            goto Js;
        }
        $lP = array_merge($lP, $this->_phoneFormId);
        Js:
        return $lP;
    }
    function isPhoneVerificationEnabled()
    {
        return $this->getVerificationType() === VerificationType::PHONE;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto rK;
        }
        return;
        rK:
        $form = $this->parseFormDetails();
        $this->_isFormEnabled = $this->sanitizeFormPOST("\146\162\155\137\x66\x6f\x72\x6d\x5f\x65\x6e\141\x62\154\145");
        $this->_otpType = $this->sanitizeFormPOST("\x66\x72\155\137\x66\157\x72\155\x5f\x65\x6e\x61\142\154\145\x5f\164\171\x70\145");
        $this->_formDetails = !empty($form) ? $form : '';
        $this->_buttonText = $this->sanitizeFormPOST("\146\x72\x6d\137\x62\165\x74\164\157\156\137\x74\145\x78\x74");
        if (!$this->basicValidationCheck(BaseMessages::FORMIDABLE_CHOOSE)) {
            goto FI;
        }
        update_mo_option("\x66\x72\155\x5f\x62\x75\164\164\157\x6e\x5f\164\x65\170\164", $this->_buttonText);
        update_mo_option("\146\x72\x6d\x5f\x66\157\x72\155\x5f\145\156\141\142\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\x66\162\155\x5f\x66\157\x72\155\x5f\x65\156\141\142\x6c\145\x5f\164\171\x70\x65", $this->_otpType);
        update_mo_option("\146\162\x6d\137\x66\x6f\x72\x6d\137\x6f\x74\x70\x5f\x65\x6e\x61\x62\154\145\x64", maybe_serialize($this->_formDetails));
        FI:
    }
    function parseFormDetails()
    {
        $form = array();
        if (array_key_exists("\146\x72\155\137\x66\x6f\x72\x6d", $_POST)) {
            goto o4;
        }
        return array();
        o4:
        foreach (array_filter($_POST["\x66\162\x6d\137\x66\157\x72\155"]["\146\157\162\x6d"]) as $xl => $sA) {
            $form[$sA] = array("\145\x6d\141\x69\154\153\145\x79" => "\x66\162\x6d\x5f\146\x69\x65\154\144\137" . $_POST["\x66\162\155\137\x66\157\x72\155"]["\145\x6d\x61\151\154\x6b\145\171"][$xl] . "\137\x63\157\x6e\164\x61\x69\156\145\x72", "\x70\150\x6f\156\145\153\145\171" => "\x66\x72\x6d\137\x66\x69\145\154\144\x5f" . $_POST["\146\x72\155\137\146\157\162\155"]["\160\x68\x6f\156\145\153\x65\171"][$xl] . "\x5f\143\x6f\x6e\x74\x61\x69\156\x65\162", "\166\x65\162\x69\x66\x79\x4b\x65\x79" => "\146\x72\155\x5f\146\x69\x65\x6c\x64\x5f" . $_POST["\x66\x72\155\137\146\x6f\x72\x6d"]["\x76\145\x72\151\146\171\113\x65\171"][$xl] . "\x5f\x63\157\156\164\x61\151\x6e\x65\162", "\x70\150\x6f\156\x65\137\163\x68\157\x77" => $_POST["\146\162\x6d\x5f\x66\157\x72\155"]["\160\x68\157\x6e\x65\x6b\x65\x79"][$xl], "\x65\x6d\x61\x69\154\x5f\x73\x68\x6f\x77" => $_POST["\146\x72\155\137\146\157\162\155"]["\145\155\141\x69\x6c\x6b\x65\171"][$xl], "\x76\145\x72\151\x66\x79\137\x73\150\x6f\167" => $_POST["\146\162\x6d\137\146\x6f\162\155"]["\x76\x65\162\x69\x66\171\113\x65\171"][$xl]);
            Gt:
        }
        pi:
        return $form;
    }
    function getFieldId($xl, $uG)
    {
        return $this->_formDetails[$uG->form_id][$xl];
    }
}
