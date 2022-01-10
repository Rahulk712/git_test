<?php


use OTP\Handler\Forms\CalderaForms;
$Sw = CalderaForms::instance();
$dk = (bool) $Sw->isFormEnabled() ? "\x63\150\145\143\x6b\x65\144" : '';
$EV = $dk == "\143\150\145\x63\153\x65\144" ? '' : "\x68\x69\x64\x64\x65\156";
$WW = $Sw->getOtpTypeEnabled();
$Ug = $Sw->getFormDetails();
$Ic = admin_url() . "\141\144\x6d\x69\156\x2e\160\x68\x70\x3f\x70\141\147\145\75\x63\x61\154\144\145\x72\141\x2d\146\x6f\x72\x6d\163";
$YG = $Sw->getButtonText();
$IS = $Sw->getPhoneHTMLTag();
$zJ = $Sw->getEmailHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\151\145\x77\x73\x2f\146\157\162\155\x73\x2f\x43\x61\154\144\x65\x72\x61\106\157\162\155\x73\56\160\x68\x70";
