<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationLogic;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
class PaidMembershipForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::PMPRO_REGISTRATION;
        $this->_formKey = "\120\x4d\x5f\120\x52\x4f\137\x46\117\122\x4d";
        $this->_formName = mo_("\120\141\151\144\40\115\145\155\x62\145\162\123\150\x69\x70\40\120\x72\157\40\x52\145\147\x69\163\164\x72\141\164\151\157\x6e\40\x46\x6f\x72\x6d");
        $this->_phoneFormId = "\x69\x6e\160\165\x74\x5b\156\141\155\x65\75\x70\150\157\156\145\137\160\x61\x69\144\x6d\145\155\x62\145\x72\x73\x68\151\x70\x5d";
        $this->_typePhoneTag = "\x70\x6d\160\x72\x6f\x5f\160\150\157\156\x65\x5f\x65\x6e\141\x62\154\x65";
        $this->_typeEmailTag = "\160\155\x70\x72\157\x5f\x65\155\141\x69\154\137\x65\x6e\141\142\154\145";
        $this->_isFormEnabled = get_mo_option("\x70\x6d\160\x72\157\x5f\145\156\141\x62\x6c\145");
        $this->_formDocuments = MoOTPDocs::PAID_MEMBERSHIP_PRO;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x70\x6d\160\x72\157\x5f\157\164\160\x5f\164\171\160\145");
        add_action("\x77\160\x5f\145\156\x71\x75\x65\x75\145\x5f\x73\x63\x72\151\x70\164\163", array($this, "\137\x73\x68\157\x77\x5f\x70\x68\x6f\x6e\145\137\x66\x69\145\154\144\x5f\157\x6e\137\160\x61\147\145"));
        add_filter("\x70\x6d\160\162\157\137\x63\150\x65\x63\153\157\165\x74\x5f\142\x65\146\x6f\162\x65\137\x70\x72\157\x63\145\x73\x73\x69\x6e\x67", array($this, "\137\160\141\x69\x64\115\x65\x6d\x62\145\x72\163\150\x69\160\x50\162\x6f\x52\x65\x67\151\x73\x74\162\x61\164\x69\157\156\103\150\x65\143\x6b"), 1, 1);
        add_filter("\x70\155\160\162\157\137\x63\x68\x65\x63\x6b\157\x75\x74\137\x63\157\x6e\146\151\x72\155\x65\x64", array($this, "\x69\x73\x56\x61\x6c\x69\x64\141\x74\145\144"), 99, 2);
    }
    public function isValidated($Qy, $bq)
    {
        global $la;
        return $la == "\x70\x6d\160\162\157\x5f\x65\162\162\157\162" ? false : $Qy;
    }
    public function _paidMembershipProRegistrationCheck()
    {
        global $la;
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $this->getVerificationType())) {
            goto zS;
        }
        $this->unsetOTPSessionVariables();
        return;
        zS:
        $this->validatePhone($_POST);
        if (!($la != "\x70\155\x70\162\x6f\x5f\145\162\162\x6f\162")) {
            goto cn;
        }
        MoUtility::initialize_transaction($this->_formSessionVar);
        $this->startOTPVerificationProcess($_POST);
        cn:
    }
    private function startOTPVerificationProcess($Jf)
    {
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto AH;
        }
        if (strcasecmp($this->_otpType, $this->_typeEmailTag) == 0) {
            goto Na;
        }
        goto D2;
        AH:
        $this->sendChallenge('', '', null, trim($Jf["\160\150\x6f\156\145\137\160\x61\x69\x64\155\x65\x6d\x62\x65\162\163\150\151\160"]), "\160\x68\x6f\x6e\x65");
        goto D2;
        Na:
        $this->sendChallenge('', $Jf["\142\145\x6d\141\151\154"], null, $Jf["\x62\x65\x6d\x61\x69\154"], "\145\x6d\x61\x69\x6c");
        D2:
    }
    public function validatePhone($Jf)
    {
        if (!($this->getVerificationType() != VerificationType::PHONE)) {
            goto gm;
        }
        return;
        gm:
        global $c1, $la, $phoneLogic, $yn;
        if (!($la == "\160\x6d\160\x72\x6f\137\x65\x72\162\x6f\x72")) {
            goto jZ;
        }
        return;
        jZ:
        $LG = $Jf["\x70\150\x6f\156\x65\x5f\x70\x61\151\144\155\145\155\x62\145\162\x73\150\151\x70"];
        if (MoUtility::validatePhoneNumber($LG)) {
            goto hs;
        }
        $bJ = str_replace("\x23\x23\x70\x68\x6f\156\x65\43\x23", $LG, $phoneLogic->_get_otp_invalid_format_message());
        $la = "\x70\155\x70\x72\x6f\137\145\x72\x72\x6f\x72";
        $yn = false;
        $c1 = apply_filters("\x70\155\160\162\157\x5f\163\145\164\137\x6d\145\163\163\141\x67\145", $bJ, $la);
        hs:
    }
    function _show_phone_field_on_page()
    {
        if (!(strcasecmp($this->_otpType, $this->_typePhoneTag) == 0)) {
            goto We;
        }
        wp_enqueue_script("\x70\x61\151\144\x6d\x65\155\142\145\x72\163\150\x69\x70\163\143\162\151\x70\x74", MOV_URL . "\x69\x6e\x63\x6c\x75\144\x65\163\x2f\152\163\x2f\160\141\x69\144\155\145\x6d\142\x65\x72\x73\x68\x69\160\x70\x72\157\x2e\x6d\151\x6e\56\152\163\x3f\166\145\162\x73\151\x6f\156\75" . MOV_VERSION, array("\152\161\165\145\x72\171"));
        We:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        $Jw = $this->getVerificationType();
        $aG = $Jw === VerificationType::BOTH ? TRUE : FALSE;
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $Jw, $aG);
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
        if (!(self::isFormEnabled() && $this->_otpType == $this->_typePhoneTag)) {
            goto vW;
        }
        array_push($lP, $this->_phoneFormId);
        vW:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto An;
        }
        return;
        An:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\160\155\x70\162\x6f\x5f\145\x6e\141\142\154\x65");
        $this->_otpType = $this->sanitizeFormPOST("\x70\155\x70\x72\x6f\137\143\157\156\164\141\x63\x74\137\164\x79\x70\x65");
        update_mo_option("\160\155\160\162\157\x5f\x65\156\141\142\x6c\145", $this->_isFormEnabled);
        update_mo_option("\x70\155\x70\162\157\x5f\157\164\x70\x5f\164\x79\160\x65", $this->_otpType);
    }
}
