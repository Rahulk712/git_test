<?php


use OTP\Handler\Forms\UltimateMemberProfileForm;
$Sw = UltimateMemberProfileForm::instance();
$em = $Sw->isFormEnabled() ? "\x63\x68\145\143\153\145\144" : '';
$jQ = $em == "\x63\x68\145\x63\x6b\x65\144" ? '' : "\150\151\x64\x64\x65\x6e";
$j6 = $Sw->getOtpTypeEnabled();
$Kn = $Sw->getPhoneKeyDetails();
$Bo = admin_url() . "\x65\x64\151\x74\x2e\x70\150\x70\77\x70\157\x73\x74\x5f\x74\x79\160\145\x3d\x75\x6d\137\146\157\x72\155";
$Qm = $Sw->getPhoneHTMLTag();
$NI = $Sw->getEmailHTMLTag();
$HT = $Sw->getBothHTMLTag();
$Y7 = $Sw->restrictDuplicates() ? "\x63\x68\x65\x63\153\x65\144" : '';
$Ra = $Sw->getFormName();
$Zu = $Sw->getButtonText();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\151\x65\x77\163\x2f\x66\157\x72\x6d\163\57\125\154\x74\x69\x6d\x61\x74\145\x4d\x65\x6d\x62\x65\x72\120\162\x6f\146\151\x6c\x65\106\157\x72\x6d\56\160\x68\x70";
