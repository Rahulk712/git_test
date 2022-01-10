<?php


namespace OTP\Helper\Templates;

if (defined("\x41\x42\x53\x50\x41\124\x48")) {
    goto U9;
}
die;
U9:
use OTP\Objects\MoITemplate;
use OTP\Objects\Template;
use OTP\Traits\Instance;
class ExternalPopup extends Template implements MoITemplate
{
    use Instance;
    protected function __construct()
    {
        $this->key = "\x45\130\124\x45\122\116\101\x4c";
        $this->templateEditorID = "\143\x75\163\x74\x6f\x6d\105\x6d\141\x69\x6c\x4d\x73\147\105\144\151\164\157\x72\63";
        $this->requiredTags = array_merge($this->requiredTags, array("\x7b\x7b\120\x48\117\116\x45\x5f\106\111\x45\x4c\x44\x5f\x4e\x41\x4d\105\x7d\x7d", "\x7b\x7b\x53\x45\x4e\x44\x5f\x4f\124\x50\137\102\124\x4e\137\111\x44\x7d\x7d", "\173\173\x56\x45\x52\111\x46\x49\103\101\124\111\117\x4e\137\x46\111\105\114\x44\137\x4e\101\x4d\x45\175\175", "\x7b\x7b\126\101\114\111\104\x41\124\x45\137\102\124\x4e\137\111\x44\x7d\x7d", "\x7b\173\123\105\x4e\104\137\x4f\124\120\137\x42\124\116\x5f\111\104\x7d\175", "\x7b\x7b\x56\105\x52\x49\106\131\x5f\x43\x4f\x44\x45\x5f\x42\117\x58\175\x7d"));
        parent::__construct();
    }
    public function getDefaults($fD)
    {
        if (is_array($fD)) {
            goto ZD;
        }
        $fD = array();
        ZD:
        $fD[$this->getTemplateKey()] = file_get_contents(MOV_DIR . "\x69\156\143\x6c\165\x64\145\163\x2f\150\x74\x6d\154\x2f\x65\x78\x74\145\x72\x6e\141\x6c\x70\x68\x6f\156\145\x2e\x6d\151\x6e\56\x68\x74\x6d\154");
        return $fD;
    }
    public function parse($b2, $bJ, $e7, $Rw)
    {
        $fO = $this->getRequiredScripts();
        $wI = $this->preview ? '' : extra_post_data();
        $un = "\x3c\x69\x6e\160\165\164\40\164\171\x70\145\75\x22\x68\151\144\x64\x65\x6e\42\x20\156\x61\x6d\x65\75\x22\x6f\160\x74\x69\x6f\156\42\x20\166\141\154\165\x65\x3d\42\x6d\x6f\x5f\141\x6a\141\170\x5f\x66\157\162\x6d\137\x76\141\x6c\151\144\x61\x74\x65\x22\40\57\76";
        $b2 = str_replace("\x7b\173\x4a\x51\125\x45\x52\x59\175\x7d", $this->jqueryUrl, $b2);
        $b2 = str_replace("\x7b\x7b\x46\117\122\115\x5f\111\104\x7d\x7d", "\x6d\157\137\x76\x61\154\151\144\141\164\145\137\x66\x6f\x72\x6d", $b2);
        $b2 = str_replace("\173\x7b\107\117\x5f\x42\x41\103\113\137\101\x43\124\x49\117\x4e\137\x43\101\x4c\x4c\175\175", "\x6d\x6f\137\166\x61\154\151\144\x61\164\x69\x6f\x6e\x5f\x67\x6f\x62\141\143\x6b\x28\x29\x3b", $b2);
        $b2 = str_replace("\173\x7b\115\x4f\137\x43\123\x53\x5f\x55\x52\x4c\x7d\175", MOV_CSS_URL, $b2);
        $b2 = str_replace("\x7b\x7b\117\x54\x50\x5f\x4d\x45\123\x53\x41\x47\105\x5f\102\x4f\x58\x7d\175", "\155\x6f\137\x6d\145\x73\x73\141\x67\145", $b2);
        $b2 = str_replace("\x7b\x7b\x52\105\121\125\111\x52\x45\x44\x5f\x46\117\x52\115\x53\137\x53\x43\x52\111\120\x54\x53\x7d\x7d", $fO, $b2);
        $b2 = str_replace("\173\x7b\x48\105\x41\104\x45\122\x7d\x7d", mo_("\x56\141\154\151\144\x61\164\x65\x20\117\124\x50\x20\50\x4f\x6e\145\40\x54\151\x6d\x65\x20\120\x61\163\x73\x63\x6f\x64\145\51"), $b2);
        $b2 = str_replace("\173\x7b\x47\x4f\x5f\102\101\103\113\x7d\x7d", mo_("\46\154\x61\x72\x72\73\40\107\157\x20\102\141\143\x6b"), $b2);
        $b2 = str_replace("\x7b\x7b\x4d\105\123\x53\x41\107\x45\175\175", mo_($bJ), $b2);
        $b2 = str_replace("\173\173\x52\105\x51\x55\111\122\105\104\x5f\x46\x49\x45\114\x44\123\175\175", $un, $b2);
        $b2 = str_replace("\173\173\120\x48\117\x4e\105\x5f\x46\x49\x45\x4c\104\137\x4e\x41\x4d\x45\x7d\x7d", "\x6d\157\x5f\160\150\x6f\156\x65\x5f\x6e\165\x6d\142\145\162", $b2);
        $b2 = str_replace("\x7b\x7b\x4f\124\120\x5f\x46\x49\x45\114\104\137\124\x49\x54\x4c\105\175\x7d", mo_("\x4f\x6e\x6c\171\x20\144\151\147\x69\164\x73\x20\167\151\x74\150\x69\x6e\40\162\x61\x6e\x67\x65\40\x34\x2d\70\40\141\x72\x65\40\141\154\x6c\157\x77\145\x64\x2e"), $b2);
        $b2 = str_replace("\173\173\x56\x45\122\x49\x46\x59\x5f\103\117\104\x45\x5f\x42\117\130\x7d\x7d", "\x6d\x6f\x5f\x76\141\x6c\151\x64\x61\164\x65\x5f\157\164\160", $b2);
        $b2 = str_replace("\x7b\173\126\x45\122\x49\x46\x49\103\x41\124\111\117\116\x5f\106\111\x45\114\x44\137\x4e\x41\x4d\105\x7d\175", "\x6d\x6f\137\157\x74\x70\137\x74\x6f\153\145\x6e", $b2);
        $b2 = str_replace("\x7b\x7b\x56\101\x4c\111\104\x41\124\x45\x5f\102\x54\116\137\111\x44\x7d\x7d", "\x76\x61\x6c\151\144\141\x74\145\137\x6f\x74\160", $b2);
        $b2 = str_replace("\x7b\173\x56\101\114\111\x44\101\124\105\137\102\125\x54\x54\117\116\x5f\x54\x45\130\x54\175\x7d", mo_("\126\141\x6c\151\x64\x61\x74\145"), $b2);
        $b2 = str_replace("\173\173\123\x45\x4e\x44\x5f\x4f\x54\x50\x5f\124\x45\x58\124\175\175", mo_("\x53\x65\x6e\144\x20\117\124\120"), $b2);
        $b2 = str_replace("\173\x7b\x53\x45\x4e\x44\137\x4f\x54\120\137\102\124\116\x5f\111\104\175\x7d", "\x73\x65\156\x64\137\157\x74\x70", $b2);
        $b2 = str_replace("\x7b\173\x45\x58\x54\x52\101\x5f\x50\117\123\x54\137\x44\101\x54\x41\x7d\175", $wI, $b2);
        $b2 .= $this->getExtraFormFields();
        return $b2;
    }
    private function getExtraFormFields()
    {
        $sx = "\x3c\146\157\162\x6d\x20\156\x61\x6d\145\x3d\42\x66\x22\x20\x6d\x65\x74\x68\x6f\144\x3d\x22\160\157\163\164\42\x20\141\x63\x74\151\x6f\156\75\x22\x22\x20\x69\144\x3d\42\166\141\x6c\151\144\x61\x74\x69\x6f\156\137\x67\157\x42\141\x63\153\137\x66\x6f\x72\x6d\x22\x3e\15\xa\40\x20\x20\x20\40\40\40\40\x20\x20\40\x20\40\x20\x20\x20\x20\x20\40\40\x20\x20\40\x20\74\x69\156\160\x75\164\40\151\x64\75\42\166\x61\154\x69\144\141\164\151\157\x6e\x5f\x67\x6f\102\141\x63\153\x22\40\156\141\155\x65\x3d\x22\x6f\160\x74\151\157\x6e\42\x20\x76\x61\x6c\x75\x65\x3d\x22\166\141\154\x69\x64\x61\164\x69\157\x6e\137\x67\157\102\141\x63\x6b\42\x20\164\x79\x70\x65\75\42\x68\x69\x64\144\145\x6e\x22\57\76\15\12\x20\40\x20\40\40\40\40\40\40\40\x20\40\x20\x20\x20\x20\40\x20\x20\40\74\x2f\x66\x6f\x72\x6d\76";
        return $sx;
    }
    private function getRequiredScripts()
    {
        $ts = "\74\x73\164\171\x6c\x65\76\x2e\155\x6f\x5f\x63\x75\163\164\157\x6d\145\162\137\x76\141\154\151\x64\141\x74\x69\157\x6e\55\x6d\x6f\x64\x61\154\x7b\x64\x69\163\x70\x6c\141\171\x3a\x62\x6c\157\x63\153\x21\x69\x6d\160\x6f\x72\x74\141\x6e\x74\x7d\74\x2f\163\164\171\154\145\76";
        if (!$this->preview) {
            goto Nl;
        }
        $ts .= "\x3c\x73\143\x72\151\x70\x74\76" . "\x24\155\157\x3d\152\x51\x75\145\162\x79\x2c" . "\44\155\157\x28\x22\x23\155\x6f\137\166\141\x6c\x69\x64\141\x74\x65\137\146\157\162\x6d\x22\x29\56\x73\x75\142\x6d\x69\x74\50\x66\165\156\143\x74\151\x6f\156\x28\145\x29\x7b" . "\x65\x2e\160\162\x65\166\145\x6e\164\104\145\146\x61\x75\154\x74\50\51\x3b" . "\175\x29\73" . "\74\x2f\163\x63\x72\x69\x70\x74\76";
        goto i2;
        Nl:
        $ts .= "\74\x73\x63\x72\x69\160\164\x3e\x66\x75\156\x63\x74\x69\x6f\x6e\40\155\157\x5f\166\141\154\x69\x64\141\164\151\x6f\x6e\137\147\157\142\141\x63\153\50\51\173\xd\xa\x20\40\40\x20\40\x20\x20\x20\x20\40\40\x20\40\40\40\144\157\x63\x75\155\x65\x6e\x74\56\147\145\164\x45\x6c\x65\155\145\x6e\x74\102\x79\111\144\50\42\166\x61\154\151\x64\141\164\x69\x6f\x6e\x5f\147\157\x42\x61\143\153\137\x66\157\162\x6d\x22\51\x2e\163\165\x62\x6d\x69\164\x28\51\x7d\73" . "\152\x51\x75\x65\162\x79\50\144\157\143\x75\155\x65\156\164\x29\56\x72\x65\141\144\x79\50\146\x75\x6e\x63\164\151\157\156\x28\51\173" . "\44\x6d\157\x3d\x6a\x51\165\x65\x72\171\x2c" . "\44\x6d\157\50\x22\x23\x73\x65\156\144\137\157\x74\160\42\51\x2e\x63\x6c\151\x63\153\50\146\x75\x6e\143\164\x69\x6f\156\x28\157\x29\x7b" . "\166\141\162\x20\x65\x3d\x24\155\157\x28\42\x69\x6e\160\165\164\133\x6e\x61\155\x65\75\x6d\x6f\137\x70\x68\157\156\145\x5f\x6e\165\x6d\x62\145\162\135\42\51\x2e\166\141\x6c\x28\51\73" . "\x24\x6d\x6f\x28\x22\43\x6d\x6f\x5f\155\x65\163\x73\x61\x67\x65\42\51\x2e\145\x6d\160\x74\171\x28\x29\x2c" . "\44\155\157\x28\x22\x23\155\157\x5f\155\145\163\163\x61\147\x65\42\x29\56\x61\x70\160\145\x6e\144\50\x22" . $this->img . "\x22\x29\54" . "\44\155\157\x28\42\x23\x6d\x6f\137\x6d\145\163\x73\141\x67\145\x22\51\x2e\163\x68\157\167\x28\x29\54" . "\44\x6d\157\x2e\141\x6a\x61\170\50\173" . "\165\x72\154\x3a\x22" . site_url() . "\57\77\157\160\x74\x69\x6f\156\x3d\x6d\x69\x6e\151\157\162\x61\156\x67\145\x2d\141\x6a\141\170\55\157\164\160\x2d\147\145\x6e\145\x72\x61\x74\145\42\x2c" . "\164\x79\160\145\72\42\x50\117\123\124\x22\54" . "\144\141\x74\x61\x3a\173\x75\x73\x65\162\x5f\160\150\157\x6e\x65\72\145\x7d\54" . "\x63\x72\x6f\x73\x73\x44\x6f\x6d\141\151\x6e\72\41\x30\x2c" . "\x64\x61\x74\141\124\171\x70\x65\x3a\42\x6a\163\157\x6e\x22\54\15\xa\40\40\40\40\40\40\40\x20\x20\40\40\x20\40\x20\40\40\40\x20\x20\40\40\x20\x20\40\40\x20\x20\40\40\40\40\40\163\165\143\x63\x65\163\163\72\x66\165\x6e\143\x74\151\x6f\156\x28\157\x29\173" . "\42\163\165\x63\x63\145\163\163\42\x3d\75\157\56\x72\145\163\x75\x6c\164\x3f\x28" . "\44\155\x6f\x28\x22\43\x6d\157\137\155\145\163\x73\x61\147\x65\42\x29\56\145\155\160\164\171\50\51\x2c" . "\44\x6d\x6f\x28\x22\43\x6d\157\137\155\x65\x73\x73\141\x67\x65\42\x29\56\141\x70\160\145\x6e\144\x28\157\56\x6d\x65\163\163\x61\147\x65\51\x2c" . "\x24\155\x6f\x28\x22\43\155\x6f\x5f\x6d\x65\163\x73\141\x67\x65\42\51\x2e\143\x73\163\50\x22\142\x61\x63\153\147\162\157\165\x6e\x64\55\x63\x6f\x6c\157\x72\x22\54\42\x23\x38\145\145\x64\x38\x65\42\51\x2c" . "\44\x6d\x6f\50\42\43\x76\x61\154\x69\144\141\164\145\137\x6f\x74\160\x22\x29\56\x73\x68\x6f\x77\x28\x29\x2c" . "\44\155\x6f\x28\42\x23\x73\x65\x6e\x64\x5f\157\x74\x70\x22\x29\56\x76\x61\154\x28\42" . mo_("\122\x65\x73\x65\x6e\x64\x20\117\x54\x50") . "\42\51\x2c" . "\44\155\157\50\42\x23\x6d\157\137\x76\x61\x6c\x69\144\141\x74\x65\137\x6f\164\x70\x22\51\x2e\163\150\x6f\x77\x28\x29\54" . "\44\x6d\157\50\42\x69\x6e\x70\x75\164\133\156\x61\155\145\x3d\155\157\137\x76\x61\x6c\151\144\141\164\145\137\x6f\x74\160\135\x22\51\x2e\146\x6f\143\165\x73\50\x29" . "\x29\x3a\50" . "\44\x6d\x6f\x28\42\43\x6d\x6f\137\155\145\163\163\141\147\145\42\x29\x2e\145\155\160\x74\x79\x28\51\54" . "\44\155\157\x28\x22\x23\x6d\x6f\x5f\155\145\163\163\141\147\x65\42\51\56\x61\x70\x70\145\156\x64\x28\157\56\155\x65\163\x73\x61\x67\145\x29\x2c" . "\44\155\157\x28\42\43\155\x6f\137\x6d\145\163\x73\141\147\x65\x22\51\x2e\x63\163\x73\x28\x22\142\141\143\153\147\x72\157\165\x6e\x64\x2d\x63\157\154\x6f\x72\x22\54\42\43\x65\144\141\x35\x38\x65\42\51\54" . "\44\155\x6f\x28\x22\x69\x6e\160\x75\164\133\x6e\x61\155\145\75\x6d\157\x5f\160\x68\157\x6e\x65\137\156\x75\x6d\x62\x65\162\x5d\42\x29\56\x66\x6f\143\165\163\x28\51" . "\x29" . "\175\x2c" . "\145\x72\x72\x6f\x72\72\x66\x75\x6e\143\x74\x69\x6f\156\x28\x6f\x2c\145\54\x6d\x29\x7b\175" . "\175\x29" . "\x7d\51\x2c" . "\x24\x6d\x6f\50\x22\43\166\x61\x6c\151\144\x61\164\x65\137\157\164\160\x22\x29\56\143\x6c\x69\x63\153\50\x66\x75\x6e\x63\164\x69\157\x6e\50\157\51\x7b" . "\x76\x61\162\40\145\x3d\44\155\157\50\x22\151\x6e\160\x75\x74\133\156\141\x6d\x65\75\155\x6f\137\157\164\x70\x5f\x74\157\x6b\x65\x6e\135\42\51\56\166\141\x6c\x28\51\x2c" . "\x6d\75\x24\x6d\157\x28\x22\151\x6e\x70\165\164\133\x6e\x61\x6d\x65\75\x6d\x6f\x5f\x70\150\x6f\156\x65\137\156\x75\x6d\x62\145\162\x5d\42\x29\x2e\x76\141\154\50\x29\73" . "\44\x6d\157\x28\x22\43\155\157\137\155\145\163\163\141\147\x65\x22\x29\56\145\155\160\x74\171\50\51\54" . "\x24\x6d\157\x28\x22\43\x6d\157\137\155\145\x73\163\141\x67\145\x22\51\x2e\x61\160\x70\x65\156\x64\50\x22" . $this->img . "\42\51\x2c" . "\x24\155\x6f\50\42\x23\155\157\x5f\155\145\x73\x73\x61\147\x65\42\51\56\x73\150\x6f\x77\x28\51\54" . "\44\155\x6f\x2e\141\x6a\141\170\50\173" . "\165\x72\154\72\42" . site_url() . "\57\77\x6f\160\x74\x69\x6f\156\x3d\155\x69\x6e\x69\x6f\x72\141\156\147\x65\x2d\141\152\141\x78\55\x6f\x74\x70\x2d\x76\141\x6c\x69\144\141\164\x65\42\54" . "\x74\x79\160\x65\72\x22\x50\x4f\123\124\42\54" . "\144\141\164\x61\x3a\173\x6d\157\x5f\157\164\160\x5f\x74\x6f\x6b\145\156\72\x65\54\x75\x73\x65\x72\137\160\150\157\156\x65\x3a\155\x7d\x2c" . "\143\162\x6f\x73\163\x44\x6f\x6d\x61\151\156\72\41\x30\54" . "\x64\141\x74\x61\x54\x79\x70\145\72\x22\x6a\163\x6f\x6e\x22\x2c" . "\163\x75\x63\143\145\163\163\72\146\x75\156\x63\164\151\157\156\50\157\x29\173" . "\42\163\165\143\x63\145\x73\163\x22\x3d\75\x6f\56\162\x65\163\x75\x6c\164\77\x28" . "\44\x6d\x6f\x28\42\43\x6d\x6f\x5f\155\x65\x73\x73\x61\147\145\42\51\x2e\x65\x6d\160\x74\171\50\51\54" . "\x24\155\x6f\x28\x22\x23\x6d\x6f\x5f\166\x61\154\151\x64\x61\164\145\137\x66\157\x72\155\x22\51\x2e\163\165\x62\155\x69\x74\x28\51" . "\51\x3a\x28" . "\x24\155\157\50\x22\43\155\157\137\x6d\145\163\163\141\147\x65\42\x29\56\x65\155\160\x74\171\x28\51\54" . "\x24\155\157\50\x22\x23\155\x6f\137\155\x65\163\x73\x61\147\145\42\x29\x2e\141\x70\160\x65\156\x64\50\x6f\x2e\155\x65\x73\x73\x61\x67\145\51\x2c" . "\x24\x6d\x6f\x28\x22\43\x6d\x6f\x5f\155\x65\163\163\x61\x67\x65\42\x29\x2e\x63\x73\x73\x28\42\x62\x61\143\x6b\x67\x72\157\x75\x6e\x64\55\143\157\x6c\157\x72\x22\54\42\43\x65\x64\x61\x35\70\145\x22\x29\54" . "\44\x6d\157\50\x22\151\x6e\x70\x75\164\133\x6e\x61\x6d\x65\x3d\166\141\154\x69\144\141\x74\x65\137\157\164\160\x5d\x22\x29\56\146\157\x63\165\163\50\x29" . "\51" . "\175\54" . "\x65\x72\162\x6f\x72\x3a\146\x75\156\143\164\151\x6f\x6e\x28\157\x2c\x65\x2c\155\51\x7b\175" . "\x7d\x29" . "\175\51" . "\175\x29\x3b" . "\74\57\163\143\x72\x69\160\x74\x3e";
        i2:
        return $ts;
    }
}
