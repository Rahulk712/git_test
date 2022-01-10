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
class WpMemberForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::WPMEMBER_REG;
        $this->_emailKey = "\165\x73\x65\162\x5f\x65\155\141\151\154";
        $this->_phoneKey = get_mo_option("\167\160\x5f\155\145\155\x62\145\162\137\162\x65\147\x5f\160\x68\157\x6e\x65\137\146\x69\145\154\x64\x5f\153\x65\171");
        $this->_phoneFormId = "\x69\156\x70\x75\x74\x5b\x6e\141\155\x65\75{$this->_phoneKey}\135";
        $this->_formKey = "\x57\x50\137\115\x45\x4d\102\105\122\137\x46\117\x52\115";
        $this->_typePhoneTag = "\x6d\157\x5f\x77\x70\x6d\x65\x6d\142\x65\162\x5f\162\145\x67\137\160\x68\157\156\145\x5f\145\156\x61\x62\x6c\145";
        $this->_typeEmailTag = "\x6d\157\137\x77\x70\x6d\x65\155\142\145\x72\137\162\x65\x67\137\145\x6d\x61\151\154\x5f\145\x6e\141\x62\x6c\x65";
        $this->_formName = mo_("\x57\x50\55\115\145\155\x62\x65\162\163");
        $this->_isFormEnabled = get_mo_option("\x77\x70\137\x6d\145\155\x62\x65\x72\x5f\x72\145\147\137\145\x6e\x61\x62\154\x65");
        $this->_formDocuments = MoOTPDocs::WP_MEMBER_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x77\160\x5f\x6d\145\x6d\142\145\x72\x5f\x72\x65\147\x5f\145\x6e\141\142\x6c\x65\x5f\x74\171\160\x65");
        add_filter("\x77\x70\x6d\145\155\x5f\162\145\x67\x69\x73\x74\145\x72\x5f\146\x6f\162\x6d\x5f\162\157\167\x73", array($this, "\167\160\x6d\x65\x6d\x62\145\162\x5f\141\144\x64\x5f\x62\165\x74\164\157\156"), 99, 2);
        add_action("\x77\160\155\x65\155\x5f\160\x72\x65\137\x72\145\x67\x69\163\164\x65\x72\137\x64\141\x74\x61", array($this, "\166\x61\154\x69\x64\141\164\x65\x5f\x77\160\155\x65\x6d\142\x65\162\x5f\x73\165\x62\155\151\164"), 99, 1);
        $this->routeData();
    }
    function routeData()
    {
        if (array_key_exists("\x6f\160\x74\x69\157\156", $_REQUEST)) {
            goto zT;
        }
        return;
        zT:
        switch (trim($_REQUEST["\157\160\164\151\157\156"])) {
            case "\x6d\151\x6e\151\x6f\162\141\x6e\x67\x65\x2d\167\x70\155\145\155\142\x65\x72\x2d\x66\157\x72\155":
                $this->_handle_wp_member_form($_POST);
                goto nR;
        }
        UZ:
        nR:
    }
    function _handle_wp_member_form($Jf)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (!($this->_otpType === $this->_typeEmailTag)) {
            goto vT;
        }
        $this->processEmailAndStartOTPVerificationProcess($Jf);
        vT:
        if (!($this->_otpType === $this->_typePhoneTag)) {
            goto Sf;
        }
        $this->processPhoneAndStartOTPVerificationProcess($Jf);
        Sf:
    }
    function processEmailAndStartOTPVerificationProcess($Jf)
    {
        if (MoUtility::sanitizeCheck("\165\x73\x65\162\137\145\155\141\151\x6c", $Jf)) {
            goto EI;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_EMAIL), MoConstants::ERROR_JSON_TYPE));
        goto Zu;
        EI:
        SessionUtils::addEmailVerified($this->_formSessionVar, $Jf["\165\163\145\x72\x5f\x65\x6d\141\151\x6c"]);
        $this->sendChallenge(null, $Jf["\165\x73\x65\x72\x5f\x65\155\141\x69\x6c"], null, '', VerificationType::EMAIL, null, null, false);
        Zu:
    }
    function processPhoneAndStartOTPVerificationProcess($Jf)
    {
        if (MoUtility::sanitizeCheck("\165\163\145\x72\137\x70\150\157\156\x65", $Jf)) {
            goto ba;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::ENTER_PHONE), MoConstants::ERROR_JSON_TYPE));
        goto vB;
        ba:
        SessionUtils::addPhoneVerified($this->_formSessionVar, $Jf["\x75\x73\145\x72\x5f\160\x68\157\x6e\x65"]);
        $this->sendChallenge(null, '', null, $Jf["\165\x73\145\162\137\x70\150\x6f\x6e\x65"], VerificationType::PHONE, null, null, false);
        vB:
    }
    function wpmember_add_button($gl, $sm)
    {
        foreach ($gl as $xl => $uG) {
            if (strcasecmp($this->_otpType, $this->_typePhoneTag) === 0 && $xl === $this->_phoneKey) {
                goto fU;
            }
            if (!(strcasecmp($this->_otpType, $this->_typeEmailTag) === 0 && $xl === $this->_emailKey)) {
                goto lk;
            }
            $gl[$xl]["\x66\151\x65\x6c\x64"] .= $this->_add_shortcode_to_wpmember("\x65\155\141\x69\x6c", $uG["\155\145\164\141"]);
            goto zN;
            lk:
            goto Ck;
            fU:
            $gl[$xl]["\x66\x69\145\154\144"] .= $this->_add_shortcode_to_wpmember("\x70\150\x6f\156\x65", $uG["\155\x65\x74\141"]);
            goto zN;
            Ck:
            i3:
        }
        zN:
        return $gl;
    }
    function validate_wpmember_submit($TH)
    {
        global $wpmem_themsg;
        $m5 = $this->getVerificationType();
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto w4;
        }
        $wpmem_themsg = MoMessages::showMessage(MoMessages::PLEASE_VALIDATE);
        w4:
        if ($this->validate_submitted($TH, $m5)) {
            goto GP;
        }
        return;
        GP:
        $this->validateChallenge($m5, NULL, $TH["\166\x61\154\151\144\x61\164\145\137\x6f\164\160"]);
    }
    function validate_submitted($TH, $m5)
    {
        global $wpmem_themsg;
        if ($m5 === VerificationType::EMAIL && !SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $TH[$this->_emailKey])) {
            goto GI;
        }
        if ($m5 == VerificationType::PHONE && !SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $TH[$this->_phoneKey])) {
            goto k0;
        }
        return true;
        goto D0;
        k0:
        $wpmem_themsg = MoMessages::showMessage(MoMessages::PHONE_MISMATCH);
        return false;
        D0:
        goto pg;
        GI:
        $wpmem_themsg = MoMessages::showMessage(MoMessages::EMAIL_MISMATCH);
        return false;
        pg:
    }
    function _add_shortcode_to_wpmember($mq, $uG)
    {
        $Mt = "\x3c\144\x69\x76\x20\163\x74\x79\154\x65\x3d\47\144\151\163\x70\154\x61\x79\72\164\141\142\x6c\145\73\164\x65\170\x74\x2d\141\154\151\147\x6e\72\x63\x65\156\164\x65\162\73\47\x3e\74\x69\x6d\147\40\163\162\143\x3d\x27" . MOV_URL . "\151\x6e\x63\154\x75\144\x65\x73\57\x69\x6d\x61\x67\145\x73\x2f\154\157\x61\144\145\x72\x2e\147\151\146\x27\76\74\57\144\x69\166\76";
        $W8 = "\74\144\x69\166\40\163\x74\171\154\x65\x3d\47\155\141\x72\147\x69\x6e\55\164\x6f\x70\72\40\62\45\x3b\47\76\74\x62\165\x74\164\157\156\40\164\171\160\145\75\x27\142\165\164\164\x6f\x6e\x27\40\143\x6c\x61\163\163\x3d\x27\142\165\164\x74\x6f\156\40\141\x6c\x74\47\x20\x73\164\171\x6c\145\x3d\x27\167\151\x64\x74\150\x3a\x31\x30\x30\x25\x3b\x68\145\x69\147\150\x74\x3a\63\x30\x70\170\x3b";
        $W8 .= "\146\157\156\164\55\x66\141\x6d\151\x6c\x79\x3a\40\122\x6f\x62\157\164\157\x3b\x66\157\x6e\x74\55\x73\x69\x7a\x65\72\x20\x31\x32\x70\170\x20\41\151\x6d\x70\157\x72\x74\x61\x6e\164\x3b\x27\x20\x69\x64\x3d\x27\155\151\x6e\x69\x6f\x72\141\x6e\x67\145\x5f\x6f\164\x70\x5f\x74\x6f\153\145\156\x5f\163\165\x62\x6d\x69\164\x27\40";
        $W8 .= "\164\151\x74\154\x65\x3d\x27\x50\x6c\x65\141\x73\145\40\x45\156\x74\x65\162\40\141\156\40\x27" . $mq . "\x27\x74\157\40\145\x6e\x61\x62\154\145\40\x74\150\151\x73\x2e\47\76\103\x6c\x69\143\153\x20\x48\x65\162\145\40\164\x6f\x20\x56\x65\x72\x69\146\x79\40" . $mq . "\x3c\x2f\142\165\x74\164\x6f\156\x3e\x3c\x2f\144\151\x76\x3e";
        $W8 .= "\74\x64\x69\x76\x20\x73\164\171\154\145\75\47\x6d\141\162\x67\151\156\x2d\x74\x6f\x70\72\x32\x25\x27\76\x3c\144\x69\x76\x20\151\x64\x3d\x27\155\x6f\x5f\155\x65\x73\x73\x61\x67\145\x27\40\x68\151\x64\x64\145\x6e\75\x27\x27\x20\x73\x74\171\154\145\x3d\47\142\x61\x63\153\147\162\157\165\x6e\x64\x2d\x63\x6f\x6c\x6f\162\72\40\43\146\x37\146\x36\146\x37\x3b\x70\x61\144\144\x69\156\x67\x3a\x20";
        $W8 .= "\61\x65\x6d\40\62\145\155\40\61\x65\155\40\63\x2e\x35\x65\x6d\73\x27\76\x3c\x2f\x64\x69\166\76\x3c\57\144\x69\166\76";
        $W8 .= "\74\163\143\x72\151\160\164\x3e\152\121\165\145\162\x79\x28\x64\157\x63\x75\155\145\156\x74\x29\56\162\145\141\x64\171\x28\x66\165\156\143\x74\x69\157\x6e\x28\51\173\44\x6d\x6f\x3d\152\121\165\x65\x72\x79\73\44\155\x6f\50\x22\x23\155\x69\156\x69\157\x72\x61\156\147\x65\x5f\x6f\x74\x70\x5f\164\x6f\153\x65\x6e\137\x73\x75\x62\155\x69\x74\42\51\x2e\x63\x6c\151\143\x6b\50\146\165\156\x63\x74\x69\x6f\x6e\x28\x6f\51\x7b\40";
        $W8 .= "\166\141\162\40\x65\75\44\155\157\x28\42\151\156\x70\165\x74\x5b\156\141\x6d\145\x3d" . $uG . "\x5d\x22\x29\x2e\166\141\x6c\x28\x29\x3b\x20\x24\x6d\x6f\x28\x22\43\155\157\137\155\145\x73\x73\x61\x67\x65\x22\51\x2e\145\x6d\x70\164\x79\50\x29\54\x24\x6d\x6f\50\x22\43\155\x6f\137\x6d\x65\163\163\x61\147\x65\42\x29\x2e\141\160\160\x65\156\144\x28\x22" . $Mt . "\42\51\54";
        $W8 .= "\x24\x6d\157\50\x22\43\x6d\157\x5f\155\145\163\163\x61\147\145\42\x29\56\163\x68\x6f\x77\x28\x29\54\x24\x6d\x6f\x2e\141\x6a\x61\x78\x28\173\165\x72\x6c\x3a\x22" . site_url() . "\57\x3f\x6f\x70\164\x69\x6f\x6e\x3d\x6d\x69\156\151\157\162\141\x6e\x67\145\55\x77\x70\155\145\155\x62\x65\x72\x2d\x66\157\x72\x6d\42\54\164\171\160\x65\72\x22\x50\x4f\123\124\x22\x2c";
        $W8 .= "\144\141\x74\141\x3a\173\165\x73\145\162\137" . $mq . "\72\x65\175\54\143\162\157\163\163\x44\x6f\x6d\141\x69\x6e\x3a\x21\60\x2c\144\x61\164\x61\x54\171\x70\x65\x3a\42\x6a\x73\x6f\156\x22\54\x73\x75\x63\x63\x65\163\163\x3a\x66\x75\156\x63\x74\x69\157\x6e\x28\157\x29\173\x20";
        $W8 .= "\151\146\50\x6f\x2e\162\x65\163\x75\x6c\x74\x3d\75\x3d\42\163\165\143\143\x65\x73\x73\x22\51\x7b\44\155\x6f\x28\42\x23\x6d\x6f\137\155\145\163\x73\x61\x67\145\x22\51\56\145\x6d\160\x74\171\50\51\x2c\44\x6d\x6f\50\x22\43\x6d\157\137\155\145\x73\163\141\x67\145\42\x29\x2e\141\160\x70\145\x6e\x64\x28\157\56\155\x65\x73\x73\x61\147\145\51\54";
        $W8 .= "\x24\155\x6f\x28\42\43\x6d\x6f\x5f\x6d\145\163\163\141\147\x65\42\x29\x2e\x63\163\x73\50\42\x62\157\x72\x64\145\162\x2d\x74\x6f\160\42\x2c\x22\x33\160\170\x20\163\157\x6c\x69\x64\x20\147\162\145\x65\156\x22\51\54\44\x6d\157\x28\42\151\156\160\165\164\133\x6e\x61\155\x65\75\145\155\x61\x69\154\x5f\x76\x65\162\151\146\171\x5d\42\51\56\x66\157\x63\x75\x73\50\51\x7d\145\154\x73\x65\173";
        $W8 .= "\x24\155\157\50\x22\x23\x6d\x6f\137\x6d\145\x73\163\141\147\145\x22\x29\x2e\145\155\160\164\171\x28\51\54\44\155\x6f\50\42\43\x6d\x6f\137\x6d\145\x73\x73\x61\147\145\42\51\56\141\160\x70\145\156\x64\50\157\56\x6d\x65\163\x73\x61\x67\145\x29\54\x24\x6d\157\x28\42\43\x6d\x6f\x5f\x6d\x65\163\163\141\147\145\x22\x29\56\143\163\x73\50\x22\x62\157\162\x64\145\162\55\164\x6f\x70\42\x2c\42\63\160\170\x20\163\157\154\151\144\40\162\145\x64\42\51";
        $W8 .= "\54\44\x6d\x6f\50\42\151\x6e\x70\165\x74\133\156\x61\155\145\75\160\x68\157\156\x65\137\166\x65\x72\151\x66\x79\x5d\x22\51\x2e\x66\x6f\x63\x75\x73\x28\x29\x7d\40\73\175\54\x65\162\x72\x6f\x72\72\x66\165\x6e\x63\x74\x69\157\x6e\50\157\x2c\145\x2c\156\x29\x7b\175\175\51\175\51\x3b\175\x29\73\x3c\x2f\163\143\162\151\x70\164\x3e";
        return $W8;
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        global $wpmem_themsg;
        $wpmem_themsg = MoUtility::_get_invalid_otp_method();
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
            goto N1;
        }
        array_push($lP, $this->_phoneFormId);
        N1:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto US;
        }
        return;
        US:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x77\160\137\155\145\155\x62\x65\162\x5f\x72\x65\147\x5f\x65\156\141\x62\154\x65");
        $this->_otpType = $this->sanitizeFormPOST("\167\160\137\155\145\155\x62\x65\162\137\x72\x65\x67\137\145\x6e\141\x62\x6c\x65\137\x74\x79\160\145");
        $this->_phoneKey = $this->sanitizeFormPOST("\167\x70\137\155\145\155\x62\145\162\x5f\x72\x65\147\x5f\x70\x68\157\x6e\x65\137\x66\151\145\x6c\144\x5f\153\145\171");
        if (!$this->basicValidationCheck(BaseMessages::WP_MEMBER_CHOOSE)) {
            goto N5;
        }
        update_mo_option("\x77\160\137\x6d\145\155\x62\145\162\137\162\145\147\x5f\x70\150\x6f\156\145\137\146\x69\x65\154\x64\x5f\x6b\145\x79", $this->_phoneKey);
        update_mo_option("\x77\x70\x5f\x6d\145\x6d\142\x65\x72\x5f\162\x65\x67\137\x65\x6e\x61\142\154\x65", $this->_isFormEnabled);
        update_mo_option("\x77\160\x5f\155\145\x6d\x62\x65\162\137\x72\145\x67\137\145\x6e\x61\x62\x6c\x65\x5f\x74\x79\x70\145", $this->_otpType);
        N5:
    }
}
