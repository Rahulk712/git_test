<?php


use OTP\Handler\Forms\WpEmemberForm;
$Sw = WpEmemberForm::instance();
$de = $Sw->isFormEnabled() ? "\x63\x68\145\143\x6b\x65\144" : '';
$La = $de == "\143\x68\145\143\153\145\144" ? '' : "\x68\x69\144\144\145\156";
$zV = $Sw->getOtpTypeEnabled();
$ns = admin_url() . "\x61\144\155\151\x6e\x2e\160\150\x70\x3f\x70\x61\x67\145\75\145\115\x65\155\x62\145\162\x5f\x73\x65\x74\164\x69\156\x67\163\x5f\155\145\x6e\x75\x26\x74\141\142\x3d\x34";
$Ve = $Sw->getPhoneHTMLTag();
$ZC = $Sw->getEmailHTMLTag();
$R0 = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\x69\x65\x77\163\x2f\x66\157\162\155\x73\57\127\x70\105\155\145\155\x62\145\162\x46\x6f\x72\155\56\x70\x68\160";
