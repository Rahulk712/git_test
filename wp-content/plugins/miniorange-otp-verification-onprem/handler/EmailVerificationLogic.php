<?php


namespace OTP\Handler;

if (defined("\101\x42\x53\x50\101\124\110")) {
    goto PR;
}
die;
PR:
use OTP\Helper\FormSessionVars;
use OTP\Helper\GatewayFunctions;
use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\VerificationLogic;
use OTP\Traits\Instance;
final class EmailVerificationLogic extends VerificationLogic
{
    use Instance;
    public function _handle_logic($u0, $Kc, $t2, $e7, $Rw)
    {
        if (is_email($Kc)) {
            goto q9;
        }
        $this->_handle_not_matched($Kc, $e7, $Rw);
        goto n9;
        q9:
        $this->_handle_matched($u0, $Kc, $t2, $e7, $Rw);
        n9:
    }
    public function _handle_matched($u0, $Kc, $t2, $e7, $Rw)
    {
        $bJ = str_replace("\x23\43\145\x6d\141\151\154\x23\43", $Kc, $this->_get_is_blocked_message());
        if ($this->_is_blocked($Kc, $t2)) {
            goto ey;
        }
        $this->_start_otp_verification($u0, $Kc, $t2, $e7, $Rw);
        goto dI;
        ey:
        if ($this->_is_ajax_form()) {
            goto k5;
        }
        miniorange_site_otp_validation_form(null, null, null, $bJ, $e7, $Rw);
        goto sn;
        k5:
        wp_send_json(MoUtility::createJson($bJ, MoConstants::ERROR_JSON_TYPE));
        sn:
        dI:
    }
    public function _handle_not_matched($Kc, $e7, $Rw)
    {
        $bJ = str_replace("\43\x23\x65\155\x61\x69\154\x23\43", $Kc, $this->_get_otp_invalid_format_message());
        if ($this->_is_ajax_form()) {
            goto QL;
        }
        miniorange_site_otp_validation_form(null, null, null, $bJ, $e7, $Rw);
        goto Dx;
        QL:
        wp_send_json(MoUtility::createJson($bJ, MoConstants::ERROR_JSON_TYPE));
        Dx:
    }
    public function _start_otp_verification($u0, $Kc, $t2, $e7, $Rw)
    {
        $Xk = GatewayFunctions::instance();
        $zv = $Xk->mo_send_otp_token("\x45\x4d\101\x49\x4c", $Kc, '');
        switch ($zv["\x73\164\141\x74\165\x73"]) {
            case "\123\125\x43\103\105\x53\x53":
                $this->_handle_otp_sent($u0, $Kc, $t2, $e7, $Rw, $zv);
                goto Ma;
            default:
                $this->_handle_otp_sent_failed($u0, $Kc, $t2, $e7, $Rw, $zv);
                goto Ma;
        }
        Ry:
        Ma:
    }
    public function _handle_otp_sent($u0, $Kc, $t2, $e7, $Rw, $zv)
    {
        SessionUtils::setEmailTransactionID($zv["\164\170\x49\x64"]);
        if (!(MoUtility::micr() && MoUtility::isMG())) {
            goto NN;
        }
        update_mo_option("\x65\x6d\141\151\154\x5f\164\x72\141\156\x73\x61\x63\164\151\x6f\156\x73\x5f\162\x65\x6d\141\151\x6e\x69\156\x67", get_mo_option("\145\155\x61\x69\x6c\x5f\x74\162\x61\156\163\x61\x63\164\x69\157\x6e\163\137\x72\145\155\141\151\x6e\151\156\x67") - 1);
        NN:
        $bJ = str_replace("\43\x23\145\155\141\x69\154\43\43", $Kc, $this->_get_otp_sent_message());
        if ($this->_is_ajax_form()) {
            goto Z8;
        }
        miniorange_site_otp_validation_form($u0, $Kc, $t2, $bJ, $e7, $Rw);
        goto ub;
        Z8:
        wp_send_json(MoUtility::createJson($bJ, MoConstants::SUCCESS_JSON_TYPE));
        ub:
    }
    public function _handle_otp_sent_failed($u0, $Kc, $t2, $e7, $Rw, $zv)
    {
        $bJ = str_replace("\43\43\145\x6d\141\x69\154\x23\43", $Kc, $this->_get_otp_sent_failed_message());
        if ($this->_is_ajax_form()) {
            goto sj;
        }
        miniorange_site_otp_validation_form(null, null, null, $bJ, $e7, $Rw);
        goto jJ;
        sj:
        wp_send_json(MoUtility::createJson($bJ, MoConstants::ERROR_JSON_TYPE));
        jJ:
    }
    public function _get_otp_sent_message()
    {
        $b3 = get_mo_option("\x73\x75\x63\143\145\x73\163\137\x65\x6d\x61\x69\x6c\x5f\155\x65\163\x73\x61\147\x65", "\x6d\x6f\137\x6f\164\160\x5f");
        return $b3 ? $b3 : MoMessages::showMessage(MoMessages::OTP_SENT_EMAIL);
    }
    public function _get_otp_sent_failed_message()
    {
        $Kt = get_mo_option("\145\162\162\x6f\x72\x5f\145\x6d\x61\151\154\x5f\155\145\163\163\x61\x67\145", "\x6d\157\x5f\x6f\x74\160\137");
        return $Kt ? $Kt : MoMessages::showMessage(MoMessages::ERROR_OTP_EMAIL);
    }
    public function _is_blocked($Kc, $t2)
    {
        $Se = explode("\x3b", get_mo_option("\142\x6c\157\x63\x6b\x65\144\x5f\x64\157\x6d\141\x69\156\163"));
        $Se = apply_filters("\x6d\157\137\142\x6c\157\x63\x6b\145\x64\137\x65\155\141\x69\x6c\137\144\x6f\x6d\141\151\x6e\x73", $Se);
        return in_array(MoUtility::getDomain($Kc), $Se);
    }
    public function _get_is_blocked_message()
    {
        $mr = get_mo_option("\142\154\157\143\x6b\145\144\x5f\145\155\141\x69\154\x5f\155\145\x73\163\x61\x67\x65", "\x6d\157\x5f\x6f\x74\x70\x5f");
        return $mr ? $mr : MoMessages::showMessage(MoMessages::ERROR_EMAIL_BLOCKED);
    }
    public function _get_otp_invalid_format_message()
    {
        $bJ = get_mo_option("\x69\156\166\x61\154\x69\144\x5f\145\155\x61\151\154\x5f\x6d\x65\x73\163\x61\x67\x65", "\x6d\157\137\157\164\160\137");
        return $bJ ? $bJ : MoMessages::showMessage(MoMessages::ERROR_EMAIL_FORMAT);
    }
}
