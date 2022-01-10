<?php


use OTP\Helper\MoUtility;
$Z6 = remove_query_arg(array("\163\x6d\163"), $_SERVER["\122\x45\121\125\x45\123\x54\137\125\x52\x49"]);
$zi = $Ka->getWcOrderProcessingNotif();
$PR = $zi->page . "\137\145\x6e\141\x62\x6c\x65";
$Vb = $zi->page . "\137\163\x6d\x73\x62\157\144\x79";
$FP = $zi->page . "\137\162\145\143\x69\x70\x69\x65\x6e\x74";
$EB = $zi->page . "\x5f\163\145\x74\164\151\x6e\x67\163";
if (!MoUtility::areFormOptionsBeingSaved($EB)) {
    goto mN;
}
$lB = array_key_exists($PR, $_POST) ? TRUE : FALSE;
$FP = serialize(explode("\x3b", $_POST[$FP]));
$l9 = MoUtility::isBlank($_POST[$Vb]) ? $zi->defaultSmsBody : $_POST[$Vb];
$Ka->getWcOrderProcessingNotif()->setIsEnabled($lB);
$Ka->getWcOrderProcessingNotif()->setRecipient($FP);
$Ka->getWcOrderProcessingNotif()->setSmsBody($l9);
update_wc_option("\156\157\164\151\146\x69\143\141\164\x69\157\156\x5f\163\x65\164\164\x69\x6e\147\163", $Ka);
$zi = $Ka->getWcOrderProcessingNotif();
mN:
$GB = $zi->recipient;
$Yh = $zi->isEnabled ? "\143\150\x65\x63\x6b\145\x64" : '';
include MSN_DIR . "\57\166\151\145\x77\x73\x2f\163\155\163\156\x6f\x74\x69\146\x69\x63\141\164\151\157\x6e\x73\x2f\167\143\55\143\165\163\x74\157\x6d\x65\162\55\163\155\x73\x2d\164\x65\x6d\x70\154\x61\164\x65\x2e\160\x68\160";
