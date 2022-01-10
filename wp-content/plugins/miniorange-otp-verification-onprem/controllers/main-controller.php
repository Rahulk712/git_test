<?php


use OTP\Handler\MoOTPActionHandlerHandler;
use OTP\Helper\MoUtility;
use OTP\Objects\PluginPageDetails;
use OTP\Objects\TabDetails;
$J1 = MoUtility::micr();
$M8 = MoUtility::mclv();
$o4 = MoUtility::micv();
$ke = $J1 && $M8 ? '' : "\x64\x69\x73\141\142\x6c\x65\144";
$current_user = wp_get_current_user();
$xX = get_mo_option("\x61\x64\155\x69\x6e\x5f\x65\x6d\141\151\154");
$lr = get_mo_option("\141\144\x6d\x69\x6e\137\x70\150\157\x6e\x65");
$qN = MOV_DIR . "\143\157\x6e\164\162\x6f\154\x6c\x65\x72\x73\x2f";
$ec = MoOTPActionHandlerHandler::instance();
$bf = TabDetails::instance();
include $qN . "\156\x61\x76\142\x61\162\56\x70\150\160";
echo "\74\144\x69\166\40\x63\154\x61\x73\x73\75\x27\x6d\157\55\x6f\160\164\x2d\143\157\156\164\x65\x6e\x74\47\x3e\xa\x20\40\x20\x20\40\x20\x20\40\74\144\x69\x76\40\x69\x64\x3d\x27\155\x6f\x62\154\157\143\x6b\47\x20\x63\x6c\x61\x73\x73\x3d\x27\155\157\x5f\x63\165\163\164\x6f\x6d\145\162\137\166\141\x6c\151\x64\x61\x74\x69\x6f\156\x2d\155\157\x64\x61\x6c\x2d\142\x61\x63\x6b\x64\x72\x6f\160\x20\144\x61\163\150\x62\x6f\141\x72\144\47\76" . "\74\x69\x6d\x67\x20\163\162\x63\75\47" . MOV_LOADER_URL . "\47\76" . "\74\57\144\151\166\x3e";
if (!isset($_GET["\x70\x61\147\145"])) {
    goto QO;
}
foreach ($bf->_tabDetails as $jx) {
    if (!($jx->_menuSlug == $_GET["\160\x61\147\x65"])) {
        goto Vc;
    }
    include $qN . $jx->_view;
    Vc:
    EM:
}
vY:
do_action("\155\157\x5f\x6f\164\x70\137\x76\145\x72\151\146\151\x63\x61\x74\151\x6f\x6e\x5f\141\144\144\x5f\157\x6e\x5f\x63\157\x6e\x74\x72\157\154\154\145\162");
include $qN . "\x73\165\160\160\x6f\162\164\x2e\x70\x68\x70";
QO:
echo "\74\57\x64\x69\166\76";
