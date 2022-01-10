<?php


use OTP\Handler\Forms\FormCraftBasicForm;
$Sw = FormCraftBasicForm::instance();
$NF = $Sw->isFormEnabled() ? "\x63\150\145\143\x6b\x65\x64" : '';
$Ts = $NF == "\x63\x68\x65\x63\153\x65\x64" ? '' : "\x68\x69\x64\x64\145\156";
$Ni = $Sw->getOtpTypeEnabled();
$f5 = admin_url() . "\x61\x64\x6d\151\x6e\x2e\x70\x68\x70\77\160\x61\x67\x65\75\x66\157\162\155\143\x72\141\146\x74\137\x62\141\163\151\x63\137\144\x61\163\150\x62\157\x61\162\x64";
$dY = $Sw->getFormDetails();
$Lz = $Sw->getPhoneHTMLTag();
$Bw = $Sw->getEmailHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\x76\151\x65\x77\x73\x2f\146\x6f\x72\155\163\x2f\106\157\x72\155\103\162\141\146\164\x42\141\163\151\x63\x46\157\162\x6d\56\x70\x68\x70";
