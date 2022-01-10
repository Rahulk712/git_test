<?php


namespace OTP\Handler\Forms;

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
use WP_Comment;
class WordPressComments extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::WPCOMMENT;
        $this->_phoneFormId = "\x69\x6e\x70\165\164\x5b\x6e\x61\x6d\145\x3d\160\x68\157\x6e\145\135";
        $this->_formKey = "\127\120\103\117\x4d\x4d\105\116\124";
        $this->_typePhoneTag = "\155\157\x5f\x77\160\x63\157\155\155\x65\156\x74\137\x70\150\157\x6e\x65\137\145\156\141\x62\x6c\145";
        $this->_typeEmailTag = "\x6d\157\x5f\167\160\x63\157\x6d\x6d\145\x6e\164\137\x65\x6d\x61\151\x6c\x5f\x65\156\141\142\x6c\145";
        $this->_formName = mo_("\x57\x6f\x72\144\120\162\145\x73\x73\40\103\x6f\155\x6d\x65\156\164\40\x46\157\x72\x6d");
        $this->_isFormEnabled = get_mo_option("\x77\x70\143\157\x6d\x6d\x65\156\x74\137\145\x6e\141\x62\154\145");
        $this->_formDocuments = MoOTPDocs::WP_COMMENT_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x77\x70\x63\157\x6d\155\145\x6e\x74\137\x65\156\141\142\x6c\145\x5f\164\171\x70\145");
        $this->_byPassLogin = get_mo_option("\167\160\143\x6f\155\155\x65\156\x74\x5f\x65\x6e\x61\x62\x6c\x65\x5f\x66\157\x72\137\x6c\157\147\x67\145\144\151\x6e\x5f\165\x73\145\x72\163");
        if (!$this->_byPassLogin) {
            goto c8;
        }
        add_filter("\x63\157\x6d\155\145\x6e\164\137\146\x6f\x72\155\137\x64\145\146\141\165\x6c\164\137\x66\151\145\x6c\144\x73", array($this, "\137\x61\x64\x64\137\143\165\x73\x74\x6f\155\x5f\x66\151\x65\154\x64\x73"), 99, 1);
        goto Io;
        c8:
        add_action("\x63\157\155\x6d\x65\x6e\164\x5f\146\157\x72\155\137\x6c\x6f\147\147\x65\x64\137\x69\x6e\137\141\x66\164\x65\162", array($this, "\x5f\141\x64\x64\137\x73\143\x72\151\x70\x74\163\x5f\141\x6e\x64\137\x61\144\x64\x69\164\151\157\156\141\x6c\137\146\151\x65\x6c\144\x73"), 1);
        add_action("\143\157\x6d\155\145\x6e\x74\137\146\x6f\162\x6d\137\141\x66\x74\145\x72\137\x66\x69\x65\154\x64\163", array($this, "\x5f\x61\144\144\x5f\x73\x63\x72\x69\x70\164\x73\x5f\x61\156\x64\137\x61\x64\144\x69\x74\151\157\x6e\x61\x6c\137\146\x69\145\154\144\163"), 1);
        Io:
        add_filter("\160\162\145\x70\x72\x6f\x63\x65\163\x73\x5f\x63\x6f\x6d\155\x65\156\x74", array($this, "\x76\x65\x72\x69\x66\x79\137\143\x6f\155\x6d\x65\156\164\x5f\x6d\x65\x74\141\137\144\141\164\141"), 1, 1);
        add_action("\143\157\x6d\x6d\x65\156\164\137\160\x6f\x73\164", array($this, "\x73\x61\x76\145\x5f\x63\157\155\x6d\145\156\x74\137\155\145\164\141\137\x64\x61\164\x61"), 1, 1);
        add_action("\x61\144\x64\137\155\x65\164\141\x5f\142\157\x78\145\x73\137\143\157\155\x6d\145\156\x74", array($this, "\145\170\x74\145\x6e\144\137\143\x6f\x6d\155\x65\156\164\137\x61\x64\x64\137\155\x65\164\141\x5f\142\157\x78"), 1, 1);
        add_action("\145\x64\151\164\x5f\143\157\155\x6d\x65\156\x74", array($this, "\145\x78\x74\x65\156\x64\137\143\x6f\x6d\155\x65\x6e\164\137\x65\x64\151\x74\x5f\x6d\x65\x74\x61\x66\151\x65\x6c\144\x73"), 1, 1);
        $this->routeData();
    }
    function routeData()
    {
        if (array_key_exists("\x6f\160\x74\151\157\156", $_GET)) {
            goto yE;
        }
        return;
        yE:
        switch (trim($_GET["\157\160\164\x69\157\x6e"])) {
            case "\155\157\x2d\143\157\155\155\145\156\164\x73\x2d\x76\145\x72\151\146\171":
                $this->_startOTPVerificationProcess($_POST);
                goto Kn;
        }
        TW:
        Kn:
    }
    function _startOTPVerificationProcess($rY)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (strcasecmp($this->_otpType, $this->_typeEmailTag) === 0 && MoUtility::sanitizeCheck("\165\x73\145\162\x5f\x65\x6d\x61\x69\x6c", $rY)) {
            goto qz;
        }
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) === 0 && MoUtility::sanitizeCheck("\x75\163\145\x72\137\x70\x68\x6f\x6e\145", $rY)) {
            goto Vt;
        }
        $bJ = strcasecmp($this->_otpType, $this->_typePhoneTag) === 0 ? MoMessages::showMessage(MoMessages::ENTER_PHONE) : MoMessages::showMessage(MoMessages::ENTER_EMAIL);
        wp_send_json(MoUtility::createJson($bJ, MoConstants::ERROR_JSON_TYPE));
        goto jw;
        Vt:
        SessionUtils::addPhoneVerified($this->_formSessionVar, trim($rY["\165\x73\x65\x72\137\x70\150\x6f\x6e\x65"]));
        $this->sendChallenge('', '', null, trim($rY["\165\163\145\162\x5f\160\x68\x6f\x6e\145"]), VerificationType::PHONE);
        jw:
        goto jg;
        qz:
        SessionUtils::addEmailVerified($this->_formSessionVar, $rY["\165\163\x65\x72\137\x65\x6d\141\x69\x6c"]);
        $this->sendChallenge('', $rY["\165\163\145\162\x5f\x65\x6d\x61\151\x6c"], null, $rY["\165\x73\145\x72\137\x65\155\x61\x69\x6c"], VerificationType::EMAIL);
        jg:
    }
    function extend_comment_edit_metafields($Cv)
    {
        if (!(!isset($_POST["\x65\170\164\x65\156\x64\137\x63\157\155\x6d\145\156\x74\x5f\165\160\144\x61\x74\x65"]) || !wp_verify_nonce($_POST["\x65\x78\164\145\156\144\x5f\143\x6f\155\155\145\x6e\164\137\x75\160\144\x61\164\x65"], "\145\170\164\145\x6e\x64\137\143\157\155\155\145\x6e\164\137\165\x70\x64\141\164\145"))) {
            goto jA;
        }
        return;
        jA:
        if (isset($_POST["\160\150\157\x6e\145"]) && $_POST["\160\150\x6f\156\x65"] != '') {
            goto DG;
        }
        delete_comment_meta($Cv, "\160\x68\157\156\145");
        goto I1;
        DG:
        $lr = wp_filter_nohtml_kses($_POST["\160\150\x6f\x6e\145"]);
        update_comment_meta($Cv, "\x70\x68\x6f\156\145", $lr);
        I1:
    }
    function extend_comment_add_meta_box()
    {
        add_meta_box("\x74\151\x74\x6c\x65", mo_("\105\x78\164\162\x61\40\106\151\145\x6c\144\163"), array($this, "\x65\170\164\145\x6e\x64\137\143\x6f\155\x6d\x65\x6e\164\x5f\155\145\164\141\137\x62\157\170"), "\143\157\155\x6d\145\156\x74", "\x6e\157\162\x6d\x61\x6c", "\150\151\x67\x68");
    }
    function extend_comment_meta_box($Yt)
    {
        $lr = get_comment_meta($Yt->comment_ID, "\160\150\x6f\156\145", true);
        wp_nonce_field("\145\170\164\145\156\x64\x5f\x63\x6f\155\155\x65\x6e\x74\137\165\x70\x64\141\164\145", "\145\170\164\x65\x6e\x64\x5f\x63\x6f\x6d\x6d\x65\156\x74\137\x75\x70\x64\x61\x74\x65", false);
        echo "\74\x74\x61\x62\x6c\145\40\x63\154\x61\163\163\75\x22\146\x6f\x72\155\55\164\x61\142\x6c\145\40\x65\144\x69\x74\143\x6f\155\155\x65\156\164\x22\x3e\15\xa\40\40\40\40\40\x20\40\x20\x20\x20\x20\40\x20\40\x20\40\74\x74\x62\x6f\x64\x79\76\15\xa\40\40\40\x20\40\x20\40\x20\x20\40\x20\x20\40\40\x20\40\74\x74\162\76\15\12\x20\x20\x20\x20\x20\40\40\40\x20\40\x20\40\40\40\40\40\x20\x20\40\x20\x3c\164\x64\x20\x63\154\x61\x73\163\x3d\x22\146\151\162\x73\164\42\76\74\x6c\141\142\x65\x6c\40\x66\157\162\75\42\x70\150\x6f\156\145\x22\x3e" . mo_("\120\150\157\156\145") . "\x3a\x3c\x2f\x6c\141\142\145\x6c\76\74\x2f\164\x64\x3e\xd\xa\40\x20\x20\x20\40\x20\40\x20\40\x20\40\x20\x20\x20\40\x20\x20\x20\x20\40\x3c\164\x64\76\x3c\151\x6e\x70\x75\164\x20\x74\x79\x70\145\75\42\164\145\x78\164\x22\x20\156\x61\x6d\x65\x3d\x22\160\x68\157\156\145\x22\40\163\x69\172\x65\75\x22\x33\x30\42\x20\x76\x61\154\x75\x65\x3d\42" . esc_attr($lr) . "\42\x20\x69\x64\x3d\x22\x70\x68\x6f\x6e\145\42\x3e\74\x2f\x74\x64\76\15\12\40\x20\40\40\x20\40\x20\40\x20\x20\x20\40\x20\40\40\40\x3c\57\x74\x72\x3e\15\xa\x20\x20\40\40\x20\40\40\40\x20\x20\40\40\x20\x20\40\40\74\x2f\x74\142\157\x64\x79\x3e\xd\12\x20\40\x20\40\40\x20\40\40\x20\40\x20\40\x3c\57\x74\x61\x62\154\x65\76";
    }
    function verify_comment_meta_data($lj)
    {
        if (!($this->_byPassLogin && is_user_logged_in())) {
            goto XS;
        }
        return $lj;
        XS:
        if (!(!isset($_POST["\x70\150\x6f\156\x65"]) && strcasecmp($this->_otpType, $this->_typePhoneTag) === 0)) {
            goto TB;
        }
        wp_die(MoMessages::showMessage(MoMessages::WPCOMMNENT_PHONE_ENTER));
        TB:
        if (isset($_POST["\166\x65\x72\151\x66\x79\157\164\160"])) {
            goto Tu;
        }
        wp_die(MoMessages::showMessage(MoMessages::WPCOMMNENT_VERIFY_ENTER));
        Tu:
        $Jw = $this->getVerificationType();
        if (SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto zI;
        }
        wp_die(MoMessages::showMessage(MoMessages::PLEASE_VALIDATE));
        zI:
        if (!($Jw === VerificationType::EMAIL && !SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $_POST["\x65\x6d\141\x69\154"]))) {
            goto DE;
        }
        wp_die(MoMessages::showMessage(MoMessages::EMAIL_MISMATCH));
        DE:
        if (!($Jw === VerificationType::PHONE && !SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $_POST["\x70\150\x6f\156\145"]))) {
            goto jV;
        }
        wp_die(MoMessages::showMessage(MoMessages::PHONE_MISMATCH));
        jV:
        $this->validateChallenge($Jw, NULL, $_POST["\166\x65\x72\x69\x66\171\157\x74\160"]);
        return $lj;
    }
    function _add_scripts_and_additional_fields()
    {
        if (!(strcasecmp($this->_otpType, $this->_typeEmailTag) === 0)) {
            goto JA;
        }
        echo $this->_getFieldHTML("\x65\155\x61\151\154");
        JA:
        if (!(strcasecmp($this->_otpType, $this->_typePhoneTag) === 0)) {
            goto J5;
        }
        echo $this->_getFieldHTML("\160\x68\157\156\145");
        J5:
        echo $this->_getFieldHTML("\166\145\x72\x69\x66\171\157\164\160");
    }
    function _add_custom_fields($TH)
    {
        if (!(strcasecmp($this->_otpType, $this->_typeEmailTag) === 0)) {
            goto aE;
        }
        $TH["\x65\155\x61\x69\154"] = $this->_getFieldHTML("\145\x6d\x61\x69\154");
        aE:
        if (!(strcasecmp($this->_otpType, $this->_typePhoneTag) === 0)) {
            goto r1;
        }
        $TH["\160\150\157\x6e\x65"] = $this->_getFieldHTML("\x70\150\x6f\156\145");
        r1:
        $TH["\x76\x65\162\x69\x66\x79\x6f\164\x70"] = $this->_getFieldHTML("\x76\145\x72\151\x66\x79\x6f\x74\x70");
        return $TH;
    }
    function _getFieldHTML($Gz)
    {
        $gV = array("\x65\x6d\141\x69\x6c" => (!is_user_logged_in() && !$this->_byPassLogin ? '' : "\74\160\40\143\154\141\163\163\75\42\143\x6f\x6d\x6d\x65\156\164\55\x66\x6f\x72\155\x2d\x65\x6d\141\151\154\42\76" . "\x3c\154\x61\x62\x65\154\x20\146\x6f\x72\x3d\x22\x65\x6d\x61\x69\154\42\x3e" . mo_("\x45\155\141\x69\154\x20\52") . "\74\x2f\x6c\141\142\x65\154\76" . "\x3c\x69\156\x70\165\x74\x20\x69\x64\75\x22\145\155\x61\151\154\42\x20\x6e\141\x6d\145\75\42\145\155\x61\x69\154\42\40\x74\171\x70\x65\75\42\164\145\170\x74\x22\40\163\x69\172\x65\75\x22\63\x30\x22\x20\40\164\x61\142\151\x6e\x64\x65\170\x3d\42\64\x22\x20\x2f\76" . "\x3c\x2f\160\x3e") . $this->get_otp_html_content("\145\155\x61\x69\x6c"), "\160\x68\x6f\x6e\145" => "\x3c\160\x20\x63\154\141\x73\163\75\x22\x63\157\155\155\x65\156\x74\x2d\x66\157\x72\155\55\145\155\141\x69\154\42\76" . "\74\154\141\142\x65\154\x20\146\157\162\x3d\x22\x70\150\x6f\156\x65\x22\76" . mo_("\120\150\157\156\145\x20\52") . "\x3c\x2f\x6c\x61\142\x65\154\76" . "\x3c\151\x6e\x70\x75\164\x20\x69\144\75\42\160\x68\157\156\145\42\40\156\141\155\x65\75\42\x70\150\x6f\x6e\x65\x22\x20\x74\x79\x70\145\75\x22\x74\x65\170\x74\42\x20\x73\x69\172\x65\75\42\x33\x30\42\40\x20\164\x61\142\x69\x6e\x64\x65\x78\75\42\64\42\x20\57\76" . "\74\57\x70\76" . $this->get_otp_html_content("\x70\x68\157\x6e\145"), "\166\x65\162\x69\146\x79\x6f\164\160" => "\74\160\40\143\x6c\141\163\x73\75\x22\143\157\x6d\155\145\156\x74\x2d\x66\x6f\x72\x6d\55\145\x6d\x61\x69\x6c\x22\76" . "\x3c\154\141\142\145\x6c\40\x66\157\x72\75\x22\x76\x65\x72\x69\x66\x79\157\x74\160\x22\x3e" . mo_("\126\145\x72\x69\146\x69\143\x61\x74\151\157\x6e\x20\x43\157\144\x65") . "\74\57\154\x61\142\x65\154\76" . "\74\x69\x6e\x70\x75\x74\x20\151\x64\x3d\42\x76\x65\x72\x69\x66\x79\157\164\160\42\40\156\x61\155\145\x3d\x22\x76\x65\162\151\x66\x79\157\164\160\x22\40\x74\x79\x70\x65\75\42\x74\145\170\164\42\x20\x73\151\x7a\145\x3d\42\x33\60\x22\40\40\x74\x61\142\151\156\x64\x65\x78\x3d\x22\64\x22\x20\x2f\76" . "\74\57\160\76\x3c\142\162\76");
        return $gV[$Gz];
    }
    function get_otp_html_content($so)
    {
        $Mt = "\x3c\144\151\x76\x20\163\x74\x79\x6c\145\75\x27\x64\x69\163\x70\x6c\141\171\72\x74\141\x62\154\145\x3b\164\145\x78\164\55\x61\154\151\147\x6e\x3a\x63\x65\156\x74\x65\162\x3b\47\76\74\x69\155\x67\x20\163\x72\x63\x3d\x27" . MOV_URL . "\x69\x6e\143\154\165\x64\x65\x73\57\x69\155\x61\147\x65\x73\57\x6c\x6f\141\144\x65\162\x2e\x67\x69\x66\47\76\x3c\57\144\x69\x76\x3e";
        $zn = "\74\x64\x69\166\40\x73\x74\171\154\x65\x3d\x22\x6d\141\162\147\x69\156\55\x62\x6f\x74\164\157\x6d\x3a\x33\45\42\76\x3c\151\156\x70\x75\x74\x20\164\x79\x70\145\75\x22\142\x75\x74\x74\x6f\x6e\42\x20\x63\x6c\141\163\x73\x3d\42\x62\x75\x74\164\x6f\x6e\40\141\154\x74\x22\x20\x73\x74\x79\154\x65\75\42\167\x69\x64\164\x68\x3a\61\60\x30\x25\x22\40\151\x64\x3d\42\155\151\156\x69\157\x72\x61\x6e\x67\x65\137\157\164\160\x5f\x74\x6f\153\145\156\137\163\x75\x62\155\151\164\x22";
        $zn .= strcasecmp($this->_otpType, $this->_typePhoneTag) === 0 ? "\x74\x69\164\154\145\x3d\x22\x50\x6c\x65\x61\x73\x65\x20\105\156\164\x65\x72\x20\x61\x20\160\x68\157\156\145\x20\156\x75\155\x62\145\x72\40\164\x6f\40\x65\156\141\x62\154\145\40\x74\150\x69\x73\x2e\x22\40" : "\164\151\164\x6c\145\75\x22\120\154\x65\141\x73\145\40\x45\156\x74\145\x72\x20\141\40\145\x6d\x61\151\x6c\40\156\165\155\x62\x65\x72\x20\x74\x6f\40\145\156\141\142\154\145\40\x74\x68\151\163\56\42\x20";
        $zn .= strcasecmp($this->_otpType, $this->_typePhoneTag) === 0 ? "\166\x61\154\x75\x65\x3d\42\103\154\151\x63\153\x20\150\145\x72\145\x20\x74\157\40\166\145\162\x69\146\x79\40\x79\157\165\x72\x20\120\150\x6f\156\x65\42\x3e" : "\166\141\x6c\165\x65\75\42\103\154\x69\143\x6b\40\x68\x65\x72\145\40\164\157\x20\166\x65\x72\151\x66\171\x20\171\157\x75\x72\x20\105\x6d\x61\151\x6c\42\76";
        $zn .= "\74\x64\151\x76\40\x69\144\75\x22\x6d\157\x5f\155\x65\163\x73\x61\147\145\42\x20\x68\151\x64\x64\145\x6e\75\42\42\40\163\164\x79\x6c\145\75\42\142\x61\x63\153\147\x72\157\x75\x6e\144\x2d\x63\x6f\154\157\x72\72\40\x23\146\x37\146\66\146\x37\x3b\160\x61\x64\144\151\156\x67\72\40\x31\x65\x6d\40\x32\145\155\x20\x31\x65\155\40\63\56\65\145\155\73\x22\x3e\x3c\x2f\144\x69\166\76\x3c\x2f\144\x69\166\76";
        $zn .= "\74\x73\143\162\x69\160\x74\x3e\x6a\121\x75\x65\x72\x79\x28\144\x6f\143\x75\x6d\145\x6e\x74\x29\56\162\x65\141\x64\171\50\146\x75\156\x63\164\151\x6f\156\50\51\173\x24\155\x6f\x3d\152\121\165\145\162\171\73\x24\155\x6f\50\42\43\x6d\151\x6e\x69\157\x72\141\156\x67\x65\x5f\157\164\x70\137\164\157\153\145\x6e\x5f\163\x75\142\x6d\x69\164\42\x29\56\143\154\151\x63\x6b\x28\146\165\156\143\164\151\157\156\x28\x6f\51\x7b";
        $zn .= "\x76\x61\x72\x20\145\x3d\x24\155\x6f\50\42\x69\156\160\165\x74\x5b\x6e\x61\155\145\x3d" . $so . "\135\x22\51\x2e\166\x61\154\50\x29\x3b\40\x24\155\157\50\42\43\155\157\x5f\x6d\x65\x73\163\x61\147\145\42\51\56\145\155\x70\x74\x79\50\51\x2c\44\x6d\x6f\x28\x22\x23\x6d\x6f\137\155\x65\163\163\x61\x67\145\x22\51\x2e\141\x70\x70\145\x6e\x64\50\42" . $Mt . "\42\51\54";
        $zn .= "\x24\155\x6f\50\x22\43\155\157\137\155\x65\163\x73\x61\x67\x65\42\51\x2e\x73\x68\157\167\x28\x29\54\44\155\x6f\x2e\141\152\141\170\50\x7b\165\x72\154\72\42" . site_url() . "\57\x3f\157\x70\x74\x69\157\156\75\x6d\157\x2d\x63\x6f\155\155\x65\x6e\164\x73\55\x76\x65\162\151\x66\x79\42\x2c\164\x79\160\x65\x3a\x22\120\x4f\123\124\x22\54";
        $zn .= "\x64\141\164\141\x3a\x7b\x75\x73\145\x72\137\x70\x68\x6f\x6e\145\x3a\145\x2c\x75\x73\x65\x72\x5f\145\x6d\x61\151\x6c\72\x65\175\54\143\x72\x6f\x73\x73\104\157\x6d\x61\151\156\72\x21\x30\54\x64\141\164\x61\124\171\x70\145\72\42\152\x73\x6f\156\42\x2c\x73\165\143\143\145\163\163\72\x66\x75\156\143\x74\151\157\x6e\50\157\51\x7b\x20\x69\x66\50\157\56\162\145\163\165\x6c\x74\75\x3d\75\42\163\x75\143\x63\145\163\x73\42\51\173";
        $zn .= "\44\x6d\157\50\x22\x23\155\157\x5f\x6d\x65\x73\x73\141\147\145\42\x29\56\x65\155\x70\x74\x79\x28\x29\x2c\44\155\x6f\x28\x22\x23\155\157\137\x6d\x65\163\163\141\x67\x65\x22\51\x2e\x61\x70\x70\145\x6e\x64\x28\157\x2e\155\145\163\x73\x61\147\x65\x29\54\44\155\x6f\50\42\43\155\157\137\155\x65\163\x73\141\x67\x65\x22\51\x2e\x63\163\x73\x28\42\x62\157\162\144\145\162\x2d\164\157\x70\x22\x2c\42\63\x70\170\x20\163\x6f\154\151\x64\x20\x67\162\145\x65\x6e\x22\x29\x2c";
        $zn .= "\x24\x6d\157\50\x22\151\156\160\165\164\133\x6e\141\x6d\x65\75\145\x6d\x61\151\x6c\137\166\145\x72\x69\x66\171\135\x22\x29\x2e\x66\157\x63\165\x73\50\x29\175\x65\x6c\x73\x65\173\x24\x6d\x6f\50\x22\x23\x6d\157\137\155\x65\163\x73\x61\147\145\42\51\x2e\145\155\x70\164\171\50\x29\x2c\44\155\157\x28\42\43\155\x6f\x5f\155\x65\163\163\141\147\x65\x22\51\56\x61\x70\160\145\x6e\x64\x28\x6f\56\155\x65\163\163\141\147\x65\x29\54";
        $zn .= "\x24\x6d\x6f\x28\x22\43\155\x6f\137\155\145\163\163\141\147\145\x22\51\56\143\x73\x73\50\42\x62\x6f\162\x64\145\162\x2d\164\x6f\x70\x22\x2c\42\63\x70\x78\40\x73\x6f\x6c\x69\144\40\162\145\144\42\51\54\x24\x6d\157\50\x22\151\x6e\160\165\x74\133\x6e\141\x6d\145\x3d\160\150\157\x6e\145\x5f\x76\145\x72\x69\x66\171\x5d\x22\x29\x2e\146\x6f\143\165\163\x28\51\175\40\73\175\x2c";
        $zn .= "\x65\162\162\x6f\x72\72\146\x75\156\x63\164\151\x6f\x6e\50\157\54\x65\54\x6e\51\173\175\175\x29\x7d\51\73\175\x29\73\74\57\x73\x63\162\151\160\x74\x3e";
        return $zn;
    }
    function save_comment_meta_data($Cv)
    {
        if (!(isset($_POST["\160\150\x6f\x6e\x65"]) && $_POST["\160\x68\157\x6e\145"] != '')) {
            goto iK;
        }
        $lr = wp_filter_nohtml_kses($_POST["\160\x68\x6f\156\145"]);
        add_comment_meta($Cv, "\160\150\157\x6e\145", $lr);
        iK:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        wp_die(MoUtility::_get_invalid_otp_method());
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
            goto Yl;
        }
        array_push($lP, $this->_phoneFormId);
        Yl:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto nS;
        }
        return;
        nS:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\167\160\x63\157\155\x6d\145\156\x74\137\145\x6e\141\142\x6c\145");
        $this->_otpType = $this->sanitizeFormPOST("\167\x70\x63\157\x6d\x6d\x65\156\x74\137\x65\x6e\141\x62\x6c\x65\x5f\164\171\160\x65");
        $this->_byPassLogin = $this->sanitizeFormPOST("\x77\160\x63\157\x6d\x6d\x65\156\164\x5f\x65\156\141\142\x6c\x65\x5f\x66\157\x72\137\154\x6f\147\x67\145\x64\151\156\x5f\x75\163\145\x72\x73");
        update_mo_option("\167\160\143\x6f\x6d\155\x65\x6e\x74\x5f\x65\156\x61\142\154\x65", $this->_isFormEnabled);
        update_mo_option("\x77\x70\x63\x6f\x6d\155\x65\156\164\x5f\145\x6e\141\x62\x6c\145\x5f\164\x79\x70\x65", $this->_otpType);
        update_mo_option("\167\x70\x63\157\155\155\145\x6e\x74\137\145\x6e\141\142\154\x65\137\x66\x6f\162\x5f\x6c\157\x67\x67\x65\x64\151\156\x5f\x75\x73\x65\x72\163", $this->_byPassLogin);
    }
}
