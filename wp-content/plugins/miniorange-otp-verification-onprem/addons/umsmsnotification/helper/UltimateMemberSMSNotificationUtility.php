<?php


namespace OTP\Addons\UmSMSNotification\Helper;

use OTP\Helper\MoUtility;
use WP_User_Query;
class UltimateMemberSMSNotificationUtility
{
    public static function getAdminPhoneNumber()
    {
        $user = new WP_User_Query(array("\162\157\x6c\145" => "\101\x64\x6d\x69\x6e\x69\x73\x74\162\141\164\157\162", "\163\145\141\x72\143\x68\x5f\143\157\x6c\x75\155\156\x73" => array("\x49\x44", "\x75\x73\x65\162\137\x6c\157\147\151\x6e")));
        return !empty($user->results[0]) ? array(get_user_meta($user->results[0]->ID, "\x6d\157\142\151\x6c\x65\137\x6e\165\155\x62\145\162", true)) : '';
    }
    public static function is_addon_activated()
    {
        MoUtility::is_addon_activated();
    }
}
