<?php


use OTP\Handler\Forms\UserProfileMadeEasyRegistrationForm;
$Sw = UserProfileMadeEasyRegistrationForm::instance();
$tC = $Sw->isFormEnabled() ? "\x63\x68\145\x63\153\145\x64" : '';
$OO = $tC == "\143\150\145\x63\x6b\x65\144" ? '' : "\x68\151\x64\144\145\x6e";
$Gq = $Sw->getOtpTypeEnabled();
$Wd = admin_url() . "\141\144\155\151\156\x2e\160\x68\x70\77\x70\x61\x67\145\75\165\x70\x6d\145\55\x66\x69\x65\154\x64\x2d\x63\165\x73\x74\x6f\x6d\151\172\x65\162";
$My = $Sw->getPhoneKeyDetails();
$lk = $Sw->getPhoneHTMLTag();
$Q6 = $Sw->getEmailHTMLTag();
$Kd = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\151\145\x77\x73\x2f\x66\x6f\x72\155\163\57\x55\x73\145\x72\x50\162\157\146\x69\x6c\145\115\141\144\x65\105\x61\x73\x79\x52\x65\x67\151\x73\x74\162\141\164\x69\x6f\x6e\106\157\x72\155\56\x70\x68\160";
