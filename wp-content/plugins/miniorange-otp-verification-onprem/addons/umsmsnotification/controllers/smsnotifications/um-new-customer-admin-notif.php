<?php


use OTP\Helper\MoUtility;
$Z6 = remove_query_arg(array("\x73\155\163"), $_SERVER["\122\105\x51\125\x45\123\124\x5f\x55\x52\111"]);
$zi = $Ka->getUmNewUserAdminNotif();
$PR = $zi->page . "\x5f\145\x6e\x61\142\x6c\145";
$Vb = $zi->page . "\137\163\155\163\142\x6f\x64\171";
$FP = $zi->page . "\x5f\162\145\x63\x69\160\x69\x65\x6e\x74";
$EB = $zi->page . "\137\163\x65\x74\x74\151\x6e\147\163";
if (!MoUtility::areFormOptionsBeingSaved($EB)) {
    goto Ah;
}
$lB = array_key_exists($PR, $_POST) ? TRUE : FALSE;
$GB = serialize(explode("\x3b", $_POST[$FP]));
$l9 = MoUtility::isBlank($_POST[$Vb]) ? $zi->defaultSmsBody : $_POST[$Vb];
$Ka->getUmNewUserAdminNotif()->setIsEnabled($lB);
$Ka->getUmNewUserAdminNotif()->setRecipient($GB);
$Ka->getUmNewUserAdminNotif()->setSmsBody($l9);
update_umsn_option("\x6e\x6f\164\x69\x66\151\x63\x61\x74\151\157\x6e\x5f\x73\145\164\x74\151\156\147\x73", $Ka);
$zi = $Ka->getUmNewUserAdminNotif();
Ah:
$GB = maybe_unserialize($zi->recipient);
$GB = is_array($GB) ? implode("\73", $GB) : $GB;
$Yh = $zi->isEnabled ? "\143\150\x65\143\153\145\144" : '';
include UMSN_DIR . "\x2f\166\151\x65\167\163\x2f\163\155\x73\x6e\157\x74\x69\x66\x69\x63\x61\164\x69\157\x6e\x73\57\x75\x6d\x2d\x61\x64\x6d\x69\156\55\163\x6d\163\55\164\145\155\x70\x6c\141\x74\x65\56\160\x68\160";
