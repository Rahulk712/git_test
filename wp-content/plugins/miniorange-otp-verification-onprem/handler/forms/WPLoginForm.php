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
use WP_Error;
use WP_User;
class WPLoginForm extends FormHandler implements IFormHandler
{
    use Instance;
    private $_savePhoneNumbers;
    private $_byPassAdmin;
    private $_allowLoginThroughPhone;
    private $_skipPasswordCheck;
    private $_userLabel;
    private $_delayOtp;
    private $_delayOtpInterval;
    private $_skipPassFallback;
    private $_createUserAction;
    private $_timeStampMetaKey = "\x6d\x6f\166\137\x6c\x61\x73\x74\x5f\x76\x65\x72\151\146\x69\x65\144\x5f\144\x74\x74\x6d";
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = TRUE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::WP_LOGIN_REG_PHONE;
        $this->_formSessionVar2 = FormSessionVars::WP_DEFAULT_LOGIN;
        $this->_phoneFormId = "\x23\x6d\157\137\160\150\x6f\x6e\x65\x5f\x6e\x75\155\x62\145\162";
        $this->_typePhoneTag = "\155\x6f\x5f\167\x70\x5f\x6c\157\147\151\x6e\137\x70\x68\x6f\156\x65\x5f\x65\x6e\x61\142\154\145";
        $this->_typeEmailTag = "\155\x6f\x5f\167\x70\x5f\x6c\157\147\151\x6e\x5f\145\155\x61\151\x6c\x5f\145\x6e\x61\142\154\145";
        $this->_formKey = "\127\120\x5f\x44\105\x46\101\125\x4c\124\137\114\117\107\x49\116";
        $this->_formName = mo_("\127\157\162\x64\120\x72\x65\x73\x73\40\114\x6f\x67\x69\x6e\x20\x46\x6f\162\x6d");
        $this->_isFormEnabled = get_mo_option("\x77\160\x5f\x6c\157\x67\151\156\137\145\x6e\x61\x62\x6c\x65");
        $this->_userLabel = get_mo_option("\167\x70\x5f\165\163\145\x72\156\141\x6d\145\x5f\x6c\x61\142\x65\x6c\x5f\164\145\x78\164");
        $this->_userLabel = $this->_userLabel ? mo_($this->_userLabel) : mo_("\x55\x73\145\162\x6e\141\155\145\54\40\x45\x2d\x6d\x61\x69\x6c\x20\x6f\x72\x20\120\150\x6f\156\x65\40\116\x6f\x2e");
        $this->_skipPasswordCheck = get_mo_option("\x77\160\x5f\x6c\157\147\151\x6e\137\163\153\151\x70\137\160\x61\x73\163\167\x6f\x72\x64");
        $this->_allowLoginThroughPhone = get_mo_option("\x77\x70\x5f\154\157\147\151\156\x5f\141\154\154\x6f\167\137\160\150\x6f\156\x65\x5f\154\157\x67\x69\156");
        $this->_skipPassFallback = get_mo_option("\167\160\x5f\154\157\x67\x69\x6e\x5f\x73\153\151\x70\x5f\x70\x61\163\163\167\x6f\x72\144\x5f\146\141\x6c\154\142\x61\x63\x6b");
        $this->_delayOtp = get_mo_option("\x77\x70\x5f\154\x6f\147\151\x6e\137\144\x65\x6c\141\171\x5f\157\164\160");
        $this->_delayOtpInterval = get_mo_option("\x77\160\x5f\x6c\157\147\x69\x6e\137\x64\x65\154\x61\x79\137\157\164\160\x5f\x69\x6e\164\x65\x72\x76\x61\154");
        $this->_delayOtpInterval = $this->_delayOtpInterval ? $this->_delayOtpInterval : 43800;
        $this->_formDocuments = MoOTPDocs::LOGIN_FORM;
        if (!($this->_skipPasswordCheck || $this->_allowLoginThroughPhone)) {
            goto cY;
        }
        add_action("\x6c\157\147\x69\x6e\137\x65\156\161\165\x65\x75\145\x5f\x73\143\x72\x69\160\164\163", array($this, "\x6d\151\x6e\x69\x6f\x72\141\156\x67\145\137\x72\x65\147\151\x73\164\145\x72\137\x6c\157\x67\151\156\137\163\x63\x72\x69\160\x74"));
        add_action("\167\x70\x5f\x65\x6e\x71\165\145\165\x65\137\163\x63\162\151\160\x74\163", array($this, "\x6d\x69\156\151\157\x72\141\156\147\x65\137\x72\145\147\151\x73\164\145\162\137\154\x6f\147\151\x6e\x5f\163\143\162\151\x70\164"));
        cY:
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\167\x70\137\154\157\147\151\156\137\x65\156\x61\x62\x6c\145\137\x74\171\x70\x65");
        $this->_phoneKey = get_mo_option("\x77\160\137\154\157\147\151\156\137\x6b\x65\171");
        $this->_savePhoneNumbers = get_mo_option("\167\x70\x5f\154\157\x67\151\156\x5f\162\x65\147\x69\163\164\x65\162\x5f\160\x68\157\156\x65");
        $this->_byPassAdmin = get_mo_option("\x77\x70\137\x6c\x6f\147\151\x6e\x5f\142\171\160\x61\x73\x73\137\141\144\x6d\151\x6e");
        $this->_restrictDuplicates = get_mo_option("\x77\x70\137\x6c\x6f\x67\151\156\137\162\145\163\x74\x72\151\x63\x74\x5f\144\165\160\154\151\143\x61\x74\x65\x73");
        add_filter("\141\165\x74\150\x65\156\x74\x69\x63\141\x74\145", array($this, "\137\150\141\156\x64\154\x65\x5f\x6d\x6f\x5f\167\x70\137\x6c\x6f\147\151\156"), 99, 3);
        add_action("\167\x70\137\x61\152\x61\170\137\155\157\55\x61\x64\x6d\151\156\55\143\150\x65\143\x6b", array($this, "\x69\163\101\x64\155\x69\156"));
        add_action("\167\x70\137\x61\152\141\170\x5f\156\157\x70\x72\151\x76\x5f\155\157\x2d\x61\x64\155\151\x6e\55\x63\150\x65\143\153", array($this, "\151\x73\x41\144\155\151\x6e"));
        if (!class_exists("\125\x4d")) {
            goto iQ;
        }
        add_filter("\167\x70\137\141\165\x74\150\145\x6e\164\151\143\141\x74\145\x5f\165\x73\145\162", array($this, "\137\147\145\164\x5f\x61\x6e\144\x5f\x72\145\x74\x75\162\156\137\x75\163\x65\162"), 99, 2);
        iQ:
        $this->routeData();
    }
    function isAdmin()
    {
        $Iv = MoUtility::sanitizeCheck("\165\163\x65\162\x6e\141\155\145", $_POST);
        $user = is_email($Iv) ? get_user_by("\x65\x6d\141\x69\154", $Iv) : get_user_by("\154\157\x67\x69\156", $Iv);
        $MC = MoConstants::SUCCESS_JSON_TYPE;
        $MC = $user ? in_array("\141\x64\x6d\x69\x6e\151\x73\164\162\x61\164\x6f\x72", $user->roles) ? $MC : "\145\162\x72\157\162" : "\145\162\x72\157\x72";
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::PHONE_EXISTS), $MC));
    }
    function routeData()
    {
        if (array_key_exists("\x6f\160\x74\151\x6f\x6e", $_REQUEST)) {
            goto VJ;
        }
        return;
        VJ:
        switch (trim($_REQUEST["\157\160\x74\x69\157\x6e"])) {
            case "\x6d\151\156\x69\x6f\162\x61\x6e\x67\145\x2d\x61\152\141\170\55\157\x74\x70\55\x67\x65\156\x65\162\x61\164\145":
                $this->_handle_wp_login_ajax_send_otp();
                goto Gm;
            case "\155\151\156\x69\157\162\141\156\147\x65\x2d\x61\152\x61\170\x2d\x6f\x74\x70\55\166\x61\154\151\x64\141\x74\x65":
                $this->_handle_wp_login_ajax_form_validate_action();
                goto Gm;
            case "\x6d\157\x5f\x61\x6a\141\x78\x5f\146\x6f\162\x6d\137\166\141\x6c\x69\x64\141\164\x65":
                $this->_handle_wp_login_create_user_action();
                goto Gm;
        }
        qS:
        Gm:
    }
    function miniorange_register_login_script()
    {
        wp_register_script("\x6d\157\154\157\147\151\156", MOV_URL . "\x69\156\x63\x6c\x75\x64\145\163\x2f\x6a\x73\x2f\154\x6f\x67\x69\156\x66\157\x72\x6d\x2e\155\151\156\x2e\152\163", array("\x6a\161\165\x65\162\x79"));
        wp_localize_script("\x6d\x6f\154\x6f\x67\151\156", "\155\157\166\x61\x72\154\157\147\x69\x6e", array("\165\x73\145\162\x4c\141\142\145\154" => $this->_allowLoginThroughPhone ? $this->_userLabel : null, "\163\x6b\x69\160\x50\x77\144\103\150\x65\143\x6b" => $this->_skipPasswordCheck, "\163\x6b\x69\x70\x50\167\144\106\x61\154\x6c\x62\141\x63\153" => $this->_skipPassFallback, "\x62\x75\x74\x74\x6f\x6e\164\145\x78\164" => mo_("\x4c\157\x67\x69\156\x20\167\151\164\150\x20\117\x54\120"), "\x69\163\x41\x64\155\x69\x6e\x41\143\x74\151\157\156" => "\155\157\x2d\x61\144\x6d\x69\x6e\55\143\x68\x65\143\x6b", "\142\171\x50\x61\163\163\x41\x64\x6d\151\x6e" => $this->_byPassAdmin, "\163\151\x74\145\x55\x52\x4c" => wp_ajax_url()));
        wp_enqueue_script("\x6d\x6f\154\157\147\151\x6e");
    }
    function _get_and_return_user($Iv, $wh)
    {
        if (!is_object($Iv)) {
            goto Ng;
        }
        return $Iv;
        Ng:
        $user = $this->getUser($Iv, $wh);
        if (!is_wp_error($user)) {
            goto Gx;
        }
        return $user;
        Gx:
        UM()->login()->auth_id = $user->data->ID;
        UM()->form()->errors = null;
        return $user;
    }
    function byPassLogin($user, $ER)
    {
        $q9 = get_userdata($user->data->ID);
        $f_ = $q9->roles;
        return in_array("\141\144\x6d\x69\x6e\151\x73\x74\x72\141\164\x6f\162", $f_) && $this->_byPassAdmin || $ER || $this->delayOTPProcess($user->data->ID);
    }
    function _handle_wp_login_create_user_action()
    {
        $cP = function ($gt) {
            $Iv = MoUtility::sanitizeCheck("\x6c\x6f\147", $gt);
            if ($Iv) {
                goto e2;
            }
            $W6 = array_filter($gt, function ($xl) {
                return strpos($xl, "\x75\x73\145\x72\156\x61\x6d\145") === 0;
            }, ARRAY_FILTER_USE_KEY);
            $Iv = !empty($W6) ? array_shift($W6) : $Iv;
            e2:
            return is_email($Iv) ? get_user_by("\145\x6d\141\x69\154", $Iv) : get_user_by("\x6c\157\147\x69\156", $Iv);
        };
        $gt = $_POST;
        if (SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $this->getVerificationType())) {
            goto yn;
        }
        return;
        yn:
        $user = $cP($gt);
        update_user_meta($user->data->ID, $this->_phoneKey, $this->check_phone_length($gt["\155\x6f\137\160\x68\157\x6e\x65\137\x6e\165\x6d\142\x65\162"]));
        $this->login_wp_user($user->data->user_login);
    }
    function login_wp_user($Z_, $SU = null)
    {
        $user = is_email($Z_) ? get_user_by("\x65\155\x61\151\154", $Z_) : ($this->allowLoginThroughPhone() && MoUtility::validatePhoneNumber($Z_) ? $this->getUserFromPhoneNumber($Z_) : get_user_by("\x6c\157\x67\151\x6e", $Z_));
        wp_set_auth_cookie($user->data->ID);
        if (!($this->_delayOtp && $this->_delayOtpInterval > 0)) {
            goto EQ;
        }
        update_user_meta($user->data->ID, $this->_timeStampMetaKey, time());
        EQ:
        $this->unsetOTPSessionVariables();
        do_action("\x77\160\x5f\154\157\x67\x69\x6e", $user->user_login, $user);
        $b5 = MoUtility::isBlank($SU) ? site_url() : $SU;
        wp_redirect($b5);
        die;
    }
    function _handle_mo_wp_login($user, $Iv, $wh)
    {
        if (MoUtility::isBlank($Iv)) {
            goto dQ;
        }
        $ER = $this->skipOTPProcess($wh);
        $user = $this->getUser($Iv, $wh);
        if (!is_wp_error($user)) {
            goto ad;
        }
        return $user;
        ad:
        if (!$this->byPassLogin($user, $ER)) {
            goto vO;
        }
        return $user;
        vO:
        $this->startOTPVerificationProcess($user, $Iv, $wh);
        dQ:
        return $user;
    }
    function startOTPVerificationProcess($user, $Iv, $wh)
    {
        $m5 = $this->getVerificationType();
        if (!(SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $m5) || SessionUtils::isStatusMatch($this->_formSessionVar2, self::VALIDATED, $m5))) {
            goto lP;
        }
        return;
        lP:
        if ($m5 === VerificationType::PHONE) {
            goto zm;
        }
        if (!($m5 === VerificationType::EMAIL)) {
            goto w7;
        }
        $xX = $user->data->user_email;
        $this->startEmailVerification($Iv, $xX);
        w7:
        goto vw;
        zm:
        $t2 = get_user_meta($user->data->ID, $this->_phoneKey, true);
        $t2 = $this->check_phone_length($t2);
        $this->askPhoneAndStartVerification($user, $this->_phoneKey, $Iv, $t2);
        $this->fetchPhoneAndStartVerification($Iv, $wh, $t2);
        vw:
    }
    function getUser($Iv, $wh = null)
    {
        $user = is_email($Iv) ? get_user_by("\x65\x6d\x61\x69\x6c", $Iv) : get_user_by("\x6c\157\147\x69\x6e", $Iv);
        if (!($this->_allowLoginThroughPhone && MoUtility::validatePhoneNumber($Iv))) {
            goto HQ;
        }
        $user = $this->getUserFromPhoneNumber($Iv);
        HQ:
        if (!($user && !$this->isLoginWithOTP($user->roles))) {
            goto RG;
        }
        $user = wp_authenticate_username_password(NULL, $user->data->user_login, $wh);
        RG:
        return $user ? $user : new WP_Error("\x49\116\126\101\x4c\111\x44\x5f\x55\123\105\x52\116\x41\x4d\105", mo_("\40\x3c\142\x3e\x45\122\x52\117\x52\x3a\74\57\x62\x3e\x20\x49\x6e\x76\141\x6c\151\x64\x20\125\163\145\162\x4e\141\155\x65\x2e\40"));
    }
    function getUserFromPhoneNumber($Iv)
    {
        global $wpdb;
        $D5 = $wpdb->get_row("\x53\105\114\105\x43\124\40\140\165\x73\145\162\x5f\x69\x64\140\40\106\122\x4f\x4d\x20\x60{$wpdb->prefix}\165\x73\145\162\x6d\145\164\x61\140" . "\x57\x48\105\122\105\40\140\x6d\145\x74\x61\137\153\145\x79\140\40\75\40\47{$this->_phoneKey}\47\x20\101\x4e\104\40\140\x6d\145\164\141\137\x76\x61\154\x75\x65\x60\40\x3d\40\40\x27{$Iv}\x27");
        return !MoUtility::isBlank($D5) ? get_userdata($D5->user_id) : false;
    }
    function askPhoneAndStartVerification($user, $xl, $Iv, $t2)
    {
        if (MoUtility::isBlank($t2)) {
            goto im;
        }
        return;
        im:
        if (!$this->savePhoneNumbers()) {
            goto cE;
        }
        MoUtility::initialize_transaction($this->_formSessionVar);
        $this->sendChallenge(NULL, $user->data->user_login, NULL, NULL, "\x65\x78\164\x65\x72\x6e\141\x6c", NULL, array("\144\141\164\141" => array("\165\x73\x65\162\137\154\157\x67\x69\x6e" => $Iv), "\155\x65\163\163\x61\x67\145" => MoMessages::showMessage(MoMessages::REGISTER_PHONE_LOGIN), "\146\157\162\155" => $xl, "\x63\165\x72\154" => MoUtility::currentPageUrl()));
        goto wN;
        cE:
        miniorange_site_otp_validation_form(null, null, null, MoMessages::showMessage(MoMessages::PHONE_NOT_FOUND), null, null);
        wN:
    }
    function fetchPhoneAndStartVerification($Iv, $wh, $t2)
    {
        MoUtility::initialize_transaction($this->_formSessionVar2);
        $fC = isset($_REQUEST["\x72\x65\144\x69\x72\145\x63\x74\137\x74\157"]) ? $_REQUEST["\162\x65\x64\x69\162\x65\x63\x74\137\x74\157"] : MoUtility::currentPageUrl();
        $this->sendChallenge($Iv, null, null, $t2, VerificationType::PHONE, $wh, $fC, false);
    }
    function startEmailVerification($Iv, $xX)
    {
        MoUtility::initialize_transaction($this->_formSessionVar2);
        $this->sendChallenge($Iv, $xX, null, null, VerificationType::EMAIL);
    }
    function _handle_wp_login_ajax_send_otp()
    {
        $Jf = $_POST;
        if ($this->restrictDuplicates() && !MoUtility::isBlank($this->getUserFromPhoneNumber($Jf["\x75\x73\x65\x72\137\160\x68\157\x6e\145"]))) {
            goto P4;
        }
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto Tp;
        }
        goto a0;
        P4:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::PHONE_EXISTS), MoConstants::ERROR_JSON_TYPE));
        goto a0;
        Tp:
        $this->sendChallenge("\x61\x6a\x61\170\x5f\160\150\157\x6e\x65", '', null, trim($Jf["\165\x73\x65\162\137\x70\150\157\156\x65"]), VerificationType::PHONE, null, $Jf);
        a0:
    }
    function _handle_wp_login_ajax_form_validate_action()
    {
        $Jf = $_POST;
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto l5;
        }
        return;
        l5:
        $lr = MoPHPSessions::getSessionVar("\x70\150\157\156\145\x5f\156\165\155\142\x65\x72\137\x6d\157");
        if (strcmp($lr, $this->check_phone_length($Jf["\165\163\x65\x72\x5f\x70\150\157\x6e\145"]))) {
            goto L2;
        }
        $this->validateChallenge($this->getVerificationType());
        goto dl;
        L2:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::PHONE_MISMATCH), MoConstants::ERROR_JSON_TYPE));
        dl:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        if (!SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto AU;
        }
        SessionUtils::addStatus($this->_formSessionVar, self::VERIFICATION_FAILED, $m5);
        wp_send_json(MoUtility::createJson(MoUtility::_get_invalid_otp_method(), MoConstants::ERROR_JSON_TYPE));
        AU:
        if (!SessionUtils::isOTPInitialized($this->_formSessionVar2)) {
            goto Fw;
        }
        miniorange_site_otp_validation_form($u0, $Kc, $t2, MoUtility::_get_invalid_otp_method(), "\160\150\x6f\156\x65", FALSE);
        Fw:
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        if (!SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto Oq;
        }
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
        wp_send_json(MoUtility::createJson('', MoConstants::SUCCESS_JSON_TYPE));
        Oq:
        if (!SessionUtils::isOTPInitialized($this->_formSessionVar2)) {
            goto Uw;
        }
        $Iv = MoUtility::isBlank($u0) ? MoUtility::sanitizeCheck("\154\157\147", $_POST) : $u0;
        $Iv = MoUtility::isBlank($Iv) ? MoUtility::sanitizeCheck("\x75\163\145\x72\x6e\x61\x6d\x65", $_POST) : $Iv;
        $this->login_wp_user($Iv, $SU);
        Uw:
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar, $this->_formSessionVar2));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!$this->isFormEnabled()) {
            goto i1;
        }
        array_push($lP, $this->_phoneFormId);
        i1:
        return $lP;
    }
    private function isLoginWithOTP($Vw = array())
    {
        $Ev = mo_("\114\157\x67\151\x6e\x20\x77\151\164\x68\40\117\124\x50");
        if (!(in_array("\141\144\155\151\156\151\163\x74\162\x61\x74\x6f\x72", $Vw) && $this->_byPassAdmin)) {
            goto F7;
        }
        return false;
        F7:
        return MoUtility::sanitizeCheck("\167\160\55\x73\x75\142\155\x69\x74", $_POST) == $Ev || MoUtility::sanitizeCheck("\154\x6f\147\x69\156", $_POST) == $Ev || MoUtility::sanitizeCheck("\x6c\157\x67\x69\x6e\x74\171\x70\x65", $_POST) == $Ev;
    }
    private function skipOTPProcess($wh)
    {
        return $this->_skipPasswordCheck && $this->_skipPassFallback && isset($wh) && !$this->isLoginWithOTP();
    }
    private function check_phone_length($lr)
    {
        $cx = MoUtility::processPhoneNumber($lr);
        return strlen($cx) >= 5 ? $cx : '';
    }
    private function delayOTPProcess($d2)
    {
        if (!($this->_delayOtp && $this->_delayOtpInterval < 0)) {
            goto Ie;
        }
        return TRUE;
        Ie:
        $Y5 = get_user_meta($d2, $this->_timeStampMetaKey, true);
        if (!MoUtility::isBlank($Y5)) {
            goto CI;
        }
        return FALSE;
        CI:
        $dn = time() - $Y5;
        return $this->_delayOtp && $dn < $this->_delayOtpInterval * 60;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto qy;
        }
        return;
        qy:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\167\x70\x5f\154\x6f\x67\151\x6e\x5f\145\x6e\141\142\x6c\145");
        $this->_savePhoneNumbers = $this->sanitizeFormPOST("\x77\x70\x5f\x6c\x6f\x67\x69\156\x5f\162\145\x67\x69\x73\164\145\x72\137\160\150\x6f\x6e\145");
        $this->_byPassAdmin = $this->sanitizeFormPOST("\x77\x70\137\154\x6f\147\x69\156\x5f\x62\171\160\141\163\x73\137\x61\144\x6d\x69\x6e");
        $this->_phoneKey = $this->sanitizeFormPOST("\x77\x70\137\154\157\x67\151\x6e\137\x70\150\x6f\156\x65\137\x66\151\145\154\144\137\x6b\x65\x79");
        $this->_allowLoginThroughPhone = $this->sanitizeFormPOST("\167\x70\x5f\x6c\157\x67\151\x6e\137\x61\x6c\154\x6f\167\137\x70\x68\x6f\x6e\x65\x5f\154\157\x67\151\x6e");
        $this->_restrictDuplicates = $this->sanitizeFormPOST("\x77\x70\137\x6c\157\x67\151\156\137\x72\145\x73\164\x72\x69\143\x74\x5f\x64\x75\160\154\x69\x63\x61\x74\145\163");
        $this->_otpType = $this->sanitizeFormPOST("\x77\x70\137\154\157\147\151\156\x5f\145\156\x61\142\154\x65\137\x74\x79\160\145");
        $this->_skipPasswordCheck = $this->sanitizeFormPOST("\x77\160\137\154\x6f\x67\x69\x6e\x5f\163\153\151\x70\x5f\160\x61\x73\x73\167\x6f\162\x64");
        $this->_userLabel = $this->sanitizeFormPOST("\167\160\x5f\x75\x73\145\x72\x6e\141\155\145\137\x6c\141\x62\x65\154\x5f\x74\x65\x78\164");
        $this->_skipPassFallback = $this->sanitizeFormPOST("\167\160\137\154\157\x67\x69\x6e\137\163\153\x69\160\137\x70\141\x73\x73\x77\157\x72\144\x5f\146\141\154\x6c\x62\x61\143\153");
        $this->_delayOtp = $this->sanitizeFormPOST("\167\x70\137\154\157\147\x69\x6e\137\144\x65\x6c\x61\x79\137\157\164\160");
        $this->_delayOtpInterval = $this->sanitizeFormPOST("\x77\x70\x5f\154\157\x67\151\x6e\137\144\x65\154\x61\171\137\157\164\160\x5f\151\156\x74\x65\x72\166\141\154");
        update_mo_option("\x77\160\137\154\x6f\x67\x69\x6e\x5f\145\156\x61\x62\x6c\x65\137\x74\171\x70\x65", $this->_otpType);
        update_mo_option("\x77\x70\137\x6c\x6f\147\x69\x6e\x5f\x65\x6e\x61\142\154\x65", $this->_isFormEnabled);
        update_mo_option("\167\160\x5f\x6c\157\x67\x69\x6e\137\x72\x65\x67\x69\x73\164\145\x72\137\x70\x68\x6f\156\x65", $this->_savePhoneNumbers);
        update_mo_option("\167\x70\137\x6c\157\x67\x69\156\x5f\142\x79\x70\141\163\x73\x5f\x61\x64\x6d\x69\156", $this->_byPassAdmin);
        update_mo_option("\167\x70\137\x6c\157\147\x69\156\x5f\153\x65\171", $this->_phoneKey);
        update_mo_option("\167\160\137\154\x6f\x67\151\156\x5f\141\154\x6c\157\x77\x5f\160\x68\157\x6e\x65\x5f\x6c\x6f\147\x69\156", $this->_allowLoginThroughPhone);
        update_mo_option("\167\160\x5f\x6c\157\147\x69\x6e\x5f\162\145\x73\x74\162\x69\143\164\x5f\144\165\160\154\151\x63\141\164\145\x73", $this->_restrictDuplicates);
        update_mo_option("\167\160\x5f\154\157\147\151\x6e\137\163\x6b\151\160\x5f\160\141\163\163\x77\157\162\x64", $this->_skipPasswordCheck);
        update_mo_option("\x77\160\137\154\157\147\151\156\x5f\163\153\x69\160\137\160\x61\x73\x73\x77\x6f\x72\x64\137\x66\141\x6c\x6c\x62\141\143\x6b", $this->_skipPassFallback);
        update_mo_option("\167\x70\137\x75\x73\x65\162\x6e\x61\155\145\137\154\141\x62\145\154\137\164\145\x78\x74", $this->_userLabel);
        update_mo_option("\167\160\137\x6c\x6f\x67\x69\x6e\137\144\x65\x6c\x61\171\137\157\x74\160", $this->_delayOtp);
        update_mo_option("\x77\160\x5f\x6c\157\147\151\156\x5f\144\x65\154\x61\171\137\x6f\x74\160\137\151\x6e\x74\x65\x72\x76\x61\x6c", $this->_delayOtpInterval);
    }
    public function savePhoneNumbers()
    {
        return $this->_savePhoneNumbers;
    }
    function byPassCheckForAdmins()
    {
        return $this->_byPassAdmin;
    }
    function allowLoginThroughPhone()
    {
        return $this->_allowLoginThroughPhone;
    }
    public function getSkipPasswordCheck()
    {
        return $this->_skipPasswordCheck;
    }
    public function getUserLabel()
    {
        return mo_($this->_userLabel);
    }
    public function getSkipPasswordCheckFallback()
    {
        return $this->_skipPassFallback;
    }
    public function isDelayOtp()
    {
        return $this->_delayOtp;
    }
    public function getDelayOtpInterval()
    {
        return $this->_delayOtpInterval;
    }
}
