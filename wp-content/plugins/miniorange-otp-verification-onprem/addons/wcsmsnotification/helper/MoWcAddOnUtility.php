<?php


namespace OTP\Addons\WcSMSNotification\Helper;

use OTP\Helper\MoUtility;
use WC_Order;
use WP_User_Query;
class MoWcAddOnUtility
{
    public static function getAdminPhoneNumber()
    {
        $user = new WP_User_Query(array("\162\x6f\x6c\145" => "\x41\x64\x6d\x69\x6e\x69\163\164\x72\141\164\157\162", "\x73\145\141\x72\143\x68\x5f\x63\157\x6c\165\155\156\163" => array("\111\x44", "\x75\163\x65\162\137\x6c\157\x67\151\156")));
        return !empty($user->results[0]) ? get_user_meta($user->results[0]->ID, "\x62\x69\x6c\154\151\x6e\147\137\160\150\157\x6e\x65", true) : '';
    }
    public static function getCustomerNumberFromOrder($qy)
    {
        $d2 = $qy->get_user_id();
        $lr = $qy->get_billing_phone();
        return !empty($lr) ? $lr : get_user_meta($d2, "\142\151\154\x6c\x69\156\147\x5f\160\x68\x6f\x6e\x65", true);
    }
    public static function is_addon_activated()
    {
        MoUtility::is_addon_activated();
    }
}
