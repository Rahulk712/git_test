<?php


namespace OTP\Objects;

interface IFormHandler
{
    public function unsetOTPSessionVariables();
    public function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5);
    public function handle_failed_verification($u0, $Kc, $t2, $m5);
    public function handleForm();
    public function handleFormOptions();
    public function getPhoneNumberSelector($lP);
    public function isLoginOrSocialForm($Sk);
    public function is_ajax_form_in_play($as);
    public function getPhoneHTMLTag();
    public function getEmailHTMLTag();
    public function getBothHTMLTag();
    public function getFormKey();
    public function getFormName();
    public function getOtpTypeEnabled();
    public function disableAutoActivation();
    public function getPhoneKeyDetails();
    public function isFormEnabled();
    public function getEmailKeyDetails();
    public function getButtonText();
    public function getFormDetails();
    public function getVerificationType();
    public function getFormDocuments();
}
