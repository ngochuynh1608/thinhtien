<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));
		$test2 = $this->request->get['test2'];
		$this->load->model('catalog/manufacturer');

		$this->load->model('tool/image');

		$results = $this->model_catalog_manufacturer->getManufacturers();


		if (isset($this->request->get['test'])) {
			$test = $this->request->get['test'];
		} else {
			$test = '';
		}

		if($test==1)
		{

			
			foreach ($results as $result) {

				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}

				$data['manufacturer'][] = array(
					'name' => $result['name'],
					'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id']),
					'image'=> $image

				);
			}
		}

		if (isset($this->request->get['route'])) {
			if ($this->request->server['HTTPS']) {
				$this->document->addLink(HTTPS_SERVER, 'canonical');
			}
			else{
				$this->document->addLink(HTTP_SERVER, 'canonical');
			}
		}
		if(!empty($test2)){
			$startTime = microtime(true);
		}
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		if(!empty($test2)){
			echo "Time:  " . number_format(( microtime(true) - $startTime), 4) . " Seconds\n";
		}
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
		}
	}
}