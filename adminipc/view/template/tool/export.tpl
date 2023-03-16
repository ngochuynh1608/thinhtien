<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="container-fluid">
            <?php if ($error_warning) { ?>
                     <div class="alert alert-warning">
					      <i class="fa fa-exclamation-circle"></i>
			              <?php echo $error_warning; ?>
			              <button type="button" class="close" data-dismiss="alert">×</button>
			         </div>
            <?php } ?>
            <?php if ($success) { ?>
                    <div class="alert alert-success">
			             <i class="fa fa-check-circle"></i>
			             <?php echo $success; ?>
			             <button type="button" class="close" data-dismiss="alert">×</button>
			        </div>
            <?php } ?>
   </div>
    <div class="page-header">
	    <div class = "container-fluid">
		    <div class = "pull-right">
                 <button class = "btn btn-primary" onclick="upload();" type="button"><?php echo $button_import; ?></button>
				 <button class = "btn btn-primary" onclick="load();" type="button"><?php echo $button_export; ?></button>
            </div>
			<h1><?php echo $heading_title; ?></h1>
		</div>
	</div>
    <div class="container-fluid">
	    <div class = "panel panel-default">
		    <div class = "panel-heading">
			    <h3 class = "panel-title"><?php echo $entry_description; ?></h3>
			</div>
			<div class = "panel-body">
                 <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                      <table class="form">
                           <tr>
                               <td width="25%"><?php echo $entry_restore; ?></td>
                               <td><input type="file" name="upload" id="upload" /></td>
                           </tr>
                      </table>
                 </form>
            </div>
	    </div>
	</div>
	<div class="page-header">
	    <div class = "container-fluid">
		    <div class = "pull-right">
                <button class = "btn btn-primary" onclick="EnterSetting();" type="button"><?php echo $button_enter; ?></button>
            </div>
			<h1><?php echo $setting_import; ?></h1>
		</div>
	</div>
	
     <div class="container-fluid">
	    <div class = "panel panel-default">
		    <div class = "panel-heading">
			    <h3 class = "panel-title"><?php echo $import_title; ?></h3>
			</div>
		<div class = "panel-body">	
                 <form action="<#>" method="post" id="setting_import" name = "form_settings">
                     <table class="table table-bordered table-hover">
                          <tr>
                               <td class = "text-left" width="25%"><?php echo $image_field; ?></td>
                               <td class = "text-left"><input type="text" size ="30"  class = "settings_value" name="image" value = "<?php echo $image ?>"/></td>
			                   <td class = "text-left" width = "55%"><input type="checkbox" class="checked_setting" name="image" <?php if ($image_checked){ ?> checked = "checked" <?php } ?>/></td>
                         </tr>
		                 <tr>
                               <td class = "text-left" width="25%"><?php echo $name_field; ?></td>
                               <td class = "text-left"><input type="text"  size ="30"  class = "settings_value" name="name" value = "<?php echo $name ?>"/></td>
			                   <td class = "text-left" width = "55%"><input type="checkbox" class="checked_setting" name="name" <?php if ($name_checked){ ?> checked = "checked" <?php } ?>/></td>
                         </tr>
		                 <tr>
                                <td class = "text-left" width="25%"><?php echo $model_field; ?></td>
                                <td class = "text-left"><input type="text"  size ="30"  class = "settings_value" name="model" value = "<?php echo $model ?>"/></td>
			                    <td class = "text-left" width = "55%"><input type="checkbox" class="checked_setting" name="model" <?php if ($model_checked){ ?> checked = "checked" <?php } ?>/></td>
                         </tr>
		                 <tr>
                                <td class = "text-left" width="25%"><?php echo $price_field; ?></td>
                                <td class = "text-left"><input type="text"  size ="30"  class = "settings_value" name="price" value = "<?php echo $price ?>"/></td>
			                    <td class = "text-left" width = "55%"><input type="checkbox" class="checked_setting" name="price" <?php if ($price_checked){ ?> checked = "checked" <?php } ?>/></td>
                         </tr>
		                 <tr>
                                <td class = "text-left" width="25%"><?php echo $guantity_field; ?></td>
                                <td class = "text-left"><input type="text"  size ="30"  class = "settings_value" name="guantity" value = "<?php echo $guantity ?>"/></td>
			                    <td class = "text-left" width = "55%"><input type="checkbox" class="checked_setting" name="guantity" <?php if ($guantity_checked){ ?> checked = "checked" <?php } ?>/></td>
                         </tr> 
		                 <tr>
                                <td class = "text-left" width="25%"><?php echo $statusenabled_field; ?></td>
                                <td class = "text-left"><input type="text"  size ="30"  class = "settings_value" name="statusenabled" value = "<?php echo $statusenabled ?>"/></td>
			                    <td class = "text-left" width = "55%"><input type="checkbox" class="checked_setting" name="statusenabled" <?php if ($statusenabled_checked){ ?> checked = "checked" <?php } ?>/></td>
                         </tr> 
		                 <tr>
                                <td class = "text-left" width="25%"><?php echo $sku_field; ?></td>
                                <td class = "text-left"><input type="text"  size ="30"  class = "settings_value" name="sku" value = "<?php echo $sku ?>"/></td>
			                    <td class = "text-left" width = "55%"><input type="checkbox" class="checked_setting" name="sku" <?php if ($sku_checked){ ?> checked = "checked" <?php } ?>/></td>
                         </tr>
                         <tr>
                                <td class = "text-left" width="25%"><?php echo $manufacturer_field; ?></td>
                                <td class = "text-left"><input type="text"  size ="30"  class = "settings_value" name="manufacturer" value = "<?php echo $manufacturer ?>"/></td>
			                    <td class = "text-left" width = "55%"><input type="checkbox" class="checked_setting" name="manufacturer" <?php if ($manufacturer_checked){ ?> checked = "checked" <?php } ?>/></td>
                         </tr>
                         <tr>
                                <td class = "text-left" width="25%"><?php echo $description_field; ?></td>
                                <td class = "text-left"><input type="text"  size ="30" class = "settings_value" name="description" value = "<?php echo $description ?>"/></td>
			                    <td class = "text-left" width = "55%"><input type="checkbox" class="checked_setting" name="description" <?php if ($description_checked){ ?> checked = "checked" <?php } ?>/></td>
                         </tr> 
                         <tr>
                                <td class = "text-left" width="25%"><?php echo $categories_field; ?></td>
                                <td class = "text-left"><input type="text"  size ="30" class = "settings_value" name="categories"  value = "<?php echo $categories ?>"/></td>
			                    <td class = "text-left" width = "55%"><input type="checkbox" class="checked_setting" name = "categories" <?php if ($categories_checked){ ?> checked = "checked" <?php } ?> /></td>
                         </tr>
						 <tr>
                            <td class = "text-left" width="25%"><?php echo $row_size; ?></td>
                            <td class = "text-left" width="25%"><input type="text"  size ="10" class = "settings_value"  name="min_size" value = "<?php echo $min_size ?>"/>&nbsp; <?php echo $min_size_comment; ?></td>
		                    <td class = "text-left"><input type="text"  size ="10" class = "settings_value"  name="max_size" value = "<?php echo $max_size ?>"/>&nbsp; <?php echo $max_size_comment; ?></td>
                        </tr> 
                        <tr>
						     <td width = "15%"><?php echo $separator_import; ?></td>
							 <td>
							     <div class="col-sm-6" style = "padding-left: 0px !important">
                                      <select id="separator_import" class="form-control">
                                                  <option value = "0">:</option>
			                                      <option value = "1">;</option>
			                                      <option value = "2">#</option>
			                                      <option value = "3">*</option>
                                       </select>
                                 </div> 
							 </td>
                        </tr>						
	               </table>  
             </form>
		 </div>
	  </div>	
    </div>
	<div class="page-header">
	    <div class = "container-fluid">
		    <div class = "pull-right">
                <button class = "btn btn-primary" onclick="EnterSetting();" type="button"><?php echo $button_enter; ?></button>
            </div>
			<h1><?php echo $setting_export; ?></h1>
		</div>
	</div>
	<div class="container-fluid">
	    <div class = "panel panel-default">
		    <div class = "panel-heading">
			    <h3 class = "panel-title"><?php echo  $export_title; ?></h3>
			</div>
		<div class = "panel-body">	
		     <form action="<#>" method="post" id="setting_import" name = "form_settings">
			      <table class="table table-bordered table-hover">
                        <tr>
                             <td class="text-left"><?php echo $image_field; ?></td>
                             <td class = "text-left"><input type="text" size ="30"  class = "settings_value_export" name="image_export" value = "<?php echo $image_export ?>"/></td>
			                 <td class = "text-left"><input type="checkbox" class="checked_setting_export" name="image_export" <?php if ($image_checked_export){ ?> checked = "checked" <?php } ?>/></td>
		                </tr>
		                <tr>
                              <td class = "text-left"><?php echo $name_field; ?></td>
                              <td class = "text-left"><input type="text"  size ="30"  class = "settings_value_export" name="name_export" value = "<?php echo $name_export ?>"/></td>
			                  <td width = "55%"><input type="checkbox" class="checked_setting_export" name="name_export" <?php if ($name_checked_export){ ?> checked = "checked" <?php } ?>/></td>
                        </tr>
		                <tr>
                              <td class = "text-left"><?php echo $model_field; ?></td>
                              <td class = "text-left"><input type="text"  size ="30"  class = "settings_value_export" name="model_export" value = "<?php echo $model_export ?>"/></td>
			                  <td width = "55%"><input type="checkbox" class="checked_setting_export" name="model_export" <?php if ($model_checked_export){ ?> checked = "checked" <?php } ?>/></td>
                        </tr>
		                <tr>
                              <td class = "text-left"><?php echo $price_field; ?></td>
                              <td class = "text-left" ><input type="text"  size ="30"  class = "settings_value_export" name="price_export" value = "<?php echo $price_export ?>"/></td>
			                  <td width = "55%"><input type="checkbox" class="checked_setting_export" name="price_export" <?php if ($price_checked_export){ ?> checked = "checked" <?php } ?>/></td>
                        </tr>
		                <tr>
                              <td class = "text-left" ><?php echo $guantity_field; ?></td>
                              <td class = "text-left"><input type="text"  size ="30"  class = "settings_value_export" name="guantity_export" value = "<?php echo $guantity_export ?>"/></td>
			                  <td width = "55%"><input type="checkbox" class="checked_setting_export" name="guantity_export" <?php if ($guantity_checked_export){ ?> checked = "checked" <?php } ?>/></td>
                        </tr> 
		                <tr>
                              <td class = "text-left"><?php echo $statusenabled_field; ?></td>
                              <td class = "text-left"><input type="text"  size ="30"  class = "settings_value_export" name="statusenabled_export" value = "<?php echo $statusenabled_export ?>"/></td>
			                  <td width = "55%"><input type="checkbox" class="checked_setting_export" name="statusenabled_export" <?php if ($statusenabled_checked_export){ ?> checked = "checked" <?php } ?>/></td>
                        </tr> 
		                <tr>
                              <td class = "text-left"><?php echo $sku_field; ?></td>
                              <td class = "text-left"><input type="text"  size ="30"  class = "settings_value_export" name="sku_export" value = "<?php echo $sku_export ?>"/></td>
			                  <td width = "55%"><input type="checkbox" class="checked_setting_export" name="sku_export" <?php if ($sku_checked_export){ ?> checked = "checked" <?php } ?>/></td>
                        </tr>
                        <tr>
                              <td class = "text-left"><?php echo $manufacturer_field; ?></td>
                              <td class = "text-left"><input type="text"  size ="30"  class = "settings_value_export" name="manufacturer_export" value = "<?php echo $manufacturer_export ?>"/></td>
			                  <td width = "55%"><input type="checkbox" class="checked_setting_export" name="manufacturer_export" <?php if ($manufacturer_checked_export){ ?> checked = "checked" <?php } ?>/></td>
                        </tr>
                        <tr>
                              <td class = "text-left"><?php echo $description_field; ?></td>
                              <td class = "text-left"><input type="text"  size ="30" class = "settings_value_export" name="description_export" value = "<?php echo $description_export ?>"/></td>
			                  <td width = "55%"><input type="checkbox" class="checked_setting_export" name="description_export" <?php if ($description_checked_export){ ?> checked = "checked" <?php } ?>/></td>
                        </tr> 
                        <tr>
                              <td class = "text-left"><?php echo $categories_field; ?></td>
                              <td class = "text-left"><input type="text"  size ="30" class = "settings_value_export" name="categories_export"  value = "<?php echo $categories_export ?>"/></td>
			                  <td width = "55%"><input type="checkbox" class="checked_setting_export" name = "categories_export" <?php if ($categories_checked_export){ ?> checked = "checked" <?php } ?> /></td>
                        </tr>
						<tr>
						     <td width = "15%"><?php echo $separator_export; ?></td>
							 <td><div class="col-sm-6" style = "padding-left: 0px !important">
                                      <select  id="separator_export" class="form-control">
                                                  <option value = "0">:</option>
			                                      <option value = "1">;</option>
			                                      <option value = "2">#</option>
			                                      <option value = "3">*</option>
                                       </select>
                                  </div>
							 </td>
                        </tr>
		                <tr>
                              <td colspan = "3" class = "text-left">
							  	   <div class = "panel-heading">
			                            <h3 class = "panel-title"><?php echo $number_column; ?></h3>
			                        </div>
							   </td>
                        </tr>
		                <tr>
                               <td width="25%"><?php echo $image_field; ?></td>
                               <td><input type="text" size ="30"  class = "settings_value_export" name="image_number" value = "<?php echo $image_number ?>"/></td>
		                </tr>
		                <tr>
                               <td width="25%"><?php echo $name_field; ?></td>
                               <td><input type="text"  size ="30"  class = "settings_value_export" name="name_number" value = "<?php echo $name_number ?>"/></td>
                        </tr>
		                <tr>
                               <td width="25%"><?php echo $model_field; ?></td>
                               <td><input type="text"  size ="30"  class = "settings_value_export" name="model_number" value = "<?php echo $model_number ?>"/></td>
                        </tr>
		                <tr>
                               <td width="25%"><?php echo $price_field; ?></td>
                               <td><input type="text"  size ="30"  class = "settings_value_export" name="price_number" value = "<?php echo $price_number ?>"/></td>
                        </tr>
		                <tr>
                               <td width="25%"><?php echo $guantity_field; ?></td>
                               <td><input type="text"  size ="30"  class = "settings_value_export" name="guantity_number" value = "<?php echo $guantity_number ?>"/></td>
                        </tr> 
		                <tr>
                               <td width="25%"><?php echo $statusenabled_field; ?></td>
                               <td><input type="text"  size ="30"  class = "settings_value_export" name="statusenabled_number" value = "<?php echo $statusenabled_number ?>"/></td>
                        </tr> 
		                <tr>
                               <td width="25%"><?php echo $sku_field; ?></td>
                               <td><input type="text"  size ="30"  class = "settings_value_export" name="sku_number" value = "<?php echo $sku_number ?>"/></td>
                        </tr>
                        <tr>
                               <td width="25%"><?php echo $manufacturer_field; ?></td>
                               <td><input type="text"  size ="30"  class = "settings_value_export" name="manufacturer_number" value = "<?php echo $manufacturer_number ?>"/></td>
                        </tr>
                        <tr>
                               <td width="25%"><?php echo $description_field; ?></td>
                               <td><input type="text"  size ="30" class = "settings_value_export" name="description_number" value = "<?php echo $description_number ?>"/></td>
                        </tr> 
                        <tr>
                               <td width="25%"><?php echo $categories_field; ?></td>
                               <td><input type="text"  size ="30" class = "settings_value_export" name="categories_number"  value = "<?php echo $categories_number ?>"/></td>
	        </table> 
          </form>
        </div>
	  </div>
    </div>
