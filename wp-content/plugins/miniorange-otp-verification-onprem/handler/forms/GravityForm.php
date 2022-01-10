<?php


namespace OTP\Handler\Forms;

use GF_Field;
use GFAPI;
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
class GravityForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::GF_FORMS;
        $this->_typePhoneTag = "\155\157\x5f\x67\146\137\143\x6f\156\x74\x61\143\164\x5f\x70\x68\x6f\156\x65\x5f\x65\x6e\141\142\154\x65";
        $this->_typeEmailTag = "\155\x6f\137\x67\x66\x5f\x63\157\x6e\164\x61\143\x74\x5f\x65\155\x61\151\154\137\145\156\x61\142\154\x65";
        $this->_formKey = "\107\122\x41\126\x49\124\x59\137\106\x4f\122\x4d";
        $this->_formName = mo_("\x47\162\x61\x76\151\x74\171\40\x46\x6f\x72\155");
        $this->_isFormEnabled = get_mo_option("\x67\146\x5f\143\x6f\156\164\141\143\164\x5f\145\x6e\x61\142\x6c\x65");
        $this->_phoneFormId = "\56\x67\x69\x6e\x70\x75\164\137\x63\x6f\156\x74\x61\151\156\145\x72\x5f\160\x68\x6f\x6e\145";
        $this->_buttonText = get_mo_option("\x67\146\x5f\142\x75\164\x74\x6f\156\x5f\164\145\x78\x74");
        $this->_buttonText = !MoUtility::isBlank($this->_buttonText) ? $this->_buttonText : mo_("\x43\154\151\143\x6b\40\110\x65\162\x65\40\x74\157\x20\x73\145\156\x64\x20\x4f\x54\x50");
        $this->_formDocuments = MoOTPDocs::GF_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x67\x66\x5f\x63\157\156\164\141\x63\x74\137\164\x79\160\145");
        $this->_formDetails = maybe_unserialize(get_mo_option("\147\146\137\157\x74\160\x5f\145\x6e\x61\x62\154\x65\x64"));
        if (!empty($this->_formDetails)) {
            goto oF;
        }
        return;
        oF:
        add_filter("\147\x66\157\162\155\137\146\151\145\154\144\x5f\x63\157\x6e\164\x65\156\164", array($this, "\x5f\x61\144\x64\137\x73\143\x72\x69\160\164\163"), 1, 5);
        add_filter("\147\146\x6f\x72\x6d\137\x66\151\x65\x6c\x64\x5f\166\x61\x6c\x69\144\141\x74\x69\x6f\156", array($this, "\x76\141\154\x69\x64\x61\164\x65\x5f\146\157\x72\155\x5f\x73\x75\x62\155\x69\x74"), 1, 5);
        $this->routeData();
    }
    function routeData()
    {
        if (array_key_exists("\x6f\x70\164\151\157\x6e", $_GET)) {
            goto Cw;
        }
        return;
        Cw:
        switch (trim($_GET["\x6f\160\164\x69\x6f\156"])) {
            case "\155\x69\x6e\x69\x6f\162\x61\x6e\147\x65\55\147\146\55\x63\157\x6e\164\141\x63\x74":
                $this->_handle_gf_form($_POST);
                goto b1;
        }
        N3:
        b1:
    }
    function _handle_gf_form($rY)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (!($this->_otpType === $this->_typeEmailTag)) {
            goto Ft;
        }
        $this->processEmailAndStartOTPVerificationProcess($rY);
        Ft:
        if (!($this->_otpType === $this->_typePhoneTag)) {
            goto LC;
        }
        $this->processPhoneAndStartOTPVerificationProcess($rY);
        LC:
    }
    function processEmailAndStartOTPVerificationProcess($rY)
    {
        if (MoUtility::sanitizeCheck("\165\163\x65\162\137\145\155\x61\151\x6c", $rY)) {
            goto bp;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_EMAIL), MoConstants::ERROR_JSON_TYPE));
        goto a4;
        bp:
        SessionUtils::addEmailVerified($this->_formSessionVar, $rY["\x75\x73\145\162\137\145\155\x61\x69\x6c"]);
        $this->sendChallenge('', $rY["\165\x73\x65\x72\137\145\155\x61\x69\154"], null, $rY["\x75\x73\x65\x72\137\145\x6d\x61\151\154"], VerificationType::EMAIL);
        a4:
    }
    function processPhoneAndStartOTPVerificationProcess($rY)
    {
        if (MoUtility::sanitizeCheck("\x75\163\145\x72\137\160\x68\x6f\156\145", $rY)) {
            goto Kc;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_PHONE), MoConstants::ERROR_JSON_TYPE));
        goto fn;
        Kc:
        SessionUtils::addPhoneVerified($this->_formSessionVar, trim($rY["\165\163\145\162\x5f\x70\150\x6f\x6e\145"]));
        $this->sendChallenge('', '', null, trim($rY["\165\x73\x65\162\137\x70\x68\x6f\156\145"]), VerificationType::PHONE);
        fn:
    }
    function _add_scripts($W8, $uG, $sA, $XW, $qL)
    {
        $nk = $this->_formDetails[$qL];
        if (MoUtility::isBlank($nk)) {
            goto Oe;
        }
        if (!(strcasecmp($this->_otpType, $this->_typeEmailTag) === 0 && get_class($uG) === "\107\106\137\x46\x69\145\154\x64\x5f\105\155\x61\151\154" && $uG["\x69\144"] == $nk["\x65\155\x61\151\x6c\153\145\171"])) {
            goto Rx;
        }
        $W8 = $this->_add_shortcode_to_form("\145\155\141\x69\154", $W8, $uG, $qL);
        Rx:
        if (!(strcasecmp($this->_otpType, $this->_typePhoneTag) === 0 && get_class($uG) === "\107\106\x5f\x46\151\145\x6c\144\x5f\120\150\x6f\x6e\x65" && $uG["\151\x64"] == $nk["\160\x68\157\x6e\145\153\145\x79"])) {
            goto kg;
        }
        $W8 = $this->_add_shortcode_to_form("\x70\150\157\x6e\x65", $W8, $uG, $qL);
        kg:
        Oe:
        return $W8;
    }
    function _add_shortcode_to_form($mq, $W8, $uG, $qL)
    {
        $Mt = "\74\144\151\166\40\163\x74\x79\154\145\75\x27\x64\151\x73\x70\154\141\171\72\x74\141\142\154\145\x3b\x74\145\x78\x74\x2d\x61\x6c\x69\x67\x6e\72\x63\x65\x6e\164\x65\162\x3b\x27\76\x3c\151\155\147\x20\x73\x72\x63\75\x27" . MOV_URL . "\151\x6e\x63\154\x75\x64\145\163\x2f\151\x6d\141\147\145\x73\x2f\154\157\x61\144\145\162\x2e\147\x69\x66\x27\x3e\x3c\57\x64\x69\x76\76";
        $W8 .= "\x3c\144\x69\166\40\163\164\171\x6c\145\x3d\x27\155\141\x72\x67\151\x6e\55\164\157\x70\72\x20\62\x25\x3b\47\76\x3c\x69\x6e\x70\165\164\40\x74\x79\x70\145\x3d\x27\142\x75\164\x74\157\156\47\40\143\x6c\141\163\163\75\x27\x67\146\x6f\162\x6d\x5f\x62\165\164\164\x6f\x6e\x20\142\x75\x74\164\x6f\x6e\40\155\x65\144\x69\x75\x6d\x27\40";
        $W8 .= "\x69\144\x3d\x27\x6d\x69\156\x69\157\x72\141\156\147\145\137\x6f\164\160\137\x74\157\x6b\145\x6e\137\x73\165\x62\x6d\151\164\47\40\164\151\x74\154\x65\x3d\47\120\x6c\x65\141\163\145\x20\105\156\x74\x65\162\x20\x61\x6e\x20" . $mq . "\40\164\157\40\x65\x6e\x61\x62\x6c\145\40\x74\x68\151\x73\x27\40";
        $W8 .= "\166\141\x6c\x75\145\x3d\40\x27" . mo_($this->_buttonText) . "\x27\x3e\74\x64\x69\166\x20\163\x74\171\x6c\x65\75\47\155\x61\x72\x67\x69\x6e\55\164\157\x70\72\62\45\47\76";
        $W8 .= "\x3c\144\151\166\40\x69\144\x3d\47\x6d\x6f\137\155\145\x73\x73\x61\147\x65\x27\x20\x68\151\x64\144\145\x6e\75\47\47\40\163\164\x79\154\x65\75\x27\142\141\143\153\x67\162\x6f\165\156\144\x2d\143\157\x6c\x6f\162\x3a\x20\x23\x66\67\146\66\x66\x37\73\160\141\144\144\x69\156\x67\72\40\61\145\155\x20\x32\145\x6d\x20\61\145\155\40\63\x2e\x35\x65\155\x3b\x27\x3e\74\57\144\151\166\76\74\x2f\x64\x69\x76\x3e\74\57\x64\x69\x76\x3e";
        $W8 .= "\x3c\163\164\171\x6c\145\x3e\x40\155\145\144\x69\141\40\x6f\156\154\171\x20\163\143\162\x65\145\x6e\40\x61\156\144\x20\50\x6d\151\x6e\x2d\167\151\144\164\x68\x3a\40\66\64\x31\x70\x78\51\x20\173\x20\x23\155\x6f\137\x6d\x65\163\163\x61\x67\x65\40\173\40\167\151\x64\164\x68\x3a\40\x63\141\154\143\x28\65\x30\45\x20\x2d\x20\x38\x70\x78\51\73\175\x7d\74\x2f\163\x74\x79\154\x65\76";
        $W8 .= "\x3c\163\x63\162\x69\160\164\76\x6a\121\x75\145\x72\171\50\144\157\x63\165\155\x65\156\x74\x29\x2e\162\x65\141\144\171\x28\x66\165\156\143\x74\151\157\x6e\x28\x29\173\x24\155\x6f\75\152\121\x75\145\162\x79\73\x24\x6d\x6f\50\x22\43\x67\146\157\162\155\137" . $qL . "\40\43\155\x69\x6e\x69\x6f\x72\141\x6e\x67\x65\x5f\157\164\160\x5f\164\157\153\x65\156\137\163\165\142\155\x69\164\42\x29\56\x63\154\x69\143\x6b\x28\x66\x75\x6e\143\164\151\157\x6e\x28\x6f\x29\x7b";
        $W8 .= "\x76\x61\162\x20\x65\75\44\x6d\157\50\42\43\x69\156\x70\165\164\137" . $qL . "\x5f" . $uG->id . "\x22\x29\x2e\x76\141\154\x28\51\73\40\44\155\157\50\42\43\147\x66\x6f\162\155\x5f" . $qL . "\40\x23\x6d\x6f\137\x6d\x65\x73\163\141\147\x65\42\51\56\145\155\160\x74\x79\x28\x29\54\x24\155\157\50\x22\43\147\x66\x6f\x72\x6d\137" . $qL . "\x20\x23\155\157\x5f\155\x65\163\x73\x61\147\145\x22\51\x2e\x61\160\x70\145\x6e\x64\x28\42" . $Mt . "\42\x29";
        $W8 .= "\x2c\44\155\157\50\42\43\x67\x66\x6f\x72\155\x5f" . $qL . "\40\43\x6d\x6f\137\155\x65\163\x73\141\147\145\42\51\x2e\163\150\157\x77\x28\51\x2c\44\155\x6f\x2e\x61\152\141\x78\x28\x7b\165\162\x6c\x3a\x22" . site_url() . "\x2f\77\x6f\x70\164\151\157\156\75\155\151\x6e\151\x6f\162\x61\156\x67\145\x2d\x67\x66\x2d\143\157\156\164\x61\x63\x74\42\x2c\x74\x79\x70\x65\72\x22\120\x4f\123\124\x22\54\144\x61\x74\x61\x3a\173\x75\163\x65\x72\x5f";
        $W8 .= $mq . "\72\x65\x7d\x2c\143\x72\x6f\163\163\x44\157\155\141\x69\x6e\72\41\x30\x2c\144\141\164\x61\124\x79\x70\145\x3a\42\x6a\x73\157\156\42\x2c\163\165\143\x63\x65\x73\x73\x3a\x66\165\x6e\143\164\151\x6f\x6e\x28\157\x29\173\40\x69\146\50\x6f\x2e\x72\x65\x73\x75\154\164\75\x3d\x3d\x22\x73\165\143\143\x65\x73\163\x22\51\173\x24\155\x6f\x28\x22\x23\147\x66\x6f\x72\155\137" . $qL . "\40\x23\x6d\x6f\137\155\x65\x73\x73\141\x67\145\x22\51\x2e\145\155\160\164\x79\50\x29";
        $W8 .= "\x2c\44\x6d\x6f\x28\42\43\x67\x66\x6f\162\155\x5f" . $qL . "\x20\43\155\x6f\x5f\x6d\x65\163\x73\141\147\x65\x22\x29\56\x61\160\160\145\x6e\144\x28\157\56\155\145\x73\163\141\x67\145\51\x2c\44\x6d\x6f\50\x22\x23\147\x66\x6f\x72\x6d\137" . $qL . "\x20\x23\155\x6f\137\155\145\x73\x73\x61\147\x65\x22\51\x2e\143\x73\163\50\x22\x62\157\x72\144\x65\x72\x2d\164\157\x70\42\x2c\42\x33\160\x78\40\x73\157\154\151\x64\40\x67\x72\x65\x65\x6e\42\51\x2c\x24\x6d\x6f\50\42";
        $W8 .= "\43\147\x66\157\x72\x6d\137" . $qL . "\x20\x69\x6e\x70\x75\x74\133\156\x61\x6d\x65\x3d\x65\x6d\x61\151\154\x5f\166\x65\162\x69\146\x79\135\42\51\56\x66\157\143\x75\x73\50\x29\175\x65\x6c\163\145\173\x24\155\x6f\x28\x22\x23\x67\146\x6f\162\155\x5f" . $qL . "\40\x23\155\x6f\137\155\145\163\x73\x61\147\145\x22\51\56\x65\x6d\x70\164\171\50\51\54\44\155\x6f\x28\42\43\147\x66\157\162\x6d\x5f" . $qL . "\40\43\x6d\157\x5f\155\x65\x73\x73\141\x67\145\42\51\56\x61\160\160\x65\156\x64\50\x6f\56\155\x65\163\x73\x61\x67\x65\x29\54";
        $W8 .= "\44\155\157\50\x22\43\x67\x66\x6f\x72\155\x5f" . $qL . "\40\x23\x6d\157\137\x6d\145\x73\x73\x61\147\145\x22\x29\x2e\x63\163\163\50\x22\142\157\x72\x64\x65\162\x2d\164\157\x70\x22\x2c\x22\x33\160\170\x20\163\157\x6c\151\x64\40\x72\145\144\42\51\x2c\x24\x6d\x6f\50\42\43\x67\146\x6f\x72\155\x5f" . $qL . "\x20\x69\156\160\165\x74\x5b\156\x61\x6d\145\75\160\x68\157\156\x65\x5f\166\145\x72\151\146\171\135\42\51\x2e\x66\x6f\143\x75\163\x28\x29\175\x20\x3b\175\x2c";
        $W8 .= "\x65\x72\162\157\162\x3a\x66\165\x6e\143\164\151\157\156\50\157\x2c\x65\54\x6e\51\x7b\x7d\x7d\x29\x7d\51\x3b\x7d\x29\73\74\57\163\143\x72\x69\160\164\76";
        return $W8;
    }
    function validate_form_submit($WC, $sA, $form, $uG)
    {
        $zm = MoUtility::sanitizeCheck($uG->formId, $this->_formDetails);
        if (!($zm && $WC["\151\x73\137\x76\x61\154\x69\144"] == 1)) {
            goto Iq;
        }
        if (strpos($uG->label, $zm["\166\x65\162\x69\x66\x79\113\x65\x79"]) !== false && SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto vZ;
        }
        if (!$this->isEmailOrPhoneField($uG, $zm)) {
            goto qu;
        }
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto GB;
        }
        $WC = array("\x69\x73\137\166\x61\x6c\x69\x64" => null, "\155\x65\163\163\141\147\145" => MoMessages::showMessage(MoMessages::PLEASE_VALIDATE));
        goto xy;
        GB:
        $WC = $this->validate_submitted_email_or_phone($WC["\x69\163\x5f\x76\141\154\151\144"], $sA, $WC);
        xy:
        qu:
        goto K7;
        vZ:
        $WC = $this->validate_otp($WC, $sA);
        K7:
        Iq:
        return $WC;
    }
    function validate_otp($WC, $sA)
    {
        $m5 = $this->getVerificationType();
        if (MoUtility::isBlank($sA)) {
            goto rG;
        }
        $this->validateChallenge($m5, NULL, $sA);
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $m5)) {
            goto vD;
        }
        $this->unsetOTPSessionVariables();
        goto xf;
        vD:
        $WC = array("\x69\x73\137\x76\x61\x6c\151\x64" => null, "\x6d\x65\163\163\x61\147\x65" => MoUtility::_get_invalid_otp_method());
        xf:
        goto ZP;
        rG:
        $WC = array("\151\x73\x5f\166\x61\154\151\x64" => null, "\x6d\x65\163\x73\x61\x67\145" => MoUtility::_get_invalid_otp_method());
        ZP:
        return $WC;
    }
    function validate_submitted_email_or_phone($CL, $sA, $WC)
    {
        $m5 = $this->getVerificationType();
        if (!$CL) {
            goto hJ;
        }
        if ($m5 === VerificationType::EMAIL && !SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $sA)) {
            goto yN;
        }
        if (!($m5 === VerificationType::PHONE && !SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $sA))) {
            goto yS;
        }
        return array("\151\163\x5f\166\141\154\151\x64" => null, "\155\145\x73\x73\x61\x67\145" => MoMessages::showMessage(MoMessages::PHONE_MISMATCH));
        yS:
        goto bT;
        yN:
        return array("\x69\163\137\166\x61\154\x69\x64" => null, "\155\145\163\x73\141\x67\x65" => MoMessages::showMessage(MoMessages::EMAIL_MISMATCH));
        bT:
        hJ:
        return $WC;
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
        if (!($this->isFormEnabled() && $this->_otpType === $this->_typePhoneTag)) {
            goto zD;
        }
        foreach ($this->_formDetails as $xl => $gm) {
            $V2 = sprintf("\45\x73\137\x25\144\137\45\x64", "\151\156\x70\x75\x74", $xl, $gm["\160\150\157\x6e\x65\153\145\x79"]);
            array_push($lP, sprintf("\45\x73\x20\x23\x25\x73", $this->_phoneFormId, $V2));
            Ha:
        }
        jR:
        zD:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto xA;
        }
        return;
        xA:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x67\146\x5f\x63\x6f\x6e\x74\x61\143\x74\137\145\x6e\141\x62\154\x65");
        $this->_otpType = $this->sanitizeFormPOST("\x67\x66\x5f\x63\157\x6e\x74\141\143\164\137\x74\x79\x70\145");
        $this->_buttonText = $this->sanitizeFormPOST("\x67\x66\x5f\142\165\x74\164\x6f\156\x5f\164\145\x78\x74");
        $BH = $this->parseFormDetails();
        $this->_formDetails = is_array($BH) ? $BH : '';
        update_mo_option("\x67\146\x5f\157\x74\x70\x5f\145\156\141\142\154\145\x64", maybe_serialize($this->_formDetails));
        update_mo_option("\147\146\137\143\x6f\x6e\x74\141\143\164\137\x65\156\141\142\154\x65", $this->_isFormEnabled);
        update_mo_option("\x67\146\x5f\x63\157\x6e\164\x61\x63\x74\x5f\x74\171\160\x65", $this->_otpType);
        update_mo_option("\147\146\x5f\142\x75\164\164\157\x6e\x5f\x74\x65\170\164", $this->_buttonText);
    }
    private function parseFormDetails()
    {
        $BH = array();
        $fv = function ($lz, $ku, $WP) {
            foreach ($lz as $uG) {
                if (!(get_class($uG) === $WP && $uG["\x6c\141\x62\x65\154"] == $ku)) {
                    goto bi;
                }
                return $uG["\x69\144"];
                bi:
                fN:
            }
            ZU:
            return null;
        };
        $form = NULL;
        if (!(!array_key_exists("\147\162\141\166\151\164\x79\x5f\x66\157\162\x6d", $_POST) || !$this->_isFormEnabled)) {
            goto Cj;
        }
        return array();
        Cj:
        foreach (array_filter($_POST["\x67\162\141\166\x69\164\x79\137\x66\157\162\155"]["\146\157\162\155"]) as $xl => $sA) {
            $nk = GFAPI::get_form($sA);
            $IP = $_POST["\x67\162\x61\166\151\x74\171\137\x66\157\162\x6d"]["\x65\x6d\x61\151\154\x6b\145\x79"][$xl];
            $nt = $_POST["\x67\162\141\166\x69\164\x79\x5f\x66\157\162\155"]["\160\x68\157\x6e\145\x6b\145\x79"][$xl];
            $BH[$sA] = array("\x65\x6d\141\151\154\x6b\145\171" => $fv($nk["\x66\x69\145\154\x64\163"], $IP, "\x47\106\x5f\106\151\145\x6c\x64\x5f\105\x6d\x61\151\x6c"), "\x70\150\x6f\x6e\145\x6b\145\x79" => $fv($nk["\146\x69\145\x6c\144\163"], $nt, "\107\106\137\106\151\145\154\x64\x5f\x50\x68\157\156\x65"), "\166\145\162\x69\146\x79\x4b\145\x79" => $_POST["\x67\162\141\166\151\164\171\137\x66\x6f\x72\155"]["\x76\x65\x72\151\146\171\x4b\145\x79"][$xl], "\160\150\x6f\x6e\145\137\163\x68\x6f\x77" => $_POST["\147\x72\141\166\151\x74\171\x5f\x66\x6f\162\x6d"]["\160\150\157\156\x65\x6b\x65\171"][$xl], "\x65\155\x61\x69\154\137\163\150\157\x77" => $_POST["\x67\x72\x61\166\151\x74\x79\x5f\x66\157\x72\x6d"]["\x65\155\x61\151\154\153\145\x79"][$xl], "\166\145\162\x69\x66\x79\x5f\x73\x68\x6f\167" => $_POST["\x67\162\141\x76\x69\164\x79\137\x66\x6f\x72\155"]["\166\x65\x72\151\146\x79\x4b\x65\171"][$xl]);
            ka:
        }
        YP:
        return $BH;
    }
    private function isEmailOrPhoneField($uG, $xw)
    {
        return $this->_otpType === $this->_typePhoneTag && $uG->id === $xw["\x70\150\157\156\x65\153\x65\171"] || $this->_otpType === $this->_typeEmailTag && $uG->id === $xw["\145\x6d\x61\x69\x6c\153\x65\x79"];
    }
}
