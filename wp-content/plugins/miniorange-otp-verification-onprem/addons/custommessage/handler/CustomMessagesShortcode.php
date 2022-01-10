<?php


namespace OTP\Addons\CustomMessage\Handler;

use OTP\Traits\Instance;
class CustomMessagesShortcode
{
    use Instance;
    private $_adminActions;
    private $_nonce;
    public function __construct()
    {
        $uc = CustomMessages::instance();
        $this->_nonce = $uc->getNonceValue();
        $this->_adminActions = $uc->_adminActions;
        add_shortcode("\155\x6f\x5f\143\x75\x73\x74\x6f\155\x5f\x73\155\x73", array($this, "\x5f\x63\x75\x73\x74\157\x6d\x5f\x73\155\163\137\163\150\157\162\164\143\157\x64\145"));
        add_shortcode("\155\x6f\x5f\x63\165\163\164\157\x6d\137\145\155\141\151\154", array($this, "\x5f\x63\165\163\x74\157\155\x5f\145\x6d\141\x69\154\x5f\163\x68\157\162\164\143\x6f\x64\145"));
    }
    function _custom_sms_shortcode()
    {
        if (is_user_logged_in()) {
            goto uZ;
        }
        return;
        uZ:
        $N_ = array_keys($this->_adminActions);
        include MCM_DIR . "\166\151\145\x77\x73\x2f\143\165\163\164\x6f\x6d\123\115\123\102\x6f\170\x2e\160\150\160";
        wp_register_script("\143\165\163\x74\157\155\x5f\163\155\x73\137\155\x73\x67\x5f\x73\143\162\x69\x70\164", MCM_SHORTCODE_SMS_JS, array("\152\x71\165\145\x72\x79"), MOV_VERSION);
        wp_localize_script("\x63\165\x73\164\x6f\155\137\163\155\163\x5f\155\163\147\137\163\143\162\151\x70\164", "\155\x6f\x76\x63\165\163\164\157\155\163\155\x73", array("\141\154\164" => mo_("\x53\x65\156\144\151\156\147\56\56\x2e"), "\151\155\147" => MOV_LOADER_URL, "\156\x6f\x6e\x63\145" => wp_create_nonce($this->_nonce), "\165\x72\154" => wp_ajax_url(), "\141\x63\164\x69\157\156" => $N_[0], "\142\165\164\x74\x6f\x6e\124\145\x78\x74" => mo_("\x53\x65\156\x64\x20\123\115\x53")));
        wp_enqueue_script("\x63\x75\x73\x74\157\155\x5f\x73\155\163\x5f\155\x73\147\137\163\143\x72\x69\160\x74");
    }
    function _custom_email_shortcode()
    {
        if (is_user_logged_in()) {
            goto z8;
        }
        return;
        z8:
        $N_ = array_keys($this->_adminActions);
        include MCM_DIR . "\166\x69\x65\167\x73\x2f\x63\165\x73\x74\x6f\155\x45\x6d\141\x69\x6c\102\157\170\56\160\x68\160";
        wp_register_script("\x63\x75\x73\x74\157\155\x5f\x65\155\x61\x69\154\x5f\x6d\163\147\137\163\143\x72\151\x70\164", MCM_SHORTCODE_EMAIL_JS, array("\152\161\165\x65\x72\x79"), MOV_VERSION);
        wp_localize_script("\x63\x75\x73\x74\x6f\155\x5f\145\155\141\151\154\137\155\163\147\x5f\x73\x63\162\151\x70\x74", "\155\x6f\166\143\165\x73\164\157\x6d\145\x6d\x61\x69\154", array("\x61\x6c\164" => mo_("\123\x65\x6e\144\x69\x6e\147\56\56\x2e"), "\151\155\x67" => MOV_LOADER_URL, "\x6e\x6f\x6e\x63\x65" => wp_create_nonce($this->_nonce), "\165\x72\x6c" => wp_ajax_url(), "\x61\x63\164\x69\157\156" => $N_[1], "\x62\x75\x74\x74\157\x6e\x54\145\170\164" => mo_("\123\x65\x6e\144\x20\x45\155\x61\151\x6c")));
        wp_enqueue_script("\143\x75\163\164\x6f\155\137\x65\155\x61\x69\154\x5f\155\x73\147\x5f\163\143\x72\x69\x70\x74");
    }
}
