<?php


use OTP\Handler\Forms\WPFormsPlugin;
$Sw = WPFormsPlugin::instance();
$Ib = (bool) $Sw->isFormEnabled() ? "\143\150\x65\143\153\x65\144" : '';
$AI = $Ib == "\143\x68\x65\x63\x6b\x65\x64" ? '' : "\150\151\144\x64\145\156";
$c0 = $Sw->getOtpTypeEnabled();
$uS = $Sw->getFormDetails();
$wA = admin_url() . "\141\144\x6d\x69\156\x2e\x70\x68\160\x3f\x70\x61\147\x65\x3d\x77\x70\x66\x6f\x72\x6d\x73\x2d\157\x76\x65\162\x76\151\145\167";
$YG = $Sw->getButtonText();
$h2 = $Sw->getPhoneHTMLTag();
$cN = $Sw->getEmailHTMLTag();
$Nq = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\151\145\x77\x73\57\146\157\162\x6d\163\57\x57\x50\x46\157\x72\155\x73\x50\154\165\147\x69\156\56\160\150\x70";
