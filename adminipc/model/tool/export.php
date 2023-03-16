<?php

static $registry = NULL;

// Error Handler
function error_handler_for_export($errno, $errstr, $errfile, $errline) {
	global $registry;
	
	switch ($errno) {
		case E_NOTICE:
		case E_USER_NOTICE:
			$errors = "Notice";
			break;
		case E_WARNING:
		case E_USER_WARNING:
			$errors = "Warning";
			break;
		case E_ERROR:
		case E_USER_ERROR:
			$errors = "Fatal Error";
			break;
		default:
			$errors = "Unknown";
			break;
	}
	
	$config = $registry->get('config');
	$url = $registry->get('url');
	$request = $registry->get('request');
	$session = $registry->get('session');
	$log = $registry->get('log');
	
	if ($config->get('config_error_log')) {
		$log->write('PHP ' . $errors . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);
	}

	if (($errors=='Warning') || ($errors=='Unknown')) {
		return true;
	}

	if (($errors != "Fatal Error") && isset($request->get['route']) && ($request->get['route']!='tool/export/download'))  {
		if ($config->get('config_error_display')) {
			echo '<b>' . $errors . '</b>: ' . $errstr . ' in <b>' . $errfile . '</b> on line <b>' . $errline . '</b>';
		}
	} else {
		$session->data['export_error'] = array( 'errstr'=>$errstr, 'errno'=>$errno, 'errfile'=>$errfile, 'errline'=>$errline );
		$token = $request->get['token'];
		$link = $url->link( 'tool/export', 'token='.$token, 'SSL' );
		header('Status: ' . 302);
		header('Location: ' . str_replace(array('&amp;', "\n", "\r"), array('&', '', ''), $link));
		exit();
	}

	return true;
}


function fatal_error_shutdown_handler_for_export()
{
	$last_error = error_get_last();
	if ($last_error['type'] === E_ERROR) {
		// fatal error
		error_handler_for_export(E_ERROR, $last_error['message'], $last_error['file'], $last_error['line']);
	}
}


class ModelToolExport extends Model {

	private $error = array();
	private $value = array();
	private $settings = array();
	private $separator = array ("0" => ":",
	                            "1" => ";",
	                            "2" => "#",
								"3" => "*"
	                            );


	function clean( &$str, $allowBlanks=FALSE ) {
		$result = "";
		$n = strlen( $str );
		for ($m=0; $m<$n; $m++) {
			$ch = substr( $str, $m, 1 );
			if (($ch==" ") && (!$allowBlanks) || ($ch=="\n") || ($ch=="\r") || ($ch=="\t") || ($ch=="\0") || ($ch=="\x0B")) {
				continue;
			}
			$result .= $ch;
		}
		return $result;
	}


	function multiquery( &$database, $sql ) {
		foreach (explode(";\n", $sql) as $sql) {
			$sql = trim($sql);
			if ($sql) {
				$database->query($sql);
			}
		}
	}


	protected function getDefaultLanguageId( &$database ) {
		$code = $this->config->get('config_language');
		$sql = "SELECT language_id FROM `".DB_PREFIX."language` WHERE code = '$code'";
		$result = $database->query( $sql );
		$languageId = 1;
		if ($result->rows) {
			foreach ($result->rows as $row) {
				$languageId = $row['language_id'];
				break;
			}
		}
		return $languageId;
	}


	protected function getDefaultWeightUnit() {
		$weightUnit = $this->config->get( 'config_weight_class' );
		return $weightUnit;
	}


	protected function getDefaultMeasurementUnit() {
		$measurementUnit = $this->config->get( 'config_length_class' );
		return $measurementUnit;
	}



	protected function detect_encoding( $str ) {
		// auto detect the character encoding of a string
		return mb_detect_encoding( $str, 'UTF-8,ISO-8859-15,ISO-8859-1,cp1251,KOI8-R' );
	}
	
	protected function readRow($data, $i, $name, $default = ''){
	
	         $temp = explode($this->separator[$this->value['separator_import']], $data[$i]);
	         $out = $temp[(int)$name];
			 
			 
			 if (isset($out))
			 {
			    return trim($out);
			 }
			 else
			 {
			    return $default;
			 }
	
	
	}




