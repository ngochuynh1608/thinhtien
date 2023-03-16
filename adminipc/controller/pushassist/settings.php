<?php
class ControllerPushassistSettings extends Controller {
	private $error = array();
	
	public function index() {
		
		$this->language->load('pushassist/settings');
		
		$this->load->model('pushassist/notification');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$url = '';
		
		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('pushassist/settings', 'token=' . $this->session->data['token'] . $url, 'SSL')
   		);
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
		
			unset($this->error['warning']);
		} else {
			$data['error'] = '';
		}	
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_save_button'] = $this->language->get('text_save_button');
		$data['text_gsm_project_no'] = $this->language->get('text_gsm_project_no');
		$data['text_gsm_apikey'] = $this->language->get('text_gsm_apikey');
		
		$data['account_response']= $this->model_pushassist_notification->get_account_details();
		$account_response=$data['account_response'];

		$data['dashboard_response']= $this->model_pushassist_notification->get_dashboard();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['add'] = $this->url->link('pushassist/settings/gcminsert', '&token=' . $this->session->data['token'] . $url, 'SSL');
		$data['addsettings'] = $this->url->link('pushassist/settings/addsettings', '&token=' . $this->session->data['token'] . $url, 'SSL');

		if( isset($account_response['error'])) {
		      if( $account_response['error'] =='' && $account_response) {

			  $this->response->setOutput($this->load->view('pushassist/settings.tpl', $data));
		      }else{ 
			      $this->session->data['success'] = $data['account_response']['error'];
			      //$this->error['warning']= $data['account_response']['error'];
			      $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		      }
		    
		}else{
			$this->response->setOutput($this->load->view('pushassist/settings.tpl', $data));
		}	
	}

	public function addsettings(){

		$this->language->load('pushassist/settings');
		 
		$this->load->model('pushassist/notification');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
		  $post=$this->request->post;

		  if( is_dir(DIR_IMAGE.'catalog/pushassist/site/') === false ){ mkdir(DIR_IMAGE.'catalog/pushassist/site/');}

		     $json = array();

		     if (!empty($this->request->files['fileupload']['name']) && is_file($this->request->files['fileupload']['tmp_name'])) {
			// Sanitize the filename
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['fileupload']['name'], ENT_QUOTES, 'UTF-8')));

			// Validate the filename length
			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
				$json['error'] = $this->language->get('error_filename');
			}

			// Allowed file extension types
			$allowed = array();
			// $extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));
			// $filetypes = explode("\n", $extension_allowed);
			$filetypes = array('jpe','jpeg','jpg','gif','bmp','ico','tiff','tif','png');

			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}

			if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}

			if($this->request->files['fileupload']['size'] > 5000){
			      $json['error'] = $this->language->get('error_filesize');
			}

			// Check to see if any PHP files are trying to be uploaded
			$content = file_get_contents($this->request->files['fileupload']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_filetype');
			}

			// Return any upload error
			if ($this->request->files['fileupload']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
			if (!isset($json['error'])) {
			    $file =  md5(mt_rand()). $filename;

			    move_uploaded_file($this->request->files['fileupload']['tmp_name'], DIR_IMAGE.'catalog/pushassist/site/' . $file);
			    $image_url_path= base64_encode(file_get_contents(DIR_IMAGE.'catalog/pushassist/site/' . $file));
			  
			}
		    }else{
			    $file='';
			    $image_url_path='';
		    }
	
		    if (!isset($json['error'])) {

			    //print_r($post);exit;
			      $response_array = array("templatesetting" => array("interval_time" => $post['pushassist_timeinterval'],
							"opt_in_title" => trim($post['pushassist_opt_in_title']),
							"opt_in_subtitle" => trim($post['pushassist_opt_in_subtitle']),
							"allow_button_text" => trim($post['pushassist_allow_button_text']),
							"disallow_button_text" => trim($post['pushassist_disallow_button_text']),
							"template" => $post['template'],
							"location" => $post['psa_template_location'],
							"image_data" => $image_url_path,	// read image file & pass image data
							"image_name" => trim($file),
							"child_window_text" => trim($post['pushassist_child_window_text']),
							"child_window_title" => trim($post['pushassist_child_window_title']),
							"child_window_message" => trim($post['pushassist_child_window_message']),
							"notification_title" => trim($post['pushassist_setting_title']),
							"notification_message" => trim($post['pushassist_setting_message']),
							"redirect_url" => trim($post['pushassist_redirect_url']))
						);
			  

			    

			    $result_array=$this->model_pushassist_notification->settings($response_array);
		
			    if($result_array['status'] == 'Success'){
				$this->session->data['success'] = $result_array['response_message'];
				$this->response->redirect($this->url->link('pushassist/settings', 'token=' . $this->session->data['token'], 'SSL'));
			    }
			    if($result_array['status'] == 'Error') {
				$this->session->data['success'] = $result_array['error_message'];
				$this->response->redirect($this->url->link('pushassist/settings', 'token=' . $this->session->data['token'], 'SSL'));
			    }if($result_array['error'] != '') {
				$this->session->data['success'] = $result_array['error'];
				$this->response->redirect($this->url->link('pushassist/settings', 'token=' . $this->session->data['token'], 'SSL'));
			    }
			    
		    }else{
				$this->session->data['success'] = $json['error'];
				$this->response->redirect($this->url->link('pushassist/settings', 'token=' . $this->session->data['token'], 'SSL'));
			  }
		}
	}

	public function gcminsert() {

		$this->language->load('pushassist/settings');
		
		$this->load->model('pushassist/notification');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {
			$post=$this->request->post;

			$response_array = array("accountgcmsetting" => array("project_number" => $post['pushassist_gcm_project_no'],
							"project_api_key" => trim($post['pushassist_gcm_api_key']))
						);
	
			
			$result_array=$this->model_pushassist_notification->gcm_setting($response_array);		
			
			if($result_array['status'] == 'Success'){
				$this->session->data['success'] = $result_array['response_message'];
				$this->response->redirect($this->url->link('pushassist/settings', 'token=' . $this->session->data['token'], 'SSL'));
			    }
			    if($result_array['status'] == 'Error') {
				$this->session->data['success'] = $result_array['error_message'];
				$this->response->redirect($this->url->link('pushassist/settings', 'token=' . $this->session->data['token'], 'SSL'));
			    }if($result_array['error'] != '') {
				$this->session->data['success'] = $result_array['error'];
				$this->response->redirect($this->url->link('pushassist/settings', 'token=' . $this->session->data['token'], 'SSL'));
			    }
		}

		
	}
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'pushassist/settings')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}