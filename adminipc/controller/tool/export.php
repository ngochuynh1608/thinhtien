<?php 
class ControllerToolExport extends Controller { 
	private $error = array();
	private $value = array();
	private $setting = array();
	
	public function index() {
		$this->load->language('tool/export');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('tool/export');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			if ((isset( $this->request->files['upload'] )) && (is_uploaded_file($this->request->files['upload']['tmp_name']))) {
				$file = $this->request->files['upload']['tmp_name'];
				if ($this->model_tool_export->upload($file, $this->session->data['value'], $this->session->data['settings'])==TRUE) {
					$this->session->data['success'] = $this->language->get('text_success');
					$this->response->redirect($this->url->link('tool/export', 'token=' . $this->session->data['token'], 'SSL'));
				}	
				else {
					$this->error['warning'] = $this->language->get('error_upload');
				}
			}
		}
		$this->OutWiev();
	}

    protected function OutWiev(){	

		if (!empty($this->session->data['export_error']['errstr'])) {
			$this->error['warning'] = $this->session->data['export_error']['errstr'];
			if (!empty($this->session->data['export_nochange'])) {
				$this->error['warning'] .= '<br />'.$this->language->get( 'text_nochange' );
			}
			$this->error['warning'] .= '<br />'.$this->language->get( 'text_log_details' );
		}
		unset($this->session->data['export_error']);
		unset($this->session->data['export_nochange']);

		$data['heading_title'] = $this->language->get('heading_title');
		$data['setting_import'] = $this->language->get('setting_import');
		$data['import_title'] = $this->language->get('import_title');
		$data['entry_restore'] = $this->language->get('entry_restore');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['image_field'] = $this->language->get('image_field');
		$data['name_field'] = $this->language->get('name_field');
		$data['model_field'] = $this->language->get('model_field'); 
		$data['price_field'] = $this->language->get('price_field');
		$data['guantity_field'] = $this->language->get('guantity_field');
		$data['statusenabled_field'] = $this->language->get('statusenabled_field');
		$data['sku_field'] = $this->language->get('sku_field');
		$data['manufacturer_field'] = $this->language->get('manufacturer_field');
		$data['description_field'] = $this->language->get('description_field');
		$data['categories_field'] = $this->language->get('categories_field');
		$data['row_size'] = $this->language->get('row_size');
		$data['min_size_comment'] = $this->language->get('min_size_comment');
		$data['max_size_comment'] = $this->language->get('max_size_comment');
		$data['separator_export'] = $this->language->get('separator_export');
		$data['separator_import'] = $this->language->get('separator_import');
		$data['button_import'] = $this->language->get('button_import');
		$data['button_export'] = $this->language->get('button_export');
		$data['button_enter'] = $this->language->get('button_enter');
		$data['tab_general'] = $this->language->get('tab_general');
		$data['error_select_file'] = $this->language->get('error_select_file');
		$data['error_post_max_size'] = str_replace( '%1', ini_get('post_max_size'), $this->language->get('error_post_max_size') );
		$data['error_upload_max_filesize'] = str_replace( '%1', ini_get('upload_max_filesize'), $this->language->get('error_upload_max_filesize') );
        $data['url'] = $this->session->data['token'];
		$data['setting_export'] = $this->language->get('setting_export');
		$data['export_title'] = $this->language->get('export_title');
		$data['row_size_export'] = $this->language->get('row_size_export');
		$data['number_column'] = $this->language->get('number_column');
		
		If (empty($this->session->data['value'])){
		    $this->session->data['value']['image']= $this->language->get('not_data');
		    $this->session->data['value']['value']= $this->language->get('not_data');
	        $this->session->data['value']['name']= $this->language->get('not_data');
		    $this->session->data['value']['model']=$this->language->get('not_data');
	        $this->session->data['value']['price']=$this->language->get('not_data');
	        $this->session->data['value']['guantity']=$this->language->get('not_data');
		    $this->session->data['value']['statusenabled']=$this->language->get('not_data');
		    $this->session->data['value']['sku']=$this->language->get('not_data');
	        $this->session->data['value']['manufacturer']=$this->language->get('not_data');
		    $this->session->data['value']['description']=$this->language->get('not_data');
		    $this->session->data['value']['categories']=$this->language->get('not_data');
			$this->session->data['value']['min_size'] = 1;
		    $this->session->data['value']['max_size'] = 500;
		    $this->session->data['value']['image_export']= $this->language->get('not_data');
		    $this->session->data['value']['value_export']= $this->language->get('not_data');
	        $this->session->data['value']['name_export']= $this->language->get('not_data');
		    $this->session->data['value']['model_export']=$this->language->get('not_data');
	        $this->session->data['value']['price_export']=$this->language->get('not_data');
	        $this->session->data['value']['guantity_export']=$this->language->get('not_data');
		    $this->session->data['value']['statusenabled_export']=$this->language->get('not_data');
		    $this->session->data['value']['sku_export']=$this->language->get('not_data');
	        $this->session->data['value']['manufacturer_export']=$this->language->get('not_data');
		    $this->session->data['value']['description_export']=$this->language->get('not_data');
		    $this->session->data['value']['categories_export']=$this->language->get('not_data');
			$this->session->data['value']['image_number']= $this->language->get('not_number');
		    $this->session->data['value']['value_number']= $this->language->get('not_number');
	        $this->session->data['value']['name_number']= $this->language->get('not_number');
		    $this->session->data['value']['model_number']=$this->language->get('not_number');
	        $this->session->data['value']['price_number']=$this->language->get('not_number');
	        $this->session->data['value']['guantity_number']=$this->language->get('not_number');
		    $this->session->data['value']['statusenabled_number']=$this->language->get('not_number');
		    $this->session->data['value']['sku_number']=$this->language->get('not_number');
	        $this->session->data['value']['manufacturer_number']=$this->language->get('not_number');
		    $this->session->data['value']['description_number']=$this->language->get('not_number');
		    $this->session->data['value']['categories_number']=$this->language->get('not_number');
		}
		
		If (empty($this->session->data['settings'])){
		    $this->session->data['settings']['image']=0;
            $this->session->data['settings']['name']=0;
		    $this->session->data['settings']['model']=0;
	        $this->session->data['settings']['price']=0;
	        $this->session->data['settings']['guantity']=0;
	        $this->session->data['settings']['statusenabled']=0;
		    $this->session->data['settings']['sku']=0;
	        $this->session->data['settings']['manufacturer']=0;
		    $this->session->data['settings']['description']=0;
		    $this->session->data['settings']['categories']=0;
		    $this->session->data['settings']['image_export']=0;
            $this->session->data['settings']['name_export']=0;
		    $this->session->data['settings']['model_export']=0;
	        $this->session->data['settings']['price_export']=0;
	        $this->session->data['settings']['guantity_export']=0;
	        $this->session->data['settings']['statusenabled_export']=0;
		    $this->session->data['settings']['sku_export']=0;
	        $this->session->data['settings']['manufacturer_export']=0;
		    $this->session->data['settings']['description_export']=0;
		    $this->session->data['settings']['categories_export']=0;
	    }
		
		if (empty($this->session->data['settings_on'])){
		
		    $this->session->data['settings_on']=0;
		}
		
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => FALSE
		);

		$data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('tool/export', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
		
		$data['action'] = $this->url->link('tool/export', 'token=' . $this->session->data['token'], 'SSL');
		$data['export'] = $this->url->link('tool/export/download', 'token=' . $this->session->data['token'], 'SSL');
		$data['post_max_size'] = $this->return_bytes( ini_get('post_max_size') );
	    $data['text_modified_ok'] = $this->language->get('text_modified_ok');
		$data['text_modified_error'] = $this->language->get('text_modified_error');
		$data['text_error_end_row'] = $this->language->get('text_error_end_row');
		$data['text_error_max_row'] = $this->language->get('text_error_max_row');
	    $data['text_row_number_zero'] = $this->language->get('text_row_number_zero');
		$data['text_export_started'] = $this->language->get('text_export_started');
		$data['text_help_export'] = $this->language->get('text_help_export');
		$data['upload_max_filesize'] = $this->return_bytes( ini_get('upload_max_filesize') );
		$data['text_settings_ok'] = $this->language->get('text_settings_ok');
		
		$this->Output($data);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('tool/export.tpl', $data)); 
	}
	
	protected function detect_encoding( $str ) {
		// auto detect the character encoding of a string
		return mb_detect_encoding( $str, 'UTF-8,ISO-8859-15,ISO-8859-1,cp1251,KOI8-R' );
	}
	
	 protected function Output(&$data){		
		$data['image'] = $this->session->data['value']['image'];
		$data['name'] = $this->session->data['value']['name'];
		$data['model'] = $this->session->data['value']['model'];
		$data['price'] = $this->session->data['value']['price'];
		$data['guantity'] = $this->session->data['value']['guantity'];
		$data['statusenabled'] = $this->session->data['value']['statusenabled'];
		$data['sku'] = $this->session->data['value']['sku'];
		$data['manufacturer'] = $this->session->data['value']['manufacturer'];
		$data['description'] = $this->session->data['value']['description'];
		$data['categories'] = $this->session->data['value']['categories'];
		$data['min_size'] = $this->session->data['value']['min_size'];
		$data['max_size'] = $this->session->data['value']['max_size'];
		$data['image_checked'] = $this->session->data['settings']['image'];
		$data['name_checked'] = $this->session->data['settings']['name'];
		$data['model_checked'] = $this->session->data['settings']['model'];
		$data['price_checked'] = $this->session->data['settings']['price'];
		$data['guantity_checked'] = $this->session->data['settings']['guantity'];
		$data['statusenabled_checked'] = $this->session->data['settings']['statusenabled'];
		$data['sku_checked'] = $this->session->data['settings']['sku'];
		$data['manufacturer_checked'] = $this->session->data['settings']['manufacturer'];
		$data['description_checked'] = $this->session->data['settings']['description'];
		$data['categories_checked'] = $this->session->data['settings']['categories'];
		$data['settings_on'] = $this->session->data['settings_on'];
		$data['image_export'] = $this->session->data['value']['image_export'];
		$data['name_export'] = $this->session->data['value']['name_export'];
		$data['model_export'] = $this->session->data['value']['model_export'];
		$data['price_export'] = $this->session->data['value']['price_export'];
		$data['guantity_export'] = $this->session->data['value']['guantity_export'];
		$data['statusenabled_export'] = $this->session->data['value']['statusenabled_export'];
		$data['sku_export'] = $this->session->data['value']['sku_export'];
		$data['manufacturer_export'] = $this->session->data['value']['manufacturer_export'];
		$data['description_export'] = $this->session->data['value']['description_export'];
		$data['categories_export'] = $this->session->data['value']['categories_export'];
		$data['image_number'] = $this->session->data['value']['image_number'];
		$data['name_number'] = $this->session->data['value']['name_number'];
		$data['model_number'] = $this->session->data['value']['model_number'];
		$data['price_number'] = $this->session->data['value']['price_number'];
		$data['guantity_number'] = $this->session->data['value']['guantity_number'];
		$data['statusenabled_number'] = $this->session->data['value']['statusenabled_number'];
		$data['sku_number'] = $this->session->data['value']['sku_number'];
		$data['manufacturer_number'] = $this->session->data['value']['manufacturer_number'];
		$data['description_number'] = $this->session->data['value']['description_number'];
		$data['categories_number'] = $this->session->data['value']['categories_number'];
		$data['image_checked_export'] = $this->session->data['settings']['image_export'];
		$data['name_checked_export'] = $this->session->data['settings']['name_export'];
		$data['model_checked_export'] = $this->session->data['settings']['model_export'];
		$data['price_checked_export'] = $this->session->data['settings']['price_export'];
		$data['guantity_checked_export'] = $this->session->data['settings']['guantity_export'];
		$data['statusenabled_checked_export'] = $this->session->data['settings']['statusenabled_export'];
		$data['sku_checked_export'] = $this->session->data['settings']['sku_export'];
		$data['manufacturer_checked_export'] = $this->session->data['settings']['manufacturer_export'];
		$data['description_checked_export'] = $this->session->data['settings']['description_export'];
		$data['categories_checked_export'] = $this->session->data['settings']['categories_export'];
		}
		
	public function settings(){

          if ($this->validate()) {
                 
             	 $value_temp = $this->request->post['value'];
				 $value_temp = str_replace('&quot;', '"' , $value_temp);
				 $this->value = json_decode($value_temp);
				 $settings_temp = $this->request->post['settings'];
				 $settings_temp = str_replace('&quot;', '"' , $settings_temp);
				 $this->settings = json_decode($settings_temp);
				 
				 $this->session->data['value']['image'] = htmlentities( $this->value->image, ENT_QUOTES, $this->detect_encoding($this->value->image));
		         $this->session->data['value']['name'] = htmlentities( $this->value->name, ENT_QUOTES, $this->detect_encoding($this->value->name));
		         $this->session->data['value']['model'] = htmlentities( $this->value->model, ENT_QUOTES, $this->detect_encoding($this->value->model));
		         $this->session->data['value']['price'] = htmlentities( $this->value->price, ENT_QUOTES, $this->detect_encoding($this->value->price));
		         $this->session->data['value']['guantity'] = htmlentities( $this->value->guantity, ENT_QUOTES, $this->detect_encoding($this->value->guantity));
		         $this->session->data['value']['statusenabled'] = htmlentities( $this->value->statusenabled, ENT_QUOTES, $this->detect_encoding($this->value->statusenabled));
		         $this->session->data['value']['sku'] = htmlentities( $this->value->sku, ENT_QUOTES, $this->detect_encoding($this->value->sku));
		         $this->session->data['value']['manufacturer'] = htmlentities( $this->value->manufacturer, ENT_QUOTES, $this->detect_encoding($this->value->manufacturer));
		         $this->session->data['value']['description'] = htmlentities( $this->value->description, ENT_QUOTES, $this->detect_encoding($this->value->description));
		         $this->session->data['value']['categories'] = htmlentities( $this->value->categories, ENT_QUOTES, $this->detect_encoding($this->value->categories));
				 $this->session->data['value']['min_size'] = htmlentities( $this->value->min_size, ENT_QUOTES, $this->detect_encoding($this->value->min_size));
		         $this->session->data['value']['max_size'] = htmlentities( $this->value->max_size, ENT_QUOTES, $this->detect_encoding($this->value->max_size));
		         $this->session->data['value']['separator_import'] = htmlentities( $this->value->separator_import, ENT_QUOTES, $this->detect_encoding($this->value->separator_import));
				 $this->session->data['value']['separator_export'] = htmlentities( $this->value->separator_export, ENT_QUOTES, $this->detect_encoding($this->value->separator_export));
				 $this->session->data['settings']['image'] = $this->settings->image;
		         $this->session->data['settings']['name'] = $this->settings->name;
		         $this->session->data['settings']['model'] = $this->settings->model;
		         $this->session->data['settings']['price'] = $this->settings->price;
		         $this->session->data['settings']['guantity'] = $this->settings->guantity;
		         $this->session->data['settings']['statusenabled'] = $this->settings->statusenabled;
		         $this->session->data['settings']['sku'] = $this->settings->sku;
		         $this->session->data['settings']['manufacturer'] = $this->settings->manufacturer;
		         $this->session->data['settings']['description'] = $this->settings->description;
		         $this->session->data['settings']['categories'] = $this->settings->categories;
				 $this->session->data['value']['image_export'] = htmlentities( $this->value->image_export, ENT_QUOTES, $this->detect_encoding($this->value->image_export));
		         $this->session->data['value']['name_export'] = htmlentities( $this->value->name_export, ENT_QUOTES, $this->detect_encoding($this->value->name_export));
		         $this->session->data['value']['model_export'] = htmlentities( $this->value->model_export, ENT_QUOTES, $this->detect_encoding($this->value->model_export));
		         $this->session->data['value']['price_export'] = htmlentities( $this->value->price_export, ENT_QUOTES, $this->detect_encoding($this->value->price_export));
		         $this->session->data['value']['guantity_export'] = htmlentities( $this->value->guantity_export, ENT_QUOTES, $this->detect_encoding($this->value->guantity_export));
		         $this->session->data['value']['statusenabled_export'] = htmlentities( $this->value->statusenabled_export, ENT_QUOTES, $this->detect_encoding($this->value->statusenabled_export));
		         $this->session->data['value']['sku_export'] = htmlentities( $this->value->sku_export, ENT_QUOTES, $this->detect_encoding($this->value->sku_export));
		         $this->session->data['value']['manufacturer_export'] = htmlentities( $this->value->manufacturer_export, ENT_QUOTES, $this->detect_encoding($this->value->manufacturer_export));
		         $this->session->data['value']['description_export'] = htmlentities( $this->value->description_export, ENT_QUOTES, $this->detect_encoding($this->value->description_export));
		         $this->session->data['value']['categories_export'] = htmlentities( $this->value->categories_export, ENT_QUOTES, $this->detect_encoding($this->value->categories_export));
		         $this->session->data['value']['image_number'] = htmlentities( $this->value->image_number, ENT_QUOTES, $this->detect_encoding($this->value->image_number));
		         $this->session->data['value']['name_number'] = htmlentities( $this->value->name_number, ENT_QUOTES, $this->detect_encoding($this->value->name_number));
		         $this->session->data['value']['model_number'] = htmlentities( $this->value->model_number, ENT_QUOTES, $this->detect_encoding($this->value->model_number));
		         $this->session->data['value']['price_number'] = htmlentities( $this->value->price_number, ENT_QUOTES, $this->detect_encoding($this->value->price_number));
		         $this->session->data['value']['guantity_number'] = htmlentities( $this->value->guantity_number, ENT_QUOTES, $this->detect_encoding($this->value->guantity_number));
		         $this->session->data['value']['statusenabled_number'] = htmlentities( $this->value->statusenabled_number, ENT_QUOTES, $this->detect_encoding($this->value->statusenabled_number));
		         $this->session->data['value']['sku_number'] = htmlentities( $this->value->sku_number, ENT_QUOTES, $this->detect_encoding($this->value->sku_number));
		         $this->session->data['value']['manufacturer_number'] = htmlentities( $this->value->manufacturer_number, ENT_QUOTES, $this->detect_encoding($this->value->manufacturer_number));
		         $this->session->data['value']['description_number'] = htmlentities( $this->value->description_number, ENT_QUOTES, $this->detect_encoding($this->value->description_number));
		         $this->session->data['value']['categories_number'] = htmlentities( $this->value->categories_number, ENT_QUOTES, $this->detect_encoding($this->value->categories_number));
				 $this->session->data['settings']['image_export'] = $this->settings->image_export;
		         $this->session->data['settings']['name_export'] = $this->settings->name_export;
		         $this->session->data['settings']['model_export'] = $this->settings->model_export;
		         $this->session->data['settings']['price_export'] = $this->settings->price_export;
		         $this->session->data['settings']['guantity_export'] = $this->settings->guantity_export;
		         $this->session->data['settings']['statusenabled_export'] = $this->settings->statusenabled_export;
		         $this->session->data['settings']['sku_export'] = $this->settings->sku_export;
		         $this->session->data['settings']['manufacturer_export'] = $this->settings->manufacturer_export;
		         $this->session->data['settings']['description_export'] = $this->settings->description_export;
		         $this->session->data['settings']['categories_export'] = $this->settings->categories_export;
				 $this->session->data['settings_on']= 1;
				 
          
				 
				 $this->output = array ( 'status' => 'Ok');
				 
				 $this->response->setOutput(json_encode($this->output));

		} else {

			// return error
			   return $this->forward('error/permission');
		}


    }	
	


	function return_bytes($val)
	{
		$val = trim($val);
	
		switch (strtolower(substr($val, -1)))
		{
			case 'm': $val = (int)substr($val, 0, -1) * 1048576; break;
			case 'k': $val = (int)substr($val, 0, -1) * 1024; break;
			case 'g': $val = (int)substr($val, 0, -1) * 1073741824; break;
			case 'b':
				switch (strtolower(substr($val, -2, 1)))
				{
					case 'm': $val = (int)substr($val, 0, -2) * 1048576; break;
					case 'k': $val = (int)substr($val, 0, -2) * 1024; break;
					case 'g': $val = (int)substr($val, 0, -2) * 1073741824; break;
					default : break;
				} break;
			default: break;
		}
		return $val;
	}
	
	
	//Upload from server
	public function load() {
	  
        $this->load->language('tool/export');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('tool/export');	  
		
		if ($this->validate()) {
           
			// send the categories, products and options as a spreadsheet file
		    if ($this->model_tool_export->download($this->session->data['value'], $this->session->data['settings']))
		    {
		       $this->session->data['success'] = $this->language->get('text_success');
			   
			}
			else 
			{
			   $this->error['warning'] = $this->language->get('error_upload');
			   $this->OutWiev();
			}
		} 
		else 
		{
		   
            // return error
            return $this->forward('error/permission');

		}
	
		
	}




	private function validate() {
		if (!$this->user->hasPermission('modify', 'tool/export')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>