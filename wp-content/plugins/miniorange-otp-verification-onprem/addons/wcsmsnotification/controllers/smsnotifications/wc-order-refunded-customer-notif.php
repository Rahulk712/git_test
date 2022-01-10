<?php


use OTP\Helper\MoUtility;
$Z6 = remove_query_arg(array("\x73\155\163"), $_SERVER["\122\105\x51\x55\105\x53\124\137\x55\122\111"]);
$zi = $Ka->getWcOrderRefundedNotif();
$PR = $zi->page . "\137\145\x6e\x61\x62\x6c\145";
$Vb = $zi->page . "\137\x73\x6d\163\x62\x6f\144\171";
$FP = $zi->page . "\137\x72\145\143\x69\160\x69\145\156\x74";
$EB = $zi->page . "\137\163\145\164\164\x69\x6e\x67\163";
if (!MoUtility::areFormOptionsBeingSaved($EB)) {
    goto Ij;
}
$lB = array_key_exists($PR, $_POST) ? TRUE : FALSE;
$FP = serialize(explode("\x3b", $_POST[$FP]));
$l9 = MoUtility::isBlank($_POST[$Vb]) ? $zi->defaultSmsBody : $_POST[$Vb];
$Ka->getWcOrderRefundedNotif()->setIsEnabled($lB);
$Ka->getWcOrderRefundedNotif()->setRecipient($FP);
$Ka->getWcOrderRefundedNotif()->setSmsBody($l9);
update_wc_option("\156\x6f\x74\151\x66\151\143\x61\164\x69\x6f\x6e\x5f\x73\x65\x74\164\x69\156\x67\163", $Ka);
$zi = $Ka->getWcOrderRefundedNotif();
Ij:
$GB = $zi->recipient;
$Yh = $zi->isEnabled ? "\143\150\x65\143\x6b\145\x64" : '';
include MSN_DIR . "\x2f\166\x69\x65\167\x73\57\163\x6d\x73\156\157\x74\151\x66\x69\x63\141\x74\151\x6f\156\163\57\167\x63\x2d\143\165\163\x74\x6f\x6d\x65\162\x2d\x73\x6d\x73\x2d\x74\x65\x6d\160\x6c\141\x74\x65\x2e\160\150\x70";
