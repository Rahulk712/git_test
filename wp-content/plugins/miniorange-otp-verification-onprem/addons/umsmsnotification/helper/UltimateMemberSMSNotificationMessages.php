<?php


namespace OTP\Addons\UmSMSNotification\Helper;

use OTP\Helper\MoUtility;
use OTP\Objects\BaseMessages;
use OTP\Traits\Instance;
final class UltimateMemberSMSNotificationMessages extends BaseMessages
{
    use Instance;
    private function __construct()
    {
        define("\115\x4f\x5f\125\115\137\101\104\x44\117\x4e\x5f\x4d\x45\x53\123\101\107\x45\123", serialize(array(self::NEW_UM_CUSTOMER_NOTIF_HEADER => mo_("\x4e\x45\x57\x20\x41\x43\103\x4f\125\116\x54\40\116\x4f\124\111\x46\x49\x43\101\x54\111\x4f\x4e"), self::NEW_UM_CUSTOMER_NOTIF_BODY => mo_("\x43\165\x73\x74\157\155\x65\x72\163\40\141\x72\145\x20\x73\145\x6e\x74\x20\x61\x20\x6e\x65\167\40\x61\x63\x63\157\x75\156\164\40\123\115\123\40\x6e\157\x74\x69\x66\151\x63\141\164\151\x6f\x6e" . "\x20\x77\x68\145\x6e\x20\x74\x68\x65\x79\x20\163\151\147\156\x20\165\x70\x20\157\156\x20\x74\x68\x65\x20\x73\151\164\145\56"), self::NEW_UM_CUSTOMER_SMS => mo_("\x54\150\141\x6e\x6b\163\x20\x66\157\162\40\143\162\145\x61\164\x69\156\x67\x20\141\x6e\x20\x61\x63\143\x6f\x75\x6e\x74\40\157\156\x20\173\163\x69\164\x65\55\156\141\x6d\145\x7d\x2e" . "\x25\x30\141\131\x6f\165\x72\40\165\163\145\x72\x6e\x61\x6d\x65\x20\x69\163\x20\173\x75\x73\x65\x72\156\x61\x6d\145\x7d\x2e\x25\60\x61\114\x6f\x67\x69\x6e\x20\x48\x65\x72\x65\x3a\40" . "\173\141\x63\143\157\165\x6e\164\x70\x61\x67\x65\x2d\165\x72\x6c\175"), self::NEW_UM_CUSTOMER_ADMIN_NOTIF_BODY => mo_("\x41\x64\155\x69\x6e\x73\x20\x61\x72\x65\40\163\145\156\164\40\x61\40\x6e\145\x77\40\x61\143\x63\157\165\x6e\164\x20\123\x4d\x53\x20\x6e\157\x74\x69\x66\x69\x63\x61\164\x69\157\156\40\x77\x68\x65\156" . "\40\141\x20\165\163\145\162\40\163\x69\147\156\x73\x20\x75\160\x20\157\x6e\x20\x74\150\145\40\x73\151\164\145\56"), self::NEW_UM_CUSTOMER_ADMIN_SMS => mo_("\x4e\145\167\40\x55\163\145\x72\x20\x43\162\145\x61\164\x65\144\40\x6f\156\x20\173\163\151\x74\x65\x2d\156\x61\x6d\145\x7d\56\x25\60\141\125\x73\145\162\156\x61\x6d\x65\72\40" . "\173\x75\163\x65\162\156\141\x6d\x65\175\x2e\45\60\x61\120\x72\157\x66\x69\154\x65\40\x50\141\x67\x65\72\x20\x7b\x61\x63\x63\x6f\165\156\164\160\x61\x67\x65\55\x75\x72\154\175"))));
    }
    public static function showMessage($Qs, $Jf = array())
    {
        $xP = '';
        $Qs = explode("\40", $Qs);
        $rK = unserialize(MO_UM_ADDON_MESSAGES);
        $fR = unserialize(MO_MESSAGES);
        $rK = array_merge($rK, $fR);
        foreach ($Qs as $KI) {
            if (!MoUtility::isBlank($KI)) {
                goto LY;
            }
            return $xP;
            LY:
            $mk = $rK[$KI];
            foreach ($Jf as $xl => $sA) {
                $mk = str_replace("\x7b\173" . $xl . "\175\x7d", $sA, $mk);
                ll:
            }
            sd:
            $xP .= $mk;
            rf:
        }
        SZ:
        return $xP;
    }
}
