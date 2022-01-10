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
use OTP\Objects\VerificationLogic;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
use UM\Core\Form;
class UltimateMemberProfileForm extends FormHandler implements IFormHandler
{
    use Instance;
    private $_verifyFieldKey;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::UM_PROFILE_UPDATE;
        $this->_typePhoneTag = "\x6d\x6f\x5f\165\155\137\160\x72\157\146\151\154\x65\x5f\160\150\157\x6e\145\x5f\145\156\141\142\154\x65";
        $this->_typeEmailTag = "\x6d\x6f\x5f\165\155\x5f\x70\162\157\146\x69\x6c\145\x5f\145\155\141\x69\x6c\137\x65\x6e\x61\142\154\145";
        $this->_typeBothTag = "\155\x6f\x5f\x75\155\137\x70\x72\x6f\x66\151\154\x65\x5f\x62\157\164\x68\137\x65\x6e\x61\x62\154\145";
        $this->_formKey = "\125\114\124\x49\115\101\x54\105\137\x50\122\117\106\111\x4c\105\x5f\x46\x4f\122\115";
        $this->_verifyFieldKey = "\x76\145\162\x69\146\x79\137\x66\x69\x65\154\144";
        $this->_formName = mo_("\x55\154\x74\x69\x6d\141\164\145\x20\115\x65\x6d\x62\145\x72\x20\x50\x72\x6f\146\151\154\145\57\101\143\143\x6f\165\x6e\164\40\x46\157\162\155");
        $this->_isFormEnabled = get_mo_option("\165\x6d\137\160\x72\x6f\x66\151\x6c\x65\137\x65\156\141\142\154\x65");
        $this->_restrictDuplicates = get_mo_option("\165\155\x5f\160\x72\x6f\x66\151\x6c\x65\x5f\162\145\x73\x74\162\151\143\x74\x5f\x64\x75\x70\x6c\x69\x63\x61\x74\x65\x73");
        $this->_buttonText = get_mo_option("\x75\x6d\x5f\x70\x72\157\x66\151\x6c\x65\137\142\x75\x74\x74\157\x6e\x5f\164\x65\170\x74");
        $this->_buttonText = !MoUtility::isBlank($this->_buttonText) ? $this->_buttonText : mo_("\x43\x6c\x69\x63\153\x20\110\x65\x72\145\x20\x74\157\40\163\x65\x6e\144\40\117\124\x50");
        $this->_emailKey = "\165\x73\x65\x72\137\x65\155\141\151\x6c";
        $this->_phoneKey = get_mo_option("\165\x6d\x5f\x70\162\x6f\x66\151\154\145\x5f\160\x68\x6f\x6e\x65\x5f\x6b\145\171");
        $this->_phoneKey = $this->_phoneKey ? $this->_phoneKey : "\155\157\x62\151\154\145\x5f\156\x75\x6d\x62\x65\x72";
        $this->_phoneFormId = "\x69\156\x70\x75\164\133\156\141\155\x65\x5e\75\47{$this->_phoneKey}\x27\135";
        $this->_formDocuments = MoOTPDocs::UM_PROFILE;
        parent::__construct();
    }
    public function handleForm()
    {
        $this->_otpType = get_mo_option("\x75\155\137\x70\162\x6f\146\x69\154\x65\x5f\x65\x6e\x61\x62\154\x65\137\x74\171\x70\145");
        add_action("\167\x70\137\x65\156\x71\165\145\x75\x65\x5f\x73\x63\x72\x69\x70\x74\163", array($this, "\155\x69\x6e\151\x6f\162\x61\156\x67\x65\137\162\145\147\x69\163\x74\145\x72\x5f\165\155\x5f\163\x63\162\151\160\x74"));
        add_action("\165\x6d\x5f\x73\165\142\x6d\x69\x74\x5f\141\143\143\157\165\x6e\164\137\x65\x72\x72\157\x72\x73\137\150\x6f\x6f\x6b", array($this, "\155\x69\x6e\151\157\x72\x61\156\x67\x65\137\x75\x6d\x5f\x76\141\x6c\x69\144\141\x74\151\157\x6e"), 99, 1);
        add_action("\165\155\x5f\141\x64\144\137\x65\x72\x72\x6f\162\x5f\157\x6e\137\x66\157\162\155\137\x73\x75\x62\155\x69\164\137\x76\x61\x6c\x69\x64\141\x74\x69\157\156", array($this, "\x6d\151\156\x69\x6f\162\141\x6e\147\145\x5f\165\155\137\160\162\x6f\x66\151\154\145\137\x76\141\154\151\144\x61\x74\151\x6f\x6e"), 1, 3);
        $this->routeData();
    }
    private function isAccountVerificationEnabled()
    {
        return strcasecmp($this->_otpType, $this->_typeEmailTag) == 0 || strcasecmp($this->_otpType, $this->_typeBothTag) == 0;
    }
    private function isProfileVerificationEnabled()
    {
        return strcasecmp($this->_otpType, $this->_typePhoneTag) == 0 || strcasecmp($this->_otpType, $this->_typeBothTag) == 0;
    }
    private function routeData()
    {
        if (array_key_exists("\157\x70\x74\151\x6f\156", $_GET)) {
            goto Uh;
        }
        return;
        Uh:
        switch (trim($_GET["\x6f\x70\164\151\x6f\156"])) {
            case "\x6d\151\x6e\151\157\162\141\x6e\x67\x65\55\x75\x6d\x2d\x61\x63\x63\55\x61\x6a\141\170\x2d\166\x65\162\151\146\171":
                $this->sendAjaxOTPRequest();
                goto Bu;
        }
        LQ:
        Bu:
    }
    private function sendAjaxOTPRequest()
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        $this->validateAjaxRequest();
        $m6 = MoUtility::sanitizeCheck("\x75\x73\145\x72\x5f\160\x68\x6f\156\x65", $_POST);
        $Kc = MoUtility::sanitizeCheck("\165\x73\x65\162\x5f\145\x6d\x61\151\x6c", $_POST);
        $Kp = MoUtility::sanitizeCheck("\157\x74\x70\x5f\162\145\x71\x75\145\x73\x74\x5f\164\x79\x70\x65", $_POST);
        $this->startOtpTransaction($Kc, $m6, $Kp);
    }
    private function startOtpTransaction($xX, $t2, $Kp)
    {
        if (strcasecmp($Kp, $this->_typePhoneTag) == 0) {
            goto Zk;
        }
        SessionUtils::addEmailVerified($this->_formSessionVar, $xX);
        $this->sendChallenge(null, $xX, null, $t2, VerificationType::EMAIL, null, null);
        goto fw;
        Zk:
        $this->checkDuplicates($t2, $this->_phoneKey);
        SessionUtils::addPhoneVerified($this->_formSessionVar, $t2);
        $this->sendChallenge(null, $xX, null, $t2, VerificationType::PHONE, null, null);
        fw:
    }
    private function checkDuplicates($sA, $xl)
    {
        if (!($this->_restrictDuplicates && $this->isPhoneNumberAlreadyInUse($sA, $xl))) {
            goto wf;
        }
        $bJ = MoMessages::showMessage(MoMessages::PHONE_EXISTS);
        wp_send_json(MoUtility::createJson($bJ, MoConstants::ERROR_JSON_TYPE));
        wf:
    }
    private function getUserData($xl)
    {
        $current_user = wp_get_current_user();
        if ($xl === $this->_phoneKey) {
            goto e_;
        }
        return $current_user->user_email;
        goto IF1;
        e_:
        global $wpdb;
        $yp = "\x53\x45\x4c\105\103\x54\40\x6d\145\164\x61\x5f\x76\x61\154\x75\145\40\x46\x52\117\115\40\140{$wpdb->prefix}\165\163\x65\162\155\145\x74\x61\x60\x20\127\x48\x45\x52\105\40\140\155\x65\164\x61\137\x6b\145\x79\x60\x20\75\40\47{$xl}\47\40\x41\x4e\104\x20\140\x75\163\x65\x72\x5f\151\144\140\40\75\x20{$current_user->ID}";
        $D5 = $wpdb->get_row($yp);
        return isset($D5) ? $D5->meta_value : '';
        IF1:
    }
    private function checkFormSession($form)
    {
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $this->getVerificationType())) {
            goto io;
        }
        $form->add_error($this->_emailKey, MoUtility::_get_invalid_otp_method());
        $form->add_error($this->_phoneKey, MoUtility::_get_invalid_otp_method());
        goto gz;
        io:
        $this->unsetOTPSessionVariables();
        gz:
    }
    private function getUmFormObj()
    {
        if ($this->isUltimateMemberV2Installed()) {
            goto B0;
        }
        global $ultimatemember;
        return $ultimatemember->form;
        goto hP;
        B0:
        return UM()->form();
        hP:
    }
    function isUltimateMemberV2Installed()
    {
        if (function_exists("\x69\163\x5f\x70\154\x75\x67\x69\x6e\x5f\x61\x63\164\151\166\145")) {
            goto Ic;
        }
        include_once ABSPATH . "\x77\160\55\141\x64\155\151\x6e\57\x69\x6e\x63\154\x75\144\145\163\57\x70\154\x75\147\151\156\56\x70\x68\160";
        Ic:
        return is_plugin_active("\x75\154\x74\x69\x6d\x61\x74\x65\x2d\155\x65\155\x62\145\x72\x2f\165\154\164\151\x6d\141\x74\x65\x2d\x6d\x65\x6d\142\145\162\56\160\150\x70");
    }
    function isPhoneNumberAlreadyInUse($lr, $xl)
    {
        global $wpdb;
        MoUtility::processPhoneNumber($lr);
        $yp = "\123\105\114\105\103\124\40\140\x75\163\x65\x72\x5f\x69\144\140\x20\x46\122\117\115\40\x60{$wpdb->prefix}\165\163\145\x72\155\145\164\141\140\x20\127\110\105\122\105\x20\x60\x6d\x65\x74\x61\137\153\145\x79\140\x20\x3d\x20\x27{$xl}\x27\x20\101\x4e\104\x20\x60\155\145\x74\x61\137\x76\141\154\x75\x65\x60\40\75\40\x20\47{$lr}\47";
        $D5 = $wpdb->get_row($yp);
        return !MoUtility::isBlank($D5);
    }
    public function miniorange_register_um_script()
    {
        wp_register_script("\155\x6f\x76\165\155\160\162\157\x66\x69\154\145", MOV_URL . "\151\x6e\143\x6c\165\x64\x65\163\x2f\x6a\163\x2f\155\x6f\x75\155\160\162\x6f\146\x69\154\145\56\155\151\156\56\152\x73", array("\x6a\x71\x75\x65\x72\171"));
        wp_localize_script("\155\157\166\165\x6d\x70\x72\157\x66\151\x6c\x65", "\155\x6f\x75\155\x61\x63\x76\x61\x72", array("\x73\x69\164\145\x55\122\x4c" => site_url(), "\x6f\164\160\x54\x79\x70\x65" => $this->_otpType, "\145\155\141\151\x6c\117\x74\160\124\x79\x70\x65" => $this->_typeEmailTag, "\160\x68\157\156\145\x4f\164\x70\x54\171\160\x65" => $this->_typePhoneTag, "\142\157\164\x68\x4f\124\x50\x54\x79\160\x65" => $this->_typeBothTag, "\x6e\x6f\156\143\x65" => wp_create_nonce($this->_nonce), "\142\x75\x74\164\x6f\156\124\x65\170\164" => mo_($this->_buttonText), "\151\155\147\x55\x52\x4c" => MOV_LOADER_URL, "\146\157\162\155\113\145\171" => $this->_verifyFieldKey, "\x65\x6d\x61\x69\x6c\126\141\154\x75\145" => $this->getUserData($this->_emailKey), "\160\150\x6f\x6e\x65\x56\x61\154\165\145" => $this->getUserData($this->_phoneKey), "\x70\150\157\x6e\x65\113\x65\x79" => $this->_phoneKey));
        wp_enqueue_script("\155\x6f\166\x75\x6d\x70\162\157\x66\151\x6c\145");
    }
    private function userHasNotChangeData($WP, $mx)
    {
        $Jf = $this->getUserData($WP);
        return strcasecmp($Jf, $mx[$WP]) != 0;
    }
    public function miniorange_um_validation($mx, $WP = "\165\x73\145\x72\x5f\145\155\x61\x69\x6c")
    {
        $CM = MoUtility::sanitizeCheck("\155\157\144\x65", $mx);
        if (!(!$this->userHasNotChangeData($WP, $mx) && $CM != "\162\145\147\x69\x73\x74\x65\x72")) {
            goto tH;
        }
        $form = $this->getUmFormObj();
        if ($this->isValidationRequired($WP) && !SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto PZ;
        }
        foreach ($mx as $xl => $sA) {
            if ($xl === $this->_verifyFieldKey) {
                goto Zs;
            }
            if ($xl === $this->_phoneKey) {
                goto Bm;
            }
            goto QG;
            Zs:
            $this->checkIntegrityAndValidateOTP($form, $sA, $mx);
            goto QG;
            Bm:
            $this->processPhoneNumbers($sA, $form);
            QG:
            jd:
        }
        UT:
        goto rr;
        PZ:
        $xl = $this->isProfileVerificationEnabled() && $CM == "\160\x72\157\x66\151\x6c\145" ? $this->_phoneKey : $this->_emailKey;
        $form->add_error($xl, MoMessages::showMessage(MoMessages::PLEASE_VALIDATE));
        rr:
        tH:
    }
    private function isValidationRequired($WP)
    {
        return $this->isAccountVerificationEnabled() && $WP === "\165\x73\145\162\137\145\x6d\x61\x69\x6c" || $this->isProfileVerificationEnabled() && $WP === $this->_phoneKey;
    }
    public function miniorange_um_profile_validation($form, $xl, $mx)
    {
        if (!($xl === $this->_phoneKey)) {
            goto gB;
        }
        $this->miniorange_um_validation($mx, $this->_phoneKey);
        gB:
    }
    private function processPhoneNumbers($sA, $form)
    {
        global $phoneLogic;
        if (MoUtility::validatePhoneNumber($sA)) {
            goto K4;
        }
        $bJ = str_replace("\43\x23\x70\150\x6f\x6e\145\x23\43", $sA, $phoneLogic->_get_otp_invalid_format_message());
        $form->add_error($this->_phoneKey, $bJ);
        K4:
        $this->checkDuplicates($sA, $this->_phoneKey);
    }
    private function checkIntegrityAndValidateOTP($form, $sA, array $mx)
    {
        $this->checkIntegrity($form, $mx);
        if (!($form->count_errors() > 0)) {
            goto f7;
        }
        return;
        f7:
        $this->validateChallenge($this->getVerificationType(), NULL, $sA);
        $this->checkFormSession($form);
    }
    private function checkIntegrity($xt, array $mx)
    {
        if (!$this->isProfileVerificationEnabled()) {
            goto E5;
        }
        if (!SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $mx[$this->_phoneKey])) {
            goto gA;
        }
        $xt->add_error($this->_phoneKey, MoMessages::showMessage(MoMessages::PHONE_MISMATCH));
        gA:
        E5:
        if (!$this->isAccountVerificationEnabled()) {
            goto H4;
        }
        if (!SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $mx[$this->_emailKey])) {
            goto Px;
        }
        $xt->add_error($this->_emailKey, MoMessages::showMessage(MoMessages::EMAIL_MISMATCH));
        Px:
        H4:
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
    }
    public function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VERIFICATION_FAILED, $m5);
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->isProfileVerificationEnabled())) {
            goto yW;
        }
        array_push($lP, $this->_phoneFormId);
        yW:
        return $lP;
    }
    public function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto GZ;
        }
        return;
        GZ:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\165\x6d\137\x70\162\x6f\x66\x69\x6c\145\137\x65\156\x61\x62\x6c\145");
        $this->_otpType = $this->sanitizeFormPOST("\x75\155\137\x70\162\x6f\146\151\x6c\145\137\145\156\141\x62\154\145\x5f\x74\171\x70\145");
        $this->_buttonText = $this->sanitizeFormPOST("\165\x6d\137\160\x72\x6f\146\151\x6c\x65\x5f\142\x75\x74\164\x6f\x6e\137\x74\x65\170\x74");
        $this->_restrictDuplicates = $this->sanitizeFormPOST("\x75\155\x5f\x70\162\157\x66\151\154\x65\137\162\x65\x73\x74\x72\151\143\164\x5f\144\165\x70\154\x69\143\x61\x74\145\x73");
        $this->_phoneKey = $this->sanitizeFormPOST("\x75\x6d\x5f\160\162\157\146\151\154\x65\137\x70\150\x6f\x6e\x65\x5f\153\x65\171");
        if (!$this->basicValidationCheck(BaseMessages::UM_PROFILE_CHOOSE)) {
            goto fp;
        }
        update_mo_option("\165\155\x5f\160\162\x6f\146\151\154\x65\137\x65\x6e\141\142\x6c\x65", $this->_isFormEnabled);
        update_mo_option("\165\x6d\x5f\x70\162\157\146\151\154\x65\137\145\156\x61\x62\154\x65\137\x74\x79\x70\145", $this->_otpType);
        update_mo_option("\165\x6d\x5f\160\x72\157\146\151\x6c\145\137\142\165\x74\164\157\x6e\137\x74\x65\170\164", $this->_buttonText);
        update_mo_option("\x75\155\x5f\160\162\x6f\146\x69\x6c\145\137\162\x65\x73\164\162\151\x63\164\137\x64\x75\x70\154\151\x63\x61\x74\x65\x73", $this->_restrictDuplicates);
        update_mo_option("\x75\x6d\137\x70\162\x6f\146\151\x6c\145\137\160\x68\x6f\156\145\137\x6b\145\x79", $this->_phoneKey);
        fp:
    }
}
