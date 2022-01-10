<?php


use OTP\Handler\Forms\UltimateMemberRegistrationForm;
$Sw = UltimateMemberRegistrationForm::instance();
$Cy = $Sw->isFormEnabled() ? "\x63\150\145\x63\x6b\145\144" : '';
$XB = $Cy == "\143\x68\x65\x63\x6b\145\x64" ? '' : "\x68\151\x64\144\145\x6e";
$pS = $Sw->getOtpTypeEnabled();
$CA = admin_url() . "\x65\144\151\x74\56\x70\x68\x70\x3f\x70\x6f\163\164\137\164\171\160\145\x3d\x75\x6d\x5f\146\157\162\155";
$JI = $Sw->getPhoneHTMLTag();
$ra = $Sw->getEmailHTMLTag();
$iM = $Sw->getBothHTMLTag();
$pm = $Sw->restrictDuplicates() ? "\143\x68\145\143\153\145\144" : '';
$Ra = $Sw->getFormName();
$aS = $Sw->getButtonText();
$xm = $Sw->isAjaxForm();
$EY = $xm ? "\143\150\x65\143\153\145\x64" : '';
$fj = $Sw->getFormKey();
$f9 = $Sw->getPhoneKeyDetails();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\x69\x65\x77\163\x2f\x66\157\x72\x6d\163\57\125\154\x74\x69\155\x61\x74\x65\x4d\145\x6d\x62\145\162\x52\145\147\x69\x73\164\x72\141\x74\x69\157\156\x46\x6f\x72\155\56\160\150\160";
