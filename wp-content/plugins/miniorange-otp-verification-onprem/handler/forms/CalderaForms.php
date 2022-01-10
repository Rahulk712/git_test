<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
use WP_Error;
class CalderaForms extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::CALDERA;
        $this->_typePhoneTag = "\155\x6f\137\143\141\154\x64\145\x72\x61\137\160\x68\157\156\145\137\x65\156\141\142\154\x65";
        $this->_typeEmailTag = "\x6d\x6f\x5f\x63\141\x6c\144\x65\x72\x61\x5f\x65\x6d\141\151\x6c\x5f\x65\156\x61\142\154\145";
        $this->_formKey = "\103\101\x4c\104\x45\x52\101";
        $this->_formName = mo_("\103\x61\154\144\x65\x72\x61\x20\x46\x6f\162\x6d\163");
        $this->_isFormEnabled = get_mo_option("\143\x61\154\144\145\x72\141\137\x65\x6e\141\x62\x6c\145");
        $this->_buttonText = get_mo_option("\143\x61\154\144\x65\162\141\x5f\142\165\164\x74\157\x6e\137\164\x65\x78\x74");
        $this->_buttonText = !MoUtility::isBlank($this->_buttonText) ? $this->_buttonText : mo_("\103\154\x69\x63\x6b\x20\110\x65\x72\x65\x20\x74\x6f\40\163\145\156\x64\40\x4f\x54\x50");
        $this->_phoneFormId = array();
        $this->_formDocuments = MoOTPDocs::CALDERA_FORMS_LINK;
        $this->_generateOTPAction = "\x6d\151\156\151\157\x72\141\x6e\x67\x65\x5f\143\141\154\x64\x65\x72\x61\x5f\147\145\156\145\x72\x61\164\145\x5f\157\x74\160";
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x63\x61\x6c\144\145\x72\141\137\x65\x6e\141\x62\x6c\x65\137\x74\171\x70\x65");
        $this->_formDetails = maybe_unserialize(get_mo_option("\x63\141\x6c\144\x65\x72\141\137\146\157\x72\x6d\x73"));
        if (!empty($this->_formDetails)) {
            goto yI;
        }
        return;
        yI:
        foreach ($this->_formDetails as $xl => $sA) {
            array_push($this->_phoneFormId, "\151\x6e\160\x75\164\133\156\141\x6d\145\x3d" . $sA["\x70\150\x6f\156\145\x6b\145\171"]);
            add_filter("\x63\x61\x6c\144\x65\162\141\x5f\146\x6f\162\x6d\x73\x5f\166\141\x6c\x69\x64\141\164\x65\x5f\146\x69\x65\x6c\144\x5f" . $sA["\x70\150\x6f\156\145\x6b\145\171"], array($this, "\x76\141\x6c\x69\144\x61\164\145\x46\x6f\x72\x6d"), 99, 3);
            add_filter("\x63\141\x6c\144\x65\x72\141\x5f\x66\x6f\162\x6d\x73\137\166\x61\x6c\x69\144\141\x74\145\137\x66\x69\145\154\x64\x5f" . $sA["\x65\155\141\x69\154\153\145\x79"], array($this, "\166\141\154\x69\x64\x61\x74\145\x46\x6f\x72\x6d"), 99, 3);
            add_filter("\x63\x61\154\x64\145\x72\141\137\x66\x6f\162\x6d\x73\x5f\x76\141\x6c\x69\x64\x61\164\x65\137\x66\151\x65\x6c\144\x5f" . $sA["\166\x65\x72\151\146\x79\x4b\x65\171"], array($this, "\x76\141\x6c\151\144\x61\164\x65\x46\x6f\x72\155"), 99, 3);
            add_filter("\x63\x61\x6c\144\x65\162\141\x5f\x66\157\162\x6d\x73\137\163\165\142\155\151\x74\137\162\145\x74\x75\x72\156\x5f\x74\x72\141\156\163\x69\x65\156\164", array($this, "\165\156\x73\145\x74\x53\x65\163\x73\x69\157\x6e\x56\141\162\151\141\x62\x6c\145"), 99, 1);
            WY:
        }
        nw:
        add_action("\167\x70\x5f\x61\152\141\170\137{$this->_generateOTPAction}", array($this, "\137\x73\145\x6e\x64\137\x6f\x74\160"));
        add_action("\x77\160\137\x61\x6a\x61\170\x5f\x6e\157\x70\162\151\166\x5f{$this->_generateOTPAction}", array($this, "\x5f\163\x65\156\x64\137\157\x74\160"));
        add_action("\x77\160\137\x65\x6e\x71\x75\145\165\145\x5f\163\143\162\151\x70\164\163", array($this, "\155\151\x6e\151\157\162\x61\x6e\147\x65\x5f\x72\x65\147\151\163\164\x65\x72\137\143\x61\154\x64\145\x72\141\x5f\x73\143\x72\x69\x70\x74"));
    }
    function unsetSessionVariable($BS)
    {
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $this->getVerificationType())) {
            goto Dr;
        }
        $this->unsetOTPSessionVariables();
        Dr:
        return $BS;
    }
    function miniorange_register_caldera_script()
    {
        wp_register_script("\x6d\x6f\x63\141\154\144\x65\x72\141", MOV_URL . "\151\156\x63\x6c\x75\x64\x65\163\57\x6a\x73\57\x63\x61\x6c\x64\145\x72\141\x2e\x6d\151\x6e\x2e\152\x73", array("\152\x71\x75\x65\x72\171"));
        wp_localize_script("\x6d\157\x63\141\x6c\144\x65\x72\x61", "\x6d\157\143\141\154\144\x65\x72\x61", array("\x73\x69\164\x65\125\x52\x4c" => wp_ajax_url(), "\x6f\x74\160\124\x79\x70\x65" => $this->_otpType, "\x66\x6f\x72\x6d\x6b\145\171" => strcasecmp($this->_otpType, $this->_typePhoneTag) == 0 ? "\160\x68\x6f\x6e\145\x6b\x65\x79" : "\x65\155\141\151\154\x6b\145\x79", "\156\157\156\x63\145" => wp_create_nonce($this->_nonce), "\142\165\164\x74\x6f\x6e\164\x65\x78\164" => mo_($this->_buttonText), "\x69\x6d\x67\125\122\114" => MOV_LOADER_URL, "\x66\x6f\162\155\163" => $this->_formDetails, "\x67\145\156\145\x72\x61\164\145\x55\122\114" => $this->_generateOTPAction));
        wp_enqueue_script("\155\157\143\141\x6c\x64\x65\x72\141");
    }
    function _send_otp()
    {
        $Jf = $_POST;
        $this->validateAjaxRequest();
        MoUtility::initialize_transaction($this->_formSessionVar);
        if ($this->_otpType == $this->_typePhoneTag) {
            goto sx;
        }
        $this->_processEmailAndStartOTPVerificationProcess($Jf);
        goto RJ;
        sx:
        $this->_processPhoneAndStartOTPVerificationProcess($Jf);
        RJ:
    }
    private function _processEmailAndStartOTPVerificationProcess($Jf)
    {
        if (!MoUtility::sanitizeCheck("\x75\x73\145\x72\x5f\x65\155\141\x69\x6c", $Jf)) {
            goto Kd;
        }
        $this->setSessionAndStartOTPVerification($Jf["\165\163\145\x72\x5f\145\x6d\141\x69\154"], $Jf["\165\x73\145\x72\137\145\155\141\151\x6c"], NULL, VerificationType::EMAIL);
        goto sG;
        Kd:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_EMAIL), MoConstants::ERROR_JSON_TYPE));
        sG:
    }
    private function _processPhoneAndStartOTPVerificationProcess($Jf)
    {
        if (!MoUtility::sanitizeCheck("\165\x73\x65\162\x5f\x70\150\x6f\x6e\145", $Jf)) {
            goto k_;
        }
        $this->setSessionAndStartOTPVerification(trim($Jf["\x75\163\x65\x72\137\160\150\x6f\156\x65"]), NULL, trim($Jf["\165\163\145\162\137\160\x68\157\x6e\145"]), VerificationType::PHONE);
        goto tA;
        k_:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_PHONE), MoConstants::ERROR_JSON_TYPE));
        tA:
    }
    private function setSessionAndStartOTPVerification($Vf, $I4, $mF, $F3)
    {
        SessionUtils::addEmailOrPhoneVerified($this->_formSessionVar, $Vf, $F3);
        $this->sendChallenge('', $I4, NULL, $mF, $F3);
    }
    public function validateForm($V4, $uG, $form)
    {
        if (!is_wp_error($V4)) {
            goto Hx;
        }
        return $V4;
        Hx:
        $so = $form["\x49\x44"];
        if (array_key_exists($so, $this->_formDetails)) {
            goto lz;
        }
        return $V4;
        lz:
        $nk = $this->_formDetails[$so];
        $V4 = $this->checkIfOtpVerificationStarted($V4);
        if (!is_wp_error($V4)) {
            goto l3;
        }
        return $V4;
        l3:
        if (strcasecmp($this->_otpType, $this->_typeEmailTag) == 0 && strcasecmp($uG["\x49\x44"], $nk["\145\x6d\141\151\154\x6b\145\171"]) == 0) {
            goto zc;
        }
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0 && strcasecmp($uG["\x49\x44"], $nk["\x70\x68\x6f\156\x65\153\x65\x79"]) == 0) {
            goto z4;
        }
        if (empty($errors) && strcasecmp($uG["\111\x44"], $nk["\166\x65\x72\151\x66\x79\x4b\145\x79"]) == 0) {
            goto Ir;
        }
        goto B_;
        zc:
        $V4 = $this->processEmail($V4);
        goto B_;
        z4:
        $V4 = $this->processPhone($V4);
        goto B_;
        Ir:
        $V4 = $this->processOTPEntered($V4);
        B_:
        return $V4;
    }
    function processOTPEntered($V4)
    {
        $Jw = $this->getVerificationType();
        $this->validateChallenge($Jw, NULL, $V4);
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $Jw)) {
            goto O1;
        }
        $V4 = new WP_Error("\111\x4e\126\101\x4c\x49\104\x5f\117\x54\120", MoUtility::_get_invalid_otp_method());
        O1:
        return $V4;
    }
    function checkIfOtpVerificationStarted($V4)
    {
        return SessionUtils::isOTPInitialized($this->_formSessionVar) ? $V4 : new WP_Error("\x45\x4e\124\105\122\137\126\x45\x52\x49\x46\131\137\103\117\x44\x45", MoMessages::showMessage(MoMessages::ENTER_VERIFY_CODE));
    }
    function processEmail($V4)
    {
        return SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $V4) ? $V4 : new WP_Error("\105\115\101\x49\x4c\137\115\111\123\x4d\101\x54\x43\x48", MoMessages::showMessage(MoMessages::EMAIL_MISMATCH));
    }
    function processPhone($V4)
    {
        return SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $V4) ? $V4 : new WP_Error("\120\x48\117\116\x45\x5f\x4d\111\x53\x4d\x41\x54\103\x48", MoMessages::showMessage(MoMessages::PHONE_MISMATCH));
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VERIFICATION_FAILED, $m5);
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_formSessionVar, $this->_txSessionId));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->_otpType == $this->_typePhoneTag)) {
            goto RL;
        }
        $lP = array_merge($lP, $this->_phoneFormId);
        RL:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto u5;
        }
        return;
        u5:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x63\x61\x6c\x64\x65\162\141\137\145\x6e\x61\x62\x6c\x65");
        $this->_otpType = $this->sanitizeFormPOST("\143\x61\154\x64\145\x72\x61\137\145\x6e\x61\142\x6c\x65\x5f\x74\x79\160\x65");
        $this->_buttonText = $this->sanitizeFormPOST("\143\x61\x6c\144\145\162\141\137\142\x75\164\x74\x6f\156\137\x74\145\170\164");
        $form = $this->parseFormDetails();
        $this->_formDetails = !empty($form) ? $form : '';
        update_mo_option("\x63\x61\x6c\x64\x65\162\141\137\x65\156\x61\142\x6c\145", $this->_isFormEnabled);
        update_mo_option("\x63\141\x6c\x64\x65\x72\141\137\145\x6e\141\x62\154\x65\x5f\x74\x79\x70\145", $this->_otpType);
        update_mo_option("\143\141\154\144\145\x72\141\137\142\165\164\164\157\x6e\x5f\x74\145\x78\164", $this->_buttonText);
        update_mo_option("\x63\141\x6c\x64\x65\x72\x61\x5f\x66\157\x72\x6d\163", maybe_serialize($this->_formDetails));
    }
    function parseFormDetails()
    {
        $form = array();
        if (!(!array_key_exists("\x63\141\154\144\145\162\x61\137\146\x6f\162\x6d", $_POST) || !$this->_isFormEnabled)) {
            goto DA;
        }
        return $form;
        DA:
        foreach (array_filter($_POST["\143\141\x6c\x64\145\162\x61\137\146\157\x72\x6d"]["\x66\157\162\x6d"]) as $xl => $sA) {
            $form[$sA] = array("\145\x6d\141\151\x6c\x6b\x65\x79" => $_POST["\143\141\154\x64\x65\162\141\137\x66\157\162\155"]["\x65\x6d\x61\x69\x6c\x6b\145\171"][$xl], "\x70\x68\x6f\x6e\x65\153\145\171" => $_POST["\x63\x61\154\x64\145\162\141\137\146\157\162\x6d"]["\160\150\157\156\145\153\x65\x79"][$xl], "\166\x65\x72\x69\x66\171\113\x65\x79" => $_POST["\x63\141\x6c\144\145\x72\x61\137\146\157\x72\155"]["\x76\x65\x72\151\x66\171\x4b\145\x79"][$xl], "\x70\x68\x6f\x6e\145\x5f\x73\150\157\167" => $_POST["\x63\x61\154\x64\145\x72\x61\x5f\x66\x6f\x72\155"]["\x70\x68\x6f\156\x65\153\145\171"][$xl], "\145\155\x61\x69\154\x5f\163\x68\157\167" => $_POST["\143\x61\x6c\x64\145\x72\141\x5f\x66\157\x72\x6d"]["\x65\x6d\141\151\x6c\x6b\x65\x79"][$xl], "\166\145\x72\x69\x66\x79\137\x73\x68\157\167" => $_POST["\x63\141\154\144\x65\x72\x61\137\146\157\162\x6d"]["\166\145\x72\151\146\x79\113\145\171"][$xl]);
            tw:
        }
        BH:
        return $form;
    }
}
