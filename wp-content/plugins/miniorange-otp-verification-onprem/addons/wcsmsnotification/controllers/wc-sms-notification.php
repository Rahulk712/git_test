<?php


use OTP\Addons\WcSMSNotification\Helper\MoWcAddOnMessages;
use OTP\Addons\WcSMSNotification\Helper\WooCommerceNotificationsList;
use OTP\Helper\MoUtility;
$Ka = get_wc_option("\x6e\x6f\x74\x69\x66\x69\x63\x61\164\x69\157\156\x5f\163\x65\x74\164\151\156\x67\163");
$Ka = $Ka ? maybe_unserialize($Ka) : WooCommerceNotificationsList::instance();
$l9 = '';
if (isset($_GET["\x73\x6d\163"])) {
    goto FT;
}
include MSN_DIR . "\57\166\x69\x65\x77\163\57\x77\x63\55\x73\x6d\163\55\156\157\164\151\x66\151\143\141\164\x69\157\156\x2e\160\x68\x70";
goto ik;
FT:
$l9 = $_GET["\x73\x6d\163"];
$Oz = $qN . "\57\x73\x6d\x73\x6e\x6f\164\151\146\151\143\x61\164\x69\x6f\156\x73\57";
switch ($_GET["\x73\155\x73"]) {
    case "\x77\143\137\x6e\x65\x77\137\x63\x75\x73\164\x6f\155\145\x72\x5f\156\x6f\x74\x69\x66":
        include $Oz . "\167\143\55\x6e\145\x77\x2d\143\165\163\164\157\155\x65\162\55\156\x6f\164\151\146\56\160\150\160";
        goto V2;
    case "\167\x63\137\x63\x75\x73\164\x6f\155\145\x72\x5f\156\157\x74\x65\137\156\x6f\x74\151\x66":
        include $Oz . "\167\x63\55\x63\x75\163\164\x6f\155\145\x72\55\x6e\157\164\x65\x2d\156\157\x74\x69\x66\56\160\x68\x70";
        goto V2;
    case "\x77\143\x5f\x6f\x72\x64\145\x72\x5f\143\141\156\143\x65\154\x6c\x65\144\x5f\156\x6f\164\x69\x66":
        include $Oz . "\167\x63\55\157\162\x64\x65\162\55\x63\x61\156\x63\145\x6c\154\x65\x64\x2d\x63\x75\x73\x74\157\155\x65\162\x2d\156\157\x74\x69\146\x2e\x70\150\160";
        goto V2;
    case "\167\143\x5f\x6f\x72\x64\145\x72\x5f\143\x6f\155\160\x6c\x65\164\x65\144\x5f\156\157\x74\x69\146":
        include $Oz . "\167\143\55\157\162\144\145\x72\55\143\157\x6d\160\154\x65\164\x65\x64\x2d\x63\x75\163\x74\157\x6d\x65\x72\x2d\156\157\x74\x69\146\56\160\150\160";
        goto V2;
    case "\x77\143\x5f\157\162\x64\x65\x72\137\x66\x61\151\154\145\x64\137\156\x6f\164\x69\x66":
        include $Oz . "\x77\x63\55\157\x72\x64\x65\162\55\146\x61\151\154\145\144\55\143\165\163\x74\157\x6d\145\x72\x2d\x6e\157\164\151\x66\56\x70\x68\160";
        goto V2;
    case "\x77\143\x5f\157\162\144\145\162\x5f\x6f\156\x5f\150\x6f\x6c\144\x5f\156\157\x74\151\x66":
        include $Oz . "\x77\x63\55\x6f\x72\144\145\x72\55\157\x6e\150\157\154\x64\55\x63\x75\x73\x74\x6f\x6d\x65\162\x2d\x6e\x6f\x74\151\146\56\160\150\160";
        goto V2;
    case "\167\143\x5f\157\x72\144\x65\x72\x5f\x70\162\x6f\x63\x65\x73\163\151\x6e\147\137\x6e\157\x74\151\x66":
        include $Oz . "\167\143\x2d\157\162\144\145\x72\x2d\x70\162\157\x63\x65\163\x73\x69\156\147\x2d\143\x75\x73\164\x6f\x6d\145\162\x2d\x6e\x6f\164\151\x66\56\x70\x68\160";
        goto V2;
    case "\x77\x63\137\157\x72\144\x65\x72\x5f\162\x65\146\x75\x6e\x64\x65\144\137\156\x6f\x74\151\x66":
        include $Oz . "\x77\143\x2d\x6f\x72\144\x65\x72\55\x72\145\146\x75\156\144\145\x64\55\143\165\163\164\x6f\x6d\145\162\55\x6e\x6f\x74\151\x66\x2e\x70\x68\x70";
        goto V2;
    case "\x77\x63\x5f\141\x64\x6d\x69\x6e\x5f\x6f\x72\144\x65\x72\137\163\x74\x61\x74\165\163\x5f\156\157\164\151\146":
        include $Oz . "\x77\x63\x2d\x6f\162\144\145\x72\55\x73\164\x61\x74\165\x73\x2d\x61\x64\155\151\156\x2d\156\157\164\x69\146\56\x70\150\x70";
        goto V2;
    case "\167\x63\137\157\162\144\x65\162\137\160\145\156\x64\151\156\147\x5f\x6e\157\x74\x69\x66":
        include $Oz . "\167\x63\55\x6f\162\144\x65\x72\55\160\145\x6e\x64\151\156\x67\55\143\x75\163\164\157\155\x65\162\x2d\156\x6f\164\151\x66\56\160\x68\160";
        goto V2;
}
iw:
V2:
ik:
function show_notifications_table(WooCommerceNotificationsList $br)
{
    foreach ($br as $hD => $F2) {
        $px = add_query_arg(array("\163\x6d\163" => $F2->page), $_SERVER["\122\105\121\125\x45\x53\124\137\x55\x52\111"]);
        echo "\11\74\x74\162\x3e\15\12\40\x20\x20\40\40\40\x20\x20\x20\40\40\40\x20\x20\x20\x20\40\x20\40\x20\74\x74\144\40\x63\154\141\x73\x73\x3d\42\155\163\156\55\164\141\142\154\x65\x2d\154\x69\x73\164\x2d\x73\x74\141\164\165\x73\42\x3e\xd\xa\40\40\40\x20\40\40\40\x20\40\40\40\x20\x20\x20\x20\40\40\40\40\x20\x20\x20\x20\x20\74\163\x70\141\x6e\x20\x63\154\141\x73\x73\75\x22" . ($F2->isEnabled ? "\163\x74\x61\x74\165\x73\55\x65\x6e\141\142\x6c\145\x64" : '') . "\42\76\x3c\x2f\163\x70\141\x6e\76\15\12\x20\40\40\40\x20\40\x20\40\40\x20\x20\x20\40\x20\x20\x20\x20\40\40\40\74\x2f\164\x64\76\xd\xa\x20\40\40\x20\40\40\x20\40\40\x20\x20\x20\40\x20\x20\40\40\x20\x20\40\x3c\x74\144\40\x63\154\141\x73\163\x3d\42\155\163\x6e\x2d\164\141\142\x6c\145\55\154\151\x73\164\55\156\x61\x6d\145\x22\76\15\12\40\40\x20\x20\40\40\40\40\x20\x20\40\40\40\40\x20\40\x20\40\40\40\x20\40\40\x20\x3c\141\40\x68\x72\x65\146\x3d\x22" . $px . "\x22\x3e" . $F2->title . "\x3c\57\141\x3e";
        mo_draw_tooltip(MoWcAddOnMessages::showMessage($F2->tooltipHeader), MoWcAddOnMessages::showMessage($F2->tooltipBody));
        echo "\11\11\x3c\x2f\164\x64\76\xd\xa\x20\40\40\x20\40\40\x20\40\40\x20\40\x20\x20\x20\40\x20\40\x20\40\x20\74\164\144\x20\143\154\141\163\163\x3d\42\x6d\163\156\x2d\x74\141\142\x6c\145\x2d\154\x69\x73\x74\x2d\x72\145\x63\151\x70\151\x65\x6e\x74\42\40\x73\x74\x79\154\145\x3d\42\167\x6f\162\144\55\167\x72\141\160\72\40\142\x72\145\x61\x6b\55\167\157\x72\x64\73\x22\x3e\xd\12\40\40\x20\x20\40\x20\40\x20\x20\x20\x20\x20\x20\x20\40\x20\40\40\x20\40\x20\x20\x20\40" . $F2->notificationType . "\xd\xa\40\x20\x20\x20\40\40\x20\40\x20\40\40\x20\40\40\40\40\40\40\x20\40\x3c\x2f\164\144\x3e\xd\xa\40\x20\40\40\x20\40\x20\x20\x20\40\x20\x20\x20\40\x20\40\x20\x20\x20\x20\x3c\x74\144\x20\x63\154\141\x73\x73\75\42\155\x73\156\x2d\x74\x61\142\x6c\x65\55\x6c\151\x73\x74\x2d\163\x74\141\x74\x75\x73\55\x61\143\164\x69\x6f\156\x73\42\76\xd\xa\40\x20\x20\40\40\x20\40\40\x20\x20\40\40\40\40\x20\x20\x20\40\x20\40\40\40\x20\40\x3c\x61\x20\143\154\x61\x73\163\x3d\x22\x62\165\x74\164\157\156\x20\x61\154\x69\147\x6e\x72\151\147\150\164\x20\x74\x69\160\163\x22\x20\x68\x72\x65\146\75\42" . $px . "\42\76\103\157\x6e\146\151\x67\165\x72\145\74\x2f\141\76\15\xa\x20\x20\40\40\x20\40\x20\40\40\x20\40\40\x20\40\40\x20\x20\40\x20\x20\74\57\x74\x64\76\15\xa\40\40\40\x20\x20\40\40\x20\40\40\40\x20\40\x20\40\40\74\57\164\162\x3e";
        js:
    }
    Aw:
}
