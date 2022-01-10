<?php


namespace OTP\Objects;

interface MoITemplate
{
    public function build($b2, $ZL, $bJ, $e7, $Rw);
    public function parse($b2, $bJ, $e7, $Rw);
    public function getDefaults($fD);
    public function showPreview();
    public function savePopup();
    public static function instance();
    public function getTemplateKey();
    public function getTemplateEditorId();
}
