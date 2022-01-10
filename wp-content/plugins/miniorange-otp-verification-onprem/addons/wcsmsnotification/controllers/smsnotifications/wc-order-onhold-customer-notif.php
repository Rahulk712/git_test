<?php


use OTP\Helper\MoUtility;
$Z6 = remove_query_arg(array("\163\x6d\x73"), $_SERVER["\x52\x45\121\125\x45\x53\x54\x5f\x55\122\111"]);
$zi = $Ka->getWcOrderOnHoldNotif();
$PR = $zi->page . "\x5f\x65\x6e\x61\x62\154\145";
$Vb = $zi->page . "\137\x73\x6d\x73\142\157\x64\171";
$FP = $zi->page . "\137\162\x65\x63\151\x70\151\145\156\164";
$EB = $zi->page . "\137\163\145\x74\164\x69\x6e\x67\163";
if (!MoUtility::areFormOptionsBeingSaved($EB)) {
    goto BN;
}
$lB = array_key_exists($PR, $_POST) ? TRUE : FALSE;
$FP = serialize(explode("\73", $_POST[$FP]));
$l9 = MoUtility::isBlank($_POST[$Vb]) ? $zi->defaultSmsBody : $_POST[$Vb];
$Ka->getWcOrderOnHoldNotif()->setIsEnabled($lB);
$Ka->getWcOrderOnHoldNotif()->setRecipient($FP);
$Ka->getWcOrderOnHoldNotif()->setSmsBody($l9);
update_wc_option("\156\157\164\x69\x66\151\x63\141\164\151\x6f\156\x5f\x73\x65\x74\164\151\x6e\147\x73", $Ka);
$zi = $Ka->getWcOrderOnHoldNotif();
BN:
$GB = $zi->recipient;
$Yh = $zi->isEnabled ? "\143\150\x65\x63\x6b\145\x64" : '';
include MSN_DIR . "\x2f\166\151\145\x77\163\x2f\x73\x6d\163\156\157\164\x69\146\151\143\x61\x74\151\157\156\163\57\x77\143\x2d\x63\x75\163\164\157\155\145\162\x2d\163\x6d\163\55\x74\x65\155\x70\154\x61\x74\x65\x2e\x70\x68\x70";
