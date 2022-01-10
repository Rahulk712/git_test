<?php


namespace OTP\Objects;

use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;
if (defined("\x41\102\x53\x50\x41\124\110")) {
    goto pn;
}
die;
pn:
abstract class Template extends BaseActionHandler implements MoITemplate
{
    protected $key;
    protected $templateEditorID;
    protected $nonce;
    protected $preview = FALSE;
    protected $jqueryUrl;
    protected $img;
    public $paneContent;
    public $messageDiv;
    protected $successMessageDiv;
    public static $templateEditor = array("\x77\160\141\x75\x74\x6f\x70" => false, "\x6d\x65\x64\x69\141\137\142\165\164\x74\x6f\x6e\163" => false, "\164\x65\170\164\x61\162\x65\x61\x5f\162\x6f\167\x73" => 20, "\x74\141\x62\x69\156\144\x65\x78" => '', "\x74\x61\x62\x66\x6f\143\x75\x73\x5f\x65\x6c\x65\x6d\145\x6e\164\x73" => "\72\160\x72\x65\166\x2c\x3a\x6e\x65\170\164", "\145\x64\151\x74\157\x72\x5f\143\163\x73" => '', "\x65\x64\x69\x74\x6f\162\x5f\x63\x6c\141\163\x73" => '', "\164\145\145\156\171" => false, "\x64\146\x77" => false, "\x74\151\156\x79\x6d\143\145" => false, "\x71\x75\151\x63\x6b\x74\x61\x67\163" => true);
    protected $requiredTags = array("\x7b\173\x4a\x51\125\x45\x52\x59\x7d\175", "\173\x7b\x47\117\x5f\102\101\x43\113\137\101\103\x54\x49\117\116\137\103\x41\x4c\x4c\175\x7d", "\173\x7b\106\x4f\x52\115\137\111\104\x7d\175", "\x7b\173\122\x45\x51\125\111\122\x45\104\x5f\x46\111\x45\114\104\123\175\175", "\x7b\173\122\x45\121\125\111\x52\x45\x44\x5f\x46\117\x52\115\123\137\123\x43\x52\111\x50\x54\x53\x7d\175");
    protected function __construct()
    {
        parent::__construct();
        $this->jqueryUrl = "\x3c\163\143\162\151\160\x74\x20\163\x72\143\75\42\150\x74\x74\160\x73\x3a\57\57\x61\152\x61\170\x2e\x67\x6f\x6f\x67\154\145\x61\160\x69\x73\x2e\143\157\155\x2f\141\152\141\170\57\x6c\151\142\163\x2f\x6a\x71\x75\x65\162\x79\x2f\61\x2e\x31\62\56\x34\57\152\161\165\x65\x72\171\x2e\155\x69\156\x2e\152\x73\42\x3e\x3c\x2f\x73\143\x72\x69\x70\164\76";
        $this->img = "\x3c\144\x69\x76\40\x73\x74\171\x6c\145\75\x27\x64\151\163\x70\x6c\x61\x79\72\x74\x61\x62\154\x65\73\x74\145\170\x74\x2d\x61\x6c\151\147\156\x3a\x63\x65\x6e\x74\145\x72\73\x27\76" . "\x3c\x69\155\x67\x20\163\162\143\x3d\x27\173\173\x4c\x4f\101\104\105\122\x5f\x43\123\126\x7d\175\x27\76" . "\74\57\x64\151\x76\76";
        $this->paneContent = "\x3c\x64\x69\x76\40\163\x74\x79\x6c\145\x3d\x27\164\145\170\x74\x2d\x61\154\x69\147\x6e\72\x63\x65\x6e\x74\145\162\x3b\167\x69\144\164\x68\72\40\x31\x30\60\45\73\150\x65\x69\x67\x68\x74\72\x20\x34\x35\60\x70\170\x3b\x64\x69\x73\160\x6c\x61\x79\x3a\x20\x62\x6c\157\x63\153\73" . "\155\x61\x72\147\x69\x6e\x2d\164\157\x70\72\40\x34\60\x25\73\166\145\x72\164\x69\143\x61\x6c\55\141\154\x69\x67\x6e\72\40\x6d\x69\x64\144\154\145\73\47\x3e" . "\173\173\x43\117\116\x54\105\x4e\124\175\x7d" . "\x3c\57\x64\151\166\76";
        $this->messageDiv = "\x3c\144\151\x76\x20\163\x74\x79\154\x65\x3d\47\x66\x6f\156\x74\x2d\163\x74\x79\x6c\x65\x3a\40\x69\164\141\x6c\x69\143\x3b\x66\157\x6e\x74\x2d\167\145\151\x67\x68\x74\x3a\x20\66\60\60\x3b\x63\157\x6c\157\x72\x3a\x20\x23\x32\x33\x32\x38\62\x64\x3b" . "\x66\x6f\x6e\164\x2d\x66\141\155\151\154\x79\x3a\123\145\x67\157\x65\x20\125\111\x2c\x48\x65\x6c\x76\x65\164\x69\143\x61\40\116\x65\x75\145\x2c\x73\141\x6e\163\x2d\163\x65\x72\x69\146\x3b" . "\143\157\154\157\x72\72\43\71\64\62\70\x32\70\73\x27\x3e" . "\173\173\x4d\105\123\x53\x41\107\105\175\x7d" . "\74\x2f\x64\x69\166\76";
        $this->successMessageDiv = "\x3c\x64\x69\x76\40\x73\x74\x79\x6c\145\75\47\146\157\x6e\164\x2d\x73\x74\171\154\x65\72\x20\151\164\x61\154\x69\143\x3b\x66\157\156\x74\55\x77\x65\151\x67\150\x74\x3a\40\66\x30\60\73\143\x6f\154\x6f\162\x3a\40\x23\62\63\x32\70\62\x64\x3b" . "\146\157\x6e\164\55\146\141\x6d\x69\x6c\171\72\123\145\147\x6f\x65\x20\x55\111\x2c\110\x65\154\166\145\164\x69\x63\x61\40\x4e\145\x75\x65\x2c\x73\141\x6e\163\55\x73\145\x72\151\x66\73\x63\x6f\x6c\x6f\x72\x3a\x23\61\63\70\141\x33\x64\x3b\47\x3e" . "\x7b\173\x4d\x45\x53\x53\x41\107\105\175\175" . "\74\x2f\x64\151\x76\x3e";
        $this->img = str_replace("\173\173\114\117\x41\104\105\x52\137\103\x53\x56\175\x7d", MOV_LOADER_URL, $this->img);
        $this->_nonce = "\155\x6f\x5f\x70\157\160\165\160\x5f\x6f\160\x74\151\x6f\x6e\163";
        add_filter("\155\157\x5f\164\x65\x6d\x70\154\x61\x74\x65\137\x64\145\146\x61\x75\x6c\164\x73", array($this, "\147\145\164\x44\145\x66\x61\165\x6c\164\163"), 1, 1);
        add_filter("\x6d\x6f\137\x74\145\155\160\x6c\x61\164\145\x5f\x62\x75\151\x6c\x64", array($this, "\x62\x75\x69\154\144"), 1, 5);
        add_action("\141\x64\x6d\151\156\137\160\157\163\164\x5f\155\x6f\x5f\160\x72\x65\x76\151\145\167\137\x70\157\x70\165\x70", array($this, "\x73\x68\157\167\120\162\145\166\151\x65\x77"));
        add_action("\141\x64\155\x69\x6e\137\160\157\x73\164\x5f\155\x6f\137\160\157\160\165\x70\137\x73\x61\166\145", array($this, "\163\141\166\145\120\x6f\x70\x75\160"));
    }
    public function showPreview()
    {
        if (!(array_key_exists("\160\157\160\x75\x70\164\171\160\x65", $_POST) && $_POST["\x70\x6f\x70\165\x70\164\171\x70\145"] != $this->getTemplateKey())) {
            goto L_;
        }
        return;
        L_:
        if ($this->isValidRequest()) {
            goto pV;
        }
        return;
        pV:
        $bJ = "\x3c\x69\x3e" . mo_("\x50\157\160\125\160\40\x4d\x65\x73\x73\141\x67\x65\x20\163\150\157\x77\x73\40\x75\160\x20\150\145\162\145\x2e") . "\x3c\57\151\76";
        $e7 = VerificationType::TEST;
        $b2 = stripslashes($_POST[$this->getTemplateEditorId()]);
        $Rw = false;
        $this->preview = TRUE;
        wp_send_json(MoUtility::createJson($this->parse($b2, $bJ, $e7, $Rw), MoConstants::SUCCESS_JSON_TYPE));
    }
    public function savePopup()
    {
        if (!(!$this->isTemplateType() || !$this->isValidRequest())) {
            goto EC;
        }
        return;
        EC:
        $b2 = stripslashes($_POST[$this->getTemplateEditorId()]);
        $this->validateRequiredFields($b2);
        $at = maybe_unserialize(get_mo_option("\143\165\x73\164\x6f\155\x5f\x70\x6f\160\x75\160\163"));
        $at[$this->getTemplateKey()] = $b2;
        update_mo_option("\x63\x75\163\x74\157\155\137\160\x6f\160\165\160\x73", $at);
        wp_send_json(MoUtility::createJson($this->showSuccessMessage(MoMessages::showMessage(MoMessages::TEMPLATE_SAVED)), MoConstants::SUCCESS_JSON_TYPE));
    }
    public function build($b2, $ZL, $bJ, $e7, $Rw)
    {
        if (!(strcasecmp($ZL, $this->getTemplateKey()) != 0)) {
            goto Eh;
        }
        return $b2;
        Eh:
        $at = maybe_unserialize(get_mo_option("\x63\x75\x73\x74\x6f\155\137\160\x6f\x70\x75\x70\163"));
        $b2 = $at[$this->getTemplateKey()];
        return $this->parse($b2, $bJ, $e7, $Rw);
    }
    protected function validateRequiredFields($b2)
    {
        foreach ($this->requiredTags as $sm) {
            if (!(strpos($b2, $sm) === FALSE)) {
                goto OV;
            }
            $bJ = str_replace("\173\173\115\105\x53\123\x41\x47\105\175\x7d", MoMessages::showMessage(MoMessages::REQUIRED_TAGS, array("\124\101\x47" => $sm)), $this->messageDiv);
            wp_send_json(MoUtility::createJson(str_replace("\173\x7b\103\117\x4e\124\105\116\124\x7d\175", $bJ, $this->paneContent), MoConstants::ERROR_JSON_TYPE));
            OV:
            Lm:
        }
        QQ:
    }
    protected function showSuccessMessage($bJ)
    {
        $bJ = str_replace("\173\173\x4d\105\123\x53\101\x47\105\x7d\175", $bJ, $this->successMessageDiv);
        return str_replace("\x7b\x7b\x43\x4f\x4e\x54\105\116\x54\175\x7d", $bJ, $this->paneContent);
    }
    protected function showMessage($bJ)
    {
        $bJ = str_replace("\x7b\x7b\x4d\x45\123\x53\101\x47\x45\175\175", $bJ, $this->messageDiv);
        return str_replace("\x7b\173\x43\x4f\116\x54\105\116\x54\x7d\175", $bJ, $this->paneContent);
    }
    protected function isTemplateType()
    {
        return array_key_exists("\x70\157\160\x75\160\164\171\160\145", $_POST) && strcasecmp($_POST["\160\x6f\x70\x75\x70\x74\x79\x70\x65"], $this->getTemplateKey()) == 0;
    }
    public function getTemplateKey()
    {
        return $this->key;
    }
    public function getTemplateEditorId()
    {
        return $this->templateEditorID;
    }
}
