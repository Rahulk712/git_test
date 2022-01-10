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
use OTP\Traits\Instance;
use ReflectionException;
use WC_Emails;
use WC_Social_Login_Provider_Profile;
class WooCommerceSocialLoginForm extends FormHandler implements IFormHandler
{
    use Instance;
    private $_oAuthProviders = array("\x66\x61\x63\x65\x62\x6f\x6f\x6b", "\164\x77\151\164\x74\x65\162", "\x67\x6f\x6f\147\x6c\145", "\x61\x6d\141\x7a\x6f\x6e", "\154\x69\156\153\145\x64\x49\x6e", "\160\x61\171\x70\x61\154", "\151\156\x73\x74\x61\x67\162\x61\x6d", "\144\151\x73\x71\x75\x73", "\x79\x61\x68\x6f\x6f", "\x76\x6b");
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = TRUE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::WC_SOCIAL_LOGIN;
        $this->_otpType = "\x70\x68\x6f\x6e\x65";
        $this->_phoneFormId = "\43\x6d\x6f\x5f\160\x68\157\x6e\x65\137\x6e\165\x6d\142\x65\x72";
        $this->_formKey = "\x57\103\x5f\x53\117\x43\x49\x41\x4c\x5f\114\x4f\107\111\x4e";
        $this->_formName = mo_("\x57\157\x6f\143\x6f\x6d\x6d\x65\x72\143\x65\x20\x53\157\143\151\141\154\40\x4c\157\147\151\156\40\74\x69\76\x28\x20\123\x4d\123\40\126\x65\x72\x69\146\x69\143\x61\x74\x69\157\x6e\x20\x4f\x6e\x6c\x79\40\51\x3c\57\x69\x3e");
        $this->_isFormEnabled = get_mo_option("\x77\143\137\163\x6f\143\x69\141\x6c\x5f\154\x6f\147\151\156\137\145\x6e\x61\x62\154\145");
        $this->_formDocuments = MoOTPDocs::WC_SOCIAL_LOGIN;
        parent::__construct();
    }
    function handleForm()
    {
        $this->includeRequiredFiles();
        foreach ($this->_oAuthProviders as $xW) {
            add_filter("\167\143\137\x73\157\x63\x69\141\154\x5f\x6c\157\147\151\x6e\x5f" . $xW . "\x5f\160\x72\x6f\x66\151\154\x65", array($this, "\155\157\137\x77\143\137\x73\x6f\143\x69\x61\154\137\154\157\147\x69\156\x5f\160\162\x6f\146\x69\x6c\145"), 99, 2);
            add_filter("\x77\143\x5f\163\157\143\151\141\x6c\x5f\154\x6f\x67\x69\156\x5f" . $xW . "\x5f\156\x65\x77\137\165\x73\145\162\137\x64\141\164\141", array($this, "\x6d\x6f\137\167\x63\x5f\163\x6f\x63\151\141\x6c\137\x6c\x6f\147\151\156"), 99, 2);
            XM:
        }
        X2:
        $this->routeData();
    }
    function routeData()
    {
        if (array_key_exists("\x6f\160\x74\x69\157\x6e", $_REQUEST)) {
            goto GA;
        }
        return;
        GA:
        switch (trim($_REQUEST["\x6f\160\x74\151\x6f\x6e"])) {
            case "\x6d\151\156\151\157\162\x61\156\x67\145\x2d\141\x6a\141\x78\55\x6f\x74\160\x2d\147\145\x6e\x65\162\x61\164\145":
                $this->_handle_wc_ajax_send_otp($_POST);
                goto OX;
            case "\155\151\x6e\151\157\x72\x61\x6e\147\145\x2d\141\152\x61\170\55\x6f\x74\x70\x2d\x76\x61\x6c\x69\x64\141\x74\145":
                $this->processOTPEntered($_REQUEST);
                goto OX;
            case "\x6d\157\137\141\152\x61\x78\x5f\x66\157\162\x6d\137\x76\x61\x6c\x69\144\141\164\145":
                $this->_handle_wc_create_user_action($_POST);
                goto OX;
        }
        O0:
        OX:
    }
    function includeRequiredFiles()
    {
        if (function_exists("\x69\x73\x5f\160\154\165\147\151\156\137\141\143\x74\x69\166\145")) {
            goto YC;
        }
        include_once ABSPATH . "\167\x70\55\x61\x64\x6d\x69\x6e\57\151\x6e\x63\154\x75\x64\145\163\57\160\154\165\147\151\x6e\x2e\160\150\x70";
        YC:
        if (!is_plugin_active("\167\x6f\x6f\143\157\155\x6d\x65\x72\x63\x65\55\163\x6f\143\x69\x61\x6c\x2d\154\157\147\151\x6e\57\x77\157\x6f\x63\157\155\155\x65\162\x63\x65\55\x73\x6f\x63\x69\x61\154\55\x6c\157\147\151\156\x2e\160\150\160")) {
            goto f3;
        }
        require_once plugin_dir_path(MOV_DIR) . "\167\x6f\x6f\143\x6f\x6d\155\145\162\143\x65\x2d\x73\157\143\151\x61\154\x2d\x6c\x6f\x67\x69\x6e\57\151\156\143\x6c\x75\144\x65\x73\x2f\x63\154\141\163\163\55\167\143\55\x73\x6f\143\151\x61\154\x2d\154\x6f\x67\151\156\x2d\x70\x72\x6f\x76\151\144\x65\162\55\160\x72\x6f\146\151\x6c\145\x2e\160\150\160";
        f3:
    }
    function mo_wc_social_login_profile($le, $Ej)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        MoPHPSessions::addSessionVar("\167\x63\137\x70\162\x6f\166\x69\144\x65\162", $le);
        $_SESSION["\167\143\x5f\160\162\x6f\166\151\x64\145\162\137\x69\144"] = maybe_serialize($Ej);
        return $le;
    }
    function mo_wc_social_login($lF, $le)
    {
        $this->sendChallenge(NULL, $lF["\x75\x73\145\x72\x5f\x65\x6d\141\x69\x6c"], NULL, NULL, "\x65\170\164\x65\x72\x6e\x61\154", NULL, array("\x64\x61\x74\x61" => $lF, "\155\145\x73\x73\x61\147\x65" => MoMessages::showMessage(MoMessages::PHONE_VALIDATION_MSG), "\146\x6f\x72\155" => "\x57\103\x5f\123\x4f\x43\111\101\114", "\143\x75\162\x6c" => MoUtility::currentPageUrl()));
    }
    function _handle_wc_create_user_action($gt)
    {
        if (!(!$this->checkIfVerificationNotStarted() && SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $this->getVerificationType()))) {
            goto tc;
        }
        $this->create_new_wc_social_customer($gt);
        tc:
    }
    function create_new_wc_social_customer($pW)
    {
        require_once plugin_dir_path(MOV_DIR) . "\167\157\x6f\143\x6f\155\x6d\145\x72\143\145\57\x69\x6e\x63\154\x75\144\145\x73\57\143\154\141\163\163\x2d\167\143\x2d\145\x6d\x61\151\x6c\163\56\160\x68\160";
        WC_Emails::init_transactional_emails();
        $BB = MoPHPSessions::getSessionVar("\x77\x63\x5f\x70\x72\x6f\166\151\144\x65\x72");
        $Ej = maybe_unserialize($_SESSION["\167\x63\137\x70\x72\x6f\166\151\144\145\x72\x5f\151\x64"]);
        $this->unsetOTPSessionVariables();
        $le = new WC_Social_Login_Provider_Profile($Ej, $BB);
        $lr = $pW["\155\x6f\x5f\x70\150\x6f\x6e\x65\137\x6e\x75\x6d\142\x65\x72"];
        $pW = array("\x72\157\154\145" => "\x63\x75\163\164\157\155\145\162", "\x75\x73\x65\162\137\x6c\157\x67\151\x6e" => $le->has_email() ? sanitize_email($le->get_email()) : $le->get_nickname(), "\x75\163\145\162\137\145\x6d\141\x69\x6c" => $le->get_email(), "\x75\163\145\162\137\x70\x61\163\x73" => wp_generate_password(), "\x66\151\162\x73\x74\137\x6e\x61\155\x65" => $le->get_first_name(), "\154\x61\163\164\x5f\156\x61\155\145" => $le->get_last_name());
        if (!empty($pW["\165\163\145\x72\x5f\x6c\157\x67\x69\156"])) {
            goto Tx;
        }
        $pW["\x75\x73\x65\162\x5f\154\157\x67\151\156"] = $pW["\146\x69\x72\x73\164\137\x6e\x61\155\x65"] . $pW["\x6c\x61\x73\164\137\156\x61\155\145"];
        Tx:
        $hf = 1;
        $bt = $pW["\x75\163\x65\x72\x5f\x6c\x6f\x67\151\x6e"];
        gM:
        if (!username_exists($pW["\165\x73\145\x72\137\154\x6f\x67\x69\156"])) {
            goto QH;
        }
        $pW["\165\x73\x65\x72\137\154\x6f\147\x69\x6e"] = $bt . $hf;
        $hf++;
        goto gM;
        QH:
        $jT = wp_insert_user($pW);
        update_user_meta($jT, "\142\x69\x6c\x6c\x69\x6e\x67\x5f\x70\x68\x6f\x6e\145", MoUtility::processPhoneNumber($lr));
        update_user_meta($jT, "\x74\x65\154\x65\x70\x68\x6f\156\145", MoUtility::processPhoneNumber($lr));
        do_action("\167\157\157\143\x6f\155\155\145\162\143\x65\137\x63\162\x65\x61\164\x65\144\137\143\x75\x73\164\x6f\x6d\x65\x72", $jT, $pW, false);
        $user = get_user_by("\151\144", $jT);
        $le->update_customer_profile($user->ID, $user);
        if (!($bJ = apply_filters("\167\143\x5f\163\x6f\x63\x69\x61\x6c\137\x6c\157\147\151\156\137\x73\145\164\x5f\x61\x75\x74\150\137\143\157\x6f\x6b\x69\145", '', $user))) {
            goto uz;
        }
        wc_add_notice($bJ, "\x6e\x6f\164\151\143\145");
        goto Vz;
        uz:
        wc_set_customer_auth_cookie($user->ID);
        update_user_meta($user->ID, "\137\x77\x63\x5f\x73\157\x63\x69\x61\x6c\137\x6c\x6f\x67\x69\156\x5f" . $le->get_provider_id() . "\x5f\154\x6f\147\151\x6e\137\164\151\x6d\x65\163\164\x61\x6d\160", current_time("\164\151\x6d\145\x73\164\141\x6d\160"));
        update_user_meta($user->ID, "\137\167\143\x5f\163\x6f\143\x69\141\154\137\154\x6f\x67\151\156\137" . $le->get_provider_id() . "\137\x6c\157\147\151\x6e\137\164\x69\155\x65\x73\164\141\x6d\160\137\x67\x6d\164", time());
        do_action("\167\143\137\163\157\x63\x69\x61\154\x5f\x6c\157\x67\x69\x6e\x5f\165\x73\145\x72\x5f\141\165\x74\x68\145\x6e\x74\x69\x63\141\164\145\x64", $user->ID, $le->get_provider_id());
        Vz:
        if (is_wp_error($jT)) {
            goto p9;
        }
        $this->redirect(null, $jT);
        goto eN;
        p9:
        $this->redirect("\145\162\x72\x6f\x72", 0, $jT->get_error_code());
        eN:
    }
    function redirect($WP = null, $d2 = 0, $OV = "\x77\143\55\163\157\143\151\141\x6c\55\x6c\x6f\147\x69\156\55\145\x72\x72\157\162")
    {
        $user = get_user_by("\151\144", $d2);
        if (MoUtility::isBlank($user->user_email)) {
            goto KX;
        }
        $Lu = get_transient("\167\143\163\x6c\137" . md5($_SERVER["\122\x45\x4d\x4f\124\x45\x5f\101\x44\x44\x52"] . $_SERVER["\110\124\124\120\137\125\123\105\x52\137\101\107\x45\116\124"]));
        $Lu = $Lu ? esc_url(urldecode($Lu)) : wc_get_page_permalink("\x6d\x79\x61\x63\x63\x6f\x75\156\164");
        delete_transient("\167\x63\163\x6c\137" . md5($_SERVER["\122\105\115\117\124\x45\137\101\x44\x44\x52"] . $_SERVER["\110\x54\124\x50\137\x55\x53\x45\x52\137\x41\107\105\x4e\124"]));
        goto u6;
        KX:
        $Lu = add_query_arg("\x77\x63\x2d\163\x6f\143\151\141\x6c\x2d\154\157\147\x69\156\x2d\x6d\x69\163\163\151\x6e\147\x2d\x65\155\141\x69\x6c", "\x74\x72\165\145", wc_customer_edit_account_url());
        u6:
        if (!("\x65\x72\162\x6f\x72" === $WP)) {
            goto Ph;
        }
        $Lu = add_query_arg($OV, "\x74\x72\x75\145", $Lu);
        Ph:
        wp_safe_redirect(esc_url_raw($Lu));
        die;
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        wp_send_json(MoUtility::createJson(MoUtility::_get_invalid_otp_method(), MoConstants::ERROR_JSON_TYPE));
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
        wp_send_json(MoUtility::createJson(MoConstants::SUCCESS, MoConstants::SUCCESS_JSON_TYPE));
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    function _handle_wc_ajax_send_otp($Jf)
    {
        if ($this->checkIfVerificationNotStarted()) {
            goto vn;
        }
        $this->sendChallenge("\x61\152\141\x78\x5f\160\x68\157\x6e\x65", '', null, trim($Jf["\165\163\145\x72\137\x70\150\157\x6e\x65"]), $this->_otpType, null, $Jf);
        vn:
    }
    function processOTPEntered($Jf)
    {
        if (!$this->checkIfVerificationNotStarted()) {
            goto WA;
        }
        return;
        WA:
        if ($this->processPhoneNumber($Jf)) {
            goto jY;
        }
        $this->validateChallenge($this->getVerificationType());
        goto WM;
        jY:
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(MoMessages::PHONE_MISMATCH), MoConstants::ERROR_JSON_TYPE));
        WM:
    }
    function processPhoneNumber($Jf)
    {
        $lr = MoPHPSessions::getSessionVar("\160\x68\157\156\145\x5f\156\x75\x6d\x62\145\162\x5f\x6d\x6f");
        return strcmp($lr, MoUtility::processPhoneNumber($Jf["\x75\x73\145\x72\x5f\x70\150\157\156\x65"])) != 0;
    }
    function checkIfVerificationNotStarted()
    {
        return !SessionUtils::isOTPInitialized($this->_formSessionVar);
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!$this->isFormEnabled()) {
            goto q1;
        }
        array_push($lP, $this->_phoneFormId);
        q1:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto uO;
        }
        return;
        uO:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\167\143\x5f\163\x6f\143\x69\x61\x6c\137\154\x6f\147\151\156\137\x65\x6e\141\x62\154\x65");
        update_mo_option("\x77\x63\x5f\163\157\143\151\x61\x6c\x5f\x6c\157\x67\151\156\x5f\145\156\x61\x62\x6c\x65", $this->_isFormEnabled);
    }
}