        function uploadPrice( &$reader, &$database ){
		         // find the default language id and default units
		         $languageId = $this->getDefaultLanguageId($database);
		         $defaultWeightUnit = $this->getDefaultWeightUnit();
		         $defaultMeasurementUnit = $this->getDefaultMeasurementUnit();
		         $defaultStockStatusId = $this->config->get('config_stock_status_id'); 
		         $data = explode("\r\n", $reader->getContents());		 
		         $temp = explode($this->separator[$this->value['separator_import']], $data[0]);
		         $k = count($temp);				 
		         $firstColumn = array();
				 $nameColumn = array();
				 
		         $i = 0;
				 
		         for ($j=0; $j < $k; $j+=1) {
				 
				      
			          $firstColumn[$j] = trim($temp[$j]);
					  
					  
					  foreach($this->settings as $index => $checked){
		
		                     if ($checked=='true'){
							     
							   
							    if (in_array($this->value[$index], $firstColumn)){
								
								    if (!isset($nameColumn[$index]))
									{
									
										    $nameColumn[$index] = $j;
							
									}  
								}
								
	                        }
			         }
					  
		         }
				 
				 
				 $products = array();
		         $product = array();
		         $isFirstRow = TRUE;
		         $i = 0;
				 $p = 1;
		         $k = count($data);
				 if ($this->value['max_size'] < $k){
				 
				    $k = $this->value['max_size'];
				 }
				 if ($this->value['min_size'] > 0){
				 
				     $i = $this->value['min_size'];
				 }
				 ini_set('max_execution_time','90');
		         for ($i; $i<$k; $i+=1) {
				 
				      if ($isFirstRow){
					  
					     $isFirstRow = false;
					     continue;
					  }
					  
				 
					  if ($this->settings['name']=='true'){
			              $name = $this->readRow($data,$p,$nameColumn['name']);
			              $name = htmlentities( $name, ENT_QUOTES, $this->detect_encoding($name), '0' );
                          $product['name'] = addslashes($name);
					  }
					  else
					  {
					      $product['name'] = 0;
					  
					  }
					  
					  if ($this->settings['image']=='true'){
					      $imageName = $this->readRow($data,$p,$nameColumn['image'],'0');
	                      $product['image'] = addslashes($imageName);    
					  }
					  else
					  {
					      $product['image'] = 0;
					  
					  }
					  
					  if ($this->settings['model']=='true'){
					      $model = $this->readRow($data,$p,$nameColumn['model'],'0');
					      $product['model'] = addslashes($model);
					  }
					  else
					  {
					      $product['model'] = 0;
					  
					  }
					  
					  if ($this->settings['price']=='true'){
					      $price = $this->readRow($data,$p,$nameColumn['price'],'0');
				          $product['price'] = addslashes($price);
					  }
					  else
					  {
					      $product['price'] = 0;
					  
					  }
					  
					  if ($this->settings['guantity']=='true'){
					      $guantity = $this->readRow($data,$p,$nameColumn['guantity'],'0');
					      $product['guantity'] = addslashes($guantity);
					  }
					  else
					  {
					      $product['guantity'] = 0;
					  
					  }
					
					  
					  if ($this->settings['statusenabled']=='true'){
					      $status = $this->readRow($data,$p,$nameColumn['statusenabled'],'0');
					      $product['status'] = addslashes($status);
					  }
					  else
					  {
					      $product['status'] = 0;
					  
					  }
					  
					  if ($this->settings['sku']=='true'){
					      $sku = $this->readRow($data,$p,$nameColumn['sku'],'0'); 
		                  $product['sku'] = addslashes($sku);
					  }
					  else
					  {
					      $product['sku'] = 0;
					  
					  }
					 
					  
					  if ($this->settings['manufacturer']=='true'){
					      $manufacturer = $this->readRow($data,$p,$nameColumn['manufacturer'],'0');
						  $product['manufacturer'] = addslashes($manufacturer);
					  }
					  else
					  {
					      $product['manufacturer'] = 0;
					  
					  }
					  
					  if ($this->settings['description']=='true'){
					      $description = $this->readRow($data,$p,$nameColumn['description'],'0');
			              $description = htmlentities( $description, ENT_QUOTES, $this->detect_encoding($description) ); 
					      $product['description'] = addslashes($description);
					  
					  }
					  else
					  {
					      $product['description'] = 0;
					  
					  }
					  
					  if ($this->settings['categories']=='true'){
					      $categories = $this->readRow($data,$p,$nameColumn['categories'],'0');
					      $product['categories']= addslashes($categories);
					  
					  }
					  else
					  {
					      $product['categories'] = 0;
					  
					  }
					  
					  $products[$p]=$product;
					  $p++;
					  
		        }
				

		              return $this->storeProductsIntoDatabase( $database, $products );
				
				 
		}
		
		
		function storeProductsIntoDatabase( &$database, &$products ) 
	    {
			// find the default language id
		    $languageId = $this->getDefaultLanguageId($database);
			
			
			
		
		   
		    foreach ($products as $product) {
			
			          $productName = $this->language->get('not_data');
			          $productImage = $this->language->get('not_image');
			          $productModel = $this->language->get('not_model'); 
					  $productPrice = '0.00';
					  $productQuantity = '0';
					  $productStatus = '1';
			          $productManufacturer = $this->language->get('not_data'); 
					  $productDescription = $this->language->get('not_data');
					  
					  
			
			          if (!empty($product['name']) && ($product['name'] !==0)){
					 
					     $productName = $product['name'];
					  }
			         
					
			          if (!empty($product['image']) && ($product['image'] !== 0)){
					      $productImage = $product['image'];
						
					  }
					  
					  if (!empty($product['model']) && ($product['model'] !==0)){
					      $productModel = $product['model'];
					      
					  }
					  
					  if (!empty($product['price']) && ($product['price'] !==0)){
					     $productPrice = $product['price'];
					  }
					  
					  if (!empty($product['guantity']) && ($product['guantity'] !==0)){
					     $productQuantity = $product['guantity'];
					  }
					  
					  if (!empty($product['status']) && ($product['status'] !==0) ){
					      $productStatus = $product['status'];
					  
					  }
					  
					  if (!empty($product['manufacturer']) && ($product['manufacturer'] !==0)){
					     $productManufacturer = $product['manufacturer'];
					  }
					  
					  if (!empty($product['description']) && ($product['description'] !==0)){
					     $productDescription = $product['description'];
					  
					  }
					  
					    
			          
			   
			         if (!empty($product['categories']) && ($product['categories'] !==0)){
					 
					     $productCategories = $product['categories'];
					  
					     $sql = "SELECT `name`,`category_id` FROM `".DB_PREFIX."category_description`";
						 
					     $result = $database->query($sql);
						 
	                    $name = array();
						$id = array();
						
						
		                if ($result->rows) {
			                foreach ($result->rows as $row) {
							
				                    $name[] = strtolower($row['name']);
									$id[strtolower($row['name'])] = $row['category_id'];
									
							}
				                    if (!in_array(strtolower($productCategories), $name )) {
										
										$temp_max = "SELECT `category_id` FROM `".DB_PREFIX."category`";
										
										$max = $database->query($temp_max);
		                               
									    $num = 0;
										
                                        foreach ($max->rows as $value){
										
										         if ($num < $value['category_id']){
												 
												     $num = $value['category_id'];
												 }
										}
										
										$num = $num+1;
										
										
										
									    $inserteCategory = "INSERT INTO`".DB_PREFIX."category` (`category_id`, `image`, `parent_id` , `top`, `column`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES ('$num','','0','1','0','0','0',NOW(),NOW())";
				
										$database->query($inserteCategory);
										
										$inserteCategoryDescription = "INSERT INTO `".DB_PREFIX."category_description` (`category_id`, `language_id`, `name` ,`description`, `meta_description`, `meta_keyword`) VALUES ('$num','$languageId','$productCategories','','','')";
										
										$database->query($inserteCategoryDescription);
										
										$categoryId = $num;
										
										
					                    goto product;
				                    } 
									else if (in_array(strtolower($productCategories), $name )) {
									
									        $categoryId = $id[strtolower($productCategories)];
					                        
				                            goto product;
									}
			                    }
		                    }
					  product:

                      //find manufacturer and id
						  
					  $sql9 = "SELECT `manufacturer_id`,`name` FROM `".DB_PREFIX."manufacturer`";
					  $manuf_temp = $database->query($sql9);
								  
					  $manuf_name = array();
					  $manuf_id = array();
						  
							
				     //find all manufacturer and them id
						  
				     if ($manuf_temp->rows) {
						  
						
							  foreach ($manuf_temp->rows as $value_manuf){
									  
									   $manuf_name[] = strtolower($value_manuf['name']);
									   $manuf_id[strtolower($value_manuf['name'])] = $value_manuf['manufacturer_id'];   
							 }
					 }
					      
					  
					      $sql2 = "SELECT `sku`,`product_id` FROM `".DB_PREFIX."product`";
						 
					      $result2 = $database->query($sql2);
						 
	                      $sku = array();
						  $productId = array();
						
						
		              if ($result2->rows) {
						
		
			                foreach ($result2->rows as $res) {
							
				                    $sku[] = $res['sku'];
									$productId[$res['sku']] = $res['product_id'];
									
							}
												  
				      }
					  
			          if (!empty($product['sku']) && ($product['sku'] !==0) ){
					  
					      $productSku = $product['sku'];
						  
					
						    if (in_array($productSku, $sku )) {
							 
					          
			                   
					            $sql3 = "SELECT `manufacturer_id` FROM `".DB_PREFIX."product` WHERE `sku` = '".$productSku."'";
					            $manufId = $database->query($sql3);
								
								
								$sql4 = "UPDATE `".DB_PREFIX."manufacturer` SET `name` = '".$productManufacturer."' WHERE `manufacturer_id` = '".$manufId->row['manufacturer_id']."'";
			                    $database->query($sql4); 
								
								$sql5  = "UPDATE `".DB_PREFIX."product` SET `quantity` = '".$productQuantity."',`model`='".$productModel."',";
			                    $sql5 .= "`manufacturer_id` = '".$manufId->row['manufacturer_id']."',`image` = '".$productImage."',`price`='".$productPrice."',`date_added`= NOW(),`date_modified` = NOW(),`status` = '".$productStatus."',`date_available`= NOW()";
			                    $sql5 .= "WHERE `sku` = '".$productSku."'";
								$database->query($sql5);
								
							    $sql6 = "SELECT `product_id` FROM `".DB_PREFIX."product` WHERE `sku` = '".$productSku."'";
					            $prodfId = $database->query($sql6);	
	
			                    $sql7 = "UPDATE `".DB_PREFIX."product_description` SET `name`='".$productName."',`description`= '".$productDescription."' WHERE `product_id` = '".$prodfId->row['product_id']."'";
			                    
			                    $database->query($sql7);
								
								$sql8 = "UPDATE `".DB_PREFIX."product_to_category` SET `category_id` = '".$categoryId."' WHERE `product_id` = '".$productId[$productSku]."'";
			                    $database->query($sql8); 
								
					  

                            }
                            else if (!in_array($productSku, $sku )) {
							
						
									  //check on existence manufacturer
									  if (in_array(strtolower($productManufacturer), $manuf_name)){
									  
									      $productManufacturerId = $manuf_id[strtolower($productManufacturer)];
									  }
									  else if (!in_array(strtolower($productManufacturer), $manuf_name)){               //Производитель существует ?    
								                                                                            //Нет
								              $db_trans = "INSERT INTO `".DB_PREFIX."manufacturer` (`name`,`sort_order`) VALUES ('$productManufacturer', '0')";
                                              $database->query($db_trans);
                                           
                                              $db_trans2 = "SELECT `manufacturer_id` FROM `".DB_PREFIX."manufacturer` WHERE `name` = '$productManufacturer'";										   
						                      $resultManufId = $database->query($db_trans2);
											  $productManufacturerId = $resultManufId->row['manufacturer_id'];
									  }
									  
									//add the goods in the table product 
									$sql10 = "INSERT INTO `".DB_PREFIX."product` (`quantity`, `model`, `manufacturer_id`,`image`,";
                                    $sql10 .= "`price`, `date_added`, `date_modified`, `status`, `sku`,`upc`,`ean`,`jan`,`isbn`,`mpn`,`stock_status_id`,`location`,";
									$sql10 .= "`tax_class_id`,`date_available`)";									
							        $sql10 .="VALUES ('$productQuantity', '$productModel', '$productManufacturerId', '$productImage',";
                                    $sql10 .="'$productPrice', NOW(), NOW(), '$productStatus', '$productSku', '','','','','','0','',";
									$sql10 .="'0',NOW())";									
							        $database->query($sql10);
	
							
							        //receive id added goods
									$tempProductId = $database->getLastId();
								
								
								    //add description added goods
			                        $sql14 = "INSERT INTO `".DB_PREFIX."product_description`  (`name`, `description`, `product_id`, `language_id`,`meta_description`, `meta_keyword`,`tag`)";
			                        $sql14 .="VALUES ('$productName', '$productDescription', '".$tempProductId."', '$languageId', '', '', '')";
								    $database->query($sql14);
								
								    //connect a category with the goods
								    $sql15 = "INSERT INTO `".DB_PREFIX."product_to_category` (`category_id`, `product_id`) VALUES ('$categoryId', '".$tempProductId."')";
			                        $database->query($sql15);

                                    //to place goods in main shop
                                    $sql16 = "INSERT INTO `".DB_PREFIX."product_to_store` (`product_id`, `store_id`) VALUES ('".$tempProductId."', '0' )";
			                        $database->query($sql16);
									
									//check existance categories in the main shop
									$sql17 = "SELECT `category_id` FROM `".DB_PREFIX."category_to_store` WHERE `category_id` = '".$categoryId."'";
					                $categoryDefault = $database->query($sql17);
									
									if (!$categoryDefault->row){
									
									//to place category in the main shop
									$sql18 = "INSERT INTO `".DB_PREFIX."category_to_store` (`category_id`, `store_id`) VALUES ('$categoryId', '0' )";
			                        $database->query($sql18);
									
									}
									
                            }							
						}  
					    else
						{
						              
								  
			                 
							 		  //check existance manufacturer
									  if (in_array(strtolower($productManufacturer), $manuf_name)){
									  
									      $productManufacturerId = $manuf_id[strtolower($productManufacturer)];
									  }
									  else if (!in_array(strtolower($productManufacturer), $manuf_name)){               //Is manufacturer exists?    
								                                                                            //No
								              $db_trans3 = "INSERT INTO `".DB_PREFIX."manufacturer` (`name`, `sort_order`,`image`) VALUES ('$productManufacturer','0','')";
                                              $database->query($db_trans3);
                                           
                                              $db_trans4 = "SELECT `manufacturer_id` FROM `".DB_PREFIX."manufacturer` WHERE `name` = '$productManufacturer'";										   
						                      $resultManufId = $database->query($db_trans4);
											  $productManufacturerId = $resultManufId->row['manufacturer_id'];
									  }
									  
									  $rand = mt_rand(100000,999999);
									  
									//Add product into table 'product' 
									$sql19 = "INSERT INTO `".DB_PREFIX."product` (`quantity`, `model`, `manufacturer_id`,`image`,";
                                    $sql19 .= "`price`, `date_added`, `date_modified`, `status`, `sku`,`upc`,`ean`,`jan`,`isbn`,`mpn`,`stock_status_id`,`location`,";
									$sql19 .= "`tax_class_id`,`date_available`)";									
							        $sql19 .="VALUES ('$productQuantity', '$productModel', '$productManufacturerId', '$productImage',";
                                    $sql19 .="'$productPrice', NOW(), NOW(), '$productStatus', '$rand', '','','','','','0','',";
									$sql19 .="'0',NOW())";									
							        $database->query($sql19);
	
							
							        //get up id have been product
									$tempProductId2 = $database->getLastId();
								
								    //add description added goods
						            $sql20 = "INSERT INTO `".DB_PREFIX."product_description`  (`name`, `description`, `product_id`, `language_id`,`meta_description`, `meta_keyword`,`tag`)";
			                        $sql20 .="VALUES ('$productName', '$productDescription', '".$tempProductId2."', '$languageId', 'Not', 'Not', 'Not')";
								    $database->query($sql20);
									
							
								    //linked category with product
								    $sql21 = "INSERT INTO `".DB_PREFIX."product_to_category` (`category_id`, `product_id`) VALUES ('$categoryId', '".$tempProductId2."')";
			                        $database->query($sql21);

                                    //added product in main shop
                                    $sql22 = "INSERT INTO `".DB_PREFIX."product_to_store` (`product_id`, `store_id`) VALUES ('".$tempProductId2."', '0' )";
			                        $database->query($sql22);
									
									//Проверяем существует ли категория в основном магазине
									$sql23 = "SELECT `category_id` FROM `".DB_PREFIX."category_to_store` WHERE `category_id` = '".$categoryId."'";
					                $categoryDefault2 = $database->query($sql23);
									
									if (!$categoryDefault2->row){
									
									//added category into main shop
									$sql24 = "INSERT INTO `".DB_PREFIX."category_to_store` (`category_id`, `store_id`) VALUES ('$categoryId', '0' )";
			                        $database->query($sql24);
									
									}
			            }	
                }					  
			 
			 return TRUE;
		    
		}
		
	


