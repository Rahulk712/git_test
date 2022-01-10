<?php


namespace OTP\Objects;

if (defined("\101\102\x53\x50\101\x54\x48")) {
    goto Gu;
}
die;
Gu:
class NotificationSettings
{
    public $sendSMS;
    public $sendEmail;
    public $phoneNumber;
    public $fromEmail;
    public $fromName;
    public $toEmail;
    public $toName;
    public $subject;
    public $bccEmail;
    public $message;
    public function __construct()
    {
        if (func_num_args() < 4) {
            goto iU;
        }
        $this->createEmailNotificationSettings(func_get_arg(0), func_get_arg(1), func_get_arg(2), func_get_arg(3), func_get_arg(4));
        goto Ez;
        iU:
        $this->createSMSNotificationSettings(func_get_arg(0), func_get_arg(1));
        Ez:
    }
    public function createSMSNotificationSettings($mF, $bJ)
    {
        $this->sendSMS = TRUE;
        $this->phoneNumber = $mF;
        $this->message = $bJ;
    }
    public function createEmailNotificationSettings($bh, $Uq, $BV, $uU, $bJ)
    {
        $this->sendEmail = TRUE;
        $this->fromEmail = $bh;
        $this->fromName = $Uq;
        $this->toEmail = $BV;
        $this->toName = $BV;
        $this->subject = $uU;
        $this->bccEmail = '';
        $this->message = $bJ;
    }
}
