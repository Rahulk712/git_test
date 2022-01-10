<?php


use OTP\Handler\Forms\UserUltraRegistrationForm;
$Sw = UserUltraRegistrationForm::instance();
$nr = $Sw->isFormEnabled() ? "\x63\x68\x65\x63\153\x65\144" : '';
$Hu = $nr == "\x63\150\x65\143\x6b\x65\144" ? '' : "\150\x69\144\x64\145\x6e";
$TU = $Sw->getOtpTypeEnabled();
$q4 = admin_url() . "\141\144\x6d\151\x6e\x2e\160\x68\160\x3f\x70\x61\x67\145\x3d\165\x73\145\x72\165\154\164\x72\x61\46\x74\x61\x62\75\146\151\145\154\144\163";
$Mu = $Sw->getPhoneKeyDetails();
$SE = $Sw->getPhoneHTMLTag();
$uR = $Sw->getEmailHTMLTag();
$bY = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\x69\145\167\163\x2f\x66\x6f\x72\155\163\x2f\x55\x73\145\x72\125\x6c\x74\x72\141\x52\x65\x67\151\163\x74\x72\x61\x74\151\x6f\156\x46\x6f\162\155\56\x70\150\160";
