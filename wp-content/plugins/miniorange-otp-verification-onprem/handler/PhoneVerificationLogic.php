<?php


namespace OTP\Handler;

if (defined("\101\102\123\x50\101\124\110")) {
    goto He;
}
die;
He:
use OTP\Helper\FormSessionVars;
use OTP\Helper\GatewayFunctions;
use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\FormSessionData;
use OTP\Objects\VerificationLogic;
use OTP\Traits\Instance;
final class PhoneVerificationLogic extends VerificationLogic
{
    use Instance;
    public function _handle_logic($u0, $Kc, $t2, $e7, $Rw)
    {
        $og = MoUtility::validatePhoneNumber($t2);
        switch ($og) {
            case 0:
                $this->_handle_not_matched($t2, $e7, $Rw);
                goto FZ;
            case 1:
                $this->_handle_matched($u0, $Kc, $t2, $e7, $Rw);
                goto FZ;
        }
        FG:
        FZ:
    }
    public function _handle_matched($u0, $Kc, $t2, $e7, $Rw)
    {
        $bJ = str_replace("\x23\x23\160\x68\x6f\x6e\145\x23\x23", $t2, $this->_get_is_blocked_message());
        if ($this->_is_blocked($Kc, $t2)) {
            goto EE;
        }
        $this->_start_otp_verification($u0, $Kc, $t2, $e7, $Rw);
        goto nQ;
        EE:
        if ($this->_is_ajax_form()) {
            goto qF;
        }
        miniorange_site_otp_validation_form(null, null, null, $bJ, $e7, $Rw);
        goto H_;
        qF:
        wp_send_json(MoUtility::createJson($bJ, MoConstants::ERROR_JSON_TYPE));
        H_:
        nQ:
    }
    public function _start_otp_verification($u0, $Kc, $t2, $e7, $Rw)
    {
        $Xk = GatewayFunctions::instance();
        $zv = $Xk->mo_send_otp_token("\x53\x4d\x53", '', $t2);
        switch ($zv["\x73\164\x61\164\x75\163"]) {
            case "\x53\125\103\103\105\123\123":
                $this->_handle_otp_sent($u0, $Kc, $t2, $e7, $Rw, $zv);
                goto gq;
            default:
                $this->_handle_otp_sent_failed($u0, $Kc, $t2, $e7, $Rw, $zv);
                goto gq;
        }
        y9:
        gq:
    }
    public function _handle_not_matched($t2, $e7, $Rw)
    {
        $bJ = str_replace("\43\x23\x70\150\157\156\x65\43\x23", $t2, $this->_get_otp_invalid_format_message());
        if ($this->_is_ajax_form()) {
            goto gt;
        }
        miniorange_site_otp_validation_form(null, null, null, $bJ, $e7, $Rw);
        goto ib;
        gt:
        wp_send_json(MoUtility::createJson($bJ, MoConstants::ERROR_JSON_TYPE));
        ib:
    }
    public function _handle_otp_sent_failed($u0, $Kc, $t2, $e7, $Rw, $zv)
    {
        $bJ = str_replace("\x23\x23\x70\150\157\x6e\145\x23\43", $t2, $this->_get_otp_sent_failed_message());
        if ($this->_is_ajax_form()) {
            goto UC;
        }
        miniorange_site_otp_validation_form(null, null, null, $bJ, $e7, $Rw);
        goto pZ;
        UC:
        wp_send_json(MoUtility::createJson($bJ, MoConstants::ERROR_JSON_TYPE));
        pZ:
    }
    public function _handle_otp_sent($u0, $Kc, $t2, $e7, $Rw, $zv)
    {
        SessionUtils::setPhoneTransactionID($zv["\164\170\x49\x64"]);
        if (!(MoUtility::micr() && MoUtility::isMG())) {
            goto cA;
        }
        update_mo_option("\x70\x68\x6f\x6e\x65\137\164\x72\141\x6e\163\x61\143\x74\151\x6f\156\x73\137\162\x65\155\141\151\x6e\151\x6e\x67", get_mo_option("\160\150\x6f\156\x65\x5f\x74\162\141\156\x73\141\143\164\x69\x6f\x6e\163\137\x72\x65\x6d\x61\151\x6e\151\156\147") - 1);
        cA:
        $bJ = str_replace("\x23\x23\160\x68\157\x6e\145\x23\x23", $t2, $this->_get_otp_sent_message());
        if ($this->_is_ajax_form()) {
            goto c7;
        }
        miniorange_site_otp_validation_form($u0, $Kc, $t2, $bJ, $e7, $Rw);
        goto py;
        c7:
        wp_send_json(MoUtility::createJson($bJ, MoConstants::SUCCESS_JSON_TYPE));
        py:
    }
    public function _get_otp_sent_message()
    {
        $Br = get_mo_option("\163\x75\143\143\145\163\x73\137\x70\150\x6f\156\x65\x5f\x6d\x65\163\163\x61\147\145", "\155\x6f\137\x6f\164\x70\x5f");
        return $Br ? $Br : MoMessages::showMessage(MoMessages::OTP_SENT_PHONE);
    }
    public function _get_otp_sent_failed_message()
    {
        $Kt = get_mo_option("\145\162\x72\157\162\137\160\x68\x6f\x6e\x65\x5f\155\x65\163\163\x61\x67\145", "\x6d\157\137\x6f\164\x70\137");
        return $Kt ? $Kt : MoMessages::showMessage(MoMessages::ERROR_OTP_PHONE);
    }
    public function _get_otp_invalid_format_message()
    {
        $xe = get_mo_option("\x69\x6e\x76\141\154\x69\x64\137\160\150\x6f\x6e\x65\x5f\155\x65\x73\x73\141\147\145", "\x6d\157\137\x6f\x74\160\137");
        return $xe ? $xe : MoMessages::showMessage(MoMessages::ERROR_PHONE_FORMAT);
    }
    public function _is_blocked($Kc, $t2)
    {
        $sQ = explode("\73", get_mo_option("\x62\154\x6f\143\x6b\145\x64\x5f\160\x68\x6f\156\x65\137\156\165\155\142\145\x72\x73"));
        $sQ = apply_filters("\x6d\157\137\142\154\157\143\x6b\145\x64\137\x70\x68\x6f\x6e\145\163", $sQ);
        return in_array($t2, $sQ);
    }
    public function _get_is_blocked_message()
    {
        $x7 = get_mo_option("\x62\154\x6f\143\x6b\x65\144\x5f\160\x68\x6f\x6e\145\x5f\x6d\145\x73\163\x61\x67\145", "\x6d\157\137\x6f\164\x70\137");
        return $x7 ? $x7 : MoMessages::showMessage(MoMessages::ERROR_PHONE_BLOCKED);
    }
}
