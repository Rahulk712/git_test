<?php


namespace OTP\Handler;

if (defined("\x41\x42\x53\120\101\124\110")) {
    goto Eq;
}
die;
Eq:
use OTP\Helper\FormSessionVars;
use OTP\Helper\GatewayFunctions;
use OTP\Helper\MoMessages;
use OTP\Helper\MoPHPSessions;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
use OTP\Objects\BaseActionHandler;
use OTP\Objects\VerificationType;
use OTP\Traits\Instance;
class FormActionHandler extends BaseActionHandler
{
    use Instance;
    function __construct()
    {
        parent::__construct();
        $this->_nonce = "\155\157\x5f\146\157\162\x6d\x5f\x61\143\x74\151\157\x6e\163";
        add_action("\x69\x6e\x69\164", array($this, "\150\141\156\144\x6c\x65\x46\x6f\162\x6d\101\x63\164\151\x6f\156\x73"), 1);
        add_action("\155\x6f\137\x76\141\154\x69\144\x61\164\145\137\157\x74\160", array($this, "\x76\x61\x6c\151\x64\141\164\145\117\x54\x50"), 1, 3);
        add_action("\155\157\x5f\147\x65\x6e\x65\162\x61\x74\145\137\157\164\160", array($this, "\143\150\141\x6c\x6c\145\156\x67\145"), 2, 8);
        add_filter("\x6d\157\x5f\x66\151\154\x74\145\x72\x5f\x70\x68\157\156\x65\137\142\145\x66\x6f\x72\145\x5f\141\160\x69\137\143\141\154\x6c", array($this, "\146\151\x6c\x74\145\162\x50\x68\157\156\x65"), 1, 1);
    }
    public function challenge($u0, $Kc, $errors, $t2 = null, $e7 = "\x65\155\x61\151\154", $wh = '', $SU = null, $Rw = false)
    {
        $t2 = MoUtility::processPhoneNumber($t2);
        MoPHPSessions::addSessionVar("\143\165\162\162\x65\156\164\x5f\x75\x72\154", MoUtility::currentPageUrl());
        MoPHPSessions::addSessionVar("\x75\163\145\162\137\145\x6d\141\x69\154", $Kc);
        MoPHPSessions::addSessionVar("\x75\x73\145\162\x5f\x6c\157\147\151\x6e", $u0);
        MoPHPSessions::addSessionVar("\165\x73\145\x72\137\160\x61\163\x73\167\157\162\x64", $wh);
        MoPHPSessions::addSessionVar("\x70\x68\x6f\x6e\x65\137\x6e\x75\x6d\x62\145\x72\x5f\x6d\157", $t2);
        MoPHPSessions::addSessionVar("\145\x78\x74\162\141\137\x64\x61\164\x61", $SU);
        $this->handleOTPAction($u0, $Kc, $t2, $e7, $Rw, $SU);
    }
    private function handleResendOTP($e7, $Rw)
    {
        $Kc = MoPHPSessions::getSessionVar("\x75\x73\x65\162\x5f\145\x6d\141\x69\154");
        $u0 = MoPHPSessions::getSessionVar("\165\163\x65\162\x5f\x6c\x6f\x67\x69\156");
        $t2 = MoPHPSessions::getSessionVar("\x70\x68\157\x6e\x65\137\156\165\155\x62\145\162\x5f\x6d\x6f");
        $SU = MoPHPSessions::getSessionVar("\x65\x78\x74\162\141\x5f\144\x61\164\141");
        $this->handleOTPAction($u0, $Kc, $t2, $e7, $Rw, $SU);
    }
    function handleOTPAction($u0, $Kc, $t2, $e7, $Rw, $SU)
    {
        global $phoneLogic, $emailLogic;
        switch ($e7) {
            case VerificationType::PHONE:
                $phoneLogic->_handle_logic($u0, $Kc, $t2, $e7, $Rw);
                goto mH;
            case VerificationType::EMAIL:
                $emailLogic->_handle_logic($u0, $Kc, $t2, $e7, $Rw);
                goto mH;
            case VerificationType::BOTH:
                miniorange_verification_user_choice($u0, $Kc, $t2, MoMessages::showMessage(MoMessages::CHOOSE_METHOD), $e7);
                goto mH;
            case VerificationType::EXTERNAL:
                mo_external_phone_validation_form($SU["\x63\x75\x72\x6c"], $Kc, $SU["\x6d\145\x73\x73\141\x67\x65"], $SU["\146\x6f\162\155"], $SU["\x64\x61\164\141"]);
                goto mH;
        }
        Gl:
        mH:
    }
    function handleGoBackAction()
    {
        $px = MoPHPSessions::getSessionVar("\143\165\x72\x72\x65\156\164\137\165\162\154");
        do_action("\x75\x6e\163\x65\x74\x5f\x73\145\x73\x73\151\x6f\156\x5f\x76\141\162\x69\141\142\154\x65");
        header("\x6c\157\x63\141\x74\x69\x6f\156\x3a" . $px);
    }
    function validateOTP($m5, $c9, $Va)
    {
        $u0 = MoPHPSessions::getSessionVar("\165\x73\145\162\137\x6c\x6f\x67\151\x6e");
        $Kc = MoPHPSessions::getSessionVar("\165\x73\145\162\137\x65\155\x61\151\x6c");
        $t2 = MoPHPSessions::getSessionVar("\160\150\157\156\145\x5f\156\x75\155\x62\145\162\x5f\x6d\157");
        $wh = MoPHPSessions::getSessionVar("\165\x73\x65\x72\x5f\160\x61\163\x73\167\x6f\162\144");
        $SU = MoPHPSessions::getSessionVar("\x65\x78\x74\162\141\x5f\144\141\164\141");
        $lb = Sessionutils::getTransactionId($m5);
        $rG = MoUtility::sanitizeCheck($c9, $_REQUEST);
        $rG = !$rG ? $Va : $rG;
        if (is_null($lb)) {
            goto gf;
        }
        $Xk = GatewayFunctions::instance();
        $zv = $Xk->mo_validate_otp_token($lb, $rG);
        switch ($zv["\x73\164\141\164\x75\163"]) {
            case "\x53\x55\103\x43\105\x53\x53":
                $this->onValidationSuccess($u0, $Kc, $wh, $t2, $SU, $m5);
                goto zb;
            default:
                $this->onValidationFailed($u0, $Kc, $t2, $m5);
                goto zb;
        }
        nn:
        zb:
        gf:
    }
    private function onValidationSuccess($u0, $Kc, $wh, $t2, $SU, $m5)
    {
        $fC = array_key_exists("\162\145\x64\x69\162\145\x63\164\137\x74\x6f", $_POST) ? $_POST["\x72\145\144\x69\162\145\143\x74\x5f\x74\157"] : '';
        do_action("\x6f\164\160\x5f\166\145\x72\151\146\151\143\x61\x74\151\x6f\x6e\137\163\165\143\143\145\163\163\146\165\x6c", $fC, $u0, $Kc, $wh, $t2, $SU, $m5);
    }
    private function onValidationFailed($u0, $Kc, $t2, $m5)
    {
        do_action("\157\164\160\x5f\166\x65\x72\151\146\x69\143\x61\x74\151\x6f\156\137\146\141\x69\154\145\x64", $u0, $Kc, $t2, $m5);
    }
    private function handleOTPChoice($gt)
    {
        $Qp = MoPHPSessions::getSessionVar("\165\163\145\162\x5f\154\x6f\147\151\156");
        $I4 = MoPHPSessions::getSessionVar("\165\x73\145\x72\137\x65\155\x61\x69\x6c");
        $fB = MoPHPSessions::getSessionVar("\x70\x68\157\x6e\x65\x5f\x6e\x75\155\x62\145\162\137\x6d\157");
        $Dz = MoPHPSessions::getSessionVar("\x75\x73\145\x72\137\x70\x61\x73\163\x77\x6f\x72\144");
        $lV = MoPHPSessions::getSessionVar("\145\x78\164\162\141\x5f\x64\141\x74\141");
        $Jw = strcasecmp($gt["\155\157\137\x63\x75\x73\164\x6f\x6d\x65\x72\137\166\x61\154\151\144\141\164\151\x6f\156\137\157\x74\x70\137\143\x68\157\151\143\x65"], "\x75\163\145\162\137\145\x6d\141\x69\154\137\166\145\162\151\146\x69\x63\x61\164\151\157\156") == 0 ? VerificationType::EMAIL : VerificationType::PHONE;
        $this->challenge($Qp, $I4, null, $fB, $Jw, $Dz, $lV, true);
    }
    function filterPhone($lr)
    {
        return str_replace("\53", '', $lr);
    }
    function handleFormActions()
    {
        if (!(array_key_exists("\x6f\x70\x74\x69\x6f\x6e", $_REQUEST) && MoUtility::micr())) {
            goto ei;
        }
        $Rw = MoUtility::sanitizeCheck("\x66\162\x6f\155\x5f\x62\157\164\150", $_POST);
        $m5 = MoUtility::sanitizeCheck("\x6f\x74\160\137\x74\x79\160\145", $_POST);
        switch (trim($_REQUEST["\157\160\164\x69\x6f\156"])) {
            case "\x76\x61\154\151\x64\x61\164\151\x6f\156\x5f\147\157\x42\141\143\x6b":
                $this->handleGoBackAction();
                goto tS;
            case "\x6d\x69\x6e\151\x6f\x72\141\x6e\147\145\55\x76\x61\x6c\x69\144\141\x74\x65\55\x6f\x74\160\55\146\157\162\x6d":
                $this->validateOTP($m5, "\155\157\x5f\x6f\x74\160\137\x74\x6f\153\145\156", null);
                goto tS;
            case "\166\x65\162\151\146\x69\143\141\x74\x69\157\156\x5f\162\x65\x73\x65\x6e\144\137\x6f\x74\x70":
                $this->handleResendOTP($m5, $Rw);
                goto tS;
            case "\x6d\x69\x6e\151\x6f\162\x61\x6e\147\145\x2d\166\x61\x6c\x69\x64\x61\x74\x65\55\x6f\x74\160\55\143\150\x6f\x69\x63\145\x2d\146\157\162\155":
                $this->handleOTPChoice($_POST);
                goto tS;
        }
        CZ:
        tS:
        ei:
    }
}