	function validateHeading( &$data, &$expected ) {
	
	    $valid = FALSE;

		
		if (!stristr($data[0],$this->separator[$this->value['separator_import']])){  
		    error_log(date('Y-m-d H:i:s - ', time()).$this->language->get( 'error_separator_import' )."\n",3,DIR_LOGS."error.log");
			
			
			return $valid;
		
		}
		
		
		$heading = array();
		$temp = explode($this->separator[$this->value['separator_import']], $data[0]);
		$k = count($temp);
		
		$i = 0;
		for ($j=0; $j < $k; $j+=1) {
			$heading[] = strtolower(trim($temp[$j]));
		}
		
		$valid = TRUE;
		for ($i=0; $i < count($expected); $i+=1) {
			if (!isset($heading[$i])) {
				$valid = FALSE;
				break;
			}
			
			if (!in_array(strtolower($expected[$i]), $heading)) {
				$valid = FALSE;
				break;
			}
		}
		return $valid;
	}


    protected function expectedPriceHeading() {
	
	    $out = array();
		$control = array();
		$i=0;
		$ok = false;
	
	    foreach($this->settings as $index => $checked){
		
		        if (($checked=='true') && (strpos($index, "_export") == false)){
				
                    $out[$i] = strtolower($this->value[$index]);
				  
				  	if (in_array($out[$i], $control)){
				
				        error_log(date('Y-m-d H:i:s - ', time()).$this->language->get( 'error_name_field' )."\n",3,DIR_LOGS."error.log");
						return false;
						break;
				    }
					
					if ($out[$i] !== $this->language->get('not_data'))
					{
					   $ok = true;
					}
				    
					$control[$i] = strtolower($this->value[$index]);
					$i++;
	            }
			
		}
		
		if ($ok)
		{
		   return $out;
		}
	    else
		{
		   error_log(date('Y-m-d H:i:s - ', time()).$this->language->get('error_select_field')."\n",3,DIR_LOGS."error.log");
		   return false;
		}
	
	}



