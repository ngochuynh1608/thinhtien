<?php
class ControllerPushassistNotifications extends Controller {
	private $error = array();
	
	public function index() {
		$this->language->load('pushassist/notification');
		
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
			'href'      => $this->url->link('pushassist/notification', 'token=' . $this->session->data['token'] . $url, 'SSL')
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
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_last'] = $this->language->get('text_last');
		$data['text_notifications'] = $this->language->get('text_notifications');
		$data['text_site']= $this->language->get('text_site');
		$data['text_message']= $this->language->get('text_message');
		$data['text_sent']= $this->language->get('text_sent');
		$data['text_campaign']= $this->language->get('text_campaign');
		$data['text_delivered']= $this->language->get('text_delivered');
		$data['text_failed']= $this->language->get('text_failed');
		$data['text_clicked']= $this->language->get('text_clicked');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_no_results'] = $this->language->get('text_no_results');
		
		$data['account_response']= $this->model_pushassist_notification->get_account_details();
		$account_response=$data['account_response'];
		
		$data['get_notifications']= $this->model_pushassist_notification->get_notifications();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['send_ntf_link']=$this->url->link('pushassist/sendnotification', 'token=' . $this->session->data['token'], 'SSL');

		if( isset($account_response['error'])) {
		      if( $account_response['error'] =='' && $account_response) {

			  $this->response->setOutput($this->load->view('pushassist/notification_list.tpl', $data));
		      }else{ 
			      $this->session->data['success'] = $data['account_response']['error'];
			      //$this->error['warning']= $data['account_response']['error'];
			      $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		      }
		    
		}else{
			$this->response->setOutput($this->load->view('pushassist/notification_list.tpl', $data));
		}
			
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'pushassist/dashboard')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}