<?php


use OTP\Handler\Forms\NinjaFormAjaxForm;
$Sw = NinjaFormAjaxForm::instance();
$QS = $Sw->isFormEnabled() ? "\x63\x68\145\143\x6b\145\x64" : '';
$cn = $QS == "\x63\x68\x65\143\153\145\144" ? '' : "\150\x69\x64\144\x65\156";
$aU = $Sw->getOtpTypeEnabled();
$qP = admin_url() . "\x61\144\x6d\151\156\x2e\x70\x68\160\77\160\x61\x67\145\x3d\x6e\151\156\x6a\x61\x2d\x66\x6f\162\x6d\163";
$dW = $Sw->getFormDetails();
$SQ = $Sw->getPhoneHTMLTag();
$AJ = $Sw->getEmailHTMLTag();
$YG = $Sw->getButtonText();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\151\x65\167\163\57\x66\157\x72\155\x73\57\x4e\x69\156\x6a\x61\106\157\162\155\101\152\x61\x78\x46\157\x72\x6d\56\160\150\x70";
