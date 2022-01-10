<?php


namespace OTP\Handler\Forms;

use OTP\Helper\FormSessionVars;
use OTP\Helper\MoMessages;
use OTP\Helper\MoOTPDocs;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
use ReflectionException;
class UltimateProRegistrationForm extends FormHandler implements IFormHandler
{
    use Instance;
    protected function __construct()
    {
        $this->_isLoginOrSocialForm = FALSE;
        $this->_isAjaxForm = TRUE;
        $this->_formSessionVar = FormSessionVars::ULTIMATE_PRO;
        $this->_phoneFormId = "\151\156\x70\165\x74\133\156\141\155\145\x3d\160\x68\x6f\x6e\x65\135";
        $this->_formKey = "\125\x4c\x54\x49\115\101\124\105\x5f\x4d\105\115\x5f\120\x52\x4f";
        $this->_typePhoneTag = "\x6d\157\x5f\x75\x6c\164\x69\160\162\x6f\x5f\x70\x68\x6f\x6e\x65\x5f\145\156\141\142\x6c\145";
        $this->_typeEmailTag = "\155\x6f\137\165\154\164\x69\x70\x72\x6f\137\x65\x6d\x61\x69\154\x5f\x65\156\x61\142\x6c\145";
        $this->_formName = mo_("\x55\154\164\151\155\x61\x74\145\x20\115\x65\x6d\142\x65\x72\x73\x68\x69\x70\40\x50\162\x6f\40\x46\157\162\x6d");
        $this->_isFormEnabled = get_mo_option("\x75\154\164\151\160\162\x6f\x5f\145\x6e\x61\142\154\145");
        $this->_formDocuments = MoOTPDocs::UM_PRO_LINK;
        parent::__construct();
    }
    function handleForm()
    {
        $this->_otpType = get_mo_option("\x75\x6c\x74\151\x70\x72\157\137\x74\171\x70\145");
        add_action("\x77\160\x5f\141\x6a\141\x78\137\x6e\x6f\160\162\x69\166\137\x69\150\143\x5f\x63\150\145\x63\x6b\x5f\162\145\147\x5f\146\x69\145\154\144\x5f\141\x6a\141\x78", array($this, "\x5f\x75\x6c\164\151\x70\162\x6f\137\x68\141\x6e\x64\x6c\x65\137\163\x75\x62\x6d\151\x74"), 1);
        add_action("\167\x70\137\x61\x6a\x61\170\137\151\x68\143\137\x63\150\145\143\153\x5f\162\x65\147\x5f\146\x69\x65\154\x64\137\141\152\x61\170", array($this, "\137\165\154\x74\151\x70\x72\157\x5f\150\141\x6e\x64\x6c\x65\x5f\x73\x75\142\155\151\x74"), 1);
        if (!(strcasecmp($this->_otpType, $this->_typePhoneTag) == 0)) {
            goto Rw;
        }
        add_shortcode("\x6d\x6f\x5f\160\150\x6f\156\145", array($this, "\x5f\160\150\x6f\156\145\137\x73\x68\x6f\x72\x74\x63\x6f\144\x65"));
        Rw:
        if (!(strcasecmp($this->_otpType, $this->_typeEmailTag) == 0)) {
            goto aM;
        }
        add_shortcode("\x6d\x6f\137\x65\155\141\151\154", array($this, "\137\x65\x6d\141\x69\154\137\x73\x68\157\x72\x74\143\x6f\144\145"));
        aM:
        $this->routeData();
    }
    function routeData()
    {
        if (array_key_exists("\157\160\x74\x69\x6f\156", $_GET)) {
            goto oB;
        }
        return;
        oB:
        switch (trim($_GET["\x6f\x70\x74\151\157\156"])) {
            case "\x6d\151\156\151\157\x72\141\156\x67\145\55\165\154\x74\151":
                $this->_handle_ulti_form($_POST);
                goto qo;
        }
        bE:
        qo:
    }
    function _ultipro_handle_submit()
    {
        $nx = array("\x70\150\x6f\x6e\x65", "\165\x73\145\162\137\x65\x6d\x61\x69\154", "\166\x61\154\x69\x64\x61\x74\x65");
        $NY = ihc_return_meta_arr("\162\x65\x67\151\x73\164\x65\x72\x2d\155\x73\x67");
        if (isset($_REQUEST["\164\x79\160\x65"]) && isset($_REQUEST["\166\141\x6c\x75\145"])) {
            goto uF;
        }
        if (!isset($_REQUEST["\146\151\145\x6c\144\x73\137\x6f\142\152"])) {
            goto oG;
        }
        $iw = $_REQUEST["\x66\151\145\154\144\163\x5f\157\x62\152"];
        foreach ($iw as $Wc => $Dj) {
            if (in_array($Dj["\164\x79\160\145"], $nx)) {
                goto Ej;
            }
            $mi[] = array("\164\x79\160\145" => $Dj["\x74\171\160\145"], "\166\x61\x6c\165\145" => ihc_check_value_field($Dj["\x74\171\x70\x65"], $Dj["\x76\141\154\165\145"], $Dj["\x73\x65\x63\x6f\156\144\137\x76\141\x6c\x75\145"], $NY));
            goto rE;
            Ej:
            $mi[] = $this->validate_umpro_submitted_value($Dj["\164\x79\x70\x65"], $Dj["\x76\141\x6c\165\145"], $Dj["\x73\145\x63\157\x6e\144\137\x76\x61\154\165\145"], $NY);
            rE:
            fR:
        }
        KW:
        echo json_encode($mi);
        oG:
        goto nm;
        uF:
        echo ihc_check_value_field($_REQUEST["\x74\x79\160\145"], $_REQUEST["\166\141\154\165\x65"], $_REQUEST["\x73\x65\x63\157\156\x64\137\166\x61\154\x75\x65"], $NY);
        nm:
        die;
    }
    function _phone_shortcode()
    {
        $Mt = "\74\x64\x69\x76\x20\163\164\x79\154\x65\x3d\47\x64\x69\x73\x70\154\x61\x79\x3a\x74\x61\142\x6c\x65\73\x74\145\x78\164\x2d\x61\x6c\151\x67\156\72\143\145\x6e\164\x65\162\x3b\x27\76\x3c\151\155\x67\x20\x73\162\143\x3d\47" . MOV_URL . "\x69\x6e\143\x6c\x75\x64\145\x73\x2f\x69\x6d\x61\x67\145\163\x2f\154\157\x61\144\145\x72\56\147\151\x66\47\x3e\74\x2f\144\x69\x76\x3e";
        $eZ = "\74\x64\x69\166\x20\163\x74\x79\154\145\x3d\x27\x6d\x61\162\x67\151\x6e\55\164\157\160\x3a\40\x32\x25\x3b\47\76\x3c\142\165\x74\x74\x6f\x6e\x20\x74\x79\160\x65\x3d\x27\x62\165\x74\x74\157\156\x27\x20\x64\151\163\x61\x62\154\x65\x64\75\47\x64\151\163\141\x62\154\x65\x64\47\40\x63\x6c\141\163\163\75\47\x62\165\x74\x74\157\x6e\x20\x61\x6c\164\x27\x20\163\164\x79\154\145\75\47\167\151\144\164\x68\72\x31\x30\x30\45\x3b\150\x65\151\147\150\x74\x3a\63\60\160\x78\x3b";
        $eZ .= "\146\157\156\x74\55\146\141\x6d\151\154\x79\x3a\40\x52\157\142\157\164\157\x3b\146\x6f\156\x74\x2d\163\x69\x7a\145\72\x20\x31\x32\x70\170\40\41\151\x6d\160\157\x72\x74\x61\156\x74\x3b\x27\x20\x69\144\x3d\47\155\x69\x6e\x69\x6f\x72\141\x6e\x67\x65\137\157\x74\x70\137\164\x6f\x6b\145\x6e\137\163\165\x62\x6d\x69\x74\47\40\x74\x69\164\154\145\x3d\47\x50\154\x65\x61\163\x65\40\105\156\x74\145\x72\40\141\156\x20\x70\x68\157\156\145\x20\x74\157\x20\x65\156\x61\142\x6c\x65\x20\164\150\151\163\56\47\x3e";
        $eZ .= "\x43\154\x69\x63\x6b\40\110\x65\162\145\x20\x74\x6f\x20\126\x65\162\x69\x66\171\x20\x50\x68\x6f\x6e\x65\x3c\x2f\142\x75\x74\x74\157\156\x3e\74\57\x64\x69\x76\76\x3c\x64\151\x76\x20\163\164\x79\x6c\145\75\47\x6d\x61\162\147\x69\156\x2d\164\157\160\72\62\45\x27\x3e\x3c\x64\x69\x76\x20\151\144\75\x27\x6d\157\137\x6d\145\x73\x73\141\147\145\47\x20\150\151\x64\144\145\x6e\75\x27\x27\40";
        $eZ .= "\163\x74\x79\x6c\145\75\x27\142\141\x63\153\x67\x72\157\x75\x6e\144\x2d\x63\157\154\x6f\162\x3a\40\x23\146\x37\x66\66\x66\x37\73\x70\141\x64\x64\x69\x6e\x67\72\x20\x31\x65\155\40\62\x65\x6d\x20\61\145\155\x20\x33\x2e\65\x65\155\x3b\47\x27\x3e\x3c\57\144\151\166\x3e\74\x2f\144\x69\166\x3e";
        $zn = "\x3c\x73\x63\162\151\x70\x74\x3e\x6a\x51\165\x65\162\x79\50\144\x6f\x63\x75\155\x65\156\164\x29\x2e\162\x65\141\x64\x79\x28\146\165\156\x63\164\151\157\156\x28\51\x7b\44\x6d\x6f\x3d\x6a\x51\165\x65\162\x79\x3b\x20\166\x61\x72\40\x64\151\x76\x45\154\145\x6d\145\156\x74\40\75\40\x22" . $eZ . "\x22\x3b\x20";
        $zn .= "\x24\x6d\x6f\50\x22\x69\x6e\x70\165\x74\x5b\156\x61\155\x65\75\x70\150\157\x6e\145\x5d\42\51\x2e\143\x68\141\156\147\x65\x28\x66\165\x6e\143\164\151\x6f\156\50\51\173\40\151\146\50\x21\44\155\x6f\x28\x74\150\x69\163\51\56\166\141\154\x28\x29\51\173\40\x24\x6d\x6f\50\42\x23\x6d\151\x6e\151\x6f\162\x61\156\147\x65\x5f\x6f\x74\x70\x5f\164\x6f\153\145\156\x5f\163\x75\142\155\151\164\42\x29\x2e\x70\162\x6f\x70\x28\42\144\x69\163\141\x62\x6c\x65\x64\42\x2c\x74\x72\x75\145\51\73";
        $zn .= "\x20\x7d\x65\154\163\145\173\40\44\155\157\50\x22\43\155\151\156\x69\x6f\x72\141\156\147\x65\x5f\x6f\x74\x70\x5f\x74\x6f\x6b\x65\x6e\x5f\163\165\x62\155\x69\x74\42\x29\56\x70\162\157\x70\x28\42\144\151\x73\x61\142\154\145\144\x22\54\x66\141\x6c\163\x65\x29\x3b\x20\x7d\40\175\x29\x3b";
        $zn .= "\x20\44\x6d\x6f\50\x64\151\166\x45\154\x65\x6d\145\156\x74\51\x2e\x69\156\163\145\162\x74\x41\x66\x74\145\162\x28\44\155\x6f\50\x20\42\x69\156\x70\165\x74\133\156\141\x6d\145\x3d\x70\x68\157\156\x65\x5d\42\51\51\73\x20\44\155\157\x28\42\43\x6d\151\x6e\x69\157\x72\x61\156\x67\145\137\x6f\164\x70\x5f\164\x6f\x6b\145\156\x5f\163\165\142\x6d\x69\x74\x22\51\x2e\x63\154\x69\x63\153\50\146\x75\x6e\x63\164\151\x6f\x6e\50\157\51\173\40";
        $zn .= "\x76\x61\x72\x20\x65\x3d\x24\x6d\157\x28\x22\151\156\160\165\x74\133\x6e\x61\155\145\75\x70\x68\157\x6e\x65\x5d\x22\x29\x2e\166\141\x6c\50\x29\x3b\40\44\155\157\x28\x22\x23\x6d\x6f\x5f\x6d\x65\163\x73\141\x67\x65\42\x29\56\x65\x6d\160\x74\x79\50\x29\x2c\44\155\157\50\x22\x23\x6d\157\x5f\x6d\x65\163\x73\x61\x67\145\x22\x29\x2e\141\x70\160\x65\x6e\144\50\x22" . $Mt . "\42\x29\x2c";
        $zn .= "\44\x6d\157\50\x22\43\155\157\x5f\x6d\x65\x73\x73\x61\x67\x65\x22\51\x2e\x73\150\157\167\50\x29\54\x24\155\x6f\x2e\x61\x6a\x61\170\x28\x7b\165\x72\154\x3a\x22" . site_url() . "\x2f\x3f\157\x70\x74\151\x6f\156\x3d\x6d\151\x6e\151\x6f\162\x61\x6e\147\145\x2d\165\x6c\164\151\x22\54\164\x79\x70\145\72\42\x50\117\x53\x54\x22\54";
        $zn .= "\144\x61\164\141\72\x7b\x75\x73\x65\x72\x5f\160\150\157\x6e\145\72\x65\x7d\54\x63\162\157\163\163\x44\x6f\x6d\x61\151\156\x3a\x21\60\54\144\x61\x74\141\124\x79\x70\145\x3a\x22\152\x73\157\156\42\x2c\163\165\143\143\x65\x73\x73\72\x66\x75\156\143\164\x69\157\x6e\50\157\x29\173\40\x69\146\x28\157\56\162\145\x73\x75\154\x74\75\75\42\163\x75\x63\x63\145\163\x73\x22\x29\x7b\x24\155\x6f\x28\42\x23\155\157\137\x6d\145\x73\163\141\147\x65\42\51\x2e\x65\155\x70\164\171\x28\51\x2c";
        $zn .= "\x24\x6d\157\x28\42\x23\155\x6f\137\155\145\163\163\141\147\145\42\51\x2e\141\x70\160\145\x6e\144\50\x6f\56\155\x65\x73\x73\x61\147\145\x29\x2c\x24\x6d\x6f\x28\x22\x23\155\x6f\x5f\x6d\x65\x73\x73\141\x67\x65\x22\51\56\x63\x73\163\x28\42\x62\157\x72\144\145\x72\55\164\x6f\x70\42\x2c\x22\63\x70\170\x20\163\157\154\151\144\40\147\162\x65\145\156\x22\51\54";
        $zn .= "\44\x6d\157\x28\42\x69\156\x70\165\164\133\x6e\141\155\x65\x3d\145\x6d\x61\x69\x6c\137\x76\x65\x72\151\146\x79\135\x22\x29\56\x66\x6f\x63\x75\x73\50\51\x7d\x65\x6c\163\145\x7b\x24\x6d\157\x28\42\x23\x6d\x6f\x5f\x6d\x65\163\163\141\x67\x65\x22\x29\56\145\155\x70\164\x79\50\51\x2c\44\155\x6f\x28\42\43\155\157\x5f\155\x65\x73\163\x61\147\145\x22\x29\x2e\x61\160\x70\145\x6e\144\50\x6f\56\155\145\163\x73\141\147\145\x29\54";
        $zn .= "\44\x6d\157\50\x22\43\x6d\157\x5f\x6d\x65\163\x73\x61\x67\x65\x22\x29\x2e\x63\x73\163\x28\42\x62\x6f\162\x64\x65\162\x2d\164\157\x70\x22\x2c\42\63\160\x78\40\163\157\154\x69\x64\x20\x72\x65\144\42\x29\x2c\x24\x6d\157\50\x22\151\156\160\x75\164\133\x6e\x61\x6d\x65\75\160\x68\x6f\x6e\x65\x5f\x76\145\x72\151\x66\x79\135\42\51\56\146\x6f\x63\165\163\x28\51\x7d\x20\73\x7d\54";
        $zn .= "\x65\x72\x72\x6f\x72\72\146\x75\x6e\143\x74\x69\157\x6e\50\157\x2c\x65\x2c\156\51\173\175\175\x29\x7d\x29\x3b\175\x29\73\74\57\163\143\x72\151\x70\x74\x3e";
        return $zn;
    }
    function _email_shortcode()
    {
        $Mt = "\x3c\x64\x69\x76\40\163\164\x79\154\x65\x3d\47\144\x69\163\x70\x6c\141\x79\x3a\x74\x61\142\x6c\145\73\x74\x65\170\x74\55\141\154\151\147\156\72\x63\145\156\164\145\162\73\x27\76\74\x69\x6d\147\x20\163\x72\143\x3d\x27" . MOV_URL . "\151\156\143\x6c\x75\x64\x65\x73\x2f\151\x6d\141\x67\145\163\x2f\154\x6f\x61\144\x65\162\56\x67\151\146\x27\76\74\x2f\x64\151\166\x3e";
        $eZ = "\x3c\x64\x69\166\x20\x73\x74\171\x6c\145\x3d\x27\155\x61\162\x67\151\156\55\x74\x6f\160\72\40\62\45\73\x27\76\x3c\x62\x75\164\x74\x6f\156\40\164\x79\160\x65\75\47\x62\165\x74\x74\x6f\156\47\x20\144\151\163\x61\x62\154\145\144\x3d\x27\144\151\x73\x61\x62\154\145\x64\x27\40\x63\x6c\x61\x73\163\75\47\x62\165\x74\164\x6f\x6e\40\141\x6c\164\47\x20";
        $eZ .= "\163\x74\171\x6c\x65\75\x27\167\x69\144\164\x68\72\61\x30\60\x25\x3b\150\x65\x69\x67\x68\x74\x3a\63\60\160\x78\73\146\x6f\156\164\x2d\x66\141\x6d\151\x6c\171\72\40\122\x6f\x62\x6f\x74\x6f\x3b\146\157\x6e\164\55\163\x69\172\x65\72\40\61\62\x70\170\x20\41\x69\155\160\x6f\x72\164\x61\156\x74\x3b\47\40\151\x64\75\x27\x6d\x69\156\x69\x6f\162\141\156\147\x65\x5f\x6f\x74\160\x5f\x74\x6f\x6b\145\x6e\x5f\x73\x75\x62\155\x69\x74\x27\x20";
        $eZ .= "\164\151\x74\x6c\x65\x3d\47\x50\154\145\x61\x73\145\x20\x45\156\164\x65\162\x20\141\156\40\x65\x6d\x61\x69\154\40\164\157\40\145\x6e\141\x62\x6c\x65\x20\164\150\151\163\56\47\76\103\154\151\143\x6b\x20\x48\145\x72\x65\40\x74\157\40\x56\x65\x72\151\x66\x79\40\x79\157\165\x72\x20\145\155\141\x69\x6c\74\57\142\x75\x74\164\157\156\76\x3c\57\144\x69\x76\76\x3c\144\x69\x76\40\x73\164\171\x6c\145\75\x27\x6d\141\x72\147\151\x6e\55\x74\x6f\x70\72\62\x25\x27\76";
        $eZ .= "\74\x64\151\166\x20\151\x64\x3d\x27\x6d\157\x5f\155\x65\x73\163\x61\x67\x65\47\40\x68\x69\144\x64\x65\156\x3d\47\47\40\163\x74\x79\154\145\75\47\x62\141\x63\x6b\x67\162\x6f\x75\x6e\x64\55\143\x6f\154\157\x72\72\x20\x23\146\67\x66\66\x66\x37\73\160\141\x64\x64\x69\156\x67\x3a\40\61\x65\155\x20\62\x65\x6d\x20\61\145\155\x20\63\x2e\x35\x65\x6d\73\47\x27\76\x3c\57\144\x69\166\x3e\x3c\57\144\151\166\x3e";
        $zn = "\74\x73\143\x72\151\160\164\76\x6a\121\165\145\162\x79\x28\144\x6f\143\165\155\145\x6e\x74\51\x2e\x72\145\x61\x64\171\50\146\x75\156\143\164\x69\x6f\156\50\x29\x7b\44\155\x6f\75\152\x51\x75\x65\162\171\73\40\166\141\162\40\x64\x69\x76\x45\154\145\155\x65\x6e\164\40\x3d\x20\x22" . $eZ . "\42\73\x20";
        $zn .= "\44\155\x6f\x28\42\x69\156\160\165\x74\133\x6e\x61\155\145\75\x75\163\145\162\x5f\145\155\141\151\154\x5d\x22\51\x2e\x63\x68\141\156\x67\145\50\146\x75\156\143\164\x69\x6f\156\x28\51\x7b\40\151\146\50\x21\44\155\157\x28\x74\x68\151\x73\x29\x2e\x76\x61\154\50\x29\x29\x7b\x20";
        $zn .= "\x24\x6d\157\50\42\x23\x6d\151\156\151\157\162\x61\156\147\x65\x5f\157\164\x70\137\x74\157\x6b\145\x6e\137\163\x75\x62\155\x69\x74\x22\x29\56\160\162\157\x70\x28\x22\x64\151\163\x61\x62\x6c\145\144\42\54\164\162\165\x65\x29\73\x20\175\145\x6c\163\x65\x7b\40";
        $zn .= "\44\155\x6f\x28\42\x23\155\x69\x6e\x69\157\x72\x61\156\147\x65\x5f\x6f\x74\160\x5f\x74\x6f\153\x65\x6e\x5f\x73\165\x62\155\151\x74\42\x29\x2e\x70\162\x6f\160\x28\x22\144\x69\x73\141\142\x6c\x65\x64\42\x2c\x66\141\154\163\145\x29\x3b\40\x7d\x20\x7d\51\x3b\40";
        $zn .= "\44\155\157\50\144\151\166\x45\154\x65\155\x65\x6e\164\51\56\x69\x6e\163\x65\x72\x74\101\146\x74\x65\x72\50\x24\155\157\x28\40\x22\151\156\160\165\x74\x5b\156\x61\155\x65\x3d\165\163\145\x72\137\145\155\x61\x69\154\x5d\x22\51\x29\x3b\x20\x24\x6d\157\50\x22\x23\155\151\156\151\157\x72\x61\156\x67\145\x5f\x6f\164\x70\x5f\164\x6f\153\x65\x6e\x5f\163\x75\x62\155\x69\x74\42\x29\56\x63\x6c\x69\143\x6b\x28\x66\165\x6e\x63\164\x69\157\x6e\50\x6f\51\173\x20";
        $zn .= "\166\x61\x72\40\145\x3d\44\155\157\50\42\151\x6e\x70\165\x74\133\156\141\x6d\x65\x3d\x75\163\x65\162\x5f\x65\155\141\x69\x6c\135\42\51\56\x76\x61\x6c\x28\51\x3b\x20\44\x6d\x6f\50\x22\43\155\x6f\x5f\155\145\163\163\141\147\145\42\x29\56\x65\155\x70\x74\x79\50\51\54\x24\155\x6f\50\x22\43\x6d\x6f\x5f\155\145\163\x73\x61\147\x65\x22\51\x2e\141\160\x70\x65\156\144\x28\42" . $Mt . "\x22\51\54";
        $zn .= "\x24\155\x6f\50\x22\x23\155\157\x5f\x6d\145\x73\163\x61\x67\x65\x22\51\x2e\x73\150\x6f\x77\50\x29\54\x24\x6d\x6f\x2e\x61\152\141\x78\x28\173\x75\162\154\72\42" . site_url() . "\x2f\77\157\x70\164\x69\157\156\x3d\155\x69\156\x69\157\162\x61\x6e\147\145\x2d\165\154\x74\x69\x22\x2c\164\x79\x70\145\72\x22\120\x4f\x53\124\42\54\x64\141\x74\x61\72\173\x75\x73\145\x72\x5f\145\155\141\151\x6c\x3a\x65\x7d\54\143\x72\x6f\163\163\104\157\155\141\151\156\72\x21\x30\x2c\144\x61\164\141\x54\171\x70\x65\72\x22\152\x73\157\x6e\42\54\163\165\143\143\x65\x73\x73\72\146\x75\156\143\164\x69\157\156\x28\x6f\x29\x7b\40\151\146\x28\157\x2e\x72\145\x73\165\x6c\x74\75\75\42\x73\x75\143\143\x65\163\x73\x22\x29\x7b\44\155\x6f\x28\x22\43\155\x6f\x5f\155\145\163\x73\x61\147\x65\x22\x29\x2e\145\155\x70\164\171\50\x29\x2c\44\155\x6f\x28\x22\43\155\157\x5f\x6d\145\x73\163\141\x67\145\42\51\x2e\x61\x70\x70\x65\156\x64\50\157\x2e\x6d\145\163\x73\x61\x67\145\51\54\44\x6d\157\50\x22\43\155\157\x5f\x6d\145\163\163\x61\147\145\42\51\56\x63\x73\x73\50\x22\142\x6f\x72\x64\145\x72\55\164\157\160\42\54\42\63\x70\x78\40\163\157\x6c\151\x64\x20\147\162\x65\x65\156\42\x29\54\x24\x6d\157\x28\x22\151\x6e\160\x75\x74\x5b\x6e\141\155\145\75\x65\x6d\x61\151\x6c\137\166\145\x72\151\146\x79\x5d\42\x29\x2e\x66\157\x63\165\163\50\x29\x7d\145\x6c\163\x65\173\44\155\x6f\x28\x22\x23\155\157\137\155\145\163\163\x61\x67\145\x22\51\x2e\145\x6d\160\x74\x79\x28\x29\x2c\x24\155\x6f\x28\42\x23\x6d\157\137\155\x65\x73\163\141\147\145\x22\51\x2e\141\x70\x70\x65\x6e\144\50\x6f\x2e\155\x65\163\163\141\147\145\51\x2c\x24\155\x6f\50\42\43\x6d\157\x5f\155\145\163\163\141\x67\x65\42\51\56\x63\163\x73\x28\x22\142\157\162\x64\145\x72\x2d\x74\x6f\x70\x22\54\42\x33\x70\x78\x20\x73\x6f\x6c\x69\144\40\x72\x65\144\42\51\x2c\x24\x6d\x6f\x28\42\x69\x6e\160\x75\164\133\x6e\x61\x6d\x65\x3d\x70\150\157\156\145\137\x76\145\162\x69\x66\171\135\x22\x29\56\x66\157\x63\x75\x73\x28\x29\x7d\x20\73\x7d\54\145\x72\x72\x6f\x72\72\x66\165\156\143\164\x69\x6f\156\x28\157\x2c\145\54\x6e\x29\x7b\x7d\x7d\x29\x7d\51\x3b\175\x29\x3b\74\x2f\x73\143\162\x69\160\x74\x3e";
        return $zn;
    }
    function _handle_ulti_form($Jf)
    {
        MoUtility::initialize_transaction($this->_formSessionVar);
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) == 0) {
            goto Ce;
        }
        SessionUtils::addEmailVerified($this->_formSessionVar, $Jf["\165\163\145\x72\137\145\155\141\x69\154"]);
        $this->sendChallenge('', $Jf["\x75\x73\145\x72\137\x65\155\141\151\154"], null, null, VerificationType::EMAIL);
        goto uQ;
        Ce:
        SessionUtils::addPhoneVerified($this->_formSessionVar, $Jf["\165\x73\x65\162\x5f\x70\150\157\x6e\145"]);
        $this->sendChallenge('', null, null, $Jf["\x75\x73\145\x72\x5f\160\x68\157\x6e\145"], VerificationType::PHONE);
        uQ:
    }
    function validate_umpro_submitted_value($WP, $sA, $PI, $NY)
    {
        $N0 = array();
        switch ($WP) {
            case "\160\x68\x6f\x6e\x65":
                $this->processPhone($N0, $WP, $sA, $PI, $NY);
                goto vC;
            case "\x75\x73\x65\162\137\x65\x6d\141\151\x6c":
                $this->processEmail($N0, $WP, $sA, $PI, $NY);
                goto vC;
            case "\x76\141\154\151\x64\141\x74\145":
                $this->processOTPEntered($N0, $WP, $sA, $PI, $NY);
                goto vC;
        }
        Dk:
        vC:
        return $N0;
    }
    function processPhone(&$N0, $WP, $sA, $PI, $NY)
    {
        if (strcasecmp($this->_otpType, $this->_typePhoneTag) != 0) {
            goto H5;
        }
        if (!SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto u9;
        }
        if (!SessionUtils::isPhoneVerifiedMatch($this->_formSessionVar, $sA)) {
            goto kB;
        }
        $N0 = array("\x74\171\x70\145" => $WP, "\166\x61\154\165\145" => ihc_check_value_field($WP, $sA, $PI, $NY));
        goto RB;
        kB:
        $N0 = array("\164\x79\x70\145" => $WP, "\166\141\154\x75\145" => MoMessages::showMessage(MoMessages::PHONE_MISMATCH));
        RB:
        goto CV;
        u9:
        $N0 = array("\x74\x79\160\145" => $WP, "\x76\141\154\165\x65" => MoMessages::showMessage(MoMessages::PLEASE_VALIDATE));
        CV:
        goto OD;
        H5:
        $N0 = array("\164\x79\x70\x65" => $WP, "\166\x61\154\x75\x65" => ihc_check_value_field($WP, $sA, $PI, $NY));
        OD:
    }
    function processEmail(&$N0, $WP, $sA, $PI, $NY)
    {
        if (strcasecmp($this->_otpType, $this->_typeEmailTag) != 0) {
            goto HC;
        }
        if (!SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto Oh;
        }
        if (!SessionUtils::isEmailVerifiedMatch($this->_formSessionVar, $sA)) {
            goto av;
        }
        $N0 = array("\164\171\160\145" => $WP, "\x76\141\154\x75\145" => ihc_check_value_field($WP, $sA, $PI, $NY));
        goto f4;
        av:
        $N0 = array("\164\x79\160\145" => $WP, "\x76\141\x6c\x75\x65" => MoMessages::showMessage(MoMessages::EMAIL_MISMATCH));
        f4:
        goto J3;
        Oh:
        $N0 = array("\164\x79\x70\x65" => $WP, "\166\141\154\x75\145" => MoMessages::showMessage(MoMessages::PLEASE_VALIDATE));
        J3:
        goto KP;
        HC:
        $N0 = array("\164\171\160\145" => $WP, "\166\x61\x6c\165\x65" => ihc_check_value_field($WP, $sA, $PI, $NY));
        KP:
    }
    function processOTPEntered(&$N0, $WP, $sA, $PI, $NY)
    {
        if (!SessionUtils::isOTPInitialized($this->_formSessionVar)) {
            goto Ux;
        }
        $this->validateAndProcessOTP($N0, $WP, $sA);
        goto xk;
        Ux:
        $N0 = array("\164\x79\x70\145" => $WP, "\x76\x61\154\165\145" => MoMessages::showMessage(MoMessages::PLEASE_VALIDATE));
        xk:
    }
    function validateAndProcessOTP(&$N0, $WP, $XS)
    {
        $Jw = $this->getVerificationType();
        $this->validateChallenge($Jw, NULL, $XS);
        if (!SessionUtils::isStatusMatch($this->_formSessionVar, self::VALIDATED, $Jw)) {
            goto Wh;
        }
        $this->unsetOTPSessionVariables();
        $N0 = array("\164\171\160\145" => $WP, "\166\141\154\x75\145" => 1);
        goto a_;
        Wh:
        $N0 = array("\x74\x79\160\x65" => $WP, "\x76\x61\x6c\165\145" => MoUtility::_get_invalid_otp_method());
        a_:
    }
    function handle_failed_verification($u0, $Kc, $t2, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VERIFICATION_FAILED, $m5);
    }
    function handle_post_verification($fC, $u0, $Kc, $wh, $t2, $SU, $m5)
    {
        SessionUtils::addStatus($this->_formSessionVar, self::VALIDATED, $m5);
    }
    public function unsetOTPSessionVariables()
    {
        SessionUtils::unsetSession(array($this->_txSessionId, $this->_formSessionVar));
    }
    public function getPhoneNumberSelector($lP)
    {
        if (!($this->isFormEnabled() && $this->_otpType == $this->_typePhoneTag)) {
            goto XG;
        }
        array_push($lP, $this->_phoneFormId);
        XG:
        return $lP;
    }
    function handleFormOptions()
    {
        if (MoUtility::areFormOptionsBeingSaved($this->getFormOption())) {
            goto Qw;
        }
        return;
        Qw:
        $this->_isFormEnabled = $this->sanitizeFormPOST("\165\x6c\164\151\160\162\157\137\x65\156\141\142\154\x65");
        $this->_otpType = $this->sanitizeFormPOST("\165\154\x74\x69\160\x72\x6f\x5f\x74\171\x70\145");
        update_mo_option("\165\x6c\x74\x69\160\162\x6f\137\145\x6e\141\142\x6c\145", $this->_isFormEnabled);
        update_mo_option("\x75\154\x74\151\x70\162\157\x5f\164\x79\x70\x65", $this->_otpType);
    }
}
