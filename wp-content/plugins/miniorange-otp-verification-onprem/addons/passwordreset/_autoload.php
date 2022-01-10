<?php


if (defined("\x41\102\x53\x50\x41\x54\x48")) {
    goto dW;
}
die;
dW:
define("\125\x4d\x50\x52\137\x44\x49\122", plugin_dir_path(__FILE__));
define("\x55\x4d\x50\x52\137\125\122\114", plugin_dir_url(__FILE__));
define("\x55\x4d\x50\122\137\x56\x45\x52\x53\x49\117\116", "\x31\56\x30\x2e\60");
define("\x55\x4d\x50\x52\x5f\x43\123\x53\x5f\x55\122\114", UMPR_URL . "\151\x6e\143\x6c\x75\144\145\x73\57\143\163\x73\x2f\x73\145\164\164\151\156\147\x73\x2e\155\x69\x6e\x2e\x63\x73\163\x3f\x76\145\162\163\151\157\156\75" . UMPR_VERSION);
function get_umpr_option($WI, $E4 = null)
{
    $WI = ($E4 == null ? "\x6d\x6f\x5f\x75\x6d\x5f\x70\x72\x5f" : $E4) . $WI;
    return get_mo_option($WI, '');
}
function update_umpr_option($kN, $sA, $E4 = null)
{
    $kN = ($E4 === null ? "\155\x6f\x5f\165\x6d\x5f\160\x72\137" : $E4) . $kN;
    update_mo_option($kN, $sA, '');
}
