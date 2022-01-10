<?php


namespace OTP;

if (defined("\x41\x42\123\x50\x41\x54\x48")) {
    goto wa;
}
die;
wa:
final class SplClassLoader
{
    private $_fileExtension = "\x2e\160\150\160";
    private $_namespace;
    private $_includePath;
    private $_namespaceSeparator = "\x5c";
    public function __construct($tU = null, $Fg = null)
    {
        $this->_namespace = $tU;
        $this->_includePath = $Fg;
    }
    public function register()
    {
        spl_autoload_register(array($this, "\x6c\157\141\x64\103\x6c\141\x73\x73"));
    }
    public function unregister()
    {
        spl_autoload_unregister(array($this, "\154\x6f\141\x64\103\154\141\163\163"));
    }
    public function loadClass($h3)
    {
        if (!(null === $this->_namespace || $this->isSameNamespace($h3))) {
            goto qR;
        }
        $lW = '';
        $op = '';
        if (!(false !== ($av = strripos($h3, $this->_namespaceSeparator)))) {
            goto iJ;
        }
        $op = strtolower(substr($h3, 0, $av));
        $h3 = substr($h3, $av + 1);
        $lW = str_replace($this->_namespaceSeparator, DIRECTORY_SEPARATOR, $op) . DIRECTORY_SEPARATOR;
        iJ:
        $lW .= str_replace("\137", DIRECTORY_SEPARATOR, $h3) . $this->_fileExtension;
        $lW = str_replace("\157\x74\x70", MOV_NAME, $lW);
        require ($this->_includePath !== null ? $this->_includePath . DIRECTORY_SEPARATOR : '') . $lW;
        qR:
    }
    private function isSameNamespace($h3)
    {
        return $this->_namespace . $this->_namespaceSeparator === substr($h3, 0, strlen($this->_namespace . $this->_namespaceSeparator));
    }
}
