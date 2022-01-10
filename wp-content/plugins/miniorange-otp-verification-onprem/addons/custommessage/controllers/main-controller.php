<?php


use OTP\Addons\CustomMessage\Handler\CustomMessages;
$Sw = CustomMessages::instance();
$A0 = $Sw->moAddOnV();
$ke = !$A0 ? "\144\151\x73\141\x62\154\145\x64" : '';
$current_user = wp_get_current_user();
$qN = MCM_DIR . "\143\157\x6e\x74\162\157\x6c\x6c\x65\x72\x73\x2f";
$sk = add_query_arg(array("\160\x61\147\145" => "\141\x64\x64\157\156"), remove_query_arg("\x61\x64\144\x6f\156", $_SERVER["\122\105\121\x55\x45\123\124\137\125\122\111"]));
if (!isset($_GET["\141\x64\144\157\156"])) {
    goto d3;
}
switch ($_GET["\x61\x64\x64\x6f\156"]) {
    case "\143\x75\x73\164\x6f\155":
        include $qN . "\143\x75\163\164\157\x6d\x2e\x70\x68\160";
        goto iY;
}
KI:
iY:
d3:
