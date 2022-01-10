<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
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
class MultiSiteFormRegistration extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::MULTISITE;
        $this->_phoneFormId = "\x69\156\x70\x75\x74\x5b\156\141\x6d\145\x3d\155\165\x6c\164\151\163\x69\x74\145\137\165\x73\x65\162\137\x70\x68\x6f\x6e\145\137\x6d\x69\x6e\x69\x6f\x72\141\x6e\147\145\135";
        $this->_typePhoneTag = "\155\157\137\155\x75\154\x74\151\x73\x69\164\x65\x5f\x63\x6f\156\x74\x61\x63\164\137\160\150\157\156\x65\x5f\145\x6e\141\x62\154\x65";
        $this->_typeEmailTag = "\155\157\137\155\x75\x6c\x74\x69\x73\151\164\145\137\143\x6f\156\164\x61\143\x74\x5f\145\155\x61\x69\154\x5f\145\x6e\x61\142\154\x65";
        $this->_formKey = "\127\x50\137\123\111\x47\116\x55\x50\137\106\x4f\x52\115";
        $this->_formName = mo_("\x57\x6f\162\x64\x50\x72\x65\x73\163\x20\115\x75\x6c\x74\151\163\x69\164\145\x20\123\x69\147\x6e\x55\160\x20\106\157\162\x6d");
        $this->_isFormEnabled = get_mo_option("\155\165\x6c\164\x69\x73\151\x74\145\x5f\x65\156\x61\142\x6c\x65");
        $this->_phoneKey = "\x74\x65\154\x65\x70\x68\x6f\156\145";
        $this->_formDocuments = MoOTPDocs::MULTISITE_REG_FORM;
        parent::__construct();
    }
    public function handleForm()
    {
        add_action("\x77\160\137\145\x6e\161\x75\145\165\x65\137\163\143\162\x69\x70\164\x73", array($this, "\141\144\x64\120\150\x6f\x6e\x65\106\151\x65\154\144\123\143\162\151\x70\164"));
        add_action("\165\x73\145\162\x5f\162\145\x67\x69\163\164\145\162", array($this, "\x5f\x73\x61\166\145\x50\x68\x6f\x6e\145\116\165\x6d\142\x65\x72"), 10, 1);
        $this->_otpType = get_mo_option("\155\165\x6c\x74\151\x73\151\x74\x65\137\157\164\160\x5f\x74\x79\160\x65");
        if (array_key_exists("\157\160\x74\x69\157\x6e", $_POST)) {
            goto wH;
        }
        return;
        wH:
        switch (trim($_POST["\x6f\160\x74\x69\x6f\x6e"])) {
            case "\x6d\165\x6c\164\151\163\151\x74\x65\x5f\x72\x65\x67\151\x73\x74\145\162":
                $this->_sanitizeAndRouteData($_POST);
                goto ty;
            case "\155\x69\156\x69\x6f\162\x61\x6e\147\x65\55\x76\141\x6c\x69\x64\141\x74\x65\x2d\x6f\164\x70\x2d\146\x6f\162\155":
                $this->_startValidation();
                goto ty;
        }
        tx:
        ty:
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
        $this->unsetOTPSessionVariables();
    }
    public function _savePhoneNumber($d2)
    {
        $mF = MoPHPSessions::getSessionVar("\x70\x68\157\x6e\x65\137\156\165\x6d\142\145\162\x5f\x6d\x6f");
        if (!$mF) {
            goto K_;
        }
        update_user_meta($d2, $this->_phoneKey, $mF);
        K_:
    }
    public function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto wG;
        }
        return;
        wG:
        $Jw = $this->getVerificationType();
        $aG = $Jw === VerificationType::BOTH ? TRUE : FALSE;
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $Jw, $aG);
    }
    function _sanitizeAndRouteData($rY)
    {
        $ll = wpmu_validate_user_signup($_POST["\x75\163\145\x72\x5f\x6e\141\x6d\145"], $_POST["\165\x73\x65\162\137\x65\x6d\x61\x69\154"]);
        $errors = $ll["\145\x72\x72\x6f\x72\x73"];
        if (!$errors->get_error_code()) {
            goto sM;
        }
        return false;
        sM:
        Moutility::initialize_transaction($this->_formSessionVar);
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto nz;
        }
        if (!(strcasecmp($this->_otpType, $this->_typeEmailTag) == 0)) {
            goto JE;
        }
        $this->_processEmail($rY);
        JE:
        goto zV;
        nz:
        $this->_processPhone($rY);
        zV:
        return false;
    }
    private function _startValidation()
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto OB;
        }
        return;
        OB:
        $Jw = $this->getVerificationType();
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $Jw)) {
            goto TU;
        }
        return;
        TU:
        $this->validateChallenge($Jw);
    }
    public function addPhoneFieldScript()
    {
        wp_enqueue_script("\x6d\x75\x6c\x74\151\163\x69\164\x65\x73\143\162\x69\x70\x74", MOV_URL . "\x69\156\x63\154\x75\144\x65\x73\57\x6a\163\x2f\x6d\x75\154\x74\151\x73\151\x74\x65\56\x6d\x69\x6e\56\x6a\x73\77\x76\x65\162\163\x69\x6f\156\75" . MOV_VERSION, array("\152\x71\165\145\x72\x79"));
    }
    private function _processPhone($rY)
    {
        if (isset($rY["\155\165\154\x74\151\163\151\164\x65\137\165\163\145\162\137\160\150\x6f\x6e\145\137\x6d\x69\x6e\151\x6f\162\141\156\147\145"])) {
            goto A6;
        }
        return;
        A6:
        $this->sendChallenge('', '', null, trim($rY["\155\x75\154\164\151\x73\x69\x74\x65\x5f\165\163\145\x72\137\160\150\157\x6e\145\x5f\x6d\x69\x6e\151\x6f\x72\141\x6e\147\145"]), VerificationType::PHONE);
    }
    private function _processEmail($rY)
    {
        if (isset($rY["\165\x73\x65\162\x5f\145\155\x61\x69\x6c"])) {
            goto Cv;
        }
        return;
        Cv:
        $this->sendChallenge('', $rY["\x75\163\145\x72\x5f\145\x6d\141\151\x6c"], null, null, VerificationType::EMAIL, '');
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!self::isFormEnabled()) {
            goto mz;
        }
        array_push($lP, $this->_phoneFormId);
        mz:
        return $lP;
    }
    public function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto jc;
        }
        return;
        jc:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\155\165\x6c\164\151\x73\x69\x74\x65\x5f\x65\x6e\141\x62\154\145");
        $this->_otpType = $this->sanitizeFormPOST("\x6d\x75\x6c\x74\x69\163\x69\164\145\x5f\143\157\156\x74\x61\x63\164\137\164\x79\160\x65");
        update_mo_option("\155\x75\x6c\x74\x69\x73\151\164\x65\x5f\145\156\x61\x62\154\x65", $this->_isFormEnabled);
        update_mo_option("\155\x75\154\x74\151\163\151\x74\145\x5f\x6f\x74\160\x5f\x74\171\160\x65", $this->_otpType);
    }
}
