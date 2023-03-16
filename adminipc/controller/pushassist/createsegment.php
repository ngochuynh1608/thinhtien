<?php
class ControllerPushassistCreatesegment extends Controller {
	private $error = array();
	
	public function index() {
		$this->language->load('pushassist/createsegments');
		
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
			'href'      => $this->url->link('pushassist/createsegment', 'token=' . $this->session->data['token'] . $url, 'SSL')
   		);
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
		
			unset($this->error['warning']);
		} else {
			$data['error'] = '';
		}
		
		$data['account_response']= $this->model_pushassist_notification->get_account_details();
		$account_response=$data['account_response'];
		
		$data['create_heading_title'] = $this->language->get('create_heading_title');

		$data['text_new_title'] = $this->language->get('text_new_title');
		$data['text_segment_name'] = $this->language->get('text_segment_name');
		$data['text_segment_message'] = $this->language->get('text_segment_message');
		$data['text_send'] = $this->language->get('text_send');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['add'] = $this->url->link('pushassist/createsegment/insert', '&token=' . $this->session->data['token'] . $url, 'SSL');
	  
		if( isset($account_response['error'])) {
		      if( $account_response['error'] =='' && $account_response) {

			  $this->response->setOutput($this->load->view('pushassist/add_segment.tpl', $data));
		      }else{ 
			      $this->session->data['success'] = $data['account_response']['error'];
			      //$this->error['warning']= $data['account_response']['error'];
			      $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		      }
		    
		}else{
			$this->response->setOutput($this->load->view('pushassist/add_segment.tpl', $data));
		}

	}
	
	public function insert() {

		$this->language->load('pushassist/segments');
		
		$this->load->model('pushassist/notification');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {
			$post=$this->request->post;

			$response_array = array("segment" => array( "segment_name" => urlencode($post['title'])));
			$this->model_pushassist_notification->add_segments($response_array);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('pushassist/segments', 'token=' . $this->session->data['token'], 'SSL'));
		}

		
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'pushassist/createsegment')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}