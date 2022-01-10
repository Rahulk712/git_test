<?php


namespace OTP\Handler\Forms;

use mysql_xdevapi\Session;
use OTP\Helper\FormSessionVars;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationLogic;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
use stdClass;
class SimplrRegistrationForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::SIMPLR_REG;
        $this->_typePhoneTag = "\x6d\157\x5f\160\150\x6f\156\145\137\x65\156\141\x62\x6c\145";
        $this->_typeEmailTag = "\x6d\157\137\x65\155\141\151\x6c\137\x65\x6e\x61\142\154\x65";
        $this->_typeBothTag = "\155\157\x5f\x62\157\164\150\137\x65\156\141\x62\154\x65";
        $this->_formKey = "\x53\x49\115\120\x4c\x52\x5f\x46\117\x52\x4d";
        $this->_formName = mo_("\x53\x69\155\x70\x6c\x72\x20\125\163\145\x72\40\122\x65\147\x69\163\x74\x72\141\164\151\x6f\x6e\40\106\157\162\x6d\40\x50\x6c\165\163");
        $this->_isFormEnabled = get_mo_option("\x73\x69\155\x70\x6c\x72\137\x64\145\146\x61\x75\154\164\x5f\145\156\x61\142\154\x65");
        $this->_formDocuments = MoOTPDocs::SIMPLR_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_formKey = get_mo_option("\x73\151\x6d\x70\154\162\137\x66\151\x65\x6c\x64\137\153\145\x79");
        $this->_otpType = get_mo_option("\163\151\155\160\x6c\162\137\x65\156\x61\x62\x6c\145\x5f\164\x79\160\145");
        $this->_phoneFormId = "\x69\156\x70\x75\x74\x5b\x6e\141\155\145\x3d" . $this->_formKey . "\135";
        add_filter("\x73\151\155\160\x6c\x72\137\x76\x61\x6c\151\144\x61\164\145\137\x66\x6f\x72\x6d", array($this, "\x73\x69\x6d\160\x6c\162\137\x73\x69\164\x65\x5f\162\145\x67\x69\163\x74\x72\x61\164\x69\x6f\156\x5f\x65\x72\x72\x6f\x72\x73"), 10, 1);
    }
    function isPhoneVerificationEnabled()
    {
        $Jw = $this->getVerificationType();
        return $Jw === VerificationType::PHONE || $Jw === VerificationType::BOTH;
    }
    function simplr_site_registration_errors($errors)
    {
        $wh = $t2 = '';
        if (!(!empty($errors) || isset($_POST["\146\x62\165\x73\x65\162\x5f\x69\x64"]))) {
            goto NU;
        }
        return $errors;
        NU:
        foreach ($_POST as $xl => $sA) {
            if ($xl == "\x75\x73\145\162\x6e\141\155\145") {
                goto Ll;
            }
            if ($xl == "\x65\x6d\141\151\x6c") {
                goto IM;
            }
            if ($xl == "\x70\x61\x73\x73\167\157\162\144") {
                goto i4;
            }
            if ($xl == $this->_formKey) {
                goto xH;
            }
            $SU[$xl] = $sA;
            goto ht;
            Ll:
            $Iv = $sA;
            goto ht;
            IM:
            $xX = $sA;
            goto ht;
            i4:
            $wh = $sA;
            goto ht;
            xH:
            $t2 = $sA;
            ht:
            oY:
        }
        cO:
        if (!(strcasecmp($this->_otpType, $this->_typePhoneTag) == 0 && !$this->processPhone($t2, $errors))) {
            goto cv;
        }
        return $errors;
        cv:
        $this->processAndStartOTPVerificationProcess($Iv, $xX, $errors, $t2, $wh, $SU);
        return $errors;
    }
    function processPhone($t2, &$errors)
    {
        if (MoUtility::validatePhoneNumber($t2)) {
            goto TD;
        }
        global $phoneLogic;
        $errors[] .= str_replace("\43\43\x70\150\x6f\x6e\145\43\x23", $t2, $phoneLogic->_get_otp_invalid_format_message());
        add_filter($this->_formKey . "\137\145\x72\x72\x6f\x72\x5f\143\x6c\141\x73\163", "\x5f\x73\x72\x65\x67\x5f\x72\x65\x74\x75\162\x6e\137\x65\162\162\x6f\x72");
        return FALSE;
        TD:
        return TRUE;
    }
    function processAndStartOTPVerificationProcess($Iv, $xX, $errors, $t2, $wh, $SU)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto e5;
        }
        if (strcasecmp($this->_otpType, $this->_typeBothTag) == 0) {
            goto dO1;
        }
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::EMAIL, $wh, $SU);
        goto Aa;
        dO1:
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::BOTH, $wh, $SU);
        Aa:
        goto Lt;
        e5:
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::PHONE, $wh, $SU);
        Lt:
    }
    function register_simplr_user($u0, $Kc, $wh, $t2, $SU)
    {
        $Jf = array();
        global $sreg;
        if ($sreg) {
            goto v1;
        }
        $sreg = new stdClass();
        v1:
        $Jf["\165\163\x65\x72\x6e\x61\155\145"] = $u0;
        $Jf["\x65\155\141\151\154"] = $Kc;
        $Jf["\160\x61\x73\x73\167\157\162\x64"] = $wh;
        if (!$this->_formKey) {
            goto fE;
        }
        $Jf[$this->_formKey] = $t2;
        fE:
        $Jf = array_merge($Jf, $SU);
        $no = $SU["\x61\164\x74\x73"];
        $sreg->output = simplr_setup_user($no, $Jf);
        if (!MoUtility::isBlank($sreg->errors)) {
            goto Z9;
        }
        $this->checkMessageAndRedirect($no);
        Z9:
    }
    function checkMessageAndRedirect($no)
    {
        global $sreg, $simplr_options;
        $X5 = isset($no["\x74\150\141\x6e\x6b\x73"]) ? get_permalink($no["\164\x68\141\156\x6b\x73"]) : (!MoUtility::isBlank($simplr_options->thank_you) ? get_permalink($simplr_options->thank_you) : '');
        if (MoUtility::isBlank($X5)) {
            goto Bd;
        }
        wp_redirect($X5);
        die;
        goto mU;
        Bd:
        $sreg->success = $sreg->output;
        mU:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto PY;
        }
        return;
        PY:
        $Jw = $this->getVerificationType();
        $aG = $Jw === VerificationType::BOTH ? TRUE : FALSE;
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $Jw, $aG);
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        $this->unsetOTPSessionVariables();
        $this->register_simplr_user($u0, $Kc, $wh, $t2, $SU);
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->isPhoneVerificationEnabled())) {
            goto oD;
        }
        array_push($lP, $this->_phoneFormId);
        oD:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto iR;
        }
        return;
        iR:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x73\151\155\160\154\162\x5f\x64\145\146\x61\x75\154\x74\x5f\x65\156\141\x62\x6c\145");
        $this->_otpType = $this->sanitizeFormPOST("\x73\151\x6d\x70\154\x72\137\145\156\141\x62\154\x65\x5f\x74\x79\160\145");
        $this->_phoneKey = $this->sanitizeFormPOST("\163\x69\155\x70\154\162\137\x70\150\157\x6e\145\137\146\151\x65\154\x64\x5f\x6b\x65\171");
        update_mo_option("\163\x69\x6d\x70\154\x72\137\x64\145\146\x61\165\x6c\x74\x5f\x65\x6e\x61\x62\154\145", $this->_isFormEnabled);
        update_mo_option("\163\151\x6d\160\x6c\x72\x5f\x65\x6e\x61\x62\x6c\x65\x5f\x74\x79\160\x65", $this->_otpType);
        update_mo_option("\x73\x69\x6d\x70\x6c\x72\137\146\151\145\x6c\144\137\x6b\145\x79", $this->_phoneKey);
    }
}
