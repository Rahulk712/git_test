<?php


use OTP\Handler\Forms\WooCommerceBilling;
$Sw = WooCommerceBilling::instance();
$F7 = (bool) $Sw->isFormEnabled() ? "\x63\150\145\x63\x6b\x65\x64" : '';
$C1 = $F7 == "\143\x68\145\143\x6b\x65\144" ? '' : "\x68\151\x64\x64\145\x6e";
$yi = $Sw->getOtpTypeEnabled();
$MR = $Sw->getPhoneHTMLTag();
$Lq = $Sw->getEmailHTMLTag();
$Tg = (bool) $Sw->restrictDuplicates() ? "\143\150\145\143\153\x65\x64" : '';
$YG = $Sw->getButtonText();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\151\x65\167\163\57\146\157\162\155\x73\57\x57\157\157\x43\157\x6d\155\x65\x72\143\145\102\x69\x6c\x6c\151\156\147\56\160\150\160";
