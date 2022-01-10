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
class ProfileBuilderRegistrationForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::PB_DEFAULT_REG;
        $this->_typePhoneTag = "\155\157\x5f\x70\142\x5f\x70\150\157\x6e\145\137\145\156\141\142\x6c\x65";
        $this->_typeEmailTag = "\x6d\157\x5f\x70\x62\x5f\145\x6d\x61\151\154\137\145\x6e\141\x62\x6c\x65";
        $this->_typeBothTag = "\155\157\x5f\x70\x62\x5f\x62\157\164\x68\137\x65\156\x61\142\154\145";
        $this->_formKey = "\x50\102\x5f\104\x45\106\x41\x55\x4c\124\137\106\117\122\x4d";
        $this->_formName = mo_("\120\162\157\x66\x69\154\145\40\x42\165\151\x6c\144\145\x72\x20\122\x65\x67\151\163\x74\162\141\164\151\157\156\40\x46\157\162\x6d");
        $this->_isFormEnabled = get_mo_option("\x70\x62\x5f\144\145\146\x61\165\x6c\x74\137\145\x6e\x61\142\154\x65");
        $this->_formDocuments = MoOTPDocs::PB_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x70\142\137\145\x6e\x61\142\x6c\x65\137\x74\171\x70\145");
        $this->_phoneKey = get_mo_option("\x70\142\x5f\160\150\157\156\x65\137\155\x65\x74\x61\137\153\x65\x79");
        $this->_phoneFormId = "\151\x6e\x70\165\164\133\x6e\141\x6d\145\x3d" . $this->_phoneKey . "\135";
        add_filter("\x77\x70\160\142\x5f\157\x75\x74\160\x75\x74\137\x66\x69\145\154\x64\x5f\145\x72\162\157\162\x73\137\x66\151\x6c\x74\x65\162", array($this, "\146\157\162\x6d\142\165\x69\x6c\x64\x65\162\x5f\163\x69\164\145\x5f\x72\145\x67\151\163\164\162\x61\x74\151\157\x6e\137\x65\x72\x72\157\162\x73"), 99, 4);
    }
    function isPhoneVerificationEnabled()
    {
        $Jw = $this->getVerificationType();
        return $Jw === VerificationType::PHONE || $Jw === VerificationType::BOTH;
    }
    function formbuilder_site_registration_errors($Dt, $dU, $wK, $s5)
    {
        if (empty($Dt)) {
            goto gp;
        }
        return $Dt;
        gp:
        if (!($wK["\141\143\x74\151\157\156"] == "\x72\x65\x67\151\163\164\145\162")) {
            goto vb;
        }
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $this->getVerificationType())) {
            goto LA;
        }
        $this->unsetOTPSessionVariables();
        return $Dt;
        LA:
        return $this->startOTPVerificationProcess($Dt, $wK);
        vb:
        return $Dt;
    }
    function startOTPVerificationProcess($Dt, $Jf)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        $mx = $this->extractArgs($Jf, $this->_phoneKey);
        $this->sendChallenge($mx["\165\163\145\162\156\141\x6d\145"], $mx["\x65\x6d\141\x69\154"], new WP_Error(), $mx["\x70\x68\x6f\156\145"], $this->getVerificationType(), $mx["\x70\x61\163\x73\x77\61"], array());
    }
    private function extractArgs($mx, $nt)
    {
        return array("\165\x73\x65\x72\x6e\x61\155\x65" => $mx["\x75\x73\x65\162\x6e\141\x6d\145"], "\x65\x6d\x61\151\154" => $mx["\x65\155\141\x69\154"], "\x70\141\163\163\x77\x31" => $mx["\x70\x61\163\163\167\61"], "\x70\150\157\156\x65" => MoUtility::sanitizeCheck($nt, $mx));
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $this->getVerificationType(), FALSE);
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
            goto n6;
        }
        array_push($lP, $this->_phoneFormId);
        n6:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto yV;
        }
        return;
        yV:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\160\142\x5f\x64\x65\146\x61\165\x6c\x74\137\145\156\141\x62\154\x65");
        $this->_otpType = $this->sanitizeFormPOST("\160\x62\137\x65\156\141\x62\x6c\145\137\x74\171\x70\145");
        $this->_phoneKey = $this->sanitizeFormPOST("\x70\x62\137\x70\x68\x6f\x6e\x65\x5f\146\151\145\154\x64\x5f\153\145\x79");
        update_mo_option("\160\x62\137\x64\x65\x66\141\165\154\164\137\x65\x6e\x61\142\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\x70\142\x5f\145\x6e\x61\142\154\145\x5f\164\171\x70\x65", $this->_otpType);
        update_mo_option("\160\x62\x5f\160\150\x6f\x6e\145\x5f\155\145\164\x61\x5f\x6b\x65\x79", $this->_phoneKey);
    }
}
