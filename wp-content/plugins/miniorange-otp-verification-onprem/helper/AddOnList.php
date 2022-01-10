<?php


namespace OTP\Helper;

if (defined("\x41\x42\123\120\x41\x54\110")) {
    goto n7;
}
die;
n7:
use OTP\Objects\BaseAddOnHandler;
use OTP\Traits\Instance;
final class AddOnList
{
    use Instance;
    private $_addOns;
    private function __construct()
    {
        $this->_addOns = array();
    }
    public function add($xl, $form)
    {
        $this->_addOns[$xl] = $form;
    }
    public function getList()
    {
        return $this->_addOns;
    }
}
