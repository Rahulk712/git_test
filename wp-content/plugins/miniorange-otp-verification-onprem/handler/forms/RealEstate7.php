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
class RealEstate7 extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::REALESTATE_7;
        $this->_phoneFormId = "\x69\156\160\x75\x74\x5b\156\x61\155\x65\x3d\x63\x74\x5f\165\163\145\162\137\x70\150\x6f\156\145\x5f\155\151\x6e\151\157\x72\141\156\x67\145\135";
        $this->_formKey = "\x52\x45\x41\114\137\105\123\124\x41\124\x45\137\x37";
        $this->_typePhoneTag = "\x6d\x6f\137\x72\145\x61\154\x65\163\x74\141\164\x65\137\143\x6f\156\164\141\143\164\137\x70\150\157\156\145\137\x65\156\141\x62\x6c\145";
        $this->_typeEmailTag = "\x6d\x6f\137\162\145\x61\x6c\x65\163\x74\141\x74\x65\x5f\143\157\x6e\164\x61\x63\x74\x5f\x65\x6d\141\x69\x6c\137\x65\x6e\141\142\x6c\145";
        $this->_formName = mo_("\122\x65\141\154\40\x45\163\x74\141\164\x65\x20\x37\40\x50\162\157\x20\124\x68\x65\x6d\145");
        $this->_isFormEnabled = get_mo_option("\162\x65\141\x6c\145\163\164\x61\164\x65\x5f\x65\156\x61\142\x6c\x65");
        $this->_formDocuments = MoOTPDocs::REALESTATE7_THEME_LINK;
        parent::__construct();
    }
    public function handleForm()
    {
        $this->_otpType = get_mo_option("\x72\145\141\x6c\145\163\x74\141\164\145\x5f\157\164\x70\x5f\x74\x79\x70\x65");
        add_action("\167\160\x5f\145\x6e\x71\x75\145\x75\145\137\163\x63\162\151\x70\164\163", array($this, "\x61\144\x64\x50\150\x6f\x6e\x65\x46\151\x65\x6c\144\123\x63\x72\x69\x70\164"));
        add_action("\165\163\145\162\137\x72\x65\147\151\x73\x74\145\162", array($this, "\x6d\151\156\x69\x6f\162\141\156\147\x65\x5f\x72\x65\147\151\x73\164\162\141\164\151\x6f\156\137\x73\x61\x76\x65"), 10, 1);
        if (array_key_exists("\x6f\160\x74\x69\157\x6e", $_POST)) {
            goto MT;
        }
        return;
        MT:
        switch ($_POST["\x6f\160\x74\151\157\156"]) {
            case "\x72\145\x61\x6c\145\163\164\141\x74\x65\x5f\x72\x65\x67\151\x73\x74\145\x72":
                if (!$this->sanitizeData($_POST)) {
                    goto VI;
                }
                $this->routeData($_POST);
                VI:
                goto FF;
            case "\x6d\151\x6e\x69\x6f\162\x61\x6e\x67\x65\x2d\x76\x61\x6c\151\x64\x61\x74\x65\x2d\x6f\x74\x70\x2d\146\157\x72\155":
                $this->_startValidation();
                goto FF;
        }
        lY:
        FF:
    }
    public function unsetOTPSessionVariables()
    {
        Sessionutils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
        $this->unsetOTPSessionVariables();
    }
    public function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        $Jw = $this->getVerificationType();
        $aG = $Jw === VerificationType::BOTH ? TRUE : FALSE;
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $Jw, $aG);
    }
    public function sanitizeData($gt)
    {
        if (!(isset($gt["\x63\x74\x5f\165\163\x65\162\137\x6c\x6f\x67\x69\x6e"]) && wp_verify_nonce($gt["\143\x74\137\x72\x65\x67\151\x73\164\x65\162\x5f\156\157\156\x63\x65"], "\143\x74\55\162\145\147\x69\163\164\145\162\55\156\157\156\x63\x65"))) {
            goto Er;
        }
        $u0 = $gt["\x63\x74\137\165\163\x65\162\137\154\157\x67\x69\x6e"];
        $Kc = $gt["\143\x74\137\165\x73\x65\162\x5f\145\155\x61\151\x6c"];
        $rS = $gt["\x63\x74\137\165\163\x65\x72\137\x66\151\162\x73\164"];
        $KB = $gt["\143\164\x5f\x75\163\145\x72\x5f\x6c\x61\163\164"];
        $P3 = $gt["\143\x74\x5f\165\x73\x65\x72\137\x70\x61\x73\163"];
        $Um = $gt["\143\x74\137\165\x73\145\x72\137\160\x61\x73\x73\x5f\x63\157\156\146\x69\x72\155"];
        if (!(username_exists($u0) || !validate_username($u0) || $u0 == '' || !is_email($Kc) || email_exists($Kc) || $P3 == '' || $P3 != $Um)) {
            goto bF;
        }
        return false;
        bF:
        return true;
        Er:
        return false;
    }
    public function miniorange_registration_save($d2)
    {
        $m5 = $this->getVerificationType();
        $lr = MoPHPSessions::getSessionVar("\160\x68\157\156\145\x5f\156\x75\155\142\145\x72\x5f\x6d\157");
        if (!($m5 === VerificationType::PHONE && $lr)) {
            goto Ts;
        }
        add_user_meta($d2, "\x70\150\x6f\156\x65", $lr);
        Ts:
    }
    private function _startValidation()
    {
        $m5 = $this->getVerificationType();
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto Qo;
        }
        return;
        Qo:
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $m5)) {
            goto FS;
        }
        return;
        FS:
        $this->validateChallenge($m5);
    }
    public function routeData($gt)
    {
        Moutility::initialize_transaction($this->_formSessionVar);
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto Ua;
        }
        if (!(strcasecmp($this->_otpType, $this->_typeEmailTag) == 0)) {
            goto a5;
        }
        $this->_processEmail($gt);
        a5:
        goto oV;
        Ua:
        $this->_processPhone($gt);
        oV:
    }
    private function _processPhone($gt)
    {
        if (!(!array_key_exists("\143\164\137\x75\163\x65\x72\137\x70\x68\157\156\x65\137\x6d\151\156\151\157\x72\141\156\x67\x65", $gt) || !isset($gt["\143\164\x5f\x75\163\145\x72\137\x70\150\157\x6e\x65\x5f\x6d\x69\x6e\x69\157\162\141\156\x67\145"]))) {
            goto TL;
        }
        return;
        TL:
        $this->sendChallenge('', '', null, trim($gt["\x63\x74\137\165\x73\x65\162\x5f\x70\x68\x6f\x6e\x65\137\155\151\156\151\157\x72\141\156\x67\x65"]), VerificationType::PHONE);
    }
    private function _processEmail($gt)
    {
        if (!(!array_key_exists("\x63\164\x5f\165\x73\145\162\137\x65\x6d\x61\151\x6c", $gt) || !isset($gt["\x63\164\x5f\165\163\145\162\x5f\x65\x6d\x61\x69\154"]))) {
            goto MZ;
        }
        return;
        MZ:
        $this->sendChallenge('', $gt["\143\164\x5f\x75\163\x65\x72\x5f\x65\155\x61\151\x6c"], null, null, VerificationType::EMAIL, '');
    }
    public function addPhoneFieldScript()
    {
        wp_enqueue_script("\162\x65\141\154\x45\x73\164\141\164\145\x37\x53\x63\x72\x69\x70\164", MOV_URL . "\x69\156\x63\x6c\165\x64\x65\x73\x2f\x6a\x73\x2f\162\145\x61\154\x45\163\x74\141\164\x65\x37\x2e\x6d\151\156\56\x6a\x73\77\166\145\162\163\x69\x6f\x6e\x3d" . MOV_VERSION, array("\x6a\161\x75\145\162\171"));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!(self::isFormEnabled() && $this->_otpType == $this->_typePhoneTag)) {
            goto Yz;
        }
        array_push($lP, $this->_phoneFormId);
        Yz:
        return $lP;
    }
    public function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto gn;
        }
        return;
        gn:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\162\145\x61\x6c\x65\x73\164\x61\x74\x65\x5f\x65\156\x61\142\x6c\x65");
        $this->_otpType = $this->sanitizeFormPOST("\162\x65\141\x6c\x65\163\x74\141\x74\x65\x5f\143\157\x6e\x74\141\x63\x74\137\x74\171\160\x65");
        update_mo_option("\x72\145\141\154\145\x73\164\x61\164\145\137\x65\x6e\x61\142\154\x65", $this->_isFormEnabled);
        update_mo_option("\x72\x65\141\x6c\x65\163\x74\141\x74\x65\x5f\157\164\x70\x5f\x74\171\x70\145", $this->_otpType);
    }
}
