<?php
class ControllerCommonHeader extends Controller {
	public function index() {
        $data['demo']="Thiss data demo";
		$data['title'] = $this->document->getTitle();
        $this->load->model('tool/image');
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
        $data['template']='common/home';
        if (isset($this->request->get['route'])) {
            $data['template']=$this->request->get['route'];
        }
		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		if ($this->config->get('config_google_analytics_status')) {
			$data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		} else {
			$data['google_analytics'] = '';
		}

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

		$data['text_home'] = $this->language->get('text_home');
		$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');

		$data['home'] = $this->url->link('common/home', '', 'SSL');
        $data['xdch'] = $this->url->link('builder/product', '', 'SSL');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['register'] = $this->url->link('account/register', '', 'SSL');
		$data['login'] = $this->url->link('account/login', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$data['download'] = $this->url->link('account/download', '', 'SSL');
		$data['logout'] = $this->url->link('account/logout', '', 'SSL');
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');
        $data['address'] = $this->config->get('config_address');
        $data['email'] = $this->config->get('config_email');
        $data['open'] = $this->config->get('config_open');
        $data['hotline'] = $this->config->get('config_fax');
		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();
                $image2="";
				if ($category['image']) {
					$image2 = $this->model_tool_image->resize($category['image'], $this->config->get('config_image_wishlist_width'), $this->config->get('config_image_wishlist_width'));
				} else {
					$image2 = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_wishlist_width'), $this->config->get('config_image_wishlist_width'));
				}
					
				$children = $this->model_catalog_category->getCategories($category['category_id']);
                
				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);
                    $children2_data=array();
                    $children2 = $this->model_catalog_category->getCategories($child['category_id']);
                    foreach ($children2 as $child2) {
    					$children2_data[] = array(
                            'category_id' => $child2['category_id'],
    						'name'  => $child2['name'],
    						'href'  => $this->url->link('product/category', 'path=' . $child2['category_id'], '', 'SSL'),
    					);
                        
                    }
        			$data['filter_groups'] = array();
        
        			$filter_groups = $this->model_catalog_category->getCategoryFilters($child['category_id']);
        			if ($filter_groups) {
        				foreach ($filter_groups as $filter_group) {
        					$childen_data = array();
        
        					foreach ($filter_group['filter'] as $filter) {
        						$filter_data = array(
        							'filter_category_id' => $child['category_id'],
        							'filter_filter'      => $filter['filter_id']
        						);
        
        						$childen_data[] = array(
        							'filter_id' => $filter['filter_id'],
        							'name'      => $filter['name']
        						);
        					}
        
        					$data['filter_groups'][] = array(
        						'filter_group_id' => $filter_group['filter_group_id'],
        						'name'            => $filter_group['name'],
        						'filter'          => $childen_data
        					);
        				}
                    }
					$children_data[] = array(
                        'category_id' => $child['category_id'],
						'name'  => $child['name'] ,
						'href'  => $this->url->link('product/category', 'path=' . $child['category_id'], '', 'SSL'),
                        'filter'=> $data['filter_groups'],
                        'child' => $children2_data
					);
				}
                
    			$data['filter_groups'] = array();
    
    			$filter_groups = $this->model_catalog_category->getCategoryFilters($category['category_id']);
    			if ($filter_groups) {
    				foreach ($filter_groups as $filter_group) {
    					$childen_data = array();
    
    					foreach ($filter_group['filter'] as $filter) {
    						$filter_data = array(
    							'filter_category_id' => $category['category_id'],
    							'filter_filter'      => $filter['filter_id']
    						);
    
    						$childen_data[] = array(
    							'filter_id' => $filter['filter_id'],
    							'name'      => $filter['name'] 
    						);
    					}
    
    					$data['filter_groups'][] = array(
    						'filter_group_id' => $filter_group['filter_group_id'],
    						'name'            => $filter_group['name'],
    						'filter'          => $childen_data
    					);
    				}
                }
				// Level 1
				$data['categories'][] = array(
                    'category_id'     => $category['category_id'],
					'name'     => $category['name'],
					'children' => $children_data,
                    'thumb'    => $image2,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'], '', 'SSL'),
                    'filter'   => $data['filter_groups'], 
				);
			}
		}

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

			// Totals
			$this->load->model('extension/extension');

			$total_data = array();
			$total = 0;
			$taxes = $this->cart->getTaxes();

			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$sort_order = array();

				$results = $this->model_extension_extension->getExtensions('total');

				foreach ($results as $key => $value) {
					$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
				}

				array_multisort($sort_order, SORT_ASC, $results);

				foreach ($results as $result) {
					if ($this->config->get($result['code'] . '_status')) {
						$this->load->model('total/' . $result['code']);

						$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
					}
				}

				$sort_order = array();

				foreach ($total_data as $key => $value) {
					$sort_order[$key] = $value['sort_order'];
				}

				array_multisort($sort_order, SORT_ASC, $total_data);
			}

			$data['totals'] = array();
			foreach ($total_data as $total) {
				$data['totals'][] = array(
					'title' => $total['title'],
					'text'  => $this->currency->format($total['value'])
				);
			}

		$data['text_items'] = $this->cart->countProducts();
		$this->load->model('tool/image');
		
		$data['products'] = array();
			
		foreach ($this->cart->getProducts() as $product) {
			if ($product['image']) {
				$image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
			} else {
				$image = '';
			}
							
			$option_data = array();
			
			foreach ($product['option'] as $option) {
				if ($option['type'] != 'file') {
					$value = $option['option_value'];	
				} else {
					$filename = $this->encryption->decrypt($option['option_value']);
					
					$value = utf8_substr($filename, 0, utf8_strrpos($filename, '.'));
				}				
				
				$option_data[] = array(								   
					'name'  => $option['name'],
					'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value),
					'type'  => $option['type']
				);
			}
			
			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = false;
			}
			
			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
			} else {
				$total = false;
			}
													
			$data['products'][] = array(
                'product_id'=> $product['product_id'],
				'key'       => $product['key'],
				'thumb'     => $image,
				'name'      => $product['name'],
				'model'     => $product['model'], 
				'option'    => $option_data,
				'quantity'  => $product['quantity'],
				'price'     => $price,	
				'total'     => $total,	
				'href'      => $this->url->link('product/product', 'product_id=' . $product['product_id']),
                'recurring' => $product['recurring'],
                //'profile'   => $product['profile_name'],
			);
		}
		
		// Gift Voucher
		$data['vouchers'] = array();
		
		if (!empty($this->session->data['vouchers'])) {
			foreach ($this->session->data['vouchers'] as $key => $voucher) {
				$this->data['vouchers'][] = array(
					'key'         => $key,
					'description' => $voucher['description'],
					'amount'      => $this->currency->format($voucher['amount'])
				);
			}
		}	
		$data['cart'] = $this->url->link('checkout/cart');
        $data['information_href'] = $this->url->link('information/information', 'information_id=4');
        $data['guide_href'] = $this->url->link('information/information', 'information_id=7');
        $data['news_href'] = $this->url->link('information/news');
        $data['contact_href'] = $this->url->link('information/contact');
        $data['landing_href'] = $this->config->get('config_url') .'khuyen-mai.html';
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
		} else {
			return $this->load->view('default/template/common/header.tpl', $data);
		}
	}
}