<?php


use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Objects\Tabs;
$WK = remove_query_arg(array("\141\x64\x64\157\x6e", "\146\157\162\155"), $_SERVER["\x52\105\121\x55\x45\x53\x54\137\125\122\x49"]);
$bR = add_query_arg(array("\x70\141\147\x65" => $bf->_tabDetails[Tabs::ACCOUNT]->_menuSlug), $WK);
$ad = MoConstants::FAQ_URL;
$ZO = MoMessages::showMessage(MoMessages::REGISTER_WITH_US, array("\165\162\x6c" => $bR));
$kI = MoMessages::showMessage(MoMessages::ACTIVATE_PLUGIN, array("\x75\162\x6c" => $bR));
$aC = $_GET["\x70\x61\x67\x65"];
$G1 = add_query_arg(array("\x70\141\x67\x65" => $bf->_tabDetails[Tabs::PRICING]->_menuSlug), $WK);
include MOV_DIR . "\x76\151\x65\x77\x73\57\x6e\141\x76\x62\x61\x72\x2e\160\150\x70";
