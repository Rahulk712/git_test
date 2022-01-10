<?php


namespace OTP\Helper;

use OTP\Objects\IMoSessions;
if (defined("\101\102\123\120\101\124\x48")) {
    goto Za;
}
die;
Za:
class MoPHPSessions implements IMoSessions
{
    static function addSessionVar($xl, $Kw)
    {
        switch (MOV_SESSION_TYPE) {
            case "\x43\117\x4f\113\x49\x45":
                setcookie($xl, maybe_serialize($Kw));
                goto xR;
            case "\123\105\x53\123\x49\x4f\116":
                self::checkSession();
                $_SESSION[$xl] = maybe_serialize($Kw);
                goto xR;
            case "\103\x41\x43\110\105":
                if (wp_cache_add($xl, maybe_serialize($Kw))) {
                    goto s0;
                }
                wp_cache_replace($xl, maybe_serialize($Kw));
                s0:
                goto xR;
            case "\x54\122\x41\116\123\x49\105\x4e\x54":
                if (!isset($_COOKIE["\x74\162\141\x6e\163\151\145\x6e\164\x5f\x6b\x65\171"])) {
                    goto ix;
                }
                $cC = $_COOKIE["\164\162\x61\156\163\151\145\x6e\x74\x5f\x6b\x65\171"];
                goto WS;
                ix:
                if (!wp_cache_get("\164\162\x61\156\163\x69\145\x6e\164\137\x6b\x65\171")) {
                    goto aG;
                }
                $cC = wp_cache_get("\164\x72\141\x6e\163\x69\x65\x6e\x74\137\x6b\x65\171");
                goto rZ;
                aG:
                $cC = MoUtility::rand();
                if (!ob_get_contents()) {
                    goto tp;
                }
                ob_clean();
                tp:
                setcookie("\164\162\x61\156\x73\x69\145\156\164\x5f\x6b\145\171", $cC, time() + 12 * HOUR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
                wp_cache_add("\x74\162\x61\x6e\163\x69\x65\156\x74\x5f\153\x65\171", $cC);
                rZ:
                WS:
                set_site_transient($cC . $xl, $Kw, 12 * HOUR_IN_SECONDS);
                goto xR;
        }
        wm:
        xR:
    }
    static function getSessionVar($xl)
    {
        switch (MOV_SESSION_TYPE) {
            case "\x43\x4f\117\113\111\105":
                return maybe_unserialize($_COOKIE[$xl]);
            case "\123\105\x53\123\111\x4f\x4e":
                self::checkSession();
                return maybe_unserialize(MoUtility::sanitizeCheck($xl, $_SESSION));
            case "\103\x41\103\x48\105":
                return maybe_unserialize(wp_cache_get($xl));
            case "\x54\122\x41\116\123\x49\x45\x4e\124":
                $cC = isset($_COOKIE["\x74\x72\x61\x6e\163\x69\145\x6e\164\137\x6b\145\x79"]) ? $_COOKIE["\x74\x72\x61\x6e\x73\x69\x65\x6e\x74\137\x6b\x65\x79"] : wp_cache_get("\164\x72\141\x6e\x73\x69\145\156\164\137\153\145\x79");
                return get_site_transient($cC . $xl);
        }
        ir:
        na:
    }
    static function unsetSession($xl)
    {
        switch (MOV_SESSION_TYPE) {
            case "\103\117\x4f\113\x49\105":
                unset($_COOKIE[$xl]);
                setcookie($xl, '', time() - 15 * 60);
                goto C6;
            case "\123\105\x53\123\111\x4f\x4e":
                self::checkSession();
                unset($_SESSION[$xl]);
                goto C6;
            case "\103\101\103\110\105":
                wp_cache_delete($xl);
                goto C6;
            case "\x54\x52\x41\116\x53\x49\105\x4e\124":
                $cC = isset($_COOKIE["\x74\162\x61\156\163\x69\145\156\x74\137\153\x65\x79"]) ? $_COOKIE["\164\162\141\156\163\x69\145\156\164\x5f\153\145\171"] : wp_cache_get("\164\162\141\x6e\163\x69\145\x6e\164\137\x6b\x65\x79");
                if (MoUtility::isBlank($cC)) {
                    goto Wz;
                }
                delete_site_transient($cC . $xl);
                Wz:
                goto C6;
        }
        Hr:
        C6:
    }
    static function checkSession()
    {
        if (!(MOV_SESSION_TYPE == "\123\105\x53\123\111\x4f\x4e")) {
            goto e6;
        }
        if (!(session_id() == '' || !isset($_SESSION))) {
            goto X3;
        }
        session_start();
        X3:
        e6:
    }
}
