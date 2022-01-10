<?php


namespace OTP\Handler;

if (defined("\101\102\123\120\x41\x54\x48")) {
    goto RY;
}
die;
RY:
use OTP\Helper\CountryList;
use OTP\Helper\GatewayFunctions;
use OTP\Helper\MoConstants;
use OTP\Helper\MocURLOTP;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;
use OTP\Objects\BaseActionHandler;
use OTP\Objects\PluginPageDetails;
use OTP\Objects\TabDetails;
use OTP\Objects\Tabs;
use OTP\Traits\Instance;
class MoOTPActionHandlerHandler extends BaseActionHandler
{
    use Instance;
    function __construct()
    {
        parent::__construct();
        $this->_nonce = "\155\157\137\x61\144\155\x69\156\x5f\x61\143\164\x69\x6f\x6e\163";
        add_action("\141\144\x6d\151\156\x5f\x69\x6e\151\164", array($this, "\137\150\141\x6e\144\x6c\145\x5f\141\144\155\x69\x6e\137\141\x63\164\151\157\x6e\x73"), 1);
        add_action("\x61\x64\155\x69\156\x5f\x69\x6e\x69\x74", array($this, "\155\157\x53\143\150\x65\x64\x75\154\x65\124\162\x61\156\x73\x61\x63\x74\151\157\x6e\123\x79\x6e\x63"), 1);
        add_action("\x61\144\x6d\151\x6e\x5f\x69\156\x69\x74", array($this, "\x63\x68\145\143\153\111\x66\120\x6f\160\x75\x70\x54\145\x6d\160\154\141\x74\145\x41\162\145\x53\145\164"), 1);
        add_filter("\144\141\x73\150\142\x6f\x61\x72\x64\x5f\147\154\x61\156\x63\x65\x5f\x69\x74\x65\155\163", array($this, "\x6f\x74\160\x5f\164\x72\x61\156\x73\x61\143\164\x69\x6f\156\x73\x5f\x67\154\141\156\143\145\137\x63\x6f\x75\156\164\x65\162"), 10, 1);
        add_action("\x61\x64\155\151\x6e\137\x70\157\x73\164\x5f\155\151\x6e\x69\x6f\162\x61\156\x67\145\x5f\x67\x65\164\137\146\157\x72\155\137\x64\x65\164\x61\151\x6c\163", array($this, "\x73\150\157\x77\x46\157\x72\155\110\x54\115\x4c\x44\x61\x74\141"));
    }
    function _handle_admin_actions()
    {
        if (isset($_POST["\157\160\x74\151\x6f\156"])) {
            goto jf;
        }
        return;
        jf:
        switch ($_POST["\x6f\x70\164\151\x6f\x6e"]) {
            case "\x6d\157\x5f\143\165\163\x74\x6f\x6d\145\162\137\166\x61\x6c\151\144\141\x74\151\157\x6e\x5f\x73\x65\x74\164\x69\x6e\147\163":
                $this->_save_settings($_POST);
                goto fC;
            case "\x6d\157\x5f\x63\165\x73\164\157\155\145\162\137\166\x61\x6c\x69\x64\141\x74\151\157\x6e\137\155\x65\163\163\141\147\x65\163":
                $this->_handle_custom_messages_form_submit($_POST);
                goto fC;
            case "\155\x6f\x5f\166\141\x6c\151\x64\141\164\151\157\x6e\137\143\157\156\x74\141\143\164\x5f\165\163\137\161\165\145\x72\x79\x5f\157\160\164\x69\x6f\156":
                $this->_mo_validation_support_query($_POST);
                goto fC;
            case "\155\157\x5f\157\164\160\137\x65\170\x74\x72\141\137\x73\x65\164\x74\151\156\147\163":
                $this->_save_extra_settings($_POST);
                goto fC;
            case "\155\x6f\x5f\157\x74\160\x5f\x66\145\145\x64\142\141\x63\153\137\157\160\164\151\157\x6e":
                $this->_mo_validation_feedback_query();
                goto fC;
            case "\143\150\145\x63\x6b\x5f\155\x6f\x5f\x6c\156":
                $this->_mo_check_l();
                goto fC;
            case "\x6d\x6f\137\x63\165\163\164\157\x6d\x65\x72\x5f\x76\x61\154\151\144\x61\164\x69\x6f\156\x5f\163\x6d\163\x5f\143\157\x6e\146\x69\147\165\x72\141\164\151\157\x6e":
                $this->_mo_configure_sms_template($_POST);
                goto fC;
            case "\155\157\x5f\x63\x75\163\x74\x6f\155\x65\x72\x5f\x76\141\154\x69\144\x61\x74\x69\157\156\x5f\x65\155\x61\x69\x6c\137\143\157\156\146\151\x67\x75\x72\x61\x74\x69\157\x6e":
                $this->_mo_configure_email_template($_POST);
                goto fC;
        }
        yy:
        fC:
    }
    function _handle_custom_messages_form_submit($post)
    {
        $this->isValidRequest();
        update_mo_option("\x73\x75\x63\143\145\x73\x73\x5f\145\x6d\x61\151\x6c\x5f\x6d\x65\163\163\141\147\145", MoUtility::sanitizeCheck("\157\x74\160\137\x73\x75\143\143\145\x73\x73\137\145\155\x61\x69\154", $post), "\x6d\x6f\137\x6f\164\x70\137");
        update_mo_option("\x73\x75\x63\143\145\163\163\137\x70\x68\x6f\156\145\137\155\x65\163\x73\141\x67\145", MoUtility::sanitizeCheck("\157\x74\x70\x5f\163\x75\x63\x63\x65\x73\x73\x5f\x70\150\x6f\x6e\x65", $post), "\155\157\x5f\x6f\164\160\137");
        update_mo_option("\145\x72\162\x6f\x72\137\x70\x68\x6f\156\x65\x5f\x6d\x65\163\x73\141\x67\x65", MoUtility::sanitizeCheck("\157\164\160\x5f\145\162\x72\157\162\x5f\160\150\x6f\156\x65", $post), "\x6d\x6f\x5f\157\164\160\137");
        update_mo_option("\145\x72\x72\x6f\162\137\145\155\141\x69\x6c\137\x6d\x65\x73\163\x61\x67\145", MoUtility::sanitizeCheck("\x6f\x74\160\137\145\x72\x72\x6f\162\x5f\145\x6d\141\151\x6c", $post), "\155\157\x5f\x6f\x74\160\x5f");
        update_mo_option("\151\x6e\x76\x61\154\151\x64\137\x70\150\x6f\x6e\145\x5f\x6d\145\x73\x73\141\147\x65", MoUtility::sanitizeCheck("\157\164\x70\x5f\151\x6e\166\x61\154\x69\144\137\160\x68\157\x6e\x65", $post), "\x6d\x6f\137\x6f\x74\x70\x5f");
        update_mo_option("\x69\x6e\166\141\154\151\x64\137\x65\x6d\x61\x69\x6c\x5f\x6d\x65\163\163\x61\147\x65", MoUtility::sanitizeCheck("\x6f\164\160\137\151\156\x76\141\154\151\144\137\145\155\x61\x69\x6c", $post), "\155\x6f\x5f\x6f\164\160\137");
        update_mo_option("\x69\156\166\x61\x6c\x69\x64\x5f\x6d\x65\x73\x73\141\147\145", MoUtility::sanitizeCheck("\x69\x6e\166\x61\x6c\x69\x64\137\x6f\164\160", $post), "\155\157\x5f\x6f\164\x70\137");
        update_mo_option("\x62\154\157\143\x6b\145\x64\x5f\x65\x6d\141\151\154\x5f\x6d\x65\x73\x73\141\147\x65", MoUtility::sanitizeCheck("\157\164\160\137\x62\154\x6f\x63\153\x65\144\137\x65\x6d\141\x69\x6c", $post), "\x6d\x6f\x5f\157\x74\160\x5f");
        update_mo_option("\142\154\x6f\143\x6b\145\144\x5f\x70\x68\157\x6e\145\137\x6d\145\x73\x73\141\147\145", MoUtility::sanitizeCheck("\157\164\160\x5f\142\154\157\143\153\145\144\x5f\160\150\x6f\x6e\x65", $post), "\155\157\137\x6f\x74\x70\137");
        do_action("\155\157\x5f\162\145\147\151\163\164\x72\141\x74\x69\x6f\156\x5f\163\x68\x6f\x77\137\x6d\x65\163\x73\141\147\145", MoMessages::showMessage(MoMessages::MSG_TEMPLATE_SAVED), "\123\x55\x43\103\105\x53\x53");
    }
    function _save_settings($A2)
    {
        $bf = TabDetails::instance();
        $oc = $bf->_tabDetails[Tabs::FORMS];
        $this->isValidRequest();
        if (!(MoUtility::sanitizeCheck("\x70\x61\x67\x65", $_GET) !== $oc->_menuSlug && $A2["\x65\x72\162\x6f\x72\137\155\x65\x73\163\141\x67\145"])) {
            goto BM;
        }
        do_action("\155\x6f\x5f\162\x65\147\151\x73\x74\162\141\x74\x69\157\156\x5f\x73\150\157\167\137\x6d\145\163\163\141\x67\145", MoMessages::showMessage($A2["\145\x72\162\x6f\x72\137\x6d\145\163\163\x61\147\x65"]), "\105\x52\x52\x4f\122");
        BM:
    }
    function _save_extra_settings($A2)
    {
        $this->isValidRequest();
        delete_site_option("\144\145\x66\141\x75\154\164\x5f\143\x6f\x75\156\164\162\171\x5f\x63\x6f\x64\145");
        $oM = isset($A2["\144\145\x66\x61\x75\x6c\164\137\x63\157\x75\x6e\164\x72\x79\137\143\157\144\145"]) ? $A2["\x64\x65\146\x61\165\154\x74\x5f\143\157\x75\156\x74\x72\171\x5f\143\157\144\145"] : '';
        update_mo_option("\144\x65\146\x61\165\x6c\x74\x5f\143\x6f\x75\x6e\x74\162\x79", maybe_serialize(CountryList::$countries[$oM]));
        update_mo_option("\x62\154\157\x63\x6b\145\144\x5f\144\157\155\x61\151\x6e\163", MoUtility::sanitizeCheck("\x6d\157\137\x6f\x74\x70\x5f\142\x6c\157\x63\153\145\x64\137\x65\x6d\141\x69\x6c\x5f\x64\x6f\155\141\x69\x6e\163", $A2));
        update_mo_option("\142\x6c\157\x63\153\x65\x64\x5f\x70\150\x6f\x6e\x65\x5f\156\x75\155\142\145\162\x73", MoUtility::sanitizeCheck("\x6d\x6f\x5f\x6f\x74\160\x5f\x62\x6c\x6f\x63\x6b\x65\144\x5f\160\x68\157\156\145\137\x6e\x75\x6d\142\145\x72\x73", $A2));
        update_mo_option("\x73\x68\157\x77\137\x72\x65\155\x61\x69\156\151\x6e\x67\x5f\x74\x72\141\156\163", MoUtility::sanitizeCheck("\x6d\x6f\137\163\150\x6f\x77\x5f\x72\145\155\141\151\156\x69\x6e\147\x5f\164\x72\x61\x6e\163", $A2));
        update_mo_option("\x73\x68\x6f\167\137\x64\162\157\160\x64\157\x77\x6e\x5f\x6f\x6e\x5f\146\157\x72\155", MoUtility::sanitizeCheck("\163\150\157\167\137\144\162\157\160\x64\x6f\167\156\x5f\157\156\137\x66\x6f\162\x6d", $A2));
        update_mo_option("\157\164\x70\137\x6c\145\x6e\147\x74\150", MoUtility::sanitizeCheck("\x6d\157\x5f\x6f\x74\160\x5f\x6c\x65\156\147\x74\150", $A2));
        update_mo_option("\157\164\x70\x5f\166\x61\x6c\x69\x64\x69\164\171", MoUtility::sanitizeCheck("\155\x6f\137\x6f\164\160\x5f\x76\x61\154\151\144\151\x74\171", $A2));
        do_action("\x6d\x6f\137\162\x65\x67\x69\x73\164\162\141\x74\x69\157\x6e\137\x73\x68\x6f\167\x5f\x6d\145\x73\x73\141\x67\145", MoMessages::showMessage(MoMessages::EXTRA_SETTINGS_SAVED), "\123\125\103\103\105\123\123");
    }
    function _mo_validation_support_query($gt)
    {
        $xX = MoUtility::sanitizeCheck("\x71\x75\x65\162\x79\137\145\155\x61\x69\154", $gt);
        $qT = MoUtility::sanitizeCheck("\161\x75\x65\x72\171", $gt);
        $lr = MoUtility::sanitizeCheck("\161\x75\x65\162\171\x5f\160\x68\x6f\x6e\x65", $gt);
        if (!(!$xX || !$qT)) {
            goto zy;
        }
        do_action("\155\x6f\x5f\x72\145\x67\151\163\x74\x72\141\164\151\x6f\156\137\x73\x68\157\167\x5f\155\x65\163\x73\x61\x67\x65", MoMessages::showMessage(MoMessages::SUPPORT_FORM_VALUES), "\105\122\122\117\122");
        return;
        zy:
        $NZ = MocURLOTP::submit_contact_us($xX, $lr, $qT);
        if (!(json_last_error() == JSON_ERROR_NONE && $NZ)) {
            goto m8;
        }
        do_action("\x6d\x6f\x5f\x72\x65\147\x69\163\x74\x72\x61\x74\x69\x6f\x6e\x5f\163\x68\157\167\x5f\155\145\x73\163\141\x67\x65", MoMessages::showMessage(MoMessages::SUPPORT_FORM_SENT), "\123\x55\103\x43\105\x53\x53");
        return;
        m8:
        do_action("\x6d\x6f\x5f\x72\145\x67\x69\163\x74\162\x61\164\151\x6f\x6e\137\163\x68\x6f\x77\137\x6d\145\163\163\x61\147\x65", MoMessages::showMessage(MoMessages::SUPPORT_FORM_ERROR), "\105\122\122\x4f\122");
    }
    public function otp_transactions_glance_counter()
    {
        if (!(!MoUtility::micr() || !MoUtility::isMG())) {
            goto Np;
        }
        return;
        Np:
        $xX = get_mo_option("\x65\155\x61\x69\x6c\137\x74\x72\141\156\x73\x61\143\x74\151\157\x6e\x73\x5f\162\145\155\x61\x69\156\151\x6e\147");
        $lr = get_mo_option("\160\x68\157\156\145\137\x74\x72\141\156\x73\141\x63\x74\x69\157\x6e\x73\x5f\x72\145\155\141\151\156\151\x6e\x67");
        echo "\74\154\x69\40\x63\x6c\141\x73\x73\75\47\155\x6f\x2d\x74\162\x61\x6e\163\55\143\x6f\165\156\164\47\76\74\x61\x20\x68\162\145\146\x3d\x27" . admin_url() . "\x61\144\x6d\151\156\x2e\160\x68\160\77\x70\141\147\145\75\155\x6f\x73\145\x74\164\151\156\x67\x73\x27\76" . MoMessages::showMessage(MoMessages::TRANS_LEFT_MSG, array("\x65\x6d\141\x69\x6c" => $xX, "\x70\150\x6f\x6e\145" => $lr)) . "\x3c\57\x61\x3e\x3c\57\154\x69\x3e";
    }
    public function checkIfPopupTemplateAreSet()
    {
        $at = maybe_unserialize(get_mo_option("\143\165\163\164\x6f\155\137\160\157\160\165\x70\x73"));
        if (!empty($at)) {
            goto j0;
        }
        $fD = apply_filters("\155\157\137\164\x65\x6d\x70\x6c\141\164\145\x5f\144\145\146\x61\165\154\x74\x73", array());
        update_mo_option("\143\x75\163\x74\157\x6d\137\160\x6f\x70\165\160\163", maybe_serialize($fD));
        j0:
    }
    public function showFormHTMLData()
    {
        $this->isValidRequest();
        $bz = $_POST["\x66\157\162\155\137\x6e\141\155\145"];
        $qN = MOV_DIR . "\143\x6f\156\164\x72\157\154\x6c\145\x72\163\57";
        $ke = !MoUtility::micr() ? "\x64\x69\x73\x61\142\x6c\145\x64" : '';
        $Rv = admin_url() . "\145\x64\151\164\x2e\x70\x68\x70\x3f\160\x6f\163\164\x5f\164\171\x70\145\75\x70\141\x67\x65";
        ob_start();
        include $qN . "\146\x6f\162\x6d\x73\x2f" . $bz . "\56\x70\x68\x70";
        $WI = ob_get_clean();
        wp_send_json(MoUtility::createJson($WI, MoConstants::SUCCESS_JSON_TYPE));
    }
    function moScheduleTransactionSync()
    {
        if (!(!wp_next_scheduled("\x68\157\165\x72\154\x79\123\171\156\x63") && MoUtility::micr())) {
            goto vh;
        }
        wp_schedule_event(time(), "\144\141\x69\x6c\x79", "\150\157\165\162\x6c\171\123\171\156\x63");
        vh:
    }
    function _mo_validation_feedback_query()
    {
        $this->isValidRequest();
        $Y0 = $_POST["\x6d\x69\156\x69\157\x72\141\x6e\147\x65\x5f\146\x65\145\144\142\141\x63\x6b\x5f\x73\x75\142\155\x69\164"];
        if (!($Y0 === "\x53\x6b\x69\x70\40\46\40\x44\x65\141\x63\164\x69\x76\x61\x74\145")) {
            goto b2;
        }
        deactivate_plugins(array(MOV_PLUGIN_NAME));
        return;
        b2:
        $xJ = strcasecmp($_POST["\160\154\x75\147\151\156\x5f\x64\x65\141\x63\x74\x69\166\141\164\145\144"], "\164\x72\165\145") == 0;
        $WP = !$xJ ? mo_("\133\x20\120\154\x75\x67\151\156\40\x46\x65\145\x64\x62\x61\143\153\x20\x5d\40\x3a\40") : mo_("\133\x20\120\154\165\147\x69\156\40\x44\x65\141\x63\164\151\x76\x61\x74\145\x64\40\x5d");
        $tL = $_POST["\x66\145\x65\x64\142\x61\143\153\137\x72\145\141\163\x6f\x6e"];
        $H4 = sanitize_text_field($_POST["\161\165\145\x72\x79\x5f\146\145\x65\x64\142\x61\x63\x6b"]);
        $mv = file_get_contents(MOV_DIR . "\151\x6e\143\x6c\165\144\x65\x73\x2f\150\164\x6d\x6c\57\146\x65\x65\144\142\141\x63\x6b\56\155\x69\156\x2e\150\x74\x6d\x6c");
        $current_user = wp_get_current_user();
        $xX = get_mo_option("\x61\x64\155\151\x6e\x5f\x65\x6d\x61\151\x6c");
        $mv = str_replace("\173\x7b\x46\111\x52\123\124\137\x4e\x41\x4d\x45\175\x7d", $current_user->first_name, $mv);
        $mv = str_replace("\173\x7b\114\101\x53\x54\137\x4e\101\115\105\x7d\x7d", $current_user->last_name, $mv);
        $mv = str_replace("\173\173\123\x45\x52\x56\105\122\175\175", $_SERVER["\123\x45\x52\x56\x45\x52\137\x4e\x41\x4d\x45"], $mv);
        $mv = str_replace("\173\x7b\105\115\x41\111\114\x7d\x7d", $xX, $mv);
        $mv = str_replace("\x7b\x7b\x50\x4c\125\107\x49\x4e\x7d\175", MoConstants::AREA_OF_INTEREST, $mv);
        $mv = str_replace("\173\173\x56\x45\x52\x53\x49\x4f\x4e\x7d\x7d", MOV_VERSION, $mv);
        $mv = str_replace("\x7b\173\123\125\x4d\x4d\x41\122\x59\x7d\x7d", $tL, $mv);
        $mv = str_replace("\173\x7b\124\131\120\x45\x7d\175", $WP, $mv);
        $mv = str_replace("\173\173\x46\x45\x45\x44\102\x41\103\113\175\x7d", $H4, $mv);
        $yj = MoUtility::send_email_notif($xX, "\x58\x65\x63\x75\162\151\146\x79", MoConstants::FEEDBACK_EMAIL, "\x57\157\x72\144\x50\x72\145\x73\163\x20\117\x54\120\40\126\x65\162\151\146\151\143\x61\x74\x69\x6f\156\x20\x50\x6c\x75\147\x69\x6e\40\x46\x65\x65\x64\142\x61\143\153", $mv);
        if ($yj) {
            goto VT;
        }
        do_action("\x6d\x6f\x5f\x72\145\147\x69\163\x74\162\x61\164\x69\x6f\x6e\137\163\x68\x6f\167\137\155\x65\x73\x73\x61\147\x65", MoMessages::showMessage(MoMessages::FEEDBACK_ERROR), "\105\x52\x52\117\x52");
        goto pI;
        VT:
        do_action("\x6d\x6f\137\x72\145\147\x69\163\x74\162\x61\x74\x69\x6f\x6e\x5f\163\x68\x6f\167\137\x6d\x65\163\163\141\x67\145", MoMessages::showMessage(MoMessages::FEEDBACK_SENT), "\123\x55\x43\103\105\123\123");
        pI:
        if (!$xJ) {
            goto lw;
        }
        deactivate_plugins(array(MOV_PLUGIN_NAME));
        lw:
    }
    function _mo_check_l()
    {
        $this->isValidRequest();
        MoUtility::_handle_mo_check_ln(true, get_mo_option("\x61\x64\x6d\151\156\137\x63\x75\163\x74\x6f\155\x65\162\x5f\153\145\x79"), get_mo_option("\x61\x64\x6d\x69\x6e\137\x61\160\x69\137\x6b\x65\x79"));
    }
    function _mo_configure_sms_template($A2)
    {
        $Xk = GatewayFunctions::instance();
        $Xk->_mo_configure_sms_template($A2);
    }
    function _mo_configure_email_template($A2)
    {
        $Xk = GatewayFunctions::instance();
        $Xk->_mo_configure_email_template($A2);
    }
}
