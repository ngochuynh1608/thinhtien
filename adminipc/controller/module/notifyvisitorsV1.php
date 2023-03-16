<?php 
#################################################################
## Open Cart Module: NotifiVisitors - Notification Automation	   ##
##-------------------------------------------------------------##
## Copyright © 2015 "NotifiVisitors" All rights reserved.     ##
## http://www.NotifiVisitors.com						       ##
##-------------------------------------------------------------##
## Permission is hereby granted, when purchased, to  use this  ##
## mod on one domain. This mod may not be reproduced, copied,  ##
## redistributed, published and/or sold.				       ##
##-------------------------------------------------------------##
## Violation of these rules will cause loss of future mod      ##
## updates and account deletion				      			   ##
#################################################################

class ControllerModulenotifyvisitorsV1 extends Controller {
	
	private $error = array(); 

	public function index() {
		
		$this->load->language('module/notifyvisitorsV1');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('notifyvisitorsV1', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));

		}
		
		$text_array = array('heading_title','advert','text_edit','text_enabled','text_disabled','text_on','text_off','entry_test','button_save','button_cancel','entry_notifyvisitorsV1_brandid','entry_notifyvisitorsV1_key');
		
		foreach($text_array as $key){
			$data[$key] = $this->language->get($key);
		}
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['notifyvisitorsV1_brandid'])) {
			$data['error_notifyvisitorsV1_brandid'] = $this->error['notifyvisitorsV1_brandid'];
		} else {
			$data['error_notifyvisitorsV1_brandid'] = '';
		}
		
		//-----------------------------notifyvisitorsV1_KEY ---------------------------
		
		if (isset($this->error['notifyvisitorsV1_key'])) {
			$data['error_notifyvisitorsV1_key'] = $this->error['notifyvisitorsV1_key'];
		} else {
			$data['error_notifyvisitorsV1_key'] = '';
		}
		
		//---------------------------notifyvisitorsV1_key-----------------------------
		
		
		
		
		
		


  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/notifyvisitorsV1', 'token=' . $this->session->data['token'], 'SSL')
   		);
				
		$data['action'] = $this->url->link('module/notifyvisitorsV1', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['notifyvisitorsV1_brandid'])) {
			$data['notifyvisitorsV1_brandid'] = $this->request->post['notifyvisitorsV1_brandid'];
		} else {
			$data['notifyvisitorsV1_brandid'] = $this->config->get('notifyvisitorsV1_brandid');
		}
		
		//------------------------------------------------------------ notifyvisitorsV1_KEY ---------------
		if (isset($this->request->post['notifyvisitorsV1_key'])) {
			$data['notifyvisitorsV1_key'] = $this->request->post['notifyvisitorsV1_key'];
		} else {
			$data['notifyvisitorsV1_key'] = $this->config->get('notifyvisitorsV1_key');
		}
		//------------------------------------------------------------ notifyvisitorsV1_KEY ---------------
		
		if (isset($this->request->post['notifyvisitorsV1_status'])) {
			$data['notifyvisitorsV1_status'] = $this->request->post['notifyvisitorsV1_status'];
		} else {
			$data['notifyvisitorsV1_status'] = $this->config->get('notifyvisitorsV1_status');
		}
		
		

		
		
		

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/notifyvisitorsV1.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/notifyvisitorsV1')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['notifyvisitorsV1_brandid']) {
			$this->error['notifyvisitorsV1_brandid'] = $this->language->get('error_notifyvisitorsV1_brandid');
		}
		
		if (!$this->request->post['notifyvisitorsV1_key']) {
			$this->error['notifyvisitorsV1_key'] = $this->language->get('error_notifyvisitorsV1_key');
		}
			
		
		return !$this->error;
		
	}	
}
?>