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
class WPFormsPlugin extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::WPFORM;
        $this->_phoneFormId = array();
        $this->_formKey = "\x57\120\106\x4f\122\x4d\x53";
        $this->_typePhoneTag = "\155\x6f\x5f\x77\160\146\157\x72\x6d\x5f\x70\150\x6f\156\x65\x5f\145\x6e\141\x62\154\x65";
        $this->_typeEmailTag = "\x6d\x6f\137\x77\x70\x66\157\x72\155\x5f\x65\155\141\x69\x6c\x5f\145\x6e\141\142\154\145";
        $this->_typeBothTag = "\x6d\157\137\x77\160\146\157\x72\155\x5f\x62\x6f\x74\150\x5f\x65\156\141\x62\x6c\x65";
        $this->_formName = mo_("\x57\x50\106\157\162\x6d\163");
        $this->_isFormEnabled = get_mo_option("\167\x70\x66\157\162\x6d\137\145\x6e\141\142\154\x65");
        $this->_buttonText = get_mo_option("\167\160\x66\x6f\x72\x6d\163\137\142\165\164\x74\x6f\156\x5f\164\x65\170\164");
        $this->_buttonText = !MoUtility::isBlank($this->_buttonText) ? $this->_buttonText : mo_("\x53\145\x6e\144\x20\x4f\124\120");
        $this->_generateOTPAction = "\x6d\x69\x6e\x69\157\162\x61\156\x67\x65\55\x77\160\x66\x6f\x72\x6d\x2d\163\145\x6e\x64\55\x6f\164\x70";
        $this->_validateOTPAction = "\x6d\151\156\x69\157\162\x61\x6e\x67\x65\55\167\160\x66\x6f\x72\155\55\166\x65\162\151\146\x79\55\x63\157\x64\x65";
        $this->_formDocuments = MoOTPDocs::WP_FORMS_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x77\x70\146\x6f\162\x6d\x5f\x65\156\x61\x62\154\x65\137\164\x79\160\x65");
        $this->_formDetails = maybe_unserialize(get_mo_option("\167\x70\146\x6f\162\x6d\137\146\x6f\x72\155\163"));
        if (!empty($this->_formDetails)) {
            goto SH;
        }
        return;
        SH:
        if (!($this->_otpType === $this->_typePhoneTag || $this->_otpType === $this->_typeBothTag)) {
            goto dy;
        }
        foreach ($this->_formDetails as $xl => $sA) {
            array_push($this->_phoneFormId, "\x23\167\160\146\157\162\155\x73\55" . $xl . "\55\x66\151\145\x6c\144\137" . $sA["\160\150\x6f\156\x65\153\x65\171"]);
            u_:
        }
        ks:
        dy:
        add_filter("\167\x70\x66\157\162\x6d\163\137\x70\162\x6f\143\145\x73\x73\x5f\x69\x6e\x69\164\x69\141\154\137\x65\162\162\157\162\x73", array($this, "\166\141\x6c\151\144\x61\164\145\x46\157\x72\x6d"), 1, 2);
        add_action("\167\160\x5f\145\x6e\161\165\x65\x75\x65\137\x73\143\162\151\x70\164\x73", array($this, "\155\x6f\137\145\x6e\x71\x75\x65\165\x65\137\167\x70\x66\157\162\x6d\x73"));
        add_action("\x77\x70\137\141\152\x61\170\137{$this->_generateOTPAction}", array($this, "\x5f\x73\x65\x6e\x64\137\157\x74\x70"));
        add_action("\x77\160\137\141\152\x61\170\x5f\x6e\157\x70\x72\x69\x76\x5f{$this->_generateOTPAction}", array($this, "\x5f\163\x65\156\x64\137\x6f\164\160"));
        add_action("\x77\x70\x5f\x61\152\x61\x78\x5f{$this->_validateOTPAction}", array($this, "\160\x72\x6f\143\145\x73\163\106\157\x72\155\x41\156\144\126\141\154\151\144\x61\x74\x65\117\124\120"));
        add_action("\167\160\x5f\x61\152\141\x78\x5f\156\157\160\162\151\x76\x5f{$this->_validateOTPAction}", array($this, "\x70\x72\x6f\x63\145\x73\x73\106\157\x72\x6d\101\x6e\144\126\x61\x6c\151\x64\141\164\145\117\124\x50"));
    }
    function mo_enqueue_wpforms()
    {
        wp_register_script("\155\157\167\160\146\x6f\x72\x6d\x73", MOV_URL . "\151\x6e\143\154\165\x64\x65\x73\57\x6a\x73\x2f\x6d\x6f\167\x70\x66\157\162\155\163\56\155\151\156\x2e\x6a\x73", array("\152\x71\x75\x65\162\x79"));
        wp_localize_script("\x6d\x6f\167\160\x66\157\x72\x6d\x73", "\x6d\157\167\x70\x66\x6f\x72\x6d\x73", array("\163\151\x74\145\x55\122\x4c" => wp_ajax_url(), "\x6f\x74\x70\124\171\x70\145" => $this->ajaxProcessingFields(), "\146\x6f\x72\155\104\x65\x74\x61\151\x6c\x73" => $this->_formDetails, "\142\165\x74\x74\x6f\156\164\x65\170\x74" => $this->_buttonText, "\x76\x61\154\x69\x64\x61\x74\x65\x64" => $this->getSessionDetails(), "\151\x6d\147\x55\122\x4c" => MOV_LOADER_URL, "\x66\151\x65\154\x64\124\145\170\x74" => mo_("\x45\156\164\145\162\40\117\x54\x50\40\x68\145\x72\x65"), "\147\x6e\157\156\x63\145" => wp_create_nonce($this->_nonce), "\x6e\157\156\x63\145\x4b\x65\171" => wp_create_nonce($this->_nonceKey), "\x76\x6e\157\156\143\145" => wp_create_nonce($this->_nonce), "\x67\141\x63\164\x69\x6f\156" => $this->_generateOTPAction, "\166\141\x63\x74\151\x6f\156" => $this->_validateOTPAction));
        wp_enqueue_script("\x6d\157\167\x70\x66\x6f\162\155\x73");
    }
    function getSessionDetails()
    {
        return array(VerificationType::EMAIL => SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, VerificationType::EMAIL), VerificationType::PHONE => SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, VerificationType::PHONE));
    }
    function _send_otp()
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if ("\155\157\x5f\167\x70\146\157\162\x6d\137" . $_POST["\157\164\x70\x54\171\160\145"] . "\137\x65\156\141\x62\154\145" === $this->_typePhoneTag) {
            goto KG;
        }
        $this->_processEmailAndSendOTP($_POST);
        goto T2;
        KG:
        $this->_processPhoneAndSendOTP($_POST);
        T2:
    }
    private function _processEmailAndSendOTP($Jf)
    {
        if (!MoUtility::sanitizeCheck("\165\163\x65\x72\137\145\x6d\x61\151\x6c", $Jf)) {
            goto m_;
        }
        SessionUtils::addEmailVerified($this->_formSessionVar, $Jf["\165\x73\x65\x72\x5f\x65\155\x61\x69\154"]);
        $this->sendChallenge('', $Jf["\x75\x73\145\x72\137\145\155\x61\x69\154"], NULL, NULL, VerificationType::EMAIL);
        goto wZ;
        m_:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_EMAIL), MoConstants::ERROR_JSON_TYPE));
        wZ:
    }
    private function _processPhoneAndSendOTP($Jf)
    {
        if (!MoUtility::sanitizeCheck("\x75\163\x65\x72\x5f\x70\x68\157\156\145", $Jf)) {
            goto q0;
        }
        SessionUtils::addPhoneVerified($this->_formSessionVar, $Jf["\x75\163\x65\162\137\x70\150\157\x6e\145"]);
        $this->sendChallenge('', NULL, NULL, $Jf["\x75\163\x65\x72\137\160\x68\x6f\156\145"], VerificationType::PHONE);
        goto KL;
        q0:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_PHONE), MoConstants::ERROR_JSON_TYPE));
        KL:
    }
    function processFormAndValidateOTP()
    {
        $this->validateAjaxRequest();
        $this->checkIfOTPSent();
        $this->checkIntegrityAndValidateOTP($_POST);
    }
    function checkIfOTPSent()
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto Yw;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_VERIFY_CODE), MoConstants::ERROR_JSON_TYPE));
        Yw:
    }
    private function checkIntegrityAndValidateOTP($Jf)
    {
        $this->checkIntegrity($Jf);
        $this->validateChallenge($Jf["\x6f\164\x70\124\x79\x70\x65"], NULL, $Jf["\x6f\x74\x70\x5f\164\x6f\x6b\145\x6e"]);
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $Jf["\157\x74\160\124\x79\x70\145"])) {
            goto gx;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::INVALID_OTP), MoConstants::ERROR_JSON_TYPE));
        goto nv;
        gx:
        wp_send_json(MoUtility::createJson(MoConstants::SUCCESS_JSON_TYPE, MoConstants::SUCCESS_JSON_TYPE));
        nv:
    }
    private function checkIntegrity($Jf)
    {
        if ($Jf["\x6f\164\160\x54\171\x70\x65"] === "\160\150\x6f\156\145") {
            goto D8;
        }
        if (SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $Jf["\165\x73\145\162\137\145\155\141\x69\154"])) {
            goto wE;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::EMAIL_MISMATCH), MoConstants::ERROR_JSON_TYPE));
        wE:
        goto Kk;
        D8:
        if (SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $Jf["\165\163\145\x72\137\160\150\157\156\x65"])) {
            goto Oy;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::PHONE_MISMATCH), MoConstants::ERROR_JSON_TYPE));
        Oy:
        Kk:
    }
    public function validateForm($errors, $nk)
    {
        $so = $nk["\151\144"];
        if (array_key_exists($so, $this->_formDetails)) {
            goto BC;
        }
        return $errors;
        BC:
        $nk = $this->_formDetails[$so];
        if (empty($errors)) {
            goto xD;
        }
        return $errors;
        xD:
        if (!($this->_otpType === $this->_typeEmailTag || $this->_otpType === $this->_typeBothTag)) {
            goto eG;
        }
        $errors = $this->processEmail($nk, $errors, $so);
        eG:
        if (!($this->_otpType === $this->_typePhoneTag || $this->_otpType === $this->_typeBothTag)) {
            goto tE;
        }
        $errors = $this->processPhone($nk, $errors, $so);
        tE:
        if (!empty($errors)) {
            goto dU;
        }
        $this->unsetOTPSessionVariables();
        dU:
        return $errors;
    }
    function processEmail($nk, $errors, $so)
    {
        $LT = $nk["\145\x6d\x61\x69\x6c\153\145\x79"];
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, VerificationType::EMAIL)) {
            goto h0;
        }
        $errors[$so][$LT] = MoMessages::showMessage(MoMessages::ENTER_VERIFY_CODE);
        h0:
        if (SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $_POST["\167\x70\x66\x6f\162\x6d\163"]["\146\x69\145\154\144\x73"][$LT])) {
            goto R4;
        }
        $errors[$so][$LT] = MoMessages::showMessage(MoMessages::EMAIL_MISMATCH);
        R4:
        return $errors;
    }
    function processPhone($nk, $errors, $so)
    {
        $LT = $nk["\160\x68\157\x6e\x65\x6b\x65\171"];
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, VerificationType::PHONE)) {
            goto qp;
        }
        $errors[$so][$LT] = MoMessages::showMessage(MoMessages::ENTER_VERIFY_CODE);
        qp:
        if (SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $_POST["\167\x70\x66\157\162\155\x73"]["\146\151\x65\x6c\x64\163"][$LT])) {
            goto Gk;
        }
        $errors[$so][$LT] = MoMessages::showMessage(MoMessages::PHONE_MISMATCH);
        Gk:
        return $errors;
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
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->_isFormEnabled && ($this->_otpType === $this->_typePhoneTag || $this->_otpType === $this->_typeBothTag))) {
            goto ZV;
        }
        $lP = array_merge($lP, $this->_phoneFormId);
        ZV:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto sX;
        }
        return;
        sX:
        $form = $this->parseFormDetails();
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x77\x70\x66\157\x72\155\x5f\145\156\141\142\154\x65");
        $this->_otpType = $this->sanitizeFormPOST("\167\x70\x66\x6f\x72\155\x5f\145\x6e\141\142\x6c\x65\x5f\x74\171\x70\x65");
        $this->_buttonText = $this->sanitizeFormPOST("\x77\160\x66\157\162\155\x73\x5f\x62\165\164\164\x6f\156\x5f\x74\145\x78\x74");
        $this->_formDetails = !empty($form) ? $form : '';
        update_mo_option("\x77\x70\x66\x6f\162\x6d\137\x65\x6e\x61\142\154\x65", $this->_isFormEnabled);
        update_mo_option("\167\160\x66\157\162\x6d\x5f\x65\x6e\x61\142\x6c\x65\x5f\x74\x79\x70\x65", $this->_otpType);
        update_mo_option("\x77\160\146\x6f\x72\155\x73\137\x62\165\x74\164\157\156\x5f\x74\x65\x78\x74", $this->_buttonText);
        update_mo_option("\x77\x70\146\157\x72\x6d\137\x66\x6f\162\x6d\x73", maybe_serialize($this->_formDetails));
    }
    function parseFormDetails()
    {
        $form = array();
        if (array_key_exists("\x77\x70\x66\x6f\162\155\137\146\157\162\155", $_POST)) {
            goto xn;
        }
        return $form;
        xn:
        foreach (array_filter($_POST["\167\160\x66\157\162\x6d\137\146\157\x72\155"]["\146\157\162\155"]) as $xl => $sA) {
            $nk = $this->getFormDataFromID($sA);
            if (!MoUtility::isBlank($nk)) {
                goto L0;
            }
            goto nE;
            L0:
            $W0 = $this->getFieldIDs($_POST, $xl, $nk);
            $form[$sA] = array("\145\x6d\141\x69\154\x6b\145\171" => $W0["\x65\x6d\141\151\154\x4b\x65\x79"], "\x70\x68\157\156\145\x6b\145\x79" => $W0["\160\x68\157\156\145\x4b\145\171"], "\166\145\x72\x69\x66\x79\x4b\145\x79" => $W0["\166\145\162\x69\x66\171\x4b\x65\171"], "\160\x68\x6f\156\x65\x5f\x73\x68\x6f\167" => $_POST["\x77\160\x66\x6f\x72\155\x5f\146\x6f\162\x6d"]["\160\150\157\156\x65\x6b\x65\x79"][$xl], "\x65\x6d\x61\151\154\137\163\150\157\x77" => $_POST["\167\x70\146\157\x72\155\x5f\146\x6f\162\155"]["\x65\155\x61\151\x6c\x6b\x65\x79"][$xl], "\x76\x65\162\x69\x66\x79\x5f\x73\x68\157\x77" => $_POST["\167\x70\146\x6f\162\155\137\146\x6f\162\x6d"]["\x76\x65\162\151\x66\171\113\x65\171"][$xl]);
            nE:
        }
        cW:
        return $form;
    }
    private function getFormDataFromID($so)
    {
        if (!Moutility::isBlank($so)) {
            goto xC;
        }
        return '';
        xC:
        $form = get_post(absint($so));
        if (!MoUtility::isBlank($so)) {
            goto XN;
        }
        return '';
        XN:
        return wp_unslash(json_decode($form->post_content));
    }
    private function getFieldIDs($Jf, $xl, $nk)
    {
        $W0 = array("\x65\x6d\x61\x69\154\x4b\x65\x79" => '', "\x70\150\157\156\x65\x4b\145\x79" => '', "\x76\x65\x72\x69\146\x79\x4b\x65\171" => '');
        if (!empty($Jf)) {
            goto up;
        }
        return $W0;
        up:
        foreach ($nk->fields as $uG) {
            if (property_exists($uG, "\154\x61\142\x65\154")) {
                goto OU;
            }
            goto GL;
            OU:
            if (!(strcasecmp($uG->label, $Jf["\x77\160\146\157\x72\155\137\146\x6f\x72\155"]["\x65\155\141\151\154\x6b\145\x79"][$xl]) === 0)) {
                goto dL;
            }
            $W0["\145\155\x61\x69\x6c\113\x65\x79"] = $uG->id;
            dL:
            if (!(strcasecmp($uG->label, $Jf["\167\160\x66\157\x72\x6d\x5f\146\157\162\x6d"]["\160\x68\x6f\156\x65\153\x65\171"][$xl]) === 0)) {
                goto AI;
            }
            $W0["\x70\x68\157\156\145\x4b\145\171"] = $uG->id;
            AI:
            if (!(strcasecmp($uG->label, $Jf["\167\x70\146\157\162\x6d\137\x66\157\162\155"]["\166\145\162\151\x66\171\x4b\145\x79"][$xl]) === 0)) {
                goto Ks;
            }
            $W0["\x76\145\x72\151\146\171\113\145\x79"] = $uG->id;
            Ks:
            GL:
        }
        wU:
        return $W0;
    }
}
