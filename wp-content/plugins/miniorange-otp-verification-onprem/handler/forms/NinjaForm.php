<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
use WP_Error;
class NinjaForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::NINJA_FORM;
        $this->_typePhoneTag = "\155\157\137\x6e\x69\x6e\152\x61\x5f\x66\157\162\x6d\137\160\150\x6f\156\145\137\145\x6e\141\x62\154\x65";
        $this->_typeEmailTag = "\x6d\x6f\x5f\x6e\x69\156\x6a\x61\x5f\146\x6f\162\x6d\x5f\x65\x6d\141\151\154\137\145\156\x61\x62\x6c\x65";
        $this->_typeBothTag = "\x6d\x6f\x5f\156\x69\x6e\152\x61\137\146\157\162\x6d\x5f\142\x6f\164\150\x5f\145\x6e\141\x62\x6c\x65";
        $this->_formKey = "\x4e\x49\x4e\112\x41\x5f\106\117\122\x4d";
        $this->_formName = mo_("\116\151\156\x6a\141\40\x46\x6f\162\x6d\x73\x20\50\40\x42\145\154\x6f\167\40\166\x65\x72\163\x69\157\156\40\x33\56\60\40\x29");
        $this->_isFormEnabled = get_mo_option("\x6e\151\156\x6a\x61\x5f\x66\157\162\x6d\137\145\x6e\x61\x62\x6c\x65");
        $this->_formDocuments = MoOTPDocs::NINJA_FORMS_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x6e\151\x6e\x6a\x61\137\x66\x6f\x72\x6d\x5f\145\156\x61\142\x6c\145\137\164\171\x70\145");
        $this->_formDetails = maybe_unserialize(get_mo_option("\156\151\156\x6a\141\x5f\146\157\162\155\x5f\157\x74\160\x5f\145\156\x61\x62\x6c\x65\144"));
        if (!empty($this->_formDetails)) {
            goto UP;
        }
        return;
        UP:
        foreach ($this->_formDetails as $xl => $sA) {
            array_push($this->_phoneFormId, "\x69\156\160\x75\x74\133\x6e\141\x6d\x65\x3d\x6e\151\156\x6a\141\x5f\x66\157\162\x6d\x73\137\146\151\145\x6c\144\137" . $sA["\160\x68\x6f\x6e\x65\153\145\x79"] . "\135");
            x8:
        }
        he:
        if (!$this->checkIfOTPOptions()) {
            goto x4;
        }
        return;
        x4:
        if (!$this->checkIfNinjaFormSubmitted()) {
            goto jt;
        }
        $this->_handle_ninja_form_submit($_REQUEST);
        jt:
    }
    function checkIfOTPOptions()
    {
        return array_key_exists("\x6f\160\x74\x69\157\x6e", $_POST) && (strpos($_POST["\x6f\x70\164\151\157\156"], "\x76\x65\162\151\x66\x69\143\141\164\x69\157\x6e\x5f\162\145\163\145\156\x64\x5f\x6f\x74\160") || $_POST["\157\x70\164\151\157\x6e"] == "\155\151\x6e\151\x6f\x72\x61\x6e\147\x65\x2d\166\x61\x6c\x69\144\141\164\x65\55\x6f\164\x70\x2d\146\x6f\x72\x6d" || $_POST["\157\160\164\x69\157\156"] == "\155\x69\x6e\x69\157\x72\x61\156\x67\x65\55\x76\141\154\151\144\x61\x74\x65\x2d\157\x74\160\55\x63\x68\157\151\143\x65\x2d\x66\157\x72\x6d");
    }
    function checkIfNinjaFormSubmitted()
    {
        return array_key_exists("\x5f\156\151\156\x6a\141\x5f\x66\x6f\x72\x6d\163\x5f\144\151\163\160\154\141\x79\137\163\165\x62\155\151\164", $_REQUEST) && array_key_exists("\x5f\x66\x6f\x72\155\x5f\x69\x64", $_REQUEST);
    }
    function isPhoneVerificationEnabled()
    {
        $m5 = $this->getVerificationType();
        return $m5 === VerificationType::PHONE || $m5 === VerificationType::BOTH;
    }
    function isEmailVerificationEnabled()
    {
        $m5 = $this->getVerificationType();
        return $m5 === VerificationType::EMAIL || $m5 === VerificationType::BOTH;
    }
    function _handle_ninja_form_submit($tE)
    {
        if (array_key_exists($tE["\x5f\146\x6f\162\155\x5f\x69\144"], $this->_formDetails)) {
            goto G6;
        }
        return;
        G6:
        $nk = $this->_formDetails[$tE["\137\x66\x6f\162\155\137\x69\x64"]];
        $xX = $this->processEmail($nk, $tE);
        $lr = $this->processPhone($nk, $tE);
        $this->miniorange_ninja_form_user($xX, null, $lr);
    }
    function processPhone($nk, $tE)
    {
        if (!$this->isPhoneVerificationEnabled()) {
            goto YX;
        }
        $uG = "\x6e\151\156\x6a\x61\x5f\x66\157\x72\x6d\163\137\x66\151\x65\154\x64\137" . $nk["\x70\150\x6f\156\145\x6b\145\171"];
        return array_key_exists($uG, $tE) ? $tE[$uG] : NULL;
        YX:
        return null;
    }
    function processEmail($nk, $tE)
    {
        if (!$this->isEmailVerificationEnabled()) {
            goto nC;
        }
        $uG = "\156\x69\156\152\141\137\x66\x6f\x72\x6d\x73\137\x66\151\145\x6c\144\x5f" . $nk["\145\155\141\x69\154\x6b\x65\171"];
        return array_key_exists($uG, $tE) ? $tE[$uG] : NULL;
        nC:
        return null;
    }
    function miniorange_ninja_form_user($Kc, $s4, $t2)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        $errors = new WP_Error();
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto ig;
        }
        if (strcasecmp($this->_otpType, $this->_typeBothTag) == 0) {
            goto YS;
        }
        $this->sendChallenge($s4, $Kc, $errors, $t2, VerificationType::EMAIL);
        goto cq;
        YS:
        $this->sendChallenge($s4, $Kc, $errors, $t2, VerificationType::BOTH);
        cq:
        goto S7;
        ig:
        $this->sendChallenge($s4, $Kc, $errors, $t2, VerificationType::PHONE);
        S7:
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
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->isPhoneVerificationEnabled())) {
            goto vd;
        }
        $lP = array_merge($lP, $this->_phoneFormId);
        vd:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto Yv;
        }
        return;
        Yv:
        if (!isset($_POST["\155\157\x5f\x63\x75\163\164\x6f\155\x65\x72\137\x76\141\154\151\x64\141\164\x69\157\156\137\156\152\141\x5f\x65\x6e\141\x62\x6c\145"])) {
            goto Zb;
        }
        return;
        Zb:
        $form = $this->parseFormDetails();
        $this->_isFormEnabled = $this->sanitizeFormPOST("\156\x69\x6e\152\x61\x5f\x66\x6f\162\x6d\x5f\145\156\x61\x62\x6c\x65");
        $this->_otpType = $this->sanitizeFormPOST("\156\151\x6e\x6a\x61\137\146\157\162\155\x5f\145\x6e\x61\142\154\x65\137\164\x79\160\x65");
        $this->_formDetails = !empty($form) ? $form : '';
        update_mo_option("\156\x69\x6e\x6a\x61\137\146\x6f\162\x6d\x5f\x65\156\x61\x62\154\145", $this->_isFormEnabled);
        update_mo_option("\156\152\x61\137\x65\x6e\141\142\154\145", 0);
        update_mo_option("\156\151\156\152\x61\137\x66\157\162\155\137\145\156\x61\x62\154\145\x5f\164\171\x70\145", $this->_otpType);
        update_mo_option("\156\x69\156\152\x61\137\x66\157\162\155\137\x6f\x74\160\x5f\145\156\x61\x62\x6c\x65\x64", maybe_serialize($this->_formDetails));
    }
    function parseFormDetails()
    {
        $form = array();
        if (array_key_exists("\156\x69\156\152\x61\x5f\x66\x6f\x72\x6d", $_POST)) {
            goto g6;
        }
        return array();
        g6:
        foreach (array_filter($_POST["\156\151\156\x6a\141\137\146\157\162\155"]["\x66\157\x72\155"]) as $xl => $sA) {
            $form[$sA] = array("\145\155\141\x69\154\x6b\145\x79" => $_POST["\x6e\151\x6e\x6a\x61\x5f\146\x6f\x72\155"]["\145\155\141\151\154\153\x65\x79"][$xl], "\160\x68\x6f\156\145\x6b\x65\171" => $_POST["\156\151\x6e\x6a\141\137\146\157\162\155"]["\x70\150\x6f\156\x65\153\145\171"][$xl]);
            KB:
        }
        h1:
        return $form;
    }
}
