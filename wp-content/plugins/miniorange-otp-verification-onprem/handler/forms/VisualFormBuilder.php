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
class VisualFormBuilder extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::VISUAL_FORM;
        $this->_typePhoneTag = "\x6d\x6f\137\166\x69\x73\x75\x61\x6c\137\146\x6f\162\x6d\137\160\150\x6f\156\x65\x5f\x65\156\141\142\154\x65";
        $this->_typeEmailTag = "\155\x6f\137\x76\151\163\165\141\154\x5f\x66\x6f\x72\x6d\137\x65\x6d\x61\x69\154\137\x65\x6e\x61\142\154\x65";
        $this->_typeBothTag = "\x6d\x6f\137\166\151\163\x75\141\x6c\x5f\x66\x6f\x72\155\x5f\x62\157\x74\x68\137\145\x6e\141\x62\x6c\x65";
        $this->_formKey = "\126\x49\x53\x55\101\x4c\x5f\x46\117\122\115";
        $this->_formName = mo_("\x56\151\x73\165\141\154\x20\x46\157\x72\x6d\40\102\165\x69\x6c\144\145\162");
        $this->_phoneFormId = array();
        $this->_isFormEnabled = get_mo_option("\166\x69\163\x75\x61\x6c\x5f\146\157\162\x6d\x5f\x65\156\141\142\154\145");
        $this->_buttonText = get_mo_option("\166\x69\163\165\x61\x6c\x5f\x66\x6f\x72\x6d\137\142\165\x74\x74\x6f\156\137\164\x65\170\164");
        $this->_buttonText = !MoUtility::isBlank($this->_buttonText) ? $this->_buttonText : mo_("\x43\x6c\x69\143\153\40\x48\145\x72\x65\40\164\157\x20\x73\x65\156\x64\40\117\124\120");
        $this->_generateOTPAction = "\155\x69\x6e\151\157\162\141\x6e\x67\x65\x2d\166\x66\x2d\x73\145\x6e\144\x2d\157\164\160";
        $this->_validateOTPAction = "\x6d\151\156\151\x6f\162\x61\x6e\147\145\55\x76\146\55\x76\x65\x72\x69\x66\171\x2d\x63\157\x64\145";
        $this->_formDocuments = MoOTPDocs::VISUAL_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\166\x69\163\165\x61\x6c\x5f\x66\x6f\x72\x6d\137\x65\156\141\142\x6c\145\x5f\x74\171\160\x65");
        $this->_formDetails = maybe_unserialize(get_mo_option("\x76\x69\x73\x75\x61\154\137\146\157\x72\x6d\137\x6f\164\x70\x5f\145\156\x61\x62\154\145\x64"));
        if (!(empty($this->_formDetails) || !$this->_isFormEnabled)) {
            goto Q3;
        }
        return;
        Q3:
        foreach ($this->_formDetails as $xl => $sA) {
            array_push($this->_phoneFormId, "\x23" . $sA["\x70\150\157\156\x65\x6b\x65\x79"]);
            ze:
        }
        xt:
        add_action("\167\x70\x5f\145\x6e\x71\165\x65\x75\x65\137\x73\x63\162\x69\x70\x74\x73", array($this, "\x6d\157\x5f\x65\x6e\x71\x75\145\165\145\137\166\x66"));
        add_action("\x77\x70\137\x61\152\x61\x78\137{$this->_generateOTPAction}", array($this, "\137\163\x65\156\x64\x5f\157\x74\160\x5f\166\146\x5f\x61\152\141\170"));
        add_action("\167\160\137\x61\152\141\170\137\x6e\x6f\160\x72\x69\x76\x5f{$this->_generateOTPAction}", array($this, "\137\163\145\156\144\x5f\x6f\164\x70\137\166\x66\137\x61\x6a\141\170"));
        add_action("\167\160\137\x61\x6a\x61\170\137{$this->_validateOTPAction}", array($this, "\160\162\157\143\x65\163\163\x46\157\162\155\101\156\x64\126\x61\x6c\151\x64\141\164\x65\117\124\x50"));
        add_action("\x77\160\x5f\x61\x6a\x61\x78\x5f\156\157\160\162\x69\166\x5f{$this->_validateOTPAction}", array($this, "\x70\x72\x6f\x63\145\163\x73\106\157\162\x6d\x41\156\x64\126\x61\x6c\x69\x64\141\x74\x65\117\x54\120"));
    }
    function mo_enqueue_vf()
    {
        wp_register_script("\166\146\x73\x63\x72\151\160\164", MOV_URL . "\151\156\143\154\165\144\x65\163\x2f\x6a\163\x2f\166\146\163\143\x72\151\x70\x74\x2e\x6d\x69\x6e\x2e\x6a\x73", array("\x6a\x71\165\145\x72\171"));
        wp_localize_script("\x76\146\163\x63\162\151\160\x74", "\155\x6f\166\x66\x76\x61\162", array("\x73\x69\164\145\125\122\114" => wp_ajax_url(), "\x6f\164\160\124\x79\160\x65" => strcasecmp($this->_otpType, $this->_typePhoneTag), "\146\157\x72\x6d\104\x65\x74\141\x69\154\x73" => $this->_formDetails, "\142\x75\x74\x74\157\156\x74\145\x78\164" => $this->_buttonText, "\x69\x6d\x67\125\x52\114" => MOV_LOADER_URL, "\146\x69\x65\154\x64\124\x65\170\164" => mo_("\x45\156\x74\145\162\x20\117\124\x50\40\150\x65\162\x65"), "\x67\156\157\156\143\145" => wp_create_nonce($this->_nonce), "\156\157\156\x63\145\x4b\x65\171" => wp_create_nonce($this->_nonceKey), "\166\x6e\157\x6e\143\145" => wp_create_nonce($this->_nonce), "\x67\x61\143\x74\x69\157\x6e" => $this->_generateOTPAction, "\x76\x61\143\164\x69\157\x6e" => $this->_validateOTPAction));
        wp_enqueue_script("\x76\x66\163\143\162\151\x70\164");
    }
    function _send_otp_vf_ajax()
    {
        $this->validateAjaxRequest();
        if ($this->_otpType == $this->_typePhoneTag) {
            goto sK;
        }
        $this->_send_vf_otp_to_email($_POST);
        goto QF;
        sK:
        $this->_send_vf_otp_to_phone($_POST);
        QF:
    }
    function _send_vf_otp_to_phone($Jf)
    {
        if (!MoUtility::sanitizeCheck("\x75\163\x65\x72\137\x70\150\x6f\x6e\145", $Jf)) {
            goto k1;
        }
        $this->startOTPVerification(trim($Jf["\x75\x73\145\162\x5f\160\150\157\x6e\145"]), NULL, trim($Jf["\165\163\145\162\137\160\x68\157\x6e\145"]), VerificationType::PHONE);
        goto AW;
        k1:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_PHONE), MoConstants::ERROR_JSON_TYPE));
        AW:
    }
    function _send_vf_otp_to_email($Jf)
    {
        if (!MoUtility::sanitizeCheck("\165\163\x65\x72\x5f\x65\x6d\x61\151\x6c", $Jf)) {
            goto C4;
        }
        $this->startOTPVerification($Jf["\165\163\145\162\137\x65\x6d\x61\x69\x6c"], $Jf["\165\x73\x65\162\x5f\x65\155\x61\x69\154"], NULL, VerificationType::EMAIL);
        goto Gw;
        C4:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_EMAIL), MoConstants::ERROR_JSON_TYPE));
        Gw:
    }
    private function startOTPVerification($Vf, $I4, $mF, $m5)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if ($m5 === VerificationType::PHONE) {
            goto AT;
        }
        SessionUtils::addEmailVerified($this->_formSessionVar, $Vf);
        goto tX;
        AT:
        SessionUtils::addPhoneVerified($this->_formSessionVar, $Vf);
        tX:
        $this->sendChallenge('', $I4, NULL, $mF, $m5);
    }
    function processFormAndValidateOTP()
    {
        $this->validateAjaxRequest();
        $this->checkIfVerificationNotStarted();
        $this->checkIntegrityAndValidateOTP($_POST);
    }
    function checkIfVerificationNotStarted()
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto cX;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_VERIFY_CODE), MoConstants::ERROR_JSON_TYPE));
        cX:
    }
    private function checkIntegrityAndValidateOTP($post)
    {
        $this->checkIntegrity($post);
        $this->validateChallenge($this->getVerificationType(), NULL, $post["\157\x74\x70\x5f\x74\x6f\153\x65\x6e"]);
    }
    private function checkIntegrity($post)
    {
        if ($this->isPhoneVerificationEnabled()) {
            goto Pu;
        }
        if (SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $post["\x73\165\142\x5f\x66\151\145\154\144"])) {
            goto a7;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::EMAIL_MISMATCH), MoConstants::ERROR_JSON_TYPE));
        a7:
        goto HH;
        Pu:
        if (SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $post["\163\x75\x62\x5f\x66\151\x65\x6c\144"])) {
            goto h9;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::PHONE_MISMATCH), MoConstants::ERROR_JSON_TYPE));
        h9:
        HH:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        wp_send_json(MoUtility::createJson(MoUtility::_get_invalid_otp_method(), MoConstants::ERROR_JSON_TYPE));
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        $this->unsetOTPSessionVariables();
        wp_send_json(MoUtility::createJson(MoConstants::SUCCESS, MoConstants::SUCCESS_JSON_TYPE));
    }
    function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->_isFormEnabled && $this->isPhoneVerificationEnabled())) {
            goto cs;
        }
        $lP = array_merge($lP, $this->_phoneFormId);
        cs:
        return $lP;
    }
    function isPhoneVerificationEnabled()
    {
        $Jw = $this->getVerificationType();
        return $Jw == VerificationType::PHONE || $Jw === VerificationType::BOTH;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto kV;
        }
        return;
        kV:
        $form = $this->parseFormDetails();
        $this->_isFormEnabled = $this->sanitizeFormPOST("\166\x69\x73\165\141\154\x5f\x66\x6f\x72\x6d\137\145\156\x61\x62\154\145");
        $this->_otpType = $this->sanitizeFormPOST("\166\x69\163\165\141\154\x5f\x66\x6f\162\155\x5f\x65\x6e\x61\142\x6c\x65\x5f\x74\171\160\145");
        $this->_formDetails = !empty($form) ? $form : '';
        $this->_buttonText = $this->sanitizeFormPOST("\x76\x69\163\165\141\x6c\137\x66\157\x72\155\x5f\142\165\164\x74\x6f\x6e\137\164\145\170\x74");
        if (!$this->basicValidationCheck(BaseMessages::VISUAL_FORM_CHOOSE)) {
            goto Qd;
        }
        update_mo_option("\166\151\163\x75\x61\154\x5f\146\157\162\155\x5f\142\165\x74\164\157\x6e\x5f\x74\145\x78\164", $this->_buttonText);
        update_mo_option("\166\151\x73\x75\141\x6c\137\x66\x6f\x72\x6d\137\x65\x6e\141\x62\x6c\145", $this->_isFormEnabled);
        update_mo_option("\x76\151\x73\x75\x61\x6c\x5f\146\x6f\162\x6d\x5f\x65\156\141\142\154\x65\137\x74\171\x70\x65", $this->_otpType);
        update_mo_option("\166\151\x73\165\141\x6c\x5f\146\157\x72\x6d\x5f\x6f\164\x70\x5f\145\x6e\141\x62\x6c\x65\144", maybe_serialize($this->_formDetails));
        Qd:
    }
    function parseFormDetails()
    {
        $form = array();
        if (array_key_exists("\x76\151\163\165\141\x6c\x5f\x66\x6f\162\x6d", $_POST)) {
            goto fX;
        }
        return array();
        fX:
        foreach (array_filter($_POST["\166\x69\163\165\x61\154\x5f\146\x6f\x72\x6d"]["\x66\x6f\x72\x6d"]) as $xl => $sA) {
            $form[$sA] = array("\x65\155\141\151\x6c\153\145\x79" => $this->getFieldID($_POST["\166\x69\x73\x75\x61\x6c\x5f\146\x6f\x72\x6d"]["\x65\x6d\x61\151\154\x6b\145\x79"][$xl], $sA), "\160\150\157\156\x65\x6b\145\x79" => $this->getFieldID($_POST["\166\x69\x73\x75\141\154\x5f\x66\x6f\x72\x6d"]["\x70\x68\157\156\145\x6b\145\171"][$xl], $sA), "\160\x68\x6f\x6e\145\x5f\163\150\x6f\167" => $_POST["\x76\151\x73\165\x61\x6c\137\x66\x6f\162\x6d"]["\x70\150\157\x6e\145\x6b\145\171"][$xl], "\x65\155\141\x69\154\137\x73\150\157\x77" => $_POST["\x76\151\163\165\x61\154\x5f\146\157\x72\155"]["\x65\155\141\x69\x6c\153\x65\171"][$xl]);
            cc:
        }
        g5:
        return $form;
    }
    private function getFieldID($xl, $u5)
    {
        global $wpdb;
        $qT = "\123\105\x4c\x45\103\x54\x20\x2a\40\x46\122\x4f\x4d\40" . VFB_WP_FIELDS_TABLE_NAME . "\x20\167\x68\x65\x72\x65\40\146\x69\145\x6c\144\137\x6e\x61\x6d\145\40\x3d\47" . $xl . "\47\x61\x6e\x64\x20\x66\157\x72\155\137\151\144\40\x3d\x20\47" . $u5 . "\47";
        $ll = $wpdb->get_row($qT);
        return !MoUtility::isBlank($ll) ? "\166\146\x62\55" . $ll->field_id : '';
    }
}
