<?php


use OTP\Handler\Forms\WordPressComments;
$Sw = WordPressComments::instance();
$D1 = (bool) $Sw->isFormEnabled() ? "\143\150\x65\x63\x6b\x65\x64" : '';
$gz = $D1 == "\x63\150\x65\x63\x6b\145\x64" ? '' : "\150\151\144\144\x65\156";
$GW = $Sw->getOtpTypeEnabled();
$fX = $Sw->bypassForLoggedInUsers() ? "\x63\x68\x65\x63\153\145\x64" : '';
$ex = $Sw->getPhoneHTMLTag();
$PQ = $Sw->getEmailHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\151\145\x77\163\x2f\x66\157\x72\x6d\x73\57\x57\157\x72\x64\120\x72\145\163\x73\103\157\x6d\155\x65\x6e\x74\x73\x2e\x70\150\x70";
