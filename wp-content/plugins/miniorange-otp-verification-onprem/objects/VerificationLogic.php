<?php


namespace OTP\Objects;

abstract class VerificationLogic
{
    public abstract function _handle_logic($u0, $Kc, $t2, $e7, $Rw);
    public abstract function _handle_otp_sent($u0, $Kc, $t2, $e7, $Rw, $zv);
    public abstract function _handle_otp_sent_failed($u0, $Kc, $t2, $e7, $Rw, $zv);
    public abstract function _get_otp_sent_message();
    public abstract function _get_otp_sent_failed_message();
    public abstract function _get_otp_invalid_format_message();
    public abstract function _get_is_blocked_message();
    public abstract function _handle_matched($u0, $Kc, $t2, $e7, $Rw);
    public abstract function _handle_not_matched($t2, $e7, $Rw);
    public abstract function _start_otp_verification($u0, $Kc, $t2, $e7, $Rw);
    public abstract function _is_blocked($Kc, $t2);
    public static function _is_ajax_form()
    {
        return (bool) apply_filters("\x69\163\137\141\152\141\170\137\x66\157\162\155", FALSE);
    }
}
