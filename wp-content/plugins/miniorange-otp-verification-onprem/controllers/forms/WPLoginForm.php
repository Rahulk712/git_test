<?php


use OTP\Handler\Forms\WPLoginForm;
$Sw = WPLoginForm::instance();
$f2 = (bool) $Sw->isFormEnabled() ? "\x63\150\x65\x63\x6b\x65\144" : '';
$fa = $f2 == "\x63\x68\x65\143\153\x65\144" ? '' : "\x68\x69\x64\144\x65\x6e";
$KQ = (bool) $Sw->savePhoneNumbers() ? "\143\x68\145\x63\x6b\145\144" : '';
$jM = $Sw->getPhoneKeyDetails();
$su = (bool) $Sw->byPassCheckForAdmins() ? "\143\150\145\x63\x6b\x65\144" : '';
$eL = (bool) $Sw->allowLoginThroughPhone() ? "\x63\150\x65\x63\153\x65\144" : '';
$IT = (bool) $Sw->restrictDuplicates() ? "\143\x68\145\x63\x6b\x65\144" : '';
$Py = $Sw->getOtpTypeEnabled();
$LJ = $Sw->getPhoneHTMLTag();
$ki = $Sw->getEmailHTMLTag();
$Ra = $Sw->getFormName();
$g_ = $Sw->getSkipPasswordCheck() ? "\x63\150\145\x63\153\145\144" : '';
$nN = $Sw->getSkipPasswordCheck() ? "\x62\154\157\143\x6b" : "\150\x69\144\x64\x65\156";
$Rs = $Sw->getSkipPasswordCheckFallback() ? "\x63\x68\145\x63\153\145\144" : '';
$mA = $Sw->getUserLabel();
$vy = $Sw->isDelayOtp() ? "\143\150\x65\143\153\145\144" : '';
$GR = $Sw->isDelayOtp() ? "\x62\154\x6f\143\153" : "\150\151\x64\x64\145\x6e";
$IZ = $Sw->getDelayOtpInterval();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\x69\x65\x77\x73\x2f\x66\x6f\x72\155\x73\57\x57\120\114\x6f\x67\151\x6e\x46\x6f\x72\155\56\x70\150\x70";
