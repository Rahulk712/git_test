<?php


namespace OTP\Handler;

if (defined("\101\102\123\120\x41\x54\110")) {
    goto gN;
}
die;
gN:
use OTP\Helper\GatewayFunctions;
use OTP\Helper\MoConstants;
use OTP\Helper\MocURLOTP;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;
use OTP\Objects\BaseActionHandler;
use OTP\Traits\Instance;
class MoRegistrationHandler extends BaseActionHandler
{
    use Instance;
    function __construct()
    {
        parent::__construct();
        $this->_nonce = "\x6d\x6f\137\x72\145\x67\137\141\x63\x74\x69\x6f\156\163";
        add_action("\141\144\155\151\x6e\x5f\x69\156\x69\164", array($this, "\x68\x61\x6e\x64\x6c\145\x5f\x63\x75\x73\x74\x6f\155\x65\162\137\162\x65\x67\151\x73\x74\x72\x61\164\x69\x6f\156"));
    }
    function handle_customer_registration()
    {
        if (current_user_can("\155\141\156\x61\147\145\137\157\x70\x74\x69\x6f\x6e\163")) {
            goto jn;
        }
        return;
        jn:
        if (isset($_POST["\x6f\160\x74\x69\x6f\156"])) {
            goto pE;
        }
        return;
        pE:
        $ey = trim($_POST["\157\160\164\x69\157\x6e"]);
        switch ($ey) {
            case "\155\157\x5f\162\145\x67\151\163\x74\x72\x61\164\151\157\x6e\x5f\162\x65\147\x69\163\x74\145\162\137\143\165\163\164\157\x6d\145\x72":
                $this->_register_customer($_POST);
                goto rW;
            case "\x6d\157\137\x72\x65\147\x69\x73\164\162\x61\164\151\x6f\x6e\x5f\143\x6f\156\156\x65\143\x74\x5f\x76\145\162\x69\x66\x79\137\143\x75\163\164\157\155\145\x72":
                $this->_verify_customer($_POST);
                goto rW;
            case "\x6d\157\x5f\x72\145\147\x69\163\164\162\x61\164\x69\157\x6e\137\166\x61\x6c\x69\144\x61\x74\145\137\x6f\x74\x70":
                $this->_validate_otp($_POST);
                goto rW;
            case "\x6d\x6f\x5f\162\145\x67\x69\163\164\162\x61\164\151\x6f\x6e\137\x72\145\x73\145\156\x64\x5f\157\164\x70":
                $this->_send_otp_token(get_mo_option("\x61\144\x6d\151\x6e\137\145\x6d\141\151\154"), '', "\x45\x4d\x41\x49\114");
                goto rW;
            case "\x6d\x6f\x5f\x72\x65\147\x69\x73\164\162\141\164\x69\x6f\156\x5f\x70\150\157\x6e\145\x5f\166\x65\162\151\146\x69\143\141\164\x69\157\x6e":
                $this->_send_phone_otp_token($_POST);
                goto rW;
            case "\x6d\x6f\137\162\x65\x67\151\163\x74\x72\141\164\x69\x6f\156\x5f\x67\x6f\137\142\x61\x63\x6b":
                $this->_revert_back_registration();
                goto rW;
            case "\155\x6f\137\x72\x65\147\x69\x73\x74\162\141\x74\151\x6f\156\x5f\x66\157\x72\x67\157\x74\137\160\x61\163\x73\x77\x6f\x72\144":
                $this->_reset_password();
                goto rW;
            case "\155\x6f\x5f\147\x6f\x5f\164\157\x5f\154\x6f\x67\x69\156\x5f\160\141\x67\x65":
            case "\x72\145\x6d\157\166\145\137\141\x63\143\157\x75\x6e\164":
                $this->removeAccount();
                goto rW;
            case "\155\x6f\137\x72\x65\x67\x69\163\164\162\x61\x74\151\x6f\x6e\137\166\x65\162\151\146\x79\137\x6c\x69\143\145\x6e\163\145":
                $this->_vlk($_POST);
                goto rW;
        }
        hz:
        rW:
    }
    function _register_customer($post)
    {
        $this->isValidRequest();
        $xX = sanitize_email($_POST["\x65\155\141\151\x6c"]);
        $uj = sanitize_text_field($_POST["\x63\157\155\x70\x61\156\171"]);
        $Iz = sanitize_text_field($_POST["\x66\156\x61\155\x65"]);
        $oG = sanitize_text_field($_POST["\154\156\141\155\x65"]);
        $wh = sanitize_text_field($_POST["\160\141\x73\163\x77\157\162\x64"]);
        $ZZ = sanitize_text_field($_POST["\143\157\156\x66\x69\x72\x6d\x50\141\x73\163\x77\x6f\x72\144"]);
        if (!(strlen($wh) < 6 || strlen($ZZ) < 6)) {
            goto t1;
        }
        do_action("\x6d\157\137\x72\145\147\151\x73\164\x72\141\164\x69\157\156\137\x73\x68\157\x77\137\x6d\x65\163\163\141\147\x65", MoMessages::showMessage(MoMessages::PASS_LENGTH), "\x45\122\x52\117\122");
        return;
        t1:
        if (!($wh != $ZZ)) {
            goto NW;
        }
        delete_mo_option("\x76\x65\x72\x69\x66\x79\137\x63\165\163\x74\157\155\145\162");
        do_action("\155\157\137\162\x65\147\151\x73\164\x72\x61\164\151\x6f\x6e\x5f\x73\x68\157\x77\x5f\155\145\x73\x73\x61\x67\x65", MoMessages::showMessage(MoMessages::PASS_MISMATCH), "\105\122\x52\117\122");
        return;
        NW:
        if (!(MoUtility::isBlank($xX) || MoUtility::isBlank($wh) || MoUtility::isBlank($ZZ))) {
            goto jX;
        }
        do_action("\x6d\157\x5f\162\x65\x67\x69\163\164\162\x61\164\151\x6f\x6e\137\x73\150\157\167\x5f\155\x65\163\x73\x61\x67\145", MoMessages::showMessage(MoMessages::REQUIRED_FIELDS), "\x45\122\122\x4f\122");
        return;
        jX:
        update_mo_option("\x63\x6f\x6d\160\141\x6e\171\x5f\156\x61\x6d\145", $uj);
        update_mo_option("\x66\151\162\163\164\137\156\x61\x6d\145", $Iz);
        update_mo_option("\x6c\141\163\x74\137\156\141\x6d\145", $oG);
        update_mo_option("\141\x64\155\x69\x6e\x5f\145\155\x61\x69\x6c", $xX);
        update_mo_option("\141\x64\x6d\x69\156\x5f\160\x61\x73\x73\x77\157\162\x64", $wh);
        $zv = json_decode(MocURLOTP::check_customer($xX), true);
        switch ($zv["\x73\164\141\164\x75\163"]) {
            case "\x43\x55\123\x54\x4f\115\x45\x52\x5f\116\117\x54\x5f\x46\x4f\x55\x4e\104":
                $this->_send_otp_token($xX, '', "\105\x4d\101\111\114");
                goto FY;
            default:
                $this->_get_current_customer($xX, $wh);
                goto FY;
        }
        s7:
        FY:
    }
    function _send_otp_token($xX, $lr, $JE)
    {
        $this->isValidRequest();
        $zv = json_decode(MocURLOTP::mo_send_otp_token($JE, $xX, $lr), true);
        if (strcasecmp($zv["\x73\x74\141\x74\x75\163"], "\x53\x55\103\103\105\123\x53") == 0) {
            goto WI;
        }
        update_mo_option("\162\145\x67\x69\163\164\162\141\x74\151\x6f\x6e\x5f\x73\164\x61\x74\x75\163", "\115\x4f\137\117\124\120\137\x44\105\x4c\x49\x56\x45\122\x45\x44\137\x46\x41\111\x4c\125\122\105");
        do_action("\155\157\x5f\x72\145\147\x69\163\x74\x72\141\164\x69\157\x6e\137\163\x68\157\167\x5f\155\x65\x73\x73\x61\x67\145", MoMessages::showMessage(MoMessages::ERR_OTP), "\x45\x52\122\x4f\x52");
        goto a6;
        WI:
        update_mo_option("\x74\162\x61\156\x73\x61\143\164\151\x6f\156\111\x64", $zv["\164\x78\111\x64"]);
        update_mo_option("\x72\145\147\151\163\x74\162\x61\x74\151\157\x6e\137\x73\164\x61\x74\x75\x73", "\115\x4f\x5f\117\x54\120\137\104\105\114\111\126\x45\122\105\x44\137\123\x55\x43\x43\105\x53\123");
        if ($JE == "\x45\115\101\111\x4c") {
            goto RF;
        }
        do_action("\155\x6f\x5f\162\x65\147\x69\x73\164\x72\x61\x74\x69\157\156\x5f\x73\x68\157\167\x5f\155\145\x73\163\141\147\145", MoMessages::showMessage(MoMessages::OTP_SENT, array("\x6d\145\164\150\x6f\x64" => $lr)), "\x53\x55\103\x43\x45\123\x53");
        goto IU;
        RF:
        do_action("\155\x6f\137\162\x65\147\x69\x73\x74\162\141\164\x69\x6f\156\x5f\163\x68\x6f\167\x5f\x6d\145\163\x73\x61\x67\145", MoMessages::showMessage(MoMessages::OTP_SENT, array("\155\145\164\150\x6f\x64" => $xX)), "\123\x55\x43\103\105\123\x53");
        IU:
        a6:
    }
    private function _get_current_customer($xX, $wh)
    {
        $zv = MocURLOTP::get_customer_key($xX, $wh);
        $WF = json_decode($zv, true);
        if (json_last_error() == JSON_ERROR_NONE) {
            goto ch;
        }
        update_mo_option("\141\144\x6d\151\x6e\137\145\155\x61\x69\154", $xX);
        update_mo_option("\166\x65\162\x69\x66\171\x5f\143\x75\x73\164\x6f\x6d\x65\x72", "\x74\x72\x75\145");
        delete_mo_option("\x6e\x65\x77\137\162\x65\x67\x69\163\x74\162\141\164\151\157\156");
        do_action("\155\157\x5f\x72\x65\x67\x69\163\164\x72\x61\x74\x69\x6f\156\x5f\x73\150\157\167\x5f\155\x65\163\163\x61\x67\145", MoMessages::showMessage(MoMessages::ACCOUNT_EXISTS), "\x45\122\122\117\x52");
        goto L1;
        ch:
        update_mo_option("\141\144\155\x69\156\x5f\x65\155\x61\151\154", $xX);
        update_mo_option("\141\144\x6d\151\156\x5f\x70\x68\157\156\145", $WF["\160\x68\157\156\145"]);
        $this->save_success_customer_config($WF["\x69\x64"], $WF["\x61\160\x69\113\145\171"], $WF["\x74\x6f\x6b\145\x6e"], $WF["\x61\x70\x70\x53\145\x63\162\145\x74"]);
        MoUtility::_handle_mo_check_ln(false, $WF["\x69\x64"], $WF["\x61\x70\x69\x4b\145\x79"]);
        do_action("\155\157\137\x72\145\x67\151\x73\x74\x72\141\164\151\157\156\x5f\x73\150\157\x77\x5f\155\145\163\x73\141\x67\x65", MoMessages::showMessage(MoMessages::REG_SUCCESS), "\x53\x55\103\x43\105\x53\123");
        L1:
    }
    function save_success_customer_config($so, $MX, $rG, $rt)
    {
        update_mo_option("\141\x64\155\151\x6e\137\x63\165\163\164\x6f\x6d\145\162\x5f\153\145\171", $so);
        update_mo_option("\x61\x64\x6d\x69\156\x5f\141\160\151\x5f\x6b\x65\x79", $MX);
        update_mo_option("\x63\x75\x73\164\x6f\155\x65\162\137\164\157\153\x65\156", $rG);
        delete_mo_option("\x76\145\x72\x69\x66\x79\137\143\165\x73\164\157\x6d\145\x72");
        delete_mo_option("\x6e\x65\167\x5f\x72\145\147\151\x73\x74\162\x61\164\151\x6f\156");
        delete_mo_option("\x61\144\155\x69\156\x5f\x70\141\x73\163\167\x6f\x72\144");
    }
    function _validate_otp($post)
    {
        $this->isValidRequest();
        $Le = sanitize_text_field($post["\x6f\164\160\137\x74\x6f\x6b\x65\x6e"]);
        $xX = get_mo_option("\141\x64\x6d\151\x6e\137\x65\155\141\x69\154");
        $uj = get_mo_option("\x63\x6f\x6d\x70\141\x6e\171\x5f\x6e\x61\155\x65");
        $wh = get_mo_option("\141\144\x6d\x69\x6e\137\x70\x61\163\163\167\x6f\162\144");
        if (!MoUtility::isBlank($Le)) {
            goto Uk;
        }
        update_mo_option("\x72\x65\x67\151\163\x74\x72\x61\164\151\157\156\137\x73\x74\141\x74\x75\x73", "\x4d\x4f\x5f\117\124\120\137\126\101\114\x49\104\101\x54\111\x4f\x4e\x5f\106\101\111\x4c\125\x52\105");
        do_action("\155\157\137\x72\x65\x67\x69\x73\164\x72\x61\164\x69\157\156\x5f\x73\150\157\x77\137\155\145\x73\163\141\147\145", MoMessages::showMessage(MoMessages::REQUIRED_OTP), "\x45\122\x52\117\122");
        return;
        Uk:
        $zv = json_decode(MocURLOTP::validate_otp_token(get_mo_option("\164\162\141\156\x73\x61\143\x74\151\157\x6e\111\144"), $Le), true);
        if (strcasecmp($zv["\163\164\141\164\165\163"], "\123\125\x43\x43\x45\123\123") == 0) {
            goto aj;
        }
        update_mo_option("\x72\145\147\151\x73\x74\162\141\x74\x69\x6f\156\x5f\163\164\x61\164\x75\x73", "\115\x4f\x5f\x4f\124\120\x5f\126\101\114\111\104\101\124\x49\117\116\x5f\x46\x41\x49\x4c\x55\122\105");
        do_action("\155\157\137\x72\x65\x67\151\163\164\162\x61\164\151\157\156\x5f\163\150\x6f\167\137\155\x65\163\163\x61\x67\145", MoUtility::_get_invalid_otp_method(), "\105\x52\122\x4f\122");
        goto Zi;
        aj:
        $WF = json_decode(MocURLOTP::create_customer($xX, $uj, $wh, $lr = '', $Iz = '', $oG = ''), true);
        if (strcasecmp($WF["\x73\x74\141\x74\x75\163"], "\103\x55\x53\x54\117\x4d\105\122\x5f\x55\123\x45\x52\x4e\101\115\x45\x5f\101\114\122\105\x41\104\131\x5f\x45\130\111\123\124\x53") == 0) {
            goto Mi;
        }
        if (strcasecmp($WF["\x73\x74\x61\x74\165\163"], "\x46\101\x49\x4c\x45\x44") == 0 && $WF["\155\145\x73\163\x61\147\x65"] == "\105\155\x61\151\x6c\x20\x69\163\40\x6e\x6f\x74\x20\x65\156\164\145\162\x70\x72\151\x73\145\40\x65\x6d\x61\x69\x6c\x2e") {
            goto b0;
        }
        if (!(strcasecmp($WF["\x73\x74\x61\x74\165\x73"], "\123\x55\103\x43\105\x53\123") == 0)) {
            goto Ge;
        }
        $this->save_success_customer_config($WF["\151\x64"], $WF["\141\x70\151\x4b\145\x79"], $WF["\164\x6f\x6b\x65\x6e"], $WF["\x61\x70\x70\123\145\x63\x72\145\x74"]);
        update_mo_option("\x72\145\x67\x69\x73\x74\x72\141\164\x69\157\156\137\163\164\x61\x74\165\x73", "\115\x4f\x5f\x43\125\123\x54\x4f\115\105\x52\137\126\101\x4c\111\x44\x41\x54\x49\x4f\116\x5f\x52\x45\x47\111\123\x54\x52\x41\124\x49\117\x4e\137\103\117\115\x50\x4c\x45\x54\105");
        update_mo_option("\x65\x6d\x61\151\154\137\x74\162\141\x6e\x73\x61\143\164\151\x6f\156\163\x5f\162\x65\155\x61\151\x6e\x69\156\x67", MoConstants::EMAIL_TRANS_REMAINING);
        update_mo_option("\160\x68\157\x6e\145\137\164\x72\141\156\163\141\143\164\x69\157\x6e\x73\137\162\x65\155\141\151\156\x69\156\x67", MoConstants::PHONE_TRANS_REMAINING);
        do_action("\155\x6f\137\162\x65\x67\151\x73\164\162\141\x74\151\157\x6e\137\163\150\x6f\167\137\155\145\163\163\141\147\145", MoMessages::showMessage(MoMessages::REG_COMPLETE), "\123\x55\103\103\x45\123\123");
        header("\114\x6f\143\x61\x74\151\157\156\72\40\141\x64\x6d\x69\x6e\x2e\x70\x68\x70\x3f\x70\141\147\x65\75\x70\162\x69\143\x69\x6e\x67");
        Ge:
        goto lq;
        b0:
        do_action("\x6d\x6f\x5f\x72\x65\147\151\163\164\x72\x61\x74\x69\x6f\156\137\163\x68\157\167\137\155\145\x73\x73\x61\147\145", MoMessages::showMessage(MoMessages::ENTERPRIZE_EMAIL), "\105\x52\x52\117\122");
        lq:
        goto Ne;
        Mi:
        $this->_get_current_customer($xX, $wh);
        Ne:
        Zi:
    }
    function _send_phone_otp_token($post)
    {
        $this->isValidRequest();
        $lr = sanitize_text_field($_POST["\160\x68\x6f\156\145\137\x6e\x75\155\142\x65\x72"]);
        $lr = str_replace("\40", '', $lr);
        $bF = "\57\133\x5c\53\x5d\133\x30\x2d\71\x5d\x7b\x31\x2c\63\175\133\x30\55\71\135\x7b\61\x30\x7d\57";
        if (preg_match($bF, $lr, $U8, PREG_OFFSET_CAPTURE)) {
            goto ru;
        }
        update_mo_option("\x72\145\x67\151\x73\164\162\141\164\x69\157\156\x5f\x73\164\x61\x74\x75\163", "\x4d\117\137\x4f\x54\x50\x5f\x44\105\x4c\x49\x56\105\x52\105\x44\137\x46\101\x49\x4c\125\x52\x45");
        do_action("\x6d\157\137\162\145\147\151\163\164\x72\141\164\151\x6f\156\137\x73\150\x6f\167\x5f\x6d\145\163\x73\x61\147\145", MoMessages::showMessage(MoMessages::INVALID_SMS_OTP), "\x45\x52\122\x4f\x52");
        goto OS;
        ru:
        update_mo_option("\141\x64\x6d\151\x6e\137\x70\150\x6f\156\x65", $lr);
        $this->_send_otp_token('', $lr, "\123\115\x53");
        OS:
    }
    function _verify_customer($post)
    {
        $this->isValidRequest();
        $xX = sanitize_email($post["\x65\x6d\141\151\x6c"]);
        $wh = stripslashes($post["\x70\141\x73\163\167\157\162\x64"]);
        if (!(MoUtility::isBlank($xX) || MoUtility::isBlank($wh))) {
            goto oz;
        }
        do_action("\x6d\x6f\x5f\x72\145\x67\151\x73\164\162\x61\x74\151\157\x6e\x5f\x73\x68\157\x77\137\x6d\145\163\163\141\147\x65", MoMessages::showMessage(MoMessages::REQUIRED_FIELDS), "\105\122\x52\x4f\122");
        return;
        oz:
        $this->_get_current_customer($xX, $wh);
    }
    function _reset_password()
    {
        $this->isValidRequest();
        $xX = get_mo_option("\x61\144\155\151\156\137\145\x6d\141\151\x6c");
        if (!$xX) {
            goto Hw;
        }
        $Gc = json_decode(MocURLOTP::forgot_password($xX));
        if ($Gc->status == "\123\125\x43\x43\105\123\123") {
            goto Rj;
        }
        do_action("\x6d\157\x5f\x72\x65\147\151\x73\x74\x72\x61\164\x69\157\156\x5f\x73\x68\x6f\x77\137\155\145\x73\163\141\x67\x65", MoMessages::showMessage(MoMessages::UNKNOWN_ERROR), "\x45\x52\x52\117\x52");
        goto tR;
        Rj:
        do_action("\x6d\x6f\137\162\x65\x67\x69\163\164\x72\141\164\x69\157\156\x5f\163\x68\x6f\167\x5f\155\x65\163\x73\141\x67\x65", MoMessages::showMessage(MoMessages::RESET_PASS), "\x53\125\x43\103\105\123\123");
        tR:
        goto XQ;
        Hw:
        do_action("\155\x6f\137\162\145\x67\151\x73\164\162\141\164\x69\x6f\x6e\x5f\163\x68\x6f\167\x5f\155\x65\163\x73\x61\x67\x65", MoMessages::showMessage(MoMessages::FORGOT_PASSWORD_MESSAGE), "\x53\x55\103\x43\105\123\x53");
        XQ:
    }
    function _revert_back_registration()
    {
        $this->isValidRequest();
        update_mo_option("\162\x65\147\x69\x73\164\x72\141\164\x69\157\x6e\x5f\163\x74\x61\164\165\x73", '');
        delete_mo_option("\156\145\x77\x5f\162\145\147\x69\163\x74\x72\x61\164\151\x6f\x6e");
        delete_mo_option("\166\x65\162\x69\x66\x79\x5f\143\x75\x73\164\x6f\x6d\145\162");
        delete_mo_option("\141\144\x6d\x69\156\x5f\x65\155\141\x69\x6c");
        delete_mo_option("\163\x6d\x73\137\157\164\160\137\143\x6f\x75\x6e\164");
        delete_mo_option("\145\155\x61\x69\x6c\137\x6f\164\x70\137\143\157\x75\156\x74");
    }
    function removeAccount()
    {
        $this->isValidRequest();
        $this->flush_cache();
        wp_clear_scheduled_hook("\x68\157\x75\x72\154\x79\x53\171\x6e\143");
        delete_mo_option("\x74\x72\141\156\x73\x61\x63\164\x69\157\156\111\144");
        delete_mo_option("\x61\x64\155\151\156\x5f\160\141\163\163\x77\x6f\x72\x64");
        delete_mo_option("\162\145\147\x69\x73\164\x72\x61\x74\151\157\156\x5f\x73\164\x61\164\x75\163");
        delete_mo_option("\141\x64\x6d\151\156\x5f\x70\x68\157\x6e\145");
        delete_mo_option("\x6e\x65\167\x5f\162\x65\x67\x69\x73\x74\x72\x61\x74\151\x6f\156");
        delete_mo_option("\x61\144\155\151\156\137\x63\x75\163\164\157\x6d\145\x72\x5f\x6b\145\x79");
        delete_mo_option("\x61\x64\x6d\151\x6e\137\x61\160\x69\137\153\145\171");
        delete_mo_option("\x63\165\163\x74\157\x6d\145\x72\137\x74\157\x6b\145\x6e");
        delete_mo_option("\x76\145\x72\151\x66\x79\137\x63\x75\163\x74\x6f\x6d\x65\x72");
        delete_mo_option("\155\x65\163\x73\141\147\x65");
        delete_mo_option("\143\x68\x65\x63\x6b\137\154\x6e");
        update_mo_option("\166\x65\162\151\x66\x79\x5f\143\165\x73\164\x6f\x6d\x65\x72", true);
    }
    function flush_cache()
    {
        $Xk = GatewayFunctions::instance();
        $Xk->flush_cache();
    }
    function _vlk($post)
    {
        $Xk = GatewayFunctions::instance();
        $Xk->_vlk($post);
    }
}
