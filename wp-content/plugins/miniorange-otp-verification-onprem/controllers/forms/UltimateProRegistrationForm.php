<?php


use OTP\Handler\Forms\UltimateProRegistrationForm;
$Sw = UltimateProRegistrationForm::instance();
$zq = (bool) $Sw->isFormEnabled() ? "\143\x68\145\143\153\145\x64" : '';
$xd = $zq == "\x63\x68\145\x63\153\x65\x64" ? '' : "\x68\151\x64\144\145\156";
$HA = $Sw->getOtpTypeEnabled();
$s2 = admin_url() . "\x61\144\155\151\156\x2e\160\150\160\77\x70\x61\147\145\75\151\x68\x63\x5f\155\141\x6e\141\x67\145\x26\x74\141\142\x3d\162\x65\147\x69\163\x74\x65\162\x26\163\165\x62\164\x61\142\75\x63\x75\x73\x74\x6f\x6d\137\x66\x69\145\154\x64\163";
$K7 = $Sw->getPhoneHTMLTag();
$j1 = $Sw->getEmailHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\x69\145\167\x73\57\146\x6f\162\155\x73\57\125\154\x74\151\x6d\x61\164\145\120\x72\157\122\145\147\x69\163\x74\x72\141\x74\151\157\156\106\157\x72\155\56\x70\150\x70";
