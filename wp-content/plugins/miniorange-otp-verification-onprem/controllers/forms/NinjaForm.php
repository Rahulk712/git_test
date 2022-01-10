<?php


use OTP\Handler\Forms\NinjaForm;
$Sw = NinjaForm::instance();
$tG = $Sw->isFormEnabled() ? "\143\150\x65\x63\x6b\145\x64" : '';
$Tt = $tG == "\x63\x68\145\x63\153\145\144" ? '' : "\x68\x69\144\144\145\156";
$kz = $Sw->getOtpTypeEnabled();
$Dr = admin_url() . "\x61\x64\x6d\x69\x6e\x2e\160\x68\x70\77\160\141\147\x65\x3d\x6e\x69\156\152\141\55\x66\157\162\x6d\163";
$xD = $Sw->getFormDetails();
$Bg = $Sw->getPhoneHTMLTag();
$Tp = $Sw->getEmailHTMLTag();
$of = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\151\x65\x77\163\57\146\157\162\155\x73\57\x4e\151\x6e\x6a\141\106\157\162\155\56\x70\150\x70";
