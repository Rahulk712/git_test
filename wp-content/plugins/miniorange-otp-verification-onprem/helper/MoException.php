<?php


namespace OTP\Helper;

if (defined("\101\102\123\120\x41\x54\x48")) {
    goto JX;
}
die;
JX:
class MoException extends \Exception
{
    private $moCode;
    public function __construct($KF, $bJ, $hq)
    {
        $this->moCode = $KF;
        parent::__construct($bJ, $hq, NULL);
    }
    public function getMoCode()
    {
        return $this->moCode;
    }
}
