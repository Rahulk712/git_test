<?php


namespace OTP\Helper\Templates;

if (defined("\x41\102\x53\x50\101\x54\110")) {
    goto yi;
}
die;
yi:
use OTP\Objects\MoITemplate;
use OTP\Objects\Template;
use OTP\Traits\Instance;
class ErrorPopup extends Template implements MoITemplate
{
    use Instance;
    protected function __construct()
    {
        $this->key = "\105\x52\122\117\122";
        $this->templateEditorID = "\x63\165\163\x74\157\x6d\x45\155\141\x69\154\x4d\x73\147\x45\144\151\164\157\x72\x34";
        $this->requiredTags = array_diff($this->requiredTags, array("\x7b\173\x46\x4f\x52\115\x5f\x49\x44\x7d\x7d", "\173\x7b\x52\x45\121\x55\x49\x52\105\x44\137\106\x49\x45\114\104\x53\175\x7d"));
        parent::__construct();
    }
    public function getDefaults($fD)
    {
        if (is_array($fD)) {
            goto Tr;
        }
        $fD = array();
        Tr:
        $fD[$this->getTemplateKey()] = file_get_contents(MOV_DIR . "\151\156\x63\154\x75\144\x65\163\57\150\x74\x6d\x6c\57\x65\x72\x72\x6f\162\x2e\155\x69\x6e\56\150\x74\155\x6c");
        return $fD;
    }
    public function parse($b2, $bJ, $e7, $Rw)
    {
        $Rw = $Rw ? "\164\x72\165\145" : "\146\x61\x6c\x73\x65";
        $fO = $this->getRequiredFormsSkeleton($e7, $Rw);
        $b2 = str_replace("\x7b\173\112\121\x55\105\122\131\x7d\175", $this->jqueryUrl, $b2);
        $b2 = str_replace("\x7b\173\x47\117\137\102\x41\103\x4b\137\101\x43\124\111\x4f\x4e\x5f\103\101\x4c\114\x7d\x7d", "\x6d\157\137\x76\x61\154\151\x64\x61\164\x69\157\x6e\137\x67\157\x62\141\x63\x6b\x28\x29\73", $b2);
        $b2 = str_replace("\173\x7b\x4d\x4f\x5f\x43\123\123\x5f\x55\122\x4c\175\x7d", MOV_CSS_URL, $b2);
        $b2 = str_replace("\173\173\x52\x45\x51\125\x49\x52\105\104\137\106\x4f\122\115\x53\x5f\x53\x43\x52\111\x50\124\x53\175\175", $fO, $b2);
        $b2 = str_replace("\173\173\x48\x45\101\x44\105\x52\175\175", mo_("\126\141\154\151\x64\x61\x74\x65\x20\117\124\x50\40\50\117\156\145\40\x54\151\x6d\145\40\120\x61\x73\x73\x63\x6f\x64\x65\x29"), $b2);
        $b2 = str_replace("\173\173\x47\x4f\137\x42\101\x43\x4b\x7d\175", mo_("\46\154\x61\162\x72\73\x20\x47\x6f\x20\x42\x61\x63\153"), $b2);
        $b2 = str_replace("\173\173\x4d\105\123\x53\101\107\x45\x7d\175", mo_($bJ), $b2);
        return $b2;
    }
    private function getRequiredFormsSkeleton($e7, $Rw)
    {
        $dN = "\74\x66\157\x72\155\x20\156\141\x6d\x65\x3d\42\x66\42\40\155\x65\164\x68\157\144\x3d\42\160\x6f\x73\x74\x22\x20\x61\x63\164\x69\157\156\75\x22\x22\40\151\x64\75\42\166\x61\154\151\144\141\164\151\157\156\x5f\x67\x6f\102\141\x63\153\137\x66\x6f\x72\155\42\76\xd\xa\x9\11\11\x3c\151\x6e\160\165\164\40\151\144\x3d\x22\166\x61\x6c\x69\144\x61\x74\x69\x6f\156\137\x67\x6f\x42\x61\143\153\42\x20\156\x61\155\x65\x3d\x22\157\x70\x74\151\157\156\42\40\166\141\154\165\x65\75\x22\166\141\x6c\151\144\141\164\151\x6f\x6e\x5f\x67\x6f\102\x61\x63\x6b\x22\x20\164\171\x70\x65\75\x22\150\x69\x64\x64\145\x6e\42\57\76\xd\12\x9\x9\x3c\x2f\146\x6f\x72\x6d\x3e\173\x7b\x53\x43\x52\x49\120\x54\x53\x7d\x7d";
        $dN = str_replace("\173\173\x53\103\122\x49\x50\124\123\175\x7d", $this->getRequiredScripts(), $dN);
        return $dN;
    }
    private function getRequiredScripts()
    {
        $ts = "\x3c\x73\x74\171\x6c\x65\76\56\x6d\157\137\143\165\163\x74\x6f\x6d\145\162\137\166\x61\x6c\151\x64\141\164\151\157\156\55\x6d\157\x64\141\x6c\173\144\x69\x73\x70\x6c\x61\x79\x3a\142\154\x6f\x63\153\x21\x69\155\x70\157\x72\164\x61\x6e\x74\175\74\57\163\164\x79\154\x65\x3e";
        $ts .= "\x3c\x73\143\162\x69\x70\164\x3e\x66\165\x6e\143\164\x69\x6f\156\x20\x6d\x6f\137\x76\x61\x6c\151\x64\141\x74\x69\157\156\x5f\x67\157\142\x61\143\153\50\51\x7b\144\x6f\143\165\155\145\156\x74\x2e\x67\145\164\x45\154\x65\155\x65\156\164\x42\x79\111\x64\x28\x22\166\x61\x6c\x69\144\x61\x74\151\157\156\x5f\147\x6f\x42\x61\143\x6b\137\x66\x6f\162\x6d\42\x29\56\163\165\x62\155\151\164\x28\x29\175\74\57\163\143\x72\151\160\164\76";
        return $ts;
    }
}
