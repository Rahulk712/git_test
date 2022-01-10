<?php


use OTP\Handler\Forms\WpMemberForm;
$Sw = WpMemberForm::instance();
$Q5 = (bool) $Sw->isFormEnabled() ? "\143\150\x65\143\153\x65\144" : '';
$hg = $Q5 == "\x63\x68\145\x63\153\x65\144" ? '' : "\x68\x69\x64\144\145\156";
$NR = $Sw->getOtpTypeEnabled();
$D0 = admin_url() . "\x61\x64\155\151\x6e\56\x70\x68\x70\77\160\x61\x67\145\x3d\167\160\x6d\x65\155\x2d\163\145\x74\x74\151\x6e\147\163\46\164\x61\x62\x3d\146\x69\x65\x6c\x64\x73";
$N7 = $Sw->getPhoneHTMLTag();
$GD = $Sw->getEmailHTMLTag();
$Ra = $Sw->getFormName();
$aZ = $Sw->getPhoneKeyDetails();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\151\x65\167\x73\57\146\x6f\x72\155\163\57\x57\160\x4d\x65\155\142\145\x72\106\x6f\x72\155\x2e\160\x68\160";
