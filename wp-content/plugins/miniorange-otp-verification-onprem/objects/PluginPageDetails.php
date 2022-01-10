<?php


namespace OTP\Objects;

class PluginPageDetails
{
    function __construct($cy, $iz, $iQ, $O2, $WK, $DT, $M6, $Aw = '', $YQ = true)
    {
        $this->_pageTitle = $cy;
        $this->_menuSlug = $iz;
        $this->_menuTitle = $iQ;
        $this->_tabName = $O2;
        $this->_url = add_query_arg(array("\160\141\x67\145" => $this->_menuSlug), $WK);
        $this->_url = remove_query_arg(array("\x61\144\144\157\156", "\x66\x6f\162\x6d"), $this->_url);
        $this->_view = $DT;
        $this->_id = $M6;
        $this->_showInNav = $YQ;
        $this->_css = $Aw;
    }
    public $_pageTitle;
    public $_menuSlug;
    public $_menuTitle;
    public $_tabName;
    public $_url;
    public $_view;
    public $_id;
    public $_showInNav;
    public $_css;
}
