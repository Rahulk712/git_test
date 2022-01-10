<?php


use OTP\Addons\PasswordReset\Handler\UMPasswordResetHandler;
use OTP\Handler\MoOTPActionHandlerHandler;
$Sw = UMPasswordResetHandler::instance();
$ec = MoOTPActionHandlerHandler::instance();
$c2 = $Sw->isFormEnabled() ? "\143\x68\x65\x63\x6b\145\x64" : '';
$re = $c2 == "\x63\150\x65\x63\x6b\145\144" ? '' : "\150\151\x64\144\x65\x6e";
$GI = $Sw->getOtpTypeEnabled();
$VB = $Sw->getPhoneHTMLTag();
$UF = $Sw->getEmailHTMLTag();
$Ra = $Sw->getFormName();
$nb = $Sw->getButtonText();
$oD = $ec->getNonceValue();
$Jv = $Sw->getFormOption();
$F1 = $Sw->getPhoneKeyDetails();
$DA = $Sw->getIsOnlyPhoneReset() ? "\x63\x68\x65\143\x6b\145\144" : '';
include UMPR_DIR . "\166\x69\x65\167\x73\x2f\x55\x4d\x50\141\163\163\x77\157\162\144\122\145\x73\145\164\56\x70\150\x70";
