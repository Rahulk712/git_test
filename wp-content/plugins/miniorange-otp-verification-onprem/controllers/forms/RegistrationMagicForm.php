<?php


use OTP\Handler\Forms\RegistrationMagicForm;
$Sw = RegistrationMagicForm::instance();
$cm = $Sw->isFormEnabled() ? "\143\x68\145\x63\153\x65\144" : '';
$U4 = $cm == "\x63\150\145\143\153\145\x64" ? '' : "\x68\151\144\144\145\156";
$IA = $Sw->getOtpTypeEnabled();
$lD = admin_url() . "\x61\x64\155\151\x6e\56\x70\x68\160\77\x70\141\147\145\75\x72\155\137\146\x6f\162\155\x5f\x6d\x61\x6e\x61\147\x65";
$q2 = $Sw->getFormDetails();
$Fj = $Sw->getPhoneHTMLTag();
$iK = $Sw->getEmailHTMLTag();
$a5 = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\x69\x65\167\x73\57\146\x6f\162\155\163\57\122\145\x67\151\163\164\x72\141\x74\151\x6f\x6e\115\141\147\151\x63\106\x6f\162\x6d\x2e\x70\x68\160";
