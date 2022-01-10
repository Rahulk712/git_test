<?php


use OTP\Handler\Forms\WPClientRegistration;
$Sw = WPClientRegistration::instance();
$jB = $Sw->isFormEnabled() ? "\143\150\145\143\153\x65\144" : '';
$b7 = $jB == "\143\x68\x65\x63\153\x65\144" ? '' : "\150\x69\x64\x64\145\x6e";
$Np = $Sw->getOtpTypeEnabled();
$sz = $Sw->getPhoneHTMLTag();
$yN = $Sw->getEmailHTMLTag();
$Wi = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
$jr = $Sw->restrictDuplicates() ? "\x63\150\x65\x63\x6b\145\x64" : '';
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\x69\145\167\x73\x2f\146\157\162\x6d\x73\57\x57\x50\103\154\151\x65\156\x74\122\145\x67\151\x73\x74\x72\141\x74\151\157\156\x2e\x70\150\x70";
