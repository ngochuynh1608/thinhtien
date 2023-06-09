<?php
class ControllerModuleFormillaedge extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/formillaedge');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('formillaedge', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
	    $data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_plugin_id'] = $this->language->get('entry_plugin_id');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['help_code'] = $this->language->get('help_code');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['code'])) {
			$data['error_code'] = $this->error['code'];
		} else {
			$data['error_code'] = '';
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
			'href' => $this->url->link('module/formillaedge', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/formillaedge', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['formillaedge_plugin_id'])) {
			$data['formillaedge_plugin_id'] = $this->request->post['formillaedge_plugin_id'];
		} else {
			$data['formillaedge_plugin_id'] = $this->config->get('formillaedge_plugin_id');
		}

		if (isset($this->request->post['formillaedge_status'])) {
			$data['formillaedge_status'] = $this->request->post['formillaedge_status'];
		} else {
			$data['formillaedge_status'] = $this->config->get('formillaedge_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/formillaedge.tpl', $data));
	}

	protected function validate() {

		if (!$this->request->post['formillaedge_plugin_id']) {
			$this->error['code'] = $this->language->get('error_code');
		}

		return !$this->error;
	}
}