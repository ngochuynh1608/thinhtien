<?php

class ControllerProductLandingpage extends Controller {
	public function index() {
		$this->load->language('product/category');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');
        
		$this->load->model('tool/image');
        $data['heading_title'] = $this->language->get('button_cart');
        $data['template'] = 'product/landingpage';
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_list'] = $this->language->get('button_list');
		$data['button_grid'] = $this->language->get('button_grid');
		$results = $this->model_catalog_product->getProductsLanding();

		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
			}

			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = false;
			}

			if ((float)$result['special']) {
				$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$special = false;
			}

			if ($this->config->get('config_tax')) {
				$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
			} else {
				$tax = false;
			}

			if ($this->config->get('config_review_status')) {
				$rating = (int)$result['rating'];
			} else {
				$rating = false;
			}
            $gift=strip_tags(html_entity_decode($result['gift'], ENT_QUOTES, 'UTF-8'));
            if(empty($gift))
            {
                $gift="";
            }
            else
            {
                $gift=utf8_substr(strip_tags(html_entity_decode($result['gift'], ENT_QUOTES, 'UTF-8')), 0, 45);
            }
			$data['products'][] = array(
				'product_id'  => $result['product_id'],
				'thumb'       => $image,
                'name'        => utf8_substr(strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')), 0, 45),
				'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
				'price'       => $price,
				'special'     => $special,
				'tax'         => $tax,
				'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
				'rating'      => $result['rating'],
                'date_added'  => $result['date_added'],
                'gift'        => $gift,
				'price'       => $price,
                'sort_description'  => html_entity_decode($result['sort_description'], ENT_QUOTES, 'UTF-8'),
				'href'        => $this->url->link('product/product', '&product_id=' . $result['product_id']),
                'percent'	  => round(100 - (float)$special/$price*100),
			);
		}
        $this->document->setTitle("SẢN PHẨM KHUYẾN MÃI");
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
 		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/landingpage.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/landingpage.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/product/landingpage.tpl', $data));
		}
	}
 
 }

?>