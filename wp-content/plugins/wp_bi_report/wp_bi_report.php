<?php 


/*
 * Plugin Name: AffiliateWP - BI Report
 * Description: Plugin for BI Reports
 * Author: Manjunath Sharma K
 * Version: 1.1
 * @package AffiliateWP
 * @category Core
 * @author Manjunath Sharma K
 * @version 1.1
 */


add_action( 'bi_daily_hook', 'update_bi_data' );
function update_bi_data(){
global $wpdb;
$fromDate=date('Y-m-d',strtotime('-1 days'));
$toDate=date('Y-m-d');
$call_procedure=$wpdb->get_results("call channel_turnover('".$fromDate."','".$toDate."')");
}


?>