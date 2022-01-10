<?php


namespace OTP\Objects;

interface IMoSessions
{
    static function addSessionVar($xl, $Kw);
    static function getSessionVar($xl);
    static function unsetSession($xl);
    static function checkSession();
}