	function validatePrice( &$reader )
	{
		$expectedPriceHeading = $this->expectedPriceHeading();
		$data = explode("\r\n", $reader->getContents());
		return $this->validateHeading( $data, $expectedPriceHeading );
	}





	function validateUpload( &$reader )
	{

		$extentions = array(".xls",".csv");
		$status = true;
		
		if(!in_array(strrchr($_FILES['upload']['name'], "."),$extentions)){
				error_log(date('Y-m-d H:i:s - ', time()).$this->language->get('error_incorrect_type_file')."\n",3,DIR_LOGS."error.log");
				$status =  FALSE;
				
	    }
		
		if (!$this->validatePrice( $reader )) {
			error_log(date('Y-m-d H:i:s - ', time()).$this->language->get('error_sheet_count')."\n",3,DIR_LOGS."error.log");
			$status =  FALSE;
		}

		return $status;
	}


	function clearCache() {
		$this->cache->delete('*');
	}


	function upload( $filename, $value, $settings ) {
		// we use our own error handler
		global $registry;
		$registry = $this->registry;
		$this->value = $value;
        $this->settings = $settings;		
		set_error_handler('error_handler_for_export',E_ALL);
		register_shutdown_function('fatal_error_shutdown_handler_for_export');

		try {
			$database =& $this->db;
			$this->session->data['export_nochange'] = 1;
			
			$cwd = getcwd();
			chdir( DIR_SYSTEM.'CFile' );
			require_once( 'Classes/CFileHelper.php' );
			chdir( $cwd );
			
			
			$reader = CFileHelper::get($filename); 

			// read the various worksheets and load them to the database
			$ok = $this->validateUpload( $reader );
			
			if (!$ok) {
				return FALSE;
			}
			$this->clearCache();
			$this->session->data['export_nochange'] = 0;
			$ok = $this->uploadPrice( $reader, $database );
			
			if (!$ok) {
				return FALSE;
			}
			return $ok;
		} catch (Exception $e) {
			$errstr = $e->getMessage();
			$errline = $e->getLine();
			$errfile = $e->getFile();
			$errno = $e->getCode();
			$this->session->data['export_error'] = array( 'errstr'=>$errstr, 'errno'=>$errno, 'errfile'=>$errfile, 'errline'=>$errline );
			if ($this->config->get('config_error_log')) {
				$this->log->write('PHP ' . get_class($e) . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);
			}
			return FALSE;
		}
	}
	


