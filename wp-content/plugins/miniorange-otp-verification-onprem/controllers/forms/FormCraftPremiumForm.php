<?php


use OTP\Handler\Forms\FormCraftPremiumForm;
$Sw = FormCraftPremiumForm::instance();
$wG = $Sw->isFormEnabled() ? "\x63\150\145\x63\153\x65\x64" : '';
$tT = $wG == "\x63\150\x65\143\153\x65\x64" ? '' : "\150\x69\x64\x64\145\156";
$XI = $Sw->getOtpTypeEnabled();
$iu = admin_url() . "\141\x64\x6d\151\156\x2e\160\x68\160\x3f\160\x61\x67\145\75\x66\x6f\x72\x6d\143\x72\x61\146\x74\x5f\x61\x64\x6d\151\x6e";
$Je = $Sw->getFormDetails();
$Uo = $Sw->getPhoneHTMLTag();
$e9 = $Sw->getEmailHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\x69\145\167\163\x2f\146\157\x72\x6d\163\57\x46\x6f\x72\155\103\162\x61\x66\164\x50\x72\x65\155\x69\165\x6d\x46\157\x72\155\x2e\x70\x68\x70";
