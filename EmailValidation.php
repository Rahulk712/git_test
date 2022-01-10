<?php // use curl to make the request
$email= $_GET['email'];

if($email!=''){
	require('wp-config.php');
	$options = get_option('zerobounce_plugin_options');
	$apiKey = $options['api_key'];
	$url = 'https://api.zerobounce.net/v2/validate?api_key='.$apiKey.'&email=' . urlencode($email) . '&ip_address=' . urlencode(do_shortcode( '[show_ip]' ));
	//PHP 5.5.19 and higher has support for TLS 1.2
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_SSLVERSION, 6);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
	curl_setopt($ch, CURLOPT_TIMEOUT, 150);
	$response = curl_exec($ch);
	curl_close($ch);
	//decode the json response
	
	$json = json_decode($response, true);
	if($json["status"] == "valid"){
		echo "1";exit;
	}else{
		echo "0";exit;
	}
}else{
	echo"0";exit;
}
    



?>