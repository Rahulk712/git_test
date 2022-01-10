<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoMessages;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoPHPSessions;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
use WP_Error;
class DefaultWordPressRegistrationForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::WP_DEFAULT_REG;
        $this->_phoneKey = "\164\x65\154\145\160\150\157\x6e\x65";
        $this->_phoneFormId = "\43\x70\x68\x6f\156\145\137\156\x75\x6d\142\145\162\137\x6d\157";
        $this->_formKey = "\x57\120\x5f\x44\105\x46\101\x55\114\124";
        $this->_typePhoneTag = "\x6d\157\137\x77\160\x5f\x64\145\x66\141\x75\154\x74\x5f\160\150\157\156\145\137\145\156\141\142\x6c\x65";
        $this->_typeEmailTag = "\155\157\x5f\167\x70\137\144\x65\146\141\165\154\164\x5f\145\155\x61\x69\x6c\x5f\x65\156\x61\142\154\145";
        $this->_typeBothTag = "\155\157\x5f\167\160\137\x64\x65\x66\x61\165\x6c\164\x5f\142\157\164\150\137\x65\156\x61\x62\154\145";
        $this->_formName = mo_("\127\157\162\x64\x50\162\x65\x73\163\40\x44\x65\146\x61\x75\154\x74\40\x2f\40\124\115\114\40\122\145\x67\151\163\164\x72\141\x74\151\157\156\40\106\157\x72\x6d");
        $this->_isFormEnabled = get_mo_option("\x77\x70\137\x64\x65\x66\141\165\x6c\x74\137\145\156\141\x62\154\x65");
        $this->_formDocuments = MoOTPDocs::WP_DEFAULT_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x77\160\137\144\x65\x66\141\165\154\x74\x5f\x65\156\141\142\154\x65\x5f\x74\x79\x70\145");
        $this->_disableAutoActivate = get_mo_option("\167\160\137\x72\145\147\137\141\x75\x74\157\137\141\x63\164\x69\166\x61\x74\145") ? FALSE : TRUE;
        $this->_restrictDuplicates = get_mo_option("\167\x70\x5f\162\145\x67\x5f\x72\x65\x73\164\162\x69\x63\164\x5f\x64\x75\160\x6c\151\143\141\x74\145\163");
        add_action("\162\x65\x67\151\163\x74\x65\162\137\x66\x6f\162\155", array($this, "\x6d\151\x6e\151\157\162\x61\x6e\147\145\137\x73\x69\x74\145\137\162\x65\147\x69\x73\164\x65\162\137\x66\157\x72\x6d"));
        add_filter("\x72\x65\x67\x69\x73\164\x72\141\x74\x69\x6f\156\137\145\x72\162\x6f\x72\163", array($this, "\155\151\156\151\157\162\141\x6e\x67\x65\137\163\151\x74\x65\x5f\x72\x65\x67\151\x73\x74\162\141\164\151\157\x6e\137\x65\162\162\157\x72\x73"), 99, 3);
        add_action("\141\144\x6d\151\156\137\160\157\x73\x74\x5f\156\x6f\160\162\151\166\137\x76\x61\x6c\151\x64\x61\x74\151\x6f\x6e\137\x67\157\x42\x61\x63\x6b", array($this, "\137\150\x61\156\144\x6c\x65\137\166\141\154\x69\144\141\x74\151\x6f\x6e\137\x67\157\x42\x61\x63\153\137\x61\x63\164\x69\157\156"));
        add_action("\165\163\145\162\x5f\x72\x65\147\x69\x73\164\145\x72", array($this, "\x6d\151\156\x69\157\162\141\x6e\x67\x65\x5f\162\x65\147\x69\163\164\162\x61\164\x69\157\156\x5f\163\141\x76\x65"), 10, 1);
        add_filter("\x77\160\x5f\154\157\147\151\x6e\x5f\x65\x72\162\x6f\x72\x73", array($this, "\155\151\x6e\x69\157\x72\141\156\x67\x65\x5f\x63\165\163\164\x6f\155\x5f\162\x65\x67\x5f\x6d\145\x73\x73\x61\x67\x65"), 10, 2);
        if ($this->_disableAutoActivate) {
            goto yd;
        }
        remove_action("\162\145\x67\x69\163\164\x65\x72\137\156\x65\167\137\x75\x73\145\162", "\x77\x70\x5f\163\x65\156\x64\137\x6e\145\167\x5f\x75\163\x65\x72\137\x6e\157\164\151\146\151\x63\x61\x74\x69\157\x6e\x73");
        yd:
    }
    function isPhoneVerificationEnabled()
    {
        $m5 = $this->getVerificationType();
        return $m5 === VerificationType::PHONE || $m5 === VerificationType::BOTH;
    }
    function miniorange_custom_reg_message(WP_Error $errors, $fC)
    {
        if ($this->_disableAutoActivate) {
            goto mv;
        }
        if (!in_array("\162\x65\147\151\x73\x74\145\162\145\x64", $errors->get_error_codes())) {
            goto KU;
        }
        $errors->remove("\162\x65\x67\x69\x73\x74\145\x72\145\144");
        $errors->add("\162\x65\147\x69\x73\x74\145\x72\145\144", mo_("\x52\x65\147\x69\x73\x74\x72\141\x74\151\x6f\x6e\40\x43\x6f\155\x70\154\x65\x74\x65\x2e"), "\155\x65\x73\x73\141\147\145");
        KU:
        mv:
        return $errors;
    }
    function miniorange_site_register_form()
    {
        echo "\74\x69\x6e\x70\x75\164\x20\164\x79\x70\x65\x3d\x22\150\151\x64\144\x65\156\x22\40\x6e\x61\x6d\145\75\42\x72\x65\147\x69\163\x74\145\x72\x5f\156\x6f\x6e\143\145\x22\40\166\x61\154\165\x65\x3d\42\162\145\147\x69\163\164\x65\162\x5f\156\157\x6e\143\x65\42\x2f\x3e";
        if (!$this->isPhoneVerificationEnabled()) {
            goto rR;
        }
        echo "\x3c\154\141\x62\145\154\x20\x66\x6f\x72\75\x22\x70\x68\157\156\145\137\x6e\x75\155\142\145\162\137\155\157\x22\76" . mo_("\x50\150\157\156\x65\40\116\165\155\x62\145\162") . "\74\142\162\x20\x2f\x3e\12\x20\40\x20\x20\40\40\x20\x20\40\x20\40\40\x20\40\x20\40\x3c\151\156\160\x75\164\x20\164\171\160\145\x3d\42\x74\145\x78\x74\42\40\156\141\x6d\145\75\x22\x70\x68\157\x6e\145\137\156\165\x6d\142\145\x72\x5f\155\157\42\x20\x69\x64\75\42\160\150\157\x6e\x65\137\156\x75\155\142\145\162\x5f\x6d\157\42\40\143\154\141\163\163\x3d\42\151\x6e\160\x75\164\42\40\166\141\154\x75\145\x3d\x22\x22\40\x73\164\171\154\x65\x3d\42\42\x2f\x3e\74\57\x6c\141\142\145\x6c\76";
        rR:
        if ($this->_disableAutoActivate) {
            goto jC;
        }
        echo "\74\154\141\142\145\x6c\40\146\x6f\162\x3d\x22\160\x61\x73\x73\167\157\162\x64\137\x6d\x6f\x22\76" . mo_("\120\141\x73\x73\167\x6f\162\144") . "\x3c\x62\x72\40\57\76\12\x20\x20\x20\40\x20\40\40\x20\x20\x20\x20\x20\40\x20\40\x20\x3c\151\x6e\160\x75\164\x20\164\171\x70\x65\x3d\x22\x70\141\163\x73\x77\157\162\x64\42\40\156\141\x6d\145\x3d\42\160\141\x73\163\167\157\x72\144\137\x6d\x6f\42\x20\151\144\x3d\x22\x70\141\163\x73\x77\x6f\x72\x64\x5f\x6d\157\x22\40\x63\x6c\141\163\x73\75\42\x69\156\x70\x75\164\x22\x20\166\141\154\x75\x65\x3d\x22\42\x20\x73\x74\171\154\145\75\42\42\x2f\76\74\x2f\154\141\x62\145\154\76";
        echo "\74\154\x61\x62\x65\x6c\40\146\157\x72\x3d\42\x63\157\156\x66\151\162\x6d\137\x70\x61\x73\x73\x77\x6f\162\x64\137\155\157\42\x3e" . mo_("\103\157\x6e\146\x69\162\155\x20\x50\x61\x73\163\167\157\x72\144") . "\x3c\x62\x72\x20\57\x3e\xa\40\x20\x20\40\x20\40\40\x20\x20\x20\x20\40\40\x20\x20\40\74\151\156\x70\165\x74\40\164\171\x70\x65\75\x22\160\141\x73\163\167\x6f\162\x64\x22\x20\156\x61\x6d\x65\x3d\x22\143\157\x6e\146\x69\x72\155\137\160\141\163\x73\x77\157\162\x64\x5f\x6d\157\42\40\151\x64\x3d\42\143\157\x6e\x66\x69\162\155\x5f\160\x61\163\163\x77\157\x72\x64\x5f\155\x6f\x22\40\143\154\141\x73\163\75\x22\151\156\160\165\164\42\x20\166\141\x6c\x75\x65\x3d\42\x22\40\163\164\x79\x6c\x65\x3d\x22\42\x2f\x3e\x3c\x2f\154\141\x62\145\x6c\76";
        echo "\74\163\143\x72\x69\160\x74\x3e\167\x69\x6e\x64\157\167\x2e\x6f\156\154\157\x61\144\x3d\146\165\156\143\x74\151\x6f\156\50\51\173\40\144\157\x63\x75\x6d\145\x6e\164\x2e\147\145\164\105\x6c\x65\155\x65\156\164\x42\171\x49\x64\50\42\x72\x65\147\137\x70\141\163\163\x6d\141\x69\154\42\51\x2e\162\x65\x6d\157\166\x65\50\x29\x3b\x20\175\x3c\57\x73\143\x72\x69\160\x74\x3e";
        jC:
    }
    function miniorange_registration_save($d2)
    {
        $mF = MoPHPSessions::getSessionVar("\160\x68\x6f\156\145\x5f\x6e\x75\155\x62\x65\162\137\x6d\x6f");
        if (!$mF) {
            goto WQ;
        }
        add_user_meta($d2, $this->_phoneKey, $mF);
        WQ:
        if ($this->_disableAutoActivate) {
            goto Q5;
        }
        wp_set_password($_POST["\160\141\x73\163\167\157\x72\144\137\x6d\x6f"], $d2);
        update_user_option($d2, "\144\145\x66\141\165\x6c\x74\x5f\x70\x61\163\163\167\157\x72\x64\137\x6e\x61\147", false, true);
        Q5:
    }
    function miniorange_site_registration_errors(WP_Error $errors, $Vy, $Kc)
    {
        $t2 = isset($_POST["\160\150\x6f\156\145\137\156\x75\155\x62\145\162\x5f\155\x6f"]) ? $_POST["\x70\x68\157\x6e\145\x5f\156\165\155\x62\x65\x72\x5f\x6d\x6f"] : null;
        $wh = isset($_POST["\x70\141\x73\x73\167\x6f\162\x64\x5f\x6d\x6f"]) ? $_POST["\x70\x61\163\163\167\157\162\x64\x5f\155\x6f"] : null;
        $tI = isset($_POST["\143\157\156\x66\x69\162\155\137\160\141\x73\163\167\x6f\162\x64\137\x6d\157"]) ? $_POST["\x63\x6f\x6e\x66\151\x72\155\137\160\x61\x73\163\167\157\x72\144\x5f\x6d\x6f"] : null;
        $this->checkIfPhoneNumberUnique($errors, $t2);
        $this->validatePasswords($errors, $wh, $tI);
        if (empty($errors->errors)) {
            goto LJ;
        }
        return $errors;
        LJ:
        if ($this->_otpType) {
            goto cf;
        }
        return $errors;
        cf:
        return $this->startOTPTransaction($Vy, $Kc, $errors, $t2);
    }
    private function validatePasswords(WP_Error &$WC, $wh, $tI)
    {
        if (!$this->_disableAutoActivate) {
            goto jr;
        }
        return;
        jr:
        if (!(strcasecmp($wh, $tI) !== 0)) {
            goto M_;
        }
        $WC->add("\160\x61\x73\x73\167\157\162\x64\137\155\x69\163\155\141\164\143\x68", MoMessages::showMessage(MoMessages::PASS_MISMATCH));
        M_:
    }
    private function checkIfPhoneNumberUnique(WP_Error &$errors, $t2)
    {
        if (!(strcasecmp($this->_otpType, $this->_typePhoneTag) !== 0)) {
            goto EV;
        }
        return;
        EV:
        if (MoUtility::isBlank($t2) || !MoUtility::validatePhoneNumber($t2)) {
            goto zn;
        }
        if ($this->_restrictDuplicates && $this->isPhoneNumberAlreadyInUse(trim($t2), $this->_phoneKey)) {
            goto vV;
        }
        goto tL;
        zn:
        $errors->add("\x69\x6e\166\141\x6c\151\x64\137\160\x68\x6f\156\145", MoMessages::showMessage(MoMessages::ENTER_PHONE_DEFAULT));
        goto tL;
        vV:
        $errors->add("\x69\156\x76\x61\154\x69\x64\x5f\x70\x68\x6f\156\145", MoMessages::showMessage(MoMessages::PHONE_EXISTS));
        tL:
    }
    function startOTPTransaction($Vy, $Kc, $errors, $t2)
    {
        if (!(!MoUtility::isBlank(array_filter($errors->errors)) || !isset($_POST["\162\145\x67\x69\x73\x74\145\162\137\x6e\157\156\143\x65"]))) {
            goto td;
        }
        return $errors;
        td:
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) === 0) {
            goto Pg;
        }
        if (strcasecmp($this->_otpType, $this->_typeBothTag) === 0) {
            goto RO;
        }
        $this->sendChallenge($Vy, $Kc, $errors, $t2, VerificationType::EMAIL);
        goto BI;
        RO:
        $this->sendChallenge($Vy, $Kc, $errors, $t2, VerificationType::BOTH);
        BI:
        goto ki;
        Pg:
        $this->sendChallenge($Vy, $Kc, $errors, $t2, VerificationType::PHONE);
        ki:
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
        $this->unsetOTPSessionVariables();
    }
    function isPhoneNumberAlreadyInUse($lr, $xl)
    {
        global $wpdb;
        $lr = MoUtility::processPhoneNumber($lr);
        $D5 = $wpdb->get_row("\123\x45\114\x45\103\x54\x20\x60\x75\163\x65\x72\x5f\151\144\140\40\x46\x52\x4f\x4d\x20\x60{$wpdb->prefix}\165\x73\145\162\155\x65\164\141\x60\x20\x57\110\x45\x52\105\x20\140\155\x65\x74\141\x5f\153\145\x79\x60\x20\75\40\x27{$xl}\x27\x20\x41\x4e\x44\40\140\x6d\145\164\141\x5f\166\141\154\x75\x65\140\x20\x3d\40\x20\47{$lr}\47");
        return !MoUtility::isBlank($D5);
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->isPhoneVerificationEnabled())) {
            goto Xk;
        }
        array_push($lP, $this->_phoneFormId);
        Xk:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto f6;
        }
        return;
        f6:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\167\x70\137\x64\x65\146\141\x75\154\x74\137\x65\x6e\141\x62\154\x65");
        $this->_otpType = $this->sanitizeFormPOST("\x77\160\137\144\x65\146\x61\x75\154\x74\x5f\145\x6e\x61\x62\154\145\x5f\x74\171\x70\145");
        $this->_restrictDuplicates = $this->sanitizeFormPOST("\167\160\x5f\x72\x65\147\x5f\162\x65\x73\164\x72\x69\x63\164\x5f\x64\x75\x70\x6c\x69\143\141\164\145\x73");
        $this->_disableAutoActivate = $this->sanitizeFormPOST("\x77\x70\x5f\162\145\x67\137\141\165\x74\157\x5f\x61\143\x74\151\166\141\164\145") ? FALSE : TRUE;
        update_mo_option("\x77\x70\137\144\x65\146\141\165\x6c\164\x5f\x65\156\141\142\154\145", $this->_isFormEnabled);
        update_mo_option("\167\x70\137\144\x65\146\x61\x75\154\164\137\145\156\141\x62\x6c\145\x5f\164\x79\160\145", $this->_otpType);
        update_mo_option("\167\x70\137\162\x65\147\x5f\162\x65\163\164\x72\x69\x63\x74\x5f\144\x75\x70\154\151\x63\x61\x74\145\163", $this->_restrictDuplicates);
        update_mo_option("\x77\x70\137\x72\x65\x67\137\x61\165\x74\157\137\141\143\164\x69\166\141\164\x65", $this->_disableAutoActivate ? FALSE : TRUE);
    }
}
