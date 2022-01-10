<?php


use OTP\Handler\Forms\DefaultWordPressRegistrationForm;
$Sw = DefaultWordPressRegistrationForm::instance();
$HY = (bool) $Sw->isFormEnabled() ? "\x63\150\x65\143\153\145\144" : '';
$YE = $HY == "\143\x68\145\143\153\x65\144" ? '' : "\x68\151\x64\x64\145\x6e";
$iW = $Sw->getOtpTypeEnabled();
$l4 = (bool) $Sw->restrictDuplicates() ? "\x63\150\145\143\153\x65\144" : '';
$UD = $Sw->getPhoneHTMLTag();
$qn = $Sw->getEmailHTMLTag();
$Sa = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
$cd = $Sw->disableAutoActivation() ? '' : "\x63\150\145\x63\x6b\145\144";
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\151\145\x77\163\x2f\x66\157\x72\155\x73\57\x44\145\x66\141\x75\x6c\164\127\x6f\162\x64\120\162\x65\x73\x73\x52\145\x67\151\163\164\162\141\x74\151\x6f\156\x46\x6f\x72\155\56\160\150\x70";
