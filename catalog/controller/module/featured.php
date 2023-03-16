<?php
class ControllerModuleFeatured extends Controller {
	public function index($setting) {
		$this->load->language('module/featured');
        
		$data['heading_title'] = $setting['name'];

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}
		
		if (!empty($setting['product'])) {
			$products = array_slice($setting['product'], 0, 8);
			if(!empty($products)){
				foreach ($products as $product_id) {
					$product_info = $this->model_catalog_product->getProduct($product_id);

					$sale_off = null;

					if($product_info['special']){

						$sale_off = $product_info['price'] - $product_info['special'];

						$sale_off= $this->currency->format($this->tax->calculate($sale_off, $product_info['tax_class_id'], $this->config->get('config_tax')));
						if (isset($this->request->get['test'])) {
							
							echo $sale_off;

						}
					}


					if ($product_info) {
						if ($product_info['image']) {
							$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height'],'w');
						} else {
							$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
						}

						if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
							$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
						} else {
							$price = false;
						}

						if ((float)$product_info['special']) {
							$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
						} else {
							$special = false;
						}

						if ($this->config->get('config_tax')) {
							$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
						} else {
							$tax = false;
						}

						if ($this->config->get('config_review_status')) {
							$rating = $product_info['rating'];
						} else {
							$rating = false;
						}
	                    
	                    
	                    $options = array();
	                    
	                    foreach ($this->model_catalog_product->getProductOptions($product_id) as $option) {
	                        if($option['type']=='textarea')
	                        {
	                           $options[] = array(
	                              'product_option_id' => $option['product_option_id'],
	                              'option_id'         => $option['option_id'],
	                              'name'              => $option['name'],
	                              'type'              => $option['type'],
	                              'option_value'      => $option['value'],
	                              'required'          => $option['required']
	                           );
	                       }              
	                    }
	                    $gift=strip_tags(html_entity_decode($product_info['gift'], ENT_QUOTES, 'UTF-8'));
	                    if(empty($gift))
	                    {
	                        $gift="";
	                    }
	                    else
	                    {
	                        $gift = utf8_substr(strip_tags(html_entity_decode($product_info['gift'], ENT_QUOTES, 'UTF-8')), 0, 45);
	                    }
	                    if($product_info['price']==0)
	                    {
	                        $percent = 0;
	                        $price="Liên hệ";
	                    }
	                    else
	                    {
	                        $price=$price;
	                        $percent=round(100 - (float)$product_info['special']/$product_info['price']*100);
	                    }



						$data['products'][] = array(
							'product_id'  => $product_info['product_id'],
							'thumb'       => $image,
							'name'        => utf8_substr(strip_tags(html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8')), 0, 45),
							'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
							'price'       => $price,
							'special'     => $special,
							'tax'         => $tax,
							'rating'      => $rating,
							'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'], '', 'SSL'),
	                        'option'      => $options,
	                        'gift'        => $gift,
	                        'sort_description'  => html_entity_decode($product_info['sort_description'], ENT_QUOTES, 'UTF-8'),
	                        'sale_off'	  => $sale_off,
	                        'percent'		=> $percent,
	                        'date_added'  => $product_info['date_added'],
						);
					}
				}
			}
		}

		if ($data['products']) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/featured.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/featured.tpl', $data);
			} else {
				return $this->load->view('default/template/module/featured.tpl', $data);
			}
		}
	}
}