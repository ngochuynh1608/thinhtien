<?php 

?>
<link href="view/stylesheet/pushassist/content_base_oc.css" type="text/css" rel="stylesheet" />
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
	  
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div><!-- page-header close -->
  <div class="container-fluid">

    <?php if($success ) {?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $success ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    
  
      <div class="panel panel-default">
    <div id="pushassist" class="content dashboard clearfix">
        <!-- Start Page Header -->
        <div class="page-header">
            <h1 class="title"><?php echo $heading_title;?></h1>
        </div>
        <!-- End Page Header -->

       <!-- Container Start -->
        <div class="container-widget clearfix">
            <div class="alert alert-danger alert-dismissable" id="notification_error" style="display: none"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" autocomplete="off" id="send_notification_form" name="send_notification_form" enctype="multipart/form-data" action="<?php echo $add;?>" method="post">                            
                            <div class="">
                                <input type="hidden" class="form-control" id="sites" name="sites" value="<?php //echo $result[0]['id']; ?>" />
                            </div>
                           <div class="form-group">
                                <label class="col-sm-3 control-label form-label"><?php echo $text_notification_title;?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Notification Title" maxlength="77" required="required" />
                                    <span class="pull-right"><?php echo $text_title_limit;?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label form-label"><?php echo $text_notification_message;?></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="2" name="message" id="message" placeholder="Notification Message" maxlength="138" required="required" style="resize: none"></textarea>
                                    <span class="pull-right"><?php echo $text_message_limit;?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label form-label"><?php echo $text_notification_url;?></label>
				<div class="col-sm-9 margin-b-15">
                                    <input type="url" maxlength="250" placeholder="Enter a URL to push your subscribers to (yoursite.com)" name="url" id="url" class="form-control" >
                                </div>
  
                            </div>
                           
                            <div class="form-group margin-b-0">
                                <label for="focusedinput" class="col-sm-3 control-label form-label"><?php echo $text_notification_logo;?></label>    
                                <div class="col-sm-9">
                                    <span class="btn btn-success fileinput-button margin-b-10">
                                        <span>Notification Logo...</span>
                                        <input id="fileupload" type="file" name="fileupload" />
					<input type="hidden" name="image_code" value="" id="input-option" />
                                    </span>
				    <span class="clearfix">Image size must be exactly 250x250px.</span>
                                    <!-- The global progress bar -->
                                    <div id="progress" class="progress">
                                        <div class="progress-bar progress-bar-success"></div>
                                    </div>
				    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-offset-3 control-label form-label">    
                                    <input type="checkbox" value="1" name="is_utm_show" id="is_utm_show" />
                                    <label class="form-label checkbox_title margin-l-10"><?php echo $text_utm_parameters;?></label>    
                                </label>
                            </div>
                           <div class="form-group" id="utm_parameter_div" style="display: none;">    
                                <label class="col-sm-3 control-label form-label"><?php echo $text_utm_source;?></label>
                                <div class="col-sm-9 margin-b-15">
                                    <input type="text" class="form-control" id="utm_source" name="utm_source" value="pushassist" placeholder="Enter UTM Source" maxlength="45" required="required" />
                                    <span class="pull-right"><?php echo $text_title_limit;?></span>
                                </div>

                                <label class="col-sm-3 control-label form-label"><?php echo $text_utm_medium;?></label>
                                <div class="col-sm-9 margin-b-15">
                                    <input type="text" class="form-control" name="utm_medium" id="utm_medium" value="pushassist_notification" placeholder="Enter UTM Medium" maxlength="73" required="required" />
                                    <span class="pull-right"><?php echo $text_message_limit;?></span>
                                </div>

                                <label class="col-sm-3 control-label form-label"><?php echo $text_utm_campaign;?></label>
                                <div class="col-sm-9 margin-b-15">
                                    <input type="text" class="form-control" name="utm_campaign" id="utm_campaign" value="pushassist" placeholder="Enter UTM Campaign" maxlength="500" required="required"  />
                                    <span class="pull-right"><?php echo $text_campaign_limit;?></span>
                                </div>    
                                <input type="hidden" id="campaign_id" name="campaign_id" value="" />
                                <input type="hidden" id="status" name="status" value="" />
                                <input type="hidden" id="notification_logo" name="notification_logo" />
                                <input type="hidden" id="cmp_status" name="cmp_status" value="0" />
                                <input type="hidden" id="date" name="date" value="" />
                                <input type="hidden" id="is_draft" name="is_draft" value="1" />    
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label form-label"><?php echo $text_segment;?></label>
                                <div class="col-sm-9 dropdown_padding">
                                    <select class="col-sm-12" id="segment" name="segment[]"  multiple>
				      <?php 
					    if(count($get_segment) > 0){ 
						foreach($get_segment as $get_segment_list){
					    ?>
						<option value="<?php echo $get_segment_list['id'];?>"><?php echo $get_segment_list['name'];?></option>
					<?php  }  } else{ 
					?>
					<option value="">No Segment</option>
                                        <?php } ?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-1 col-xs-3">
                                    <button type="submit" class="btn btn-default"><?php echo $text_send;?></button>
                                </div>

                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
	    <div class="col-md-6 dummy-notification shadow panel panel-default">
		<p class="h4 pb15">Preview</p>
		<div class="widget shadow dummy-notification-inner-wrapper">
		    <div class="wrapper">
			<div class="img_wrapper pull-left">
			  <img class="img-responsive" src="<?php echo $account_response['site_image'];?>" id="pushassist_preview_logo">
			</div>
			<div class="text_wrapper pull-left">
			    <div class="title">
				<div id="notification_title" class="title_txt pull-left">Notification Title</div>
				<div class="closer pull-right">x</div>
			    </div>
			    <div id="notification_message" class="message">Notification Body</div>
			    <div class="domain">
				    <div class="domain"><?php echo $account_response['account_name'];?>.pushassist.com</div>
			    </div>
			</div>
		      </div>
		  </div>

		  <div class="redirect_url">
			  <p class="h5" id="redirect_url" name="redirect_url">URL to open when user clicks the notification:</p>
		  </div>
	    </div>

        </div>
        <!-- Container End -->
</div>
    </div>
    <!-- Content End -->
  <script language="javascript">
		
$(document).ready(function() {
"use strict";
		 var $url = "";
			
		 jQuery("#title").keyup(function () {
		 
            title = jQuery('#title').val();

            if (title != "") {
                jQuery('#notification_title').text(title);
            }
            else {
                jQuery('#notification_title').text('Notification Title');
            }
        });

        jQuery("#message").keyup(function () {

             message = jQuery('#message').val();

            if (message != "") {
                jQuery('#notification_message').text(message);               
            }
            else {

                jQuery('#notification_message').text('Notification Body');                
            }
        });

        jQuery("#url,#utm_medium,#utm_source, #utm_campaign").keyup(function () {

            $url = jQuery('#url').val();

            if ($url != "" && jQuery('#is_utm_show').is(':checked')) {

                jQuery('#redirect_url').text($url + "?utm_source=" + jQuery('#utm_source').val() + "&utm_medium=" + jQuery('#utm_medium').val() + "&utm_campaign=" + jQuery('#utm_campaign').val());                

            } else if ($url != "") {
			
                jQuery('#redirect_url').text($url);                
            }
            else {
                jQuery('#redirect_url').text('URL to open when user clicks the notification:');                
            }
        });

	

        jQuery("#title").blur(function () {
            title = jQuery('#title').val();

            if (title != "") {
                jQuery('#notification_title').text(title);
            }
            else {
                jQuery('#notification_title').text('Notification Title');
            }
        });

        jQuery("#message").blur(function () {
		
            message = jQuery('#message').val();

            if (message != "") {
                jQuery('#notification_message').text(message);               
            }
            else {

                jQuery('#notification_message').text('Notification Body');                
            }
        });

        jQuery("#url").blur(function () {

            $url = jQuery('#url').val();

            if ($url != "" && jQuery('#is_utm_show').is(':checked')) {

                jQuery('#redirect_url').text($url + "?utm_source=" + jQuery('#utm_source').val() + "&utm_medium=" + jQuery('#utm_medium').val() + "&utm_campaign=" + jQuery('#utm_campaign').val());                

            } else if ($url != "") {
			
                jQuery('#redirect_url').text($url);                
            }
            else {
                jQuery('#redirect_url').text('URL to open when user clicks the notification:');                
            }
        });
		
		jQuery("#is_utm_show").on('click', function () {
		
			if (jQuery('#is_utm_show').is(':checked')) { 


					jQuery('#utm_parameter_div').show('slow');

					if ($url == "") {

						jQuery('#redirect_url').text('URL to open when user clicks the notification:');
					} else {

						jQuery('#redirect_url').text($url + "?utm_source=" + jQuery('#utm_source').val() + "&utm_medium=" + jQuery('#utm_medium').val() + "&utm_campaign=" + jQuery('#utm_campaign').val());
					}

				} else {

					jQuery('#utm_parameter_div').hide('slow');

					if ($url == "") {

						jQuery('#redirect_url').text('URL to open when user clicks the notification:');
					} else {

						jQuery('#redirect_url').text($url);
					}
				}
		});
	});	
	</script>
</form>
	
  </div>
</div><!-- content close -->
<?php echo $footer; ?>