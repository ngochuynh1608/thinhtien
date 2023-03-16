<?php
#################################################################
## Open Cart Module:  NotifiVisitors 	   ##
##-------------------------------------------------------------##
##                                         						##
## 					     									  ##
## NotifiVisitors						      					 ##
##-------------------------------------------------------------##
## Permission is hereby granted, when purchased, to  use this  ##
## mod on one domain. This mod may not be reproduced, copied,  ##
## redistributed, published and/or sold.				       ##
##-------------------------------------------------------------##
## Violation of these rules will cause loss of future mod      ##
## updates and account deletion				      			   ##
#################################################################

class ControllerModulenotifyvisitorsV1 extends Controller {
	
	public function index() {		
		
			//-------------------- Referral Code ---------------------------------------------------------------------
		
		$data['notifyvisitorsV1_fname'] = $this->customer->getFirstName();
		$data['notifyvisitorsV1_lname'] = $this->customer->getLastName();
		$data['notifyvisitorsV1_email'] = $this->customer->getEmail();
		$data['notifyvisitorsV1_number'] = $this->customer->getTelephone();		
		
		$data['notifyvisitorsV1_brandid'] = $this->config->get('notifyvisitorsV1_brandid');
		$data['notifyvisitorsV1_secretkey'] = $this->config->get('notifyvisitorsV1_key');
		$data['notifyvisitorsV1_t'] =420; 
		
		if($this->config->get('notifyvisitorsV1_status') == 'On'){
		
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/notifyvisitorsV1.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/notifyvisitorsV1.tpl', $data);
			} else {
				return $this->load->view('default/template/module/notifyvisitorsV1.tpl');
			}
		}		
	}
}