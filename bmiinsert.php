<?php

global $wpdb;
$user_details= $_POST['user_details'];
$bmi_result = $_POST['bmi_result'];
$user_details = json_decode($user_details);

require_once(dirname( __FILE__ ) . '/' . 'wp-config.php');
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
mysqli_select_db($connection, DB_NAME);
/*  if(!$connection)
 {
	echo 'Database Error: ' . mysqli_connect_error() ;
	exit;
 }
 
 
$sql = "INSERT INTO bmi_calculator(name,phone,email,age,gender,height,weight,date,result)VALUES ('".($user_details->user_name)."','".($user_details->user_phone)."','".($user_details->user_email)."'
		,'".($user_details->user_age)."','".($user_details->sexoption)."','".($user_details->height)."','".($user_details->weight)."','".time()."','".$bmi_result."')";
$result = mysqli_query($connection,$sql); */

if( null == username_exists( $user_details->user_email ) ) {
	$password = wp_generate_password( 12, false );
	$user_id = wp_create_user( $user_details->user_email, $password, $user_details->user_email );
	wp_update_user(
			array(
					'ID'          =>    $user_id,
					'nickname'    =>    $user_details->user_name
						)
			);
	$user = new WP_User( $user_id );
	$user->set_role( 'contributor' );
	
	$bm_result=array("phone_number"=>$user_details->user_phone,"age"=>$user_details->user_age,"gender"=>$user_details->sexoption,"height"=>$user_details->height,"weight"=>$user_details->weight,"bmi_result"=>$bmi_result,'time' => time());
	
	$result = serialize($bm_result);
	add_user_meta($user_id,'bmi_result',$result);
	
}else{
	$the_user = get_user_by('email', $user_details->user_email);
	$the_user_id = $the_user->ID;
	$bm_result=array("phone_number"=>$user_details->user_phone,"age"=>$user_details->user_age,"gender"=>$user_details->sexoption,"height"=>$user_details->height,"weight"=>$user_details->weight,"bmi_result"=>$bmi_result,'time' => time());
	
	$result = serialize($bm_result);
	add_user_meta($the_user_id,'bmi_result',$result);
	
}

?>
