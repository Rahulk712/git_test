<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoPHPSessions;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationLogic;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
class UserProfileMadeEasyRegistrationForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::UPME_REG;
        $this->_typePhoneTag = "\x6d\x6f\137\165\160\155\145\x5f\x70\x68\x6f\156\x65\x5f\x65\156\x61\x62\x6c\x65";
        $this->_typeEmailTag = "\155\157\137\165\x70\155\x65\x5f\x65\x6d\x61\151\x6c\x5f\x65\156\141\142\x6c\x65";
        $this->_typeBothTag = "\155\157\137\x75\x70\155\145\137\x62\157\164\x68\137\x65\156\141\142\x6c\145";
        $this->_formKey = "\x55\x50\x4d\105\x5f\x46\x4f\122\115";
        $this->_formName = mo_("\125\x73\x65\x72\120\162\157\x66\x69\x6c\145\x20\x4d\x61\x64\145\x20\105\141\x73\171\x20\x52\x65\x67\x69\x73\x74\x72\141\x74\151\x6f\156\x20\x46\157\x72\155");
        $this->_isFormEnabled = get_mo_option("\x75\160\x6d\x65\137\144\145\x66\x61\x75\154\164\x5f\x65\x6e\x61\x62\154\145");
        $this->_formDocuments = MoOTPDocs::UPME_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x75\x70\x6d\145\137\145\156\141\x62\x6c\x65\x5f\x74\x79\160\x65");
        $this->_phoneKey = get_mo_option("\165\x70\x6d\145\x5f\160\150\157\156\145\137\x6b\x65\x79");
        $this->_phoneFormId = "\151\156\160\x75\164\x5b\x6e\x61\155\145\x3d" . $this->_phoneKey . "\135";
        add_filter("\151\156\x73\x65\x72\x74\137\165\163\x65\x72\x5f\x6d\x65\164\141", array($this, "\155\x69\x6e\x69\157\162\x61\x6e\147\145\x5f\x75\160\x6d\x65\x5f\151\156\163\145\x72\x74\x5f\165\163\x65\162"), 1, 3);
        add_filter("\x75\x70\x6d\145\x5f\x72\x65\147\151\x73\x74\x72\141\x74\151\x6f\x6e\137\143\x75\x73\x74\157\x6d\x5f\x66\151\145\154\x64\x5f\164\x79\x70\145\137\162\145\x73\164\x72\x69\x63\x74\x69\x6f\x6e\163", array($this, "\155\151\x6e\x69\157\162\141\156\x67\x65\137\x75\x70\155\145\x5f\143\150\145\x63\x6b\137\160\150\157\156\145"), 1, 2);
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $this->getVerificationType())) {
            goto z5;
        }
        if (array_key_exists("\165\x70\x6d\x65\55\x72\145\147\x69\163\164\x65\x72\55\x66\x6f\x72\155", $_POST) && !SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto ud;
        }
        goto r0;
        z5:
        $this->unsetOTPSessionVariables();
        goto r0;
        ud:
        $this->_handle_upme_form_submit($_POST);
        r0:
    }
    function isPhoneVerificationEnabled()
    {
        $Jw = $this->getVerificationType();
        return $Jw === VerificationType::PHONE || $Jw === VerificationType::BOTH;
    }
    function _handle_upme_form_submit($Yb)
    {
        $m6 = '';
        foreach ($Yb as $xl => $sA) {
            if (!($xl == $this->_phoneKey)) {
                goto RE;
            }
            $m6 = $sA;
            goto wD;
            RE:
            DH:
        }
        wD:
        $this->miniorange_upme_user($_POST["\x75\163\x65\162\x5f\x6c\157\147\x69\x6e"], $_POST["\165\x73\145\x72\x5f\145\x6d\141\x69\154"], $m6);
    }
    function miniorange_upme_insert_user($Fy, $user, $q8)
    {
        $ew = MoPHPSessions::getSessionVar("\x66\x69\154\x65\x5f\165\160\x6c\157\141\144");
        if (!(!SessionUtils::isOTPInitialized($this->_formSessionVar) || !$ew)) {
            goto hX;
        }
        return $Fy;
        hX:
        foreach ($ew as $xl => $sA) {
            $NV = get_user_meta($user->ID, $xl, true);
            if (!('' != $NV)) {
                goto VR;
            }
            upme_delete_uploads_folder_files($NV);
            VR:
            update_user_meta($user->ID, $xl, $sA);
            fu:
        }
        kD:
        return $Fy;
    }
    function miniorange_upme_check_phone($errors, $TH)
    {
        global $phoneLogic;
        if (!empty($errors)) {
            goto Be;
        }
        if (!($TH["\x6d\145\x74\x61"] == $this->_phoneKey)) {
            goto w2;
        }
        if (MoUtility::validatePhoneNumber($TH["\x76\x61\154\165\145"])) {
            goto sz;
        }
        $errors[] = str_replace("\43\43\x70\x68\157\156\145\43\x23", $TH["\166\x61\x6c\x75\145"], $phoneLogic->_get_otp_invalid_format_message());
        sz:
        w2:
        Be:
        return $errors;
    }
    function miniorange_upme_user($s4, $Kc, $t2)
    {
        global $upme_register;
        $upme_register->prepare($_POST);
        $upme_register->handle();
        $ew = array();
        if (MoUtility::isBlank($upme_register->errors)) {
            goto gy;
        }
        return;
        gy:
        MoUtility::initialize_transaction($this->_formSessionVar);
        $this->processFileUpload($ew);
        MoPHPSessions::addSessionVar("\146\151\x6c\145\137\165\x70\154\157\141\x64", $ew);
        $this->processAndStartOTPVerification($s4, $Kc, $t2);
    }
    function processFileUpload(&$ew)
    {
        if (!empty($_FILES)) {
            goto r5;
        }
        return;
        r5:
        $Qk = wp_upload_dir();
        $yV = $Qk["\142\x61\x73\145\x64\x69\x72"] . "\x2f\x75\160\155\x65\57";
        if (is_dir($yV)) {
            goto th;
        }
        mkdir($yV, 511);
        th:
        foreach ($_FILES as $xl => $W6) {
            $Xp = sanitize_file_name(basename($W6["\x6e\x61\155\x65"]));
            $yV = $yV . time() . "\137" . $Xp;
            $jp = $Qk["\142\x61\x73\x65\x75\x72\154"] . "\x2f\x75\x70\x6d\x65\x2f";
            $jp = $jp . time() . "\x5f" . $Xp;
            move_uploaded_file($W6["\164\155\160\137\156\141\155\145"], $yV);
            $ew[$xl] = $jp;
            ou:
        }
        e4:
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->isPhoneVerificationEnabled())) {
            goto Wl;
        }
        array_push($lP, $this->_phoneFormId);
        Wl:
        return $lP;
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        $Jw = $this->getVerificationType();
        $aG = $Jw === VerificationType::BOTH ? TRUE : FALSE;
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $Jw, $aG);
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
    }
    function processAndStartOTPVerification($s4, $Kc, $t2)
    {
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto sP;
        }
        if (strcasecmp($this->_otpType, $this->_typeBothTag) == 0) {
            goto Ap;
        }
        $this->sendChallenge($s4, $Kc, null, $t2, VerificationType::EMAIL);
        goto Tl;
        Ap:
        $this->sendChallenge($s4, $Kc, null, $t2, VerificationType::BOTH);
        Tl:
        goto Uf;
        sP:
        $this->sendChallenge($s4, $Kc, null, $t2, VerificationType::PHONE);
        Uf:
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto Cq;
        }
        return;
        Cq:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\165\160\155\145\x5f\144\x65\x66\141\x75\154\164\137\x65\x6e\x61\x62\x6c\145");
        $this->_otpType = $this->sanitizeFormPOST("\165\x70\155\145\x5f\145\156\x61\x62\x6c\145\137\x74\x79\x70\x65");
        $this->_phoneKey = $this->sanitizeFormPOST("\165\160\x6d\x65\137\x70\x68\x6f\156\x65\x5f\x66\151\x65\x6c\144\x5f\x6b\145\171");
        update_mo_option("\165\160\x6d\145\x5f\x64\x65\x66\x61\x75\x6c\164\137\145\156\x61\x62\x6c\145", $this->_isFormEnabled);
        update_mo_option("\165\x70\155\x65\x5f\x65\156\141\142\154\145\x5f\x74\171\x70\x65", $this->_otpType);
        update_mo_option("\x75\x70\155\x65\137\x70\x68\157\156\145\137\x6b\145\171", $this->_phoneKey);
    }
}