    //this function makes validate
	function validateLoad()
	{

		$status = true;
		
		if (!$this->expectedColumn()) {
			error_log(date('Y-m-d H:i:s - ', time()).$this->language->get('error_sheet_count')."\n",3,DIR_LOGS."error.log");
			$status =  FALSE;
		}

		return $status;
	}
	
	
	//this function makes expected column
	protected function expectedColumn() {
	
	    $out = array();
		$control = array();
		$ok = false;
		$i=0;
	
	    foreach($this->settings as $index => $checked){
		
		        if (($checked=='true') && (strpos($index, "_export") !== false)){
				
                    $out[$i] = strtolower($this->value[$index]);
				  
				  	if (in_array($out[$i], $control) && ($out[$i] !== $this->language->get('not_data'))){
				
				        error_log(date('Y-m-d H:i:s - ', time()).$this->language->get( 'error_name_field' )."\n",3,DIR_LOGS."error.log");
						return false;
						break;
				    }
				    if ($out[$i] !== $this->language->get('not_data'))
					{
					   $ok = true;
					}
					
					$control[$i] = strtolower($this->value[$index]);
					$i++;
	            }
			
		}
		
		$i = 0;
		$number = array();
		$temp = array();
		$ok = false;
		
		
	    foreach($this->value as $values => $value){

		        if (strpos($values, "_number") !== false){
					
				    $number[$i] = $this->value[$values];

				  	if (in_array($number[$i], $temp) && ($number[$i] !== $this->language->get('not_number'))){
				
				        error_log(date('Y-m-d H:i:s - ', time()).$this->language->get( 'error_number_field' )."\n",3,DIR_LOGS."error.log");
						return false;
						break;
				    }
				    if ($number[$i] !== $this->language->get('not_number'))
					{
					   $ok = true;
					}
					
					$temp[$i] = $this->value[$values];
					$i++;
	            }
			
		}
		
		
		if ($ok)
		{
		   return $out;
		}
	    else
		{
		   error_log(date('Y-m-d H:i:s - ', time()).$this->language->get('error_select_field')."\n",3,DIR_LOGS."error.log");
		   return false;
		}
		
	}

	
	protected function writeRow( &$csv, $row/*1-based*/, $col/*0-based*/, $val){
		
		              $csv[$row][$col] = $val;
		
		
	}