</div>
<script type="text/javascript">

var ok = <?php echo $settings_on; ?>;

function checkFileSize(id) {
	//
	var input, file, file_size;
	

	if (!window.FileReader) {
		// The file API isn't yet supported on user's browser
		return true;
	}

	input = document.getElementById(id);
	if (!input) {
		// couldn't find the file input element
		return true;
	}
	else if (!input.files) {
		// browser doesn't seem to support the `files` property of file inputs
		return true;
	}
	else if (!input.files[0]) {
		// no file has been selected for the upload
		alert( "<?php echo $error_select_file; ?>" );
		return false;
	}
	else {
		file = input.files[0];
		file_size = file.size;
		<?php if (!empty($post_max_size)) { ?>
		// check against PHP's post_max_size
		post_max_size = <?php echo $post_max_size; ?>;
		if (file_size > post_max_size) {
			alert( "<?php echo $error_post_max_size; ?>" );
			return false;
		}
		<?php } ?>
		<?php if (!empty($upload_max_filesize)) { ?>
		// check against PHP's upload_max_filesize
		upload_max_filesize = <?php echo $upload_max_filesize; ?>;
		if (file_size > upload_max_filesize) {
			alert( "<?php echo $error_upload_max_filesize; ?>" );
			return false;
		}
		<?php } ?>
		return true;
	}
}

	  
function receiveAjax(value, settings){

          $.ajax({ url:'index.php?route=tool/export/settings&token=<?php echo $url; ?>',
           type: "Post",
		   data: {'value':JSON.stringify(value), 'settings':JSON.stringify(settings)},
		   dataType: "json",
		   cache:false,
		   timeout: 3000,
           success: function(data){ 
		                            alert("<?php echo $text_modified_ok; ?>");
									if (data.status == 'Ok'){
									
									   ok = true;
									
									}
								  },
		   error: function(){alert("<?php echo $text_modified_error; ?>");}					  
           								  
           });
  
    } 
	
	

