<?php


if (defined("\101\102\x53\120\x41\124\110")) {
    goto LM;
}
die;
LM:
define("\125\x4d\x53\116\x5f\x44\x49\x52", plugin_dir_path(__FILE__));
define("\125\115\x53\116\137\x55\x52\114", plugin_dir_url(__FILE__));
define("\125\x4d\x53\x4e\x5f\126\105\x52\x53\x49\x4f\116", "\x31\56\x30\56\x30");
define("\125\115\123\x4e\x5f\x43\123\123\x5f\125\122\114", UMSN_URL . "\151\156\x63\x6c\x75\x64\x65\x73\x2f\x63\x73\163\x2f\x73\x65\164\164\151\x6e\147\x73\x2e\155\151\x6e\x2e\143\x73\x73\x3f\166\145\x72\163\x69\x6f\156\x3d" . UMSN_VERSION);
function get_umsn_option($WI, $E4 = null)
{
    $WI = ($E4 == null ? "\x6d\x6f\x5f\x75\x6d\x5f\163\x6d\x73\137" : $E4) . $WI;
    return get_mo_option($WI, '');
}
function update_umsn_option($kN, $sA, $E4 = null)
{
    $kN = ($E4 === null ? "\x6d\x6f\x5f\165\x6d\x5f\163\155\163\x5f" : $E4) . $kN;
    update_mo_option($kN, $sA, '');
}
