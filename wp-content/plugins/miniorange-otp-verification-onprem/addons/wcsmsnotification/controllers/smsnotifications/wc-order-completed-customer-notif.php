<?php


use OTP\Helper\MoUtility;
$Z6 = remove_query_arg(array("\163\x6d\x73"), $_SERVER["\122\x45\x51\125\105\x53\x54\x5f\125\122\111"]);
$zi = $Ka->getWcOrderCompletedNotif();
$PR = $zi->page . "\x5f\145\156\141\x62\x6c\x65";
$Vb = $zi->page . "\x5f\x73\x6d\x73\142\157\x64\x79";
$FP = $zi->page . "\137\162\145\x63\151\160\151\145\156\x74";
$EB = $zi->page . "\x5f\163\x65\x74\164\151\156\147\163";
if (!MoUtility::areFormOptionsBeingSaved($EB)) {
    goto SX;
}
$lB = array_key_exists($PR, $_POST) ? TRUE : FALSE;
$FP = serialize(explode("\73", $_POST[$FP]));
$l9 = MoUtility::isBlank($_POST[$Vb]) ? $zi->defaultSmsBody : $_POST[$Vb];
$Ka->getWcOrderCompletedNotif()->setIsEnabled($lB);
$Ka->getWcOrderCompletedNotif()->setRecipient($FP);
$Ka->getWcOrderCompletedNotif()->setSmsBody($l9);
update_wc_option("\x6e\x6f\164\151\x66\151\143\141\x74\151\157\x6e\x5f\x73\145\x74\164\151\x6e\147\163", $Ka);
$zi = $Ka->getWcOrderCompletedNotif();
SX:
$GB = $zi->recipient;
$Yh = $zi->isEnabled ? "\143\x68\x65\143\153\145\144" : '';
include MSN_DIR . "\57\166\151\x65\167\x73\x2f\163\155\x73\x6e\x6f\164\151\x66\x69\143\x61\x74\151\x6f\x6e\x73\57\167\143\55\143\x75\x73\x74\x6f\155\145\162\55\x73\155\163\55\x74\145\x6d\160\x6c\x61\x74\x65\56\x70\150\x70";
