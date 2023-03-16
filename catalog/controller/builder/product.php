<?php 
class ControllerBuilderProduct extends Controller {
    public function index() {
		$this->load->language('product/category');
        
        $this->load->language('builder/product');
        
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
            //$sort = 'p.sort_order';
			$sort = 'p.price';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_product_limit');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
        
		if (isset($this->request->get['category_id'])) {
			$url = '';
            
            $id_path=$this->request->get['category_id'];
            
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$path = '';

			$parts = explode('_', (string)$this->request->get['category_id']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('product/category', 'path=' . $path . $url)
					);
				}
			}
		} else {
            $id_path=159;
			$category_id = 159;
		}

		$category_info = $this->model_catalog_category->getCategory($category_id);
        

		if ($category_info) {
			$this->document->setTitle($category_info['meta_title']);
			$this->document->setDescription($category_info['meta_description']);
			$this->document->setKeywords($category_info['meta_keyword']);
			$this->document->addLink($this->url->link('product/category', 'path=' . $id_path), 'canonical');

			$data['heading_title'] = $category_info['name'];

			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			$data['text_quantity'] = $this->language->get('text_quantity');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_price'] = $this->language->get('text_price');
			$data['text_tax'] = $this->language->get('text_tax');
			$data['text_points'] = $this->language->get('text_points');
			$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');

			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_list'] = $this->language->get('button_list');
			$data['button_grid'] = $this->language->get('button_grid');
            $data['button_submit'] = $this->language->get('button_submit');
			// Set the last category breadcrumb

			if ($category_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
			} else {
				$data['thumb'] = '';
			}

			$data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			$data['compare'] = $this->url->link('product/compare');

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['categories'] = array();

			$results = $this->model_catalog_category->getCategories($category_id);

			foreach ($results as $result) {
				$filter_data = array(
					'filter_category_id'  => $result['category_id'],
					'filter_sub_category' => true
				);

				$data['categories'][] = array(
					'name'  => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
					'href'  => $this->url->link('product/category', 'path=' . $id_path . '_' . $result['category_id'] . $url)
				);
			}

			$data['products'] = array();
            $data['category_code']=$category_id;
			$filter_data = array(
				'filter_category_id' => $category_id,
				'filter_filter'      => $filter,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * 10,
				'limit'              => 10
			);

            //print_r($filter_data);
			$product_total = $this->model_catalog_product->getTotalProducts2($filter_data);

			$results = $this->model_catalog_product->getProducts($filter_data);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], 200, 200);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', 200, 200);
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
                if($result['price']==0)
                {
                    $percent=0;
                    $price="Liên hệ";
                }
                else
                {
                    $price=$price;
                    $percent=round(100 - (float)$result['special']/$result['price']*100);
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
                    'sort_description'  => html_entity_decode($result['sort_description'], ENT_QUOTES, 'UTF-8'),
					'href'        => $this->url->link('product/product', 'path=' . $id_path . '&product_id=' . $result['product_id'] . $url),
                    'percent'	  => $percent,
				);
			}

			$url = '';
            $data['children'][]=array();
            if(isset($this->request->get['path'])){
                $children = $this->model_catalog_category->getCategories($this->request->get['path']);
				foreach ($children as $child) {
                    $data['children'][]=array();
					$data['children'][] = array(
                        'category_id' => $child['category_id'],
						'name'  => $child['name'],
						'href'  => $this->url->link('product/category', 'path=' . $child['category_id']),
					);
				}
            }
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $id_path . '&sort=p.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $id_path . '&sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $id_path . '&sort=pd.name&order=DESC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $id_path . '&sort=p.price&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $id_path . '&sort=p.price&order=DESC' . $url)
			);

			if ($this->config->get('config_review_status')) {
				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/category', 'path=' . $id_path . '&sort=rating&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link('product/category', 'path=' . $id_path . '&sort=rating&order=ASC' . $url)
				);
			}

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/category', 'path=' . $id_path . '&sort=p.model&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link('product/category', 'path=' . $id_path . '&sort=p.model&order=DESC' . $url)
			);

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$data['limits'] = array();

			$limits = array_unique(array($this->config->get('config_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('product/category', 'path=' . $id_path . $url . '&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('builder/product', 'path=' . $id_path . $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['limit'] = $limit;

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
            $data['cost_href']=$this->url->link('builder/product/cost' );

            /*----- filter -------*/
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
            $this->load->language('module/filter');
            $data['button_filter'] = $this->language->get('button_filter');
            $data['action'] = str_replace('&amp;', '&', $this->url->link('builder/product', 'path=' . $id_path . $url));
    		if (isset($this->request->get['filter'])) {
    			$data['filter_category'] = explode(',', $this->request->get['filter']);
    		} else {
    			$data['filter_category'] = array();
    		}
			$data['filter_groups'] = array();

			$filter_groups = $this->model_catalog_category->getCategoryFilters($category_id);

			if ($filter_groups) {
				foreach ($filter_groups as $filter_group) {
					$childen_data = array();

					foreach ($filter_group['filter'] as $filter) {
						$filter_data = array(
							'filter_category_id' => $category_id,
							'filter_filter'      => $filter['filter_id']
						);

						$childen_data[] = array(
							'filter_id' => $filter['filter_id'],
							'name'      => $filter['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : '')
						);
					}

					$data['filter_groups'][] = array(
						'filter_group_id' => $filter_group['filter_group_id'],
						'name'            => $filter_group['name'],
						'filter'          => $childen_data
					);
				}
			}
            $step_id=array(93,90,158,91,83,158,216);
            
            
            foreach($step_id as $id)
            {
                $category_infor = $this->model_catalog_category->getCategory($id);
                if(isset($this->session->data['build'][$id]))
                {
                    $data['categorys'][]=array(
                        'id'        =>  $category_infor['category_id'],
                        'name'      =>  $category_infor['name'],
                        'href'      =>  $this->url->link('builder/product', 'category_id=' . $category_infor['category_id'] ),
                        'image'     =>  $this->session->data['build'][$id]['thumb'],
                    );
                }
                else
                {
                    $data['categorys'][]=array(
                        'id'        =>  $category_infor['category_id'],
                        'name'      =>  $category_infor['name'],
                        'href'      =>  $this->url->link('builder/product', 'category_id='. $category_infor['category_id'] ),
                    );
                }
            }
    		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/builder.tpl')) {
    			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/builder.tpl', $data));
    		} else {
    			$this->response->setOutput($this->load->view('default/template/product/builder.tpl', $data));
    		}
		} else {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/category', $url)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

    		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/builder.tpl')) {
    			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/builder.tpl', $data));
    		} else {
    			$this->response->setOutput($this->load->view('default/template/product/builder.tpl', $data));
    		}
        
    }
    }
    public function add()
    {
        $this->load->model('tool/image');
        $json=array();
  		if (isset($this->request->post['product_id'])) {
			$product_id = (int)$this->request->post['product_id'];
		} else {
			$product_id = 0;
		}
  		if (isset($this->request->post['category'])) {
			$category = (int)$this->request->post['category'];
		} else {
			$category = 0;
		}
		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);
		if ($product_info) {
			if ($product_info['image']) {
				$image = $this->model_tool_image->resize($product_info['image'], 70, 70);
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', 70, 70);
			}
            $price=0;
            if(!empty($product_info['special']))
            {
                $price=$product_info['special'];
            }
            else{
                $price=$product_info['price'];
            }
			$this->session->data['build'][$category] = array(
                'name'          => $product_info['name'],
                'description'   => html_entity_decode($product_info['sort_description'], ENT_QUOTES, 'UTF-8'),
                'thumb'         => $image,
                'price'         => $price,
                'price_format'  => $this->currency->format($price),
                'href'          => $this->url->link('product/product', '&product_id=' . $product_info['product_id']),
                'id'            => $product_info['product_id'],
            );
            $json['success'] = 'Đã chọn sản phẩm';
        }
        
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
    }
    
    public function step_sidebar()
    {
         $step_id=array(93,90,158,91,83,158,216);
        
        $this->load->model('catalog/category');
        
        $data=array();
        
        foreach($step_id as $id)
        {
            $category_info = $this->model_catalog_category->getCategory($id);
            if(isset($this->session->data['build'][$id]))
            {
                $data['categorys'][]=array(
                    'id'        =>  $category_info['category_id'],
                    'name'      =>  $category_info['name'],
                    'href'      =>  $this->url->link('builder/product', 'category_id=' . $category_info['category_id'] ),
                    'image'     =>  $this->session->data['build'][$id]['thumb'],
                    
                );
                echo $this->url->link('builder/product', 'category_id=' . $category_info['category_id'] );
            }
            else
            {
                $data['categorys'][]=array(
                    'id'        =>  $category_info['category_id'],
                    'name'      =>  $category_info['name'],
                    'href'      =>  $this->url->link('builder/product', 'category_id='. $category_info['category_id'] ),
                );
                echo $this->url->link('builder/product', 'category_id=' . $category_info['category_id'] );
            }
        }
        
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/step.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/product/step.tpl', $data);
		} else {
			return $this->load->view('default/template/product/step.tpl', $data);
		}
    }
    
	public function step() {
		$this->response->setOutput($this->step_sidebar());
	}
    
    public function cost()
    {
        $this->load->language('builder/product');
        
        $data=array();
        
        $data['total_price']=0;
        
        $total=0;
        
        if(isset($this->session->data['build']))
        {
            foreach($this->session->data['build'] as $product)
            {
                $data['products'][]=$product;
                $total=$total+$product['price'];
                $data['total_price']=$this->currency->format($total);
            }

        }
        
		$this->document->setTitle($this->language->get('heading_title'));
        $data['reset_href']  =   $this->url->link('builder/product/reset', '', '');
		$data['heading_title'] = $this->language->get('heading_title');
        $data['description'] = $this->language->get('description');
        $data['price']      = $this->language->get('price');
        $data['image']  = $this->language->get('image');
        $data['total'] = $this->language->get('total');
        $data['name_product'] = $this->language->get('name_product');
        $data['stt'] = $this->language->get('stt');
        $data['reset'] = $this->language->get('reset');
        $data['cart'] = $this->language->get('cart');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/cost.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/cost.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/product/cost.tpl', $data));
		}
    }
    public function reset()
    {
        if(isset($this->session->data['build']))
        {
            unset($this->session->data['build']);
        }
        $this->response->redirect($this->url->link('builder/product', '', ''));
        
    }
	public function add_cart() {
        if(isset($this->session->data['build']))
        {
            foreach($this->session->data['build'] as $product)
            {
                print_r($product);
                $this->cart->add($product['id'],1);
            }
            $this->response->redirect($this->url->link('checkout/cart', '', 'SSL'));
        }
        else
        {
            $this->response->redirect($this->url->link('builder/product', '', ''));
        }
	}
}