<?php


namespace OTP\Objects;

abstract class SMSNotification
{
    public $page;
    public $isEnabled;
    public $tooltipHeader;
    public $tooltipBody;
    public $recipient;
    public $smsBody;
    public $defaultSmsBody;
    public $title;
    public $availableTags;
    public $pageHeader;
    public $pageDescription;
    public $notificationType;
    function __construct()
    {
    }
    public abstract function sendSMS(array $mx);
    public function setIsEnabled($lB)
    {
        $this->isEnabled = $lB;
        return $this;
    }
    public function setRecipient($f6)
    {
        $this->recipient = $f6;
        return $this;
    }
    public function setSmsBody($D2)
    {
        $this->smsBody = $D2;
        return $this;
    }
}
