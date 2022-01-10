<?php


namespace OTP\Helper;

use OTP\Objects\NotificationSettings;
use OTP\Objects\TabDetails;
use OTP\Objects\Tabs;
use ReflectionClass;
use ReflectionException;
use stdClass;
if (defined("\101\x42\123\x50\101\x54\110")) {
    goto DL;
}
die;
DL:
class MoUtility
{
    public static function get_hidden_phone($lr)
    {
        return "\170\x78\x78\x78\x78\x78\x78" . substr($lr, strlen($lr) - 3);
    }
    public static function isBlank($sA)
    {
        return !isset($sA) || empty($sA);
    }
    public static function createJson($bJ, $WP)
    {
        return array("\x6d\145\x73\163\x61\x67\145" => $bJ, "\162\145\163\x75\154\164" => $WP);
    }
    public static function mo_is_curl_installed()
    {
        return in_array("\143\x75\x72\154", get_loaded_extensions());
    }
    public static function currentPageUrl()
    {
        $EM = "\150\164\x74\160";
        if (!(isset($_SERVER["\x48\x54\124\120\123"]) && $_SERVER["\x48\x54\124\120\x53"] == "\x6f\x6e")) {
            goto jh;
        }
        $EM .= "\x73";
        jh:
        $EM .= "\72\x2f\x2f";
        if ($_SERVER["\x53\x45\x52\x56\105\122\137\x50\x4f\x52\x54"] != "\x38\x30") {
            goto iG;
        }
        $EM .= $_SERVER["\x53\x45\x52\126\x45\122\x5f\116\101\115\x45"] . $_SERVER["\122\105\121\125\x45\123\124\x5f\125\122\111"];
        goto NA;
        iG:
        $EM .= $_SERVER["\x53\x45\122\126\x45\x52\x5f\116\x41\115\x45"] . "\x3a" . $_SERVER["\x53\x45\122\126\x45\122\x5f\120\x4f\x52\x54"] . $_SERVER["\x52\x45\121\125\x45\x53\124\x5f\x55\122\111"];
        NA:
        if (!function_exists("\x61\x70\160\x6c\x79\137\146\x69\x6c\164\x65\x72\163")) {
            goto sR;
        }
        apply_filters("\155\157\x5f\143\165\x72\x6c\x5f\x70\141\147\x65\137\165\162\154", $EM);
        sR:
        return $EM;
    }
    public static function getDomain($xX)
    {
        return $yX = substr(strrchr($xX, "\100"), 1);
    }
    public static function validatePhoneNumber($lr)
    {
        return preg_match(MoConstants::PATTERN_PHONE, MoUtility::processPhoneNumber($lr), $U8);
    }
    public static function isCountryCodeAppended($lr)
    {
        return preg_match(MoConstants::PATTERN_COUNTRY_CODE, $lr, $U8) ? true : false;
    }
    public static function processPhoneNumber($lr)
    {
        $lr = preg_replace(MoConstants::PATTERN_SPACES_HYPEN, '', ltrim(trim($lr), "\x30"));
        $JR = CountryList::getDefaultCountryCode();
        $lr = !isset($JR) || MoUtility::isCountryCodeAppended($lr) ? $lr : $JR . $lr;
        return apply_filters("\x6d\x6f\137\x70\x72\157\x63\145\x73\x73\x5f\160\150\157\x6e\145", $lr);
    }
    public static function micr()
    {
        $xX = get_mo_option("\141\x64\155\x69\156\x5f\x65\x6d\141\151\154");
        $WF = get_mo_option("\141\144\x6d\151\156\137\143\x75\163\x74\x6f\x6d\x65\x72\137\x6b\145\171");
        if (!$xX || !$WF || !is_numeric(trim($WF))) {
            goto gE;
        }
        return 1;
        goto Sj;
        gE:
        return 0;
        Sj:
    }
    public static function rand()
    {
        $aV = wp_rand(0, 15);
        $vi = "\60\61\x32\x33\x34\65\66\x37\70\x39\x61\142\143\144\145\x66\147\150\151\152\153\154\x6d\156\x6f\x70\161\x72\163\x74\x75\166\x77\x78\x79\x7a\101\102\x43\x44\x45\106\x47\110\x49\x4a\113\x4c\115\x4e\117\x50\x51\122\123\124\125\126\127\130\x59\x5a";
        $p8 = '';
        $eI = 0;
        QU:
        if (!($eI < $aV)) {
            goto P2;
        }
        $p8 .= $vi[wp_rand(0, strlen($vi) - 1)];
        Wg:
        $eI++;
        goto QU;
        P2:
        return $p8;
    }
    public static function micv()
    {
        $xX = get_mo_option("\x61\x64\x6d\151\156\137\x65\155\141\x69\x6c");
        $WF = get_mo_option("\141\144\x6d\x69\x6e\x5f\x63\165\163\164\x6f\x6d\145\162\137\x6b\145\171");
        $zT = get_mo_option("\143\x68\x65\143\x6b\137\154\156");
        if (!$xX || !$WF || !is_numeric(trim($WF))) {
            goto mT;
        }
        return $zT ? $zT : 0;
        goto dC;
        mT:
        return 0;
        dC:
    }
    public static function _handle_mo_check_ln($Of, $WF, $MX)
    {
        $Vh = MoMessages::FREE_PLAN_MSG;
        $o4 = array();
        $Xk = GatewayFunctions::instance();
        $zv = json_decode(MocURLOTP::check_customer_ln($WF, $MX, $Xk->getApplicationName()), true);
        if (strcasecmp($zv["\163\x74\x61\x74\x75\163"], "\x53\125\x43\x43\x45\x53\x53") == 0) {
            goto eB;
        }
        $zv = json_decode(MocURLOTP::check_customer_ln($WF, $MX, "\167\160\137\145\x6d\141\151\x6c\x5f\x76\x65\162\151\x66\x69\143\x61\x74\x69\157\x6e\137\x69\156\164\162\141\x6e\145\164"), true);
        if (!MoUtility::sanitizeCheck("\154\x69\x63\x65\x6e\163\x65\120\154\141\156", $zv)) {
            goto CC;
        }
        $Vh = MoMessages::INSTALL_PREMIUM_PLUGIN;
        CC:
        goto nL;
        eB:
        if (!MoUtility::sanitizeCheck("\x6c\x69\x63\x65\x6e\163\145\120\154\141\x6e", $zv)) {
            goto FO;
        }
        $Vh = MoMessages::UPGRADE_MSG;
        $o4 = array("\x70\154\x61\x6e" => $zv["\x6c\151\143\145\x6e\163\x65\120\x6c\141\x6e"]);
        update_mo_option("\143\x68\145\x63\153\x5f\154\x6e", base64_encode($zv["\154\151\143\145\x6e\x73\145\x50\154\x61\156"]));
        FO:
        $eT = isset($zv["\x65\155\x61\151\x6c\x52\x65\155\x61\151\156\x69\156\147"]) ? $zv["\x65\155\x61\151\x6c\122\145\x6d\x61\x69\x6e\151\156\x67"] : 0;
        $o8 = isset($zv["\163\155\163\122\145\155\141\151\x6e\x69\x6e\147"]) ? $zv["\x73\155\163\x52\145\155\141\151\156\x69\156\x67"] : 0;
        update_mo_option("\x65\155\141\x69\154\137\x74\162\x61\x6e\x73\x61\x63\164\x69\157\156\163\137\162\145\155\x61\151\x6e\x69\156\x67", $eT);
        update_mo_option("\x70\150\x6f\x6e\145\x5f\164\162\x61\x6e\163\x61\x63\x74\x69\x6f\x6e\x73\x5f\x72\x65\155\141\x69\x6e\151\x6e\x67", $o8);
        nL:
        if (!$Of) {
            goto OF;
        }
        do_action("\x6d\x6f\x5f\x72\x65\147\151\163\164\162\x61\x74\151\x6f\156\137\x73\x68\x6f\167\x5f\x6d\x65\163\163\141\x67\145", MoMessages::showMessage($Vh, $o4), "\x53\125\103\x43\105\123\x53");
        OF:
    }
    public static function initialize_transaction($form)
    {
        $L2 = new ReflectionClass(FormSessionVars::class);
        foreach ($L2->getConstants() as $xl => $sA) {
            MoPHPSessions::unsetSession($sA);
            wr:
        }
        gV:
        SessionUtils::initializeForm($form);
    }
    public static function _get_invalid_otp_method()
    {
        return get_mo_option("\x69\x6e\166\141\154\151\144\137\x6d\x65\x73\163\x61\147\x65", "\x6d\x6f\x5f\x6f\x74\160\137") ? mo_(get_mo_option("\x69\156\x76\x61\x6c\x69\144\x5f\x6d\145\163\x73\x61\147\x65", "\155\157\137\157\164\x70\x5f")) : MoMessages::showMessage(MoMessages::INVALID_OTP);
    }
    public static function _is_polylang_installed()
    {
        return function_exists("\160\x6c\154\137\x5f") && function_exists("\x70\x6c\x6c\137\162\145\147\151\163\x74\145\162\x5f\x73\164\x72\x69\x6e\147");
    }
    public static function replaceString(array $NS, $WI)
    {
        foreach ($NS as $xl => $sA) {
            $WI = str_replace("\x7b" . $xl . "\175", $sA, $WI);
            AR:
        }
        OY:
        return $WI;
    }
    private static function testResult()
    {
        $qY = new stdClass();
        $qY->status = MO_FAIL_MODE ? "\x45\x52\122\x4f\122" : "\123\x55\x43\103\105\123\x53";
        return $qY;
    }
    public static function send_phone_notif($cf, $Vh)
    {
        $Ty = function ($cf, $Vh) {
            return json_decode(MocURLOTP::send_notif(new NotificationSettings($cf, $Vh)));
        };
        $cf = MoUtility::processPhoneNumber($cf);
        $Vh = self::replaceString(array("\x70\150\x6f\156\145" => str_replace("\53", '', "\x25\x32\x42" . $cf)), $Vh);
        $zv = MO_TEST_MODE ? self::testResult() : $Ty($cf, $Vh);
        return strcasecmp($zv->status, "\123\x55\103\103\x45\123\x53") == 0 ? true : false;
    }
    public static function send_email_notif($bh, $Uq, $BV, $uU, $bJ)
    {
        $Ty = function ($bh, $Uq, $BV, $uU, $bJ) {
            $wl = new NotificationSettings($bh, $Uq, $BV, $uU, $bJ);
            return json_decode(MocURLOTP::send_notif($wl));
        };
        $zv = MO_TEST_MODE ? self::testResult() : $Ty($bh, $Uq, $BV, $uU, $bJ);
        return strcasecmp($zv->status, "\x53\x55\103\x43\105\123\x53") == 0 ? true : false;
    }
    public static function sanitizeCheck($xl, $SP)
    {
        if (is_array($SP)) {
            goto d0;
        }
        return $SP;
        d0:
        $sA = !array_key_exists($xl, $SP) || self::isBlank($SP[$xl]) ? false : $SP[$xl];
        return is_array($sA) ? $sA : sanitize_text_field($sA);
    }
    public static function mclv()
    {
        $Xk = GatewayFunctions::instance();
        return $Xk->mclv();
    }
    public static function isMG()
    {
        $Xk = GatewayFunctions::instance();
        return $Xk->isMG();
    }
    public static function areFormOptionsBeingSaved($BF)
    {
        return current_user_can("\155\x61\x6e\x61\x67\145\x5f\157\x70\x74\x69\157\x6e\x73") && self::micr() && self::mclv() && isset($_POST["\x6f\160\164\x69\x6f\x6e"]) && $BF == $_POST["\x6f\160\164\x69\x6f\x6e"];
    }
    public static function is_addon_activated()
    {
        if (!(self::micr() && self::mclv())) {
            goto qw;
        }
        return;
        qw:
        $bf = TabDetails::instance();
        $Zs = add_query_arg(array("\x70\141\x67\145" => $bf->_tabDetails[Tabs::ACCOUNT]->_menuSlug), remove_query_arg("\x61\144\x64\x6f\156", $_SERVER["\122\x45\x51\125\105\123\x54\137\x55\x52\x49"]));
        echo "\x3c\144\x69\166\x20\163\x74\x79\x6c\x65\x3d\42\144\151\x73\160\154\x61\x79\72\x62\154\157\143\153\x3b\x6d\x61\162\x67\x69\156\55\x74\157\x70\x3a\x31\60\160\170\x3b\x63\x6f\154\157\x72\x3a\x72\145\144\73\x62\x61\143\153\147\x72\x6f\x75\x6e\x64\55\x63\x6f\x6c\x6f\162\72\x72\147\142\141\x28\x32\65\61\x2c\x20\x32\x33\x32\54\x20\60\54\40\60\x2e\61\x35\51\73\12\x9\x9\x9\x9\x9\x9\11\11\x70\141\x64\x64\x69\x6e\147\x3a\65\x70\170\73\x62\x6f\x72\x64\x65\x72\x3a\163\x6f\x6c\x69\x64\x20\61\160\170\x20\x72\147\x62\x61\50\x32\x35\x35\x2c\40\x30\x2c\x20\x39\x2c\40\60\x2e\x33\x36\51\73\x22\76\xa\11\x9\11\x20\11\11\74\x61\x20\x68\x72\x65\146\75\x22" . $Zs . "\42\76" . mo_("\126\141\x6c\151\x64\x61\x74\x65\x20\x79\157\165\162\40\160\x75\162\143\x68\141\x73\x65") . "\x3c\57\141\x3e\x20\xa\11\x9\x9\40\11\11\11\x9" . mo_("\x20\x74\157\x20\145\156\141\142\154\145\x20\164\x68\145\40\x41\x64\x64\40\x4f\x6e") . "\x3c\57\144\151\166\x3e";
    }
    public static function getActivePluginVersion($mH, $Dk = 0)
    {
        if (function_exists("\147\x65\164\x5f\x70\154\165\x67\151\156\x73")) {
            goto JU;
        }
        require_once ABSPATH . "\x77\x70\55\141\x64\155\151\156\57\151\x6e\143\x6c\165\144\x65\163\x2f\160\154\x75\x67\151\156\x2e\x70\x68\160";
        JU:
        $hZ = get_plugins();
        $Ne = get_option("\141\143\164\x69\x76\145\x5f\x70\x6c\x75\147\x69\156\x73");
        foreach ($hZ as $xl => $sA) {
            if (!(strcasecmp($sA["\116\x61\155\x65"], $mH) == 0)) {
                goto xm;
            }
            if (!in_array($xl, $Ne)) {
                goto bc;
            }
            return (int) $sA["\x56\145\162\x73\x69\157\x6e"][$Dk];
            bc:
            xm:
            U4:
        }
        AY:
        return null;
    }
}
