<?php
class ControllerModuleFormillaedge extends Controller {
	public function index() {
		$this->load->language('module/formillaedge');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['code'] = html_entity_decode($this->config->get('formillaedge_plugin_id'));

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/formillaedge.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/formillaedge.tpl', $data);
		} else {
			return $this->load->view('default/template/module/formillaedge.tpl', $data);
		}
	}
}