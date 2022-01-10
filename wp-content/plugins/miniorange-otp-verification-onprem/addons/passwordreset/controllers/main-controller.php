<?php


use OTP\Addons\PasswordReset\Handler\UMPasswordResetAddOnHandler;
$Sw = UMPasswordResetAddOnHandler::instance();
$J1 = $Sw->moAddOnV();
$ke = !$J1 ? "\x64\151\163\x61\x62\x6c\145\144" : '';
$current_user = wp_get_current_user();
$qN = UMPR_DIR . "\x63\157\156\164\162\157\x6c\154\145\162\163\x2f";
$sk = add_query_arg(array("\160\141\x67\145" => "\x61\x64\x64\x6f\156"), remove_query_arg("\141\x64\x64\157\156", $_SERVER["\x52\x45\x51\x55\105\123\x54\137\125\x52\111"]));
if (!isset($_GET["\x61\x64\144\x6f\x6e"])) {
    goto aq;
}
switch ($_GET["\141\144\144\x6f\x6e"]) {
    case "\165\155\160\162\x5f\x6e\157\164\151\x66":
        include $qN . "\x55\x4d\120\141\x73\163\167\x6f\x72\144\x52\145\x73\x65\x74\x2e\x70\150\x70";
        goto fT;
}
g_:
fT:
aq:
