<?php


namespace OTP\Addons\PasswordReset\Handler;

use OTP\Objects\BaseAddOnHandler;
use OTP\Traits\Instance;
class UMPasswordResetAddOnHandler extends BaseAddOnHandler
{
    use Instance;
    function __construct()
    {
        parent::__construct();
        if ($this->moAddOnV()) {
            goto YF;
        }
        return;
        YF:
        UMPasswordResetHandler::instance();
    }
    function setAddonKey()
    {
        $this->_addOnKey = "\165\x6d\137\x70\141\163\163\137\162\145\163\145\x74\137\x61\x64\144\x6f\156";
    }
    function setAddOnDesc()
    {
        $this->_addOnDesc = mo_("\x41\154\154\x6f\x77\x73\40\171\157\x75\x72\x20\x75\x73\145\x72\x73\40\x74\157\x20\162\145\x73\145\164\40\164\x68\x65\x69\x72\40\x70\x61\x73\163\167\x6f\162\x64\x20\x75\163\151\156\147\x20\x4f\x54\x50\40\x69\x6e\163\x74\145\141\144\x20\157\146\x20\x65\x6d\x61\x69\x6c\x20\x6c\x69\156\x6b\x73\56" . "\103\x6c\151\x63\x6b\x20\x6f\156\x20\x74\x68\x65\x20\163\x65\x74\x74\151\156\147\x73\x20\x62\165\164\164\157\156\x20\x74\157\x20\164\x68\145\40\x72\x69\147\150\164\40\164\x6f\x20\143\157\156\146\x69\x67\x75\162\x65\40\163\x65\x74\x74\151\x6e\x67\x73\x20\146\x6f\162\x20\x74\150\x65\40\x73\x61\155\145\x2e");
    }
    function setAddOnName()
    {
        $this->_addOnName = mo_("\125\x6c\x74\x69\x6d\x61\164\145\x20\115\x65\155\142\145\x72\x20\x50\141\x73\x73\167\157\x72\144\40\122\x65\163\x65\x74\x20\117\x76\x65\x72\x20\117\x54\x50");
    }
    function setSettingsUrl()
    {
        $this->_settingsUrl = add_query_arg(array("\x61\144\x64\x6f\156" => "\x75\155\160\x72\x5f\156\x6f\164\151\146"), $_SERVER["\x52\x45\x51\x55\105\x53\x54\137\x55\x52\111"]);
    }
}
