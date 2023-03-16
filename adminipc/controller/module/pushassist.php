<?php
class ControllerModulePushassist extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/pushassist');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

		    $finaldata=$this->request->post;
		  
		   $account_response=$this->model_pushassist_notification->check_account_details($finaldata);

			$finaldata['pushassist_jspath'] =$account_response['jsPath'];
			$finaldata['pushassist_account_name']=$account_response['account_name'];
			$this->model_setting_setting->editSetting('pushassist', $finaldata);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('pushassist/dashboard', 'token=' . $this->session->data['token'], 'SSL'));

			   
		    
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['entry_full_name'] = $this->language->get('entry_full_name');
		$data['entry_company_name'] = $this->language->get('entry_company_name');
		$data['entry_phone'] = $this->language->get('entry_phone');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_siteurl'] = $this->language->get('entry_siteurl');
		$data['entry_accountname'] = $this->language->get('entry_accountname');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_api_key'] = $this->language->get('entry_api_key');
		$data['entry_secret_key'] = $this->language->get('entry_secret_key');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['redirect_settings_page'] =$this->url->link('pushassist/settings', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/pushassist', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/pushassist', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['pushassist_status'])) {
			$data['pushassist_status'] = $this->request->post['pushassist_status'];
		} else {
			$data['pushassist_status'] = $this->config->get('pushassist_status');
		}
		
		if (isset($this->request->post['pushassist_api_key'])) {
			$data['pushassist_api_key'] = $this->request->post['pushassist_api_key'];
		} else {
			$data['pushassist_api_key'] = $this->config->get('pushassist_api_key');
		}
	
		if (isset($this->request->post['pushassist_secret_key'])) {
			$data['pushassist_secret_key'] = $this->request->post['pushassist_secret_key'];
		} else {
			$data['pushassist_secret_key'] = $this->config->get('pushassist_secret_key');
		}
		$this->load->model('pushassist/notification');
		$data['account_response']= $this->model_pushassist_notification->get_account_details();
		$account_response=$data['account_response'];

		$data['test']='dfsdfs';
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/pushassist.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/pushassist')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		$finaldata=$this->request->post;
		$this->load->model('pushassist/notification');
		$this->load->model('setting/setting');
		if($finaldata['api_form']=='appKey'){

		    $account_response=$this->model_pushassist_notification->check_account_details($finaldata);
		    if( isset($account_response['error']) ) {
			$finaldata['pushassist_api_key'] ='';
			$finaldata['pushassist_secret_key'] ='';
			$finaldata['pushassist_jspath'] ='';
			$finaldata['pushassist_account_name'] ='';
			$this->model_setting_setting->editSetting('pushassist', $finaldata);
			$this->error['warning'] = $account_response['error'];
			

		    }
		}

		if($finaldata['api_form']=='account_creation'){ 

			    	$finaldata = array("account" => array(
						"name" => trim($finaldata['name']),
						"company_name" => trim($finaldata['company_name']),
						"contact" => trim($finaldata['phone']),
						"email" => trim($finaldata['email']),
						"password" => trim($finaldata['password']),
						"protocol" => trim($finaldata['protocol']),
						"siteurl" => trim($finaldata['site_url']),
						"subdomain" => trim($finaldata['sub_domain']),
						"psa_source" => 'OpenCart'
					    )
				);

			    $account_create=$this->model_pushassist_notification->create_account($finaldata);

			    if ($account_create['status'] == 'Success') { 
				  $account_info=array();
				  $account_info['pushassist_api_key'] =$account_create['api_key'];
				  $account_info['pushassist_secret_key'] =$account_create['auth_secret'];
				  $account_response=$this->model_pushassist_notification->check_account_details($account_info);

				  if( isset($account_response['error']) ) {
				      $account_info['pushassist_api_key'] ='';
				      $account_info['pushassist_secret_key'] ='';
				      $account_info['pushassist_jspath'] ='';
				      $account_info['pushassist_account_name'] ='';
				      $this->model_setting_setting->editSetting('pushassist', $account_info);
				      $this->error['warning'] = $account_response['error'];
				  }else{
				      $new_account_info=array();
				      $new_account_info['pushassist_api_key'] =$account_response['apiKey'];
				      $new_account_info['pushassist_secret_key'] =$account_response['apiSecret'];
				      $new_account_info['pushassist_jspath'] =$account_response['jsPath'];
				      $new_account_info['pushassist_account_name'] =$account_response['account_name'];

				    $this->model_setting_setting->editSetting('pushassist', $new_account_info);
				    $this->session->data['success'] = $this->language->get('text_success');
				  // $this->response->redirect($this->url->link('pushassist/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
				  }
				  
			    }else{ 
				if(isset($account_create['error'])) {
				  $response_message = $account_create['error'];
				}
				if(isset($account_create['errors'])){
				$response_message = $account_create['errors'];
				}
				if(isset($account_create['error_message'])){
				$response_message = $account_create['error_message'];
				}
				
				$this->error['warning'] = $response_message;
			    }
		}
	
		return !$this->error;
	}
	
	
	
	
}