<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoPHPSessions;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Traits\Instance;
use ReflectionException;
class ClassifyRegistrationForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::CLASSIFY_REGISTER;
        $this->_typePhoneTag = "\143\154\141\163\x73\x69\146\171\137\x70\150\157\x6e\x65\137\145\156\x61\x62\154\145";
        $this->_typeEmailTag = "\x63\154\x61\163\163\151\146\171\137\145\155\141\x69\154\x5f\145\x6e\141\142\x6c\x65";
        $this->_formKey = "\x43\114\x41\123\123\111\x46\131\137\x52\x45\107\x49\123\x54\105\122";
        $this->_formName = mo_("\x43\154\141\163\x73\151\146\x79\40\x54\150\x65\x6d\x65\40\x52\x65\147\x69\x73\164\x72\x61\164\151\157\156\x20\106\x6f\x72\x6d");
        $this->_isFormEnabled = get_mo_option("\x63\154\141\x73\x73\151\x66\x79\137\x65\x6e\141\142\x6c\145");
        $this->_phoneFormId = "\151\x6e\x70\165\x74\x5b\x6e\x61\x6d\x65\x3d\x70\150\x6f\156\x65\135";
        $this->_formDocuments = MoOTPDocs::CLASSIFY_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x63\x6c\x61\x73\163\x69\146\171\137\164\x79\160\145");
        add_action("\x77\160\x5f\x65\156\161\165\145\x75\145\137\x73\143\x72\151\160\164\x73", array($this, "\137\163\x68\x6f\167\x5f\160\x68\157\x6e\145\137\146\151\145\154\x64\x5f\x6f\156\137\160\141\x67\x65"));
        add_action("\165\163\145\162\137\162\x65\147\x69\163\164\145\x72", array($this, "\x73\141\166\145\x5f\x70\x68\x6f\x6e\x65\137\x6e\165\155\142\x65\x72"), 10, 1);
        $this->routeData();
    }
    function routeData()
    {
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $this->getVerificationType())) {
            goto ip;
        }
        if (!(MoUtility::sanitizeCheck("\x6f\x70\x74\x69\x6f\156", $_POST) === "\x76\x65\162\x69\x66\x79\x5f\x75\163\x65\162\x5f\143\x6c\x61\163\x73\151\x66\171")) {
            goto ji;
        }
        $this->_handle_classify_theme_form_post($_POST);
        ji:
        goto dz;
        ip:
        $this->unsetOTPSessionVariables();
        dz:
    }
    function _show_phone_field_on_page()
    {
        wp_enqueue_script("\x63\154\x61\x73\163\x69\146\171\x73\143\x72\151\160\164", MOV_URL . "\151\156\x63\x6c\165\144\x65\x73\x2f\x6a\x73\57\x63\x6c\141\x73\163\151\x66\x79\x2e\x6d\151\156\56\x6a\x73\77\x76\x65\x72\163\x69\157\x6e\x3d" . MOV_VERSION, array("\x6a\x71\x75\145\x72\x79"));
    }
    function _handle_classify_theme_form_post($Jf)
    {
        $Iv = $Jf["\165\163\145\x72\x6e\x61\155\x65"];
        $qp = $Jf["\145\155\141\151\x6c"];
        $lr = $Jf["\x70\150\157\x6e\x65"];
        if (!(username_exists($Iv) != FALSE)) {
            goto lC;
        }
        return;
        lC:
        if (!(email_exists($qp) != FALSE)) {
            goto UO;
        }
        return;
        UO:
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) === 0) {
            goto pw;
        }
        if (strcasecmp($this->_otpType, $this->_typeEmailTag) === 0) {
            goto R0;
        }
        $this->sendChallenge($_POST["\165\163\x65\x72\x6e\141\x6d\145"], $qp, null, $lr, "\142\157\164\150", null, null);
        goto Ys;
        R0:
        $this->sendChallenge($_POST["\x75\163\145\x72\x6e\141\x6d\145"], $qp, null, null, "\x65\x6d\x61\x69\x6c", null, null);
        Ys:
        goto RX;
        pw:
        $this->sendChallenge($_POST["\165\163\x65\x72\x6e\141\x6d\145"], $qp, null, $lr, "\x70\x68\157\x6e\x65", null, null);
        RX:
    }
    function save_phone_number($d2)
    {
        $mF = MoPHPSessions::getSessionVar("\160\150\x6f\x6e\x65\x5f\x6e\165\155\x62\145\162\137\x6d\x6f");
        if (!$mF) {
            goto d1;
        }
        update_user_meta($d2, "\160\150\157\x6e\x65", $mF);
        d1:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto mA;
        }
        return;
        mA:
        $Jw = strcasecmp($this->_otpType, $this->_typePhoneTag) === 0 ? "\160\150\157\x6e\145" : (strcasecmp($this->_otpType, $this->_typeEmailTag) === 0 ? "\x65\155\x61\151\x6c" : "\142\157\164\x68");
        $aG = strcasecmp($Jw, "\142\157\x74\x68") === 0 ? TRUE : FALSE;
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $Jw, $aG);
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_formSessionVar, $this->_txSessionId));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->_otpType === $this->_typePhoneTag)) {
            goto qg;
        }
        array_push($lP, $this->_phoneFormId);
        qg:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto OP;
        }
        return;
        OP:
        $this->_otpType = $this->sanitizeFormPOST("\143\154\x61\x73\x73\151\x66\171\137\x74\x79\x70\x65");
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x63\x6c\141\x73\x73\x69\x66\171\x5f\x65\156\141\x62\154\x65");
        update_mo_option("\x63\154\141\x73\163\151\146\171\x5f\x65\x6e\x61\x62\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\143\154\141\163\x73\151\x66\x79\x5f\164\171\x70\x65", $this->_otpType);
    }
}
