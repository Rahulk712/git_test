<?php


use OTP\Handler\Forms\WooCommerceRegistrationForm;
use OTP\Helper\MoUtility;
$Sw = WooCommerceRegistrationForm::instance();
$YN = (bool) $Sw->isFormEnabled() ? "\x63\x68\145\x63\x6b\145\x64" : '';
$ib = $YN == "\x63\150\145\x63\153\145\x64" ? '' : "\x68\151\144\x64\x65\156";
$HG = $Sw->getOtpTypeEnabled();
$Tg = (bool) $Sw->restrictDuplicates() ? "\x63\150\145\x63\x6b\145\x64" : '';
$uu = $Sw->getPhoneHTMLTag();
$Ii = $Sw->getEmailHTMLTag();
$nD = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
$DB = $Sw->redirectToPage();
$bO = MoUtility::isBlank($DB) ? '' : get_page_by_title($DB)->ID;
$xm = $Sw->isAjaxForm();
$EY = $xm ? "\143\150\145\143\153\x65\x64" : '';
$es = $Sw->getButtonText();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\151\145\167\x73\57\146\157\162\155\x73\57\127\157\157\103\x6f\155\155\145\x72\143\145\122\x65\147\x69\163\x74\x72\x61\x74\151\x6f\156\x46\x6f\x72\x6d\56\160\x68\x70";
