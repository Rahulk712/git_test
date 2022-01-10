<?php


use OTP\Handler\Forms\ProfileBuilderRegistrationForm;
$Sw = ProfileBuilderRegistrationForm::instance();
$zx = $Sw->isFormEnabled() ? "\x63\x68\x65\x63\153\x65\x64" : '';
$Dw = $zx == "\x63\150\x65\143\x6b\x65\x64" ? '' : "\150\151\x64\144\x65\156";
$D8 = $Sw->getOtpTypeEnabled();
$mW = $Sw->getPhoneKeyDetails();
$PV = admin_url() . "\141\x64\155\x69\156\56\x70\x68\x70\x3f\160\141\147\145\75\x6d\141\x6e\141\x67\x65\x2d\x66\151\x65\x6c\x64\x73";
$eG = $Sw->getPhoneHTMLTag();
$ic = $Sw->getEmailHTMLTag();
$mP = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\x69\x65\167\x73\57\x66\157\x72\x6d\x73\x2f\120\162\157\146\151\154\145\102\165\x69\x6c\144\145\x72\x52\x65\x67\151\163\x74\162\x61\x74\151\x6f\156\x46\157\x72\155\56\x70\x68\x70";
