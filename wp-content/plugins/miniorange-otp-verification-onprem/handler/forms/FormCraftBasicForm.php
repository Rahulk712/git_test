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
class FormCraftBasicForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::FORMCRAFT;
        $this->_typePhoneTag = "\x6d\157\137\146\x6f\162\x6d\143\162\141\146\164\137\x70\x68\x6f\156\x65\x5f\x65\x6e\x61\x62\x6c\145";
        $this->_typeEmailTag = "\x6d\157\x5f\x66\157\x72\x6d\143\162\x61\x66\164\137\x65\155\141\x69\154\x5f\x65\156\x61\x62\154\145";
        $this->_formKey = "\x46\117\x52\115\x43\122\101\106\124\102\101\123\x49\103";
        $this->_formName = mo_("\x46\157\x72\x6d\x43\162\x61\146\164\x20\102\x61\163\151\143\40\50\x46\x72\x65\x65\40\x56\145\162\163\151\x6f\156\x29");
        $this->_isFormEnabled = get_mo_option("\146\157\x72\x6d\143\162\x61\146\164\137\x65\156\141\x62\154\x65");
        $this->_phoneFormId = array();
        $this->_formDocuments = MoOTPDocs::FORMCRAFT_BASIC_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        if ($this->isFormCraftPluginInstalled()) {
            goto zE;
        }
        return;
        zE:
        $this->_otpType = get_mo_option("\146\x6f\x72\155\x63\162\x61\146\164\x5f\145\x6e\x61\142\x6c\145\137\164\171\160\145");
        $this->_formDetails = maybe_unserialize(get_mo_option("\x66\x6f\x72\x6d\x63\162\141\x66\164\137\157\164\160\137\145\156\141\142\154\x65\144"));
        if (!empty($this->_formDetails)) {
            goto lK;
        }
        return;
        lK:
        foreach ($this->_formDetails as $xl => $sA) {
            array_push($this->_phoneFormId, "\x5b\144\x61\x74\141\55\x69\144\75" . $xl . "\x5d\x20\x69\x6e\160\165\x74\133\x6e\x61\x6d\145\x3d" . $sA["\x70\150\x6f\156\145\x6b\x65\x79"] . "\x5d");
            vI:
        }
        DJ:
        add_action("\x77\x70\137\141\x6a\141\x78\x5f\146\x6f\162\x6d\x63\x72\x61\146\164\x5f\142\x61\x73\x69\143\137\146\x6f\x72\x6d\x5f\163\x75\x62\x6d\151\x74", array($this, "\x76\x61\154\151\x64\141\164\x65\137\146\x6f\x72\155\x63\x72\141\x66\164\137\146\157\x72\155\137\x73\x75\x62\155\x69\x74"), 1);
        add_action("\167\160\x5f\141\152\141\x78\x5f\x6e\x6f\160\162\151\x76\137\x66\157\162\155\143\x72\141\146\x74\x5f\x62\x61\x73\x69\143\137\146\x6f\x72\x6d\137\x73\x75\142\x6d\151\164", array($this, "\166\x61\154\x69\144\141\164\x65\x5f\146\157\162\x6d\143\162\x61\146\164\137\146\x6f\x72\155\x5f\x73\165\142\155\x69\164"), 1);
        add_action("\167\160\137\x65\x6e\161\165\145\x75\145\137\x73\x63\x72\151\160\x74\x73", array($this, "\145\156\161\165\145\165\x65\137\x73\x63\x72\x69\160\x74\137\157\156\137\160\141\x67\145"));
        $this->routeData();
    }
    function routeData()
    {
        if (array_key_exists("\x6f\x70\x74\x69\157\156", $_GET)) {
            goto xu;
        }
        return;
        xu:
        switch (trim($_GET["\x6f\x70\164\x69\157\x6e"])) {
            case "\x6d\x69\x6e\151\x6f\x72\141\156\x67\x65\55\146\x6f\162\155\x63\x72\141\x66\x74\x2d\166\x65\162\151\146\171":
                $this->_handle_formcraft_form($_POST);
                goto Qn;
            case "\x6d\x69\x6e\151\157\162\141\x6e\x67\145\55\x66\x6f\162\x6d\143\x72\141\146\x74\x2d\146\x6f\162\155\x2d\x6f\164\160\x2d\x65\156\141\142\154\x65\x64":
                wp_send_json($this->isVerificationEnabledForThisForm($_POST["\x66\157\x72\x6d\x5f\151\144"]));
                goto Qn;
        }
        H6:
        Qn:
    }
    function _handle_formcraft_form($Jf)
    {
        if ($this->isVerificationEnabledForThisForm($_POST["\x66\157\162\x6d\x5f\x69\144"])) {
            goto hC;
        }
        return;
        hC:
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) === 0) {
            goto pc;
        }
        $this->_send_otp_to_email($Jf);
        goto Dw;
        pc:
        $this->_send_otp_to_phone($Jf);
        Dw:
    }
    function _send_otp_to_phone($Jf)
    {
        if (array_key_exists("\165\163\x65\162\x5f\160\150\157\156\x65", $Jf) && !MoUtility::isBlank($Jf["\x75\163\145\x72\137\x70\x68\x6f\x6e\145"])) {
            goto bd;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_PHONE), MoConstants::ERROR_JSON_TYPE));
        goto ZM;
        bd:
        SessionUtils::addPhoneVerified($this->_formSessionVar, $Jf["\165\163\x65\x72\x5f\x70\150\x6f\156\145"]);
        $this->sendChallenge("\164\145\163\x74", '', null, trim($Jf["\x75\163\x65\162\137\x70\x68\x6f\x6e\x65"]), VerificationType::PHONE);
        ZM:
    }
    function _send_otp_to_email($Jf)
    {
        if (array_key_exists("\165\163\x65\162\x5f\145\x6d\141\x69\x6c", $Jf) && !MoUtility::isBlank($Jf["\x75\163\145\x72\137\145\x6d\x61\151\x6c"])) {
            goto Le;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_EMAIL), MoConstants::ERROR_JSON_TYPE));
        goto ko;
        Le:
        SessionUtils::addEmailVerified($this->_formSessionVar, $Jf["\165\163\145\x72\137\x65\x6d\141\151\x6c"]);
        $this->sendChallenge("\x74\x65\163\x74", $Jf["\165\x73\145\162\x5f\x65\155\141\x69\x6c"], null, $Jf["\x75\163\x65\162\137\145\x6d\141\151\154"], VerificationType::EMAIL);
        ko:
    }
    function validate_formcraft_form_submit()
    {
        $so = $_POST["\x69\144"];
        if ($this->isVerificationEnabledForThisForm($so)) {
            goto GW;
        }
        return;
        GW:
        $this->checkIfVerificationNotStarted($so);
        $nk = $this->_formDetails[$so];
        $m5 = $this->getVerificationType();
        if ($m5 === VerificationType::PHONE && !SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $_POST[$nk["\x70\x68\157\x6e\145\x6b\145\x79"]])) {
            goto JI;
        }
        if ($m5 === VerificationType::EMAIL && !SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $_POST[$nk["\145\155\x61\151\x6c\x6b\x65\x79"]])) {
            goto cQ;
        }
        goto qh;
        JI:
        $this->sendJSONErrorMessage(array("\x65\162\x72\157\162\x73" => array($this->_formDetails[$so]["\160\x68\157\156\x65\153\145\x79"] => MoMessages::showMessage(MoMessages::PHONE_MISMATCH))));
        goto qh;
        cQ:
        $this->sendJSONErrorMessage(array("\x65\x72\162\x6f\162\x73" => array($this->_formDetails[$so]["\145\x6d\x61\x69\154\x6b\145\171"] => MoMessages::showMessage(MoMessages::EMAIL_MISMATCH))));
        qh:
        if (MoUtility::sanitizeCheck($_POST, $nk["\166\145\162\x69\x66\171\x4b\145\x79"])) {
            goto sg;
        }
        $this->sendJSONErrorMessage(array("\145\162\x72\x6f\x72\x73" => array($this->_formDetails[$so]["\x76\145\162\x69\146\171\113\145\x79"] => MoUtility::_get_invalid_otp_method())));
        sg:
        SessionUtils::setFormOrFieldId($this->_formSessionVar, $so);
        $this->validateChallenge($m5, NULL, $_POST[$nk["\166\145\x72\151\x66\171\113\145\x79"]]);
    }
    function enqueue_script_on_page()
    {
        wp_register_script("\x66\157\x72\x6d\x63\162\x61\x66\x74\163\143\162\151\160\164", MOV_URL . "\x69\x6e\143\x6c\x75\x64\145\x73\x2f\152\x73\x2f\x66\x6f\162\155\143\162\141\x66\164\142\141\163\151\x63\56\155\151\156\56\152\163\77\x76\145\162\x73\151\157\x6e\x3d" . MOV_VERSION, array("\152\161\x75\x65\x72\x79"));
        wp_localize_script("\146\157\x72\x6d\x63\x72\141\x66\164\163\143\162\x69\x70\164", "\x6d\157\x66\x63\x76\141\x72\163", array("\151\x6d\x67\x55\122\x4c" => MOV_LOADER_URL, "\146\157\x72\155\x43\162\x61\x66\164\106\x6f\x72\x6d\163" => $this->_formDetails, "\x73\x69\164\x65\125\122\x4c" => site_url(), "\157\x74\160\x54\171\x70\x65" => $this->_otpType, "\x62\x75\164\164\x6f\x6e\124\x65\x78\164" => mo_("\x43\154\x69\143\x6b\40\150\x65\162\145\40\x74\157\40\x73\145\156\144\x20\117\x54\x50"), "\x62\x75\x74\164\157\156\124\151\x74\154\x65" => $this->_otpType === $this->_typePhoneTag ? mo_("\x50\x6c\145\x61\x73\x65\40\x65\156\164\145\x72\x20\x61\x20\x50\150\157\156\x65\40\x4e\165\x6d\142\x65\162\40\164\157\x20\145\x6e\141\142\154\x65\40\x74\150\151\163\x20\x66\151\x65\154\144\56") : mo_("\120\154\145\x61\163\x65\40\145\156\x74\145\x72\40\x61\40\120\150\x6f\x6e\145\x20\116\165\x6d\x62\x65\162\40\164\157\x20\145\x6e\x61\142\x6c\x65\40\x74\x68\x69\x73\40\x66\x69\x65\x6c\144\x2e"), "\x61\x6a\141\170\x75\x72\154" => wp_ajax_url(), "\164\171\x70\x65\x50\x68\x6f\156\145" => $this->_typePhoneTag, "\143\x6f\165\156\164\162\171\x44\162\157\x70" => get_mo_option("\163\150\x6f\167\x5f\x64\162\157\160\144\157\167\x6e\137\x6f\156\137\146\157\x72\x6d")));
        wp_enqueue_script("\x66\157\x72\155\x63\x72\141\146\x74\163\x63\162\x69\x70\164");
    }
    function isVerificationEnabledForThisForm($so)
    {
        return array_key_exists($so, $this->_formDetails);
    }
    function sendJSONErrorMessage($errors)
    {
        $hy["\146\141\151\x6c\145\x64"] = mo_("\120\x6c\145\141\163\145\40\x63\157\162\162\x65\143\x74\x20\164\x68\x65\40\145\162\162\157\x72\163");
        $hy["\x65\162\162\157\162\163"] = $errors;
        echo json_encode($hy);
        die;
    }
    function checkIfVerificationNotStarted($so)
    {
        if (!SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto qM;
        }
        return;
        qM:
        $tc = MoMessages::showMessage(MoMessages::PLEASE_VALIDATE);
        if ($this->_otpType === $this->_typePhoneTag) {
            goto uw;
        }
        $this->sendJSONErrorMessage(array("\145\x72\162\157\162\163" => array($this->_formDetails[$so]["\145\155\141\151\154\153\x65\x79"] => $tc)));
        goto Hs;
        uw:
        $this->sendJSONErrorMessage(array("\145\162\x72\x6f\x72\x73" => array($this->_formDetails[$so]["\160\x68\x6f\x6e\x65\x6b\145\x79"] => $tc)));
        Hs:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto tm;
        }
        return;
        tm:
        $we = SessionUtils::getFormOrFieldId($this->_formSessionVar);
        $this->sendJSONErrorMessage(array("\x65\162\162\157\x72\163" => array($this->_formDetails[$we]["\x76\145\x72\x69\146\x79\x4b\x65\x79"] => MoUtility::_get_invalid_otp_method())));
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
            goto le;
        }
        $lP = array_merge($lP, $this->_phoneFormId);
        le:
        return $lP;
    }
    function isFormCraftPluginInstalled()
    {
        return MoUtility::getActivePluginVersion("\106\x6f\x72\x6d\103\x72\141\x66\x74") < 3 ? true : false;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto Uj;
        }
        return;
        Uj:
        if ($this->isFormCraftPluginInstalled()) {
            goto ON;
        }
        return;
        ON:
        if (array_key_exists("\146\157\162\155\143\162\141\x66\164\x5f\x66\157\x72\x6d", $_POST)) {
            goto Xd;
        }
        return;
        Xd:
        foreach (array_filter($_POST["\146\x6f\x72\155\x63\x72\141\146\x74\x5f\146\x6f\x72\x6d"]["\x66\x6f\162\155"]) as $xl => $sA) {
            $nk = $this->getFormCraftFormDataFromID($sA);
            if (!MoUtility::isBlank($nk)) {
                goto W3;
            }
            goto CL;
            W3:
            $W0 = $this->getFieldIDs($_POST, $xl, $nk);
            $form[$sA] = array("\145\x6d\x61\151\x6c\x6b\145\x79" => $W0["\x65\155\x61\x69\154\113\x65\x79"], "\x70\x68\x6f\x6e\x65\x6b\x65\171" => $W0["\x70\x68\x6f\156\x65\x4b\x65\171"], "\x76\x65\162\x69\x66\171\113\145\x79" => $W0["\166\145\x72\x69\146\x79\x4b\145\x79"], "\x70\x68\x6f\x6e\x65\137\163\150\x6f\167" => $_POST["\146\157\x72\155\143\x72\141\146\164\137\x66\157\162\155"]["\x70\150\x6f\156\x65\x6b\x65\x79"][$xl], "\145\x6d\x61\151\154\x5f\163\150\x6f\x77" => $_POST["\146\157\162\155\143\162\141\x66\164\137\x66\157\162\x6d"]["\145\155\x61\151\x6c\x6b\x65\171"][$xl], "\x76\145\x72\x69\x66\171\137\x73\x68\157\167" => $_POST["\146\x6f\162\155\x63\162\141\146\164\137\x66\x6f\162\155"]["\166\145\162\151\146\x79\113\145\x79"][$xl]);
            CL:
        }
        DQ:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\146\x6f\162\155\x63\x72\x61\146\x74\137\145\x6e\x61\x62\x6c\145");
        $this->_otpType = $this->sanitizeFormPOST("\146\157\162\x6d\143\x72\x61\146\x74\137\x65\x6e\x61\x62\x6c\x65\137\164\x79\x70\x65");
        $this->_formDetails = !empty($form) ? $form : '';
        update_mo_option("\146\157\x72\155\x63\x72\x61\146\164\137\145\156\x61\142\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\x66\x6f\162\155\143\162\x61\x66\x74\x5f\x65\x6e\141\x62\x6c\145\137\x74\171\160\x65", $this->_otpType);
        update_mo_option("\146\x6f\x72\155\x63\x72\x61\146\164\x5f\157\x74\160\137\145\x6e\141\142\x6c\145\x64", maybe_serialize($this->_formDetails));
    }
    private function getFieldIDs($Jf, $xl, $nk)
    {
        $W0 = array("\145\155\x61\x69\154\113\145\171" => '', "\x70\150\x6f\x6e\145\113\145\171" => '', "\x76\x65\162\151\146\171\x4b\145\171" => '');
        if (!empty($Jf)) {
            goto ag;
        }
        return $W0;
        ag:
        foreach ($nk as $form) {
            if (!(strcasecmp($form["\145\154\145\155\145\x6e\x74\104\145\146\141\x75\154\x74\x73"]["\x6d\141\151\x6e\137\x6c\141\142\x65\154"], $Jf["\146\x6f\162\x6d\143\162\141\x66\x74\x5f\x66\x6f\162\x6d"]["\145\x6d\x61\151\154\x6b\145\x79"][$xl]) === 0)) {
                goto gr;
            }
            $W0["\x65\x6d\141\151\154\113\x65\x79"] = $form["\x69\x64\x65\x6e\x74\151\x66\151\145\x72"];
            gr:
            if (!(strcasecmp($form["\x65\x6c\145\155\x65\156\164\104\145\x66\x61\165\154\x74\163"]["\x6d\141\151\x6e\137\x6c\x61\x62\x65\154"], $Jf["\x66\157\162\155\143\x72\x61\x66\164\x5f\x66\x6f\x72\155"]["\160\150\x6f\x6e\145\153\x65\171"][$xl]) === 0)) {
                goto HZ;
            }
            $W0["\160\x68\157\156\x65\113\x65\171"] = $form["\x69\144\x65\156\164\151\x66\151\x65\162"];
            HZ:
            if (!(strcasecmp($form["\x65\154\145\155\x65\x6e\x74\104\145\x66\141\165\x6c\x74\163"]["\x6d\x61\151\156\x5f\154\x61\142\145\154"], $Jf["\x66\157\x72\x6d\143\x72\141\146\164\x5f\x66\x6f\x72\155"]["\166\145\162\x69\x66\x79\x4b\145\x79"][$xl]) === 0)) {
                goto s4;
            }
            $W0["\166\x65\162\151\146\x79\113\145\x79"] = $form["\151\x64\x65\156\164\151\146\x69\145\x72"];
            s4:
            EK:
        }
        ff:
        return $W0;
    }
    function getFormCraftFormDataFromID($so)
    {
        global $wpdb, $forms_table;
        $Fy = $wpdb->get_var("\x53\x45\x4c\x45\x43\x54\40\x6d\145\164\141\x5f\x62\x75\151\154\x64\145\162\40\106\x52\x4f\115\x20{$forms_table}\x20\127\x48\x45\x52\105\40\151\144\75{$so}");
        $Fy = json_decode(stripcslashes($Fy), 1);
        return $Fy["\146\151\x65\x6c\144\x73"];
    }
}
