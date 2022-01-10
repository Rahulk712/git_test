<?php


namespace OTP\Objects;

use OTP\Helper\FormList;
use OTP\Helper\FormSessionVars;
use OTP\Helper\MoConstants;
use OTP\Helper\MoMessages;
use OTP\Helper\MoUtility;
use OTP\Helper\SessionUtils;
class FormHandler
{
    protected $_typePhoneTag;
    protected $_typeEmailTag;
    protected $_typeBothTag;
    protected $_formKey;
    protected $_formName;
    protected $_otpType;
    protected $_phoneFormId;
    protected $_isFormEnabled;
    protected $_restrictDuplicates;
    protected $_byPassLogin;
    protected $_isLoginOrSocialForm;
    protected $_isAjaxForm;
    protected $_phoneKey;
    protected $_emailKey;
    protected $_buttonText;
    protected $_formDetails;
    protected $_disableAutoActivate;
    protected $_formSessionVar;
    protected $_formSessionVar2;
    protected $_nonce = "\146\157\x72\155\x5f\156\x6f\156\x63\145";
    protected $_txSessionId = FormSessionVars::TX_SESSION_ID;
    protected $_formOption = "\155\157\x5f\x63\165\163\164\157\155\145\162\x5f\x76\141\154\151\144\141\164\x69\x6f\x6e\x5f\x73\x65\x74\164\x69\x6e\147\163";
    protected $_generateOTPAction;
    protected $_validateOTPAction;
    protected $_nonceKey = "\163\145\143\165\x72\151\x74\171";
    protected $_isAddOnForm = FALSE;
    protected $_formDocuments = array();
    const VALIDATED = "\126\x41\x4c\111\104\101\x54\105\104";
    const VERIFICATION_FAILED = "\166\x65\x72\151\x66\x69\x63\141\x74\151\x6f\x6e\x5f\146\x61\151\154\x65\x64";
    const VALIDATION_CHECKED = "\x76\141\x6c\151\144\x61\x74\x69\157\156\x43\x68\x65\x63\153\145\x64";
    protected function __construct()
    {
        add_action("\141\144\155\x69\156\137\x69\156\x69\164", array($this, "\150\x61\x6e\x64\154\145\x46\157\x72\x6d\117\x70\x74\151\x6f\x6e\163"), 2);
        if (!(!MoUtility::micr() || !$this->isFormEnabled())) {
            goto fL;
        }
        return;
        fL:
        add_action("\151\x6e\x69\164", array($this, "\150\141\156\144\154\145\106\157\162\155"), 1);
        add_filter("\155\x6f\137\x70\x68\x6f\x6e\145\137\144\162\157\x70\144\x6f\x77\x6e\137\x73\x65\x6c\x65\143\x74\x6f\162", array($this, "\x67\x65\x74\x50\150\157\156\x65\116\x75\x6d\142\x65\162\x53\145\154\145\x63\x74\157\x72"), 1, 1);
        if (!(SessionUtils::isOTPInitialized($this->_formSessionVar) || SessionUtils::isOTPInitialized($this->_formSessionVar2))) {
            goto jy;
        }
        add_action("\157\164\x70\137\166\x65\162\x69\x66\151\143\x61\x74\x69\x6f\156\137\x73\165\143\143\145\x73\163\146\165\154", array($this, "\150\141\x6e\144\154\x65\137\x70\x6f\163\164\x5f\166\145\162\151\146\151\143\x61\164\151\157\x6e"), 1, 7);
        add_action("\157\x74\x70\137\166\145\x72\151\x66\151\x63\141\164\151\157\x6e\x5f\146\141\x69\x6c\x65\144", array($this, "\150\141\x6e\x64\154\x65\137\146\141\x69\154\145\x64\x5f\166\x65\162\x69\146\x69\143\x61\164\151\x6f\156"), 1, 4);
        add_action("\165\156\x73\145\x74\x5f\163\145\x73\x73\151\x6f\156\x5f\x76\x61\162\151\141\x62\154\145", array($this, "\165\x6e\x73\x65\164\x4f\124\x50\123\145\x73\163\x69\x6f\156\x56\141\162\x69\141\x62\154\x65\x73"), 1, 0);
        jy:
        add_filter("\x69\163\x5f\x61\152\141\x78\137\x66\157\162\155", array($this, "\151\x73\137\141\152\x61\170\137\146\157\x72\x6d\137\x69\x6e\137\160\x6c\x61\x79"), 1, 1);
        add_filter("\x69\163\137\x6c\x6f\147\151\156\x5f\157\162\137\163\x6f\143\x69\x61\154\x5f\146\x6f\x72\x6d", array($this, "\151\163\114\x6f\147\151\156\x4f\162\x53\x6f\143\x69\141\154\106\157\162\x6d"), 1, 1);
        $JC = FormList::instance();
        $JC->add($this->getFormKey(), $this);
    }
    public function isLoginOrSocialForm($Sk)
    {
        return SessionUtils::isOTPInitialized($this->_formSessionVar) ? $this->getisLoginOrSocialForm() : $Sk;
    }
    public function is_ajax_form_in_play($as)
    {
        return SessionUtils::isOTPInitialized($this->_formSessionVar) ? $this->_isAjaxForm : $as;
    }
    public function sanitizeFormPOST($LR, $E4 = null)
    {
        $LR = ($E4 === null ? "\155\x6f\137\x63\x75\x73\x74\x6f\x6d\145\x72\137\166\141\x6c\151\x64\141\x74\x69\157\156\x5f" : '') . $LR;
        return MoUtility::sanitizeCheck($LR, $_POST);
    }
    public function sendChallenge($u0, $Kc, $errors, $t2 = null, $e7 = "\145\x6d\x61\x69\x6c", $wh = '', $SU = null, $Rw = false)
    {
        do_action("\x6d\x6f\x5f\x67\x65\156\145\x72\141\164\x65\x5f\x6f\x74\x70", $u0, $Kc, $errors, $t2, $e7, $wh, $SU, $Rw);
    }
    public function validateChallenge($m5, $tw = "\155\157\x5f\157\164\160\x5f\164\x6f\153\145\x6e", $XS = NULL)
    {
        do_action("\155\157\137\x76\141\154\x69\x64\x61\x74\x65\137\x6f\164\160", $m5, $tw, $XS);
    }
    public function basicValidationCheck($bJ)
    {
        if (!($this->isFormEnabled() && MoUtility::isBlank($this->_otpType))) {
            goto eT;
        }
        do_action("\155\157\x5f\x72\x65\x67\151\163\x74\x72\141\164\x69\157\156\137\x73\x68\x6f\167\137\155\x65\x73\x73\x61\x67\145", MoMessages::showMessage($bJ), MoConstants::ERROR);
        return false;
        eT:
        return true;
    }
    public function getVerificationType()
    {
        $Ap = array($this->_typePhoneTag => VerificationType::PHONE, $this->_typeEmailTag => VerificationType::EMAIL, $this->_typeBothTag => VerificationType::BOTH);
        return MoUtility::isBlank($this->_otpType) ? false : $Ap[$this->_otpType];
    }
    protected function validateAjaxRequest()
    {
        if (check_ajax_referer($this->_nonce, $this->_nonceKey)) {
            goto kk;
        }
        wp_send_json(MoUtility::createJson(MoMessages::showMessage(BaseMessages::INVALID_OP), MoConstants::ERROR_JSON_TYPE));
        die;
        kk:
    }
    protected function ajaxProcessingFields()
    {
        $Ap = array($this->_typePhoneTag => array(VerificationType::PHONE), $this->_typeEmailTag => array(VerificationType::EMAIL), $this->_typeBothTag => array(VerificationType::PHONE, VerificationType::EMAIL));
        return $Ap[$this->_otpType];
    }
    public function getPhoneHTMLTag()
    {
        return $this->_typePhoneTag;
    }
    public function getEmailHTMLTag()
    {
        return $this->_typeEmailTag;
    }
    public function getBothHTMLTag()
    {
        return $this->_typeBothTag;
    }
    public function getFormKey()
    {
        return $this->_formKey;
    }
    public function getFormName()
    {
        return $this->_formName;
    }
    public function getOtpTypeEnabled()
    {
        return $this->_otpType;
    }
    public function disableAutoActivation()
    {
        return $this->_disableAutoActivate;
    }
    public function getPhoneKeyDetails()
    {
        return $this->_phoneKey;
    }
    public function getEmailKeyDetails()
    {
        return $this->_emailKey;
    }
    public function isFormEnabled()
    {
        return $this->_isFormEnabled;
    }
    public function getButtonText()
    {
        return mo_($this->_buttonText);
    }
    public function getFormDetails()
    {
        return $this->_formDetails;
    }
    public function restrictDuplicates()
    {
        return $this->_restrictDuplicates;
    }
    public function bypassForLoggedInUsers()
    {
        return $this->_byPassLogin;
    }
    public function getisLoginOrSocialForm()
    {
        return (bool) $this->_isLoginOrSocialForm;
    }
    public function getFormOption()
    {
        return $this->_formOption;
    }
    public function isAjaxForm()
    {
        return $this->_isAjaxForm;
    }
    public function isAddOnForm()
    {
        return $this->_isAddOnForm;
    }
    public function getFormDocuments()
    {
        return $this->_formDocuments;
    }
}
