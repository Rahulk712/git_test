<?php


namespace OTP\Addons\WcSMSNotification\Helper;

use ReflectionClass;
final class WcOrderStatus
{
    const PROCESSING = "\x70\162\x6f\x63\x65\163\163\151\x6e\x67";
    const ON_HOLD = "\157\156\55\x68\x6f\x6c\x64";
    const CANCELLED = "\x63\x61\156\143\x65\154\x6c\x65\x64";
    const PENDING = "\x70\145\156\144\x69\x6e\x67";
    const FAILED = "\x66\x61\151\x6c\145\x64";
    const COMPLETED = "\143\x6f\x6d\160\x6c\145\x74\145\144";
    const REFUNDED = "\x72\145\x66\x75\156\144\x65\144";
    public static function getAllStatus()
    {
        $iC = new ReflectionClass(self::class);
        return array_values($iC->getConstants());
    }
}
