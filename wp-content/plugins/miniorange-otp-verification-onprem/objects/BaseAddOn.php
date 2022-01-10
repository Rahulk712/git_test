<?php


namespace OTP\Objects;

abstract class BaseAddOn implements AddOnInterface
{
    function __construct()
    {
        $this->initializeHelpers();
        $this->initializeHandlers();
        add_action("\x6d\x6f\137\157\164\160\137\x76\145\x72\151\146\x69\x63\141\x74\x69\157\x6e\x5f\141\x64\x64\x5f\157\156\137\143\157\156\x74\162\x6f\x6c\x6c\x65\x72", array($this, "\x73\150\157\x77\x5f\141\144\x64\157\156\x5f\163\145\164\x74\x69\156\147\163\x5f\160\141\147\x65"), 1, 1);
    }
}
