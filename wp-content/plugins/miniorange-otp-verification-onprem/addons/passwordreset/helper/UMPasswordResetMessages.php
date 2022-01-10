<?php


namespace OTP\Addons\PasswordReset\Helper;

use OTP\Helper\MoUtility;
use OTP\Objects\BaseMessages;
use OTP\Traits\Instance;
final class UMPasswordResetMessages extends BaseMessages
{
    use Instance;
    private function __construct()
    {
        define("\115\x4f\137\x55\115\120\122\137\x41\104\x44\117\116\x5f\x4d\105\x53\x53\101\x47\x45\123", serialize(array(self::USERNAME_MISMATCH => mo_("\125\x73\145\x72\156\x61\x6d\145\x20\164\x68\141\x74\x20\x74\150\145\x20\x4f\124\120\x20\x77\x61\163\x20\x73\145\156\x74\x20\x74\x6f\40\141\156\144\x20\164\x68\x65\40\x75\x73\145\162\x6e\x61\155\145\x20\163\165\x62\x6d\x69\x74\x74\x65\144\x20\144\x6f\x20\x6e\157\164\x20\x6d\141\164\143\x68"), self::USERNAME_NOT_EXIST => mo_("\127\x65\40\143\141\x6e\47\164\40\146\x69\x6e\144\40\141\x6e\x20\141\143\143\x6f\165\156\164\40\x72\x65\x67\151\163\x74\x65\x72\x65\144\40\167\151\x74\150\x20\164\x68\x61\x74\40\x61\144\144\x72\x65\163\x73\40\157\x72\40" . "\165\163\145\162\x6e\x61\x6d\x65\40\x6f\x72\x20\160\150\x6f\156\145\x20\156\x75\155\142\145\x72"), self::RESET_LABEL => mo_("\x54\157\40\162\145\163\x65\164\40\x79\157\165\162\40\x70\141\163\x73\x77\157\162\144\x2c\40\160\154\145\x61\163\x65\x20\145\x6e\x74\145\x72\40\x79\x6f\165\162\40\x65\x6d\x61\x69\154\40\x61\x64\x64\162\x65\163\x73\x2c\40\165\x73\145\x72\156\141\155\145\40\x6f\x72\x20\x70\150\x6f\156\145\x20\156\165\155\142\145\x72\40\142\145\154\x6f\x77"), self::RESET_LABEL_OP => mo_("\x54\157\x20\x72\145\x73\145\x74\x20\x79\x6f\x75\x72\x20\x70\141\x73\x73\x77\x6f\x72\144\54\x20\x70\154\x65\141\163\145\40\145\156\164\145\x72\x20\x79\x6f\165\x72\40\162\145\x67\x69\163\x74\x65\162\x65\x64\40\160\150\x6f\x6e\145\x20\x6e\x75\155\x62\x65\x72\x20\x62\x65\154\x6f\x77"))));
    }
    public static function showMessage($Qs, $Jf = array())
    {
        $xP = '';
        $Qs = explode("\x20", $Qs);
        $rK = unserialize(MO_UMPR_ADDON_MESSAGES);
        $fR = unserialize(MO_MESSAGES);
        $rK = array_merge($rK, $fR);
        foreach ($Qs as $KI) {
            if (!MoUtility::isBlank($KI)) {
                goto nd;
            }
            return $xP;
            nd:
            $mk = $rK[$KI];
            foreach ($Jf as $xl => $sA) {
                $mk = str_replace("\173\x7b" . $xl . "\x7d\175", $sA, $mk);
                Z6:
            }
            B3:
            $xP .= $mk;
            ZN:
        }
        hN:
        return $xP;
    }
}
