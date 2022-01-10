<?php


use OTP\Handler\Forms\ContactForm7;
$Sw = ContactForm7::instance();
$IF = (bool) $Sw->isFormEnabled() ? "\143\150\145\x63\153\145\x64" : '';
$Pl = $IF == "\143\x68\x65\143\153\145\144" ? '' : "\150\x69\144\144\x65\x6e";
$oC = $Sw->getOtpTypeEnabled();
$Yk = admin_url() . "\141\144\155\151\156\56\160\x68\160\77\160\x61\x67\145\75\x77\x70\143\x66\67";
$bT = $Sw->getEmailKeyDetails();
$M_ = $Sw->getPhoneHTMLTag();
$B9 = $Sw->getEmailHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\x69\145\167\163\57\x66\x6f\162\x6d\163\x2f\103\x6f\x6e\x74\141\143\164\x46\x6f\x72\155\x37\56\160\x68\x70";
