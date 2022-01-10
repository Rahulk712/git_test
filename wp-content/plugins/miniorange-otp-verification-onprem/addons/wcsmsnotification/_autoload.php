<?php


if (defined("\x41\102\123\x50\101\x54\x48")) {
    goto vq;
}
die;
vq:
define("\x4d\x53\x4e\137\104\111\x52", plugin_dir_path(__FILE__));
define("\x4d\x53\x4e\137\x55\122\114", plugin_dir_url(__FILE__));
define("\x4d\123\116\x5f\126\105\x52\x53\111\117\x4e", "\x31\x2e\x30\x2e\60");
define("\115\x53\x4e\x5f\103\123\x53\x5f\125\x52\x4c", MSN_URL . "\x69\x6e\143\x6c\165\144\145\x73\57\x63\x73\163\57\x73\x65\164\x74\151\x6e\147\x73\x2e\155\x69\x6e\56\143\x73\x73\77\x76\x65\162\x73\x69\157\x6e\75" . MSN_VERSION);
define("\x4d\x53\x4e\x5f\x4a\x53\x5f\x55\122\114", MSN_URL . "\x69\x6e\143\x6c\165\x64\x65\163\x2f\x6a\x73\57\x73\x65\164\164\x69\156\147\163\x2e\155\x69\x6e\x2e\x6a\163\x3f\x76\145\x72\x73\151\157\156\75" . MSN_VERSION);
function get_wc_option($WI, $E4 = null)
{
    $WI = ($E4 === null ? "\155\x6f\x5f\167\143\137\x73\155\163\x5f" : $E4) . $WI;
    return get_mo_option($WI, '');
}
function update_wc_option($kN, $sA, $E4 = null)
{
    $kN = ($E4 === null ? "\x6d\157\x5f\167\x63\x5f\163\155\163\x5f" : $E4) . $kN;
    update_mo_option($kN, $sA, '');
}
