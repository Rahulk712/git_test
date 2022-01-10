<?php


use OTP\Handler\Forms\SimplrRegistrationForm;
$Sw = SimplrRegistrationForm::instance();
$Ob = $Sw->isFormEnabled() ? "\143\x68\145\x63\153\x65\144" : '';
$vw = $Ob == "\x63\150\145\x63\x6b\x65\144" ? '' : "\150\x69\x64\144\145\156";
$z4 = $Sw->getOtpTypeEnabled();
$rR = admin_url() . "\x6f\160\164\x69\x6f\156\163\x2d\147\x65\x6e\x65\x72\x61\x6c\x2e\x70\x68\x70\x3f\x70\141\x67\x65\x3d\x73\x69\x6d\160\x6c\x72\137\x72\x65\x67\137\x73\x65\x74\x26\162\145\147\166\x69\x65\167\75\x66\x69\x65\154\144\x73\46\157\x72\x64\x65\x72\x62\x79\x3d\x6e\141\x6d\145\x26\x6f\162\x64\145\x72\75\x64\x65\x73\x63";
$J_ = $Sw->getPhoneKeyDetails();
$ZT = $Sw->getPhoneHTMLTag();
$ru = $Sw->getEmailHTMLTag();
$nS = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\151\145\x77\x73\57\146\x6f\162\x6d\x73\x2f\x53\151\x6d\160\154\162\x52\x65\x67\x69\x73\x74\162\141\x74\151\x6f\156\106\157\x72\x6d\x2e\160\150\x70";
