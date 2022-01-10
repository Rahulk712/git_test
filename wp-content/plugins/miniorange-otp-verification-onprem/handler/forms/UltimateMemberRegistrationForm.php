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
use OTP\Objects\VerificationLogic;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
use um\core\Form;
use WP_Error;
class UltimateMemberRegistrationForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = get_mo_option("\x75\155\x5f\151\x73\137\141\152\x61\170\137\146\157\162\155");
        $this->_formSessionVar = FormSessionVars::UM_DEFAULT_REG;
        $this->_typePhoneTag = "\x6d\x6f\x5f\x75\x6d\137\x70\x68\157\x6e\145\x5f\145\x6e\141\x62\x6c\145";
        $this->_typeEmailTag = "\x6d\157\137\x75\155\137\145\x6d\141\x69\x6c\x5f\145\x6e\x61\x62\154\145";
        $this->_typeBothTag = "\x6d\157\x5f\x75\x6d\137\142\157\164\x68\x5f\x65\x6e\x61\x62\154\145";
        $this->_phoneKey = get_mo_option("\165\155\137\x70\x68\157\156\x65\137\x6b\x65\171");
        $this->_phoneKey = $this->_phoneKey ? $this->_phoneKey : "\155\157\142\x69\x6c\x65\x5f\x6e\165\x6d\142\x65\162";
        $this->_phoneFormId = "\x69\156\x70\165\x74\x5b\156\141\155\x65\136\x3d\x27" . $this->_phoneKey . "\x27\x5d";
        $this->_formKey = "\x55\114\124\111\x4d\x41\124\105\137\x46\117\122\115";
        $this->_formName = mo_("\125\154\x74\151\x6d\x61\164\145\40\x4d\145\x6d\142\x65\x72\x20\x52\x65\147\x69\x73\164\162\x61\164\151\157\x6e\x20\106\x6f\162\x6d");
        $this->_isFormEnabled = get_mo_option("\165\x6d\137\x64\x65\x66\141\x75\x6c\164\x5f\145\x6e\141\142\154\145");
        $this->_restrictDuplicates = get_mo_option("\165\155\x5f\162\x65\163\x74\x72\151\x63\x74\x5f\144\x75\160\x6c\151\143\x61\x74\145\163");
        $this->_buttonText = get_mo_option("\x75\155\137\x62\x75\x74\x74\157\x6e\x5f\x74\x65\x78\164");
        $this->_buttonText = !MoUtility::isBlank($this->_buttonText) ? $this->_buttonText : mo_("\x43\x6c\151\143\x6b\40\110\x65\162\x65\40\x74\157\x20\x73\x65\156\x64\40\x4f\124\x50");
        $this->_formKey = get_mo_option("\165\x6d\137\x76\145\x72\x69\146\171\137\x6d\x65\x74\x61\x5f\153\x65\x79");
        $this->_formDocuments = MoOTPDocs::UM_ENABLED;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x75\x6d\x5f\145\156\x61\142\x6c\x65\x5f\164\x79\x70\x65");
        if ($this->isUltimateMemberV2Installed()) {
            goto yg;
        }
        add_action("\165\155\x5f\163\165\142\x6d\151\164\137\146\x6f\162\x6d\137\145\x72\162\x6f\x72\x73\137\x68\157\157\153\x5f", array($this, "\x6d\x69\156\x69\x6f\162\x61\156\x67\145\x5f\165\x6d\137\160\x68\157\156\x65\137\166\x61\x6c\151\144\x61\164\151\x6f\x6e"), 99, 1);
        add_action("\x75\155\137\142\145\x66\x6f\x72\x65\x5f\x6e\145\x77\137\165\x73\x65\162\x5f\x72\x65\147\x69\x73\x74\x65\162", array($this, "\155\151\156\151\x6f\x72\x61\156\147\145\x5f\x75\x6d\137\165\x73\145\x72\x5f\162\x65\x67\x69\163\x74\162\x61\x74\151\x6f\x6e"), 99, 1);
        goto IW;
        yg:
        add_action("\165\155\137\163\x75\x62\155\151\164\137\x66\157\x72\155\x5f\x65\x72\x72\x6f\x72\163\x5f\x68\157\x6f\153\137\137\162\x65\147\151\163\164\x72\x61\164\x69\157\156", array($this, "\155\x69\x6e\x69\157\x72\x61\156\x67\145\137\165\x6d\x32\x5f\x70\x68\x6f\156\145\x5f\166\x61\x6c\x69\144\x61\x74\x69\x6f\x6e"), 99, 1);
        add_filter("\165\x6d\x5f\162\145\x67\x69\163\x74\162\x61\164\151\157\x6e\x5f\x75\x73\145\x72\x5f\162\157\154\145", array($this, "\155\151\x6e\x69\x6f\x72\141\x6e\147\145\x5f\165\x6d\62\x5f\x75\x73\145\x72\x5f\162\x65\147\151\x73\x74\162\x61\x74\x69\157\156"), 99, 2);
        IW:
        if (!($this->_isAjaxForm && $this->_otpType != $this->_typeBothTag)) {
            goto eZ;
        }
        add_action("\167\160\x5f\145\156\x71\x75\145\165\x65\x5f\x73\143\162\x69\160\x74\x73", array($this, "\155\x69\x6e\x69\x6f\162\141\x6e\x67\x65\x5f\162\x65\x67\151\x73\x74\145\162\x5f\165\155\137\x73\143\x72\151\160\164"));
        $this->routeData();
        eZ:
    }
    function isUltimateMemberV2Installed()
    {
        if (function_exists("\x69\x73\137\160\154\x75\147\151\x6e\137\141\x63\x74\151\166\x65")) {
            goto ai;
        }
        include_once ABSPATH . "\167\160\55\x61\x64\155\151\156\57\x69\x6e\x63\154\x75\x64\145\163\57\x70\154\165\x67\151\x6e\56\160\150\160";
        ai:
        return is_plugin_active("\x75\154\x74\x69\155\141\x74\145\55\x6d\x65\155\x62\145\x72\57\x75\154\x74\x69\155\x61\164\145\55\155\x65\x6d\142\145\162\x2e\x70\150\160");
    }
    private function routeData()
    {
        if (array_key_exists("\x6f\160\x74\x69\x6f\x6e", $_GET)) {
            goto PQ;
        }
        return;
        PQ:
        switch (trim($_GET["\x6f\160\x74\151\x6f\156"])) {
            case "\155\x69\x6e\151\x6f\162\141\156\x67\145\x2d\165\155\55\x61\x6a\141\170\x2d\166\145\162\151\x66\x79":
                $this->sendAjaxOTPRequest();
                goto mO;
        }
        gF:
        mO:
    }
    private function sendAjaxOTPRequest()
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        $this->validateAjaxRequest();
        $m6 = MoUtility::sanitizeCheck("\165\x73\145\162\137\160\x68\x6f\156\145", $_POST);
        $Kc = MoUtility::sanitizeCheck("\165\163\x65\162\x5f\145\155\x61\151\154", $_POST);
        if ($this->_otpType === $this->_typePhoneTag) {
            goto Yo;
        }
        SessionUtils::addEmailVerified($this->_formSessionVar, $Kc);
        goto N_;
        Yo:
        $this->checkDuplicates($m6, $this->_phoneKey, null);
        SessionUtils::addPhoneVerified($this->_formSessionVar, $m6);
        N_:
        $this->startOtpTransaction(null, $Kc, null, $m6, null, null);
    }
    function miniorange_register_um_script()
    {
        wp_register_script("\155\x6f\166\x75\155", MOV_URL . "\151\x6e\x63\x6c\165\x64\x65\x73\57\152\163\x2f\165\155\x72\145\x67\x2e\155\x69\156\x2e\x6a\x73", array("\152\161\165\x65\x72\171"));
        wp_localize_script("\155\x6f\x76\165\x6d", "\155\x6f\165\x6d\166\x61\162", array("\163\x69\164\x65\125\122\114" => site_url(), "\x6f\x74\x70\x54\x79\160\145" => $this->_otpType, "\x6e\157\x6e\x63\x65" => wp_create_nonce($this->_nonce), "\x62\165\x74\x74\x6f\x6e\164\x65\x78\x74" => mo_($this->_buttonText), "\146\151\145\x6c\x64" => $this->_otpType === $this->_typePhoneTag ? $this->_phoneKey : "\x75\163\x65\x72\x5f\x65\155\141\x69\154", "\x69\155\147\125\x52\114" => MOV_LOADER_URL));
        wp_enqueue_script("\x6d\x6f\166\x75\155");
    }
    function isPhoneVerificationEnabled()
    {
        $np = $this->getVerificationType();
        return $np === VerificationType::PHONE || $np === VerificationType::BOTH;
    }
    function miniorange_um2_user_registration($f_, $mx)
    {
        $Jw = $this->getVerificationType();
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $Jw)) {
            goto Z4;
        }
        if (!SessionUtils::isOTPInitialized($this->_formSessionVar) && $this->_isAjaxForm) {
            goto ay;
        }
        MoUtility::initialize_transaction($this->_formSessionVar);
        $mx = $this->extractArgs($mx);
        $this->startOtpTransaction($mx["\165\x73\x65\162\x5f\x6c\x6f\147\x69\156"], $mx["\x75\x73\x65\162\x5f\145\x6d\141\x69\x6c"], new WP_Error(), $mx[$this->_phoneKey], $mx["\x75\163\145\x72\x5f\160\x61\163\x73\x77\x6f\162\144"], null);
        goto dD;
        Z4:
        $this->unsetOTPSessionVariables();
        return $f_;
        goto dD;
        ay:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::PLEASE_VALIDATE), MoConstants::ERROR_JSON_TYPE));
        dD:
        return $f_;
    }
    private function extractArgs($mx)
    {
        return array("\x75\163\145\162\137\154\157\147\x69\x6e" => $mx["\x75\x73\145\162\x5f\x6c\157\147\x69\x6e"], "\165\x73\145\162\x5f\145\x6d\x61\x69\x6c" => $mx["\165\163\x65\162\137\x65\155\141\x69\154"], $this->_phoneKey => $mx[$this->_phoneKey], "\165\163\145\162\x5f\x70\x61\x73\x73\167\x6f\162\x64" => $mx["\x75\163\x65\x72\x5f\x70\x61\x73\163\167\157\162\144"]);
    }
    function miniorange_um_user_registration($mx)
    {
        $errors = new WP_Error();
        MoUtility::initialize_transaction($this->_formSessionVar);
        foreach ($mx as $xl => $sA) {
            if ($xl == "\165\163\145\x72\x5f\154\157\x67\151\x6e") {
                goto qE;
            }
            if ($xl == "\165\163\145\x72\137\x65\x6d\x61\151\154") {
                goto eP;
            }
            if ($xl == "\165\x73\145\162\137\160\x61\163\x73\167\x6f\162\x64") {
                goto lo;
            }
            if ($xl == $this->_phoneKey) {
                goto i9;
            }
            $SU[$xl] = $sA;
            goto Zn;
            qE:
            $Iv = $sA;
            goto Zn;
            eP:
            $xX = $sA;
            goto Zn;
            lo:
            $wh = $sA;
            goto Zn;
            i9:
            $t2 = $sA;
            Zn:
            TY:
        }
        hf:
        $this->startOtpTransaction($Iv, $xX, $errors, $t2, $wh, $SU);
    }
    function startOtpTransaction($Iv, $xX, $errors, $t2, $wh, $SU)
    {
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto Ob;
        }
        if (strcasecmp($this->_otpType, $this->_typeBothTag) == 0) {
            goto aB;
        }
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::EMAIL, $wh, $SU);
        goto Fr;
        Ob:
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::PHONE, $wh, $SU);
        goto Fr;
        aB:
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::BOTH, $wh, $SU);
        Fr:
    }
    function miniorange_um2_phone_validation($mx)
    {
        $form = UM()->form();
        foreach ($mx as $xl => $sA) {
            if ($this->_isAjaxForm && $xl === $this->_formKey) {
                goto sv;
            }
            if ($xl === $this->_phoneKey) {
                goto V8;
            }
            goto jp;
            sv:
            $this->checkIntegrityAndValidateOTP($form, $sA, $mx);
            goto jp;
            V8:
            $this->processPhoneNumbers($sA, $xl, $form);
            jp:
            dg:
        }
        W_:
    }
    private function processPhoneNumbers($sA, $xl, $form = null)
    {
        global $phoneLogic;
        if (MoUtility::validatePhoneNumber($sA)) {
            goto cj;
        }
        $bJ = str_replace("\x23\x23\160\150\x6f\x6e\145\x23\43", $sA, $phoneLogic->_get_otp_invalid_format_message());
        $form->add_error($xl, $bJ);
        cj:
        $this->checkDuplicates($sA, $xl, $form);
    }
    private function checkDuplicates($sA, $xl, $form = null)
    {
        if (!($this->_restrictDuplicates && $this->isPhoneNumberAlreadyInUse($sA, $xl))) {
            goto If1;
        }
        $bJ = MoMessages::showMessage(MoMessages::PHONE_EXISTS);
        if ($this->_isAjaxForm && SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto ee;
        }
        $form->add_error($xl, $bJ);
        goto xX;
        ee:
        wp_send_json(MoUtility::createJson($bJ, MoConstants::ERROR_JSON_TYPE));
        xX:
        If1:
    }
    private function checkIntegrityAndValidateOTP($form, $sA, array $mx)
    {
        $Jw = $this->getVerificationType();
        $this->checkIntegrity($form, $mx, $Jw);
        $this->validateChallenge($Jw, NULL, $sA);
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $Jw)) {
            goto OT;
        }
        $form->add_error($this->_formKey, MoUtility::_get_invalid_otp_method());
        OT:
    }
    private function checkIntegrity($xt, array $mx, $Jw)
    {
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto oR1;
        }
        if (!(strcasecmp($this->_otpType, $this->_typeEmailTag) == 0)) {
            goto lh;
        }
        if (SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $mx["\165\x73\x65\x72\x5f\145\x6d\x61\151\154"])) {
            goto j4;
        }
        $xt->add_error($this->_formKey, MoMessages::showMessage(MoMessages::EMAIL_MISMATCH));
        j4:
        lh:
        goto Ny;
        oR1:
        if (SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $mx[$this->_phoneKey])) {
            goto Ip;
        }
        $xt->add_error($this->_formKey, MoMessages::showMessage(MoMessages::PHONE_MISMATCH));
        Ip:
        Ny:
    }
    function miniorange_um_phone_validation($mx)
    {
        global $ultimatemember;
        foreach ($mx as $xl => $sA) {
            if ($this->_isAjaxForm && $xl === $this->_formKey) {
                goto eX;
            }
            if ($xl === $this->_phoneKey) {
                goto ot;
            }
            goto fA;
            eX:
            $this->checkIntegrityAndValidateOTP($ultimatemember->form, $sA, $mx);
            goto fA;
            ot:
            $this->processPhoneNumbers($sA, $xl, $ultimatemember->form);
            fA:
            KO:
        }
        QJ:
    }
    function isPhoneNumberAlreadyInUse($lr, $xl)
    {
        global $wpdb;
        MoUtility::processPhoneNumber($lr);
        $yp = "\x53\x45\x4c\105\103\124\x20\140\x75\x73\x65\x72\137\151\x64\140\x20\106\x52\117\115\x20\x60{$wpdb->prefix}\x75\x73\145\162\155\145\164\141\x60\x20\x57\110\105\x52\x45\40\x60\155\x65\164\x61\x5f\x6b\145\171\x60\x20\75\40\x27{$xl}\x27\x20\101\116\x44\40\140\x6d\145\164\x61\x5f\166\141\x6c\x75\145\140\40\75\40\x20\47{$lr}\x27";
        $D5 = $wpdb->get_row($yp);
        return !MoUtility::isBlank($D5);
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto um;
        }
        return;
        um:
        $Jw = $this->getVerificationType();
        $aG = $Jw === VerificationType::BOTH ? TRUE : FALSE;
        if ($this->_isAjaxForm) {
            goto aO;
        }
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $Jw, $aG);
        aO:
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        if (function_exists("\x69\163\137\160\154\165\x67\x69\x6e\137\141\143\164\x69\x76\x65")) {
            goto VA;
        }
        include_once ABSPATH . "\167\x70\x2d\141\x64\x6d\x69\x6e\x2f\151\156\143\154\165\144\145\163\57\x70\154\x75\147\151\x6e\56\x70\150\x70";
        VA:
        if ($this->isUltimateMemberV2Installed()) {
            goto Dl;
        }
        $this->register_ultimateMember_user($u0, $Kc, $wh, $t2, $SU);
        goto hi;
        Dl:
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
        hi:
    }
    function register_ultimateMember_user($u0, $Kc, $wh, $t2, $SU)
    {
        $mx = array();
        $mx["\165\163\145\162\137\154\157\x67\151\x6e"] = $u0;
        $mx["\165\163\145\162\x5f\x65\x6d\141\151\154"] = $Kc;
        $mx["\x75\163\x65\x72\x5f\160\141\x73\163\x77\157\x72\x64"] = $wh;
        $mx = array_merge($mx, $SU);
        $d2 = wp_create_user($u0, $wh, $Kc);
        $this->unsetOTPSessionVariables();
        do_action("\165\155\x5f\x61\146\164\145\162\137\x6e\x65\x77\137\165\163\x65\x72\x5f\x72\x65\x67\x69\x73\x74\145\162", $d2, $mx);
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->isPhoneVerificationEnabled())) {
            goto O7;
        }
        array_push($lP, $this->_phoneFormId);
        O7:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto Ds;
        }
        return;
        Ds:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\165\155\137\x64\x65\x66\x61\165\154\x74\137\145\156\141\x62\x6c\x65");
        $this->_otpType = $this->sanitizeFormPOST("\165\x6d\137\x65\x6e\141\142\154\145\x5f\x74\171\160\x65");
        $this->_restrictDuplicates = $this->_otpType != $this->_typePhoneTag ? '' : $this->sanitizeFormPOST("\x75\155\137\162\x65\163\164\x72\151\x63\164\x5f\144\165\160\x6c\151\143\141\164\x65\163");
        $this->_isAjaxForm = $this->sanitizeFormPOST("\x75\x6d\137\151\x73\137\141\x6a\141\x78\137\146\x6f\x72\x6d");
        $this->_buttonText = $this->sanitizeFormPOST("\165\x6d\137\x62\x75\164\164\157\x6e\137\164\x65\x78\x74");
        $this->_formKey = $this->sanitizeFormPOST("\x75\x6d\x5f\x76\145\162\151\146\171\x5f\155\x65\x74\x61\137\x6b\145\x79");
        $this->_phoneKey = $this->sanitizeFormPOST("\165\155\x5f\x70\150\x6f\156\145\x5f\x6b\145\171");
        if (!$this->basicValidationCheck(BaseMessages::UM_CHOOSE)) {
            goto eA;
        }
        update_mo_option("\x75\155\137\x70\150\x6f\x6e\x65\x5f\153\145\171", $this->_phoneKey);
        update_mo_option("\x75\x6d\137\x64\145\x66\x61\x75\x6c\164\137\x65\156\x61\x62\x6c\145", $this->_isFormEnabled);
        update_mo_option("\x75\x6d\x5f\145\x6e\141\142\154\x65\137\x74\x79\x70\145", $this->_otpType);
        update_mo_option("\x75\155\137\162\x65\x73\164\162\151\143\x74\x5f\x64\x75\x70\154\x69\143\141\164\x65\x73", $this->_restrictDuplicates);
        update_mo_option("\x75\155\x5f\151\163\137\141\152\141\170\x5f\146\157\162\x6d", $this->_isAjaxForm);
        update_mo_option("\165\155\x5f\x62\x75\x74\164\x6f\x6e\137\x74\x65\170\x74", $this->_buttonText);
        update_mo_option("\165\155\137\166\x65\x72\151\x66\x79\x5f\155\145\164\141\137\x6b\x65\x79", $this->_formKey);
        eA:
    }
}
