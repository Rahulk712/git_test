<?php


namespace OTP\Traits;

trait Instance
{
    private static $_instance = null;
    public static function instance()
    {
        if (!is_null(self::$_instance)) {
            goto CF;
        }
        self::$_instance = new self();
        CF:
        return self::$_instance;
    }
}
