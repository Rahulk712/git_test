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
use OTP\Objects\VerificationLogic;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
use WP_Error;
class WooCommerceProductVendors extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_formSessionVar = FormSessionVars::WC_PRODUCT_VENDOR;
        $this->_isAjaxForm = TRUE;
        $this->_typePhoneTag = "\155\x6f\137\167\x63\137\160\166\137\160\150\x6f\x6e\x65\x5f\145\156\141\x62\x6c\145";
        $this->_typeEmailTag = "\155\157\x5f\167\x63\137\160\166\137\x65\155\x61\151\x6c\x5f\145\156\141\142\x6c\x65";
        $this->_phoneFormId = "\43\x72\145\x67\x5f\x62\x69\154\154\151\156\147\x5f\160\x68\x6f\156\145";
        $this->_formKey = "\x57\x43\137\120\126\x5f\122\105\x47\137\x46\x4f\122\115";
        $this->_formName = mo_("\x57\157\157\143\x6f\x6d\x6d\x65\162\143\145\x20\x50\162\157\144\x75\143\164\40\126\x65\156\x64\x6f\162\x20\x52\x65\147\151\x73\164\162\x61\x74\x69\x6f\156\x20\x46\x6f\x72\x6d");
        $this->_isFormEnabled = get_mo_option("\x77\143\x5f\160\166\x5f\144\145\146\x61\165\x6c\x74\x5f\x65\156\141\142\154\145");
        $this->_buttonText = get_mo_option("\x77\143\x5f\160\166\x5f\x62\x75\164\164\157\156\137\x74\145\170\164");
        $this->_buttonText = !MoUtility::isBlank($this->_buttonText) ? $this->_buttonText : mo_("\x43\x6c\x69\143\x6b\40\110\145\162\145\40\x74\x6f\40\x73\x65\156\144\x20\x4f\124\x50");
        $this->_formDocuments = MoOTPDocs::WC_PRODUCT_VENDOR;
        parent::__construct();
    }
    public function handleForm()
    {
        $this->_otpType = get_mo_option("\167\x63\x5f\160\166\x5f\145\156\x61\142\x6c\145\x5f\164\171\160\145");
        $this->_restrictDuplicates = get_mo_option("\167\143\x5f\x70\x76\137\x72\145\x73\164\162\x69\143\x74\x5f\x64\x75\160\154\x69\x63\x61\164\145\x73");
        add_action("\167\x63\x70\166\137\x72\x65\147\x69\x73\164\162\141\164\151\157\156\x5f\146\x6f\x72\155", array($this, "\155\157\137\x61\x64\x64\x5f\160\x68\157\156\145\x5f\x66\151\x65\x6c\144"), 1);
        add_action("\167\x70\x5f\x61\152\x61\x78\x5f\x6e\157\160\162\x69\166\x5f\x6d\x69\x6e\151\157\x72\141\x6e\x67\x65\137\x77\143\137\166\x70\137\162\x65\147\137\x76\x65\x72\151\x66\171", array($this, "\163\x65\x6e\x64\x41\x6a\141\x78\x4f\x54\x50\x52\145\161\165\145\163\164"));
        add_filter("\x77\x63\x70\x76\137\x73\x68\157\162\x74\x63\157\144\145\x5f\x72\x65\147\151\x73\x74\162\x61\x74\151\157\156\137\x66\x6f\x72\x6d\x5f\166\x61\x6c\151\144\x61\164\x69\x6f\156\x5f\x65\x72\x72\157\162\x73", array($this, "\x72\x65\147\137\146\x69\145\154\144\x73\137\145\x72\162\x6f\x72\163"), 1, 2);
        add_action("\x77\x70\x5f\145\x6e\161\x75\145\x75\x65\x5f\163\143\162\x69\x70\164\163", array($this, "\x6d\151\x6e\151\157\x72\141\156\147\x65\137\162\145\x67\151\163\x74\145\x72\x5f\167\143\137\x73\x63\162\151\160\x74"));
    }
    public function sendAjaxOTPRequest()
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        $this->validateAjaxRequest();
        $m6 = MoUtility::sanitizeCheck("\165\x73\145\162\137\160\150\157\156\x65", $_POST);
        $Kc = MoUtility::sanitizeCheck("\x75\x73\145\x72\137\x65\155\x61\151\x6c", $_POST);
        if ($this->_otpType === $this->_typePhoneTag) {
            goto gh;
        }
        SessionUtils::addEmailVerified($this->_formSessionVar, $Kc);
        goto sW;
        gh:
        SessionUtils::addPhoneVerified($this->_formSessionVar, MoUtility::processPhoneNumber($m6));
        sW:
        $WC = $this->processFormFields(null, $Kc, new WP_Error(), null, $m6);
        if (!$WC->get_error_code()) {
            goto uc;
        }
        wp_send_json(MoUtility::createJson($WC->get_error_message(), MoConstants::ERROR_JSON_TYPE));
        uc:
    }
    public function reg_fields_errors($errors, $rI)
    {
        if (empty($errors)) {
            goto tI;
        }
        return $errors;
        tI:
        $this->assertOTPField($errors, $rI);
        $this->checkIfOTPWasSent($errors);
        return $this->checkIntegrityAndValidateOTP($rI, $errors);
    }
    private function assertOTPField(&$errors, $rI)
    {
        if (MoUtility::sanitizeCheck("\155\157\x76\145\162\x69\x66\x79", $rI)) {
            goto Iw;
        }
        $errors[] = MoMessages::showMessage(MoMessages::REQUIRED_OTP);
        Iw:
    }
    private function checkIfOTPWasSent(&$errors)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto pk;
        }
        $errors[] = MoMessages::showMessage(MoMessages::PLEASE_VALIDATE);
        pk:
    }
    private function checkIntegrityAndValidateOTP($Jf, array $errors)
    {
        if (empty($errors)) {
            goto Fn;
        }
        return $errors;
        Fn:
        $Jf["\x62\151\x6c\x6c\151\x6e\147\137\160\x68\157\x6e\x65"] = MoUtility::processPhoneNumber($Jf["\x62\151\x6c\154\151\156\147\137\x70\x68\x6f\156\145"]);
        $errors = $this->checkIntegrity($Jf, $errors);
        if (empty($errors->errors)) {
            goto DB;
        }
        return $errors;
        DB:
        $Jw = $this->getVerificationType();
        $this->validateChallenge($Jw, NULL, $Jf["\x6d\157\166\145\162\x69\146\x79"]);
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $Jw)) {
            goto pM;
        }
        $this->unsetOTPSessionVariables();
        goto gk;
        pM:
        $errors[] = MoUtility::_get_invalid_otp_method();
        gk:
        return $errors;
    }
    private function checkIntegrity($Jf, array $errors)
    {
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto Bj;
        }
        if (!(strcasecmp($this->_otpType, $this->_typeEmailTag) == 0)) {
            goto Re;
        }
        if (SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $Jf["\x65\x6d\x61\151\154"])) {
            goto Jl;
        }
        $errors[] = MoMessages::showMessage(MoMessages::EMAIL_MISMATCH);
        Jl:
        Re:
        goto Uq;
        Bj:
        if (SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, MoUtility::processPhoneNumber($Jf["\142\151\x6c\154\x69\156\x67\x5f\160\x68\x6f\156\145"]))) {
            goto KN;
        }
        $errors[] = MoMessages::showMessage(MoMessages::PHONE_MISMATCH);
        KN:
        Uq:
        return $errors;
    }
    function processFormFields($Iv, $xX, $errors, $wh, $lr)
    {
        global $phoneLogic;
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) === 0) {
            goto zh;
        }
        if (!(strcasecmp($this->_otpType, $this->_typeEmailTag) === 0)) {
            goto lx;
        }
        $lr = isset($lr) ? $lr : '';
        $this->sendChallenge($Iv, $xX, $errors, $lr, VerificationType::EMAIL, $wh);
        lx:
        goto hy;
        zh:
        if (!isset($lr) || !MoUtility::validatePhoneNumber($lr)) {
            goto bB;
        }
        if ($this->_restrictDuplicates && $this->isPhoneNumberAlreadyInUse($lr, "\142\x69\x6c\154\151\x6e\x67\137\x70\150\157\x6e\145")) {
            goto la;
        }
        goto Ik;
        bB:
        return new WP_Error("\142\x69\154\154\151\156\x67\137\160\150\157\156\x65\x5f\x65\x72\x72\x6f\162", str_replace("\x23\43\x70\x68\157\x6e\145\x23\43", $lr, $phoneLogic->_get_otp_invalid_format_message()));
        goto Ik;
        la:
        return new WP_Error("\142\151\x6c\154\151\x6e\147\x5f\x70\x68\x6f\156\x65\x5f\x65\x72\162\157\162", MoMessages::showMessage(MoMessages::PHONE_EXISTS));
        Ik:
        $this->sendChallenge($Iv, $xX, $errors, $lr, VerificationType::PHONE, $wh);
        hy:
        return $errors;
    }
    function isPhoneNumberAlreadyInUse($lr, $xl)
    {
        global $wpdb;
        $lr = MoUtility::processPhoneNumber($lr);
        $D5 = $wpdb->get_row("\123\105\114\x45\x43\x54\40\140\165\163\x65\162\137\x69\x64\140\40\x46\122\x4f\115\40\x60{$wpdb->prefix}\165\x73\145\x72\x6d\x65\164\141\140\40\127\110\105\122\105\x20\140\155\x65\164\x61\x5f\x6b\x65\x79\x60\x20\x3d\40\x27{$xl}\x27\x20\x41\116\104\x20\x60\x6d\145\x74\141\x5f\x76\x61\154\165\x65\140\x20\75\40\40\x27{$lr}\47");
        return !MoUtility::isBlank($D5);
    }
    function miniorange_register_wc_script()
    {
        wp_register_script("\155\x6f\167\143\x70\x76\162\145\x67", MOV_URL . "\151\x6e\x63\x6c\165\x64\145\x73\57\x6a\163\57\167\x63\160\x76\162\145\x67\x2e\x6d\151\x6e\56\152\163", array("\152\x71\165\145\162\171"));
        wp_localize_script("\155\x6f\167\x63\160\166\x72\x65\147", "\x6d\x6f\167\143\x70\x76\x72\145\x67", array("\163\151\x74\x65\125\122\114" => wp_ajax_url(), "\x6f\x74\x70\124\x79\x70\x65" => $this->_otpType, "\156\157\156\x63\x65" => wp_create_nonce($this->_nonce), "\142\x75\x74\x74\x6f\156\x74\x65\170\164" => mo_($this->_buttonText), "\x66\x69\x65\x6c\144" => $this->_otpType === $this->_typePhoneTag ? "\162\x65\x67\x5f\x76\160\137\142\151\x6c\x6c\x69\x6e\x67\137\160\150\157\156\145" : "\x77\143\x70\x76\x2d\143\x6f\156\146\151\162\155\x2d\145\x6d\x61\x69\154", "\x69\x6d\147\125\x52\x4c" => MOV_LOADER_URL, "\x63\x6f\x64\x65\114\141\142\145\x6c" => mo_("\105\x6e\164\145\162\40\x56\145\x72\151\x66\x69\x63\141\x74\151\157\156\x20\103\x6f\144\x65")));
        wp_enqueue_script("\x6d\157\x77\143\x70\x76\x72\x65\147");
    }
    public function mo_add_phone_field()
    {
        echo "\74\x70\40\x63\x6c\141\x73\x73\x3d\x22\x66\x6f\162\x6d\x2d\x72\157\167\x20\x66\x6f\x72\x6d\x2d\162\157\167\55\x77\151\144\145\42\76\xa\x9\11\x9\x9\11\74\154\x61\x62\x65\x6c\x20\146\157\x72\75\42\162\145\x67\137\x76\160\x5f\x62\x69\x6c\154\x69\156\x67\137\x70\150\157\156\145\x22\x3e\12\11\x9\x9\11\11\x20\x20\x20\40" . mo_("\120\150\x6f\156\145") . "\12\x9\x9\x9\11\11\40\x20\40\40\x3c\x73\160\141\x6e\x20\x63\154\x61\x73\x73\x3d\x22\x72\x65\x71\x75\x69\162\x65\x64\x22\76\x2a\74\57\163\160\141\x6e\76\xa\x20\40\x20\40\40\x20\x20\40\40\x20\x20\x20\40\x20\x20\40\40\40\x20\x20\x3c\57\x6c\141\142\x65\x6c\x3e\xa\x9\11\11\x9\11\x3c\x69\x6e\x70\x75\x74\x20\164\x79\x70\x65\x3d\42\x74\x65\170\164\x22\40\143\154\x61\x73\x73\x3d\42\x69\x6e\160\165\x74\55\164\145\170\164\42\40\12\x9\x9\x9\x9\x9\40\40\x20\40\40\x20\x20\40\x6e\x61\155\x65\75\x22\142\x69\154\154\151\x6e\x67\137\160\150\157\x6e\x65\42\x20\151\x64\75\x22\x72\145\x67\137\166\160\x5f\142\x69\154\x6c\x69\x6e\x67\137\x70\150\157\x6e\x65\x22\x20\xa\11\11\11\x9\11\40\40\x20\x20\x20\x20\40\x20\x76\x61\154\x75\145\75\42" . (!empty($_POST["\142\151\154\x6c\151\156\147\137\x70\x68\x6f\156\145"]) ? $_POST["\142\151\x6c\x6c\x69\x6e\147\x5f\x70\x68\x6f\156\x65"] : '') . "\x22\40\57\76\xa\x9\x9\11\x20\x20\11\40\40\74\x2f\x70\76";
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
    }
    public function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VERIFICATION_FAILED, $m5);
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!$this->isFormEnabled()) {
            goto KD;
        }
        array_push($lP, $this->_phoneFormId);
        KD:
        return $lP;
    }
    public function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto Dz;
        }
        return;
        Dz:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\167\x63\137\160\166\137\x64\145\146\x61\165\154\164\x5f\x65\x6e\141\142\154\145");
        $this->_otpType = $this->sanitizeFormPOST("\x77\x63\137\x70\166\x5f\145\x6e\141\142\154\x65\x5f\164\171\x70\x65");
        $this->_restrictDuplicates = $this->sanitizeFormPOST("\x77\143\x5f\x70\166\x5f\x72\x65\163\164\162\x69\143\164\137\x64\x75\160\154\x69\143\141\164\x65\163");
        $this->_buttonText = $this->sanitizeFormPOST("\167\x63\137\x70\x76\x5f\142\x75\164\x74\x6f\156\137\x74\x65\x78\x74");
        update_mo_option("\167\x63\137\160\x76\x5f\144\145\x66\141\x75\x6c\164\x5f\145\156\x61\x62\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\x77\x63\x5f\160\166\x5f\x65\x6e\x61\x62\x6c\x65\x5f\x74\x79\160\145", $this->_otpType);
        update_mo_option("\x77\143\137\x70\166\x5f\x72\x65\x73\x74\162\x69\x63\164\137\144\x75\160\x6c\x69\143\141\x74\x65\x73", $this->_restrictDuplicates);
        update_mo_option("\x77\x63\137\160\x76\137\x62\165\164\x74\157\x6e\x5f\164\145\x78\164", $this->_buttonText);
    }
}
