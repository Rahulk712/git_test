<?php


use OTP\Handler\Forms\UserProRegistrationForm;
$Sw = UserProRegistrationForm::instance();
$Am = $Sw->isFormEnabled() ? "\143\x68\x65\x63\153\145\x64" : '';
$rb = $Am == "\x63\x68\x65\x63\153\145\144" ? '' : "\x68\151\x64\144\145\x6e";
$pz = $Sw->getOtpTypeEnabled();
$Xy = admin_url() . "\141\144\x6d\x69\156\56\160\x68\x70\x3f\160\x61\x67\145\x3d\x75\163\x65\162\160\x72\157\46\164\141\142\75\146\x69\145\154\144\163";
$aN = $Sw->disableAutoActivation() ? "\143\150\145\x63\x6b\145\144" : '';
$Ld = $Sw->getPhoneHTMLTag();
$Pz = $Sw->getEmailHTMLTag();
$Ra = $Sw->getFormName();
get_plugin_form_link($Sw->getFormDocuments());
include MOV_DIR . "\166\x69\145\167\163\x2f\x66\x6f\x72\x6d\x73\57\x55\163\145\162\x50\162\x6f\x52\x65\147\x69\163\x74\162\x61\x74\x69\157\x6e\106\x6f\x72\x6d\x2e\160\x68\160";
