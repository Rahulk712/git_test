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
class FormMaker extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::FORM_MAKER;
        $this->_typePhoneTag = "\x6d\157\137\x66\x6f\x72\x6d\137\x6d\x61\153\x65\x72\x5f\x70\x68\157\156\145\137\x65\x6e\141\142\154\145";
        $this->_typeEmailTag = "\x6d\x6f\137\146\x6f\x72\155\137\155\x61\x6b\145\162\x5f\x65\155\141\x69\x6c\x5f\145\156\x61\142\154\145";
        $this->_formName = mo_("\106\157\x72\155\x20\115\141\153\145\162\x20\106\157\x72\155");
        $this->_formKey = "\106\x4f\122\x4d\x5f\x4d\101\x4b\105\x52";
        $this->_isFormEnabled = get_mo_option("\x66\157\162\155\x6d\x61\x6b\x65\162\137\145\x6e\x61\x62\154\145");
        $this->_otpType = get_mo_option("\146\x6f\162\155\155\141\153\145\162\x5f\x65\156\x61\x62\154\x65\137\164\171\160\x65");
        $this->_formDetails = maybe_unserialize(get_mo_option("\x66\x6f\162\155\x6d\x61\153\145\x72\x5f\x6f\x74\x70\137\145\156\141\x62\x6c\x65\x64"));
        $this->_buttonText = get_mo_option("\x66\157\162\x6d\155\x61\153\145\162\137\x62\x75\x74\x74\157\x6e\137\164\x65\x78\x74");
        $this->_buttonText = !MoUtility::isBlank($this->_buttonText) ? $this->_buttonText : mo_("\103\x6c\151\x63\x6b\x20\x48\145\x72\x65\40\x74\x6f\40\x73\145\x6e\x64\x20\x4f\x54\120");
        $this->_formDocuments = MoOTPDocs::FORMMAKER;
        parent::__construct();
        if (!$this->_isFormEnabled) {
            goto l6;
        }
        add_action("\x77\160\x5f\145\x6e\x71\165\x65\x75\145\137\163\143\x72\151\160\x74\163", array($this, "\x72\x65\x67\151\x73\164\145\162\x5f\146\x6d\x5f\x62\x75\x74\x74\x6f\x6e\x5f\x73\x63\x72\151\160\x74"));
        l6:
    }
    function handleForm()
    {
        $this->routeData();
    }
    function routeData()
    {
        if (array_key_exists("\x6f\x70\x74\x69\x6f\x6e", $_GET)) {
            goto bx;
        }
        return;
        bx:
        switch (trim($_GET["\157\160\x74\151\x6f\156"])) {
            case "\155\151\156\151\157\162\x61\x6e\x67\145\x2d\146\x6d\x2d\x61\x6a\x61\170\55\x76\x65\x72\151\146\171":
                $this->_send_otp_fm_ajax_verify($_POST);
                goto HP;
            case "\155\x69\x6e\151\157\x72\141\x6e\x67\145\55\146\x6d\x2d\x76\x65\162\x69\146\171\55\143\157\144\145":
                $this->_validate_otp($_POST);
                goto HP;
        }
        mD:
        HP:
    }
    private function _validate_otp($post)
    {
        $this->validateChallenge($this->getVerificationType(), NULL, $post["\157\x74\160\137\x74\x6f\153\145\x6e"]);
    }
    function _send_otp_fm_ajax_verify($Jf)
    {
        if ($this->_otpType == $this->_typePhoneTag) {
            goto Nd;
        }
        $this->_send_fm_ajax_otp_to_email($Jf);
        goto aL;
        Nd:
        $this->_send_fm_ajax_otp_to_phone($Jf);
        aL:
    }
    function _send_fm_ajax_otp_to_phone($Jf)
    {
        if (!MoUtility::sanitizeCheck("\165\x73\145\x72\137\160\150\x6f\156\x65", $Jf)) {
            goto NR;
        }
        $this->sendOTP(trim($Jf["\165\163\145\162\x5f\x70\150\157\x6e\x65"]), NULL, trim($Jf["\165\163\145\162\137\x70\x68\x6f\x6e\145"]), VerificationType::PHONE);
        goto Fp;
        NR:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_PHONE), MoConstants::ERROR_JSON_TYPE));
        Fp:
    }
    function _send_fm_ajax_otp_to_email($Jf)
    {
        if (!MoUtility::sanitizeCheck("\x75\163\x65\x72\137\x65\x6d\x61\151\x6c", $Jf)) {
            goto Mu;
        }
        $this->sendOTP($Jf["\x75\x73\145\x72\137\x65\155\141\151\154"], $Jf["\165\x73\145\162\137\x65\x6d\x61\x69\x6c"], NULL, VerificationType::EMAIL);
        goto fM;
        Mu:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_EMAIL), MoConstants::ERROR_JSON_TYPE));
        fM:
    }
    private function checkPhoneOrEmailIntegrity($Wx)
    {
        if ($this->getVerificationType() === VerificationType::PHONE) {
            goto D3;
        }
        return SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $Wx);
        goto Nu;
        D3:
        return SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $Wx);
        Nu:
    }
    private function sendOTP($Vf, $I4, $mF, $m5)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if ($m5 === VerificationType::PHONE) {
            goto Sn;
        }
        SessionUtils::addEmailVerified($this->_formSessionVar, $Vf);
        goto WU;
        Sn:
        SessionUtils::addPhoneVerified($this->_formSessionVar, $Vf);
        WU:
        $this->sendChallenge('', $I4, NULL, $mF, $m5);
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto eY;
        }
        return;
        eY:
        wp_send_json(MoUtility::createJson(MoUtility::_get_invalid_otp_method(), MoConstants::ERROR_JSON_TYPE));
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        if ($this->checkPhoneOrEmailIntegrity($_POST["\x73\165\x62\137\x66\x69\145\x6c\144"])) {
            goto VZ;
        }
        if ($this->_otpType == $this->_typePhoneTag) {
            goto H3;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::EMAIL_MISMATCH), MoConstants::ERROR_JSON_TYPE));
        goto JS;
        H3:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::PHONE_MISMATCH), MoConstants::ERROR_JSON_TYPE));
        JS:
        goto Fe;
        VZ:
        $this->unsetOTPSessionVariables();
        wp_send_json(MoUtility::createJson(self::VALIDATED, MoConstants::SUCCESS_JSON_TYPE));
        Fe:
    }
    function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->getVerificationType() === VerificationType::PHONE)) {
            goto uf;
        }
        array_push($lP, $this->_phoneFormId);
        uf:
        return $lP;
    }
    function register_fm_button_script()
    {
        wp_register_script("\146\155\x6f\164\x70\x62\x75\x74\164\157\156\x73\143\x72\x69\x70\164", MOV_URL . "\151\x6e\143\x6c\165\144\145\x73\x2f\152\x73\x2f\x66\x6f\x72\x6d\x6d\x61\153\x65\162\56\x6d\151\x6e\x2e\x6a\163", array("\x6a\x71\165\x65\x72\171"));
        wp_localize_script("\146\x6d\157\164\x70\142\165\x74\x74\157\156\163\x63\x72\151\x70\164", "\x6d\x6f\146\155\166\x61\x72", array("\x73\x69\164\145\x55\122\114" => site_url(), "\157\164\160\x54\171\160\x65" => $this->_otpType, "\x66\157\x72\155\104\145\164\141\x69\x6c\x73" => $this->_formDetails, "\x62\165\x74\164\x6f\x6e\164\x65\170\x74" => mo_($this->_buttonText), "\x69\155\x67\x55\122\x4c" => MOV_URL . "\x69\156\143\154\x75\x64\x65\x73\x2f\151\x6d\x61\147\145\x73\57\x6c\157\x61\144\145\x72\56\147\151\x66"));
        wp_enqueue_script("\146\x6d\x6f\164\160\x62\x75\164\x74\157\x6e\x73\x63\x72\x69\160\x74");
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto LV;
        }
        return;
        LV:
        $form = $this->parseFormDetails();
        $this->_formDetails = !empty($form) ? $form : '';
        $this->_otpType = $this->sanitizeFormPOST("\146\155\x5f\x65\x6e\141\142\x6c\x65\137\x74\x79\160\x65");
        $this->_isFormEnabled = $this->sanitizeFormPOST("\146\x6d\x5f\x65\156\x61\142\x6c\x65");
        $this->_buttonText = $this->sanitizeFormPOST("\146\x6d\137\x62\165\x74\x74\157\x6e\137\164\145\170\x74");
        if (!$this->basicValidationCheck(BaseMessages::FORMMAKER_CHOOSE)) {
            goto CG;
        }
        update_mo_option("\x66\157\x72\155\155\141\153\x65\162\137\x65\156\141\x62\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\146\x6f\162\x6d\x6d\x61\153\x65\x72\x5f\145\x6e\x61\142\x6c\x65\x5f\x74\171\x70\x65", $this->_otpType);
        update_mo_option("\x66\x6f\162\x6d\x6d\141\x6b\x65\x72\x5f\x6f\164\x70\137\145\156\x61\142\154\x65\x64", maybe_serialize($this->_formDetails));
        update_mo_option("\x66\157\x72\x6d\x6d\x61\153\x65\x72\137\142\x75\x74\x74\157\x6e\x5f\164\145\170\164", $this->_buttonText);
        CG:
    }
    private function parseFormDetails()
    {
        $form = array();
        if (array_key_exists("\x66\157\x72\155\155\x61\x6b\x65\162\x5f\x66\x6f\x72\x6d", $_POST)) {
            goto Ii;
        }
        return array();
        Ii:
        foreach (array_filter($_POST["\146\x6f\x72\155\x6d\141\153\x65\162\x5f\x66\157\162\155"]["\x66\x6f\162\155"]) as $xl => $sA) {
            $form[$sA] = array("\145\x6d\141\151\x6c\x6b\145\x79" => $this->_get_efield_id($_POST["\146\x6f\x72\x6d\155\x61\x6b\x65\x72\x5f\146\x6f\162\x6d"]["\x65\x6d\141\x69\x6c\153\x65\171"][$xl], $sA), "\x70\150\x6f\156\145\153\145\x79" => $this->_get_efield_id($_POST["\x66\x6f\162\x6d\x6d\x61\x6b\145\162\137\x66\157\x72\x6d"]["\x70\x68\157\156\145\153\x65\x79"][$xl], $sA), "\x76\x65\162\x69\146\171\x4b\x65\x79" => $this->_get_efield_id($_POST["\x66\x6f\162\x6d\155\x61\x6b\x65\162\x5f\146\x6f\x72\x6d"]["\166\x65\x72\x69\146\171\x4b\x65\171"][$xl], $sA), "\160\x68\157\156\145\x5f\x73\150\x6f\167" => $_POST["\146\x6f\x72\x6d\x6d\x61\153\145\162\x5f\146\157\x72\155"]["\x70\x68\x6f\156\145\x6b\145\171"][$xl], "\x65\x6d\141\151\x6c\137\163\150\x6f\x77" => $_POST["\146\x6f\162\155\155\141\153\x65\x72\137\146\157\x72\155"]["\145\x6d\141\x69\x6c\153\x65\x79"][$xl], "\166\x65\x72\151\x66\171\137\x73\150\157\x77" => $_POST["\x66\157\x72\155\x6d\141\x6b\145\162\x5f\x66\157\162\x6d"]["\166\x65\162\x69\146\x79\113\145\x79"][$xl]);
            M6:
        }
        TQ:
        return $form;
    }
    private function _get_efield_id($cz, $form)
    {
        global $wpdb;
        $I1 = $wpdb->get_row("\123\105\114\x45\x43\124\40\52\40\x46\x52\117\115\40{$wpdb->prefix}\x66\x6f\x72\155\x6d\x61\x6b\145\x72\40\x77\x68\x65\162\145\40\140\x69\144\140\x20\x3d" . $form);
        if (!MoUtility::isBlank($I1)) {
            goto uJ;
        }
        return '';
        uJ:
        $TH = explode("\x2a\72\52\x6e\145\x77\x5f\146\x69\x65\x6c\x64\52\72\x2a", $I1->form_fields);
        $SL = $Tf = $ZA = array();
        foreach ($TH as $uG) {
            $qY = explode("\52\72\x2a\x69\x64\x2a\x3a\x2a", $uG);
            if (MoUtility::isBlank($qY)) {
                goto kz;
            }
            array_push($SL, $qY[0]);
            if (!array_key_exists(1, $qY)) {
                goto tv;
            }
            $qY = explode("\52\x3a\52\164\x79\x70\145\52\72\52", $qY[1]);
            array_push($Tf, $qY[0]);
            $qY = explode("\x2a\x3a\52\x77\137\x66\x69\x65\154\144\137\x6c\x61\x62\145\x6c\52\72\x2a", $qY[1]);
            tv:
            array_push($ZA, $qY[0]);
            kz:
            di:
        }
        G0:
        $xl = array_search($cz, $ZA);
        return "\43\x77\144\x66\x6f\x72\155\137" . $SL[$xl] . "\137\x65\x6c\145\155\145\x6e\164" . $form;
    }
}
