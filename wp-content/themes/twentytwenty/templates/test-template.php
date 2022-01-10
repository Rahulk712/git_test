<?php
/**
 * Template Name: test
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 

date_default_timezone_set('Asia/Calcutta');
	
	chdir(getcwd()."/wp-content/plugins/affiliate-ccHourly-Report/cc-reports");
		global $wpdb;
  
		$orders=wc_get_orders();
		$ordered_people=array();
		foreach($orders as $order){
			$ordered_people[]="'".$order->data['customer_id']."'";
		}
		$ordered_people=implode(",",$ordered_people);
		$reportingStartTime= date('Y-m-d 12:55:00',strtotime("-1 days"));
			$reportingEndTime=date("Y-m-d 11:55:00");
		$reportingTimeFileName=date('d-M-Y H:i');
		$filename='Registration Lead Report -'.$reportingTimeFileName.'.csv';
		$list=array();
		$header=array('Lead ID','Platform','Affiliate','DateTime','Firstname','Mobile','Email');
		$delimiter=",";
		$f = fopen("php://output", 'w');
		foreach($header as $hdr){
			$list[] = $hdr;
		}
		fputcsv($f, $list);

		$affiliates=$wpdb->get_results("select reference,(select display_name from wp_users where ID=(SELECT user_id FROM `wp_affiliate_wp_affiliates` WHERE wp_affiliate_wp_affiliates.affiliate_id=wp_affiliate_wp_referrals.affiliate_id)),campaign,CONVERT_TZ(`date`,'+00:00',@@global.time_zone),(select display_name from wp_users where ID=reference) as name,(SELECT meta_value  FROM wp_usermeta WHERE meta_key='phone_number' and user_id=reference) as mobile,(select user_email from wp_users where ID=reference) as mail from wp_affiliate_wp_referrals where type='lead' and context='ultimate_member_signup' and CONVERT_TZ(`date`,'+00:00',@@global.time_zone) >= '$reportingStartTime' and CONVERT_TZ(`date`,'+00:00',@@global.time_zone) < '$reportingEndTime' and wp_affiliate_wp_referrals.reference not in ($ordered_people)");



		$form_id = 5;
		// Get all submissions for that form ID


		foreach($affiliates as $aff){
			$aff->reference="M".$aff->reference;
		}

		$array_dt = json_decode(json_encode($affiliates), true);

		foreach ($array_dt as $line) {
			
			// generate csv lines from the inner arrays
			fputcsv($f, $line);
			
		}
		fseek($f, 0);
		fpassthru($f); 
		//fclose($f); 
		
		
		
		
			 header('Content-Type: application/csv');
    // tell the browser we want to save it instead of displaying it
   // header('Content-Disposition: attachment; filename="'.$filename.'";');
	header('Content-Disposition: attachment; filename="'.$filename.'";');
		
		fclose($f); 
		exit;


		//Send the CSV as Attachment for each hour to call center team
		

		$file=getcwd()."/".$filename;
		$bmi_file=getcwd()."/".$bmi_filename;
*/?>