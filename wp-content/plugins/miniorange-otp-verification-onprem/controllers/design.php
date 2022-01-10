<?php


use OTP\Helper\Templates\DefaultPopup;
use OTP\Helper\Templates\ErrorPopup;
use OTP\Helper\Templates\ExternalPopup;
use OTP\Helper\Templates\UserChoicePopup;
use OTP\Objects\Template;
$FU = DefaultPopup::instance();
$O4 = UserChoicePopup::instance();
$UH = ExternalPopup::instance();
$l3 = ErrorPopup::instance();
$oD = $FU->getNonceValue();
$nG = $FU->getTemplateKey();
$Z3 = $O4->getTemplateKey();
$OP = $UH->getTemplateKey();
$QN = $l3->getTemplateKey();
$at = maybe_unserialize(get_mo_option("\143\165\163\164\x6f\x6d\x5f\160\x6f\160\165\160\163"));
$L1 = $at[$FU->getTemplateKey()];
$ck = $at[$UH->getTemplateKey()];
$qH = $at[$O4->getTemplateKey()];
$F8 = $at[$l3->getTemplateKey()];
$rN = Template::$templateEditor;
$OX = $FU->getTemplateEditorId();
$u1 = array_merge($rN, array("\x74\x65\170\x74\x61\162\x65\x61\x5f\156\x61\155\x65" => $OX, "\x65\x64\151\x74\157\162\x5f\x68\x65\151\x67\150\x74" => 400));
$GM = $O4->getTemplateEditorId();
$t7 = array_merge($rN, array("\164\145\x78\x74\x61\162\145\141\x5f\156\x61\x6d\145" => $GM, "\x65\144\151\164\x6f\162\137\x68\145\x69\147\150\164" => 400));
$Bd = $UH->getTemplateEditorId();
$r5 = array_merge($rN, array("\164\145\170\x74\x61\x72\x65\141\x5f\156\141\155\x65" => $Bd, "\x65\x64\151\x74\157\x72\x5f\x68\145\151\x67\150\164" => 400));
$VU = $l3->getTemplateEditorId();
$vC = array_merge($rN, array("\x74\145\170\164\x61\x72\x65\141\x5f\156\141\155\x65" => $VU, "\145\144\151\164\x6f\162\137\x68\145\x69\x67\150\164" => 400));
$mB = str_replace("\x7b\173\103\x4f\x4e\124\x45\x4e\124\175\x7d", "\x3c\151\155\147\x20\163\162\143\75\47" . MOV_LOADER_URL . "\47\x3e", $FU->paneContent);
$g1 = "\74\x73\x70\x61\x6e\40\x73\x74\171\x6c\x65\75\x27\146\157\x6e\164\55\x73\x69\172\145\72\x20\x31\56\x33\x65\155\x3b\47\76" . "\120\x52\105\x56\111\105\x57\x20\120\x41\116\x45\74\142\x72\57\x3e\74\x62\x72\x2f\x3e" . "\x3c\57\163\160\x61\156\x3e" . "\74\163\x70\x61\156\x3e" . "\x43\x6c\151\x63\153\40\157\156\x20\x74\x68\x65\40\120\162\x65\166\151\145\167\40\x62\x75\x74\x74\x6f\x6e\x20\x61\142\157\x76\145\40\x74\x6f\40\x63\150\145\143\153\40\x68\157\x77\40\171\157\x75\x72\40\160\x6f\160\165\x70\x20\x77\157\x75\x6c\144\x20\154\x6f\x6f\153\x20\x6c\x69\x6b\x65\x2e" . "\74\x2f\x73\160\141\156\76";
$g1 = str_replace("\173\x7b\x4d\x45\x53\x53\x41\107\105\x7d\175", $g1, $FU->messageDiv);
$bJ = str_replace("\173\x7b\103\x4f\x4e\x54\105\x4e\124\175\175", $g1, $FU->paneContent);
include MOV_DIR . "\166\151\145\167\x73\x2f\144\145\x73\x69\x67\156\56\160\150\160";
