<?php


namespace OTP\Helper;

if (defined("\101\x42\123\x50\x41\124\x48")) {
    goto Bh;
}
die;
Bh:
use OTP\Addons\CustomMessage\MiniOrangeCustomMessage;
use OTP\Addons\PasswordReset\UltimateMemberPasswordReset;
use OTP\Addons\UmSMSNotification\UltimateMemberSmsNotification;
use OTP\Addons\WcSMSNotification\WooCommerceSmsNotification;
use OTP\Objects\BaseAddOnHandler;
use OTP\Objects\IGatewayFunctions;
use OTP\Traits\Instance;
class CustomGatewayWithAddons extends CustomGateway implements IGatewayFunctions
{
    use Instance;
    protected $applicationName = "\167\160\137\x65\155\x61\151\x6c\137\166\145\162\151\146\151\143\141\164\151\157\156\x5f\151\156\164\x72\141\156\145\x74";
    public function registerAddOns()
    {
        UltimateMemberSmsNotification::instance();
        WooCommerceSmsNotification::instance();
        MiniOrangeCustomMessage::instance();
        UltimateMemberPasswordReset::instance();
    }
    public function showAddOnList()
    {
        $qO = AddOnList::instance();
        $qO = $qO->getList();
        foreach ($qO as $sk) {
            echo "\74\164\x72\76\12\40\x20\40\x20\x20\40\x20\40\40\40\40\x20\x20\x20\x20\40\x20\x20\x20\x20\74\x74\144\x20\x63\154\x61\x73\163\75\42\x61\x64\144\157\x6e\x2d\164\x61\x62\x6c\145\55\x6c\151\163\x74\55\x73\x74\141\x74\165\163\x22\76\12\40\40\40\40\x20\40\x20\40\40\40\40\40\40\40\40\x20\x20\40\40\x20\x20\40\40\x20" . $sk->getAddOnName() . "\xa\40\x20\40\x20\x20\40\40\x20\x20\x20\40\40\40\x20\40\40\x20\40\40\x20\74\57\164\x64\x3e\xa\x20\x20\40\40\40\x20\40\40\x20\40\40\40\40\40\x20\40\40\x20\x20\x20\74\x74\144\x20\143\x6c\141\x73\163\x3d\42\141\x64\144\157\x6e\x2d\x74\141\x62\x6c\x65\x2d\154\x69\163\164\x2d\156\x61\x6d\145\42\x3e\xa\x20\40\40\x20\x20\40\x20\40\x20\x20\40\40\40\40\x20\40\x20\x20\x20\40\x20\40\40\40\74\x69\76\xa\40\40\40\40\x20\x20\x20\x20\x20\40\40\x20\x20\x20\x20\x20\40\40\x20\40\x20\40\x20\x20\x20\40\x20\x20" . $sk->getAddOnDesc() . "\12\40\40\x20\40\x20\x20\x20\x20\x20\x20\x20\x20\x20\40\x20\x20\x20\40\x20\40\x20\40\40\40\74\x2f\x69\76\xa\40\x20\x20\40\x20\40\x20\x20\x20\x20\40\40\40\40\40\40\x20\x20\40\x20\x3c\x2f\164\144\76\12\x20\40\x20\40\40\40\40\x20\40\40\40\x20\40\40\40\x20\x20\40\x20\40\x3c\164\144\x20\x63\x6c\141\x73\x73\75\42\x61\144\144\157\156\x2d\164\x61\142\x6c\145\55\x6c\x69\x73\x74\x2d\x61\143\x74\x69\x6f\156\163\x22\x3e\12\40\40\40\x20\40\40\40\40\x20\x20\40\40\40\40\x20\x20\x20\40\x20\40\40\40\x20\x20\74\x61\40\x20\143\x6c\x61\163\163\75\x22\x62\x75\164\x74\157\x6e\55\x70\x72\x69\x6d\141\162\171\40\142\x75\164\x74\x6f\156\x20\164\151\x70\x73\42\x20\xa\x20\40\40\40\x20\40\x20\40\40\x20\x20\40\40\40\x20\40\x20\x20\x20\x20\40\40\x20\40\x20\40\40\40\x68\x72\x65\x66\x3d\x22" . $sk->getSettingsUrl() . "\42\76\xa\40\x20\40\x20\x20\x20\x20\x20\40\x20\x20\40\40\x20\40\x20\40\40\x20\40\x20\x20\x20\x20\x20\x20\x20\40" . mo_("\x53\145\x74\164\x69\156\x67\x73") . "\12\x20\40\40\x20\40\x20\x20\40\x20\40\40\x20\x20\40\x20\x20\x20\40\40\40\40\x20\x20\40\x3c\57\x61\x3e\12\x20\x20\x20\40\x20\x20\x20\40\40\40\x20\x20\x20\40\x20\x20\x20\x20\x20\x20\x3c\x2f\164\x64\x3e\xa\40\x20\40\40\40\x20\40\40\40\x20\40\x20\x20\x20\40\x20\74\57\x74\x72\x3e";
            Ol:
        }
        uy:
    }
    public function getConfigPagePointers()
    {
        return array();
    }
}
