<?php


use OTP\Handler\Forms\MultiSiteFormRegistration;
$Sw = MultiSiteFormRegistration::instance();
$Uc = $Sw->isFormEnabled() ? "\x63\x68\x65\143\153\x65\144" : '';
$Mp = $Uc == "\143\150\x65\143\x6b\x65\144" ? '' : "\x68\151\144\x64\145\156";
$uN = $Sw->getOtpTypeEnabled();
$S6 = $Sw->getPhoneHTMLTag();
$sC = $Sw->getEmailHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\151\x65\167\x73\x2f\146\x6f\162\x6d\163\x2f\115\x75\154\164\x69\123\151\x74\145\x46\x6f\162\155\x52\145\147\151\x73\164\x72\x61\x74\x69\x6f\x6e\x2e\160\150\160";
