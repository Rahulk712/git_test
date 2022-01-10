<?php


namespace OTP\Objects;

use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;
class BaseActionHandler
{
    protected $_nonce;
    protected function __construct()
    {
    }
    protected function isValidRequest()
    {
        if (!(!current_user_can("\155\141\x6e\141\147\x65\137\x6f\x70\164\x69\157\x6e\163") || !check_admin_referer($this->_nonce))) {
            goto kQ;
        }
        wp_die(MoMessages::showMessage(MoMessages::INVALID_OP));
        kQ:
        return true;
    }
    protected function isValidAjaxRequest($xl)
    {
        if (check_ajax_referer($this->_nonce, $xl)) {
            goto HT;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(BaseMessages::INVALID_OP), MoConstants::ERROR_JSON_TYPE));
        HT:
    }
    public function getNonceValue()
    {
        return $this->_nonce;
    }
}
