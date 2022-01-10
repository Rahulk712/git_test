<?php


use OTP\Helper\MoUtility;
$Z6 = remove_query_arg(array("\x73\x6d\163"), $_SERVER["\122\x45\x51\x55\x45\x53\x54\x5f\125\122\111"]);
$zi = $Ka->getUmNewCustomerNotif();
$PR = $zi->page . "\x5f\x65\x6e\x61\x62\x6c\145";
$Vb = $zi->page . "\x5f\163\x6d\163\142\x6f\x64\x79";
$FP = $zi->page . "\x5f\162\x65\143\151\x70\151\x65\156\164";
$EB = $zi->page . "\137\163\x65\164\x74\x69\156\147\x73";
if (!MoUtility::areFormOptionsBeingSaved($EB)) {
    goto wJ;
}
$lB = array_key_exists($PR, $_POST) ? TRUE : FALSE;
$GB = $_POST[$FP];
$l9 = MoUtility::isBlank($_POST[$Vb]) ? $zi->defaultSmsBody : $_POST[$Vb];
$Ka->getUmNewCustomerNotif()->setIsEnabled($lB);
$Ka->getUmNewCustomerNotif()->setRecipient($GB);
$Ka->getUmNewCustomerNotif()->setSmsBody($l9);
update_umsn_option("\x6e\157\164\x69\146\x69\143\x61\164\x69\157\x6e\137\163\x65\164\164\x69\156\147\x73", $Ka);
$zi = $Ka->getUmNewCustomerNotif();
wJ:
$GB = maybe_unserialize($zi->recipient);
$GB = MoUtility::isBlank($GB) ? "\x6d\157\142\151\154\145\x5f\x6e\x75\x6d\x62\145\162" : $GB;
$Yh = $zi->isEnabled ? "\x63\150\x65\143\153\145\x64" : '';
include UMSN_DIR . "\x2f\x76\x69\145\167\163\x2f\x73\155\163\156\157\x74\151\x66\x69\x63\x61\x74\x69\157\x6e\x73\x2f\x75\x6d\55\x63\x75\x73\x74\x6f\x6d\x65\x72\55\x73\x6d\163\55\164\x65\x6d\160\x6c\141\x74\145\x2e\160\150\x70";