	protected function getCategories( &$database, $languageId ) {
		$query  = "SELECT c.* , cd.*, ua.keyword FROM `".DB_PREFIX."category` c ";
		$query .= "INNER JOIN `".DB_PREFIX."category_description` cd ON cd.category_id = c.category_id ";
		$query .= " AND cd.language_id=$languageId ";
		$query .= "LEFT JOIN `".DB_PREFIX."url_alias` ua ON ua.query=CONCAT('category_id=',c.category_id) ";
		$query .= "ORDER BY c.`parent_id`, `sort_order`, c.`category_id`;";
		$result = $database->query( $query );
		return $result->rows;
	}
	


	protected function populateCategoriesWorksheet(&$database, $languageId) {
		// Set the column widths
		$j = 0;
		$step = array( '1' => $this->value['image_number'],
		               '2' => $this->value['name_number'],
		               '3' => $this->value['model_number'], 
		               '4' => $this->value['price_number'],
					   '5' => $this->value['guantity_number'],
					   '6' => $this->value['statusenabled_number'],
					   '7' => $this->value['sku_number'],
					   '8' => $this->value['manufacturer_number'],
					   '9' => $this->value['description_number'],
					   '10' => $this->value['categories_number'],
		              );
					 
		$number = array(
		                 '1' => $this->settings['image_export'],
		                 '2' => $this->settings['name_export'],
		                 '3' => $this->settings['model_export'], 
		                 '4' => $this->settings['price_export'],
					     '5' => $this->settings['guantity_export'],
					     '6' => $this->settings['statusenabled_export'],
					     '7' => $this->settings['sku_export'],
					     '8' => $this->settings['manufacturer_export'],
					     '9' => $this->settings['description_export'],
					     '10' => $this->settings['categories_export'],
		
		                );
						
		$csv = array();
						
		for ($counter = 1; $counter <= 10; $counter++)
		{
		    if (!is_numeric($step[$counter]))
			{
			   for ($m = 1; $m <= 10; $m++)
			   {
			       if (!in_array($m, $step))
				   {
			           $step[$counter] = $m;
				   }
			   }
			}
		
		
		}
		
		$step = array_flip($step);
		
		
		// The heading row
		$i = 0;
		$j = 0;
		
		
		for ($counter2 = 1; $counter2 <= 10; $counter2++)
		{
		     switch ($step[$counter2])
			 {

		           case 1:
				          
	                          if ($number[$step[$counter2]] == 'true')
		                      {
		                          if (strtolower($this->value['image_export']) !== $this->language->get('not_data'))
		                          {
		                              $this->writeRow( $csv, $i, $j++, $this->value['image_export']);  
		                          }
		                      }
						 
		           break;
		
		
		           case 2:
				          
		                      if ($number[$step[$counter2]] == 'true')
		                      {
		                          if (strtolower($this->value['name_export']) !== $this->language->get('not_data'))
		                          {
		   
		                              $this->writeRow( $csv, $i, $j++, $this->value['name_export']);
		                          }
		                      }
						  
		           break;
		
		
		
		           case 3:
				         
		                      if ($number[$step[$counter2]] == 'true')
		                      {
		                          if (strtolower($this->value['model_export']) !== $this->language->get('not_data'))
		                          {
		                              $this->writeRow( $csv, $i, $j++, $this->value['model_export']);
		                          }
		                      }
						  
	               break;
		
		
		
		           case 4:
				       
		                      if ($number[$step[$counter2]] == 'true')
		                      {
		                          if (strtolower($this->value['price_export']) !== $this->language->get('not_data'))
		                          {
		                              $this->writeRow( $csv, $i, $j++, $this->value['price_export']);
		                          }
		                      }
						  
		           break;
		
		
		
		           case 5:
				          
		                      if ($number[$step[$counter2]] == 'true')
		                      {
		                          if (strtolower($this->value['guantity_export']) !== $this->language->get('not_data'))
		                          {
		                              $this->writeRow( $csv, $i, $j++, $this->value['guantity_export']);
		                          }
		                       }
						 
		           break;
		
		
		
		           case 6:
				        
		                      if ($number[$step[$counter2]] == 'true')
		                      {
		                          if (strtolower($this->value['statusenabled_export']) !== $this->language->get('not_data'))
		                          {
		                              $this->writeRow( $csv, $i, $j++, $this->value['statusenabled_export']);
		                          }
		                      }
						 
	               break;
		
		
		
		           case 7:
				          
	                          if ($number[$step[$counter2]] == 'true')
		                      {
		                          if (strtolower($this->value['sku_export']) !== $this->language->get('not_data'))
		                          {
		                              $this->writeRow( $csv, $i, $j++, $this->value['sku_export']); 
		                          }
		                       }
						   
		           break;
		
	
		           case 8:
				        
	                          if ($number[$step[$counter2]] == 'true')
		                      {
		                          if (strtolower($this->value['manufacturer_export']) !== $this->language->get('not_data'))
		                          {
		                              $this->writeRow( $csv, $i, $j++, $this->value['manufacturer_export']);
		                          }
		                       }
						 
		           break;
		
		
		
		           case 9:
				          
	                          if ($number[$step[$counter2]] == 'true')
		                      {
		                          if (strtolower($this->value['description_export']) !== $this->language->get('not_data'))
		                          {
		                              $this->writeRow( $csv, $i, $j++, $this->value['description_export']);
		                          }
		                       }
						  
		           break;
	
	
		           case 10:
				            
		                         if ($number[$step[$counter2]] == 'true')
		                         {
		                             if (strtolower($this->value['categories_export']) !== $this->language->get('not_data'))
		                             {
		                                 $this->writeRow( $csv, $i, $j++, $this->value['categories_export']);
                                     }
		                         }
							 
		           break;
				   default:
				   ;
		
		     }
		}
		
		
		// The actual categories data
		$i += 1;
		$j = 0;
		
		$categories = $this->getCategories( $database, $languageId );
		$products = $this->getProducts( $database, $languageId );
		foreach ($products as $row) {
			
			
			for ($counter3 = 1; $counter3 <= 10; $counter3++)
			{
			     switch ($step[$counter3])
				 {

				       case 1:
					           
			                       if ($number[$step[$counter3]] == 'true')                       //image
		                           {
		                               if (strtolower($this->value['image_export']) !== $this->language->get('not_data'))
		                               {
		                                   $this->writeRow( $csv, $i, $j++, $row['image']); 
		                               }
		                           }
							   
					   break;
						
					   case 2:
					         
			                       if ($number[$step[$counter3]] == 'true')                        //name
		                           {
		                               if (strtolower($this->value['name_export']) !== $this->language->get('not_data'))
		                               {
				                           $this->writeRow( $csv, $i, $j++, html_entity_decode($row['name'],ENT_QUOTES,'UTF-8'));
				                       }
			                       }
							  
			            break;
						
						case 3:
						        								
			                        if ($number[$step[$counter3]] == 'true')                        //model
		                            {
		                                if (strtolower($this->value['model_export']) !== $this->language->get('not_data'))
		                                {
				                            $this->writeRow( $csv, $i, $j++,  $row['model']);
				                        }
			                        }
								
						break;
						
						case 4:
						       
						            if ($number[$step[$counter3]] == 'true')                         //price
		                            {
		                                if (strtolower($this->value['price_export']) !== $this->language->get('not_data'))
		                                {
			                                $this->writeRow( $csv, $i, $j++, $row['price']);
			                            }
			                        }
								
						break;
						
						case 5:
						        
			                        if ($number[$step[$counter3]] == 'true')                      //quantity
		                            {
		                                if (strtolower($this->value['guantity_export']) !== $this->language->get('not_data'))
		                                {
				                            $this->writeRow( $csv, $i, $j++, $row['quantity']);
				                        }
			                        }
								
						break;
						
						case 6:
						     
			                       if ($number[$step[$counter3]] == 'true')                 //status
		                           {
		                               if (strtolower($this->value['statusenabled_export']) !== $this->language->get('not_data'))
		                               {
			                               $this->writeRow( $csv, $i, $j++, ($row['status']==0) ? "false" : "true");
			                           }
			                       }
							    
						break;
						
						case 7:
						      
			                        if ($number[$step[$counter3]] == 'true')                           //article
		                            {
		                                if (strtolower($this->value['sku_export']) !== $this->language->get('not_data'))
		                                {
			                                $this->writeRow( $csv, $i, $j++, $row['sku']);
			                            }
			                        }
							  
						break;
						
						case 8:
						      
			                        if ($number[$step[$counter3]] == 'true')                  //manufacturer
		                            {
		                                if (strtolower($this->value['manufacturer_export']) !== $this->language->get('not_data'))
		                                {
			                                $this->writeRow( $csv, $i, $j++, $row['manufacturer']);
			                            }
			                        }
								 
						break;
						
						case 9:
						       
			                        if ($number[$step[$counter3]] == 'true')                   //description
		                            {
		                                if (strtolower($this->value['description_export']) !== $this->language->get('not_data'))
		                                {
			                                $this->writeRow( $csv, $i, $j++, html_entity_decode($row['description'],ENT_QUOTES,'UTF-8'));
			                            }
			                        }
								
						break;
						
						case 10:
						       
			                         if ($number[$step[$counter3]] == 'true')                    //categories
		                             {
		                                 if (strtolower($this->value['categories_export']) !== $this->language->get('not_data'))
		                                 {
				
				                             $num = 0;
				                             $storeIdList = '';
					                         $id = explode("," , $row['categories']);
					                         foreach ($categories as $result)
					                         {
					                                if (!empty($id[$num]))
							                        {
							                            if ($result['category_id'] == $id[$num])
								                        {
								   
								                             $storeIdList .= ($storeIdList=='') ? $result['name'] : ','.$result['name'];
								                             $num++;   
								                        }
							     
							                         }
					        
					                         }

			                                 $this->writeRow( $csv, $i, $j++, $storeIdList);
				   
				                         }
		                             
								  }
							     default:
								 ;
		                  }
		    }	
			$i += 1;
			$j = 0;
		}
		
		$csv_implode = array();
		
		$r = 0;
		
		foreach($csv as $stroks)
		{
			

		       $csv_implode[$r] =  implode($this->separator[$this->value['separator_export']], $stroks);
               $r++;
		}

		$csv_out = implode("\r\n", $csv_implode);
		
		return $csv_out;
		
	}


