<?php


use OTP\Helper\MoUtility;
$Z6 = remove_query_arg(array("\163\155\163"), $_SERVER["\x52\x45\x51\x55\105\123\x54\x5f\x55\122\111"]);
$zi = $Ka->getWcAdminOrderStatusNotif();
$PR = $zi->page . "\137\145\x6e\141\x62\x6c\x65";
$Vb = $zi->page . "\x5f\163\155\163\142\x6f\144\171";
$FP = $zi->page . "\137\x72\x65\143\x69\x70\x69\x65\x6e\x74";
$EB = $zi->page . "\x5f\163\145\x74\x74\x69\156\x67\163";
if (!MoUtility::areFormOptionsBeingSaved($EB)) {
    goto Qa;
}
$lB = array_key_exists($PR, $_POST) ? TRUE : FALSE;
$FP = serialize(explode("\73", $_POST[$FP]));
$l9 = MoUtility::isBlank($_POST[$Vb]) ? $zi->defaultSmsBody : $_POST[$Vb];
$Ka->getWcAdminOrderStatusNotif()->setIsEnabled($lB);
$Ka->getWcAdminOrderStatusNotif()->setRecipient($FP);
$Ka->getWcAdminOrderStatusNotif()->setSmsBody($l9);
update_wc_option("\x6e\157\x74\151\x66\151\143\x61\164\151\x6f\x6e\x5f\163\x65\164\x74\x69\x6e\x67\163", $Ka);
$zi = $Ka->getWcAdminOrderStatusNotif();
Qa:
$GB = maybe_unserialize($zi->recipient);
$GB = is_array($GB) ? implode("\73", $GB) : $GB;
$Yh = $zi->isEnabled ? "\143\150\145\143\x6b\x65\144" : '';
include MSN_DIR . "\57\x76\x69\x65\167\x73\57\x73\x6d\x73\x6e\157\164\151\146\151\x63\x61\164\151\x6f\x6e\x73\x2f\x77\x63\x2d\141\x64\155\151\156\55\163\155\x73\55\164\x65\x6d\x70\154\141\x74\145\x2e\x70\150\160";
