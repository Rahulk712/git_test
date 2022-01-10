<?php


namespace OTP\Helper;

use OTP\Objects\NotificationSettings;
if (defined("\x41\102\x53\x50\101\x54\110")) {
    goto ti;
}
die;
ti:
class MocURLOTP
{
    public static function create_customer($xX, $uj, $wh, $lr = '', $Iz = '', $oG = '')
    {
        $px = MoConstants::HOSTNAME . "\x2f\x6d\x6f\141\163\x2f\x72\145\163\164\x2f\x63\165\163\x74\157\155\145\162\x2f\x61\x64\x64";
        $WF = MoConstants::DEFAULT_CUSTOMER_KEY;
        $MX = MoConstants::DEFAULT_API_KEY;
        $TH = array("\x63\157\155\160\x61\156\x79\116\141\155\x65" => $uj, "\141\162\145\141\117\x66\111\156\x74\x65\162\145\x73\164" => MoConstants::AREA_OF_INTEREST, "\146\151\162\163\164\156\x61\x6d\145" => $Iz, "\154\141\163\x74\x6e\x61\x6d\145" => $oG, "\x65\155\141\151\x6c" => $xX, "\160\150\x6f\x6e\x65" => $lr, "\160\141\163\x73\167\157\x72\144" => $wh);
        $uL = json_encode($TH);
        $CC = self::createAuthHeader($WF, $MX);
        $hy = self::callAPI($px, $uL, $CC);
        return $hy;
    }
    public static function get_customer_key($xX, $wh)
    {
        $px = MoConstants::HOSTNAME . "\57\x6d\157\x61\163\57\162\145\163\x74\x2f\143\165\163\164\x6f\x6d\145\x72\x2f\153\x65\171";
        $WF = MoConstants::DEFAULT_CUSTOMER_KEY;
        $MX = MoConstants::DEFAULT_API_KEY;
        $TH = array("\x65\x6d\x61\x69\x6c" => $xX, "\x70\141\x73\163\x77\157\x72\144" => $wh);
        $uL = json_encode($TH);
        $CC = self::createAuthHeader($WF, $MX);
        $hy = self::callAPI($px, $uL, $CC);
        return $hy;
    }
    public static function check_customer($xX)
    {
        $px = MoConstants::HOSTNAME . "\57\x6d\x6f\141\x73\57\x72\x65\x73\x74\x2f\143\165\163\164\x6f\155\145\x72\x2f\143\150\145\x63\153\55\151\146\x2d\x65\170\x69\163\164\x73";
        $WF = MoConstants::DEFAULT_CUSTOMER_KEY;
        $MX = MoConstants::DEFAULT_API_KEY;
        $TH = array("\x65\155\x61\151\x6c" => $xX);
        $uL = json_encode($TH);
        $CC = self::createAuthHeader($WF, $MX);
        $hy = self::callAPI($px, $uL, $CC);
        return $hy;
    }
    public static function mo_send_otp_token($JE, $xX = '', $lr = '')
    {
        $px = MoConstants::HOSTNAME . "\x2f\155\157\x61\x73\x2f\x61\x70\x69\57\x61\x75\x74\x68\57\x63\x68\141\x6c\154\145\156\x67\x65";
        $WF = !MoUtility::isBlank(get_mo_option("\141\144\155\151\x6e\x5f\x63\165\163\x74\157\x6d\145\x72\x5f\153\145\171")) ? get_mo_option("\141\144\x6d\151\156\x5f\x63\165\x73\164\x6f\x6d\x65\162\x5f\153\x65\171") : MoConstants::DEFAULT_CUSTOMER_KEY;
        $MX = !MoUtility::isBlank(get_mo_option("\141\144\x6d\x69\156\x5f\141\x70\151\137\153\x65\x79")) ? get_mo_option("\141\144\155\x69\x6e\x5f\141\160\151\x5f\153\x65\x79") : MoConstants::DEFAULT_API_KEY;
        $TH = array("\x63\x75\163\164\157\x6d\145\162\113\x65\171" => $WF, "\145\155\141\151\154" => $xX, "\x70\150\x6f\x6e\145" => $lr, "\x61\165\164\x68\x54\171\160\x65" => $JE, "\164\162\141\x6e\163\141\143\164\151\157\156\116\141\x6d\145" => MoConstants::AREA_OF_INTEREST);
        $uL = json_encode($TH);
        $CC = self::createAuthHeader($WF, $MX);
        $hy = self::callAPI($px, $uL, $CC);
        return $hy;
    }
    public static function validate_otp_token($dB, $XS)
    {
        $px = MoConstants::HOSTNAME . "\57\155\x6f\141\x73\x2f\x61\x70\151\x2f\141\x75\164\x68\57\x76\141\154\x69\x64\141\x74\145";
        $WF = !MoUtility::isBlank(get_mo_option("\x61\x64\155\151\x6e\137\143\x75\x73\164\157\155\145\162\137\x6b\x65\171")) ? get_mo_option("\x61\144\155\x69\x6e\x5f\143\x75\163\x74\x6f\155\x65\x72\137\153\145\171") : MoConstants::DEFAULT_CUSTOMER_KEY;
        $MX = !MoUtility::isBlank(get_mo_option("\141\144\x6d\151\x6e\x5f\x61\x70\151\x5f\153\x65\171")) ? get_mo_option("\141\x64\x6d\151\x6e\x5f\141\x70\151\x5f\x6b\x65\x79") : MoConstants::DEFAULT_API_KEY;
        $TH = array("\x74\170\111\144" => $dB, "\164\x6f\153\145\x6e" => $XS);
        $uL = json_encode($TH);
        $CC = self::createAuthHeader($WF, $MX);
        $hy = self::callAPI($px, $uL, $CC);
        return $hy;
    }
    public static function submit_contact_us($PM, $CP, $qT)
    {
        $current_user = wp_get_current_user();
        $px = MoConstants::HOSTNAME . "\x2f\155\157\141\163\57\x72\145\x73\x74\x2f\x63\x75\163\164\x6f\x6d\x65\162\x2f\143\157\x6e\164\x61\x63\164\55\x75\163";
        $qT = "\x5b" . MoConstants::AREA_OF_INTEREST . "\x5d\x3a\40" . $qT;
        $WF = !MoUtility::isBlank(get_mo_option("\141\x64\155\x69\156\x5f\x63\165\x73\x74\157\x6d\145\162\x5f\153\145\171")) ? get_mo_option("\x61\144\155\x69\x6e\x5f\x63\165\x73\164\x6f\155\x65\162\x5f\x6b\x65\x79") : MoConstants::DEFAULT_CUSTOMER_KEY;
        $MX = !MoUtility::isBlank(get_mo_option("\141\144\155\151\156\137\141\160\151\x5f\x6b\145\x79")) ? get_mo_option("\x61\x64\155\151\156\x5f\141\160\x69\137\153\145\x79") : MoConstants::DEFAULT_API_KEY;
        $TH = array("\x66\x69\162\x73\x74\x4e\141\155\145" => $current_user->user_firstname, "\154\x61\163\x74\116\x61\155\145" => $current_user->user_lastname, "\143\x6f\155\160\x61\x6e\171" => $_SERVER["\x53\x45\x52\x56\105\x52\x5f\116\x41\x4d\105"], "\x65\155\x61\151\154" => $PM, "\x63\x63\x45\x6d\141\x69\154" => MoConstants::FEEDBACK_EMAIL, "\160\x68\x6f\156\x65" => $CP, "\161\165\145\162\171" => $qT);
        $P9 = json_encode($TH);
        $CC = self::createAuthHeader($WF, $MX);
        $hy = self::callAPI($px, $P9, $CC);
        return true;
    }
    public static function forgot_password($xX)
    {
        $px = MoConstants::HOSTNAME . "\57\x6d\x6f\141\163\x2f\x72\x65\163\164\x2f\x63\x75\x73\164\x6f\x6d\x65\162\x2f\160\x61\x73\163\167\x6f\162\x64\55\162\x65\163\x65\164";
        $WF = get_mo_option("\x61\x64\x6d\x69\x6e\x5f\143\165\x73\164\x6f\155\145\162\x5f\153\x65\x79");
        $MX = get_mo_option("\141\144\x6d\151\156\x5f\x61\160\x69\x5f\153\145\x79");
        $TH = array("\x65\x6d\141\x69\154" => $xX);
        $uL = json_encode($TH);
        $CC = self::createAuthHeader($WF, $MX);
        $hy = self::callAPI($px, $uL, $CC);
        return $hy;
    }
    public static function check_customer_ln($WF, $MX, $qv)
    {
        $px = MoConstants::HOSTNAME . "\57\x6d\157\x61\x73\x2f\x72\x65\163\x74\57\143\165\x73\x74\x6f\x6d\x65\162\x2f\154\x69\143\x65\x6e\x73\x65";
        $TH = array("\x63\x75\163\x74\x6f\x6d\145\x72\x49\x64" => $WF, "\141\x70\x70\154\x69\x63\141\x74\151\157\x6e\116\141\155\x65" => $qv, "\x6c\x69\x63\145\156\163\145\124\171\x70\145" => !MoUtility::micr() ? "\x44\x45\x4d\x4f" : "\120\122\x45\x4d\111\x55\x4d");
        $uL = json_encode($TH);
        $CC = self::createAuthHeader($WF, $MX);
        $hy = self::callAPI($px, $uL, $CC);
        return $hy;
    }
    public static function createAuthHeader($WF, $MX)
    {
        $h9 = self::getTimestamp();
        if (!MoUtility::isBlank($h9)) {
            goto pj;
        }
        $h9 = round(microtime(true) * 1000);
        $h9 = number_format($h9, 0, '', '');
        pj:
        $XG = $WF . $h9 . $MX;
        $CC = hash("\163\150\x61\x35\61\62", $XG);
        $GJ = array("\x43\x6f\156\164\x65\156\164\55\124\171\160\x65" => "\141\x70\160\154\151\x63\141\x74\x69\157\156\x2f\152\x73\157\156", "\103\x75\163\x74\x6f\155\145\x72\x2d\x4b\x65\x79" => $WF, "\x54\151\155\145\163\164\141\155\x70" => $h9, "\101\165\x74\150\157\x72\151\172\x61\164\151\x6f\x6e" => $CC);
        return $GJ;
    }
    public static function getTimestamp()
    {
        $px = MoConstants::HOSTNAME . "\57\155\x6f\141\x73\x2f\x72\145\163\164\57\x6d\157\x62\x69\x6c\145\x2f\x67\x65\x74\55\164\x69\x6d\x65\x73\164\x61\x6d\x70";
        return self::callAPI($px, null, null);
    }
    public static function callAPI($px, $iA, $UG = array("\x43\x6f\156\x74\x65\156\164\x2d\124\171\160\145" => "\141\160\x70\154\x69\x63\x61\x74\151\x6f\x6e\x2f\x6a\163\157\x6e"), $Ac = "\120\x4f\123\124")
    {
        $mx = array("\155\x65\x74\x68\157\x64" => $Ac, "\x62\x6f\144\171" => $iA, "\x74\x69\x6d\x65\x6f\165\164" => "\61\x30\60\60\60", "\x72\x65\144\x69\162\x65\x63\x74\x69\157\x6e" => "\61\60", "\x68\x74\164\160\x76\x65\162\x73\x69\157\x6e" => "\x31\56\x30", "\x62\x6c\157\143\153\151\x6e\x67" => true, "\x68\x65\x61\x64\145\162\x73" => $UG, "\163\x73\x6c\x76\x65\162\x69\146\171" => MOV_SSL_VERIFY);
        $hy = wp_remote_post($px, $mx);
        if (!is_wp_error($hy)) {
            goto Km;
        }
        wp_die("\x53\157\x6d\145\164\150\151\156\x67\40\167\145\x6e\164\x20\167\162\157\156\x67\72\40\74\x62\162\x2f\x3e\x20{$hy->get_error_message()}");
        Km:
        return wp_remote_retrieve_body($hy);
    }
    public static function send_notif(NotificationSettings $El)
    {
        $Xk = GatewayFunctions::instance();
        return $Xk->mo_send_notif($El);
    }
}
