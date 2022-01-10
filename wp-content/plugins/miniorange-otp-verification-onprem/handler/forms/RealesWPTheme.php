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
class RealesWPTheme extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::REALESWP_REGISTER;
        $this->_typePhoneTag = "\x6d\x6f\x5f\x72\145\x61\x6c\145\x73\137\x70\150\157\156\145\x5f\x65\x6e\141\142\154\x65";
        $this->_typeEmailTag = "\155\x6f\x5f\x72\145\x61\154\x65\163\x5f\145\x6d\x61\151\x6c\137\145\156\x61\142\x6c\145";
        $this->_phoneFormId = "\x23\x70\x68\x6f\156\x65\x53\151\147\156\x75\160";
        $this->_formKey = "\x52\105\101\x4c\105\123\137\x52\105\x47\111\x53\x54\x45\x52";
        $this->_formName = mo_("\122\x65\141\154\x65\x73\40\127\120\40\124\x68\x65\155\145\40\122\x65\147\x69\163\x74\x72\141\164\x69\x6f\x6e\x20\106\x6f\x72\x6d");
        $this->_isFormEnabled = get_mo_option("\162\145\x61\x6c\145\x73\x5f\x65\x6e\x61\x62\154\x65");
        $this->_formDocuments = MoOTPDocs::REALES_THEME;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x72\x65\x61\x6c\x65\163\137\145\x6e\x61\x62\x6c\145\137\164\x79\x70\x65");
        add_action("\167\x70\137\145\x6e\161\165\x65\x75\145\137\163\143\162\x69\160\164\x73", array($this, "\145\x6e\161\x75\145\165\145\x5f\x73\x63\x72\151\160\164\x5f\157\156\x5f\160\141\147\145"));
        $this->routeData();
    }
    function routeData()
    {
        if (array_key_exists("\157\160\x74\151\x6f\156", $_GET)) {
            goto Fy;
        }
        return;
        Fy:
        switch (trim($_GET["\157\160\164\151\157\156"])) {
            case "\x6d\151\156\151\157\162\141\x6e\x67\x65\x2d\x72\145\x61\x6c\145\163\167\160\55\166\145\162\x69\x66\x79":
                $this->_send_otp_realeswp_verify($_POST);
                goto C7;
            case "\155\151\x6e\x69\x6f\162\x61\156\x67\x65\55\x76\x61\154\x69\144\141\164\x65\55\x72\x65\x61\154\145\x73\167\x70\x2d\x6f\164\160":
                $this->_reales_validate_otp($_POST);
                goto C7;
        }
        kt:
        C7:
    }
    function enqueue_script_on_page()
    {
        wp_register_script("\162\x65\141\154\x65\x73\167\x70\x53\143\x72\x69\160\164", MOV_URL . "\151\156\x63\154\x75\144\145\x73\57\x6a\163\57\x72\145\x61\x6c\145\x73\167\x70\56\155\x69\x6e\56\x6a\163\x3f\166\145\x72\163\x69\157\156\75" . MOV_VERSION, array("\x6a\161\165\145\x72\171"));
        wp_localize_script("\x72\x65\x61\x6c\145\x73\167\x70\123\143\x72\151\160\x74", "\155\157\x76\141\x72\x73", array("\151\155\x67\x55\122\114" => MOV_URL . "\x69\156\143\x6c\165\x64\145\163\57\151\x6d\141\147\145\x73\57\x6c\157\x61\144\145\x72\x2e\147\151\x66", "\x66\151\145\154\x64\x6e\x61\155\145" => $this->_otpType == $this->_typePhoneTag ? "\x70\x68\x6f\x6e\x65\40\x6e\165\155\x62\145\x72" : "\x65\155\x61\x69\x6c", "\146\x69\x65\154\x64" => $this->_otpType == $this->_typePhoneTag ? "\x70\150\x6f\x6e\x65\x53\x69\147\x6e\165\160" : "\145\155\141\151\x6c\x53\x69\x67\156\165\x70", "\163\151\x74\x65\x55\122\x4c" => site_url(), "\x69\x6e\x73\145\x72\x74\101\x66\164\145\x72" => $this->_otpType == $this->_typePhoneTag ? "\x23\160\150\x6f\156\145\x53\x69\147\x6e\165\x70" : "\43\145\155\141\151\154\123\x69\147\156\x75\160", "\160\154\141\143\145\110\157\154\x64\145\162" => mo_("\x4f\124\x50\40\x43\157\x64\145"), "\142\x75\164\164\157\x6e\124\145\170\164" => mo_("\x56\x61\x6c\151\144\141\x74\145\x20\x61\x6e\x64\x20\123\x69\x67\x6e\40\125\x70"), "\141\152\141\170\165\x72\154" => wp_ajax_url()));
        wp_enqueue_script("\162\x65\x61\154\145\x73\167\x70\123\143\x72\151\x70\164");
    }
    function _send_otp_realeswp_verify($Jf)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto PP;
        }
        $this->_send_otp_to_email($Jf);
        goto qW;
        PP:
        $this->_send_otp_to_phone($Jf);
        qW:
    }
    function _send_otp_to_phone($Jf)
    {
        if (array_key_exists("\x75\x73\145\162\137\160\x68\157\156\145", $Jf) && !MoUtility::isBlank($Jf["\165\x73\x65\162\x5f\x70\x68\x6f\156\x65"])) {
            goto pF;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_PHONE), MoConstants::ERROR_JSON_TYPE));
        goto tC;
        pF:
        SessionUtils::addPhoneVerified($this->_formSessionVar, trim($Jf["\165\163\x65\162\137\x70\150\157\156\145"]));
        $this->sendChallenge("\x74\145\x73\x74", '', null, trim($Jf["\165\163\145\x72\137\160\150\x6f\x6e\145"]), VerificationType::PHONE);
        tC:
    }
    function _send_otp_to_email($Jf)
    {
        if (array_key_exists("\x75\163\145\162\137\x65\155\x61\151\154", $Jf) && !MoUtility::isBlank($Jf["\x75\163\145\x72\137\x65\x6d\x61\151\154"])) {
            goto VC;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_EMAIL), MoConstants::ERROR_JSON_TYPE));
        goto G3;
        VC:
        SessionUtils::addEmailVerified($this->_formSessionVar, $Jf["\165\x73\x65\x72\x5f\145\x6d\x61\151\154"]);
        $this->sendChallenge("\164\145\163\164", $Jf["\x75\163\145\162\137\145\x6d\x61\151\x6c"], null, $Jf["\165\163\145\162\137\x65\155\141\151\154"], VerificationType::EMAIL);
        G3:
    }
    function _reales_validate_otp($Jf)
    {
        $nT = !isset($Jf["\157\x74\160"]) ? sanitize_text_field($Jf["\157\164\x70"]) : '';
        $this->checkIfOTPVerificationHasStarted();
        $this->validateSubmittedFields($Jf);
        $this->validateChallenge(NULL, $nT);
    }
    function validateSubmittedFields($Jf)
    {
        $Jw = $this->getVerificationType();
        if ($Jw === VerificationType::EMAIL && !SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $Jf["\165\163\145\162\137\x65\155\x61\151\154"])) {
            goto dX;
        }
        if ($Jw === VerificationType::PHONE && !SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $Jf["\x75\163\x65\x72\x5f\x70\150\x6f\x6e\145"])) {
            goto k2;
        }
        goto vS;
        dX:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::EMAIL_MISMATCH), MoConstants::ERROR_JSON_TYPE));
        die;
        goto vS;
        k2:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::PHONE_MISMATCH), MoConstants::ERROR_JSON_TYPE));
        die;
        vS:
    }
    function checkIfOTPVerificationHasStarted()
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto HX;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::PLEASE_VALIDATE), MoConstants::ERROR_JSON_TYPE));
        die;
        HX:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        wp_send_json(MoUtility::createJson(MoUtility::_get_invalid_otp_method(), MoConstants::ERROR_JSON_TYPE));
        die;
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        $this->unsetOTPSessionVariables();
        wp_send_json(MoUtility::createJson(MoMessages::REG_SUCCESS, MoConstants::SUCCESS_JSON_TYPE));
        die;
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->_otpType == $this->_typePhoneTag)) {
            goto Mz;
        }
        array_push($lP, $this->_phoneFormId);
        Mz:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto iq;
        }
        return;
        iq:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x72\x65\x61\x6c\145\163\137\x65\x6e\141\x62\x6c\145");
        $this->_otpType = $this->sanitizeFormPOST("\x72\x65\x61\154\x65\163\x5f\x65\x6e\141\x62\154\145\137\164\171\160\x65");
        update_mo_option("\x72\145\141\154\x65\163\x5f\x65\156\x61\x62\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\162\145\x61\154\x65\x73\x5f\145\156\141\142\x6c\x65\x5f\164\x79\x70\x65", $this->_otpType);
    }
}
