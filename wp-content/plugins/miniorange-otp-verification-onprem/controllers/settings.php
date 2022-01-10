<?php


use OTP\Helper\MoConstants;
use OTP\Helper\MoUtility;
use OTP\Objects\PluginPageDetails;
use OTP\Objects\Tabs;
$Rv = admin_url() . "\145\144\151\164\56\x70\150\160\77\160\x6f\x73\x74\137\x74\x79\x70\x65\75\160\141\147\145";
$kW = MoUtility::micv() ? "\167\x70\137\x6f\164\160\137\x76\x65\x72\151\146\151\x63\x61\x74\x69\x6f\x6e\137\x75\160\147\162\141\144\145\137\x70\154\x61\156" : "\x77\160\137\x6f\x74\160\137\x76\145\x72\151\146\151\143\x61\x74\x69\157\156\137\x62\x61\163\151\x63\137\160\x6c\141\156";
$oD = $ec->getNonceValue();
$bW = add_query_arg(array("\x70\x61\147\x65" => $bf->_tabDetails[Tabs::FORMS]->_menuSlug, "\146\157\x72\155" => "\143\157\x6e\x66\151\x67\165\x72\x65\144\x5f\146\157\x72\x6d\163\x23\x63\x6f\156\x66\x69\147\165\162\x65\144\x5f\x66\x6f\x72\x6d\163"));
$Qz = add_query_arg("\x70\x61\147\x65", $bf->_tabDetails[Tabs::FORMS]->_menuSlug . "\43\x66\x6f\162\155\137\163\x65\x61\x72\x63\x68", remove_query_arg(array("\146\157\x72\x6d")));
$bz = isset($_GET["\x66\157\162\x6d"]) ? $_GET["\146\x6f\162\x6d"] : false;
$ai = $bz == "\143\157\156\146\151\147\x75\x72\145\144\x5f\146\x6f\162\x6d\163";
$oJ = $bf->_tabDetails[Tabs::OTP_SETTINGS];
$W3 = $oJ->_url;
$Ef = $bf->_tabDetails[Tabs::SMS_EMAIL_CONFIG];
$ql = $Ef->_url;
$Lv = $bf->_tabDetails[Tabs::DESIGN];
$zY = $Lv->_url;
$SM = $bf->_tabDetails[Tabs::ADD_ONS];
$sk = $SM->_url;
$N8 = MoConstants::FEEDBACK_EMAIL;
include MOV_DIR . "\166\151\x65\167\x73\x2f\163\145\x74\164\x69\156\147\x73\56\x70\150\160";
include MOV_DIR . "\166\151\x65\x77\163\57\x69\x6e\x73\x74\x72\165\x63\x74\151\x6f\156\x73\x2e\x70\150\x70";
