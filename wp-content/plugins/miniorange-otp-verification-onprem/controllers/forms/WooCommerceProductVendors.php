<?php


use OTP\Handler\Forms\WooCommerceProductVendors;
$Sw = WooCommerceProductVendors::instance();
$Uf = (bool) $Sw->isFormEnabled() ? "\143\x68\145\x63\x6b\x65\x64" : '';
$EA = $Uf == "\143\150\145\x63\153\145\144" ? '' : "\150\151\x64\144\x65\156";
$nC = $Sw->getOtpTypeEnabled();
$sv = (bool) $Sw->restrictDuplicates() ? "\x63\x68\145\143\153\x65\144" : '';
$u3 = $Sw->getPhoneHTMLTag();
$j4 = $Sw->getEmailHTMLTag();
$lC = $Sw->getBothHTMLTag();
$Ra = $Sw->getFormName();
$xm = $Sw->isAjaxForm();
$EY = $xm ? "\143\x68\x65\143\153\145\x64" : '';
$G0 = $Sw->getButtonText();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\x69\x65\167\163\x2f\146\x6f\162\x6d\163\x2f\127\157\157\103\x6f\155\x6d\145\162\x63\145\x50\162\x6f\x64\x75\143\x74\126\145\x6e\144\x6f\x72\163\x2e\160\150\160";
