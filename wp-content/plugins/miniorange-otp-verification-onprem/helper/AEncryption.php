<?php


namespace OTP\Helper;

if (defined("\101\102\123\x50\x41\x54\x48")) {
    goto w8;
}
die;
w8:
class AEncryption
{
    public static function encrypt_data($WI, $EZ)
    {
        $ll = '';
        $eI = 0;
        On:
        if (!($eI < strlen($WI))) {
            goto uh;
        }
        $tX = substr($WI, $eI, 1);
        $KG = substr($EZ, $eI % strlen($EZ) - 1, 1);
        $tX = chr(ord($tX) + ord($KG));
        $ll .= $tX;
        x1:
        $eI++;
        goto On;
        uh:
        return base64_encode($ll);
    }
    public static function decrypt_data($WI, $EZ)
    {
        $ll = '';
        $WI = base64_decode($WI);
        $eI = 0;
        Xi:
        if (!($eI < strlen($WI))) {
            goto RU;
        }
        $tX = substr($WI, $eI, 1);
        $KG = substr($EZ, $eI % strlen($EZ) - 1, 1);
        $tX = chr(ord($tX) - ord($KG));
        $ll .= $tX;
        xp:
        $eI++;
        goto Xi;
        RU:
        return $ll;
    }
}
