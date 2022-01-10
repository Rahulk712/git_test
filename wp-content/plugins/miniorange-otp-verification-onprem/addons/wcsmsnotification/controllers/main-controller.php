<?php


use OTP\Addons\WcSMSNotification\Handler\WooCommerceNotifications;
$A0 = WooCommerceNotifications::instance()->moAddOnV();
$ke = !$A0 ? "\x64\151\x73\141\142\154\145\x64" : '';
$current_user = wp_get_current_user();
$qN = MSN_DIR . "\143\x6f\156\164\162\x6f\x6c\x6c\145\x72\x73\57";
$sk = add_query_arg(array("\160\x61\147\x65" => "\141\144\x64\x6f\156"), remove_query_arg("\x61\x64\x64\157\156", $_SERVER["\122\x45\x51\x55\105\123\x54\x5f\x55\122\111"]));
if (!isset($_GET["\x61\144\x64\157\x6e"])) {
    goto EO;
}
switch ($_GET["\x61\144\x64\157\156"]) {
    case "\167\x6f\x6f\x63\x6f\x6d\155\145\162\143\x65\x5f\x6e\157\164\x69\x66":
        include $qN . "\x77\x63\x2d\x73\x6d\x73\x2d\x6e\x6f\x74\x69\146\x69\143\x61\x74\151\157\x6e\x2e\160\x68\160";
        goto aA;
}
so:
aA:
EO:
