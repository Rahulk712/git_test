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
use WPCF7_FormTag;
use WPCF7_Validation;
class ContactForm7 extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::CF7_FORMS;
        $this->_typePhoneTag = "\155\x6f\x5f\x63\x66\x37\x5f\143\x6f\156\164\141\143\x74\137\160\x68\x6f\x6e\x65\x5f\x65\156\x61\142\154\145";
        $this->_typeEmailTag = "\155\x6f\137\x63\146\67\137\x63\x6f\156\164\141\x63\164\137\x65\x6d\x61\151\x6c\x5f\145\156\141\x62\x6c\x65";
        $this->_formKey = "\103\x46\67\x5f\x46\x4f\x52\115";
        $this->_formName = mo_("\103\157\156\164\141\x63\164\x20\x46\x6f\162\x6d\x20\x37\x20\x2d\x20\103\157\156\164\141\143\x74\x20\106\x6f\162\x6d");
        $this->_isFormEnabled = get_mo_option("\143\146\x37\137\x63\x6f\156\x74\x61\143\x74\x5f\x65\x6e\x61\x62\x6c\x65");
        $this->_generateOTPAction = "\x6d\x69\156\x69\x6f\162\141\156\x67\145\x2d\143\146\x37\55\x63\x6f\156\164\x61\143\164";
        $this->_formDocuments = MoOTPDocs::CF7_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x63\x66\67\x5f\143\157\x6e\x74\x61\143\x74\x5f\x74\171\x70\x65");
        $this->_emailKey = get_mo_option("\143\146\x37\x5f\x65\155\141\151\154\137\x6b\145\x79");
        $this->_phoneKey = "\x6d\x6f\x5f\160\150\x6f\x6e\145";
        $this->_phoneFormId = array("\x2e\x63\154\141\x73\163\137" . $this->_phoneKey, "\x69\x6e\x70\x75\164\x5b\156\141\155\x65\75" . $this->_phoneKey . "\x5d");
        add_filter("\x77\160\143\146\67\137\166\x61\x6c\x69\x64\141\x74\x65\x5f\x74\145\x78\164\x2a", array($this, "\166\141\x6c\151\144\x61\x74\x65\106\157\162\x6d\120\x6f\163\164"), 1, 2);
        add_filter("\x77\x70\143\146\67\x5f\x76\x61\154\151\x64\x61\x74\x65\x5f\145\155\x61\x69\154\52", array($this, "\x76\x61\154\x69\x64\141\x74\145\106\x6f\x72\155\x50\x6f\163\x74"), 1, 2);
        add_filter("\x77\x70\143\146\67\137\x76\141\x6c\x69\144\x61\164\145\137\x65\x6d\x61\x69\x6c", array($this, "\x76\x61\154\x69\x64\141\164\145\x46\x6f\162\x6d\120\157\x73\x74"), 1, 2);
        add_filter("\167\160\x63\x66\x37\137\166\141\x6c\151\x64\x61\x74\x65\x5f\x74\x65\154\x2a", array($this, "\166\x61\x6c\151\x64\x61\164\145\x46\x6f\162\x6d\x50\x6f\163\164"), 1, 2);
        add_shortcode("\155\x6f\137\x76\145\x72\x69\x66\x79\x5f\145\x6d\x61\x69\x6c", array($this, "\137\x63\146\67\x5f\145\x6d\141\151\154\137\x73\150\157\x72\164\143\157\x64\145"));
        add_shortcode("\x6d\x6f\x5f\x76\145\162\151\146\x79\x5f\160\150\x6f\x6e\x65", array($this, "\137\x63\146\x37\x5f\160\150\x6f\x6e\x65\137\x73\150\157\x72\164\143\157\x64\145"));
        add_action("\x77\x70\137\x61\152\x61\x78\137\x6e\x6f\160\x72\151\x76\137{$this->_generateOTPAction}", array($this, "\x5f\150\x61\156\x64\154\x65\x5f\143\x66\67\137\x63\x6f\x6e\164\141\x63\164\x5f\x66\157\x72\x6d"));
        add_action("\x77\x70\137\x61\x6a\141\170\x5f{$this->_generateOTPAction}", array($this, "\137\150\x61\x6e\144\x6c\145\x5f\x63\146\x37\137\143\157\x6e\164\x61\143\164\137\x66\x6f\x72\x6d"));
    }
    function _handle_cf7_contact_form()
    {
        $Jf = $_POST;
        $this->validateAjaxRequest();
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (MoUtility::sanitizeCheck("\165\x73\145\x72\x5f\x65\155\141\x69\154", $Jf)) {
            goto So;
        }
        if (MoUtility::sanitizeCheck("\165\163\145\162\x5f\160\x68\157\156\x65", $Jf)) {
            goto i_;
        }
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto lb;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_EMAIL), MoConstants::ERROR_JSON_TYPE));
        goto IG;
        lb:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_PHONE), MoConstants::ERROR_JSON_TYPE));
        IG:
        goto FN;
        i_:
        SessionUtils::addPhoneVerified($this->_formSessionVar, trim($Jf["\165\x73\145\162\x5f\160\x68\157\x6e\x65"]));
        $this->sendChallenge("\x74\x65\x73\x74", '', null, trim($Jf["\x75\163\x65\162\137\160\x68\157\x6e\x65"]), VerificationType::PHONE);
        FN:
        goto vj;
        So:
        SessionUtils::addEmailVerified($this->_formSessionVar, $Jf["\165\163\145\162\137\x65\155\x61\x69\154"]);
        $this->sendChallenge("\164\145\x73\164", $Jf["\x75\x73\x65\x72\x5f\145\x6d\x61\151\154"], null, $Jf["\x75\x73\145\162\x5f\145\x6d\x61\x69\154"], VerificationType::EMAIL);
        vj:
    }
    function validateFormPost($ll, $sm)
    {
        $sm = new WPCF7_FormTag($sm);
        $Hk = $sm->name;
        $sA = isset($_POST[$Hk]) ? trim(wp_unslash(strtr((string) $_POST[$Hk], "\xa", "\40"))) : '';
        if (!("\145\x6d\x61\x69\154" == $sm->basetype && $Hk == $this->_emailKey && strcasecmp($this->_otpType, $this->_typeEmailTag) == 0)) {
            goto PV;
        }
        SessionUtils::addEmailSubmitted($this->_formSessionVar, $sA);
        PV:
        if (!("\x74\145\x6c" == $sm->basetype && $Hk == $this->_phoneKey && strcasecmp($this->_otpType, $this->_typePhoneTag) == 0)) {
            goto gg;
        }
        SessionUtils::addPhoneSubmitted($this->_formSessionVar, $sA);
        gg:
        if (!("\164\x65\x78\164" == $sm->basetype && $Hk == "\145\x6d\141\151\154\x5f\166\145\162\151\x66\x79" || "\x74\145\170\164" == $sm->basetype && $Hk == "\x70\x68\x6f\156\x65\137\166\x65\162\x69\x66\x79")) {
            goto JN;
        }
        $this->checkIfVerificationCodeNotEntered($Hk, $ll, $sm);
        $this->checkIfVerificationNotStarted($ll, $sm);
        if (!(strcasecmp($this->_otpType, $this->_typeEmailTag) == 0)) {
            goto kY;
        }
        $this->processEmail($ll, $sm);
        kY:
        if (!(strcasecmp($this->_otpType, $this->_typePhoneTag) == 0)) {
            goto n0;
        }
        $this->processPhoneNumber($ll, $sm);
        n0:
        if (!empty($ll->get_invalid_fields())) {
            goto M2;
        }
        if (!$this->processOTPEntered($Hk)) {
            goto Ox;
        }
        $this->unsetOTPSessionVariables();
        goto LZ;
        Ox:
        $ll->invalidate($sm, MoUtility::_get_invalid_otp_method());
        LZ:
        M2:
        JN:
        return $ll;
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VERIFICATION_FAILED, $m5);
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
    }
    function processOTPEntered($Hk)
    {
        $Jw = $this->getVerificationType();
        $this->validateChallenge($Jw, $Hk, NULL);
        return SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $Jw);
    }
    function processEmail(&$ll, $sm)
    {
        if (SessionUtils::isEmailSubmittedAndVerifiedMatch($this->_formSessionVar)) {
            goto NH;
        }
        $ll->invalidate($sm, mo_(MoMessages::showMessage(MoMessages::EMAIL_MISMATCH)));
        NH:
    }
    function processPhoneNumber(&$ll, $sm)
    {
        if (Sessionutils::isPhoneSubmittedAndVerifiedMatch($this->_formSessionVar)) {
            goto nU;
        }
        $ll->invalidate($sm, mo_(MoMessages::showMessage(MoMessages::PHONE_MISMATCH)));
        nU:
    }
    function checkIfVerificationNotStarted(&$ll, $sm)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto af;
        }
        $ll->invalidate($sm, mo_(MoMessages::showMessage(MoMessages::PLEASE_VALIDATE)));
        af:
    }
    function checkIfVerificationCodeNotEntered($Hk, &$ll, $sm)
    {
        if (MoUtility::sanitizeCheck($Hk, $_REQUEST)) {
            goto Dg;
        }
        $ll->invalidate($sm, wpcf7_get_message("\x69\156\166\141\154\151\x64\137\162\x65\x71\165\x69\x72\x65\144"));
        Dg:
    }
    function _cf7_email_shortcode($ZM)
    {
        $IP = MoUtility::sanitizeCheck("\x6b\x65\171", $ZM);
        $J5 = MoUtility::sanitizeCheck("\142\165\x74\x74\157\x6e\x69\144", $ZM);
        $HQ = MoUtility::sanitizeCheck("\x6d\x65\x73\163\141\x67\x65\x64\x69\x76", $ZM);
        $IP = $IP ? "\x23" . $IP : "\151\156\x70\165\x74\133\156\x61\x6d\x65\x3d\47" . $this->_emailKey . "\47\x5d";
        $J5 = $J5 ? $J5 : "\x6d\x69\156\151\157\162\x61\x6e\x67\145\137\157\164\160\x5f\164\157\x6b\x65\x6e\137\x73\x75\142\x6d\151\x74";
        $HQ = $HQ ? $HQ : "\155\157\x5f\x6d\x65\163\x73\141\147\145";
        $Mt = "\74\144\151\166\x20\163\x74\x79\154\x65\x3d\x27\144\x69\163\160\x6c\x61\171\x3a\x74\x61\x62\x6c\x65\73\164\x65\170\164\x2d\x61\154\x69\147\x6e\72\x63\x65\156\164\145\x72\73\x27\76" . "\74\x69\155\x67\x20\x73\162\143\x3d\47" . MOV_URL . "\151\x6e\x63\x6c\165\144\145\x73\57\151\x6d\x61\147\x65\163\x2f\x6c\x6f\141\x64\145\162\56\147\151\146\47\76" . "\x3c\57\144\151\x76\76";
        $zn = "\x3c\x73\x63\x72\x69\x70\164\76" . "\152\121\x75\x65\162\x79\x28\144\157\x63\165\155\145\x6e\164\51\56\162\x65\x61\x64\x79\50\146\165\x6e\143\164\151\x6f\x6e\x28\x29\x7b" . "\x24\155\x6f\x3d\152\x51\x75\x65\x72\x79\73" . "\44\x6d\x6f\x28\40\x22\x23" . $J5 . "\x22\x20\51\x2e\x65\141\x63\x68\50\x66\x75\x6e\143\x74\x69\157\156\50\151\x6e\144\x65\170\x29\x20\173" . "\x24\155\157\x28\164\150\151\163\x29\x2e\x6f\156\x28\42\x63\x6c\x69\143\153\42\x2c\x20\146\x75\156\x63\x74\151\157\156\x28\x29\173" . "\166\x61\x72\40\164\40\75\x20\x24\155\x6f\x28\x74\150\151\x73\x29\x2e\x63\154\x6f\x73\145\x73\164\x28\x22\146\157\x72\155\42\x29\73" . "\166\141\x72\x20\145\40\75\x20\x74\56\x66\x69\x6e\x64\50\42" . $IP . "\42\51\56\166\141\x6c\50\51\73" . "\166\141\162\x20\156\x20\75\x20\164\x2e\x66\151\x6e\x64\x28\x22\x69\x6e\x70\165\x74\133\x6e\x61\x6d\145\x3d\x27\145\155\x61\151\154\137\166\145\162\x69\x66\x79\x27\135\42\51\73" . "\166\141\x72\40\144\x20\75\40\x74\56\146\x69\x6e\x64\50\42\43" . $HQ . "\42\51\73" . "\144\56\145\155\160\164\171\50\51\73" . "\x64\x2e\x61\160\x70\145\x6e\144\50\42" . $Mt . "\42\51\73" . "\144\x2e\x73\x68\x6f\167\50\x29\73" . "\x24\155\x6f\56\x61\152\x61\x78\50\173" . "\165\x72\x6c\x3a\x22" . wp_ajax_url() . "\x22\x2c" . "\164\x79\x70\145\x3a\42\x50\x4f\123\124\42\x2c" . "\x64\x61\164\x61\72\x7b" . "\165\x73\x65\162\137\x65\155\x61\x69\x6c\x3a\145\x2c" . "\x61\x63\x74\151\157\156\x3a\42" . $this->_generateOTPAction . "\x22\54" . $this->_nonceKey . "\x3a\x22" . wp_create_nonce($this->_nonce) . "\x22" . "\x7d\54" . "\x63\x72\x6f\x73\x73\104\157\155\x61\151\156\x3a\x21\60\x2c" . "\x64\141\164\x61\124\171\x70\145\x3a\x22\152\x73\x6f\x6e\x22\54" . "\x73\x75\143\x63\x65\163\163\72\x66\165\x6e\143\164\x69\157\156\50\x6f\x29\173\x20" . "\x69\x66\50\x6f\x2e\x72\x65\x73\x75\154\x74\75\75\x22\x73\x75\x63\x63\145\163\163\42\51\x7b" . "\144\56\145\x6d\160\x74\x79\x28\x29\54" . "\144\56\141\160\x70\145\x6e\x64\x28\x6f\56\155\x65\x73\163\x61\147\x65\51\54" . "\144\56\x63\x73\163\x28\42\142\157\162\x64\145\x72\55\x74\157\160\x22\54\x22\63\160\170\x20\x73\x6f\x6c\x69\x64\40\x67\x72\145\145\x6e\42\x29\x2c" . "\x6e\x2e\146\157\x63\165\163\50\x29" . "\x7d\x65\x6c\x73\x65\173" . "\x64\x2e\x65\155\x70\164\171\x28\51\x2c" . "\x64\x2e\141\x70\x70\x65\x6e\x64\50\x6f\x2e\155\x65\x73\x73\x61\147\x65\x29\54" . "\144\x2e\x63\x73\x73\50\42\x62\x6f\162\144\145\x72\x2d\164\x6f\x70\x22\54\42\x33\160\x78\x20\x73\157\x6c\x69\144\40\x72\145\144\42\x29" . "\175" . "\175\54" . "\145\162\162\157\x72\x3a\x66\165\x6e\x63\x74\151\x6f\x6e\50\157\54\x65\54\156\51\x7b\175" . "\x7d\51" . "\175\51\x3b" . "\175\51\73" . "\175\51\73" . "\x3c\57\x73\143\x72\x69\x70\164\76";
        return $zn;
    }
    function _cf7_phone_shortcode($ZM)
    {
        $JL = MoUtility::sanitizeCheck("\153\145\171", $ZM);
        $J5 = MoUtility::sanitizeCheck("\142\165\164\x74\157\156\x69\144", $ZM);
        $HQ = MoUtility::sanitizeCheck("\155\x65\163\x73\x61\147\x65\x64\x69\166", $ZM);
        $JL = $JL ? "\43" . $JL : "\151\156\x70\x75\164\x5b\156\x61\155\145\x3d\x27" . $this->_phoneKey . "\x27\x5d";
        $J5 = $J5 ? $J5 : "\155\151\156\x69\x6f\x72\x61\156\147\x65\x5f\157\164\160\x5f\164\157\153\145\156\x5f\163\x75\x62\x6d\x69\x74";
        $HQ = $HQ ? $HQ : "\155\157\x5f\x6d\x65\x73\163\x61\x67\x65";
        $Mt = "\74\144\151\166\40\x73\x74\171\x6c\x65\75\47\x64\151\x73\x70\154\x61\171\x3a\164\x61\x62\154\145\73\164\145\x78\x74\x2d\141\x6c\151\147\x6e\x3a\143\145\x6e\164\145\x72\73\47\x3e" . "\74\151\x6d\147\40\x73\x72\143\x3d\47" . MOV_URL . "\x69\156\x63\x6c\x75\x64\x65\163\x2f\151\155\x61\147\x65\163\57\154\x6f\141\x64\145\162\x2e\147\x69\x66\47\x3e" . "\74\57\144\x69\x76\x3e";
        $zn = "\74\163\143\162\151\x70\x74\76" . "\152\x51\x75\145\162\x79\x28\144\x6f\x63\165\x6d\x65\x6e\x74\51\56\162\x65\x61\144\x79\50\146\x75\x6e\143\x74\151\x6f\156\x28\51\173" . "\x24\x6d\157\x3d\152\121\165\145\x72\x79\73\44\155\157\x28\40\42\x23" . $J5 . "\x22\x20\51\x2e\145\141\143\150\50\146\165\x6e\143\x74\151\157\x6e\x28\x69\156\x64\x65\170\x29\40\173" . "\x24\155\157\50\x74\x68\x69\163\x29\x2e\x6f\x6e\50\x22\143\x6c\x69\143\153\42\x2c\x20\x66\165\156\143\164\151\x6f\156\x28\51\x7b" . "\x76\x61\162\x20\x74\x20\75\x20\44\x6d\157\50\x74\150\151\163\51\56\x63\154\157\x73\145\x73\x74\50\42\146\x6f\x72\155\x22\x29\73" . "\x76\141\x72\x20\145\x20\75\40\164\56\x66\151\156\144\x28\x22" . $JL . "\x22\51\x2e\166\x61\154\x28\51\73" . "\x76\141\162\40\x6e\40\x3d\40\x74\x2e\x66\151\156\144\50\42\x69\x6e\160\x75\164\133\156\x61\155\145\75\47\160\150\x6f\x6e\145\x5f\166\x65\x72\x69\x66\171\x27\x5d\42\51\x3b" . "\166\x61\162\x20\x64\40\75\40\164\x2e\146\151\156\144\50\42\43" . $HQ . "\42\51\73" . "\x64\56\145\x6d\x70\164\x79\50\51\73" . "\144\56\x61\160\x70\145\x6e\144\x28\42" . $Mt . "\42\x29\73" . "\144\56\x73\150\x6f\x77\50\x29\x3b" . "\x24\x6d\157\x2e\x61\152\141\x78\x28\173" . "\165\162\x6c\72\x22" . wp_ajax_url() . "\x22\54" . "\164\x79\x70\x65\72\x22\120\117\123\124\x22\x2c" . "\x64\141\164\141\x3a\173" . "\x75\x73\145\162\x5f\x70\150\x6f\156\x65\x3a\145\54" . "\141\143\x74\x69\x6f\156\x3a\42" . $this->_generateOTPAction . "\42\54" . $this->_nonceKey . "\72\42" . wp_create_nonce($this->_nonce) . "\42" . "\175\x2c" . "\143\x72\157\163\x73\104\157\x6d\141\151\x6e\x3a\x21\x30\x2c" . "\x64\x61\x74\x61\x54\171\x70\145\72\42\x6a\x73\x6f\x6e\x22\54" . "\163\x75\x63\143\x65\x73\x73\72\146\x75\x6e\143\164\x69\157\156\50\x6f\x29\173\x20" . "\151\146\x28\157\x2e\162\x65\163\x75\154\164\x3d\x3d\x22\x73\x75\x63\143\x65\163\x73\x22\51\173" . "\x64\56\145\155\160\164\x79\x28\51\54" . "\x64\56\141\x70\x70\x65\x6e\x64\x28\157\56\155\x65\163\x73\141\x67\x65\51\x2c" . "\144\x2e\x63\x73\163\x28\42\142\157\x72\x64\x65\x72\55\x74\157\x70\42\x2c\42\63\160\x78\x20\163\157\154\x69\x64\40\147\x72\145\145\x6e\x22\x29\54" . "\x6e\x2e\146\157\x63\x75\163\x28\x29" . "\x7d\145\154\163\145\x7b" . "\x64\x2e\x65\155\160\x74\171\x28\x29\x2c" . "\x64\x2e\x61\x70\160\x65\x6e\144\50\x6f\x2e\x6d\x65\163\x73\141\x67\145\x29\54" . "\x64\56\x63\163\163\50\x22\142\157\x72\144\145\x72\55\164\157\x70\42\x2c\x22\x33\x70\170\40\x73\157\x6c\151\144\x20\x72\x65\x64\x22\51" . "\175" . "\x7d\x2c" . "\145\162\x72\157\162\x3a\146\x75\156\143\x74\x69\x6f\x6e\x28\x6f\54\x65\54\156\51\x7b\175" . "\x7d\51" . "\x7d\x29\x3b" . "\175\51\73" . "\x7d\x29\x3b" . "\74\57\163\x63\x72\151\x70\164\76";
        return $zn;
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->_isFormEnabled && $this->_otpType == $this->_typePhoneTag)) {
            goto Ao;
        }
        $lP = array_merge($lP, $this->_phoneFormId);
        Ao:
        return $lP;
    }
    private function emailKeyValidationCheck()
    {
        if (!($this->_otpType === $this->_typeEmailTag && MoUtility::isBlank($this->_emailKey))) {
            goto EU;
        }
        do_action("\155\x6f\137\162\145\147\x69\163\x74\x72\141\164\x69\157\x6e\x5f\163\150\x6f\x77\137\x6d\x65\x73\x73\x61\147\145", MoMessages::showMessage(BaseMessages::CF7_PROVIDE_EMAIL_KEY), MoConstants::ERROR);
        return false;
        EU:
        return true;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto Cm;
        }
        return;
        Cm:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x63\146\x37\x5f\143\x6f\156\164\141\143\x74\137\x65\x6e\x61\x62\154\x65");
        $this->_otpType = $this->sanitizeFormPOST("\x63\146\x37\x5f\143\157\x6e\x74\141\143\164\137\x74\171\x70\145");
        $this->_emailKey = $this->sanitizeFormPOST("\143\146\67\137\145\155\141\151\x6c\137\x66\x69\145\154\144\137\153\x65\171");
        if (!($this->basicValidationCheck(BaseMessages::CF7_CHOOSE) && $this->emailKeyValidationCheck())) {
            goto Sr;
        }
        update_mo_option("\x63\x66\67\137\143\x6f\156\x74\x61\143\x74\137\x65\x6e\141\x62\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\143\146\67\x5f\143\x6f\156\x74\x61\x63\164\x5f\164\171\160\x65", $this->_otpType);
        update_mo_option("\x63\x66\x37\137\145\155\141\x69\x6c\x5f\x6b\x65\171", $this->_emailKey);
        Sr:
    }
}
