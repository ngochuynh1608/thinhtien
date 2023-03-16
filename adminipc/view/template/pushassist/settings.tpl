<?php ?>
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
    <?php if ($error) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
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
        <div class="col-md-6">
            <div class="panel panel-default">

                <div class="panel-body">

                    <form class="form-horizontal" autocomplete="off" id="pushassist_template_setting_form"
                          name="pushassist_template_setting_form" enctype="multipart/form-data"
                          action="<?php echo $addsettings;?>" method="post">

                        <div class="form-group">
                            <label class="control-label form-label margin-r-10 padding-t-0">Ask for permission after</label>

                            <input type="number" id="pushassist_timeinterval" class="form-control" name="pushassist_timeinterval"
                                   placeholder="Interval"
                                   min="0" style="width: 10%;display:inline;" max="30"
                                   maxlength="2" value="<?php echo $account_response['notification_interval']; ?>"/>
                            <label
                                class="control-label form-label margin-l-10 padding-t-0"> seconds on your website</label>
                        </div>

                        <div class="form-group">
                            <label
                                class="col-sm-2 control-label form-label">Opt-In Box Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pushassist_opt_in_title"
                                       id="pushassist_opt_in_title" value="<?php echo stripslashes($account_response['opt_in_title']); ?>"
                                       placeholder="Opt-In Box Title"
                                       maxlength="80" required>
                                <span
                                    class="float-r">Limit 80 Characters</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label
                                class="col-sm-2 control-label form-label">Opt-In Box Subtitle</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pushassist_opt_in_subtitle"
                                       id="pushassist_opt_in_subtitle" value="<?php echo stripslashes($account_response['opt_in_subtitle']); ?>"
                                       placeholder="Opt-In Box Subtitle"
                                       maxlength="105" required>
                                <span
                                    class="float-r">Limit 105 Characters</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label
                                class="col-sm-2 control-label form-label">Allow Button Text</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pushassist_allow_button_text"
                                       id="pushassist_allow_button_text" value="<?php echo stripslashes($account_response['allow_button']); ?>"
                                       placeholder="Allow Button Text"
                                       maxlength="25" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label
                                class="col-sm-2 control-label form-label">Don't Allow Button</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pushassist_disallow_button_text"
                                       id="pushassist_disallow_button_text" value="<?php echo stripslashes($account_response['disallow_button']); ?>"
                                       maxlength="25" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label padding-l-0">Notification Template</label>
                            <div class="col-sm-9">
                                <select class="selectpicker col-sm-12" id="template" name="template">
                                    <?php

                                    $template = array('1' => 'Default', '2' => 'Template 1', '3' => 'Template 2', '4' => 'Template 3', '5' => 'Template 4', '6' => 'Template 5', '7' => 'Template 6', '8' => 'Template 7'); //

                                    while (list($key, $val) = each($template)) {

                                    if ($key == $account_response['template']) {
                                         ?>
                                            <option value="<?php echo $key;  ?>" data-title="<?php echo $key; ?>"
                                                    selected> <?php echo $val;  ?></option>
                                        <?php } else {
                                             ?>
                                    <option data-title="<?php echo $key; ?>" value="<?php echo $key; ?>"> <?php echo $val; ?></option>
                                    <?php }
                                    } ?>
                                                                    </select>
                            </div>
                        </div>

						 
						
                        <div class="form-group">
                            <label class="col-sm-2 control-label form-label">Location</label>
                           <?php
                            $location = array('1' => 'Top Left', '2' => 'Top Right', '3' => 'Top Center', '4' => 'Bottom Left', '5' => 'Bottom Right', '6' => 'Bottom Center');
                            $location_2 = array('1' => 'Top Left', '2' => 'Top Right', '4' => 'Bottom Left', '5' => 'Bottom Right');
                            $location_3 = array('7' => 'Top', '8' => 'Bottom');
                            ?>
                            <input type="hidden" name="psa_template_location" id="psa_template_location" value="<?php if(isset($account_response['opt_in_location'])){ echo $account_response['opt_in_location']; } else { echo 1; } ?>">
							
                            <div class="col-sm-9" id="psa_list_1" style="display: <?php if($account_response['template'] < 7 ||  $account_response['template'] == '1') { echo 'block'; } else { echo 'none'; }?>;">
                                <select class="selectpicker col-sm-12" id="location" name="location">

                                    <?php

                                    while (list($key, $val) = each($location)) {

                                        if ($key == $account_response['opt_in_location']) {
                                            ?>
                                            <option value="<?php echo $key;  ?>"
                                                    selected> <?php echo $val;  ?></option>
                                        <?php } else {
                                            ?>
                                            <option value="<?php echo $key; ?>"> <?php echo $val; ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>

                            <div class="col-sm-9" id="psa_list_2" style="display: <?php if($account_response['template'] == 7) { echo 'block'; } else { echo 'none'; }?>;">
                               <select class="selectpicker col-sm-12" id="location_1" name="location_1">

                                    <?php

                                    while (list($key, $val) = each($location_2)) {

                                        if ($key == $account_response['opt_in_location']) {
                                            ?>
                                            <option value="<?php echo $key;  ?>"
                                                    selected> <?php echo $val;  ?></option>
                                        <?php } else {
                                            ?>
                                            <option value="<?php echo $key; ?>"> <?php echo $val; ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>

                            <div class="col-sm-9" id="psa_list_3" style="display: <?php if($account_response['template'] == 8) { echo 'block'; } else { echo 'none'; }?>;">
                               <select class="selectpicker col-sm-12" id="location_2" name="location_2">

                                    <?php

                                    while (list($key, $val) = each($location_3)) {

                                        if ($key == $account_response['opt_in_location']) {
                                            ?>
                                            <option value="<?php echo $key;  ?>"
                                                    selected> <?php echo $val;  ?></option>
                                        <?php } else {
                                            ?>
                                            <option value="<?php echo $key; ?>"> <?php echo $val; ?></option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>

                        </div>

                        <div class="form-group margin-b-0">
                            <label for="focusedinput"
                                   class="col-sm-2 control-label form-label">Site Logo</label>
                            <div class="col-sm-9">
                                <span class="btn btn-success fileinput-button margin-b-10">
                                    <span>Site Logo</span>
                                    <input id="fileupload" type="file" name="fileupload"/>
                                </span>
                                <br/>
                                <span>Image size must be exactly 250x250px</span>
                            </div>
                        </div>

                        <hr>

                        <h5 class="col-sm-offset-2 title margin-t-0 margin-b-20">Notification Subscription Setting</h5>
			 <div class="form-group">
                            <label
                                class="col-sm-2 control-label form-label">Opt-In Text</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pushassist_child_window_text"
                                       id="pushassist_child_window_text" value="<?php echo stripslashes($account_response['child_text']); ?>"
                                       maxlength="100" placeholder="Would Like to Send You Push Notifications. Click Allow to receive notifications." required>
                                <span
                                    class="float-r">Limit 100 Characters</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label
                                class="col-sm-2 control-label form-label">Opt-In Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pushassist_child_window_title"
                                       id="pushassist_child_window_title" placeholder="Opt-In Title" value="<?php echo stripslashes($account_response['child_title']); ?>"
                                       maxlength="45" required>
                                <span
                                    class="float-r">Limit 45 Characters</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label
                                class="col-sm-2 control-label form-label">Opt-In Message</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pushassist_child_window_message"
                                       id="pushassist_child_window_message" placeholder="Opt-In Message" value="<?php echo stripslashes($account_response['child_message']); ?>"
                                       maxlength="73" required>
                                <span
                                    class="float-r">Limit 73 Characters</span>
                            </div>
                        </div>

                        <hr>

                        <h5 class="col-sm-offset-2 title margin-t-0 margin-b-20">Welcome Message for first time subscribers</h5>

                        <div class="form-group">
                            <label
                                class="col-sm-2 control-label form-label">Notification Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pushassist_setting_title"
                                       id="pushassist_setting_title" value="<?php echo stripslashes($account_response['title']); ?>"
                                       placeholder="Notification Title" maxlength="45">
				<span class="float-r">Limit 45 Characters</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label
                                class="col-sm-2 control-label form-label">Notification Message</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pushassist_setting_message"
                                       id="pushassist_setting_message" value="<?php echo stripslashes($account_response['message']); ?>"
                                       placeholder="Notification Message"
                                       maxlength="73">
				<span class="float-r">Limit 73 Characters</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label
                                class="col-sm-2 control-label form-label">Redirect URL</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pushassist_redirect_url"
                                       id="pushassist_redirect_url" value="<?php echo stripslashes($account_response['redirect_url']); ?>"
                                       placeholder="Redirect URL"
                                       maxlength="250">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-default" value="Save Settings" name="psa-gcm-settings"><?php echo $text_save_button;?></button>
                            </div>
                        </div>

                    </form>

                    <hr>

                    

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">

                    <p><strong>What is a GCM Key? How do I get export my subscribers, What if I want to switch to other vendor.</strong></p>
                    <p class="margin-b-15 margin-t-15">At the time of installation, you have to provide your GCM (Google Cloud Messaging) API Key for Chrome and Certificate Details for Safari that is used.</p>
                    <p>We need this information to export your subscriber&rsquo;s ID&rsquo;s. Please note that only premium accounts can export the subscribers.</p>
                    <p class="margin-b-15 margin-t-15"> Please read
                        <a
                            href="https://pushassist.com/adding-your-own-gcm-key-project-id-in-pushassist/"
                            style="color: #0000ff;"
                            target="_blank"> GCM registration</a> guidelines here.
                    </p>

                    <form class="form-horizontal margin-t-30" autocomplete="off" id="pushassist_gcm_setting_form" name="pushassist_gcm_setting_form" enctype="multipart/form-data"
                          action="<?php echo $add; ?>" method="post">

                        <div class="form-group">
                            <label
                                class="col-sm-2 control-label form-label">GCM Project No.</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pushassist_gcm_project_no"
                                       id="pushassist_gcm_project_no" value="<?php echo stripslashes($account_response['gcm_project_number']); ?>"
                                       placeholder="GCM Project No."
                                       maxlength="20" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label
                                class="col-sm-2 control-label form-label">GCM API Key</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pushassist_gcm_api_key"
                                       id="pushassist_gcm_api_key" value="<?php echo stripslashes($account_response['gcm_api_key']); ?>"
                                       placeholder="GCM API Key"
                                       maxlength="250" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-default" value="Save Settings" name="psa-gcm-settings"><?php echo $text_save_button;?></button>
                            </div>
                        </div>

                    </form>

                    <hr>

                    <p class="clearfix margin-t-20 margin-b-20">Screenshot of advance configurations that are possible with your PushAssist account. &nbsp;&nbsp;&nbsp;
                        <a href="https://<?php echo $account_response['account_name'];?>.pushassist.com/allsites/"
                           class="btn btn-default margin-t-0"
                           target="_blank">Customize Now</a>
                    </p>

                    <div class="margin-t-15 image_wrapper">
                       <img src="view/stylesheet/pushassist/pushassist_opt_in_box_setting.png" alt="Campaign Notification">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Container End -->
      <script language="javascript">

   

    jQuery("#template").on("change", function () {

        if(jQuery(this).val() == 8){

            jQuery('#psa_list_3').show();
            jQuery('#psa_list_2').hide();
            jQuery('#psa_list_1').hide();

            jQuery('#psa_template_location').val(jQuery('#location_2').val());

        }

        if(jQuery(this).val() == 7){

            jQuery('#psa_list_3').hide();
            jQuery('#psa_list_2').show();
            jQuery('#psa_list_1').hide();

            jQuery('#psa_template_location').val(jQuery('#location_1').val());

        }

        if(jQuery(this).val() < 7){

            jQuery('#psa_list_3').hide();
            jQuery('#psa_list_2').hide();
            jQuery('#psa_list_1').show();

            jQuery('#psa_template_location').val(jQuery('#location').val());
        }
    });

    jQuery("#location").on("change", function () {

        var template_location = jQuery(this).val();

        jQuery('#psa_template_location').val(template_location);
    });

    jQuery("#location_1").on("change", function () {

        var template_location = jQuery(this).val();

        jQuery('#psa_template_location').val(template_location);
    });

    jQuery("#location_2").on("change", function () {

        var template_location = jQuery(this).val();

        jQuery('#psa_template_location').val(template_location);
    });

</script>
</div>
    </div>
    <!-- Content End -->
  
	
  </div>
</div><!-- content close -->
<?php echo $footer; ?>