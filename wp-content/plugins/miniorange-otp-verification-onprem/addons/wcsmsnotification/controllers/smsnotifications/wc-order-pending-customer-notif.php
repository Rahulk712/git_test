<?php


use OTP\Helper\MoUtility;
$Z6 = remove_query_arg(array("\x73\155\163"), $_SERVER["\x52\x45\121\125\x45\123\x54\137\125\122\111"]);
$zi = $Ka->getWcOrderPendingNotif();
$PR = $zi->page . "\137\x65\x6e\x61\x62\x6c\x65";
$Vb = $zi->page . "\x5f\x73\155\163\142\157\x64\171";
$FP = $zi->page . "\137\162\x65\143\x69\160\x69\145\156\x74";
$EB = $zi->page . "\137\163\x65\x74\x74\151\156\x67\163";
if (!MoUtility::areFormOptionsBeingSaved($EB)) {
    goto g2;
}
$lB = array_key_exists($PR, $_POST) ? TRUE : FALSE;
$FP = serialize(explode("\x3b", $_POST[$FP]));
$l9 = MoUtility::isBlank($_POST[$Vb]) ? $zi->defaultSmsBody : $_POST[$Vb];
$Ka->getWcOrderPendingNotif()->setIsEnabled($lB);
$Ka->getWcOrderPendingNotif()->setRecipient($FP);
$Ka->getWcOrderPendingNotif()->setSmsBody($l9);
update_wc_option("\156\x6f\164\151\x66\151\143\141\164\x69\x6f\156\137\x73\x65\x74\x74\x69\x6e\x67\x73", $Ka);
$zi = $Ka->getWcOrderPendingNotif();
g2:
$GB = $zi->recipient;
$Yh = $zi->isEnabled ? "\143\x68\145\143\153\x65\x64" : '';
include MSN_DIR . "\57\x76\151\145\x77\x73\57\x73\155\x73\x6e\x6f\164\151\x66\151\143\x61\x74\151\x6f\x6e\163\x2f\167\143\55\x63\165\163\x74\157\155\145\162\x2d\x73\x6d\x73\55\x74\x65\155\160\x6c\141\x74\x65\x2e\x70\150\x70";
