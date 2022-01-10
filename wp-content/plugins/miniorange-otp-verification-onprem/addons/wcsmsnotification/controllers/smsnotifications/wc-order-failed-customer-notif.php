<?php


use OTP\Helper\MoUtility;
$Z6 = remove_query_arg(array("\163\155\163"), $_SERVER["\x52\x45\x51\x55\105\x53\124\x5f\125\x52\111"]);
$zi = $Ka->getWcOrderFailedNotif();
$PR = $zi->page . "\x5f\x65\156\141\142\154\x65";
$Vb = $zi->page . "\x5f\x73\155\163\x62\x6f\x64\x79";
$FP = $zi->page . "\x5f\162\x65\143\x69\x70\151\145\x6e\164";
$EB = $zi->page . "\137\x73\x65\x74\x74\x69\x6e\x67\163";
if (!MoUtility::areFormOptionsBeingSaved($EB)) {
    goto IH;
}
$lB = array_key_exists($PR, $_POST) ? TRUE : FALSE;
$FP = serialize(explode("\x3b", $_POST[$FP]));
$l9 = MoUtility::isBlank($_POST[$Vb]) ? $zi->defaultSmsBody : $_POST[$Vb];
$Ka->getWcOrderFailedNotif()->setIsEnabled($lB);
$Ka->getWcOrderFailedNotif()->setRecipient($FP);
$Ka->getWcOrderFailedNotif()->setSmsBody($l9);
update_wc_option("\x6e\157\x74\151\x66\x69\143\x61\164\151\x6f\x6e\x5f\163\x65\164\x74\x69\156\147\163", $Ka);
$zi = $Ka->getWcOrderFailedNotif();
IH:
$GB = $zi->recipient;
$Yh = $zi->isEnabled ? "\x63\x68\x65\143\x6b\x65\144" : '';
include MSN_DIR . "\x2f\166\151\x65\167\x73\57\163\155\x73\156\x6f\164\151\146\x69\143\x61\164\x69\x6f\x6e\163\x2f\x77\143\x2d\143\165\x73\x74\x6f\155\x65\162\55\163\155\x73\55\x74\145\x6d\x70\x6c\141\164\x65\56\x70\150\160";
