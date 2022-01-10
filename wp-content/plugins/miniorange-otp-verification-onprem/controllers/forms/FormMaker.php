<?php


use OTP\Handler\Forms\FormMaker;
$Sw = FormMaker::instance();
$Vr = (bool) $Sw->isFormEnabled() ? "\143\x68\145\143\x6b\x65\x64" : '';
$o_ = $Vr == "\x63\x68\x65\143\153\x65\144" ? '' : "\x68\x69\144\x64\145\156";
$ps = admin_url() . "\x61\x64\x6d\151\156\x2e\x70\x68\160\77\160\x61\x67\x65\x3d\155\x61\x6e\x61\x67\145\x5f\x66\x6d";
$wX = $Sw->getOtpTypeEnabled();
$W9 = $Sw->getEmailHTMLTag();
$VT = $Sw->getPhoneHTMLTag();
$Kg = $Sw->getFormDetails();
$Ra = $Sw->getFormName();
$YG = $Sw->getButtonText();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\x69\x65\x77\x73\57\x66\x6f\162\155\163\x2f\106\x6f\x72\x6d\115\x61\153\x65\162\x2e\160\150\160";
