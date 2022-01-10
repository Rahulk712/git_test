<?php


namespace OTP\Helper;

use OTP\Objects\FormHandler;
use OTP\Traits\Instance;
if (defined("\x41\x42\123\x50\x41\x54\x48")) {
    goto pR;
}
die;
pR:
final class FormList
{
    use Instance;
    private $_forms;
    private $enabled_forms;
    private function __construct()
    {
        $this->_forms = array();
    }
    public function add($xl, $form)
    {
        $this->_forms[$xl] = $form;
        if (!$form->isFormEnabled()) {
            goto xN;
        }
        $this->enabled_forms[$xl] = $form;
        xN:
    }
    public function getList()
    {
        return $this->_forms;
    }
    public function getEnabledForms()
    {
        return $this->enabled_forms;
    }
}
