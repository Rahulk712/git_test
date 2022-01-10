<?php


namespace OTP\Objects;

class TransactionSessionData
{
    private $emailTransactionId;
    private $phoneTransactionId;
    public function getEmailTransactionId()
    {
        return $this->emailTransactionId;
    }
    public function setEmailTransactionId($xc)
    {
        $this->emailTransactionId = $xc;
    }
    public function getPhoneTransactionId()
    {
        return $this->phoneTransactionId;
    }
    public function setPhoneTransactionId($Gs)
    {
        $this->phoneTransactionId = $Gs;
    }
}
