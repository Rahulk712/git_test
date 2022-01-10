<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoPHPSessions;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
class NinjaFormAjaxForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::NINJA_FORM_AJAX;
        $this->_typePhoneTag = "\x6d\157\x5f\x6e\x69\x6e\x6a\141\x5f\146\157\162\155\x5f\160\x68\157\156\145\137\x65\156\x61\142\x6c\145";
        $this->_typeEmailTag = "\x6d\x6f\137\156\x69\x6e\152\x61\x5f\x66\157\x72\x6d\x5f\x65\155\141\x69\x6c\137\x65\156\x61\x62\154\x65";
        $this->_typeBothTag = "\x6d\x6f\x5f\156\151\x6e\152\141\x5f\x66\x6f\x72\155\137\142\157\164\150\x5f\x65\156\x61\x62\x6c\x65";
        $this->_formKey = "\x4e\x49\x4e\x4a\101\137\106\x4f\x52\115\137\101\x4a\101\x58";
        $this->_formName = mo_("\116\x69\156\x6a\x61\40\106\157\162\x6d\x73\40\50\x20\x41\142\x6f\x76\x65\x20\166\x65\x72\163\151\157\x6e\x20\63\56\60\40\x29");
        $this->_isFormEnabled = get_mo_option("\156\x6a\x61\x5f\x65\156\x61\x62\x6c\145");
        $this->_buttonText = get_mo_option("\156\152\141\137\142\165\x74\x74\x6f\x6e\x5f\164\x65\x78\x74");
        $this->_buttonText = !MoUtility::isBlank($this->_buttonText) ? $this->_buttonText : mo_("\x43\x6c\151\x63\153\x20\x48\145\x72\x65\40\x74\157\x20\163\x65\x6e\x64\40\117\x54\120");
        $this->_phoneFormId = array();
        $this->_formDocuments = MoOTPDocs::NINJA_FORMS_AJAX_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x6e\x69\x6e\x6a\141\137\x66\157\162\x6d\x5f\x65\x6e\141\x62\x6c\x65\137\x74\171\160\145");
        $this->_formDetails = maybe_unserialize(get_mo_option("\156\x69\156\152\x61\137\x66\x6f\162\x6d\x5f\x6f\164\x70\137\x65\x6e\x61\x62\154\145\144"));
        if (!empty($this->_formDetails)) {
            goto Pv;
        }
        return;
        Pv:
        foreach ($this->_formDetails as $xl => $sA) {
            array_push($this->_phoneFormId, "\151\x6e\x70\x75\164\x5b\x69\x64\x3d\x6e\x66\55\x66\x69\x65\x6c\x64\x2d" . $sA["\x70\150\x6f\x6e\145\153\x65\x79"] . "\x5d");
            fi:
        }
        hk:
        add_action("\156\x69\x6e\x6a\x61\137\x66\x6f\x72\155\x73\x5f\141\x66\x74\x65\162\137\146\157\x72\155\137\144\x69\163\160\x6c\x61\171", array($this, "\145\156\161\x75\145\165\145\x5f\x6e\152\x5f\x66\157\x72\155\137\x73\x63\162\151\160\164"), 99, 1);
        add_filter("\156\151\x6e\152\x61\x5f\146\157\162\x6d\163\137\163\x75\x62\x6d\x69\x74\x5f\x64\141\x74\141", array($this, "\x5f\x68\141\x6e\144\x6c\145\x5f\156\152\137\x61\152\x61\170\x5f\x66\x6f\x72\155\137\x73\165\142\x6d\x69\164"), 99, 1);
        $m5 = $this->getVerificationType();
        if (!$m5) {
            goto NO;
        }
        add_filter("\156\x69\x6e\152\141\137\x66\x6f\162\x6d\163\x5f\x6c\x6f\x63\x61\154\151\172\x65\137\146\151\145\x6c\144\137\163\x65\164\x74\151\x6e\x67\163\137" . $m5, array($this, "\x5f\x61\x64\x64\137\142\165\x74\x74\157\156"), 99, 2);
        NO:
        $this->routeData();
    }
    function routeData()
    {
        if (array_key_exists("\157\160\164\x69\157\156", $_GET)) {
            goto yX;
        }
        return;
        yX:
        switch (trim($_GET["\157\x70\164\151\x6f\x6e"])) {
            case "\x6d\151\x6e\151\157\162\x61\x6e\x67\x65\x2d\156\x6a\55\x61\x6a\x61\170\x2d\x76\145\162\151\146\x79":
                $this->_send_otp_nj_ajax_verify($_POST);
                goto zq;
        }
        Y4:
        zq:
    }
    function enqueue_nj_form_script($qL)
    {
        if (!array_key_exists($qL, $this->_formDetails)) {
            goto Ht;
        }
        $nk = $this->_formDetails[$qL];
        $p3 = array_keys($this->_formDetails);
        wp_register_script("\x6e\152\x73\143\x72\151\160\x74", MOV_URL . "\151\156\x63\x6c\165\144\x65\x73\57\x6a\x73\x2f\156\x69\x6e\152\x61\x66\x6f\x72\155\x61\152\x61\x78\56\155\x69\156\x2e\152\163", array("\x6a\x71\165\145\x72\x79"), MOV_VERSION, true);
        wp_localize_script("\156\x6a\x73\143\162\x69\160\164", "\155\x6f\x6e\151\x6e\152\x61\166\141\162\163", array("\151\x6d\x67\x55\122\x4c" => MOV_URL . "\x69\x6e\x63\x6c\165\x64\145\x73\57\x69\155\x61\147\145\163\x2f\x6c\157\x61\144\145\x72\56\x67\x69\146", "\163\x69\164\145\125\122\x4c" => site_url(), "\157\x74\160\x54\171\160\x65" => $this->_otpType == $this->_typePhoneTag ? VerificationType::PHONE : VerificationType::EMAIL, "\146\x6f\x72\x6d\163" => $this->_formDetails, "\x66\x6f\162\155\x4b\x65\171\x56\x61\x6c\x73" => $p3));
        wp_enqueue_script("\x6e\x6a\163\143\x72\x69\x70\x74");
        Ht:
        return $qL;
    }
    function _add_button($El, $form)
    {
        $u5 = $form->get_id();
        if (array_key_exists($u5, $this->_formDetails)) {
            goto Up;
        }
        return $El;
        Up:
        $nk = $this->_formDetails[$u5];
        $PW = $this->_otpType == $this->_typePhoneTag ? "\160\150\x6f\x6e\145\x6b\x65\x79" : "\145\155\141\x69\x6c\x6b\x65\171";
        if (!($El["\151\144"] == $nk[$PW])) {
            goto go;
        }
        $El["\141\146\x74\145\162\x46\x69\x65\x6c\x64"] = "\xa\x20\40\40\40\x20\40\40\x20\40\x20\40\x20\40\40\40\x20\x3c\144\151\x76\40\151\144\75\42\156\146\x2d\x66\151\145\154\x64\x2d\64\x2d\143\157\x6e\x74\141\151\156\x65\x72\42\40\x63\154\x61\x73\163\75\x22\x6e\146\x2d\146\151\x65\154\x64\55\x63\157\x6e\164\x61\x69\156\145\162\x20\x73\x75\142\x6d\x69\164\55\143\157\x6e\x74\x61\151\x6e\x65\x72\x20\x20\x6c\141\142\x65\154\x2d\141\x62\157\x76\x65\x20\42\x3e\12\40\x20\x20\x20\x20\x20\x20\40\x20\x20\40\40\x20\x20\x20\40\x20\x20\x20\x20\74\x64\151\x76\40\x63\154\x61\163\x73\x3d\42\156\x66\55\142\x65\x66\157\162\145\55\x66\151\x65\x6c\144\x22\76\xa\40\x20\40\40\40\x20\40\x20\x20\40\40\40\40\x20\x20\x20\x20\40\x20\x20\x20\x20\40\40\x3c\x6e\146\55\163\145\143\x74\x69\157\156\76\74\57\x6e\x66\55\163\145\143\x74\151\x6f\x6e\x3e\xa\40\40\40\x20\40\40\x20\40\40\x20\x20\x20\40\x20\40\x20\x20\40\x20\40\74\57\x64\151\x76\x3e\12\40\x20\40\x20\40\40\40\40\x20\40\40\40\40\40\40\40\x20\x20\x20\x20\x3c\x64\x69\166\x20\x63\154\x61\163\163\75\x22\x6e\x66\55\146\x69\145\154\144\x22\76\xa\40\40\x20\40\40\40\x20\x20\40\40\40\40\40\40\x20\40\x20\40\40\40\40\x20\40\40\74\x64\151\166\40\x63\154\x61\163\x73\x3d\42\x66\x69\x65\x6c\144\55\167\162\x61\x70\x20\163\x75\142\x6d\x69\164\x2d\x77\x72\141\x70\x22\76\12\x20\40\40\x20\x20\x20\x20\40\x20\40\x20\40\40\40\40\40\40\40\40\40\x20\x20\40\x20\40\40\40\x20\74\144\151\166\40\x63\x6c\x61\163\163\x3d\x22\156\146\55\146\x69\145\x6c\x64\x2d\154\x61\142\145\154\x22\76\74\x2f\144\x69\166\76\xa\x20\40\x20\x20\40\40\x20\40\x20\x20\40\40\40\40\40\x20\x20\x20\x20\x20\x20\40\x20\x20\40\x20\40\40\x3c\x64\x69\x76\40\143\154\141\163\163\75\x22\x6e\146\55\146\151\x65\154\144\55\x65\154\145\155\145\156\x74\x22\x3e\xa\x20\x20\x20\40\x20\x20\x20\x20\40\40\x20\x20\40\40\40\40\x20\40\40\40\x20\x20\x20\40\40\x20\x20\40\40\40\40\40\74\151\156\x70\x75\x74\x20\40\x69\x64\75\42\x6d\151\156\151\x6f\162\x61\x6e\147\145\137\x6f\x74\160\x5f\x74\x6f\x6b\x65\156\137\x73\x75\x62\155\151\164\137" . $u5 . "\x22\40\143\x6c\141\163\163\x3d\x22\x6e\151\x6e\x6a\x61\55\x66\x6f\x72\x6d\x73\x2d\x66\151\145\x6c\144\x20\x6e\x66\55\145\154\x65\155\145\156\164\x22\12\x20\x20\40\40\40\x20\40\40\40\40\40\40\x20\40\x20\x20\40\x20\40\x20\40\40\x20\x20\40\40\x20\40\x20\40\40\x20\40\40\x20\x20\40\40\x20\x20\166\141\154\x75\145\75\42" . mo_($this->_buttonText) . "\x22\x20\x74\x79\160\x65\75\x22\142\165\164\x74\157\156\42\x3e\12\40\x20\x20\40\x20\40\40\40\40\40\40\40\x20\40\40\40\40\40\x20\x20\x20\40\x20\40\40\40\40\40\74\57\x64\151\166\x3e\xa\40\x20\x20\x20\x20\40\40\40\x20\x20\40\x20\40\x20\40\40\40\40\40\x20\40\x20\40\40\74\x2f\x64\151\x76\76\xa\40\40\x20\40\x20\x20\40\x20\x20\x20\40\40\x20\40\40\40\40\x20\40\40\x3c\57\144\151\x76\76\12\x20\40\40\x20\x20\40\40\x20\40\40\40\40\40\x20\40\40\40\40\40\40\x3c\x64\151\x76\40\x63\x6c\x61\x73\x73\x3d\42\156\146\x2d\141\x66\x74\x65\x72\x2d\146\x69\x65\154\x64\x22\76\xa\40\40\x20\x20\40\40\40\x20\x20\x20\x20\x20\40\40\x20\40\40\x20\40\40\40\40\40\x20\74\x6e\146\x2d\x73\x65\143\164\151\x6f\x6e\76\12\x20\40\40\40\40\x20\40\x20\40\x20\40\40\x20\40\x20\x20\40\40\40\x20\x20\40\40\x20\40\40\x20\x20\74\144\151\166\40\x63\154\141\x73\x73\x3d\42\x6e\146\x2d\x69\x6e\x70\x75\164\55\x6c\x69\x6d\x69\164\x22\x3e\x3c\x2f\x64\151\x76\x3e\12\x20\40\40\40\x20\x20\40\40\x20\40\40\40\40\40\x20\40\40\40\x20\x20\40\40\40\x20\x20\40\x20\40\x3c\144\x69\x76\40\143\x6c\x61\163\x73\x3d\42\x6e\x66\x2d\x65\x72\162\157\x72\x2d\167\x72\x61\x70\x20\x6e\x66\55\145\x72\162\x6f\162\x22\x3e\x3c\x2f\144\151\166\x3e\xa\40\x20\40\x20\40\40\x20\x20\40\40\40\x20\40\x20\40\x20\x20\x20\40\40\x20\x20\x20\x20\x3c\x2f\156\x66\x2d\163\x65\x63\164\151\x6f\156\x3e\12\x20\40\x20\x20\x20\x20\x20\x20\40\x20\40\40\x20\40\40\40\x20\x20\x20\40\74\57\x64\x69\x76\76\xa\x20\40\40\40\x20\40\40\x20\40\x20\x20\40\x20\40\40\40\74\57\144\151\x76\76\12\x20\40\x20\x20\40\x20\x20\40\x20\x20\x20\40\x20\40\40\40\74\144\151\x76\40\x69\144\75\x22\155\157\x5f\x6d\x65\163\163\141\x67\x65\x5f" . $u5 . "\x22\x20\150\151\x64\x64\145\156\x3d\42\x22\x20\163\164\x79\x6c\145\75\42\142\141\143\x6b\x67\162\157\x75\156\x64\55\x63\x6f\154\x6f\162\72\40\x23\146\x37\x66\x36\146\x37\x3b\x70\x61\144\x64\x69\156\147\x3a\40\61\x65\155\x20\62\145\155\40\x31\145\155\40\63\56\65\x65\x6d\73\x22\x3e\74\x2f\144\151\166\76";
        go:
        return $El;
    }
    function _handle_nj_ajax_form_submit($Jf)
    {
        if (array_key_exists($Jf["\x69\x64"], $this->_formDetails)) {
            goto WC;
        }
        return $Jf;
        WC:
        $nk = $this->_formDetails[$Jf["\151\x64"]];
        $Jf = $this->checkIfOtpVerificationStarted($nk, $Jf);
        if (!isset($Jf["\145\x72\162\x6f\162\163"]["\x66\x69\x65\154\144\163"])) {
            goto ax;
        }
        return $Jf;
        ax:
        if (!(strcasecmp($this->_otpType, $this->_typeEmailTag) == 0)) {
            goto Gd;
        }
        $Jf = $this->processEmail($nk, $Jf);
        Gd:
        if (!(strcasecmp($this->_otpType, $this->_typePhoneTag) == 0)) {
            goto fr;
        }
        $Jf = $this->processPhone($nk, $Jf);
        fr:
        if (isset($Jf["\x65\x72\162\157\162\163"]["\x66\151\145\x6c\x64\163"])) {
            goto vK;
        }
        $Jf = $this->processOTPEntered($Jf, $nk);
        vK:
        return $Jf;
    }
    function processOTPEntered($Jf, $nk)
    {
        $cB = $nk["\166\x65\x72\151\146\x79\113\145\171"];
        $m5 = $this->getVerificationType();
        $this->validateChallenge($m5, NULL, $Jf["\x66\151\x65\154\144\x73"][$cB]["\166\x61\x6c\x75\145"]);
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $m5)) {
            goto m3;
        }
        $this->unsetOTPSessionVariables();
        goto Bo;
        m3:
        $Jf["\x65\162\162\157\162\x73"]["\x66\151\145\154\x64\163"][$cB] = MoUtility::_get_invalid_otp_method();
        Bo:
        return $Jf;
    }
    function checkIfOtpVerificationStarted($nk, $Jf)
    {
        if (!SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto yU;
        }
        return $Jf;
        yU:
        if (strcasecmp($this->_otpType, $this->_typeEmailTag) == 0) {
            goto WB;
        }
        $Jf["\145\162\x72\157\x72\163"]["\x66\x69\x65\x6c\x64\x73"][$nk["\x70\150\157\x6e\x65\153\145\171"]] = MoMessages::showMessage(MoMessages::ENTER_VERIFY_CODE);
        goto Xj;
        WB:
        $Jf["\145\x72\162\x6f\162\x73"]["\x66\151\145\154\144\x73"][$nk["\x65\155\141\151\x6c\153\145\171"]] = MoMessages::showMessage(MoMessages::ENTER_VERIFY_CODE);
        Xj:
        return $Jf;
    }
    function processEmail($nk, $Jf)
    {
        $LT = $nk["\x65\x6d\141\x69\x6c\153\145\x79"];
        if (!SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $Jf["\x66\151\145\154\x64\x73"][$LT]["\166\141\154\x75\x65"])) {
            goto r_;
        }
        $Jf["\145\162\x72\x6f\162\x73"]["\146\151\145\x6c\x64\x73"][$LT] = MoMessages::showMessage(MoMessages::EMAIL_MISMATCH);
        r_:
        return $Jf;
    }
    function processPhone($nk, $Jf)
    {
        $LT = $nk["\160\150\x6f\156\145\153\x65\x79"];
        if (!SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $Jf["\x66\x69\x65\x6c\x64\x73"][$LT]["\166\x61\x6c\165\x65"])) {
            goto VO;
        }
        $Jf["\145\162\162\157\x72\x73"]["\x66\x69\145\154\144\163"][$LT] = MoMessages::showMessage(MoMessages::PHONE_MISMATCH);
        VO:
        return $Jf;
    }
    function _send_otp_nj_ajax_verify($Jf)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if ($this->_otpType == $this->_typePhoneTag) {
            goto sq;
        }
        $this->_send_nj_ajax_otp_to_email($Jf);
        goto ps;
        sq:
        $this->_send_nj_ajax_otp_to_phone($Jf);
        ps:
    }
    function _send_nj_ajax_otp_to_phone($Jf)
    {
        if (!array_key_exists("\165\x73\145\162\x5f\160\150\157\156\x65", $Jf) || !isset($Jf["\x75\163\145\162\137\x70\150\157\x6e\145"])) {
            goto Xe;
        }
        $this->setSessionAndStartOTPVerification(trim($Jf["\x75\x73\145\162\137\x70\150\x6f\x6e\x65"]), NULL, trim($Jf["\165\163\x65\162\137\160\x68\157\156\x65"]), VerificationType::PHONE);
        goto wb;
        Xe:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_PHONE), MoConstants::ERROR_JSON_TYPE));
        wb:
    }
    function _send_nj_ajax_otp_to_email($Jf)
    {
        if (!array_key_exists("\165\x73\x65\x72\x5f\x65\x6d\141\x69\154", $Jf) || !isset($Jf["\x75\163\145\162\137\x65\155\141\151\x6c"])) {
            goto ls;
        }
        $this->setSessionAndStartOTPVerification($Jf["\165\163\x65\162\137\145\x6d\141\151\x6c"], $Jf["\x75\163\145\x72\x5f\145\155\x61\151\154"], NULL, VerificationType::EMAIL);
        goto Nr;
        ls:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_EMAIL), MoConstants::ERROR_JSON_TYPE));
        Nr:
    }
    function setSessionAndStartOTPVerification($Vf, $I4, $mF, $m5)
    {
        SessionUtils::setFormOrFieldId($this->_formSessionVar, $Vf);
        $this->sendChallenge('', $I4, NULL, $mF, $m5);
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VERIFICATION_FAILED, $m5);
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
        if (!($this->isFormEnabled() && $this->_otpType == $this->_typePhoneTag)) {
            goto jq;
        }
        $lP = array_merge($lP, $this->_phoneFormId);
        jq:
        return $lP;
    }
    function getFieldId($Jf)
    {
        global $wpdb;
        return $wpdb->get_var("\x53\105\x4c\x45\x43\x54\40\x69\x64\40\106\x52\117\115\40{$wpdb->prefix}\x6e\146\x33\x5f\x66\151\x65\154\144\163\40\x77\x68\x65\x72\145\40\x60\153\145\171\140\40\x3d\x27" . $Jf . "\47");
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto Qy;
        }
        return;
        Qy:
        if (!isset($_POST["\155\157\x5f\143\165\x73\164\157\x6d\145\x72\x5f\x76\141\154\151\144\x61\x74\151\157\x6e\x5f\156\151\x6e\152\141\137\x66\x6f\x72\x6d\137\145\156\x61\142\154\x65"])) {
            goto Ev;
        }
        return;
        Ev:
        $form = $this->parseFormDetails();
        $this->_formDetails = !empty($form) ? $form : '';
        $this->_otpType = $this->sanitizeFormPOST("\x6e\x6a\141\x5f\145\156\x61\142\154\145\137\x74\171\x70\145");
        $this->_isFormEnabled = $this->sanitizeFormPOST("\156\x6a\141\137\x65\x6e\x61\142\x6c\145");
        $this->_buttonText = $this->sanitizeFormPOST("\x6e\152\x61\x5f\x62\165\x74\164\157\156\137\164\145\170\164");
        update_mo_option("\x6e\151\x6e\152\x61\x5f\146\157\x72\155\x5f\x65\x6e\141\142\154\145", 0);
        update_mo_option("\x6e\152\141\137\x65\x6e\x61\x62\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\x6e\x69\156\x6a\141\x5f\x66\x6f\162\x6d\x5f\x65\x6e\x61\142\x6c\145\137\164\x79\x70\x65", $this->_otpType);
        update_mo_option("\156\x69\156\152\x61\137\146\x6f\x72\x6d\137\157\164\x70\x5f\145\156\x61\142\x6c\x65\x64", maybe_serialize($this->_formDetails));
    }
    function parseFormDetails()
    {
        $form = array();
        if (array_key_exists("\156\x69\x6e\152\141\137\141\152\x61\x78\137\146\x6f\162\155", $_POST)) {
            goto pr;
        }
        return array();
        pr:
        foreach (array_filter($_POST["\156\151\x6e\x6a\141\137\141\152\141\x78\x5f\x66\157\162\x6d"]["\146\157\x72\155"]) as $xl => $sA) {
            $form[$sA] = array("\145\155\141\151\154\x6b\145\171" => $this->getFieldId($_POST["\156\x69\156\x6a\141\137\x61\152\x61\170\137\x66\x6f\x72\x6d"]["\145\x6d\141\x69\x6c\x6b\145\x79"][$xl]), "\x70\150\x6f\x6e\145\153\x65\171" => $this->getFieldId($_POST["\156\x69\156\x6a\141\x5f\141\x6a\x61\170\137\146\x6f\162\x6d"]["\x70\150\x6f\x6e\145\153\145\x79"][$xl]), "\166\145\162\151\x66\x79\x4b\x65\171" => $this->getFieldId($_POST["\156\151\156\x6a\x61\x5f\141\x6a\141\x78\137\x66\x6f\162\x6d"]["\x76\145\162\151\146\171\113\x65\x79"][$xl]), "\x70\150\x6f\x6e\x65\137\163\x68\157\x77" => $_POST["\156\x69\156\152\141\x5f\x61\x6a\141\170\x5f\146\x6f\x72\155"]["\160\150\x6f\x6e\145\153\145\x79"][$xl], "\145\x6d\141\151\154\x5f\x73\x68\x6f\x77" => $_POST["\x6e\x69\x6e\152\x61\x5f\x61\x6a\x61\x78\x5f\146\x6f\162\155"]["\145\x6d\x61\x69\154\153\145\171"][$xl], "\x76\145\162\151\146\x79\137\163\150\x6f\167" => $_POST["\x6e\x69\156\x6a\x61\x5f\141\152\141\x78\x5f\146\x6f\x72\155"]["\x76\x65\162\x69\146\171\113\145\x79"][$xl]);
            Us:
        }
        dF:
        return $form;
    }
}
