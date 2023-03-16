<?php
class ControllerModuleLiveSearchLite extends Controller
{
	public function index() {
		//$this->document->addScript('catalog/view/javascript/livesearchlite.js');
        $this->load->model('catalog/product');
        $this->load->model('tool/image');
		if (isset($this->request->get['filter_name']) && strlen($this->request->get['filter_name']) >= 1) {

			//$querys = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_description` WHERE `name` LIKE '%" . $this->db->escape($this->request->get['filter_name']) . "%' ORDER BY name ASC");
			if (isset($this->request->get['filter_name']) || isset($this->request->get['tag'])) {
			$filter_data = array(
				'filter_name'         => $this->request->get['filter_name'],
                'start'               => 0,
                'limit'               => 5
			);
            }
            $results = $this->model_catalog_product->getProducts($filter_data);
            foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], 50, 50);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', 50, 50);
				}
                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				    $price=$special;
                } else {
					$special = false;
				}
                if($result['price']==0)
                {
                    $percent=0;
                    $price="Liên h?";
                }
				$data[] = array(
					'name' => $result['name'],
					'href' => $this->url->link('product/product', 'product_id=' . $result['product_id']),
                    'thumb'=> $image,
                    'price'=> $price,
				);
			}
			
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($data));
		}
	}
}