	protected function getProducts( &$database, $languageId ) {
		$query  = "SELECT ";
		$query .= "  p.product_id,";
		$query .= "  pd.name,";
		$query .= "  GROUP_CONCAT( DISTINCT CAST(pc.category_id AS CHAR(11)) SEPARATOR \",\" ) AS categories,";
		$query .= "  p.sku,";
		$query .= "  p.upc,";
		$query .= "  p.ean,";
		$query .= "  p.jan,";
		$query .= "  p.isbn,";
		$query .= "  p.mpn,";
		$query .= "  p.location,";
		$query .= "  p.quantity,";
		$query .= "  p.model,";
		$query .= "  m.name AS manufacturer,";
		$query .= "  p.image,";
		$query .= "  p.shipping,";
		$query .= "  p.price,";
		$query .= "  p.points,";
		$query .= "  p.date_added,";
		$query .= "  p.date_modified,";
		$query .= "  p.date_available,";
		$query .= "  p.weight,";
		$query .= "  wc.unit,";
		$query .= "  p.length,";
		$query .= "  p.width,";
		$query .= "  p.height,";
		$query .= "  p.status,";
		$query .= "  p.tax_class_id,";
		$query .= "  p.viewed,";
		$query .= "  p.sort_order,";
		$query .= "  pd.language_id,";
		$query .= "  ua.keyword,";
		$query .= "  pd.description, ";
		$query .= "  pd.meta_description, ";
		$query .= "  pd.meta_keyword, ";
		$query .= "  pd.tag, ";
		$query .= "  p.stock_status_id, ";
		$query .= "  mc.unit AS length_unit, ";
		$query .= "  p.subtract, ";
		$query .= "  p.minimum, ";
		$query .= "  GROUP_CONCAT( DISTINCT CAST(pr.related_id AS CHAR(11)) SEPARATOR \",\" ) AS related ";
		$query .= "FROM `".DB_PREFIX."product` p ";
		$query .= "LEFT JOIN `".DB_PREFIX."product_description` pd ON p.product_id=pd.product_id ";
		$query .= "  AND pd.language_id=$languageId ";
		$query .= "LEFT JOIN `".DB_PREFIX."product_to_category` pc ON p.product_id=pc.product_id ";
		$query .= "LEFT JOIN `".DB_PREFIX."url_alias` ua ON ua.query=CONCAT('product_id=',p.product_id) ";
		$query .= "LEFT JOIN `".DB_PREFIX."manufacturer` m ON m.manufacturer_id = p.manufacturer_id ";
		$query .= "LEFT JOIN `".DB_PREFIX."weight_class_description` wc ON wc.weight_class_id = p.weight_class_id ";
		$query .= "  AND wc.language_id=$languageId ";
		$query .= "LEFT JOIN `".DB_PREFIX."length_class_description` mc ON mc.length_class_id=p.length_class_id ";
		$query .= "  AND mc.language_id=$languageId ";
		$query .= "LEFT JOIN `".DB_PREFIX."product_related` pr ON pr.product_id=p.product_id ";
		$query .= "GROUP BY p.product_id ";
		$query .= "ORDER BY p.product_id, pc.category_id; ";
		$result = $database->query( $query );
		return $result->rows;
	}









