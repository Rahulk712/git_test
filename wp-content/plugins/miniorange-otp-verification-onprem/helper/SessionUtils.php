<?php


namespace OTP\Helper;

if (defined("\101\102\x53\x50\x41\x54\110")) {
    goto l4;
}
die;
l4:
use OTP\Objects\FormSessionData;
use OTP\Objects\TransactionSessionData;
use OTP\Objects\VerificationType;
final class SessionUtils
{
    static function isOTPInitialized($xl)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto Es;
        }
        return $nk->getIsInitialized();
        Es:
        return FALSE;
    }
    static function addEmailOrPhoneVerified($xl, $Kw, $m5)
    {
        switch ($m5) {
            case VerificationType::PHONE:
                self::addPhoneVerified($xl, $Kw);
                goto iN;
            case VerificationType::EMAIL:
                self::addEmailVerified($xl, $Kw);
                goto iN;
        }
        fz:
        iN:
    }
    static function addEmailSubmitted($xl, $Kw)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto ah;
        }
        $nk->setEmailSubmitted($Kw);
        MoPHPSessions::addSessionVar($xl, $nk);
        ah:
    }
    static function addPhoneSubmitted($xl, $Kw)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto XK;
        }
        $nk->setPhoneSubmitted($Kw);
        MoPHPSessions::addSessionVar($xl, $nk);
        XK:
    }
    static function addEmailVerified($xl, $Kw)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto Ix;
        }
        $nk->setEmailVerified($Kw);
        MoPHPSessions::addSessionVar($xl, $nk);
        Ix:
    }
    static function addPhoneVerified($xl, $Kw)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto Uo;
        }
        $nk->setPhoneVerified($Kw);
        MoPHPSessions::addSessionVar($xl, $nk);
        Uo:
    }
    static function addStatus($xl, $Kw, $WP)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto hT;
        }
        if ($nk->getIsInitialized()) {
            goto J6;
        }
        return;
        J6:
        if (!($WP === VerificationType::EMAIL)) {
            goto xO;
        }
        $nk->setEmailVerificationStatus($Kw);
        xO:
        if (!($WP === VerificationType::PHONE)) {
            goto AS1;
        }
        $nk->setPhoneVerificationStatus($Kw);
        AS1:
        MoPHPSessions::addSessionVar($xl, $nk);
        hT:
    }
    static function isStatusMatch($xl, $eg, $WP)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto Ve;
        }
        switch ($WP) {
            case VerificationType::EMAIL:
                return $eg === $nk->getEmailVerificationStatus();
            case VerificationType::PHONE:
                return $eg === $nk->getPhoneVerificationStatus();
            case VerificationType::BOTH:
                return $eg === $nk->getEmailVerificationStatus() || $eg === $nk->getPhoneVerificationStatus();
        }
        va:
        hO:
        Ve:
        return FALSE;
    }
    static function isEmailVerifiedMatch($xl, $WI)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto G9;
        }
        return $WI === $nk->getEmailVerified();
        G9:
        return FALSE;
    }
    static function isPhoneVerifiedMatch($xl, $WI)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto TE;
        }
        return $WI === $nk->getPhoneVerified();
        TE:
        return FALSE;
    }
    static function setEmailTransactionID($Js)
    {
        $cL = MoPHPSessions::getSessionVar(FormSessionVars::TX_SESSION_ID);
        if ($cL instanceof TransactionSessionData) {
            goto GO;
        }
        $cL = new TransactionSessionData();
        GO:
        $cL->setEmailTransactionId($Js);
        MoPHPSessions::addSessionVar(FormSessionVars::TX_SESSION_ID, $cL);
    }
    static function setPhoneTransactionID($Js)
    {
        $cL = MoPHPSessions::getSessionVar(FormSessionVars::TX_SESSION_ID);
        if ($cL instanceof TransactionSessionData) {
            goto Du;
        }
        $cL = new TransactionSessionData();
        Du:
        $cL->setPhoneTransactionId($Js);
        MoPHPSessions::addSessionVar(FormSessionVars::TX_SESSION_ID, $cL);
    }
    static function getTransactionId($m5)
    {
        $cL = MoPHPSessions::getSessionVar(FormSessionVars::TX_SESSION_ID);
        if (!$cL instanceof TransactionSessionData) {
            goto K2;
        }
        switch ($m5) {
            case VerificationType::EMAIL:
                return $cL->getEmailTransactionId();
            case VerificationType::PHONE:
                return $cL->getPhoneTransactionId();
            case VerificationType::BOTH:
                return MoUtility::isBlank($cL->getPhoneTransactionId()) ? $cL->getEmailTransactionId() : $cL->getPhoneTransactionId();
        }
        fs:
        s3:
        K2:
        return '';
    }
    static function unsetSession($qj)
    {
        foreach ($qj as $xl) {
            MoPHPSessions::unsetSession($xl);
            iS:
        }
        uE:
    }
    static function isPhoneSubmittedAndVerifiedMatch($xl)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto ef;
        }
        return $nk->getPhoneVerified() === $nk->getPhoneSubmitted();
        ef:
        return FALSE;
    }
    static function isEmailSubmittedAndVerifiedMatch($xl)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto eh;
        }
        return $nk->getEmailVerified() === $nk->getEmailSubmitted();
        eh:
        return FALSE;
    }
    static function setFormOrFieldId($xl, $Kw)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto f2;
        }
        $nk->setFieldOrFormId($Kw);
        MoPHPSessions::addSessionVar($xl, $nk);
        f2:
    }
    static function getFormOrFieldId($xl)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto zd;
        }
        return $nk->getFieldOrFormId();
        zd:
        return '';
    }
    static function initializeForm($form)
    {
        $nk = new FormSessionData();
        MoPHPSessions::addSessionVar($form, $nk->init());
    }
    static function addUserInSession($xl, $Kw)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto zu;
        }
        $nk->setUserSubmitted($Kw);
        MoPHPSessions::addSessionVar($xl, $nk);
        zu:
    }
    static function getUserSubmitted($xl)
    {
        $nk = MoPHPSessions::getSessionVar($xl);
        if (!$nk instanceof FormSessionData) {
            goto oN;
        }
        return $nk->getUserSubmitted();
        oN:
        return '';
    }
}
