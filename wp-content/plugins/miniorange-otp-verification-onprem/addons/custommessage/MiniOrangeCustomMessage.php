<?php


namespace OTP\Addons\CustomMessage;

use OTP\Addons\CustomMessage\Handler\CustomMessages;
use OTP\Addons\CustomMessage\Handler\CustomMessagesShortcode;
use OTP\Helper\AddOnList;
use OTP\Objects\AddOnInterface;
use OTP\Objects\BaseAddOn;
use OTP\Traits\Instance;
if (defined("\101\102\x53\x50\101\124\110")) {
    goto UG;
}
die;
UG:
include "\137\x61\x75\x74\x6f\154\x6f\141\144\56\160\150\x70";
class MiniOrangeCustomMessage extends BaseAddOn implements AddOnInterface
{
    use Instance;
    function initializeHandlers()
    {
        $rz = AddOnList::instance();
        $Sw = CustomMessages::instance();
        $rz->add($Sw->getAddOnKey(), $Sw);
    }
    function initializeHelpers()
    {
        CustomMessagesShortcode::instance();
    }
    function show_addon_settings_page()
    {
        include MCM_DIR . "\x63\157\x6e\164\x72\157\x6c\154\145\162\x73\57\155\x61\151\x6e\55\143\157\156\x74\x72\157\x6c\154\145\162\56\x70\150\x70";
    }
}
