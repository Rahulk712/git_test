<?php


use OTP\Helper\MoUtility;
$Z6 = remove_query_arg(array("\x73\x6d\163"), $_SERVER["\122\105\x51\125\x45\123\124\137\x55\122\111"]);
$zi = $Ka->getWcCustomerNoteNotif();
$PR = $zi->page . "\x5f\x65\156\141\x62\154\x65";
$Vb = $zi->page . "\x5f\x73\x6d\x73\x62\x6f\x64\x79";
$FP = $zi->page . "\x5f\x72\145\x63\151\160\151\x65\x6e\164";
$EB = $zi->page . "\137\x73\145\x74\164\x69\x6e\147\x73";
if (!MoUtility::areFormOptionsBeingSaved($EB)) {
    goto oP;
}
$lB = array_key_exists($PR, $_POST) ? TRUE : FALSE;
$FP = serialize(explode("\73", $_POST[$FP]));
$l9 = MoUtility::isBlank($_POST[$Vb]) ? $zi->defaultSmsBody : $_POST[$Vb];
$Ka->getWcCustomerNoteNotif()->setIsEnabled($lB);
$Ka->getWcCustomerNoteNotif()->setRecipient($FP);
$Ka->getWcCustomerNoteNotif()->setSmsBody($l9);
update_wc_option("\156\157\x74\x69\146\x69\x63\141\x74\x69\157\156\137\x73\x65\164\164\x69\156\147\163", $Ka);
$zi = $Ka->getWcCustomerNoteNotif();
oP:
$GB = $zi->recipient;
$Yh = $zi->isEnabled ? "\143\x68\x65\143\153\145\144" : '';
include MSN_DIR . "\x2f\x76\x69\145\167\163\x2f\163\155\x73\156\x6f\x74\x69\x66\x69\x63\x61\x74\x69\157\x6e\x73\x2f\167\143\x2d\143\165\163\x74\157\155\x65\x72\x2d\163\x6d\x73\55\x74\145\x6d\x70\154\x61\164\x65\56\160\150\x70";
