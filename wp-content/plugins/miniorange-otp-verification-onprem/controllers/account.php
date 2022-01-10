<?php


use OTP\Handler\MoRegistrationHandler;
use OTP\Helper\MoConstants;
use OTP\Helper\MoUtility;
$px = MoConstants::HOSTNAME . "\57\155\157\x61\163\x2f\154\157\x67\x69\x6e" . "\x3f\x72\x65\144\151\162\145\x63\164\x55\x72\x6c\75" . MoConstants::HOSTNAME . "\x2f\155\157\141\x73\x2f\x76\151\145\x77\x6c\x69\143\145\x6e\x73\x65\x6b\x65\x79\x73";
$Sw = MoRegistrationHandler::instance();
if (get_mo_option("\162\145\147\151\x73\x74\162\x61\x74\x69\157\x6e\x5f\163\x74\x61\164\x75\163") === "\x4d\117\x5f\x4f\x54\x50\x5f\104\x45\x4c\111\x56\105\x52\x45\104\x5f\123\125\103\103\x45\x53\123" || get_mo_option("\162\145\x67\x69\x73\x74\162\x61\164\x69\157\156\137\x73\164\141\164\x75\163") === "\115\x4f\x5f\117\124\120\x5f\x56\101\114\111\x44\101\124\111\117\x4e\x5f\x46\x41\111\114\125\x52\x45" || get_mo_option("\x72\x65\147\151\163\x74\162\141\164\151\x6f\x6e\x5f\163\x74\141\164\165\163") === "\115\117\137\117\x54\120\137\x44\x45\114\111\x56\x45\x52\105\x44\x5f\106\x41\111\114\125\x52\x45") {
    goto nb;
}
if (get_mo_option("\x76\x65\162\x69\x66\171\x5f\x63\165\163\164\x6f\x6d\145\162")) {
    goto Yq;
}
if (!MoUtility::micr()) {
    goto yr;
}
if (MoUtility::micr() && !MoUtility::mclv()) {
    goto Bs;
}
$jT = get_mo_option("\x61\144\155\151\x6e\x5f\x63\x75\163\x74\157\155\145\x72\137\x6b\145\171");
$xg = get_mo_option("\141\144\155\151\156\x5f\141\x70\x69\x5f\153\x65\171");
$rG = get_mo_option("\143\x75\x73\164\157\x6d\145\162\137\164\157\x6b\145\156");
$v2 = MoUtility::mclv() && !MoUtility::isMG();
$oD = $ec->getNonceValue();
$N4 = $Sw->getNonceValue();
include MOV_DIR . "\x76\x69\x65\x77\163\x2f\x61\x63\x63\x6f\165\x6e\164\x2f\160\x72\x6f\x66\151\154\145\x2e\160\150\160";
goto rh;
Bs:
$oD = $Sw->getNonceValue();
include MOV_DIR . "\166\151\x65\x77\x73\57\141\x63\143\157\165\156\164\x2f\x76\x65\162\x69\146\171\x2d\x6c\153\x2e\160\150\x70";
rh:
goto sC;
yr:
$current_user = wp_get_current_user();
$n3 = get_mo_option("\141\x64\x6d\151\x6e\137\x70\x68\157\x6e\145") ? get_mo_option("\141\x64\x6d\x69\x6e\x5f\x70\x68\157\156\145") : '';
$oD = $Sw->getNonceValue();
delete_site_option("\x70\141\x73\163\x77\x6f\162\x64\x5f\x6d\151\163\x6d\141\164\x63\x68");
update_mo_option("\x6e\145\x77\137\x72\x65\147\151\163\x74\x72\x61\164\x69\157\x6e", "\x74\162\165\145");
include MOV_DIR . "\166\151\x65\167\x73\x2f\x61\143\143\x6f\x75\156\164\57\162\145\147\x69\163\x74\145\x72\56\160\x68\x70";
sC:
goto gP;
Yq:
$GH = get_mo_option("\x61\x64\155\151\x6e\137\145\155\x61\x69\154") ? get_mo_option("\x61\144\155\151\x6e\x5f\145\155\141\151\x6c") : '';
$oD = $Sw->getNonceValue();
include MOV_DIR . "\x76\x69\x65\x77\x73\57\x61\143\x63\157\165\156\x74\57\154\157\x67\x69\156\x2e\160\150\160";
gP:
goto Hk;
nb:
$n3 = get_mo_option("\x61\x64\155\151\x6e\x5f\160\x68\x6f\156\x65") ? get_mo_option("\141\144\155\151\156\x5f\160\x68\157\156\x65") : '';
$oD = $Sw->getNonceValue();
include MOV_DIR . "\166\151\145\167\163\x2f\x61\143\x63\157\165\156\x74\57\x76\x65\x72\151\146\x79\x2e\x70\150\160";
Hk:
