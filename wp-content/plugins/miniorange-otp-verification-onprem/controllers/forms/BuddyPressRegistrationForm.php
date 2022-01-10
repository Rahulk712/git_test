<?php


use OTP\Handler\Forms\BuddyPressRegistrationForm;
$Sw = BuddyPressRegistrationForm::instance();
$GY = $Sw->isFormEnabled() ? "\143\x68\145\x63\153\x65\144" : '';
$t0 = $GY == "\143\x68\x65\x63\x6b\145\x64" ? '' : "\150\x69\x64\144\x65\156";
$rC = $Sw->getOtpTypeEnabled();
$H1 = admin_url() . "\165\163\145\x72\163\56\160\x68\160\x3f\160\x61\x67\145\75\x62\160\x2d\x70\162\157\x66\151\x6c\x65\x2d\x73\x65\x74\165\160";
$BL = $Sw->getPhoneKeyDetails();
$rX = $Sw->disableAutoActivation() ? "\x63\150\145\x63\153\145\x64" : '';
$FV = $Sw->getPhoneHTMLTag();
$Bb = $Sw->getEmailHTMLTag();
$oA = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
$jr = $Sw->restrictDuplicates() ? "\143\x68\x65\143\153\145\x64" : '';
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\151\x65\167\x73\57\x66\x6f\162\x6d\x73\x2f\102\x75\x64\144\x79\120\162\x65\163\163\x52\x65\147\x69\x73\164\162\x61\x74\151\x6f\156\106\157\162\155\x2e\160\150\160";