function EnterSetting(){

  var settings = {};
  
  var value = {};
  
  var settings_value = document.getElementsByClassName("settings_value");
 
  var status = document.getElementsByClassName("checked_setting");
  
  for (var i = 0; i < status.length; i++){
  
       if (status[i].type == 'checkbox'){
	   
	      settings[status[i].name] = status[i].checked;
	   
	   }
   }
   
     
   
     for (var i = 0; i < settings_value.length; i++){
  
          value[settings_value[i].name] = settings_value[i].value;
	   
	}
	
	settings_value = document.getElementsByClassName("settings_value_export");
 
    status = document.getElementsByClassName("checked_setting_export");
  
    for (var i = 0; i < status.length; i++){
  
         if (status[i].type == 'checkbox'){
	   
	         settings[status[i].name] = status[i].checked;
	   
	   }
   }
   
     
   
     for (var i = 0; i < settings_value.length; i++){
  
          value[settings_value[i].name] = settings_value[i].value;
	   
	}
	
	value['separator_import'] = $("#separator_import option:selected").val();
	value['separator_export'] = $("#separator_export option:selected").val();
	
	if (Number(value['min_size']) >= Number(value['max_size'])){
	
	   alert("<?php echo $text_error_end_row; ?>");
	
	}
    else if (Number(value['max_size']) - Number(value['min_size']) > 500){
	
	        alert("<?php echo $text_error_max_row; ?>");
	}
	else if ((Number(value['max_size']) < 1) || (Number(value['min_size']) < 1)){
	
	        alert("<?php echo $text_row_number_zero; ?>");
	}
	else
	{
	     
	     receiveAjax(value, settings);
	
	}
	
	
	
	
	
}
	
	
function load(){

    if (ok) 
	{
	    alert("<?php echo $text_export_started; ?>");
		document.location = "index.php?route=tool/export/load&token=<?php echo $url; ?>";
	}
    else
	{
	   alert("<?php echo $text_help_export; ?>");
	}
        

}	 

function upload() {

    
	if (checkFileSize('upload') && ok) {
	   
		$('#form').submit();
		
	}
}
</script>
<?php echo $footer; ?>