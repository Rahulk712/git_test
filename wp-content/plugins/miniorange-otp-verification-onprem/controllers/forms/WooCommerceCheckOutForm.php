<?php


use OTP\Handler\Forms\WooCommerceCheckOutForm;
$Sw = WooCommerceCheckOutForm::instance();
$FG = $Sw->isFormEnabled() ? "\x63\150\145\x63\x6b\x65\144" : '';
$z6 = $FG == "\143\150\x65\143\153\x65\144" ? '' : "\x68\151\144\144\145\156";
$e8 = $Sw->getOtpTypeEnabled();
$Vm = $Sw->isGuestCheckoutOnlyEnabled() ? "\143\x68\145\143\153\145\144" : '';
$tS = $Sw->showButtonInstead() ? "\x63\150\145\x63\153\145\144" : '';
$za = $Sw->isPopUpEnabled() ? "\143\x68\145\143\153\x65\x64" : '';
$Hd = $Sw->getPaymentMethods();
$Zl = $Sw->isSelectivePaymentEnabled() ? "\x63\x68\145\x63\153\x65\144" : '';
$Hq = $Zl == "\x63\150\x65\143\153\x65\x64" ? '' : "\150\x69\x64\x64\145\156";
$hF = $Sw->getPhoneHTMLTag();
$By = $Sw->getEmailHTMLTag();
$YG = $Sw->getButtonText();
$Ra = $Sw->getFormName();
$QU = $Sw->isAutoLoginDisabled() ? "\x63\x68\x65\143\153\145\144" : '';
$jr = $Sw->restrictDuplicates() ? "\x63\150\x65\x63\x6b\145\144" : '';
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\151\145\x77\x73\57\x66\x6f\162\155\x73\x2f\x57\x6f\x6f\103\x6f\x6d\x6d\145\x72\x63\145\103\150\145\143\153\117\165\164\x46\157\x72\155\56\x70\150\160";
