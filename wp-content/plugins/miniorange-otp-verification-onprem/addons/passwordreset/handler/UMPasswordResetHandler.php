<?php


namespace OTP\Addons\PasswordReset\Handler;

use OTP\Addons\PasswordReset\Helper\UMPasswordResetMessages;
use OTP\Helper\FormSessionVars;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use UM;
use um\core\Form;
use um\core\Options;
use um\core\Password;
use um\core\User;
use WP_User;
class UMPasswordResetHandler extends FormHandler implements IFormHandler
{
    use Instance;
    private $_fieldKey;
    private $_isOnlyPhoneReset;
    protected function __construct()
    {
        $this->_isAjaxForm = TRUE;
        $this->_isAddOnForm = TRUE;
        $this->_formOption = "\x75\x6d\x5f\x70\141\x73\163\167\157\162\144\137\x72\x65\x73\145\x74\137\x68\141\156\x64\x6c\145\162";
        $this->_formSessionVar = FormSessionVars::UM_DEFAULT_PASS;
        $this->_typePhoneTag = "\155\x6f\137\x75\x6d\137\x70\x68\157\156\x65\137\x65\x6e\x61\142\154\x65";
        $this->_typeEmailTag = "\155\x6f\137\x75\x6d\137\x65\x6d\141\x69\x6c\x5f\145\156\141\x62\154\x65";
        $this->_phoneFormId = "\x75\x73\x65\x72\x6e\x61\155\x65\137\142";
        $this->_fieldKey = "\x75\163\145\162\x6e\141\x6d\145\x5f\x62";
        $this->_formKey = "\125\x4c\x54\111\115\x41\x54\105\x5f\120\x41\123\x53\x5f\x52\x45\123\x45\124";
        $this->_formName = mo_("\x55\x6c\x74\x69\x6d\141\164\145\40\x4d\145\x6d\x62\145\162\40\x50\141\x73\x73\x77\x6f\x72\144\40\122\x65\163\x65\x74\x20\x75\163\x69\x6e\147\x20\117\124\x50");
        $this->_isFormEnabled = get_umpr_option("\160\x61\163\163\x5f\145\x6e\x61\x62\154\x65") ? TRUE : FALSE;
        $this->_generateOTPAction = "\x6d\157\137\x75\x6d\x70\x72\x5f\x73\145\156\144\137\157\164\160";
        $this->_buttonText = get_umpr_option("\160\141\163\x73\x5f\x62\165\x74\164\x6f\156\x5f\164\145\170\x74");
        $this->_buttonText = !MoUtility::isBlank($this->_buttonText) ? $this->_buttonText : mo_("\122\145\x73\x65\164\x20\120\141\x73\x73\167\x6f\x72\144");
        $this->_phoneKey = get_umpr_option("\x70\141\163\163\137\x70\x68\x6f\156\x65\x4b\145\171");
        $this->_phoneKey = $this->_phoneKey ? $this->_phoneKey : "\x6d\x6f\142\x69\154\145\137\156\x75\155\x62\145\162";
        $this->_isOnlyPhoneReset = get_umpr_option("\157\x6e\154\x79\x5f\160\x68\x6f\x6e\x65\x5f\162\145\x73\x65\164");
        parent::__construct();
    }
    public function handleForm()
    {
        $this->_otpType = get_umpr_option("\x65\156\141\142\x6c\145\x64\137\164\171\x70\145");
        if (!$this->_isOnlyPhoneReset) {
            goto GR;
        }
        $this->_phoneFormId = "\x69\156\x70\x75\x74\x23\165\x73\145\162\x6e\x61\155\x65\x5f\142";
        GR:
        add_action("\x77\x70\137\141\x6a\x61\x78\137\156\157\160\x72\x69\x76\x5f" . $this->_generateOTPAction, array($this, "\x73\x65\156\x64\x41\x6a\x61\x78\117\x54\x50\x52\x65\161\x75\x65\163\164"));
        add_action("\167\x70\x5f\x61\x6a\x61\170\137" . $this->_generateOTPAction, array($this, "\x73\x65\x6e\144\x41\152\x61\170\x4f\124\120\122\145\161\165\145\x73\164"));
        add_action("\167\x70\137\145\x6e\161\x75\x65\x75\145\x5f\163\143\x72\151\x70\x74\x73", array($this, "\155\151\x6e\x69\157\x72\x61\156\x67\x65\137\x72\145\147\151\x73\x74\145\162\x5f\x75\155\x5f\163\143\162\x69\160\x74"));
        add_action("\x75\155\x5f\162\x65\163\145\x74\137\x70\141\163\163\x77\x6f\x72\x64\x5f\145\162\x72\x6f\162\x73\137\150\157\157\x6b", array($this, "\165\x6d\137\x72\x65\163\x65\164\137\160\x61\163\163\x77\x6f\x72\x64\137\145\162\162\157\162\163\137\x68\157\x6f\153"), 99);
        add_action("\x75\x6d\137\x72\x65\x73\145\x74\137\160\141\163\163\167\x6f\162\x64\137\x70\x72\x6f\x63\x65\x73\163\x5f\150\x6f\x6f\x6b", array($this, "\165\x6d\x5f\162\x65\x73\x65\164\137\x70\x61\163\x73\167\x6f\x72\144\137\160\162\x6f\x63\145\x73\163\137\150\x6f\x6f\x6b"), 1);
    }
    public function sendAjaxOTPRequest()
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        $this->validateAjaxRequest();
        $Iv = MoUtility::sanitizeCheck("\165\163\145\162\x6e\141\155\x65", $_POST);
        SessionUtils::addUserInSession($this->_formSessionVar, $Iv);
        $user = $this->getUser($Iv);
        $lr = get_user_meta($user->ID, $this->_phoneKey, true);
        $this->startOtpTransaction(null, $user->user_email, null, $lr, null, null);
    }
    public function um_reset_password_process_hook()
    {
        $user = MoUtility::sanitizeCheck("\x75\x73\x65\162\156\141\x6d\x65\137\x62", $_POST);
        $user = $this->getUser(trim($user));
        $Jd = $this->getUmPwdObj();
        um_fetch_user($user->ID);
        $this->getUmUserObj()->password_reset();
        wp_redirect($Jd->reset_url());
        die;
    }
    public function um_reset_password_errors_hook()
    {
        $form = $this->getUmFormObj();
        $Iv = MoUtility::sanitizeCheck($this->_fieldKey, $_POST);
        if (!isset($form->errors)) {
            goto Az;
        }
        if (!(strcasecmp($this->_otpType, $this->_typePhoneTag) == 0 && MoUtility::validatePhoneNumber($Iv))) {
            goto tY;
        }
        $user = $this->getUserFromPhoneNumber($Iv);
        if (!$user) {
            goto Rm;
        }
        $form->errors = null;
        if (isset($form->errors)) {
            goto VY;
        }
        $this->check_reset_password_limit($form, $user->ID);
        VY:
        goto fB;
        Rm:
        $form->add_error($this->_fieldKey, UMPasswordResetMessages::showMessage(UMPasswordResetMessages::USERNAME_NOT_EXIST));
        fB:
        tY:
        Az:
        if (isset($form->errors)) {
            goto ry;
        }
        $this->checkIntegrityAndValidateOTP($form, MoUtility::sanitizeCheck("\x76\x65\x72\151\x66\x79\x5f\x66\151\x65\x6c\x64", $_POST), $_POST);
        ry:
    }
    private function checkIntegrityAndValidateOTP(&$form, $sA, array $mx)
    {
        $Jw = $this->getVerificationType();
        $this->checkIntegrity($form, $mx);
        $this->validateChallenge($Jw, NULL, $sA);
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $Jw)) {
            goto YM;
        }
        $form->add_error($this->_fieldKey, UMPasswordResetMessages::showMessage(UMPasswordResetMessages::INVALID_OTP));
        YM:
    }
    private function checkIntegrity($xt, array $mx)
    {
        $HC = SessionUtils::getUserSubmitted($this->_formSessionVar);
        if (!($HC !== $mx[$this->_fieldKey])) {
            goto rU;
        }
        $xt->add_error($this->_fieldKey, UMPasswordResetMessages::showMessage(UMPasswordResetMessages::USERNAME_MISMATCH));
        rU:
    }
    public function getUserId($user)
    {
        $user = $this->getUser($user);
        return $user ? $user->ID : false;
    }
    public function getUser($Iv)
    {
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0 && MoUtility::validatePhoneNumber($Iv)) {
            goto Ag;
        }
        if (is_email($Iv)) {
            goto QW;
        }
        $user = get_user_by("\x6c\x6f\x67\151\x6e", $Iv);
        goto Tv;
        QW:
        $user = get_user_by("\145\155\141\x69\154", $Iv);
        Tv:
        goto am;
        Ag:
        $Iv = MoUtility::processPhoneNumber($Iv);
        $user = $this->getUserFromPhoneNumber($Iv);
        am:
        return $user;
    }
    function getUserFromPhoneNumber($Iv)
    {
        global $wpdb;
        $D5 = $wpdb->get_row("\x53\x45\x4c\105\x43\124\x20\x60\x75\x73\145\x72\137\x69\144\140\x20\x46\122\x4f\115\x20\140{$wpdb->prefix}\165\x73\x65\x72\x6d\x65\x74\141\x60\40\x57\x48\105\122\x45\40\x60\155\x65\x74\x61\x5f\153\145\x79\140\x20\x3d\40\47{$this->_phoneKey}\47\40\101\116\104\40\140\155\145\164\x61\x5f\x76\141\154\x75\x65\x60\40\x3d\x20\40\47{$Iv}\x27");
        return !MoUtility::isBlank($D5) ? get_userdata($D5->user_id) : false;
    }
    public function check_reset_password_limit(Form &$form, $d2)
    {
        $Tz = (int) get_user_meta($d2, "\160\141\163\x73\x77\157\162\144\x5f\x72\163\164\x5f\141\164\x74\x65\155\x70\x74\163", true);
        $p4 = user_can(intval($d2), "\155\141\156\141\147\145\137\x6f\160\x74\x69\x6f\156\x73");
        if (!$this->getUmOptions()->get("\145\x6e\x61\142\154\x65\137\x72\x65\x73\x65\x74\x5f\x70\x61\163\163\167\x6f\162\144\137\154\x69\155\151\164")) {
            goto Cz;
        }
        if ($this->getUmOptions()->get("\x64\x69\163\141\x62\x6c\145\137\x61\x64\x6d\x69\x6e\x5f\162\x65\163\x65\x74\x5f\160\x61\x73\x73\167\x6f\x72\144\x5f\154\x69\155\x69\164") && $p4) {
            goto Ek;
        }
        $j2 = $this->getUmOptions()->get("\x72\x65\x73\145\x74\x5f\160\x61\163\x73\x77\157\162\144\x5f\x6c\151\x6d\151\164\x5f\x6e\x75\x6d\142\x65\162");
        if ($Tz >= $j2) {
            goto xL;
        }
        update_user_meta($d2, "\160\141\x73\163\x77\157\x72\x64\137\x72\163\x74\137\141\x74\x74\145\155\160\x74\x73", $Tz + 1);
        goto qO;
        xL:
        $form->add_error($this->_fieldKey, __("\131\x6f\x75\x20\150\x61\x76\145\x20\162\145\141\143\150\145\x64\40\x74\150\x65\40\x6c\x69\x6d\151\x74\x20\146\x6f\x72\40\x72\x65\161\165\x65\x73\x74\151\156\x67\40\160\x61\x73\x73\x77\157\162\144\x20\42\56\12\x20\x20\x20\x20\40\40\40\40\x20\x20\x20\x20\40\40\40\x20\40\x20\x20\40\x22\x63\x68\x61\156\x67\145\x20\146\x6f\x72\x20\x74\x68\x69\x73\40\165\163\x65\x72\40\141\x6c\162\x65\x61\144\x79\x2e\40\103\x6f\x6e\x74\141\x63\x74\x20\x73\x75\x70\160\157\x72\164\x20\x69\146\x20\x79\157\165\x20\143\x61\156\156\x6f\x74\40\157\x70\x65\x6e\40\164\150\145\40\x65\x6d\141\151\x6c", "\x75\154\164\x69\x6d\141\164\145\55\155\145\155\x62\145\162"));
        qO:
        goto Pw;
        Ek:
        Pw:
        Cz:
    }
    private function getUmFormObj()
    {
        if ($this->isUltimateMemberV2Installed()) {
            goto l1;
        }
        global $ultimatemember;
        return $ultimatemember->form;
        goto tz;
        l1:
        return UM()->form();
        tz:
    }
    private function getUmUserObj()
    {
        if ($this->isUltimateMemberV2Installed()) {
            goto w1;
        }
        global $ultimatemember;
        return $ultimatemember->user;
        goto Wx;
        w1:
        return UM()->user();
        Wx:
    }
    private function getUmPwdObj()
    {
        if ($this->isUltimateMemberV2Installed()) {
            goto kL;
        }
        global $ultimatemember;
        return $ultimatemember->password;
        goto BB;
        kL:
        return UM()->password();
        BB:
    }
    private function getUmOptions()
    {
        if ($this->isUltimateMemberV2Installed()) {
            goto aD;
        }
        global $ultimatemember;
        return $ultimatemember->options;
        goto Uu;
        aD:
        return UM()->options();
        Uu:
    }
    function isUltimateMemberV2Installed()
    {
        if (function_exists("\151\x73\137\160\x6c\x75\147\151\x6e\137\x61\143\x74\151\x76\x65")) {
            goto iy;
        }
        include_once ABSPATH . "\167\160\55\x61\144\155\151\156\57\x69\156\143\154\165\144\x65\x73\57\160\x6c\165\x67\151\156\x2e\x70\150\160";
        iy:
        return is_plugin_active("\x75\154\164\151\x6d\141\x74\x65\x2d\155\145\155\142\x65\162\57\x75\154\x74\151\155\x61\164\145\55\x6d\x65\155\142\x65\162\x2e\160\150\x70");
    }
    private function startOtpTransaction($Iv, $xX, $errors, $t2, $wh, $SU)
    {
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto KT;
        }
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::EMAIL, $wh, $SU);
        goto SC;
        KT:
        $this->sendChallenge($Iv, $xX, $errors, $t2, VerificationType::PHONE, $wh, $SU);
        SC:
    }
    public function miniorange_register_um_script()
    {
        wp_register_script("\x6d\157\165\x6d\160\x72", UMPR_URL . "\x69\x6e\143\x6c\165\x64\145\x73\57\152\163\x2f\155\x6f\165\x6d\x70\162\56\155\151\156\x2e\152\163", array("\152\161\x75\x65\x72\x79"));
        wp_localize_script("\155\x6f\165\155\x70\162", "\x6d\x6f\165\155\x70\162\166\141\162", array("\163\x69\x74\x65\x55\x52\114" => wp_ajax_url(), "\x6e\x6f\x6e\x63\145" => wp_create_nonce($this->_nonce), "\142\x75\164\164\157\x6e\164\145\170\164" => mo_($this->_buttonText), "\151\155\x67\125\x52\114" => MOV_LOADER_URL, "\x61\x63\x74\151\x6f\x6e" => array("\x73\145\156\x64" => $this->_generateOTPAction), "\146\x69\145\154\144\x4b\145\171" => $this->_fieldKey, "\162\145\x73\145\x74\114\141\x62\145\x6c\124\x65\x78\164" => UMPasswordResetMessages::showMessage($this->_isOnlyPhoneReset ? UMPasswordResetMessages::RESET_LABEL_OP : UMPasswordResetMessages::RESET_LABEL), "\160\150\x54\x65\170\164" => $this->_isOnlyPhoneReset ? mo_("\x45\x6e\x74\145\x72\x20\131\x6f\x75\x72\40\120\x68\x6f\x6e\x65\40\x4e\165\155\142\x65\162") : mo_("\105\x6e\164\145\x72\40\x59\157\x75\x72\40\105\155\x61\151\x6c\x2c\x20\125\163\145\162\156\x61\155\145\40\x6f\x72\x20\x50\150\x6f\156\x65\x20\116\x75\x6d\142\x65\x72")));
        wp_enqueue_script("\x6d\157\165\155\160\162");
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
    public function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto Rl;
        }
        return;
        Rl:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\x75\155\137\160\162\137\x65\156\x61\142\x6c\x65");
        $this->_buttonText = $this->sanitizeFormPOST("\165\x6d\x5f\160\x72\x5f\142\165\164\x74\157\x6e\137\x74\145\170\x74");
        $this->_buttonText = $this->_buttonText ? $this->_buttonText : "\122\x65\163\x65\164\x20\120\x61\x73\163\167\157\162\144";
        $this->_otpType = $this->sanitizeFormPOST("\x75\155\137\x70\x72\x5f\145\156\x61\x62\154\x65\137\164\x79\160\145");
        $this->_phoneKey = $this->sanitizeFormPOST("\x75\155\137\160\162\137\160\150\157\x6e\145\137\x66\151\145\x6c\x64\137\x6b\x65\x79");
        $this->_isOnlyPhoneReset = $this->sanitizeFormPOST("\165\x6d\137\160\x72\137\x6f\156\x6c\171\137\160\150\157\156\145");
        update_umpr_option("\157\x6e\x6c\x79\x5f\x70\x68\157\156\x65\x5f\x72\x65\163\x65\164", $this->_isOnlyPhoneReset);
        update_umpr_option("\x70\141\163\x73\x5f\145\x6e\141\x62\x6c\145", $this->_isFormEnabled);
        update_umpr_option("\160\141\163\x73\137\x62\165\x74\x74\x6f\156\137\164\x65\170\164", $this->_buttonText);
        update_umpr_option("\145\x6e\141\142\x6c\145\x64\137\164\x79\160\145", $this->_otpType);
        update_umpr_option("\x70\141\x73\x73\137\160\150\157\156\145\x4b\145\171", $this->_phoneKey);
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && strcasecmp($this->_otpType, $this->_typePhoneTag) == 0)) {
            goto MM;
        }
        array_push($lP, $this->_phoneFormId);
        MM:
        return $lP;
    }
    public function getIsOnlyPhoneReset()
    {
        return $this->_isOnlyPhoneReset;
    }
}
