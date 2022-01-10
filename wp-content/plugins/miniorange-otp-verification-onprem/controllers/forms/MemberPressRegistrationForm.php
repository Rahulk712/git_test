<?php


use OTP\Handler\Forms\MemberPressRegistrationForm;
$Sw = MemberPressRegistrationForm::instance();
$Sn = $Sw->isFormEnabled() ? "\143\150\x65\143\153\x65\x64" : '';
$CO = $Sn == "\x63\150\x65\143\153\x65\144" ? '' : "\x68\151\x64\x64\145\156";
$t5 = $Sw->getOtpTypeEnabled();
$pD = $Sw->getPhoneKeyDetails();
$zF = admin_url() . "\141\x64\x6d\x69\x6e\x2e\x70\x68\160\x3f\x70\141\147\x65\x3d\x6d\145\x6d\142\145\x72\x70\162\145\163\x73\x2d\157\160\164\x69\x6f\156\163\43\155\x65\160\x72\x2d\x66\x69\145\x6c\144\x73";
$az = $Sw->getPhoneHTMLTag();
$Lr = $Sw->getEmailHTMLTag();
$zM = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
$JB = $Sw->bypassForLoggedInUsers() ? "\x63\x68\x65\143\x6b\x65\144" : '';
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\x69\x65\167\163\57\146\157\162\x6d\163\x2f\115\x65\155\142\x65\x72\120\x72\145\x73\x73\x52\x65\147\151\x73\x74\162\141\x74\x69\157\x6e\106\157\x72\155\x2e\160\150\x70";
