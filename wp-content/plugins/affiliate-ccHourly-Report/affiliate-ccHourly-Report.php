<?php 


/*
 * Plugin Name: AffiliateWP - CC Hourly Report
 * Description: Plugin that generates Leads Report every hour
 * Author: Manjunath Sharma K
 * Version: 1.0
 * @package AffiliateWP
 * @category Core
 * @author Manjunath Sharma K
 * @version 1.0
 */



add_action( 'cc_hourly_report_hook', 'send_leads_data' );



function send_leads_data(){
	date_default_timezone_set('Asia/Calcutta');
	if(date('H')>='09' &&  date('H')<='17'){ //Run cron between 09 to 17 hours
		chdir(getcwd()."/wp-content/plugins/affiliate-ccHourly-Report/cc-reports");
		global $wpdb;
  
		$orders=wc_get_orders();
		$ordered_people=array();
		foreach($orders as $order){
			$ordered_people[]="'".$order->data['customer_id']."'";
		}
		$ordered_people=implode(",",$ordered_people);


		if(date('H')=='09'){
			$reportingStartTime= date('Y-m-d 16:55:00',strtotime("-1 days"));
			$reportingEndTime=date("Y-m-d 08:55:00");
		} else {
			/*$st_t=strtotime ( '-2 hour' , strtotime ( $cur_time ) ) ;
			$reportingStartTime=date("Y-m-d H:55:00",$st_t);
			$en_t=strtotime ( '-1 hour' , strtotime ( $cur_time ) ) ;
			$reportingEndTime=date("Y-m-d H:55:00",$en_t);*/
			$reportingStartTimeDuration = strtotime('-65 minutes');
			$reportingEndTimeDuration = strtotime('-5 minutes');
			$reportingStartTime=date("Y-m-d H:i:00",$reportingStartTimeDuration);
			$reportingEndTime=date("Y-m-d H:i:00",$reportingEndTimeDuration);
		}

		$reportingTimeFileName=date('d-M-Y H:i');
		$filename='Registration Lead Report -'.$reportingTimeFileName.'.csv';
		$list=array();
		$header=array('Lead ID','Platform','Affiliate','DateTime','Firstname','Mobile','Email');
		$delimiter=",";
		$f = fopen($filename, 'w');
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
		fclose($f);                                                  // End of ONE CSV File
		$bmi_filename='BMI Lead Report -'.$reportingTimeFileName.'.csv';
		$f1 = fopen($bmi_filename, 'w');

		$list=array();
		$bmi_header=array('Lead ID','Platform','Name','Mobile Number','Email','DateTime','Result');
		foreach($bmi_header as $hdr){
			$list[] = $hdr;
		}
		fputcsv($f1, $list);

		$submissions = Ninja_Forms()->form( $form_id )->get_subs();
			if ( is_array( $submissions ) && count( $submissions ) > 0 ) {
				foreach($submissions as $submission) {
					$submission_values=array();
					$line=array();
					$sub_values = $submission->get_field_values();
					$submission_values['Lead ID'] = "M".$sub_values['_seq_num'];
					$submission_values['platform']='Website';
					$submission_values['name'] = $sub_values['bmi_data_name'];
					$submission_values['phone'] = $sub_values['bmi_data_phone'];
					$submission_values['email'] = $sub_values['bmi_data_email'];
					$submission_values['dateTime'] = $submission->get_sub_date('Y-m-d H:i');
					//Show BMI Result in CSV
					$bmi_data=unserialize($sub_values['calculations']);
						$submission_values['Result'] = $bmi_data['bmi_result']['value']; 

											//check Date condition
					if($submission_values['dateTime'] >= $reportingStartTime && $submission_values['dateTime']<$reportingEndTime){
						$line = json_decode(json_encode($submission_values), true);
						fputcsv($f1, $line);
					}
				}
			}
			
		fseek($f1, 0);
		fpassthru($f1); 
		fclose($f1);



		//Send the CSV as Attachment for each hour to call center team
		$admin_email = get_option( 'admin_email' );
		$cc='ponnan.i@baryons.net';
		$attachments = array(getcwd()."/".$filename,getcwd()."/".$bmi_filename);
		$headers = array('Content-Type: text/html; charset=UTF-8','From:'.$admin_email,'Cc:'.$cc);
		//$headers = 'From:'.$admin_email. "\r\n";
		$to="ponnan.i@baryons.net";
		$subject="Call Center Leads and BMI Hourly Report-".date('d-M-Y H:i');
		$message="Hi, <p> Find attached the Hourly lead report from Lead Form and BMI form.</p>";

		$mail_sent=wp_mail( $to, $subject, $message, $headers, $attachments );

		$file=getcwd()."/".$filename;
		$bmi_file=getcwd()."/".$bmi_filename;
		unlink($file);     // Delete Leads file
		unlink($bmi_file); // Delete BMI file
	}
}
?>