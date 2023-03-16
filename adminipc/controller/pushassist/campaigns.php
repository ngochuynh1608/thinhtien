<?php
class ControllerPushassistCampaigns extends Controller {
	private $error = array();
	
	public function index() {
		$this->language->load('pushassist/campaigns');
		
		$this->load->model('pushassist/notification');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);
		$url='';
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('pushassist/campaigns', 'token=' . $this->session->data['token'] . $url, 'SSL')
   		);
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		
			unset($this->error['warning']);
		} else {
			$data['error_warning'] = '';
		}
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_title'] = $this->language->get('text_title');	
		$data['text_summary'] = $this->language->get('text_summary');
		$data['text_campaign_title'] = $this->language->get('text_campaign_title');
		
		$data['text_campaign_body'] = $this->language->get('text_campaign_body');
		$data['text_campaign_preview_url'] = $this->language->get('text_campaign_preview_url');
		
		$data['text_campaign_message'] = $this->language->get('text_campaign_message');
		$data['text_campaign_url'] = $this->language->get('text_campaign_url');
		$data['text_campaign_logo'] = $this->language->get('text_campaign_logo');
		$data['text_segment'] = $this->language->get('text_segment');
		$data['text_title_limit'] = $this->language->get('text_title_limit');
		$data['text_message_limit'] = $this->language->get('text_message_limit');
		$data['text_utm_parameters']= $this->language->get('text_utm_parameters');
		$data['text_utm_source']= $this->language->get('text_utm_source');
		$data['text_utm_medium']= $this->language->get('text_utm_medium');
		$data['text_utm_campaign']= $this->language->get('text_utm_campaign');
		$data['text_campaign_limit']= $this->language->get('text_campaign_limit');
		$data['text_campaign_date']= $this->language->get('text_campaign_date');
		$data['text_campaign_date_ex']= $this->language->get('text_campaign_date_ex');

		$data['text_send']= $this->language->get('text_send');	
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['add'] = $this->url->link('pushassist/campaigns/insert', '&token=' . $this->session->data['token'] . $url, 'SSL');
		$data['get_segment']= $this->model_pushassist_notification->get_segments();

		$data['account_response']= $this->model_pushassist_notification->get_account_details();
		$account_response=$data['account_response'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		if( isset($account_response['error'])) {
		      if( $account_response['error'] =='' && $account_response) {

			 $this->response->setOutput($this->load->view('pushassist/campaigns.tpl', $data));
		      }else{ 
			      $this->session->data['success'] = $data['account_response']['error'];
			      //$this->error['warning']= $data['account_response']['error'];
			      $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		      }
		    
		}else{
			$this->response->setOutput($this->load->view('pushassist/campaigns.tpl', $data));
		}
			
	}
	
	public function insert() {
	      
		$this->language->load('pushassist/campaigns');
		 
		$this->load->model('pushassist/notification');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
		  $post=$this->request->post;

		  if( is_dir(DIR_IMAGE.'catalog/pushassist/campaign/') === false ){ mkdir(DIR_IMAGE.'catalog/pushassist/campaign/');}

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

			

			// Check to see if any PHP files are trying to be uploaded
			$content = file_get_contents($this->request->files['fileupload']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {
				$json['error'] = $this->language->get('error_filetype');
			}

			// Return any upload error
			if ($this->request->files['fileupload']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
			  $file =  md5(mt_rand()). $filename;

			    move_uploaded_file($this->request->files['fileupload']['tmp_name'], DIR_IMAGE.'catalog/pushassist/campaign/' . $file);

		    }else{
			    $file='';
		    }
		    if($file !=''){
		    $image_url_path=$this->config->get('config_url').'image/catalog/pushassist/campaign/'.$file;
		    }else{
				$image_url_path='';
		    }
		    if (!isset($json['error'])) {

			    $response_array = array("campaign" => array(
						"title" => $post['title'],
						"message" => $post['message'],
						"redirect_url" => $post['url'],
						"timezone"=>$post['form_datetime'],
						"image" => $image_url_path)
			  );

			    
			    if(isset($post['is_utm_show'])){
				if($post['is_utm_show']==1){

				$response_array['utm_params'] =array("utm_source" => $post['utm_source'],	// optional
									"utm_medium" => $post['utm_medium'],
									"utm_campaign" => $post['utm_campaign']);
		
				}
			    }else{
					    $response_array['utm_params'] =array("utm_source" => '',	// optional
									"utm_medium" => '',
									"utm_campaign" => '');
			    }	

			    if(!empty($post['segment'])){

				  $response_array['segments'] =$post['segment'];
			    }else{
					 $response_array['segments'] =array();
			    }

			    $result_array=$this->model_pushassist_notification->add_campaign($response_array);
		
			    if($result_array['status'] == 'Success'){
				$this->session->data['success'] = $result_array['response_message'];
				$this->response->redirect($this->url->link('pushassist/campaigns', 'token=' . $this->session->data['token'], 'SSL'));
			    }
			    if($result_array['status'] == 'Error') {
				$this->session->data['success'] = $result_array['error_message'];
				$this->response->redirect($this->url->link('pushassist/campaigns', 'token=' . $this->session->data['token'], 'SSL'));
			    }if($result_array['error'] != '') {
				$this->session->data['success'] = $result_array['error'];
				$this->response->redirect($this->url->link('pushassist/campaigns', 'token=' . $this->session->data['token'], 'SSL'));
			    }
			    
		    }else{
				$this->session->data['success'] = $json['error'];
				$this->response->redirect($this->url->link('pushassist/campaigns', 'token=' . $this->session->data['token'], 'SSL'));
			  }
		}

		
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'pushassist/campaigns')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}