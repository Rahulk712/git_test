<?php


namespace OTP;

use OTP\Handler\EmailVerificationLogic;
use OTP\Handler\FormActionHandler;
use OTP\Handler\MoOTPActionHandlerHandler;
use OTP\Handler\MoRegistrationHandler;
use OTP\Handler\PhoneVerificationLogic;
use OTP\Helper\CountryList;
use OTP\Helper\GatewayFunctions;
use OTP\Helper\MenuItems;
use OTP\Helper\MoConstants;
use OTP\Helper\MoDisplayMessages;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;
use OTP\Helper\MOVisualTour;
use OTP\Helper\PolyLangStrings;
use OTP\Helper\Templates\DefaultPopup;
use OTP\Helper\Templates\ErrorPopup;
use OTP\Helper\Templates\ExternalPopup;
use OTP\Helper\Templates\UserChoicePopup;
use OTP\Objects\PluginPageDetails;
use OTP\Objects\TabDetails;
use OTP\Objects\Tabs;
use OTP\Traits\Instance;
if (defined("\x41\x42\x53\x50\x41\x54\x48")) {
    goto LG;
}
die;
LG:
final class MoOTP
{
    use Instance;
    private function __construct()
    {
        $this->initializeHooks();
        $this->initializeGlobals();
        $this->initializeHelpers();
        $this->initializeHandlers();
        $this->registerPolyLangStrings();
        $this->registerAddOns();
    }
    private function initializeHooks()
    {
        add_action("\160\154\x75\147\151\x6e\163\x5f\x6c\157\141\144\145\144", array($this, "\x6f\164\x70\x5f\154\x6f\141\x64\137\x74\145\170\164\144\157\155\x61\x69\156"));
        add_action("\141\144\155\x69\156\x5f\155\145\x6e\165", array($this, "\155\x69\156\151\157\x72\141\x6e\x67\x65\x5f\x63\x75\163\164\x6f\x6d\x65\162\x5f\166\141\154\x69\144\x61\164\x69\x6f\x6e\x5f\x6d\x65\156\x75"));
        add_action("\x61\144\155\x69\x6e\x5f\145\x6e\161\165\145\x75\145\137\163\x63\x72\x69\x70\x74\x73", array($this, "\155\x6f\137\162\145\147\151\x73\164\x72\141\164\x69\x6f\156\x5f\x70\x6c\165\x67\x69\156\x5f\x73\x65\x74\x74\151\x6e\x67\x73\137\163\x74\x79\x6c\145"));
        add_action("\141\x64\x6d\x69\156\x5f\x65\156\x71\165\x65\x75\145\x5f\x73\x63\162\x69\160\x74\x73", array($this, "\x6d\157\x5f\x72\x65\147\151\163\164\162\141\164\151\157\156\x5f\x70\x6c\x75\147\151\156\137\163\145\x74\164\x69\x6e\x67\x73\x5f\x73\x63\162\x69\160\x74"));
        add_action("\x77\160\x5f\145\156\161\165\145\165\x65\137\x73\x63\162\x69\x70\x74\x73", array($this, "\155\157\x5f\x72\x65\x67\x69\x73\164\x72\x61\164\x69\157\x6e\x5f\x70\x6c\165\147\x69\x6e\x5f\146\162\x6f\156\164\145\x6e\144\x5f\163\143\162\x69\160\164\x73"), 99);
        add_action("\x6c\x6f\x67\x69\x6e\x5f\x65\156\161\x75\145\165\x65\x5f\x73\x63\162\151\160\x74\163", array($this, "\x6d\157\137\162\x65\147\x69\163\x74\162\141\x74\x69\157\x6e\137\160\x6c\165\x67\x69\x6e\x5f\146\x72\157\x6e\164\145\x6e\144\x5f\163\143\162\x69\160\x74\x73"), 99);
        add_action("\155\157\x5f\x72\x65\147\x69\x73\164\162\141\x74\x69\157\x6e\x5f\163\x68\157\x77\137\x6d\x65\163\163\141\147\x65", array($this, "\x6d\x6f\137\163\x68\x6f\x77\x5f\x6f\x74\160\137\x6d\x65\x73\163\141\147\145"), 1, 2);
        add_action("\150\157\x75\x72\154\x79\123\x79\156\x63", array($this, "\x68\157\165\162\154\171\x53\x79\x6e\143"));
        add_action("\x61\144\x6d\x69\156\x5f\146\x6f\157\x74\x65\x72", array($this, "\x66\145\x65\144\142\141\143\x6b\x5f\x72\145\x71\165\x65\163\x74"));
        add_filter("\167\160\137\155\141\151\154\x5f\146\162\157\x6d\137\x6e\x61\x6d\x65", array($this, "\x63\165\x73\x74\157\x6d\137\x77\x70\x5f\155\x61\151\154\137\146\x72\x6f\x6d\x5f\156\141\x6d\145"));
        add_filter("\160\x6c\165\147\151\x6e\137\162\x6f\x77\137\x6d\145\164\x61", array($this, "\x6d\x6f\x5f\155\145\164\x61\137\154\151\156\x6b\163"), 10, 2);
        add_action("\167\160\137\145\156\161\165\x65\x75\x65\137\x73\143\x72\151\x70\164\x73", array($this, "\154\x6f\141\144\137\152\161\x75\145\162\171\137\x6f\156\x5f\x66\x6f\x72\155\163"));
        add_action("\160\x6c\x75\x67\151\x6e\137\x61\143\164\x69\157\x6e\x5f\x6c\151\156\x6b\x73\x5f" . MOV_PLUGIN_NAME, array($this, "\x70\x6c\x75\147\151\156\x5f\x61\143\164\x69\157\156\x5f\154\x69\156\x6b\x73"), 10, 1);
    }
    function load_jquery_on_forms()
    {
        if (wp_script_is("\152\161\165\145\x72\171", "\145\156\x71\165\x65\165\x65\x64")) {
            goto iH;
        }
        wp_enqueue_script("\152\161\x75\x65\162\x79");
        iH:
    }
    private function initializeHelpers()
    {
        MoMessages::instance();
        PolyLangStrings::instance();
        MOVisualTour::instance();
    }
    private function initializeHandlers()
    {
        FormActionHandler::instance();
        MoOTPActionHandlerHandler::instance();
        DefaultPopup::instance();
        ErrorPopup::instance();
        ExternalPopup::instance();
        UserChoicePopup::instance();
        MoRegistrationHandler::instance();
    }
    private function initializeGlobals()
    {
        global $phoneLogic, $emailLogic;
        $phoneLogic = PhoneVerificationLogic::instance();
        $emailLogic = EmailVerificationLogic::instance();
    }
    function miniorange_customer_validation_menu()
    {
        MenuItems::instance();
    }
    function mo_customer_validation_options()
    {
        include MOV_DIR . "\143\157\x6e\164\x72\157\154\154\x65\x72\163\x2f\x6d\x61\x69\156\x2d\143\157\x6e\164\162\157\x6c\154\x65\162\x2e\x70\150\160";
    }
    function mo_registration_plugin_settings_style()
    {
        wp_enqueue_style("\x6d\157\x5f\143\165\163\164\x6f\155\145\162\137\x76\x61\x6c\x69\x64\x61\164\151\x6f\x6e\137\x61\x64\x6d\151\x6e\137\163\145\164\x74\151\x6e\x67\163\137\163\x74\x79\x6c\x65", MOV_CSS_URL);
        wp_enqueue_style("\x6d\157\x5f\x63\x75\163\x74\x6f\x6d\145\x72\137\x76\141\x6c\151\x64\x61\x74\x69\x6f\156\x5f\x69\156\164\164\x65\154\151\x6e\x70\x75\164\137\x73\164\x79\154\145", MO_INTTELINPUT_CSS);
    }
    function mo_registration_plugin_settings_script()
    {
        wp_enqueue_script("\155\x6f\x5f\143\165\x73\x74\157\155\145\x72\x5f\166\x61\x6c\x69\x64\141\x74\x69\x6f\156\x5f\141\144\x6d\151\x6e\x5f\163\145\x74\x74\151\x6e\147\x73\137\x73\x63\162\x69\160\x74", MOV_JS_URL, array("\152\161\165\145\162\171"));
        wp_enqueue_script("\x6d\x6f\x5f\x63\165\163\x74\x6f\155\145\162\137\x76\141\x6c\151\144\x61\x74\151\157\156\137\146\x6f\162\x6d\x5f\166\141\x6c\x69\144\141\x74\151\157\156\137\163\x63\162\151\160\164", VALIDATION_JS_URL, array("\x6a\x71\165\x65\x72\171"));
        wp_enqueue_script("\155\157\137\x63\x75\163\164\157\x6d\145\x72\x5f\x76\x61\154\151\x64\141\164\151\x6f\x6e\x5f\151\156\x74\164\145\154\151\156\x70\x75\164\x5f\163\x63\x72\151\160\x74", MO_INTTELINPUT_JS, array("\152\x71\x75\145\162\x79"));
    }
    function mo_registration_plugin_frontend_scripts()
    {
        if (get_mo_option("\163\150\x6f\x77\137\144\x72\x6f\160\x64\157\x77\156\x5f\x6f\x6e\137\x66\x6f\x72\155")) {
            goto Ct;
        }
        return;
        Ct:
        $lP = apply_filters("\155\157\137\x70\x68\x6f\156\x65\x5f\144\162\x6f\160\144\157\167\156\137\163\145\154\x65\143\164\x6f\x72", array());
        if (!MoUtility::isBlank($lP)) {
            goto XW;
        }
        return;
        XW:
        $lP = array_unique($lP);
        wp_enqueue_script("\x6d\x6f\x5f\x63\x75\163\164\157\x6d\x65\162\x5f\166\x61\x6c\151\x64\x61\164\151\x6f\x6e\x5f\151\156\x74\164\145\x6c\x69\156\x70\165\164\137\163\x63\162\151\160\164", MO_INTTELINPUT_JS, array("\152\x71\165\145\x72\x79"));
        wp_enqueue_style("\155\157\x5f\x63\x75\x73\164\x6f\155\145\x72\x5f\x76\141\154\151\144\x61\164\x69\x6f\156\x5f\151\156\164\164\x65\x6c\151\156\160\165\164\x5f\163\x74\x79\154\x65", MO_INTTELINPUT_CSS);
        wp_register_script("\155\x6f\x5f\143\x75\x73\x74\x6f\x6d\x65\162\137\166\x61\x6c\151\x64\x61\x74\151\x6f\x6e\137\144\x72\157\160\144\x6f\167\156\137\163\143\x72\151\160\x74", MO_DROPDOWN_JS, array("\152\x71\x75\145\x72\x79"), MOV_VERSION, true);
        wp_localize_script("\x6d\x6f\137\143\165\x73\x74\157\155\x65\x72\x5f\x76\x61\154\151\144\x61\x74\151\157\156\x5f\144\x72\157\160\144\157\x77\x6e\137\163\x63\162\151\x70\164", "\155\157\144\x72\157\x70\144\157\x77\x6e\x76\141\162\163", array("\x73\x65\x6c\145\143\x74\157\162" => json_encode($lP), "\144\145\x66\141\165\x6c\164\x43\157\165\x6e\164\162\x79" => CountryList::getDefaultCountryIsoCode(), "\157\x6e\x6c\171\x43\157\165\156\x74\162\x69\145\x73" => CountryList::getOnlyCountryList()));
        wp_enqueue_script("\155\x6f\x5f\143\165\163\x74\157\155\x65\162\x5f\166\x61\154\x69\x64\x61\x74\151\157\156\x5f\144\162\x6f\160\x64\157\167\x6e\x5f\163\x63\x72\x69\x70\x74");
    }
    function mo_show_otp_message($zv, $WP)
    {
        new MoDisplayMessages($zv, $WP);
    }
    function otp_load_textdomain()
    {
        load_plugin_textdomain("\155\151\x6e\151\x6f\162\x61\156\147\145\x2d\157\164\160\55\x76\x65\x72\x69\x66\x69\x63\x61\164\x69\157\x6e", FALSE, dirname(plugin_basename(__FILE__)) . "\57\x6c\x61\156\x67\x2f");
        do_action("\x6d\x6f\x5f\157\164\x70\137\x76\145\x72\x69\x66\151\143\141\164\x69\157\156\x5f\x61\x64\144\137\x6f\x6e\137\154\141\x6e\147\137\146\151\x6c\x65\x73");
    }
    private function registerPolylangStrings()
    {
        if (MoUtility::_is_polylang_installed()) {
            goto zp;
        }
        return;
        zp:
        foreach (unserialize(MO_POLY_STRINGS) as $xl => $sA) {
            pll_register_string($xl, $sA, "\x6d\151\x6e\151\157\162\141\156\147\x65\55\x6f\x74\x70\55\x76\x65\162\151\146\x69\x63\x61\x74\151\x6f\x6e");
            ES:
        }
        RR:
    }
    private function registerAddOns()
    {
        $Xk = GatewayFunctions::instance();
        $Xk->registerAddOns();
    }
    function feedback_request()
    {
        include MOV_DIR . "\x63\157\x6e\164\x72\x6f\154\x6c\x65\162\x73\57\x66\145\145\144\142\141\x63\153\x2e\x70\150\160";
    }
    function mo_meta_links($yU, $uD)
    {
        if (!(MOV_PLUGIN_NAME === $uD)) {
            goto mI;
        }
        $yU[] = "\x3c\163\160\141\x6e\x20\x63\x6c\141\x73\163\75\47\144\141\x73\x68\151\x63\157\x6e\163\40\144\141\163\150\x69\143\x6f\x6e\x73\x2d\163\x74\151\x63\153\171\x27\76\74\x2f\x73\160\141\156\76\xd\xa\x20\40\40\40\40\40\40\40\x20\40\40\x20\74\x61\40\150\x72\x65\x66\x3d\x27" . MoConstants::FAQ_URL . "\x27\40\164\x61\162\147\145\x74\75\47\137\142\x6c\141\156\x6b\x27\x3e" . mo_("\106\101\x51\163") . "\x3c\x2f\x61\76";
        mI:
        return $yU;
    }
    function plugin_action_links($Hj)
    {
        $bf = TabDetails::instance();
        $oc = $bf->_tabDetails[Tabs::FORMS];
        if (!is_plugin_active(MOV_PLUGIN_NAME)) {
            goto L5;
        }
        $Hj = array_merge(array("\74\141\x20\x68\x72\x65\146\x3d\x22" . esc_url(admin_url("\141\x64\x6d\151\156\x2e\160\x68\160\x3f\x70\x61\x67\x65\x3d" . $oc->_menuSlug)) . "\x22\76" . mo_("\123\x65\164\x74\x69\156\147\163") . "\74\x2f\x61\x3e"), $Hj);
        L5:
        return $Hj;
    }
    function hourlySync()
    {
        $Xk = GatewayFunctions::instance();
        $Xk->hourlySync();
    }
    function custom_wp_mail_from_name($ni)
    {
        $Xk = GatewayFunctions::instance();
        return $Xk->custom_wp_mail_from_name($ni);
    }
}
