<?php


namespace OTP\Helper;

if (defined("\101\102\x53\x50\x41\124\x48")) {
    goto rq;
}
die;
rq:
class MoDisplayMessages
{
    private $_message;
    private $_type;
    function __construct($bJ, $WP)
    {
        $this->_message = $bJ;
        $this->_type = $WP;
        add_action("\141\144\155\151\x6e\x5f\156\x6f\164\x69\143\145\x73", array($this, "\x72\x65\x6e\144\x65\162"));
    }
    function render()
    {
        switch ($this->_type) {
            case "\x43\125\123\124\117\x4d\x5f\x4d\105\123\x53\101\x47\105":
                echo mo_($this->_message);
                goto rO;
            case "\116\x4f\124\x49\103\105":
                echo "\74\x64\151\166\40\163\x74\171\x6c\x65\x3d\x22\x6d\141\162\147\151\x6e\55\x74\157\160\x3a\61\45\x3b\42" . "\143\154\x61\163\163\x3d\x22\x69\163\x2d\144\x69\x73\155\151\163\x73\x69\142\x6c\x65\40\x6e\157\164\x69\143\x65\x20\x6e\x6f\x74\x69\143\145\x2d\x77\141\162\x6e\151\x6e\x67\40\x6d\157\55\141\x64\x6d\151\x6e\x2d\x6e\x6f\x74\x69\146\42\x3e" . "\74\160\x3e" . mo_($this->_message) . "\74\57\160\x3e" . "\x3c\57\144\x69\166\x3e";
                goto rO;
            case "\105\122\122\x4f\x52":
                echo "\x3c\144\151\166\40\x73\164\171\154\x65\75\x22\x6d\141\x72\147\151\156\55\x74\x6f\160\72\61\x25\73\x22" . "\x63\x6c\x61\x73\163\75\42\x6e\x6f\x74\x69\143\145\x20\156\157\x74\x69\143\x65\x2d\x65\162\x72\x6f\162\40\x69\163\x2d\x64\x69\x73\155\x69\x73\163\x69\x62\154\145\x20\x6d\157\55\141\x64\155\151\x6e\x2d\156\157\x74\151\146\x22\76" . "\74\x70\76" . mo_($this->_message) . "\74\x2f\160\x3e" . "\x3c\x2f\x64\x69\166\x3e";
                goto rO;
            case "\123\x55\103\103\105\x53\123":
                echo "\x3c\144\151\166\x20\x20\x73\x74\171\x6c\x65\x3d\42\x6d\141\162\x67\x69\156\x2d\x74\157\160\72\x31\x25\x3b\x22" . "\x63\154\x61\x73\163\75\x22\x6e\157\x74\151\x63\x65\40\156\157\164\x69\143\145\x2d\x73\165\x63\143\145\163\163\x20\151\163\55\x64\x69\163\155\151\x73\x73\x69\x62\154\x65\x20\x6d\157\55\141\144\155\x69\156\55\156\157\x74\x69\x66\x22\x3e" . "\x3c\x70\x3e" . mo_($this->_message) . "\74\57\160\x3e" . "\74\57\x64\151\x76\76";
                goto rO;
        }
        ea:
        rO:
    }
}