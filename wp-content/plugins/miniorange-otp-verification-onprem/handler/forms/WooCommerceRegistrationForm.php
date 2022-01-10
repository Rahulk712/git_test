<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoConstants;
use OTP\Helper\MoException;
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
class WooCommerceRegistrationForm extends FormHandler implements IFormHandler
{
    use Instance;
    private $_redirectToPage;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_formSessionVar = FormSessionVars::WC_DEFAULT_REG;
        $this->_typePhoneTag = "\155\x6f\137\x77\x63\x5f\160\x68\x6f\156\x65\137\x65\156\x61\x62\x6c\145";
        $this->_typeEmailTag = "\x6d\157\x5f\167\x63\137\145\155\x61\x69\x6c\137\x65\156\x61\x62\154\145";
        $this->_typeBothTag = "\x6d\157\137\167\143\x5f\x62\157\x74\150\137\145\156\141\142\154\145";
        $this->_phoneFormId = "\43\x72\x65\147\x5f\142\x69\x6c\154\x69\x6e\147\137\x70\x68\x6f\x6e\x65";
        $this->_formKey = "\127\x43\137\x52\105\107\137\106\x4f\122\x4d";
        $this->_formName = mo_("\127\x6f\x6f\143\157\x6d\155\x65\x72\143\145\40\x52\x65\x67\x69\163\164\162\x61\164\151\157\156\40\x46\157\x72\x6d");
        $this->_isFormEnabled = get_mo_option("\167\x63\x5f\x64\x65\x66\x61\165\x6c\164\x5f\x65\156\x61\142\x6c\145");
        $this->_buttonText = get_mo_option("\x77\143\137\x62\x75\164\x74\157\x6e\x5f\x74\x65\170\164");
        $this->_buttonText = !MoUtility::isBlank($this->_buttonText) ? $this->_buttonText : mo_("\103\154\151\143\153\40\110\x65\162\x65\40\164\x6f\x20\x73\x65\156\144\x20\117\124\120");
        $this->_formDocuments = MoOTPDocs::WC_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_isAjaxForm = get_mo_option("\167\143\137\x69\x73\137\x61\152\141\x78\137\146\157\162\x6d");
        $this->_otpType = get_mo_option("\167\143\x5f\145\x6e\x61\142\x6c\145\x5f\164\x79\160\145");
        $this->_redirectToPage = get_mo_option("\x77\x63\137\162\145\x64\151\162\x65\x63\x74");
        $this->_restrictDuplicates = get_mo_option("\167\x63\x5f\x72\145\x73\164\162\x69\x63\x74\x5f\x64\165\160\x6c\151\143\x61\164\145\x73");
        add_filter("\167\x6f\x6f\x63\x6f\155\x6d\x65\x72\x63\x65\x5f\160\162\157\143\145\163\x73\137\162\x65\x67\151\x73\164\162\141\x74\x69\x6f\156\x5f\x65\162\x72\x6f\162\163", array($this, "\x77\157\x6f\x63\157\155\x6d\145\162\143\145\137\x73\151\164\145\137\162\145\x67\151\x73\164\x72\141\x74\x69\157\156\x5f\145\162\x72\157\162\163"), 99, 4);
        add_action("\x77\157\157\x63\157\x6d\155\x65\162\143\x65\x5f\143\x72\x65\x61\164\x65\x64\137\x63\165\163\164\157\x6d\145\162", array($this, "\162\x65\147\x69\x73\164\145\x72\x5f\x77\157\157\143\157\x6d\155\x65\162\x63\145\137\165\x73\x65\162"), 1, 3);
        add_filter("\x77\x6f\x6f\143\x6f\155\155\x65\x72\x63\x65\x5f\162\145\x67\x69\163\x74\162\141\x74\x69\x6f\156\x5f\x72\x65\x64\x69\x72\145\x63\x74", array($this, "\143\x75\x73\x74\157\155\137\162\x65\147\151\163\164\x72\141\164\x69\x6f\x6e\137\162\145\144\x69\x72\x65\x63\x74"), 99, 1);
        if (!$this->isPhoneVerificationEnabled()) {
            goto PB;
        }
        add_action("\x77\x6f\157\143\157\x6d\x6d\145\162\143\145\x5f\x72\145\x67\x69\163\x74\145\x72\x5f\x66\157\x72\155", array($this, "\x6d\157\x5f\x61\x64\144\137\x70\x68\x6f\156\145\137\146\x69\x65\154\x64"), 1);
        add_action("\x77\x63\155\160\137\166\145\x6e\144\157\162\137\x72\145\x67\151\163\164\145\162\x5f\x66\x6f\x72\x6d", array($this, "\155\x6f\137\141\144\x64\x5f\160\150\x6f\156\x65\x5f\x66\x69\145\154\x64"), 1);
        PB:
        if (!($this->_isAjaxForm && $this->_otpType != $this->_typeBothTag)) {
            goto Zy;
        }
        add_action("\167\157\x6f\143\x6f\155\155\x65\162\x63\145\x5f\162\x65\x67\151\x73\164\x65\x72\x5f\x66\157\162\x6d", array($this, "\x6d\x6f\137\141\144\144\x5f\x76\145\162\x69\x66\x69\x63\141\x74\151\x6f\x6e\x5f\146\151\145\x6c\x64"), 1);
        add_action("\167\143\x6d\160\137\166\145\x6e\x64\157\162\x5f\x72\145\147\x69\x73\x74\x65\162\x5f\146\x6f\162\155", array($this, "\x6d\157\137\x61\144\144\x5f\x76\145\162\x69\x66\x69\x63\x61\x74\151\x6f\156\x5f\146\151\145\154\x64"), 1);
        add_action("\167\x70\137\145\156\161\x75\x65\165\x65\137\x73\143\x72\x69\x70\164\163", array($this, "\x6d\x69\x6e\x69\157\162\x61\156\147\145\137\162\x65\x67\151\x73\164\145\x72\x5f\x77\143\137\163\x63\x72\151\160\x74"));
        $this->routeData();
        Zy:
    }
    private function routeData()
    {
        if (array_key_exists("\x6f\160\164\151\157\156", $_GET)) {
            goto Fg;
        }
        return;
        Fg:
        switch (trim($_GET["\x6f\160\x74\x69\157\x6e"])) {
            case "\x6d\151\156\x69\157\162\x61\156\x67\145\x2d\167\143\x2d\162\x65\x67\x2d\166\145\x72\151\146\x79":
                $this->sendAjaxOTPRequest();
                goto bO;
        }
        Gi:
        bO:
    }
    private function sendAjaxOTPRequest()
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        $this->validateAjaxRequest();
        $m6 = MoUtility::sanitizeCheck("\x75\x73\x65\162\137\160\150\x6f\156\145", $_POST);
        $Kc = MoUtility::sanitizeCheck("\x75\163\x65\x72\x5f\x65\x6d\x61\151\x6c", $_POST);
        if ($this->_otpType === $this->_typePhoneTag) {
            goto R9;
        }
        SessionUtils::addEmailVerified($this->_formSessionVar, $Kc);
        goto VM;
        R9:
        SessionUtils::addPhoneVerified($this->_formSessionVar, MoUtility::processPhoneNumber($m6));
        VM:
        $WC = $this->processFormFields(null, $Kc, new WP_Error(), null, $m6);
        if (!$WC->get_error_code()) {
            goto gD;
        }
        wp_send_json(MoUtility::createJson($WC->get_error_message(), MoConstants::ERROR_JSON_TYPE));
        gD:
    }
    function miniorange_register_wc_script()
    {
        wp_register_script("\155\157\x77\143\162\145\147", MOV_URL . "\151\x6e\x63\154\165\x64\145\163\x2f\152\x73\57\167\143\162\145\147\56\155\151\x6e\x2e\152\x73", array("\x6a\x71\x75\145\x72\x79"));
        wp_localize_script("\x6d\157\167\143\x72\x65\147", "\x6d\x6f\167\143\x72\x65\x67", array("\x73\151\x74\x65\125\122\114" => site_url(), "\x6f\x74\160\124\171\160\x65" => $this->_otpType, "\156\157\156\143\x65" => wp_create_nonce($this->_nonce), "\x62\x75\x74\x74\x6f\x6e\x74\145\170\164" => mo_($this->_buttonText), "\146\151\x65\x6c\x64" => $this->_otpType === $this->_typePhoneTag ? "\162\145\147\137\x62\151\x6c\154\x69\x6e\x67\137\x70\x68\157\x6e\x65" : "\x72\145\147\x5f\x65\x6d\141\x69\154", "\151\x6d\x67\125\122\114" => MOV_LOADER_URL));
        wp_enqueue_script("\x6d\x6f\167\143\x72\x65\147");
    }
    function custom_registration_redirect($MG)
    {
        return MoUtility::isBlank($MG) ? get_permalink(get_page_by_title($this->_redirectToPage)->ID) : $MG;
    }
    function isPhoneVerificationEnabled()
    {
        $Jw = $this->getVerificationType();
        return $Jw === VerificationType::BOTH || $Jw === VerificationType::PHONE;
    }
    function woocommerce_site_registration_errors(WP_Error $errors, $Iv, $wh, $xX)
    {
        if (MoUtility::isBlank(array_filter($errors->errors))) {
            goto zj;
        }
        return $errors;
        zj:
        if ($this->_isAjaxForm) {
            goto f8;
        }
        return $this->processFormAndSendOTP($Iv, $wh, $xX, $errors);
        goto LT;
        f8:
        $this->assertOTPField($errors, $_POST);
        $this->checkIfOTPWasSent($errors);
        return $this->checkIntegrityAndValidateOTP($_POST, $errors);
        LT:
    }
    private function assertOTPField(&$errors, $rI)
    {
        if (MoUtility::sanitizeCheck("\x6d\157\x76\145\x72\151\x66\171", $rI)) {
            goto lO;
        }
        $errors = new WP_Error("\162\x65\x67\151\163\x74\162\141\164\x69\157\x6e\x2d\145\x72\162\x6f\162\x2d\x6f\164\160\55\156\145\x65\144\145\x64", MoMessages::showMessage(MoMessages::REQUIRED_OTP));
        lO:
    }
    private function checkIfOTPWasSent(&$errors)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto lF;
        }
        $errors = new WP_Error("\162\145\147\x69\163\164\162\x61\x74\151\157\x6e\x2d\x65\162\162\x6f\162\55\156\x65\x65\144\x2d\x76\141\x6c\x69\x64\141\164\151\x6f\x6e", MoMessages::showMessage(MoMessages::PLEASE_VALIDATE));
        lF:
    }
    private function checkIntegrityAndValidateOTP($Jf, WP_Error $errors)
    {
        if (empty($errors->errors)) {
            goto KQ;
        }
        return $errors;
        KQ:
        $Jf["\x62\x69\x6c\154\x69\x6e\x67\x5f\160\x68\157\x6e\x65"] = MoUtility::processPhoneNumber($Jf["\x62\x69\x6c\154\151\x6e\x67\137\x70\150\x6f\156\x65"]);
        $errors = $this->checkIntegrity($Jf, $errors);
        if (empty($errors->errors)) {
            goto LU;
        }
        return $errors;
        LU:
        $Jw = $this->getVerificationType();
        $this->validateChallenge($Jw, NULL, $Jf["\155\157\166\145\x72\151\x66\171"]);
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $Jw)) {
            goto El;
        }
        return new WP_Error("\x72\145\x67\x69\x73\x74\162\141\164\x69\157\156\x2d\x65\162\162\157\x72\x2d\151\x6e\166\x61\x6c\151\144\x2d\157\164\x70", MoUtility::_get_invalid_otp_method());
        goto EF;
        El:
        $this->unsetOTPSessionVariables();
        EF:
        return $errors;
    }
    private function checkIntegrity($Jf, WP_Error $errors)
    {
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto id;
        }
        if (!(strcasecmp($this->_otpType, $this->_typeEmailTag) == 0)) {
            goto UD;
        }
        if (SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $Jf["\x65\155\141\151\154"])) {
            goto Bg;
        }
        return new WP_Error("\162\145\x67\x69\163\x74\162\141\x74\x69\157\156\55\145\x72\162\x6f\x72\55\151\156\166\x61\154\151\144\55\x65\x6d\x61\151\154", MoMessages::showMessage(MoMessages::EMAIL_MISMATCH));
        Bg:
        UD:
        goto Ff;
        id:
        if (Sessionutils::isPhoneVerifiedMatch($this->_formSessionVar, $Jf["\142\151\x6c\x6c\151\x6e\147\x5f\160\150\157\x6e\x65"])) {
            goto CY;
        }
        return new WP_Error("\142\x69\154\154\x69\x6e\147\137\160\x68\x6f\x6e\x65\x5f\x65\162\x72\157\162", MoMessages::showMessage(MoMessages::PHONE_MISMATCH));
        CY:
        Ff:
        return $errors;
    }
    private function processFormAndSendOTP($Iv, $wh, $xX, WP_Error $errors)
    {
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $this->getVerificationType())) {
            goto xb;
        }
        $this->unsetOTPSessionVariables();
        return $errors;
        xb:
        MoUtility::initialize_transaction($this->_formSessionVar);
        try {
            $this->assertUserName($Iv);
            $this->assertPassword($wh);
            $this->assertEmail($xX);
        } catch (MoException $VX) {
            return new WP_Error($VX->getMoCode(), $VX->getMessage());
        }
        do_action("\x77\157\157\x63\x6f\x6d\x6d\145\162\143\145\x5f\x72\145\147\x69\163\164\145\x72\137\160\157\163\x74", $Iv, $xX, $errors);
        return $errors->get_error_code() ? $errors : $this->processFormFields($Iv, $xX, $errors, $wh, $_POST["\x62\x69\154\154\151\x6e\147\x5f\x70\x68\157\156\x65"]);
    }
    private function assertPassword($wh)
    {
        if (!(get_mo_option("\167\157\x6f\x63\157\x6d\x6d\145\162\143\145\x5f\x72\x65\147\151\x73\164\162\141\x74\151\x6f\x6e\x5f\x67\145\156\x65\x72\141\164\145\x5f\x70\x61\163\x73\167\x6f\162\x64", '') === "\x6e\x6f")) {
            goto Xf;
        }
        if (!MoUtility::isBlank($wh)) {
            goto Jd;
        }
        throw new MoException("\x72\x65\147\151\x73\x74\162\x61\164\151\x6f\156\55\x65\162\x72\x6f\162\55\x69\x6e\166\141\x6c\151\144\x2d\160\x61\x73\x73\167\157\162\x64", mo_("\x50\154\145\x61\163\145\x20\145\156\164\145\x72\x20\x61\x20\x76\141\x6c\x69\x64\x20\x61\x63\143\x6f\165\x6e\164\x20\x70\141\x73\163\x77\157\x72\144\x2e"), 204);
        Jd:
        Xf:
    }
    private function assertEmail($xX)
    {
        if (!(MoUtility::isBlank($xX) || !is_email($xX))) {
            goto nj;
        }
        throw new MoException("\x72\145\147\151\163\164\162\x61\164\151\x6f\x6e\x2d\145\162\162\x6f\x72\x2d\151\x6e\166\x61\x6c\151\x64\x2d\x65\x6d\141\151\154", mo_("\120\x6c\x65\141\163\145\x20\x65\156\164\x65\x72\x20\141\40\x76\141\154\151\144\40\145\x6d\x61\151\154\40\x61\144\x64\162\145\163\163\56"), 202);
        nj:
        if (!email_exists($xX)) {
            goto tg;
        }
        throw new MoException("\x72\x65\147\x69\x73\x74\x72\x61\x74\151\x6f\156\x2d\x65\162\x72\x6f\162\x2d\145\x6d\141\151\154\x2d\x65\x78\151\x73\164\x73", mo_("\x41\x6e\40\141\143\143\x6f\x75\156\164\40\x69\x73\40\x61\154\x72\x65\x61\144\171\40\x72\x65\147\151\163\x74\x65\x72\x65\144\40\167\151\164\150\40\x79\x6f\x75\x72\40\x65\155\141\151\x6c\x20\x61\x64\144\162\145\163\x73\x2e\40\x50\154\145\141\163\x65\x20\154\157\x67\x69\x6e\x2e"), 203);
        tg:
    }
    private function assertUserName($Iv)
    {
        if (!(get_mo_option("\167\x6f\157\x63\x6f\155\x6d\145\162\143\x65\x5f\162\x65\147\151\x73\x74\x72\141\164\x69\157\156\137\147\145\156\x65\x72\141\164\145\x5f\x75\x73\145\x72\x6e\x61\155\x65", '') === "\156\x6f")) {
            goto ii;
        }
        if (!(MoUtility::isBlank($Iv) || !validate_username($Iv))) {
            goto Kx;
        }
        throw new MoException("\162\145\147\x69\x73\x74\x72\x61\164\x69\x6f\156\55\x65\162\162\157\162\55\x69\156\166\141\154\x69\144\55\165\x73\x65\x72\156\141\155\x65", mo_("\x50\154\145\141\x73\145\x20\145\156\x74\145\162\40\x61\40\166\141\154\x69\144\40\x61\x63\143\x6f\x75\156\x74\40\165\x73\x65\162\156\x61\x6d\x65\x2e"), 200);
        Kx:
        if (!username_exists($Iv)) {
            goto xQ;
        }
        throw new MoException("\x72\x65\x67\x69\163\x74\162\x61\164\151\x6f\156\55\x65\x72\162\157\x72\55\x75\x73\145\x72\x6e\141\x6d\x65\x2d\145\170\151\163\x74\163", mo_("\101\x6e\x20\x61\x63\x63\157\x75\x6e\164\x20\151\163\x20\141\154\x72\x65\141\x64\171\40\162\145\147\151\163\164\x65\162\145\x64\40\x77\x69\164\150\x20\164\150\141\164\40\x75\x73\145\x72\x6e\x61\x6d\x65\56\x20\x50\x6c\145\141\x73\145\x20\143\x68\157\x6f\x73\x65\x20\x61\x6e\157\x74\x68\145\x72\x2e"), 201);
        xQ:
        ii:
    }
    function processFormFields($Iv, $xX, $errors, $wh, $lr)
    {
        global $phoneLogic;
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) === 0) {
            goto Ra;
        }
        if (strcasecmp($this->_otpType, $this->_typeEmailTag) === 0) {
            goto hG;
        }
        if (!(strcasecmp($this->_otpType, $this->_typeBothTag) === 0)) {
            goto P3;
        }
        if (!(!isset($lr) || !MoUtility::validatePhoneNumber($lr))) {
            goto pU;
        }
        return new WP_Error("\142\151\154\154\x69\x6e\x67\x5f\x70\150\x6f\156\x65\x5f\145\x72\162\x6f\162", str_replace("\x23\43\x70\x68\157\x6e\x65\x23\43", $_POST["\142\151\154\154\151\x6e\147\137\160\x68\x6f\x6e\145"], $phoneLogic->_get_otp_invalid_format_message()));
        pU:
        $this->sendChallenge($Iv, $xX, $errors, $_POST["\x62\x69\154\x6c\151\156\x67\x5f\x70\x68\157\156\x65"], VerificationType::BOTH, $wh);
        P3:
        goto MK;
        hG:
        $lr = isset($lr) ? $lr : '';
        $this->sendChallenge($Iv, $xX, $errors, $lr, VerificationType::EMAIL, $wh);
        MK:
        goto t6;
        Ra:
        if (!isset($lr) || !MoUtility::validatePhoneNumber($lr)) {
            goto jL;
        }
        if ($this->_restrictDuplicates && $this->isPhoneNumberAlreadyInUse($lr, "\x62\x69\154\154\151\x6e\x67\137\160\150\157\156\145")) {
            goto MN;
        }
        goto jS;
        jL:
        return new WP_Error("\x62\151\x6c\x6c\151\156\x67\x5f\x70\150\x6f\156\145\x5f\x65\162\x72\157\162", str_replace("\x23\x23\x70\150\x6f\156\x65\43\43", $lr, $phoneLogic->_get_otp_invalid_format_message()));
        goto jS;
        MN:
        return new WP_Error("\x62\x69\x6c\x6c\x69\x6e\147\x5f\x70\x68\157\156\x65\x5f\145\x72\x72\157\x72", MoMessages::showMessage(MoMessages::PHONE_EXISTS));
        jS:
        $this->sendChallenge($Iv, $xX, $errors, $lr, VerificationType::PHONE, $wh);
        t6:
        return $errors;
    }
    public function register_woocommerce_user($jT, $Sd, $TO)
    {
        if (!isset($_POST["\x62\151\154\154\x69\156\147\x5f\160\150\x6f\156\145"])) {
            goto zB;
        }
        $lr = MoUtility::sanitizeCheck("\142\151\154\154\x69\156\147\x5f\160\x68\157\156\145", $_POST);
        update_user_meta($jT, "\x62\x69\154\x6c\x69\x6e\147\137\160\x68\157\156\x65", MoUtility::processPhoneNumber($lr));
        zB:
    }
    function mo_add_phone_field()
    {
        if (!(!did_action("\x77\157\157\x63\x6f\155\155\x65\162\x63\145\137\x72\145\x67\151\x73\x74\145\x72\137\146\157\x72\155") || !did_action("\167\143\155\160\137\166\145\156\144\157\x72\137\x72\145\147\x69\x73\164\145\162\x5f\146\157\x72\x6d"))) {
            goto kq;
        }
        echo "\74\x70\40\x63\154\x61\163\x73\75\42\146\x6f\x72\155\x2d\162\x6f\167\40\x66\x6f\162\x6d\55\x72\157\167\x2d\167\x69\x64\145\x22\x3e\xa\x20\40\40\40\x20\x20\40\40\40\40\x20\x20\40\x20\x20\40\74\x6c\x61\142\x65\154\x20\x66\x6f\x72\x3d\x22\162\145\x67\137\x62\151\154\154\x69\156\147\137\160\x68\157\156\145\x22\x3e\xa\40\x20\40\40\x20\x20\40\40\40\40\40\40\40\x20\40\40\40\40\x20\x20" . mo_("\x50\x68\157\x6e\145") . "\xa\40\x20\x20\x20\40\x20\40\x20\x20\40\40\40\40\40\x20\x20\40\40\40\x20\x3c\x73\160\x61\x6e\40\143\x6c\x61\x73\163\75\42\162\145\161\165\x69\162\x65\x64\x22\x3e\52\x3c\57\163\x70\141\x6e\76\xa\40\x20\40\x20\x20\40\x20\40\x20\x20\40\40\x20\40\40\x20\74\57\x6c\x61\142\145\154\76\xa\40\40\x20\x20\x20\x20\40\x20\40\40\40\40\x20\x20\40\x20\x3c\151\x6e\160\x75\x74\x20\x74\x79\x70\x65\x3d\x22\164\x65\170\164\x22\40\143\154\x61\163\163\x3d\42\x69\156\x70\x75\x74\x2d\164\x65\170\x74\42\x20\xa\40\40\40\x20\40\40\40\x20\x20\x20\x20\40\40\x20\x20\x20\x20\40\x20\x20\40\40\x20\x20\156\141\x6d\x65\x3d\x22\x62\x69\154\154\151\x6e\147\137\x70\150\157\x6e\145\42\40\151\144\x3d\42\162\145\x67\137\x62\x69\x6c\154\151\156\147\x5f\x70\150\157\x6e\145\42\40\xa\40\40\x20\x20\x20\40\40\40\x20\x20\x20\40\40\40\40\x20\x20\x20\40\40\40\x20\40\40\166\x61\154\165\145\x3d\x22" . (!empty($_POST["\142\151\154\154\151\x6e\147\137\x70\150\157\156\145"]) ? $_POST["\142\x69\x6c\154\x69\x6e\x67\x5f\x70\x68\x6f\156\x65"] : '') . "\x22\x20\57\x3e\12\40\40\x20\40\x20\40\x20\x20\40\40\x20\40\x20\x20\74\57\160\76";
        kq:
    }
    function mo_add_verification_field()
    {
        echo "\x3c\x70\40\x63\x6c\141\163\163\x3d\x22\x66\x6f\x72\x6d\x2d\162\x6f\167\x20\x66\157\162\x6d\x2d\x72\x6f\x77\x2d\x77\x69\144\x65\x22\76\12\x20\x20\x20\x20\40\x20\x20\40\x20\x20\x20\40\40\x20\x20\x20\74\154\x61\142\145\x6c\40\x66\157\162\75\42\x72\145\x67\x5f\x76\145\x72\151\x66\x69\143\141\164\151\157\156\137\x70\x68\157\x6e\x65\x22\x3e\xa\x20\x20\x20\40\40\x20\x20\40\40\40\x20\x20\x20\x20\x20\x20\x20\40\x20\x20" . mo_("\105\x6e\x74\x65\162\40\103\157\144\145") . "\xa\x20\40\x20\x20\x20\40\x20\x20\x20\40\x20\x20\40\x20\x20\x20\x20\x20\40\x20\x3c\x73\x70\141\x6e\40\x63\154\x61\163\163\75\42\162\x65\161\x75\151\162\145\144\x22\76\52\x3c\57\x73\160\x61\x6e\76\xa\x20\x20\40\x20\40\40\40\40\x20\x20\40\40\x20\40\x20\x20\74\57\x6c\141\142\145\x6c\x3e\12\40\40\40\40\40\x20\40\x20\x20\40\40\40\40\40\40\x20\74\151\x6e\x70\x75\x74\40\164\x79\160\145\75\x22\164\145\170\164\42\40\x63\154\141\x73\x73\75\x22\x69\x6e\160\165\x74\55\164\145\x78\x74\x22\40\x6e\141\155\x65\75\x22\x6d\x6f\166\145\162\151\146\x79\42\x20\12\40\x20\x20\40\40\40\x20\40\40\40\x20\40\x20\40\x20\x20\x20\x20\40\40\40\x20\40\x20\x69\x64\75\x22\162\145\x67\x5f\x76\145\162\x69\146\x69\143\x61\164\x69\157\x6e\137\146\151\x65\x6c\144\x22\x20\xa\40\x20\40\x20\40\x20\x20\40\x20\40\x20\40\x20\x20\x20\x20\40\x20\x20\40\40\x20\x20\x20\x76\x61\154\165\x65\75\42\42\40\57\76\xa\x20\40\40\40\x20\40\x20\40\40\40\x20\40\40\x20\74\x2f\x70\76";
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        if ($this->_isAjaxForm) {
            goto Q0;
        }
        $Jw = $this->getVerificationType();
        $aG = $Jw === VerificationType::BOTH ? TRUE : FALSE;
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $Jw, $aG);
        goto ZB;
        Q0:
        SessionUtils::addStatus($this->_formSessionVar, self::VERIFICATION_FAILED, $m5);
        ZB:
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
            goto Eg;
        }
        array_push($lP, $this->_phoneFormId);
        Eg:
        return $lP;
    }
    function isPhoneNumberAlreadyInUse($lr, $xl)
    {
        global $wpdb;
        $lr = MoUtility::processPhoneNumber($lr);
        $D5 = $wpdb->get_row("\x53\x45\x4c\x45\x43\124\x20\140\x75\x73\x65\x72\x5f\x69\x64\140\40\x46\x52\x4f\x4d\40\x60{$wpdb->prefix}\165\x73\145\162\x6d\145\164\x61\140\40\127\110\x45\122\105\40\x60\155\145\x74\141\x5f\153\x65\171\x60\40\75\x20\47{$xl}\47\x20\101\116\x44\x20\x60\x6d\145\164\x61\137\166\x61\x6c\x75\145\140\40\75\x20\40\x27{$lr}\x27");
        return !MoUtility::isBlank($D5);
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto Vk;
        }
        return;
        Vk:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\167\x63\137\144\x65\x66\x61\x75\x6c\x74\x5f\x65\x6e\141\142\154\145");
        $this->_otpType = $this->sanitizeFormPOST("\167\x63\137\145\156\x61\x62\x6c\x65\137\x74\171\x70\x65");
        $this->_restrictDuplicates = $this->sanitizeFormPOST("\x77\143\137\x72\145\x73\164\x72\x69\143\164\137\x64\x75\160\154\151\143\141\x74\145\x73");
        $this->_redirectToPage = isset($_POST["\160\141\147\x65\137\151\144"]) ? get_the_title($_POST["\x70\141\147\x65\x5f\x69\144"]) : "\x4d\x79\40\101\x63\143\x6f\x75\x6e\164";
        $this->_isAjaxForm = $this->sanitizeFormPOST("\x77\x63\x5f\151\x73\137\x61\x6a\x61\170\x5f\146\x6f\162\155");
        $this->_buttonText = $this->sanitizeFormPOST("\x77\143\137\142\x75\x74\x74\x6f\x6e\x5f\164\145\x78\164");
        update_mo_option("\x77\x63\137\144\145\x66\x61\x75\154\x74\x5f\x65\x6e\141\x62\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\167\x63\137\x65\156\x61\x62\154\x65\137\x74\171\x70\x65", $this->_otpType);
        update_mo_option("\167\143\x5f\x72\x65\163\x74\162\151\143\x74\137\x64\165\x70\154\151\143\141\x74\x65\x73", $this->_restrictDuplicates);
        update_mo_option("\x77\143\137\x72\x65\x64\151\x72\x65\x63\164", $this->_redirectToPage);
        update_mo_option("\167\143\x5f\151\x73\137\x61\152\x61\x78\137\146\x6f\x72\x6d", $this->_isAjaxForm);
        update_mo_option("\x77\143\x5f\x62\x75\164\164\x6f\x6e\x5f\x74\x65\170\x74", $this->_buttonText);
    }
    public function redirectToPage()
    {
        return $this->_redirectToPage;
    }
}
