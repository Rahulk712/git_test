<?php


namespace OTP\Handler\Forms;

use mysql_xdevapi\Session;
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
class FormCraftPremiumForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::FORMCRAFT;
        $this->_typePhoneTag = "\155\157\x5f\x66\x6f\x72\x6d\x63\x72\141\x66\x74\x5f\x70\150\157\156\x65\137\145\156\x61\x62\154\x65";
        $this->_typeEmailTag = "\155\157\137\x66\157\162\155\x63\x72\x61\x66\x74\137\145\155\141\151\x6c\x5f\x65\156\141\x62\154\x65";
        $this->_formKey = "\x46\117\x52\115\103\122\x41\x46\124\x50\x52\105\115\x49\125\x4d";
        $this->_formName = mo_("\106\157\162\155\x43\162\x61\146\164\x20\x28\x50\162\x65\155\x69\x75\x6d\40\126\x65\162\163\151\157\x6e\x29");
        $this->_isFormEnabled = get_mo_option("\146\x63\x70\x72\145\x6d\x69\x75\x6d\137\145\x6e\141\x62\x6c\145");
        $this->_phoneFormId = array();
        $this->_formDocuments = MoOTPDocs::FORMCRAFT_PREMIUM;
        parent::__construct();
    }
    function handleForm()
    {
        if (MoUtility::getActivePluginVersion("\106\157\162\x6d\103\x72\141\146\x74")) {
            goto tb;
        }
        return;
        tb:
        $this->_otpType = get_mo_option("\146\143\x70\162\145\x6d\x69\x75\x6d\x5f\145\x6e\x61\142\154\145\x5f\x74\171\x70\x65");
        $this->_formDetails = maybe_unserialize(get_mo_option("\x66\x63\160\162\x65\155\x69\165\155\x5f\157\x74\x70\x5f\145\156\141\x62\x6c\x65\x64"));
        if (!empty($this->_formDetails)) {
            goto pa;
        }
        return;
        pa:
        if ($this->isFormCraftVersion3Installed()) {
            goto Yy;
        }
        foreach ($this->_formDetails as $xl => $sA) {
            array_push($this->_phoneFormId, "\56\156\x66\157\162\155\x5f\x6c\151\40\x69\x6e\x70\x75\x74\x5b\156\141\x6d\145\136\x3d" . $sA["\x70\x68\157\156\145\153\145\171"] . "\x5d");
            EN:
        }
        uU:
        goto Nx;
        Yy:
        foreach ($this->_formDetails as $xl => $sA) {
            array_push($this->_phoneFormId, "\x69\x6e\160\165\x74\x5b\x6e\x61\155\x65\136\75" . $sA["\160\x68\x6f\x6e\145\x6b\x65\171"] . "\x5d");
            c3:
        }
        x0:
        Nx:
        add_action("\167\160\x5f\x61\x6a\x61\170\x5f\x66\x6f\x72\x6d\143\x72\x61\x66\x74\x5f\x73\165\x62\155\151\164", array($this, "\x76\x61\154\x69\x64\x61\164\x65\x5f\x66\x6f\x72\x6d\x63\162\x61\146\164\x5f\x66\x6f\162\155\x5f\163\165\x62\155\151\x74"), 1);
        add_action("\x77\160\137\x61\x6a\141\x78\137\156\x6f\160\x72\x69\x76\137\146\x6f\162\x6d\143\162\x61\146\164\137\163\x75\x62\155\x69\x74", array($this, "\x76\x61\x6c\151\x64\141\x74\x65\137\146\157\x72\155\143\x72\x61\x66\164\137\x66\x6f\162\x6d\x5f\163\165\x62\x6d\151\x74"), 1);
        add_action("\167\x70\137\x61\x6a\141\x78\137\146\x6f\162\155\143\x72\141\x66\164\x33\137\146\157\162\155\137\163\x75\x62\155\151\164", array($this, "\166\x61\154\151\x64\141\164\x65\137\x66\157\x72\x6d\x63\x72\141\146\164\137\x66\157\162\155\137\163\x75\142\155\151\164"), 1);
        add_action("\x77\x70\137\141\x6a\141\170\x5f\x6e\x6f\160\162\151\x76\x5f\x66\157\x72\155\x63\x72\141\x66\164\63\x5f\x66\157\x72\155\137\163\165\142\155\x69\x74", array($this, "\x76\x61\x6c\151\144\x61\x74\145\137\146\157\162\155\143\x72\x61\146\164\x5f\x66\157\x72\155\137\x73\x75\142\x6d\151\x74"), 1);
        add_action("\167\160\137\145\x6e\x71\x75\145\165\x65\x5f\163\143\162\x69\x70\x74\x73", array($this, "\x65\x6e\x71\165\145\x75\x65\x5f\163\x63\162\x69\x70\x74\137\157\x6e\x5f\160\141\147\x65"));
        $this->routeData();
    }
    function routeData()
    {
        if (array_key_exists("\157\160\164\151\x6f\156", $_GET)) {
            goto l2;
        }
        return;
        l2:
        switch (trim($_GET["\157\160\164\151\157\x6e"])) {
            case "\155\x69\156\151\157\x72\141\156\x67\145\55\146\x6f\162\155\x63\162\141\x66\x74\x70\x72\145\x6d\151\x75\x6d\x2d\x76\x65\162\x69\146\x79":
                $this->_handle_formcraft_form($_POST);
                goto a8;
            case "\x6d\x69\156\x69\x6f\x72\x61\156\147\x65\x2d\146\x6f\x72\155\143\x72\141\146\164\x70\x72\145\x6d\151\x75\x6d\55\146\157\x72\155\55\x6f\x74\x70\55\145\156\141\142\x6c\x65\144":
                wp_send_json($this->isVerificationEnabledForThisForm($_POST["\x66\x6f\x72\x6d\x5f\x69\144"]));
                goto a8;
        }
        dS:
        a8:
    }
    function _handle_formcraft_form($Jf)
    {
        if ($this->isVerificationEnabledForThisForm($_POST["\146\157\162\x6d\137\x69\x64"])) {
            goto mP;
        }
        return;
        mP:
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto SB;
        }
        $this->_send_otp_to_email($Jf);
        goto z3;
        SB:
        $this->_send_otp_to_phone($Jf);
        z3:
    }
    function _send_otp_to_phone($Jf)
    {
        if (array_key_exists("\x75\163\x65\162\137\160\150\157\156\145", $Jf) && !MoUtility::isBlank($Jf["\165\163\145\162\137\x70\x68\157\x6e\145"])) {
            goto oj;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_PHONE), MoConstants::ERROR_JSON_TYPE));
        goto Ih;
        oj:
        SessionUtils::addPhoneVerified($this->_formSessionVar, $Jf["\165\x73\x65\162\x5f\160\x68\157\156\145"]);
        $this->sendChallenge("\x74\x65\163\x74", '', null, trim($Jf["\165\163\145\x72\137\x70\x68\157\x6e\x65"]), VerificationType::PHONE);
        Ih:
    }
    function _send_otp_to_email($Jf)
    {
        if (array_key_exists("\165\163\145\162\137\145\x6d\141\151\154", $Jf) && !MoUtility::isBlank($Jf["\x75\163\145\x72\x5f\x65\x6d\x61\151\x6c"])) {
            goto N7;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_EMAIL), MoConstants::ERROR_JSON_TYPE));
        goto pG;
        N7:
        SessionUtils::addEmailVerified($this->_formSessionVar, $Jf["\165\163\145\162\137\x65\x6d\x61\151\x6c"]);
        $this->sendChallenge("\x74\x65\163\164", $Jf["\x75\163\145\x72\x5f\145\x6d\141\151\154"], null, $Jf["\x75\x73\145\x72\137\145\155\141\x69\x6c"], VerificationType::EMAIL);
        pG:
    }
    function validate_formcraft_form_submit()
    {
        $so = $_POST["\x69\144"];
        if ($this->isVerificationEnabledForThisForm($so)) {
            goto gT;
        }
        return;
        gT:
        $nk = $this->parseSubmittedData($_POST, $so);
        $this->checkIfVerificationNotStarted($nk);
        $lr = is_array($nk["\x70\x68\157\x6e\x65"]["\x76\x61\154\165\145"]) ? $nk["\x70\x68\157\x6e\x65"]["\166\x61\x6c\165\145"][0] : $nk["\160\150\157\156\x65"]["\x76\x61\x6c\165\145"];
        $xX = is_array($nk["\x65\x6d\x61\x69\x6c"]["\166\141\154\165\145"]) ? $nk["\x65\x6d\141\151\x6c"]["\x76\x61\x6c\x75\145"][0] : $nk["\x65\x6d\x61\151\154"]["\166\141\154\x75\145"];
        $Va = is_array($nk["\157\164\160"]["\166\x61\x6c\165\x65"]) ? $nk["\157\164\160"]["\x76\141\x6c\x75\x65"][0] : $nk["\157\x74\x70"]["\x76\x61\x6c\x75\x65"];
        $m5 = $this->getVerificationType();
        if ($m5 === VerificationType::PHONE && !SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $lr)) {
            goto EL;
        }
        if ($m5 === VerificationType::EMAIL && !SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $xX)) {
            goto rb;
        }
        goto lc;
        EL:
        $this->sendJSONErrorMessage(MoMessages::showMessage(MoMessages::PHONE_MISMATCH), $nk["\x70\x68\x6f\x6e\x65"]["\x66\x69\x65\154\x64"]);
        goto lc;
        rb:
        $this->sendJSONErrorMessage(MoMessages::showMessage(MoMessages::EMAIL_MISMATCH), $nk["\x65\155\141\151\x6c"]["\146\151\x65\154\x64"]);
        lc:
        if (!MoUtility::isBlank($nk["\x6f\164\x70"]["\x76\x61\154\165\145"])) {
            goto Fu;
        }
        $this->sendJSONErrorMessage(MoUtility::_get_invalid_otp_method(), $nk["\157\164\160"]["\x66\151\145\154\144"]);
        Fu:
        SessionUtils::setFormOrFieldId($this->_formSessionVar, $nk["\x6f\x74\x70"]["\146\151\x65\154\x64"]);
        $this->validateChallenge($m5, NULL, $Va);
    }
    function enqueue_script_on_page()
    {
        wp_register_script("\x66\x63\160\x72\145\155\x69\x75\155\x73\x63\x72\151\160\164", MOV_URL . "\151\x6e\143\154\165\x64\x65\x73\x2f\x6a\x73\x2f\146\157\162\155\143\162\141\146\164\160\162\145\155\x69\165\155\x2e\155\151\156\56\152\163\77\x76\145\162\163\x69\x6f\156\x3d" . MOV_VERSION, array("\x6a\161\x75\x65\x72\x79"));
        wp_localize_script("\146\143\x70\x72\145\x6d\151\x75\155\x73\143\162\151\160\x74", "\155\x6f\x66\143\160\166\x61\x72\x73", array("\x69\155\147\x55\122\114" => MOV_LOADER_URL, "\x66\157\x72\155\x43\x72\x61\x66\164\x46\157\x72\155\x73" => $this->_formDetails, "\x73\x69\164\145\x55\x52\x4c" => site_url(), "\x6f\164\160\x54\171\x70\x65" => $this->_otpType, "\x62\x75\164\x74\x6f\x6e\124\x65\x78\164" => mo_("\103\x6c\x69\143\x6b\x20\150\x65\162\145\40\164\157\40\x73\x65\156\144\x20\117\124\120"), "\142\x75\x74\164\157\156\x54\x69\164\154\x65" => $this->_otpType == $this->_typePhoneTag ? mo_("\x50\x6c\x65\x61\163\x65\40\145\156\164\x65\x72\x20\x61\x20\120\150\x6f\156\145\40\116\x75\155\x62\145\162\x20\x74\157\x20\145\156\x61\142\154\x65\x20\164\x68\151\163\40\x66\151\x65\154\144\x2e") : mo_("\x50\x6c\x65\141\163\x65\40\x65\x6e\x74\145\x72\x20\x61\x20\120\150\157\x6e\x65\x20\116\165\155\142\145\162\40\x74\157\x20\x65\156\141\x62\x6c\145\x20\x74\x68\151\x73\x20\x66\x69\x65\x6c\x64\56"), "\x61\x6a\x61\170\165\162\154" => wp_ajax_url(), "\164\x79\x70\145\120\x68\157\156\145" => $this->_typePhoneTag, "\143\x6f\x75\156\x74\x72\171\104\162\x6f\x70" => get_mo_option("\x73\150\157\167\x5f\x64\162\x6f\x70\x64\157\x77\156\137\157\x6e\137\x66\x6f\162\x6d"), "\x76\145\x72\x73\151\157\156\63" => $this->isFormCraftVersion3Installed()));
        wp_enqueue_script("\x66\x63\x70\162\x65\155\151\165\x6d\x73\143\x72\151\160\164");
    }
    function parseSubmittedData($post, $so)
    {
        $Jf = array();
        $form = $this->_formDetails[$so];
        foreach ($post as $xl => $sA) {
            if (!(strpos($xl, "\x66\151\x65\154\x64") === FALSE)) {
                goto sL;
            }
            goto E7;
            sL:
            $this->getValueAndFieldFromPost($Jf, "\145\155\141\151\154", $xl, str_replace("\x20", "\x5f", $form["\145\155\x61\x69\x6c\153\x65\x79"]), $sA);
            $this->getValueAndFieldFromPost($Jf, "\x70\150\x6f\x6e\x65", $xl, str_replace("\x20", "\137", $form["\x70\150\157\x6e\145\153\x65\x79"]), $sA);
            $this->getValueAndFieldFromPost($Jf, "\157\x74\160", $xl, str_replace("\x20", "\x5f", $form["\166\145\162\x69\146\171\113\145\171"]), $sA);
            E7:
        }
        os:
        return $Jf;
    }
    function getValueAndFieldFromPost(&$Jf, $XE, $xI, $Zz, $sA)
    {
        if (!(is_null($Jf[$XE]) && strpos($xI, $Zz, 0) !== FALSE)) {
            goto aN;
        }
        $Jf[$XE]["\x76\141\154\x75\145"] = $this->isFormCraftVersion3Installed() && $XE == "\x6f\x74\x70" ? $sA[0] : $sA;
        $dR = strpos($xI, "\146\x69\145\x6c\x64", 0);
        $Jf[$XE]["\146\151\x65\154\x64"] = $this->isFormCraftVersion3Installed() ? $xI : substr($xI, $dR, strpos($xI, "\137", $dR) - $dR);
        aN:
    }
    function isVerificationEnabledForThisForm($so)
    {
        return array_key_exists($so, $this->_formDetails);
    }
    function sendJSONErrorMessage($errors, $uG)
    {
        if ($this->isFormCraftVersion3Installed()) {
            goto CT;
        }
        $hy["\x65\162\162\x6f\162\x73"] = mo_("\120\154\145\x61\163\x65\x20\x63\x6f\x72\162\145\x63\x74\40\164\x68\x65\x20\145\x72\162\x6f\162\x73\40\141\156\144\40\164\162\171\40\141\x67\141\x69\x6e");
        $hy[$uG][0] = $errors;
        goto HR;
        CT:
        $hy["\x66\x61\x69\x6c\x65\144"] = mo_("\x50\x6c\x65\x61\163\x65\x20\143\x6f\162\162\x65\143\164\40\x74\150\x65\40\145\x72\x72\x6f\162\163\40\141\x6e\x64\x20\x74\x72\x79\x20\x61\147\141\151\x6e");
        $hy["\145\162\x72\157\162\163"][$uG] = $errors;
        HR:
        echo json_encode($hy);
        die;
    }
    function checkIfVerificationNotStarted($nk)
    {
        if (!SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto wi;
        }
        return;
        wi:
        if ($this->_otpType == $this->_typePhoneTag) {
            goto rX;
        }
        $this->sendJSONErrorMessage(MoMessages::showMessage(MoMessages::PLEASE_VALIDATE), $nk["\145\x6d\141\151\x6c"]["\146\x69\x65\154\x64"]);
        goto HS;
        rX:
        $this->sendJSONErrorMessage(MoMessages::showMessage(MoMessages::PLEASE_VALIDATE), $nk["\x70\150\157\156\145"]["\146\151\x65\154\x64"]);
        HS:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto jB;
        }
        return;
        jB:
        $qL = SessionUtils::getFormOrFieldId($this->_formSessionVar);
        $this->sendJSONErrorMessage(MoUtility::_get_invalid_otp_method(), $qL);
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
        if (!($this->isFormEnabled() && $this->_otpType == $this->_typePhoneTag)) {
            goto Fv;
        }
        $lP = array_merge($lP, $this->_phoneFormId);
        Fv:
        return $lP;
    }
    function getFieldId($Jf, $nk)
    {
        foreach ($nk as $form) {
            if (!($form["\x65\154\145\155\145\x6e\164\104\x65\146\x61\165\x6c\164\x73"]["\155\141\x69\156\x5f\x6c\x61\142\145\154"] == $Jf)) {
                goto sh;
            }
            return $form["\151\144\x65\x6e\x74\x69\x66\151\145\x72"];
            sh:
            pl:
        }
        kX:
        return NULL;
    }
    function getFormCraftFormDataFromID($so)
    {
        global $wpdb, $yd;
        $Fy = $wpdb->get_var("\123\105\114\x45\x43\x54\x20\x6d\x65\164\141\x5f\x62\x75\x69\154\144\145\x72\40\106\x52\117\x4d\40{$yd}\x20\127\x48\105\x52\105\x20\x69\144\75{$so}");
        $Fy = json_decode(stripcslashes($Fy), 1);
        return $Fy["\x66\x69\x65\x6c\x64\x73"];
    }
    function isFormCraftVersion3Installed()
    {
        return MoUtility::getActivePluginVersion("\106\157\x72\155\x43\x72\141\x66\x74") == 3 ? true : false;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto ER;
        }
        return;
        ER:
        if (MoUtility::getActivePluginVersion("\106\x6f\162\x6d\x43\162\141\146\x74")) {
            goto V4;
        }
        return;
        V4:
        $form = array();
        foreach (array_filter($_POST["\x66\x63\x70\x72\x65\155\151\x75\x6d\x5f\x66\157\x72\x6d"]["\146\x6f\x72\155"]) as $xl => $sA) {
            !$this->isFormCraftVersion3Installed() ? $this->processAndGetFormData($_POST, $xl, $sA, $form) : $this->processAndGetForm3Data($_POST, $xl, $sA, $form);
            Ur:
        }
        XC:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\146\x63\160\162\x65\x6d\151\165\x6d\x5f\x65\156\141\x62\154\145");
        $this->_otpType = $this->sanitizeFormPOST("\146\x63\x70\162\x65\155\x69\x75\x6d\137\145\156\x61\142\154\145\137\164\x79\160\x65");
        $this->_formDetails = !empty($form) ? $form : '';
        update_mo_option("\146\143\x70\x72\145\x6d\x69\165\x6d\x5f\x65\x6e\x61\142\154\145", $this->_isFormEnabled);
        update_mo_option("\x66\143\x70\x72\145\155\x69\x75\x6d\x5f\x65\156\141\x62\154\145\x5f\x74\171\x70\145", $this->_otpType);
        update_mo_option("\146\143\x70\162\145\155\x69\165\155\x5f\157\x74\x70\137\145\156\141\x62\154\145\x64", maybe_serialize($this->_formDetails));
    }
    function processAndGetFormData($post, $xl, $sA, &$form)
    {
        $form[$sA] = array("\x65\x6d\x61\x69\x6c\153\x65\171" => str_replace("\x20", "\x20", $post["\x66\143\x70\162\145\x6d\151\x75\x6d\137\146\157\x72\x6d"]["\145\155\141\151\154\x6b\x65\171"][$xl]) . "\x5f\145\155\x61\151\154\x5f\145\155\x61\x69\154\x5f", "\160\x68\x6f\156\145\x6b\x65\171" => str_replace("\40", "\40", $post["\x66\143\x70\162\145\155\151\x75\x6d\137\x66\x6f\x72\155"]["\160\150\x6f\x6e\145\153\145\171"][$xl]) . "\x5f\x74\145\x78\164\137", "\166\x65\x72\x69\x66\x79\113\145\x79" => str_replace("\40", "\x20", $post["\x66\x63\160\x72\145\x6d\x69\x75\x6d\x5f\146\x6f\x72\155"]["\166\x65\162\151\146\171\x4b\145\x79"][$xl]) . "\137\x74\x65\170\164\137", "\x70\x68\157\x6e\145\x5f\x73\150\157\167" => $post["\146\143\x70\162\x65\155\151\165\155\x5f\146\x6f\162\x6d"]["\x70\x68\157\156\x65\153\145\x79"][$xl], "\x65\x6d\141\x69\x6c\x5f\163\x68\157\x77" => $post["\146\143\x70\162\x65\x6d\x69\165\x6d\137\x66\x6f\x72\155"]["\x65\x6d\141\x69\154\x6b\x65\171"][$xl], "\x76\145\x72\151\x66\171\x5f\163\x68\157\167" => $post["\x66\143\160\x72\145\155\x69\x75\x6d\x5f\x66\x6f\x72\155"]["\166\x65\x72\x69\146\171\113\145\x79"][$xl]);
    }
    function processAndGetForm3Data($post, $xl, $sA, &$form)
    {
        $nk = $this->getFormCraftFormDataFromID($sA);
        if (!MoUtility::isBlank($nk)) {
            goto Jr;
        }
        return;
        Jr:
        $form[$sA] = array("\145\x6d\x61\151\x6c\x6b\145\x79" => $this->getFieldId($post["\x66\x63\160\x72\x65\155\x69\165\155\x5f\x66\157\x72\155"]["\145\155\x61\151\x6c\153\145\171"][$xl], $nk), "\x70\x68\x6f\156\x65\x6b\x65\x79" => $this->getFieldId($post["\146\143\x70\162\x65\155\x69\165\x6d\137\146\x6f\x72\155"]["\160\150\x6f\156\145\153\145\171"][$xl], $nk), "\x76\145\162\151\x66\171\113\x65\171" => $this->getFieldId($post["\x66\143\x70\162\x65\x6d\x69\x75\155\x5f\146\x6f\x72\155"]["\166\x65\x72\151\146\171\x4b\145\171"][$xl], $nk), "\160\x68\x6f\156\x65\x5f\x73\x68\157\x77" => $post["\x66\143\160\162\145\155\x69\x75\155\x5f\x66\x6f\x72\155"]["\160\x68\x6f\x6e\145\x6b\x65\x79"][$xl], "\145\x6d\x61\x69\x6c\x5f\x73\150\157\x77" => $post["\x66\143\x70\162\x65\155\151\165\155\x5f\x66\157\162\155"]["\145\x6d\x61\151\x6c\153\145\171"][$xl], "\x76\145\162\151\x66\171\x5f\163\x68\157\167" => $post["\x66\x63\160\162\145\x6d\151\x75\155\x5f\146\157\x72\155"]["\x76\x65\x72\151\146\x79\x4b\x65\x79"][$xl]);
    }
}
