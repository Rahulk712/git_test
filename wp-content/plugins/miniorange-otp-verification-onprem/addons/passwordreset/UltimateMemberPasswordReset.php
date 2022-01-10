<?php


namespace OTP\Addons\PasswordReset;

use OTP\Addons\PasswordReset\Handler\UMPasswordResetAddOnHandler;
use OTP\Addons\PasswordReset\Helper\UMPasswordResetMessages;
use OTP\Helper\AddOnList;
use OTP\Objects\AddOnInterface;
use OTP\Objects\BaseAddOn;
use OTP\Traits\Instance;
if (defined("\101\102\x53\120\x41\x54\x48")) {
    goto dG;
}
die;
dG:
include "\x5f\x61\x75\x74\x6f\154\x6f\141\144\x2e\160\x68\x70";
final class UltimateMemberPasswordReset extends BaseAddOn implements AddOnInterface
{
    use Instance;
    public function __construct()
    {
        parent::__construct();
        add_action("\141\144\155\x69\x6e\x5f\x65\156\x71\165\x65\x75\x65\137\163\x63\162\151\160\164\x73", array($this, "\x75\x6d\137\160\x72\x5f\x6e\157\164\x69\146\x5f\163\x65\x74\164\x69\156\x67\x73\x5f\163\x74\171\x6c\x65"));
        add_action("\x6d\x6f\x5f\x6f\x74\160\137\x76\x65\x72\x69\146\151\143\141\x74\x69\x6f\156\137\x64\145\x6c\145\164\x65\x5f\x61\x64\144\x6f\x6e\x5f\157\160\164\151\x6f\x6e\x73", array($this, "\x75\x6d\137\160\x72\137\x6e\157\164\x69\146\x5f\x64\145\x6c\145\164\x65\x5f\x6f\160\x74\x69\x6f\156\163"));
    }
    function um_pr_notif_settings_style()
    {
        wp_enqueue_style("\x75\155\137\160\x72\x5f\x6e\x6f\164\151\146\x5f\x61\144\x6d\x69\156\137\x73\145\164\164\x69\156\x67\163\x5f\x73\x74\171\x6c\145", UMPR_CSS_URL);
    }
    function initializeHandlers()
    {
        $rz = AddOnList::instance();
        $Sw = UMPasswordResetAddOnHandler::instance();
        $rz->add($Sw->getAddOnKey(), $Sw);
    }
    function initializeHelpers()
    {
        UMPasswordResetMessages::instance();
    }
    function show_addon_settings_page()
    {
        include UMPR_DIR . "\x63\157\x6e\x74\162\157\x6c\154\x65\162\163\x2f\155\141\x69\x6e\x2d\x63\x6f\x6e\x74\x72\157\154\154\x65\x72\x2e\160\x68\x70";
    }
    function um_pr_notif_delete_options()
    {
        delete_site_option("\x6d\157\137\x75\155\137\160\x72\x5f\x70\x61\163\163\137\145\156\141\142\154\145");
        delete_site_option("\155\x6f\137\165\155\137\160\162\x5f\x70\x61\x73\163\137\142\x75\x74\164\x6f\x6e\137\164\145\x78\x74");
        delete_site_option("\x6d\x6f\x5f\x75\155\x5f\160\162\137\x65\156\141\142\154\x65\x64\137\x74\x79\x70\145");
    }
}
