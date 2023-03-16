<?php
class ModelPushassistNotification extends Model {
	  
	public function create_account($create_account_data) {
		
		$create_account_url = 'https://api.pushassist.com/accounts/';     		
		
		$create_account_ch = curl_init();
		curl_setopt($create_account_ch, CURLOPT_URL, $create_account_url);		
		curl_setopt($create_account_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($create_account_ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($create_account_ch, CURLOPT_POSTFIELDS, json_encode($create_account_data)); 
		curl_setopt($create_account_ch, CURLOPT_SSLVERSION, 4);
		
		$create_account_result = curl_exec($create_account_ch);

		if ($create_account_result === FALSE) {
			die('Curl failed: ' . curl_error($create_account_ch));
		}
		
		curl_close($create_account_ch);

		$create_account_result_arr = json_decode($create_account_result, true);
		
		return $create_account_result_arr;
	}


	public function get_account_details() {
		global $config;
 		$api_key=$config->get('pushassist_api_key');
 		$secret_key=$config->get('pushassist_secret_key');

		$account_url = 'https://api.pushassist.com/accounts_info/';     		
		
		$account_headers = array(
			'X-Auth-Token:'.$api_key,
			'X-Auth-Secret:'.$secret_key,	
			'Content-Type: application/json'
		);
	   
		$account_ch = curl_init();
		curl_setopt($account_ch, CURLOPT_URL, $account_url);		
		curl_setopt($account_ch, CURLOPT_HTTPHEADER, $account_headers);
		curl_setopt($account_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($account_ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($account_ch, CURLOPT_SSLVERSION, 4);
		
		$account_result = curl_exec($account_ch);

		if ($account_result === FALSE) {
			die('Curl failed: ' . curl_error($account_ch));
		}
		
		curl_close($account_ch);

		$account_result_arr = json_decode($account_result, true);
		
		return $account_result_arr;
	}
	public function check_account_details($account_data) {
		

 		$api_key=$account_data['pushassist_api_key'];
 		$secret_key=$account_data['pushassist_secret_key'];

		$account_url = 'https://api.pushassist.com/accounts_info/';     		
		
		$account_headers = array(
			'X-Auth-Token:'.$api_key,
			'X-Auth-Secret:'.$secret_key,	
			'Content-Type: application/json'
		);
	   
		$account_ch = curl_init();
		curl_setopt($account_ch, CURLOPT_URL, $account_url);		
		curl_setopt($account_ch, CURLOPT_HTTPHEADER, $account_headers);
		curl_setopt($account_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($account_ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($account_ch, CURLOPT_SSLVERSION, 4);
		
		$account_result = curl_exec($account_ch);

		if ($account_result === FALSE) {
			die('Curl failed: ' . curl_error($account_ch));
		}
		
		curl_close($account_ch);

		$account_result_arr = json_decode($account_result, true);
		
		return $account_result_arr;
	}
	public function get_dashboard() {
		global $config;
 		$api_key=$config->get('pushassist_api_key');
 		$secret_key=$config->get('pushassist_secret_key');
		$dashboard_url = 'https://api.pushassist.com/dashboard/';     		
		
		$dashboard_headers = array(
			'X-Auth-Token:'.$api_key,
			'X-Auth-Secret:'.$secret_key,	
			'Content-Type: application/json'
		);
	   
		$dashboard_ch = curl_init();
		curl_setopt($dashboard_ch, CURLOPT_URL, $dashboard_url);		
		curl_setopt($dashboard_ch, CURLOPT_HTTPHEADER, $dashboard_headers);
		curl_setopt($dashboard_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($dashboard_ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($dashboard_ch, CURLOPT_SSLVERSION, 4);
		
		$dashboard_result = curl_exec($dashboard_ch);

		if ($dashboard_result === FALSE) {
			die('Curl failed: ' . curl_error($dashboard_ch));
		}
		
		curl_close($dashboard_ch);

		$dashboard_result_arr = json_decode($dashboard_result, true);
		
		return $dashboard_result_arr;
	}
	public function get_notifications(){
		global $config;
 		$api_key=$config->get('pushassist_api_key');
 		$secret_key=$config->get('pushassist_secret_key');
		
		$notifications_url = 'https://api.pushassist.com/notifications/';     		
		
		$notifications_headers = array(
			'X-Auth-Token:'.$api_key,
			'X-Auth-Secret:'.$secret_key,	
			'Content-Type: application/json'
		);
	   
		$notifications_ch = curl_init();
		curl_setopt($notifications_ch, CURLOPT_URL, $notifications_url);		
		curl_setopt($notifications_ch, CURLOPT_HTTPHEADER, $notifications_headers);
		curl_setopt($notifications_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($notifications_ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($notifications_ch, CURLOPT_SSLVERSION, 4);
		
		$notifications_result = curl_exec($notifications_ch);

		if ($notifications_result === FALSE) {
			die('Curl failed: ' . curl_error($notifications_ch));
		}
		
		curl_close($notifications_ch);

		$notifications_result_arr = json_decode($notifications_result, true);
		
		return $notifications_result_arr;
	}

	public function send_notification($response_array) {
		global $config;
 		$api_key=$config->get('pushassist_api_key');
 		$secret_key=$config->get('pushassist_secret_key');

		$send_notification_url = 'https://api.pushassist.com/notifications/';     		
		
		$send_notification_headers = array(
			'X-Auth-Token:'.$api_key,
			'X-Auth-Secret:'.$secret_key,	
			'Content-Type: application/json'
		);
	   
		$send_notification_ch = curl_init();
		curl_setopt($send_notification_ch, CURLOPT_URL, $send_notification_url);
		curl_setopt($send_notification_ch, CURLOPT_POST, true);
		curl_setopt($send_notification_ch, CURLOPT_HTTPHEADER, $send_notification_headers);
		curl_setopt($send_notification_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($send_notification_ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($send_notification_ch, CURLOPT_POSTFIELDS, json_encode($response_array));
		curl_setopt($send_notification_ch, CURLOPT_SSLVERSION, 4);
		$send_notification_result = curl_exec($send_notification_ch);

		if ($send_notification_result === FALSE) {
			die('Curl failed: ' . curl_error($send_notification_ch));
		}
		
		curl_close($send_notification_ch);

		$send_notification_result_arr = json_decode($send_notification_result, true);
		
		return $send_notification_result_arr;

	}
    
	public function get_segments() {
		global $config;
 		$api_key=$config->get('pushassist_api_key');
 		$secret_key=$config->get('pushassist_secret_key');

		$segments_url = 'https://api.pushassist.com/segments/';     		
		
		$segments_headers = array(
			'X-Auth-Token:'.$api_key,
			'X-Auth-Secret:'.$secret_key,	
			'Content-Type: application/json'
		);
	   
		$segments_ch = curl_init();
		curl_setopt($segments_ch, CURLOPT_URL, $segments_url);		
		curl_setopt($segments_ch, CURLOPT_HTTPHEADER, $segments_headers);
		curl_setopt($segments_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($segments_ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($segments_ch, CURLOPT_SSLVERSION, 4);
		
		$segments_result = curl_exec($segments_ch);

		if ($segments_result === FALSE) {
			die('Curl failed: ' . curl_error($segments_ch));
		}
		
		curl_close($segments_ch);

		$segments_result_arr = json_decode($segments_result, true);
		
		return $segments_result_arr;
	}

	public function add_segments($segments_response_array) {
		global $config;
 		$api_key=$config->get('pushassist_api_key');
 		$secret_key=$config->get('pushassist_secret_key');

		$add_segments_url = 'https://api.pushassist.com/segments/';     		
		
		$add_segments_headers = array(
			'X-Auth-Token:'.$api_key,
			'X-Auth-Secret:'.$secret_key,	
			'Content-Type: application/json'
		);
	   
		$add_segments_ch = curl_init();
		curl_setopt($add_segments_ch, CURLOPT_URL, $add_segments_url);
		curl_setopt($add_segments_ch, CURLOPT_POST, true);
		curl_setopt($add_segments_ch, CURLOPT_HTTPHEADER, $add_segments_headers);
		curl_setopt($add_segments_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($add_segments_ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($add_segments_ch, CURLOPT_POSTFIELDS, json_encode($segments_response_array));
		curl_setopt($add_segments_ch, CURLOPT_SSLVERSION, 4);
		$add_segments_result = curl_exec($add_segments_ch);

		if ($add_segments_result === FALSE) {
			die('Curl failed: ' . curl_error($add_segments_ch));
		}
		
		curl_close($add_segments_ch);

		$add_segments_result_arr = json_decode($add_segments_result, true);
		
		return $add_segments_result_arr;

	}

	public function get_subscribers() {
		global $config;
 		$api_key=$config->get('pushassist_api_key');
 		$secret_key=$config->get('pushassist_secret_key');

		$url = 'https://api.pushassist.com/subscribers/';     		
		
		$headers = array(
			'X-Auth-Token:'.$api_key,
			'X-Auth-Secret:'.$secret_key,	
			'Content-Type: application/json'
		);
	   
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSLVERSION, 4);
		
		$result = curl_exec($ch);

		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}
		
		curl_close($ch);

		$result_arr = json_decode($result, true);
		
		return $result_arr;
	}

	public function gcm_setting($gcm_response_array) {

		global $config;
 		$api_key=$config->get('pushassist_api_key');
 		$secret_key=$config->get('pushassist_secret_key');

		$gcm_url = 'https://api.pushassist.com/gcmsettings/';     		
		
		$gcm_headers = array(
			'X-Auth-Token:'.$api_key,
			'X-Auth-Secret:'.$secret_key,	
			'Content-Type: application/json'
		);
	   
		$gcm_ch = curl_init();
		curl_setopt($gcm_ch, CURLOPT_URL, $gcm_url);
		curl_setopt($gcm_ch, CURLOPT_POST, true);
		curl_setopt($gcm_ch, CURLOPT_HTTPHEADER, $gcm_headers);
		curl_setopt($gcm_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($gcm_ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($gcm_ch, CURLOPT_POSTFIELDS, json_encode($gcm_response_array));
		curl_setopt($gcm_ch, CURLOPT_SSLVERSION, 4);
		$gcm_result = curl_exec($gcm_ch);

		if ($gcm_result === FALSE) {
			die('Curl failed: ' . curl_error($gcm_ch));
		}
		
		curl_close($gcm_ch);

		$gcm_result_arr = json_decode($gcm_result, true);
		
		return $gcm_result_arr;

	}
	public function settings($settings_response_array) {

		global $config;
 		$api_key=$config->get('pushassist_api_key');
 		$secret_key=$config->get('pushassist_secret_key');

		$settings_url = 'https://api.pushassist.com/settings/';     		
		
		$settings_headers = array(
			'X-Auth-Token:'.$api_key,
			'X-Auth-Secret:'.$secret_key,	
			'Content-Type: application/json'
		);
	   
		$settings_ch = curl_init();
		curl_setopt($settings_ch, CURLOPT_URL, $settings_url);
		curl_setopt($settings_ch, CURLOPT_POST, true);
		curl_setopt($settings_ch, CURLOPT_HTTPHEADER, $settings_headers);
		curl_setopt($settings_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($settings_ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($settings_ch, CURLOPT_POSTFIELDS, json_encode($settings_response_array));
		curl_setopt($settings_ch, CURLOPT_SSLVERSION, 4);
		$settings_result = curl_exec($settings_ch);

		if ($settings_result === FALSE) {
			die('Curl failed: ' . curl_error($settings_ch));
		}
		
		curl_close($settings_ch);

		$settings_result_arr = json_decode($settings_result, true);
		
		return $settings_result_arr;

	}

	public function add_campaign($response_array) {
		global $config;
 		$api_key=$config->get('pushassist_api_key');
 		$secret_key=$config->get('pushassist_secret_key');

		$add_campaign_url = 'https://api.pushassist.com/campaigns/';     		
		
		$add_campaign_headers = array(
			'X-Auth-Token:'.$api_key,
			'X-Auth-Secret:'.$secret_key,	
			'Content-Type: application/json'
		);
	   
		$add_campaign_ch = curl_init();
		curl_setopt($add_campaign_ch, CURLOPT_URL, $add_campaign_url);
		curl_setopt($add_campaign_ch, CURLOPT_POST, true);
		curl_setopt($add_campaign_ch, CURLOPT_HTTPHEADER, $add_campaign_headers);
		curl_setopt($add_campaign_ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($add_campaign_ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($add_campaign_ch, CURLOPT_POSTFIELDS, json_encode($response_array));
		curl_setopt($add_campaign_ch, CURLOPT_SSLVERSION, 4);
		$add_campaign_result = curl_exec($add_campaign_ch);

		if ($add_campaign_result === FALSE) {
			die('Curl failed: ' . curl_error($add_campaign_ch));
		}
		
		curl_close($add_campaign_ch);

		$add_campaign_result_arr = json_decode($add_campaign_result, true);
		
		return $add_campaign_result_arr;

	}
	
}