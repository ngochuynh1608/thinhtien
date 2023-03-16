<?php
class ControllerPushassistSubscribers extends Controller {
	private $error = array();
	
	public function index() {
		$this->language->load('pushassist/subscribers');
		
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
			'href'      => $this->url->link('pushassist/subscribers', 'token=' . $this->session->data['token'] . $url, 'SSL')
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
		$data['text_site_url'] = $this->language->get('text_site_url');
		$data['text_chrome'] = $this->language->get('text_chrome');
		$data['text_firefox'] = $this->language->get('text_firefox');
		$data['text_safari'] = $this->language->get('text_safari');
		$data['text_title'] = $this->language->get('text_title');
		$data['text_no_results'] = $this->language->get('text_no_results');
		
		$data['account_response']= $this->model_pushassist_notification->get_account_details();
		$account_response=$data['account_response'];
		
		$data['get_subscribers'] = $this->model_pushassist_notification->get_subscribers();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		if( isset($account_response['error'])) {
		      if( $account_response['error'] =='' && $account_response) {

			 $this->response->setOutput($this->load->view('pushassist/subscribers.tpl', $data));
		      }else{ 
			      $this->session->data['success'] = $data['account_response']['error'];
			      //$this->error['warning']= $data['account_response']['error'];
			      $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		      }
		    
		}else{
			$this->response->setOutput($this->load->view('pushassist/subscribers.tpl', $data));
		}
			
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'pushassist/subscribers')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}