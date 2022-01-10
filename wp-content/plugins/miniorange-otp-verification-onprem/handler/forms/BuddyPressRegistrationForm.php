<?php


namespace OTP\Handler\Forms;

use OTP\Handler\PhoneVerificationLogic;
use OTP\Helper\FormSessionVars;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\BaseMessages;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
use WP_Error;
use BP_Signup;
use WP_User;
class BuddyPressRegistrationForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = FALSE;
        $this->_formSessionVar = FormSessionVars::BUDDYPRESS_REG;
        $this->_typePhoneTag = "\155\x6f\137\142\142\160\137\160\150\157\x6e\145\x5f\145\156\x61\x62\x6c\x65";
        $this->_typeEmailTag = "\x6d\157\x5f\x62\x62\x70\137\x65\155\x61\x69\x6c\x5f\145\156\x61\x62\154\145";
        $this->_typeBothTag = "\x6d\x6f\x5f\x62\x62\x70\137\x62\157\164\x68\137\145\156\141\142\x6c\145\144";
        $this->_formKey = "\102\120\137\x44\x45\x46\x41\125\x4c\124\137\x46\117\122\115";
        $this->_formName = mo_("\102\x75\x64\144\171\120\x72\x65\163\163\40\122\145\147\x69\163\x74\x72\141\164\151\x6f\x6e\x20\x46\x6f\x72\155");
        $this->_isFormEnabled = get_mo_option("\x62\x62\160\137\x64\x65\x66\x61\x75\154\164\x5f\x65\x6e\x61\142\x6c\145");
        $this->_formDocuments = MoOTPDocs::BBP_FORM_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_phoneKey = get_mo_option("\x62\142\160\x5f\160\x68\157\x6e\x65\137\x6b\x65\171");
        $this->_otpType = get_mo_option("\x62\142\160\x5f\x65\156\141\142\x6c\x65\137\x74\x79\x70\145");
        $this->_disableAutoActivate = get_mo_option("\x62\142\160\x5f\x64\x69\163\x61\x62\x6c\145\x5f\141\x63\164\x69\166\141\x74\151\157\x6e");
        $this->_phoneFormId = "\x69\156\x70\x75\164\133\x6e\x61\155\x65\x3d\x66\151\x65\x6c\x64\x5f" . $this->moBBPgetphoneFieldId() . "\135";
        $this->_restrictDuplicates = get_mo_option("\142\x62\160\137\162\x65\x73\x74\x72\151\143\x74\x5f\144\x75\x70\x6c\x69\x63\141\x74\145\x73");
        add_filter("\x62\160\x5f\x72\145\x67\x69\x73\x74\x72\141\164\x69\157\x6e\x5f\x6e\145\145\x64\163\137\141\x63\x74\x69\x76\141\164\151\157\x6e", array($this, "\x66\151\x78\x5f\x73\151\x67\x6e\x75\160\x5f\146\157\x72\155\137\166\141\154\151\144\141\x74\x69\157\x6e\x5f\164\145\x78\x74"));
        add_filter("\x62\160\137\143\157\162\x65\137\163\151\x67\156\x75\x70\137\x73\145\x6e\144\x5f\141\x63\x74\x69\166\141\x74\151\157\x6e\x5f\153\145\171", array($this, "\144\151\x73\141\142\x6c\145\x5f\x61\143\164\x69\166\141\164\x69\x6f\x6e\137\145\155\x61\x69\154"));
        add_filter("\x62\x70\x5f\163\x69\147\x6e\x75\x70\137\x75\163\x65\x72\155\145\x74\x61", array($this, "\155\x69\156\x69\x6f\x72\x61\x6e\x67\145\x5f\x62\x70\x5f\x75\x73\145\x72\137\x72\x65\147\x69\163\x74\x72\x61\164\151\x6f\156"), 1, 1);
        add_action("\x62\x70\137\163\x69\x67\x6e\x75\160\137\x76\141\154\x69\144\x61\164\145", array($this, "\x76\x61\x6c\x69\x64\x61\x74\x65\x4f\124\x50\122\145\x71\165\145\163\164"), 99, 0);
        if (!$this->_disableAutoActivate) {
            goto MB;
        }
        add_action("\x62\160\137\143\157\x72\x65\137\x73\151\147\156\165\160\x5f\x75\163\145\162", array($this, "\x6d\x6f\x5f\x61\143\x74\x69\166\x61\164\145\x5f\x62\142\x70\137\x75\163\145\x72"), 1, 5);
        MB:
    }
    function fix_signup_form_validation_text()
    {
        return $this->_disableAutoActivate ? FALSE : TRUE;
    }
    function disable_activation_email()
    {
        return $this->_disableAutoActivate ? FALSE : TRUE;
    }
    function isPhoneVerificationEnabled()
    {
        $m5 = $this->getVerificationType();
        return $m5 === VerificationType::PHONE || $m5 === VerificationType::BOTH;
    }
    function validateOTPRequest()
    {
        global $bp, $phoneLogic;
        $vv = "\146\151\145\x6c\x64\137" . $this->moBBPgetphoneFieldId();
        if (isset($_POST[$vv]) && !MoUtility::validatePhoneNumber($_POST[$vv])) {
            goto mJ;
        }
        if (!$this->isPhoneNumberAlreadyInUse($_POST[$vv])) {
            goto Af;
        }
        $bp->signup->errors[$vv] = mo_("\120\x68\x6f\156\x65\40\156\x75\x6d\142\145\162\x20\141\154\x72\145\141\x64\171\x20\x69\156\40\165\x73\145\56\x20\120\154\145\141\x73\x65\x20\105\x6e\164\145\162\x20\141\x20\144\151\x66\x66\x65\x72\145\x6e\164\40\x50\x68\x6f\x6e\145\x20\156\x75\x6d\142\x65\162\56");
        Af:
        goto PL;
        mJ:
        $bp->signup->errors[$vv] = str_replace("\43\43\160\150\x6f\x6e\145\43\43", $_POST[$vv], $phoneLogic->_get_otp_invalid_format_message());
        PL:
    }
    function isPhoneNumberAlreadyInUse($lr)
    {
        if (!$this->_restrictDuplicates) {
            goto WV;
        }
        global $wpdb;
        $lr = MoUtility::processPhoneNumber($lr);
        $vv = $this->moBBPgetphoneFieldId();
        $D5 = $wpdb->get_row("\123\105\114\105\x43\124\x20\x60\x75\163\x65\162\x5f\151\144\x60\40\x46\x52\117\115\40\x60{$wpdb->prefix}\142\160\x5f\x78\x70\162\x6f\x66\x69\154\145\137\144\x61\164\141\140\x20\127\x48\x45\122\x45\x20\x60\x66\x69\x65\x6c\x64\x5f\151\x64\x60\40\x3d\x20\47{$vv}\x27\40\101\x4e\x44\x20\x60\166\x61\x6c\165\x65\x60\x20\x3d\40\x20\x27{$lr}\47");
        return !MoUtility::isBlank($D5);
        WV:
        return false;
    }
    function checkIfVerificationIsComplete()
    {
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $this->getVerificationType())) {
            goto MD;
        }
        $this->unsetOTPSessionVariables();
        return TRUE;
        MD:
        return FALSE;
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        $Jw = $this->getVerificationType();
        $aG = VerificationType::BOTH === $Jw ? TRUE : FALSE;
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), $Jw, $aG);
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
    }
    function miniorange_bp_user_registration($lF)
    {
        if (!$this->checkIfVerificationIsComplete()) {
            goto nP;
        }
        return $lF;
        nP:
        MoUtility::initialize_transaction($this->_formSessionVar);
        $errors = new WP_Error();
        $t2 = NULL;
        foreach ($_POST as $xl => $sA) {
            if ($xl === "\163\x69\x67\x6e\165\160\137\x75\x73\145\162\156\141\x6d\145") {
                goto XY;
            }
            if ($xl === "\x73\151\x67\156\x75\160\x5f\x65\x6d\x61\x69\154") {
                goto BF;
            }
            if ($xl === "\163\x69\x67\x6e\x75\x70\x5f\160\x61\163\163\167\157\x72\x64") {
                goto aR;
            }
            $SU[$xl] = $sA;
            goto Df;
            XY:
            $Iv = $sA;
            goto Df;
            BF:
            $xX = $sA;
            goto Df;
            aR:
            $wh = $sA;
            Df:
            n1:
        }
        YB:
        $e_ = $this->moBBPgetphoneFieldId();
        if (!isset($_POST["\x66\151\145\154\144\x5f" . $e_])) {
            goto Ls;
        }
        $t2 = $_POST["\146\151\x65\x6c\144\x5f" . $e_];
        Ls:
        $SU["\x75\163\145\x72\x6d\145\x74\x61"] = $lF;
        $this->startVerificationProcess($Iv, $xX, $errors, $t2, $wh, $SU);
        return $lF;
    }
    function startVerificationProcess($Iv, $xX, $errors, $t2, $wh, $SU)
    {
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) === 0) {
            goto GC;
        }
        if (strcasecmp($this->_otpType, $this->_typeBothTag) === 0) {
            goto AD;
        }
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::EMAIL, $wh, $SU);
        goto uY;
        AD:
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::BOTH, $wh, $SU);
        uY:
        goto hB;
        GC:
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::PHONE, $wh, $SU);
        hB:
    }
    function mo_activate_bbp_user($W1, $u0)
    {
        $kx = $this->moBBPgetActivationKey($u0);
        bp_core_activate_signup($kx);
        BP_Signup::validate($kx);
        $zP = new WP_User($W1);
        $zP->add_role("\x73\x75\x62\163\143\x72\x69\x62\x65\x72");
        return;
    }
    function moBBPgetActivationKey($u0)
    {
        global $wpdb;
        return $wpdb->get_var("\x53\x45\114\x45\103\124\40\x61\143\x74\x69\x76\x61\164\151\157\x6e\137\153\145\171\40\106\122\x4f\x4d\40{$wpdb->prefix}\x73\x69\x67\156\x75\x70\x73\x20\x57\x48\x45\122\105\40\141\143\164\151\166\145\x20\75\x20\x27\60\x27\x20\x41\x4e\104\x20\x75\163\x65\162\x5f\x6c\157\x67\151\x6e\40\x3d\40\x27" . $u0 . "\x27");
    }
    function moBBPgetphoneFieldId()
    {
        global $wpdb;
        return $wpdb->get_var("\123\105\x4c\x45\x43\124\40\151\x64\x20\106\x52\117\115\x20{$wpdb->prefix}\x62\x70\x5f\x78\x70\x72\157\x66\x69\154\x65\137\146\151\145\x6c\x64\x73\40\167\x68\x65\x72\145\40\156\141\155\x65\40\x3d\47" . $this->_phoneKey . "\47");
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_formSessionVar, $this->_txSessionId));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->isPhoneVerificationEnabled())) {
            goto Nw;
        }
        array_push($lP, $this->_phoneFormId);
        Nw:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto NX;
        }
        return;
        NX:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x62\x62\x70\137\144\x65\146\x61\165\154\164\137\145\x6e\141\x62\x6c\x65");
        $this->_disableAutoActivate = $this->sanitizeFormPOST("\x62\142\x70\x5f\144\x69\163\141\142\154\x65\137\x61\x63\x74\x69\166\141\164\151\157\x6e");
        $this->_otpType = $this->sanitizeFormPOST("\x62\x62\x70\x5f\145\156\141\x62\154\145\x5f\164\x79\x70\x65");
        $this->_phoneKey = $this->sanitizeFormPOST("\142\142\x70\x5f\160\150\157\156\145\x5f\x6b\145\x79");
        $this->_restrictDuplicates = $this->sanitizeFormPOST("\142\142\160\137\x72\x65\163\x74\x72\151\x63\x74\137\x64\x75\x70\154\151\x63\141\x74\x65\x73");
        if (!$this->basicValidationCheck(BaseMessages::BP_CHOOSE)) {
            goto cN;
        }
        update_mo_option("\142\142\160\137\144\x65\x66\141\165\x6c\164\x5f\x65\x6e\x61\x62\154\145", $this->_isFormEnabled);
        update_mo_option("\142\x62\x70\137\144\x69\x73\141\142\x6c\145\x5f\x61\x63\164\x69\166\141\164\x69\157\x6e", $this->_disableAutoActivate);
        update_mo_option("\142\x62\x70\x5f\145\x6e\x61\142\154\x65\x5f\x74\x79\160\x65", $this->_otpType);
        update_mo_option("\x62\142\x70\x5f\x72\145\163\164\x72\151\143\164\x5f\144\x75\160\x6c\151\x63\141\x74\145\163", $this->_restrictDuplicates);
        update_mo_option("\142\x62\x70\137\160\150\x6f\x6e\x65\137\x6b\145\x79", $this->_phoneKey);
        cN:
    }
}
