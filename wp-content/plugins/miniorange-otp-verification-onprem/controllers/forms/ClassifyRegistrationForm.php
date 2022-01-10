<?php


use OTP\Handler\Forms\ClassifyRegistrationForm;
$Sw = ClassifyRegistrationForm::instance();
$lw = $Sw->isFormEnabled() ? "\x63\150\x65\x63\x6b\145\x64" : '';
$aX = $lw == "\x63\x68\x65\x63\x6b\145\144" ? '' : "\150\151\144\144\145\156";
$p2 = $Sw->getOtpTypeEnabled();
$bA = $Sw->getPhoneHTMLTag();
$Zp = $Sw->getEmailHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\151\145\167\163\57\146\157\162\155\x73\57\103\154\141\163\x73\151\146\x79\122\x65\x67\151\163\x74\x72\x61\x74\x69\x6f\156\106\x6f\x72\155\x2e\x70\x68\160";
