<?php


namespace OTP\Helper;

if (defined("\x41\102\123\120\x41\x54\x48")) {
    goto Is;
}
die;
Is:
use OTP\Handler\MoOTPActionHandlerHandler;
use OTP\Objects\NotificationSettings;
class CustomGateway
{
    protected $applicationName;
    public function hourlySync()
    {
        if ($this->ch_xdigit()) {
            goto zr;
        }
        $this->daoptions();
        zr:
    }
    public function flush_cache()
    {
        if (MO_TEST_MODE) {
            goto l_;
        }
        if (!$this->mclv()) {
            goto bj;
        }
        $this->mius();
        bj:
        goto J7;
        l_:
        delete_mo_option("\163\x69\x74\x65\137\x65\155\141\151\x6c\x5f\x63\x6b\x6c");
        delete_mo_option("\x65\155\141\x69\154\x5f\x76\145\162\151\x66\151\143\141\164\151\157\x6e\x5f\154\153");
        J7:
    }
    public function _vlk($post)
    {
        if (!MoUtility::isBlank($post["\145\x6d\x61\x69\154\x5f\154\x6b"])) {
            goto jG;
        }
        do_action("\x6d\x6f\137\x72\145\x67\x69\x73\x74\162\141\164\151\x6f\x6e\x5f\163\x68\157\x77\x5f\155\x65\x73\x73\x61\147\145", MoMessages::showMessage(MoMessages::REQUIRED_FIELDS), MoConstants::ERROR);
        return;
        jG:
        $hq = trim($_POST["\145\x6d\141\x69\x6c\x5f\154\153"]);
        $ll = json_decode($this->ccl(), true);
        switch ($ll["\x73\164\x61\x74\165\163"]) {
            case "\123\x55\103\103\x45\x53\x53":
                $this->_vlk_success($hq);
                goto hK;
            default:
                $this->_vlk_fail();
                goto hK;
        }
        iO:
        hK:
    }
    public function mclv()
    {
        $xl = get_mo_option("\x63\165\163\164\157\155\x65\162\x5f\164\x6f\153\x65\x6e");
        $UW = isset($xl) && !empty($xl) ? AEncryption::decrypt_data(get_mo_option("\163\151\164\x65\137\145\155\141\x69\154\x5f\143\153\x6c"), $xl) : "\146\141\x6c\163\145";
        $KT = get_mo_option("\145\x6d\x61\151\154\x5f\166\145\x72\151\146\x69\x63\x61\x74\151\x6f\156\x5f\x6c\153");
        $xX = get_mo_option("\141\144\155\x69\x6e\137\x65\155\x61\x69\x6c");
        $WF = get_mo_option("\141\144\155\x69\156\137\143\165\x73\x74\x6f\155\145\162\x5f\153\x65\x79");
        return $UW == "\x74\162\x75\x65" && $KT && $xX && $WF && is_numeric(trim($WF));
    }
    public function isMG()
    {
        return FALSE;
    }
    public function getApplicationName()
    {
        return $this->applicationName;
    }
    private function ch_xdigit()
    {
        if (get_mo_option("\x73\x69\164\x65\x5f\x65\155\x61\151\x6c\137\143\x6b\154")) {
            goto q3;
        }
        return FALSE;
        q3:
        $xl = get_mo_option("\x63\x75\163\x74\x6f\155\x65\162\x5f\164\x6f\153\x65\x6e");
        return AEncryption::decrypt_data(get_mo_option("\163\x69\164\145\137\x65\155\141\151\154\x5f\x63\153\154"), $xl) == "\x74\162\165\145";
    }
    private function daoptions()
    {
        delete_mo_option("\167\160\x5f\x64\x65\146\141\165\154\164\x5f\x65\x6e\x61\x62\x6c\x65");
        delete_mo_option("\167\x63\x5f\144\145\146\x61\x75\x6c\164\137\145\x6e\x61\x62\154\145");
        delete_mo_option("\x70\142\x5f\x64\x65\146\141\165\x6c\164\x5f\145\156\141\142\x6c\x65");
        delete_mo_option("\165\155\x5f\x64\x65\x66\141\x75\154\x74\x5f\x65\x6e\141\142\154\145");
        delete_mo_option("\x73\151\x6d\160\x6c\x72\137\144\x65\146\x61\x75\x6c\164\137\x65\x6e\141\142\154\145");
        delete_mo_option("\145\x76\145\156\164\137\144\x65\x66\141\x75\154\x74\x5f\x65\x6e\141\x62\154\x65");
        delete_mo_option("\142\142\x70\x5f\x64\145\146\141\165\x6c\x74\137\145\156\141\x62\x6c\x65");
        delete_mo_option("\x63\162\x66\137\x64\x65\x66\141\x75\x6c\x74\137\145\x6e\141\142\154\x65");
        delete_mo_option("\165\x75\x6c\164\162\141\x5f\144\145\x66\141\x75\154\164\137\x65\156\141\142\x6c\145");
        delete_mo_option("\167\143\x5f\x63\x68\x65\143\x6b\157\x75\x74\137\x65\x6e\x61\x62\x6c\145");
        delete_mo_option("\x75\x70\155\145\137\144\x65\x66\x61\165\154\x74\137\x65\156\141\x62\154\x65");
        delete_mo_option("\160\151\x65\x5f\144\145\146\141\x75\154\164\137\x65\156\141\142\x6c\145");
        delete_mo_option("\143\x66\67\137\x63\157\156\x74\x61\x63\164\x5f\x65\156\x61\x62\154\145");
        delete_mo_option("\143\154\x61\163\x73\151\146\x79\137\145\156\141\x62\154\x65");
        delete_mo_option("\147\x66\x5f\143\x6f\x6e\164\141\143\164\x5f\145\x6e\x61\x62\x6c\x65");
        delete_mo_option("\x6e\152\x61\137\x65\x6e\141\x62\154\x65");
        delete_mo_option("\156\x69\x6e\152\141\137\146\x6f\x72\x6d\137\145\156\141\142\154\x65");
        delete_mo_option("\164\155\x6c\137\x65\156\141\142\154\x65");
        delete_mo_option("\x75\154\x74\151\x70\x72\157\x5f\145\x6e\x61\142\154\145");
        delete_mo_option("\x75\163\145\162\x70\x72\157\x5f\144\x65\x66\141\x75\x6c\164\137\x65\156\141\142\154\145");
        delete_mo_option("\167\160\137\154\x6f\x67\x69\x6e\137\145\156\x61\x62\x6c\x65");
        delete_mo_option("\146\157\162\155\143\x72\141\x66\x74\137\x70\x72\145\155\x69\165\155\x5f\x65\x6e\x61\142\x6c\145");
        delete_mo_option("\167\160\x5f\155\145\x6d\142\145\162\137\x72\x65\x67\x5f\145\156\141\142\x6c\x65");
        delete_mo_option("\147\x66\x5f\157\164\160\137\145\156\141\142\x6c\145\144");
        delete_mo_option("\167\x63\137\x73\x6f\143\x69\x61\x6c\137\154\157\147\151\156\x5f\145\x6e\x61\142\x6c\x65");
        delete_mo_option("\x66\157\x72\155\x63\162\141\146\164\x5f\x65\x6e\141\142\154\x65");
        delete_mo_option("\x6d\x6f\x5f\x63\x75\163\x74\157\x6d\x65\x72\137\166\141\154\x69\144\x61\x74\151\157\156\137\141\144\x6d\x69\x6e\x5f\x65\x6d\x61\151\x6c");
        delete_mo_option("\x77\x70\x63\x6f\x6d\x6d\x65\x6e\164\137\145\156\141\142\x6c\145");
        delete_mo_option("\x64\157\143\x64\151\x72\x65\x63\x74\x5f\x65\156\x61\142\x6c\145");
        delete_mo_option("\167\160\x66\x6f\x72\x6d\137\145\156\141\142\154\145");
        delete_mo_option("\143\x72\146\x5f\157\x74\x70\x5f\x65\156\x61\142\154\x65\x64");
        delete_mo_option("\143\x61\154\x64\x65\x72\x61\x5f\x65\x6e\141\x62\x6c\145");
        delete_mo_option("\146\157\x72\155\x6d\141\x6b\145\162\x5f\x65\x6e\x61\x62\x6c\145");
        delete_mo_option("\x75\155\x5f\x70\x72\x6f\x66\151\x6c\x65\137\x65\x6e\x61\142\x6c\145");
        delete_mo_option("\166\x69\163\x75\x61\x6c\x5f\x66\157\162\155\137\145\x6e\x61\142\154\145");
        delete_mo_option("\146\x72\155\x5f\x66\x6f\162\x6d\137\145\156\141\142\154\x65");
        delete_mo_option("\x77\143\x5f\x62\151\x6c\x6c\151\156\x67\x5f\145\156\x61\x62\154\x65");
    }
    private function _vlk_success($hq)
    {
        $zv = json_decode($this->vml($hq), true);
        if (strcasecmp($zv["\x73\164\x61\x74\165\x73"], "\x53\x55\103\103\105\x53\123") == 0) {
            goto S9;
        }
        if (strcasecmp($zv["\x73\x74\x61\x74\165\x73"], "\106\x41\111\114\x45\104") == 0) {
            goto Jh;
        }
        do_action("\155\157\137\x72\x65\x67\151\x73\x74\x72\141\164\151\157\x6e\x5f\x73\150\x6f\x77\137\x6d\x65\x73\163\x61\147\x65", MoMessages::showMessage(MoMessages::UNKNOWN_ERROR), "\x45\122\x52\x4f\x52");
        goto aa;
        Jh:
        if (strcasecmp($zv["\155\145\163\x73\x61\147\x65"], "\x43\157\x64\145\x20\x68\141\x73\x20\105\x78\x70\x69\x72\145\144") == 0) {
            goto Gh;
        }
        do_action("\x6d\x6f\x5f\x72\x65\x67\151\163\164\x72\x61\164\151\x6f\x6e\137\163\150\157\x77\137\x6d\x65\163\163\x61\147\145", MoMessages::showMessage(MoMessages::INVALID_LK), "\x45\122\122\x4f\x52");
        goto kE;
        Gh:
        do_action("\155\157\137\x72\x65\147\151\163\164\162\141\164\x69\157\x6e\x5f\x73\150\157\167\x5f\x6d\x65\x73\163\141\x67\145", MoMessages::showMessage(MoMessages::LK_IN_USE), "\x45\122\122\x4f\x52");
        kE:
        aa:
        goto tN;
        S9:
        $xl = get_mo_option("\143\165\x73\x74\x6f\155\x65\x72\137\x74\157\x6b\x65\x6e");
        update_mo_option("\x65\155\141\x69\x6c\137\166\x65\x72\151\x66\x69\x63\x61\164\151\157\x6e\x5f\x6c\153", AEncryption::encrypt_data($hq, $xl));
        update_mo_option("\x73\151\x74\x65\137\145\155\141\x69\154\x5f\143\153\154", AEncryption::encrypt_data("\164\x72\x75\145", $xl));
        do_action("\155\157\137\x72\x65\x67\151\163\x74\x72\x61\164\x69\157\156\137\x73\x68\x6f\x77\137\155\x65\163\x73\141\x67\145", MoMessages::showMessage(MoMessages::VERIFIED_LK), "\123\125\x43\x43\105\123\x53");
        tN:
    }
    private function _vlk_fail()
    {
        $xl = get_mo_option("\143\165\163\x74\x6f\155\145\x72\137\x74\157\153\145\x6e");
        update_mo_option("\163\x69\x74\x65\x5f\145\x6d\141\151\x6c\x5f\x63\x6b\154", AEncryption::encrypt_data("\x66\x61\154\163\x65", $xl));
        do_action("\x6d\x6f\137\162\x65\x67\x69\163\164\x72\141\x74\151\x6f\x6e\137\163\150\157\167\137\x6d\145\163\163\x61\x67\x65", MoMessages::showMessage(MoMessages::NEED_UPGRADE_MSG), "\x45\x52\122\117\x52");
    }
    private function vml($hq)
    {
        $px = MoConstants::HOSTNAME . "\57\x6d\157\x61\x73\57\141\x70\151\x2f\x62\141\x63\x6b\x75\160\143\x6f\144\145\57\166\x65\162\151\x66\171";
        $WF = get_mo_option("\x61\x64\x6d\151\156\137\x63\x75\163\x74\x6f\155\x65\x72\x5f\x6b\x65\x79");
        $MX = get_mo_option("\x61\144\x6d\151\156\x5f\x61\x70\151\137\153\x65\x79");
        $TH = array("\143\157\x64\145" => $hq, "\x63\x75\163\164\x6f\x6d\x65\x72\x4b\x65\x79" => $WF, "\141\x64\x64\151\164\151\x6f\x6e\141\154\106\x69\x65\154\144\163" => array("\146\151\145\x6c\x64\61" => site_url()));
        $uL = json_encode($TH);
        $CC = MocURLOTP::createAuthHeader($WF, $MX);
        $hy = MocURLOTP::callAPI($px, $uL, $CC);
        return $hy;
    }
    private function ccl()
    {
        $px = MoConstants::HOSTNAME . "\57\155\157\141\x73\x2f\162\145\163\x74\57\x63\165\x73\164\x6f\155\x65\x72\x2f\x6c\151\143\x65\x6e\163\145";
        $WF = get_mo_option("\x61\144\x6d\x69\156\x5f\x63\x75\163\164\157\x6d\145\162\137\153\x65\171");
        $MX = get_mo_option("\141\144\x6d\151\x6e\137\141\160\151\x5f\153\145\x79");
        $TH = array("\143\x75\163\164\157\155\145\162\x49\144" => $WF, "\x61\160\x70\154\151\143\141\x74\x69\x6f\x6e\x4e\x61\155\x65" => $this->applicationName);
        $uL = json_encode($TH);
        $CC = MocURLOTP::createAuthHeader($WF, $MX);
        $hy = MocURLOTP::callAPI($px, $uL, $CC);
        return $hy;
    }
    private function mius()
    {
        $px = MoConstants::HOSTNAME . "\57\x6d\x6f\x61\x73\57\141\160\x69\x2f\x62\x61\x63\x6b\x75\160\143\157\144\145\57\165\x70\144\141\x74\145\163\x74\141\164\x75\163";
        $WF = get_mo_option("\141\x64\x6d\x69\x6e\137\143\x75\x73\x74\157\155\145\162\137\153\145\x79");
        $MX = get_mo_option("\141\x64\x6d\x69\x6e\x5f\141\x70\151\x5f\153\145\x79");
        $xl = get_mo_option("\143\x75\x73\164\157\x6d\145\162\137\x74\157\153\x65\156");
        $hq = AEncryption::decrypt_data(get_mo_option("\x65\x6d\x61\x69\154\137\166\145\162\x69\146\x69\143\141\164\x69\x6f\156\137\154\153"), $xl);
        $TH = array("\143\x6f\144\x65" => $hq, "\143\165\x73\x74\157\155\x65\x72\x4b\145\171" => $WF);
        $uL = json_encode($TH);
        $CC = MocURLOTP::createAuthHeader($WF, $MX);
        $hy = MocURLOTP::callAPI($px, $uL, $CC);
        return $hy;
    }
    public function custom_wp_mail_from_name($ni)
    {
        return get_mo_option("\143\165\163\164\157\x6d\137\x65\155\141\x69\x6c\x5f\146\162\157\155\x5f\156\x61\x6d\145") ? get_mo_option("\143\165\163\164\157\155\137\x65\x6d\141\151\x6c\x5f\x66\x72\157\155\x5f\x6e\x61\x6d\145") : $ni;
    }
    function _mo_configure_sms_template($A2)
    {
        $ml = trim($A2["\x6d\x6f\x5f\x63\x75\x73\164\157\x6d\145\x72\137\166\x61\x6c\x69\x64\141\x74\151\x6f\x6e\x5f\x63\x75\163\x74\157\x6d\137\163\x6d\163\137\155\x73\x67"]);
        $ml = str_replace(PHP_EOL, "\45\60\141", $ml);
        update_mo_option("\x63\165\x73\164\157\155\x5f\163\155\x73\137\x6d\163\x67", $ml);
        update_mo_option("\x63\x75\163\x74\x6f\x6d\137\163\x6d\163\137\x67\141\164\x65\167\x61\x79", $A2["\x6d\157\137\143\165\x73\x74\157\x6d\x65\x72\137\166\x61\x6c\x69\144\141\x74\151\x6f\156\x5f\x63\x75\163\x74\x6f\x6d\x5f\163\155\163\137\x67\141\x74\145\167\141\171"]);
        do_action("\155\157\137\x72\x65\147\151\x73\164\162\141\x74\x69\157\x6e\x5f\163\x68\157\x77\137\155\x65\x73\x73\141\147\145", MoMessages::showMessage(MoMessages::SMS_TEMPLATE_SAVED), "\123\125\x43\103\105\x53\x53");
    }
    function _mo_configure_email_template($A2)
    {
        update_mo_option("\143\165\x73\x74\x6f\x6d\x5f\x65\155\x61\151\x6c\x5f\x6d\x73\147", wpautop($A2["\x6d\157\x5f\143\x75\x73\x74\x6f\155\x65\x72\x5f\166\141\x6c\151\144\x61\164\x69\157\x6e\x5f\x63\x75\x73\x74\x6f\155\x5f\x65\x6d\x61\151\154\137\x6d\x73\x67"]));
        update_mo_option("\x63\165\163\x74\x6f\155\137\x65\155\141\151\x6c\137\x73\165\x62\152\145\x63\164", sanitize_text_field($A2["\155\157\x5f\x63\x75\x73\164\157\155\145\x72\137\x76\x61\x6c\151\x64\x61\164\x69\x6f\x6e\137\143\165\x73\x74\157\155\137\x65\155\141\x69\x6c\137\163\165\142\152\x65\x63\x74"]));
        update_mo_option("\143\165\x73\164\x6f\155\137\x65\x6d\x61\151\154\137\146\162\x6f\x6d\137\151\144", sanitize_text_field($A2["\x6d\157\137\x63\165\163\164\x6f\x6d\145\x72\x5f\166\141\154\x69\x64\141\164\151\x6f\156\137\143\x75\x73\x74\x6f\155\137\145\155\x61\151\154\137\x66\x72\x6f\x6d\x5f\x69\144"]));
        update_mo_option("\143\165\163\x74\157\x6d\x5f\145\155\141\151\x6c\x5f\x66\162\x6f\x6d\137\x6e\x61\x6d\145", sanitize_text_field($A2["\x6d\157\137\x63\165\x73\164\157\x6d\145\x72\x5f\x76\141\x6c\x69\144\141\x74\x69\x6f\156\x5f\143\165\x73\164\157\155\137\145\155\141\151\154\137\146\x72\x6f\155\137\x6e\141\x6d\145"]));
        do_action("\155\157\137\x72\x65\x67\151\163\164\x72\141\164\x69\157\156\137\x73\x68\x6f\x77\x5f\155\145\163\x73\x61\147\145", MoMessages::showMessage(MoMessages::EMAIL_TEMPLATE_SAVED), "\123\125\103\103\x45\123\x53");
    }
    public function showConfigurationPage($ke)
    {
        $XX = get_mo_option("\143\165\163\164\x6f\155\137\163\x6d\x73\x5f\155\x73\x67") ? get_mo_option("\x63\x75\x73\164\x6f\x6d\137\163\x6d\163\137\x6d\163\x67") : MoMessages::showMessage(MoMessages::DEFAULT_SMS_TEMPLATE);
        $XX = mo_($XX);
        $i0 = get_mo_option("\143\x75\163\x74\x6f\155\137\x73\155\x73\137\147\x61\x74\145\167\x61\x79") ? get_mo_option("\x63\165\163\x74\157\155\137\x73\155\163\x5f\x67\x61\164\145\x77\141\x79") : '';
        $x2 = get_mo_option("\143\165\x73\x74\x6f\x6d\x5f\x65\x6d\141\151\x6c\137\x73\165\142\152\145\x63\x74") ? get_mo_option("\x63\165\163\164\157\x6d\137\145\155\141\x69\154\x5f\163\165\x62\152\145\143\x74") : MoMessages::showMessage(MoMessages::EMAIL_SUBJECT);
        $Nf = get_mo_option("\x63\x75\x73\164\157\155\x5f\x65\155\x61\x69\x6c\x5f\146\x72\157\155\x5f\x69\x64") ? get_mo_option("\143\x75\x73\x74\157\155\137\145\155\141\x69\x6c\137\146\162\157\x6d\137\x69\x64") : get_mo_option("\141\144\x6d\x69\156\137\x65\155\141\151\x6c");
        $XO = get_mo_option("\x63\165\163\x74\x6f\x6d\137\145\x6d\x61\x69\154\x5f\146\162\x6f\x6d\x5f\156\141\155\145") ? get_mo_option("\143\165\x73\164\157\x6d\137\145\x6d\x61\151\154\137\146\x72\x6f\x6d\x5f\x6e\x61\155\145") : get_bloginfo("\156\x61\x6d\x65");
        $zv = get_mo_option("\x63\165\x73\x74\x6f\155\137\x65\155\x61\x69\x6c\x5f\x6d\x73\147") ? stripslashes(get_mo_option("\143\165\x73\x74\x6f\x6d\137\x65\x6d\141\151\x6c\137\155\x73\x67")) : MoMessages::showMessage(MoMessages::DEFAULT_EMAIL_TEMPLATE);
        $L5 = "\x63\x75\x73\x74\157\x6d\x65\155\x61\151\154\x65\x64\151\x74\x6f\x72";
        $Nr = array("\155\145\144\x69\x61\137\142\x75\x74\x74\x6f\x6e\163" => false, "\x74\145\170\164\141\162\x65\x61\x5f\x6e\x61\155\x65" => "\x6d\x6f\137\143\165\x73\x74\157\155\145\x72\137\x76\x61\154\x69\144\x61\164\x69\x6f\156\137\x63\x75\163\164\x6f\155\x5f\x65\155\x61\x69\x6c\137\x6d\x73\x67", "\145\144\151\x74\157\162\137\150\x65\x69\147\x68\164" => "\61\67\60\x70\170", "\167\x70\x61\x75\x74\157\160" => false);
        $ec = MoOTPActionHandlerHandler::instance();
        $oD = $ec->getNonceValue();
        $fN = wp_nonce_field($oD);
        $xr = mo_("\x53\x4d\x53\x20\103\117\x4e\x46\111\107\125\122\101\x54\x49\117\x4e");
        $KK = mo_("\x53\115\x53\40\x54\x65\155\x70\x6c\141\x74\145");
        $Wz = mo_("\x45\156\x74\145\x72\x20\x4f\x54\120\40\123\115\x53\x20\115\x65\163\x73\x61\x67\145");
        $lm = mo_("\105\156\x74\x65\162\40\x79\x6f\x75\162\x20\123\115\x53\x20\x67\x61\x74\x65\167\141\x79\40\125\122\114");
        $hr = mo_("\123\x4d\x53\x20\107\141\x74\x65\x77\x61\171\40\x55\122\x4c");
        $At = mo_("\131\x6f\165\40\156\x65\x65\144\x20\164\157\x20\167\162\x69\x74\145\40\43\43\x6f\164\x70\x23\43\40\167\150\x65\x72\145\40\x79\x6f\x75\x20\x77\x69\163\x68\40\164\x6f\x20\160\x6c\141\x63\145\40\147\145\156\x65\x72\x61\x74\x65\144\x20\157\x74\160\x20\151\x6e\40\x74\150\x69\163\x20\164\145\155\x70\154\x61\164\145\x2e");
        $c6 = mo_("\x59\157\165\x20\167\x69\x6c\x6c\40\x6e\x65\145\x64\40\164\157\40\160\154\141\143\145\x20\x79\157\x75\162\40\123\115\x53\x20\147\141\x74\145\x77\141\x79\x20\x55\x52\x4c\x20\x69\x6e\40\164\x68\x65\x20\146\151\x65\x6c\x64\40\141\x62\157\x76\145\40\151\156\x20\x6f\x72\144\x65\x72\40\164\157\40\142\x65\40\xa\40\40\40\40\x20\40\40\40\40\40\40\40\40\40\x20\x20\x20\x20\x20\x20\40\40\x20\40\x20\x20\40\40\x20\x20\40\40\x20\x20\40\x20\x61\x62\154\145\40\164\x6f\40\163\145\x6e\144\x20\x4f\124\120\x73\40\x74\157\x20\164\x68\x65\40\x75\163\x65\162\47\163\40\160\150\157\x6e\145\56") . "\74\142\x72\x2f\x3e" . mo_("\131\157\165\40\167\x69\x6c\154\40\x62\145\x20\141\x62\154\x65\x20\164\157\40\x67\x65\164\x20\164\150\x69\163\40\x55\x52\114\40\146\162\157\155\x20\171\157\165\x72\40\123\x4d\123\40\x67\x61\x74\145\x77\x61\171\40\160\x72\x6f\166\x69\x64\145\162\x2e");
        $Ki = mo_("\x49\146\40\171\x6f\165\x20\x61\162\145\x20\150\x61\166\151\x6e\147\x20\164\162\x6f\165\142\154\145\x20\151\x6e\x20\x66\151\x6e\x64\151\x6e\x67\x20\171\157\165\x72\x20\x67\141\x74\x65\167\141\x79\x20\x55\x52\x4c\40\164\x68\x65\156\40\171\157\165\40\x64\162\x6f\x70\x20\165\x73\40\141\x6e\x20\12\x20\40\x20\x20\40\x20\x20\40\40\x20\40\40\x20\40\40\x20\40\40\40\x20\x20\40\40\40\40\x20\x20\40\x20\x20\40\x20\40\40\x20\x20\145\155\141\x69\x6c\40\x61\x74\40" . MoConstants::FEEDBACK_EMAIL . "\x2e\x20\127\145\x20\x77\151\154\x6c\x20\x68\x65\154\160\40\x79\157\165\40\x77\x69\x74\150\40\x74\150\x65\40\x73\x65\164\165\160\56");
        $Lj = "\105\170\141\x6d\160\154\145\72\55\x20\150\x74\164\160\72\x2f\x2f\x61\154\x65\x72\x74\163\56\x73\151\x6e\146\x69\156\151\56\143\x6f\155\x2f\x61\160\x69\x2f\167\x65\142\x32\x73\x6d\163\56\x70\x68\160\165\x73\x65\162\x6e\141\155\145\75\x58\131\x5a\46\160\141\x73\163\x77\157\x72\144\75\160\141\x73\163\x77\157\162\x64\46\164\157\x3d\x23\x23\160\x68\157\156\x65\43\x23\x26\163\145\156\144\145\162\x3d\163\x65\x6e\144\x65\162\151\144\46\x6d\145\x73\163\x61\147\x65\75\43\x23\x6d\x65\163\x73\x61\x67\145\x23\43";
        $Ff = mo_("\103\x41\116\116\x4f\x54\x20\x46\x49\116\104\40\124\110\105\x20\107\x41\124\x45\x57\x41\131\x20\125\122\114\x3f");
        $zA = mo_("\x53\141\166\x65\x20\x53\x4d\x53\x20\x43\157\x6e\146\x69\147\x75\x72\141\164\x69\157\x6e\x73");
        $HD = mo_("\105\115\x41\111\114\40\x43\117\x4e\x46\x49\107\125\122\x41\x54\111\x4f\x4e");
        $Om = mo_("\x59\157\165\x20\x6e\x65\x65\144\x20\x74\x6f\40\x63\157\x6e\x66\151\147\x75\162\x65\x20\x79\157\165\x72\40\160\150\x70\56\151\156\x69\x20\146\x69\x6c\145\x20\167\151\x74\150\40\x53\115\x54\x50\40\163\145\x74\164\151\156\x67\x73\40\164\157\x20\x62\x65\x20\141\142\x6c\145\40\164\x6f\x20\x73\145\x6e\144\40\145\155\x61\x69\154\x73\56");
        $ko = mo_("\123\141\166\145\40\x45\x6d\141\x69\x6c\40\x43\x6f\156\146\151\147\x75\162\x61\164\151\157\x6e\x73");
        $hP = mo_("\x45\x6e\x74\x65\162\40\171\x6f\x75\162\40\117\x54\x50\x20\x45\155\141\151\x6c\x20\x53\165\142\x6a\145\143\164");
        $ue = mo_("\x45\x6e\x74\145\x72\x20\x4e\141\x6d\x65");
        $Gh = mo_("\x45\x6e\164\145\x72\x20\145\155\x61\x69\x6c\x20\141\x64\x64\x72\145\x73\163");
        $sR = mo_("\x46\x72\x6f\x6d\x20\111\104");
        $Dh = mo_("\106\162\157\x6d\40\116\x61\155\145");
        $uU = mo_("\123\x75\142\x6a\145\x63\x74");
        $Oa = mo_("\x42\157\x64\171");
        include MOV_DIR . "\166\x69\x65\x77\x73\57\143\143\157\156\146\x69\147\165\162\141\164\x69\x6f\x6e\x2e\x70\x68\x70";
    }
    public function mo_send_otp_token($Ft, $xX, $lr)
    {
        if (MO_TEST_MODE) {
            goto WR;
        }
        $zv = $this->send_otp_token($Ft, $xX, $lr);
        return json_decode($zv, TRUE);
        goto qf;
        WR:
        return array("\x73\x74\x61\164\165\163" => "\123\125\x43\x43\x45\123\123", "\x74\x78\x49\x64" => MoUtility::rand());
        qf:
    }
    public function mo_send_notif(NotificationSettings $El)
    {
        $hy = $El->sendSMS ? self::send_sms_token($El->message, $El->phoneNumber) : self::send_email_token($El->message, $El->toEmail, $El->fromEmail, $El->subject);
        return !is_null($hy) ? json_encode(array("\163\164\x61\164\x75\163" => "\x53\x55\103\103\x45\x53\123")) : json_encode(array("\x73\164\141\164\165\163" => "\105\x52\x52\x4f\x52"));
    }
    private function send_otp_token($Ft, $xX = null, $lr = null)
    {
        $JD = get_mo_option("\x6f\x74\160\137\x6c\145\156\x67\x74\x68") ? get_mo_option("\x6f\x74\160\137\154\x65\x6e\147\164\x68") : 5;
        $Va = wp_rand(pow(10, $JD - 1), pow(10, $JD) - 1);
        $WF = get_mo_option("\141\144\155\x69\x6e\x5f\143\x75\163\164\157\155\145\x72\137\153\x65\171");
        $XG = $WF . $Va;
        $dB = hash("\x73\150\x61\x35\x31\x32", $XG);
        $hy = self::httpRequest($Ft, $Va, $xX, $lr);
        if ($hy) {
            goto wu;
        }
        $zv = array("\163\x74\141\164\165\x73" => "\x46\101\x49\x4c\x55\x52\105");
        goto Oo;
        wu:
        MoPHPSessions::addSessionVar("\x6d\x6f\x5f\157\164\x70\x74\x6f\153\x65\x6e", true);
        MoPHPSessions::addSessionVar("\163\x65\156\x74\137\157\156", time());
        $zv = array("\x73\164\x61\164\x75\x73" => "\123\125\103\103\105\x53\123", "\x74\x78\111\x64" => $dB);
        Oo:
        return json_encode($zv);
    }
    private function httpRequest($Ft, $Va, $xX = null, $lr = null)
    {
        $hy = null;
        switch ($Ft) {
            case "\x53\x4d\x53":
                $bJ = get_mo_option("\x63\165\x73\x74\x6f\x6d\x5f\163\x6d\x73\137\x6d\163\147") ? mo_(get_mo_option("\x63\x75\163\164\x6f\155\137\x73\155\163\137\x6d\x73\x67")) : mo_(MoMessages::showMessage(MoMessages::DEFAULT_SMS_TEMPLATE));
                $bJ = mo_($bJ);
                $bJ = str_replace("\x23\43\157\164\160\43\43", $Va, $bJ);
                $hy = $this->send_sms_token($bJ, $lr);
                goto SI;
            case "\x45\115\x41\x49\114":
                $bJ = get_mo_option("\x63\165\x73\164\x6f\x6d\x5f\145\x6d\141\x69\154\x5f\155\163\x67") ? mo_(get_mo_option("\x63\165\163\164\x6f\155\137\x65\155\x61\x69\x6c\137\155\x73\x67")) : mo_(MoMessages::showMessage(MoMessages::DEFAULT_EMAIL_TEMPLATE));
                $bJ = mo_($bJ);
                $bJ = stripslashes($bJ);
                $bJ = str_replace("\x23\43\157\x74\x70\x23\x23", $Va, $bJ);
                $bh = get_mo_option("\143\165\x73\164\x6f\155\x5f\x65\155\x61\x69\x6c\137\x66\162\x6f\155\137\151\x64");
                $uU = get_mo_option("\143\x75\x73\164\x6f\155\x5f\x65\x6d\x61\151\154\137\x73\x75\142\152\x65\143\164");
                $Uq = get_mo_option("\143\165\x73\x74\157\155\x5f\x65\x6d\x61\151\154\x5f\x66\x72\157\155\137\x6e\141\x6d\x65");
                $hy = $this->send_email_token($bJ, $xX, $bh, $uU, $Uq);
                goto SI;
        }
        sA:
        SI:
        return $hy;
    }
    private function send_sms_token($bJ, $lr)
    {
        $px = get_mo_option("\143\165\163\164\x6f\x6d\x5f\163\x6d\x73\137\x67\x61\x74\x65\x77\141\171");
        $bJ = str_replace("\x20", "\53", $bJ);
        $px = str_replace("\43\43\x6d\x65\x73\x73\141\x67\145\43\43", $bJ, $px);
        $px = str_replace("\x23\x23\x70\150\157\x6e\145\43\43", apply_filters("\x6d\157\137\x66\151\154\164\x65\x72\137\160\x68\x6f\156\x65\137\x62\x65\146\x6f\x72\x65\x5f\141\x70\x69\x5f\x63\141\154\154", $lr), $px);
        $px = apply_filters("\x63\x75\x73\164\157\x6d\x69\172\x65\137\x6f\x74\x70\x5f\x75\x72\x6c\x5f\142\145\146\157\x72\145\x5f\141\160\151\x5f\x63\141\154\154", $px, $bJ, apply_filters("\x6d\x6f\137\146\151\x6c\x74\145\x72\137\x70\x68\157\156\x65\x5f\142\145\x66\x6f\x72\x65\x5f\x61\x70\x69\x5f\x63\x61\x6c\x6c", $lr));
        $hy = MocURLOTP::callAPI($px, null, null);
        return $hy;
    }
    private function send_email_token($bJ, $xX, $bh = null, $uU = null, $Uq = null)
    {
        $bh = !MoUtility::isBlank($bh) ? $bh : MoConstants::FROM_EMAIL;
        $uU = !MoUtility::isBlank($uU) ? $uU : MoMessages::showMessage(MoMessages::EMAIL_SUBJECT);
        $Uq = !MoUtility::isBlank($Uq) ? $Uq : $bh;
        $UG = "\x46\162\x6f\x6d\72" . $Uq . "\x20\x3c" . $bh . "\76\x20\xa";
        $UG .= MoConstants::HEADER_CONTENT_TYPE;
        $zv = $bJ;
        return ini_get("\123\115\x54\x50") != FALSE || ini_get("\x73\155\x74\x70\137\160\157\x72\x74") != FALSE ? wp_mail($xX, $uU, $zv, $UG) : false;
    }
    public function mo_validate_otp_token($Js, $Le)
    {
        return MO_TEST_MODE ? MO_FAIL_MODE ? array("\x73\164\x61\164\x75\163" => '') : array("\x73\164\x61\x74\x75\163" => "\x53\x55\x43\x43\105\123\x53") : $this->validate_otp_token($Js, $Le);
    }
    private function validate_otp_token($dB, $XS)
    {
        $WF = get_mo_option("\141\144\x6d\151\x6e\x5f\143\x75\163\x74\x6f\155\145\162\137\x6b\x65\x79");
        if (MoPHPSessions::getSessionVar("\155\x6f\137\157\164\160\164\157\x6b\145\156")) {
            goto KM;
        }
        $zv = array("\163\x74\x61\x74\x75\x73" => MoConstants::FAILURE);
        goto Ew;
        KM:
        $EZ = $this->checkTimeStamp(MoPHPSessions::getSessionVar("\x73\145\x6e\164\x5f\x6f\156"), time());
        $EZ = $this->checkTransactionId($WF, $XS, $dB, $EZ);
        if ($EZ) {
            goto Ov;
        }
        $zv = array("\x73\164\141\x74\165\x73" => MoConstants::FAILURE);
        goto gI;
        Ov:
        $zv = array("\163\x74\x61\164\x75\x73" => MoConstants::SUCCESS);
        gI:
        MoPHPSessions::unsetSession("\x24\x6d\157\137\x6f\x74\160\164\x6f\x6b\x65\x6e");
        Ew:
        return $zv;
    }
    private function checkTimeStamp($Te, $g2)
    {
        $iU = get_mo_option("\157\164\x70\137\x76\x61\154\151\144\x69\x74\171") ? get_mo_option("\157\x74\160\137\x76\141\154\151\x64\151\x74\171") : 5;
        $ei = round(abs($g2 - $Te) / 60, 2);
        return $ei > $iU ? false : true;
    }
    private function checkTransactionId($WF, $XS, $dB, $EZ)
    {
        if ($EZ) {
            goto oa;
        }
        return false;
        oa:
        $XG = $WF . $XS;
        $vA = hash("\163\x68\x61\65\x31\62", $XG);
        return $vA === $dB;
    }
}
