<?php


namespace OTP\Handler\Forms;

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
class DocDirectThemeRegistration extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::DOCDIRECT_REG;
        $this->_typePhoneTag = "\x6d\x6f\137\144\x6f\143\144\x69\x72\x65\143\x74\x5f\x70\x68\x6f\x6e\145\137\x65\x6e\141\x62\x6c\145";
        $this->_typeEmailTag = "\155\x6f\x5f\144\x6f\143\x64\151\162\x65\143\164\x5f\x65\x6d\141\x69\x6c\x5f\145\x6e\141\142\x6c\145";
        $this->_formKey = "\104\117\x43\x44\x49\122\105\103\x54\137\x54\110\x45\x4d\x45";
        $this->_formName = mo_("\104\157\x63\40\x44\151\x72\x65\x63\x74\40\x54\x68\145\x6d\145\x20\142\171\x20\x54\150\145\155\x6f\107\x72\x61\x70\150\x69\143\163");
        $this->_isFormEnabled = get_mo_option("\x64\x6f\143\x64\151\162\x65\x63\x74\x5f\x65\156\141\142\154\x65");
        $this->_phoneFormId = "\x69\x6e\160\x75\164\133\156\x61\155\x65\x3d\x70\150\x6f\156\145\137\x6e\165\155\142\145\162\135";
        $this->_formDocuments = MoOTPDocs::DOCDIRECT_THEME;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\144\x6f\x63\144\151\x72\x65\143\164\x5f\145\156\x61\142\154\x65\137\x74\x79\x70\145");
        add_action("\x77\x70\x5f\x65\x6e\161\165\145\165\145\x5f\163\143\x72\x69\160\x74\163", array($this, "\141\144\x64\123\143\162\x69\x70\x74\x54\x6f\122\145\147\x69\x73\164\x72\x61\x74\x69\157\x6e\x50\x61\147\145"));
        add_action("\x77\160\x5f\141\x6a\x61\170\137\x64\157\x63\144\x69\162\145\143\164\137\x75\163\x65\x72\x5f\162\145\x67\x69\163\164\162\x61\x74\x69\157\x6e", array($this, "\x6d\x6f\x5f\x76\x61\154\x69\x64\141\164\x65\x5f\x64\x6f\x63\x64\x69\162\145\143\x74\137\165\x73\x65\162\x5f\162\x65\x67\151\163\164\x72\141\x74\x69\x6f\x6e"), 1);
        add_action("\x77\160\x5f\x61\x6a\141\x78\x5f\156\157\x70\x72\x69\166\137\x64\x6f\143\x64\x69\162\x65\143\164\x5f\x75\x73\x65\x72\x5f\162\145\147\151\x73\164\162\141\164\x69\157\156", array($this, "\x6d\x6f\x5f\x76\141\154\151\144\x61\164\x65\x5f\144\x6f\143\x64\151\162\x65\143\x74\137\165\163\145\x72\137\162\x65\x67\151\x73\164\x72\141\x74\151\x6f\156"), 1);
        $this->routeData();
    }
    function routeData()
    {
        if (array_key_exists("\x6f\x70\164\151\x6f\x6e", $_GET)) {
            goto h8;
        }
        return;
        h8:
        switch (trim($_GET["\x6f\160\x74\x69\x6f\x6e"])) {
            case "\x6d\x69\156\x69\x6f\162\x61\156\x67\x65\x2d\144\157\143\144\x69\x72\145\143\x74\55\166\x65\162\151\146\171":
                $this->startOTPVerificationProcess($_POST);
                goto qx;
        }
        It:
        qx:
    }
    function addScriptToRegistrationPage()
    {
        wp_register_script("\144\157\143\144\151\x72\x65\x63\164", MOV_URL . "\151\156\143\x6c\x75\x64\145\x73\57\152\x73\x2f\144\157\x63\144\151\x72\x65\143\164\x2e\155\151\x6e\x2e\x6a\x73\x3f\x76\145\162\163\151\157\156\x3d" . MOV_VERSION, array("\x6a\x71\165\x65\162\x79"), MOV_VERSION, true);
        wp_localize_script("\144\157\x63\x64\151\x72\145\143\164", "\x6d\x6f\x64\157\143\144\151\162\145\x63\x74", array("\151\155\x67\125\122\114" => MOV_URL . "\x69\x6e\143\x6c\x75\x64\145\163\57\x69\155\141\147\x65\x73\57\154\x6f\141\x64\x65\x72\x2e\147\151\x66", "\142\165\x74\164\157\156\124\x65\170\x74" => mo_("\x43\x6c\151\143\x6b\40\110\x65\x72\145\x20\x74\x6f\40\126\145\162\151\146\171\40\x59\x6f\165\x72\163\x65\154\146"), "\x69\156\x73\145\162\164\101\146\x74\x65\x72" => strcasecmp($this->_otpType, $this->_typePhoneTag) === 0 ? "\151\x6e\160\165\x74\x5b\x6e\141\155\x65\75\160\x68\x6f\156\145\137\x6e\x75\x6d\x62\145\x72\135" : "\x69\x6e\x70\165\x74\133\x6e\x61\155\x65\75\145\155\141\151\154\135", "\160\x6c\x61\143\145\110\157\x6c\x64\x65\162" => mo_("\x4f\124\120\x20\103\157\144\x65"), "\x73\151\x74\x65\125\x52\x4c" => site_url()));
        wp_enqueue_script("\144\157\143\144\151\x72\145\x63\164");
    }
    function startOtpVerificationProcess($Jf)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) === 0) {
            goto pJ;
        }
        $this->_send_otp_to_email($Jf);
        goto TT;
        pJ:
        $this->_send_otp_to_phone($Jf);
        TT:
    }
    function _send_otp_to_phone($Jf)
    {
        if (array_key_exists("\165\x73\x65\162\137\160\150\x6f\x6e\145", $Jf) && !MoUtility::isBlank($Jf["\x75\x73\145\x72\137\160\x68\157\156\145"])) {
            goto tj;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_PHONE), MoConstants::ERROR_JSON_TYPE));
        goto Aj;
        tj:
        SessionUtils::addPhoneVerified($this->_formSessionVar, trim($Jf["\165\x73\x65\162\x5f\x70\x68\x6f\x6e\x65"]));
        $this->sendChallenge("\x74\x65\163\x74", '', null, trim($Jf["\165\163\145\x72\137\160\150\x6f\x6e\x65"]), VerificationType::PHONE);
        Aj:
    }
    function _send_otp_to_email($Jf)
    {
        if (array_key_exists("\x75\x73\x65\162\x5f\x65\x6d\x61\151\x6c", $Jf) && !MoUtility::isBlank($Jf["\x75\x73\x65\x72\137\145\x6d\x61\x69\154"])) {
            goto yA;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_EMAIL), MoConstants::ERROR_JSON_TYPE));
        goto h_;
        yA:
        SessionUtils::addEmailVerified($this->_formSessionVar, $Jf["\x75\163\145\x72\137\145\155\141\151\154"]);
        $this->sendChallenge("\x74\145\x73\x74", $Jf["\x75\x73\x65\162\x5f\x65\x6d\141\x69\x6c"], null, $Jf["\x75\163\145\x72\x5f\x65\x6d\141\151\154"], VerificationType::EMAIL);
        h_:
    }
    function mo_validate_docdirect_user_registration()
    {
        $this->checkIfVerificationNotStarted();
        $this->checkIfVerificationCodeNotEntered();
        $this->handle_otp_token_submitted();
    }
    function checkIfVerificationNotStarted()
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto DW;
        }
        echo json_encode(array("\164\x79\x70\145" => "\145\162\162\157\162", "\x6d\145\163\163\x61\x67\145" => MoMessages::showMessage(MoMessages::DOC_DIRECT_VERIFY)));
        die;
        DW:
    }
    function checkIfVerificationCodeNotEntered()
    {
        if (!(!array_key_exists("\155\x6f\137\166\145\x72\x69\146\171", $_POST) || MoUtility::isBlank($_POST["\x6d\x6f\x5f\166\145\162\x69\x66\x79"]))) {
            goto xi;
        }
        echo json_encode(array("\164\x79\x70\145" => "\145\x72\x72\157\162", "\x6d\145\163\163\141\147\145" => MoMessages::showMessage(MoMessages::DCD_ENTER_VERIFY_CODE)));
        die;
        xi:
    }
    function handle_otp_token_submitted()
    {
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) === 0) {
            goto FL;
        }
        $this->processEmail();
        goto kb;
        FL:
        $this->processPhoneNumber();
        kb:
        $this->validateChallenge($this->getVerificationType(), "\155\157\137\x76\145\x72\x69\x66\x79", NULL);
    }
    function processPhoneNumber()
    {
        if (SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $_POST["\160\150\x6f\x6e\145\x5f\156\x75\x6d\x62\x65\x72"])) {
            goto oI;
        }
        echo json_encode(array("\164\x79\x70\x65" => "\x65\x72\x72\x6f\162", "\155\x65\163\163\141\x67\145" => MoMessages::showMessage(MoMessages::PHONE_MISMATCH)));
        die;
        oI:
    }
    function processEmail()
    {
        if (SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $_POST["\145\x6d\141\x69\x6c"])) {
            goto BJ;
        }
        echo json_encode(array("\164\171\x70\x65" => "\145\x72\162\157\162", "\x6d\145\163\x73\141\x67\145" => MoMessages::showMessage(MoMessages::EMAIL_MISMATCH)));
        die;
        BJ:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto wq;
        }
        return;
        wq:
        echo json_encode(array("\164\x79\x70\x65" => "\145\x72\x72\x6f\x72", "\155\145\163\163\141\x67\x65" => MoUtility::_get_invalid_otp_method()));
        die;
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
        if (!($this->isFormEnabled() && $this->_otpType === $this->_typePhoneTag)) {
            goto E6;
        }
        array_push($lP, $this->_phoneFormId);
        E6:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto uN;
        }
        return;
        uN:
        $this->_otpType = $this->sanitizeFormPOST("\x64\157\x63\x64\151\x72\145\143\164\x5f\x65\x6e\x61\x62\x6c\145\137\164\x79\160\145");
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x64\157\x63\x64\x69\x72\x65\x63\164\137\x65\x6e\141\x62\154\145");
        update_mo_option("\x64\x6f\143\x64\x69\x72\x65\x63\x74\x5f\145\156\x61\x62\154\145", $this->_isFormEnabled);
        update_mo_option("\x64\157\143\x64\x69\162\x65\x63\x74\x5f\x65\156\x61\x62\154\x65\x5f\164\171\x70\145", $this->_otpType);
    }
}
