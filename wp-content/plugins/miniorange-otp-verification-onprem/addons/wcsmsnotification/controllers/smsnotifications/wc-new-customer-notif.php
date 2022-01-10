<?php


use OTP\Helper\MoUtility;
$Z6 = remove_query_arg(array("\163\x6d\163"), $_SERVER["\x52\x45\121\x55\105\123\124\x5f\x55\x52\x49"]);
$zi = $Ka->getWcNewCustomerNotif();
$PR = $zi->page . "\x5f\145\156\141\x62\154\x65";
$Vb = $zi->page . "\137\163\155\163\142\157\144\171";
$FP = $zi->page . "\137\162\x65\x63\151\160\151\x65\156\164";
$EB = $zi->page . "\x5f\x73\145\x74\x74\151\156\x67\x73";
if (!MoUtility::areFormOptionsBeingSaved($EB)) {
    goto yO;
}
$lB = array_key_exists($PR, $_POST) ? TRUE : FALSE;
$FP = serialize(explode("\x3b", $_POST[$FP]));
$l9 = MoUtility::isBlank($_POST[$Vb]) ? $zi->defaultSmsBody : $_POST[$Vb];
$Ka->getWcNewCustomerNotif()->setIsEnabled($lB);
$Ka->getWcNewCustomerNotif()->setRecipient($FP);
$Ka->getWcNewCustomerNotif()->setSmsBody($l9);
update_wc_option("\x6e\x6f\164\x69\146\151\x63\141\164\x69\157\156\137\x73\145\164\164\151\x6e\x67\163", $Ka);
$zi = $Ka->getWcNewCustomerNotif();
yO:
$GB = $zi->recipient;
$Yh = $zi->isEnabled ? "\143\x68\145\x63\153\145\144" : '';
include MSN_DIR . "\x2f\x76\x69\145\x77\x73\57\163\155\163\x6e\x6f\164\151\x66\x69\x63\141\164\151\x6f\156\x73\x2f\x77\143\x2d\143\165\163\164\x6f\x6d\x65\x72\x2d\163\155\163\55\164\145\155\x70\x6c\141\164\x65\56\160\x68\x70";
