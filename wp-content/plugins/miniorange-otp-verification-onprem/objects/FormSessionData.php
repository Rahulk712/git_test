<?php


namespace OTP\Objects;

class FormSessionData
{
    private $isInitialized = false;
    private $emailSubmitted;
    private $phoneSubmitted;
    private $emailVerified;
    private $phoneVerified;
    private $emailVerificationStatus;
    private $phoneVerificationStatus;
    private $fieldOrFormId;
    private $userSubmitted;
    function __construct()
    {
    }
    function init()
    {
        $this->isInitialized = true;
        return $this;
    }
    public function getIsInitialized()
    {
        return $this->isInitialized;
    }
    public function getEmailSubmitted()
    {
        return $this->emailSubmitted;
    }
    public function setEmailSubmitted($S0)
    {
        $this->emailSubmitted = $S0;
    }
    public function getPhoneSubmitted()
    {
        return $this->phoneSubmitted;
    }
    public function setPhoneSubmitted($vX)
    {
        $this->phoneSubmitted = $vX;
    }
    public function getEmailVerified()
    {
        return $this->emailVerified;
    }
    public function setEmailVerified($sP)
    {
        $this->emailVerified = $sP;
    }
    public function getPhoneVerified()
    {
        return $this->phoneVerified;
    }
    public function setPhoneVerified($B7)
    {
        $this->phoneVerified = $B7;
    }
    public function getEmailVerificationStatus()
    {
        return $this->emailVerificationStatus;
    }
    public function setEmailVerificationStatus($FE)
    {
        $this->emailVerificationStatus = $FE;
    }
    public function getPhoneVerificationStatus()
    {
        return $this->phoneVerificationStatus;
    }
    public function setPhoneVerificationStatus($qx)
    {
        $this->phoneVerificationStatus = $qx;
    }
    public function getFieldOrFormId()
    {
        return $this->fieldOrFormId;
    }
    public function setFieldOrFormId($nP)
    {
        $this->fieldOrFormId = $nP;
    }
    public function getUserSubmitted()
    {
        return $this->userSubmitted;
    }
    public function setUserSubmitted($KE)
    {
        $this->userSubmitted = $KE;
    }
}
