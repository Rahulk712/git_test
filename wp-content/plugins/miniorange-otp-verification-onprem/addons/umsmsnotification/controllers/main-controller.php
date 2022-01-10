<?php


use OTP\Addons\UmSMSNotification\Handler\UltimateMemberSMSNotificationsHandler;
$Sw = UltimateMemberSMSNotificationsHandler::instance();
$A0 = $Sw->moAddOnV();
$ke = !$A0 ? "\144\x69\x73\141\142\154\x65\x64" : '';
$current_user = wp_get_current_user();
$qN = UMSN_DIR . "\x63\x6f\156\164\x72\x6f\x6c\x6c\145\162\163\57";
$sk = add_query_arg(array("\160\x61\147\145" => "\141\144\x64\157\156"), remove_query_arg("\141\x64\x64\157\x6e", $_SERVER["\x52\105\121\125\105\123\124\137\x55\x52\x49"]));
if (!isset($_GET["\141\x64\144\x6f\x6e"])) {
    goto hv;
}
switch ($_GET["\141\x64\144\157\x6e"]) {
    case "\x75\x6d\137\x6e\x6f\164\151\x66":
        include $qN . "\165\155\55\163\155\x73\55\156\x6f\164\x69\146\151\x63\x61\x74\151\x6f\x6e\56\x70\150\160";
        goto Kv;
}
Mh:
Kv:
hv:
