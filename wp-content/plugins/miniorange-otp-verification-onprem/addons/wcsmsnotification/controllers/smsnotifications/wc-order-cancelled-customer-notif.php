<?php


use OTP\Helper\MoUtility;
$Z6 = remove_query_arg(array("\163\155\163"), $_SERVER["\x52\105\x51\x55\x45\123\x54\x5f\x55\122\x49"]);
$zi = $Ka->getWcOrderCancelledNotif();
$PR = $zi->page . "\x5f\145\156\141\142\154\145";
$Vb = $zi->page . "\137\163\x6d\x73\142\157\144\x79";
$FP = $zi->page . "\137\x72\x65\x63\x69\160\151\x65\x6e\x74";
$EB = $zi->page . "\x5f\x73\x65\164\x74\151\156\x67\x73";
if (!MoUtility::areFormOptionsBeingSaved($EB)) {
    goto tG;
}
$lB = array_key_exists($PR, $_POST) ? TRUE : FALSE;
$FP = serialize(explode("\73", $_POST[$FP]));
$l9 = MoUtility::isBlank($_POST[$Vb]) ? $zi->defaultSmsBody : $_POST[$Vb];
$Ka->getWcOrderCancelledNotif()->setIsEnabled($lB);
$Ka->getWcOrderCancelledNotif()->setRecipient($FP);
$Ka->getWcOrderCancelledNotif()->setSmsBody($l9);
update_wc_option("\156\157\164\x69\146\x69\143\141\164\x69\x6f\156\137\x73\145\x74\164\x69\156\x67\x73", $Ka);
$zi = $Ka->getWcOrderCancelledNotif();
tG:
$GB = $zi->recipient;
$Yh = $zi->isEnabled ? "\143\150\145\x63\153\145\x64" : '';
include MSN_DIR . "\x2f\166\151\145\x77\x73\57\163\155\163\156\157\164\x69\146\x69\143\x61\164\x69\x6f\156\x73\x2f\167\x63\x2d\x63\x75\x73\164\157\155\145\162\x2d\163\155\x73\55\x74\145\155\160\154\141\164\145\56\x70\x68\160";
