<?php


namespace OTP\Helper;

if (defined("\x41\102\x53\x50\x41\124\x48")) {
    goto ZW;
}
die;
ZW:
use OTP\MoOTP;
use OTP\Objects\PluginPageDetails;
use OTP\Objects\TabDetails;
use OTP\Traits\Instance;
final class MenuItems
{
    use Instance;
    private $_callback;
    private $_menuSlug;
    private $_menuLogo;
    private $_tabDetails;
    private function __construct()
    {
        $this->_callback = array(MoOTP::instance(), "\x6d\x6f\137\x63\165\163\x74\157\x6d\145\x72\137\166\141\x6c\151\x64\141\164\151\157\156\x5f\x6f\160\164\x69\x6f\156\x73");
        $this->_menuLogo = MOV_ICON;
        $bf = TabDetails::instance();
        $this->_tabDetails = $bf->_tabDetails;
        $this->_menuSlug = $bf->_parentSlug;
        $this->addMainMenu();
        $this->addSubMenus();
    }
    private function addMainMenu()
    {
        add_menu_page("\117\x54\120\40\126\x65\162\151\x66\x69\143\141\x74\x69\x6f\156", "\117\124\x50\x20\126\145\162\x69\x66\151\x63\141\164\x69\x6f\x6e", "\155\x61\x6e\x61\147\145\137\x6f\x70\x74\x69\157\x6e\163", $this->_menuSlug, $this->_callback, $this->_menuLogo);
    }
    private function addSubMenus()
    {
        foreach ($this->_tabDetails as $Uy) {
            add_submenu_page($this->_menuSlug, $Uy->_pageTitle, $Uy->_menuTitle, "\x6d\141\156\141\147\145\137\157\x70\x74\x69\x6f\156\163", $Uy->_menuSlug, $this->_callback);
            m2:
        }
        Xy:
    }
}