	protected function clearSpreadsheetCache() {
		$files = glob(DIR_CACHE . 'Spreadsheet_Excel_Writer' . '*');
		
		if ($files) {
			foreach ($files as $file) {
				if (file_exists($file)) {
					@unlink($file);
					clearstatcache();
				}
			}
		}
	}

//upload from server
function download($value, $settings) {
        $this->value = $value;
		$this->settings = $settings;
		// we use our own error handler
		global $registry;
		$registry = $this->registry;
		set_error_handler('error_handler_for_export',E_ERROR);
		register_shutdown_function('fatal_error_shutdown_handler_for_export');

		try {
		
		    // call expected columns
		    $ok = $this->validateLoad();
			
			if (!$ok)
			{
			    return false;
			}
		     
			// set appropriate timeout limit
			set_time_limit( 1800 );

			$database =& $this->db;
			$languageId = $this->getDefaultLanguageId($database);

			// creating the worksheet
			$csv = $this->populateCategoriesWorksheet($database, $languageId);
			$replay_csv =  chr(0xEF) . chr(0xBB) . chr(0xBF) . $csv;
			
            // redirect output to client browser
            ob_end_clean();
			header('Content-Type:text/csv');
			header('Content-Disposition: attachment;filename="export_price.csv"');
			$out = fopen('php://output', 'w');
			fwrite($out, $replay_csv);
			fclose($out);
		
              
			// Clear the spreadsheet caches
			$this->clearSpreadsheetCache();
			exit;

		} catch (Exception $e) {
			$errstr = $e->getMessage();
			$errline = $e->getLine();
			$errfile = $e->getFile();
			$errno = $e->getCode();
			$this->session->data['export_error'] = array( 'errstr'=>$errstr, 'errno'=>$errno, 'errfile'=>$errfile, 'errline'=>$errline );
			if ($this->config->get('config_error_log')) {
				$this->log->write('PHP ' . get_class($e) . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);
			}
			return false;
		}
		return true;
	}
















  }
?>