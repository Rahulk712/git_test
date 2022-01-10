<?php


use OTP\Helper\FormList;
use OTP\Helper\FormSessionData;
use OTP\Helper\MoUtility;
use OTP\Objects\FormHandler;
use OTP\Objects\IFormHandler;
use OTP\SplClassLoader;
if (defined("\101\x42\x53\120\101\x54\110")) {
    goto cg;
}
die;
cg:
define("\115\x4f\x56\137\104\111\122", plugin_dir_path(__FILE__));
define("\115\x4f\126\137\x55\122\x4c", plugin_dir_url(__FILE__));
$response = wp_remote_retrieve_body(wp_remote_get(MOV_URL . "\160\141\x63\153\141\x67\145\x2e\x6a\x73\x6f\156", ["\163\163\154\x76\x65\162\151\146\x79"=> false]));
$packageData = empty($response) || (strpos($response, "not found") !== false) ? 
                                    initializePackageJson() :  $response;
$dr =  json_decode($packageData);

define("\x4d\117\x56\x5f\x56\105\122\x53\x49\117\x4e", $dr->version);
define("\115\117\126\137\124\x59\120\x45", $dr->type);
define("\x4d\x4f\x56\x5f\x48\x4f\x53\x54", $dr->hostname);
define("\115\117\126\x5f\104\105\106\101\125\114\x54\x5f\103\x55\123\124\x4f\x4d\x45\122\113\x45\131", $dr->dCustomerKey);
define("\115\x4f\x56\137\x44\x45\106\101\125\114\124\137\101\x50\x49\x4b\x45\x59", $dr->dApiKey);
define("\115\x4f\x56\137\123\123\x4c\137\x56\105\122\x49\x46\x59", $dr->sslVerify);
define("\x4d\x4f\126\137\103\123\x53\x5f\x55\122\114", MOV_URL . "\151\x6e\143\154\x75\144\x65\x73\57\x63\163\x73\x2f\155\157\137\x63\x75\x73\164\x6f\155\145\x72\x5f\x76\x61\154\x69\144\x61\164\x69\x6f\x6e\137\163\164\171\x6c\145\56\155\x69\156\56\143\x73\x73\x3f\x76\x65\162\x73\x69\157\156\75" . MOV_VERSION);
define("\115\x4f\137\111\116\x54\124\x45\114\111\x4e\x50\125\x54\x5f\x43\x53\x53", MOV_URL . "\151\156\x63\154\x75\x64\x65\x73\x2f\x63\163\163\57\151\156\x74\x6c\124\x65\154\111\x6e\x70\165\164\56\x6d\x69\156\56\143\163\x73\77\x76\145\x72\x73\x69\x6f\x6e\75" . MOV_VERSION);
define("\115\x4f\126\137\x4a\123\x5f\125\122\114", MOV_URL . "\151\x6e\x63\154\x75\144\145\x73\57\x6a\163\x2f\x73\x65\164\x74\x69\x6e\147\x73\x2e\155\x69\156\56\x6a\163\x3f\166\145\x72\x73\151\157\156\x3d" . MOV_VERSION);
define("\x56\x41\x4c\111\x44\101\x54\x49\117\116\137\112\x53\x5f\x55\122\x4c", MOV_URL . "\151\156\143\x6c\165\x64\x65\163\x2f\152\x73\57\146\157\x72\155\126\x61\154\x69\144\x61\x74\x69\157\x6e\56\155\x69\x6e\x2e\152\x73\x3f\x76\x65\x72\163\x69\157\x6e\x3d" . MOV_VERSION);
define("\x4d\x4f\x5f\x49\116\124\124\105\114\x49\x4e\120\125\124\x5f\112\x53", MOV_URL . "\151\x6e\x63\x6c\x75\144\145\x73\57\152\x73\57\151\156\x74\154\124\145\x6c\x49\x6e\160\165\x74\56\155\151\x6e\x2e\152\163\77\x76\x65\162\163\151\x6f\156\75" . MOV_VERSION);
define("\115\117\x5f\104\122\117\x50\104\117\127\116\137\112\x53", MOV_URL . "\151\156\143\x6c\x75\144\x65\x73\x2f\152\x73\57\x64\x72\157\x70\144\x6f\x77\x6e\x2e\155\151\x6e\56\152\x73\x3f\166\145\x72\x73\x69\x6f\156\75" . MOV_VERSION);
define("\x4d\117\126\x5f\114\x4f\x41\x44\x45\x52\137\x55\x52\x4c", MOV_URL . "\151\156\143\x6c\x75\144\x65\163\57\x69\155\141\x67\x65\x73\x2f\x6c\157\x61\x64\x65\x72\56\147\x69\x66");
define("\x4d\x4f\x56\137\x4c\x4f\107\117\137\x55\x52\x4c", MOV_URL . "\x69\156\143\x6c\x75\x64\145\x73\57\151\155\x61\147\145\x73\57\154\157\147\157\56\x70\156\147");
define("\x4d\x4f\x56\x5f\111\103\117\116", MOV_URL . "\151\156\143\154\165\144\x65\x73\57\151\x6d\x61\147\145\163\x2f\155\151\156\151\157\x72\x61\156\147\x65\137\151\143\157\x6e\56\x70\156\x67");
define("\115\117\126\x5f\101\x44\x44\117\116\x5f\104\x49\x52", MOV_DIR . "\141\144\x64\55\157\x6e\163\x2f");
define("\115\117\126\137\125\x53\105\x5f\120\x4f\114\131\114\x41\x4e\x47", TRUE);
define("\115\117\137\x54\x45\123\x54\137\115\x4f\x44\105", $dr->testMode);
define("\x4d\x4f\137\106\x41\111\114\x5f\x4d\x4f\x44\x45", $dr->failMode);
define("\x4d\x4f\126\137\123\105\x53\123\111\117\116\137\x54\x59\x50\105", $dr->session);
include "\123\160\x6c\103\x6c\x61\x73\x73\x4c\157\x61\144\x65\162\x2e\x70\x68\x70";
$e3 = new SplClassLoader("\117\124\120", realpath(__DIR__ . DIRECTORY_SEPARATOR . "\x2e\x2e"));
$e3->register();
require_once "\166\x69\x65\167\x73\57\143\157\x6d\155\157\x6e\x2d\145\x6c\x65\x6d\145\x6e\x74\x73\56\160\150\160";
initializeForms();
function initializeForms()
{
    $gS = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(MOV_DIR . "\x68\x61\156\144\x6c\145\162\x2f\146\157\162\155\163", RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::LEAVES_ONLY);
    foreach ($gS as $aw) {
        $iP = $aw->getFilename();
        $h3 = "\117\x54\120\134\x48\141\x6e\x64\154\145\x72\x5c\106\157\162\x6d\x73\x5c" . str_replace("\x2e\160\x68\160", '', $iP);
        $JC = FormList::instance();
        $BN = $h3::instance();
        $JC->add($BN->getFormKey(), $BN);
        Hl:
    }
    ms:
}
function admin_post_url()
{
    return admin_url("\x61\x64\x6d\x69\x6e\x2d\x70\157\163\x74\x2e\160\x68\x70");
}
function wp_ajax_url()
{
    return admin_url("\141\144\155\x69\156\55\141\x6a\141\x78\56\160\150\x70");
}
function mo_($WI)
{
    $FD = "\x6d\x69\156\x69\x6f\162\x61\156\x67\145\55\x6f\164\x70\55\166\x65\x72\151\146\151\143\x61\x74\x69\157\x6e";
    $WI = preg_replace("\x2f\134\163\53\x2f\x53", "\x20", $WI);
    return is_scalar($WI) ? MoUtility::_is_polylang_installed() && MOV_USE_POLYLANG ? pll__($WI) : __($WI, $FD) : $WI;
}
function get_mo_option($WI, $E4 = null)
{
    $WI = ($E4 === null ? "\x6d\x6f\x5f\x63\165\163\x74\157\x6d\x65\162\x5f\166\x61\x6c\x69\x64\141\164\151\x6f\x6e\137" : $E4) . $WI;
    return apply_filters("\147\145\164\x5f\155\x6f\x5f\157\160\x74\x69\x6f\x6e", get_site_option($WI));
}
function update_mo_option($WI, $sA, $E4 = null)
{
    $WI = ($E4 === null ? "\155\157\x5f\143\165\x73\164\x6f\155\x65\x72\x5f\x76\141\154\151\x64\x61\x74\x69\157\x6e\x5f" : $E4) . $WI;
    update_site_option($WI, apply_filters("\x75\160\x64\x61\164\x65\137\x6d\x6f\x5f\x6f\160\164\151\157\x6e", $sA, $WI));
}
function delete_mo_option($WI, $E4 = null)
{
    $WI = ($E4 === null ? "\155\157\137\x63\x75\163\164\x6f\x6d\145\x72\137\166\x61\x6c\x69\x64\x61\164\x69\x6f\156\137" : $E4) . $WI;
    delete_site_option($WI);
}
function get_mo_class($go)
{
    $hc = get_class($go);
    return substr($hc, strrpos($hc, "\x5c") + 1);
}

function initializePackageJson(){
           $package = json_encode(["name"=>"miniorange-otp-verification-onprem","version"=>"3.4","type"=>"CustomGatewayWithAddons","testMode"=>false,"failMode"=>false,"hostname"=>"https://login.xecurify.com","dCustomerKey"=>"16555","dApiKey"=>"fFd2XcvTGDemZvbw1bcUesNJWEqKbbUq","sslVerify"=>false,"session"=>"TRANSIENT"]);
            return $package;
     }