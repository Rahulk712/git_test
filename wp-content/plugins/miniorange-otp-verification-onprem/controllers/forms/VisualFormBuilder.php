<?php


use OTP\Handler\Forms\VisualFormBuilder;
$Sw = VisualFormBuilder::instance();
$Ds = $Sw->isFormEnabled() ? "\143\150\x65\143\x6b\145\144" : '';
$eQ = $Ds == "\x63\x68\145\x63\x6b\x65\x64" ? '' : "\x68\x69\x64\144\x65\156";
$yM = $Sw->getOtpTypeEnabled();
$dV = admin_url() . "\141\x64\155\151\156\56\x70\150\160\77\160\x61\147\145\x3d\x76\x69\x73\165\x61\x6c\55\x66\x6f\x72\x6d\x2d\142\165\151\154\144\x65\x72";
$RD = $Sw->getFormDetails();
$JA = $Sw->getPhoneHTMLTag();
$hS = $Sw->getEmailHTMLTag();
$YG = $Sw->getButtonText();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\151\x65\x77\163\57\146\157\x72\x6d\163\x2f\x56\151\163\165\x61\154\106\157\162\155\x42\x75\x69\x6c\x64\145\x72\56\160\x68\x70";
