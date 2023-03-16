<?php
#################################################################
## Open Cart Module: invitereferrals - Referral Marketing Software	   ##
##-------------------------------------------------------------##
## Copyright © 2015 "Invitereferrals" All rights reserved.     ##
## http://www.invitereferrals.com						       ##
##-------------------------------------------------------------##
## Permission is hereby granted, when purchased, to  use this  ##
## mod on one domain. This mod may not be reproduced, copied,  ##
## redistributed, published and/or sold.				       ##
##-------------------------------------------------------------##
## Violation of these rules will cause loss of future mod      ##
## updates and account deletion				      			   ##
#################################################################
?>

<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-notifyvisitorsV1" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
		
		
		
		
      <h1><?php echo $heading_title.$advert; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
	  
	  	   
	  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-notifyvisitorsV1" class="form-horizontal">
         
		 
		 
          <div class="form-group-lg required">
		  
            <label class="col-sm-2 control-label" for="notifyvisitorsV1_brandid"><?php echo $entry_notifyvisitorsV1_brandid; ?></label>
            <div class="col-sm-10">
              <input type="text" name="notifyvisitorsV1_brandid" id="notifyvisitorsV1-brandid" class="form-control" value="<?php echo $notifyvisitorsV1_brandid; ?>">
			  
			  <?php if ($error_notifyvisitorsV1_brandid) { ?>      <!--  Error Script     -->
              <div class="text-danger"><?php echo $error_notifyvisitorsV1_brandid; ?></div>
              <?php } ?>
			  
			  <br>
			  
			  
			  
			  

			  
              
            </div>
			
			<label class="col-sm-2 control-label" for="notifyvisitorsV1_key"><?php echo $entry_notifyvisitorsV1_key; ?></label>
            <div class="col-sm-10">
              <input type="text" name="notifyvisitorsV1_key" id="notifyvisitorsV1-key" class="form-control" value="<?php echo $notifyvisitorsV1_key; ?>">
			
			<?php if ($error_notifyvisitorsV1_key) { ?>             <!--  Error Script     -->
              <div class="text-danger"><?php echo $error_notifyvisitorsV1_key; ?></div>
              <?php } ?>
			
			<br>
			
			
	  
	  
	  		
         </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-test"><?php echo $entry_test; ?></label>
            <div class="col-sm-10">
              <select name="notifyvisitorsV1_status" id="input-notifyvisitorsV1" class="form-control">
                <option value="<?php echo $text_on;?>" <?php echo ($notifyvisitorsV1_status == $text_on ? ' selected="selected"' : '')?>><?php echo $text_on; ?></option>
				<option value="<?php echo $text_off;?>" <?php echo ($notifyvisitorsV1_status == $text_off ? ' selected="selected"' : '')?>><?php echo $text_off; ?></option>
              </select>
            </div>
          </div>
		  
		  <div class="bg-info col-md-12 lead well" >
		  Please Follow Instructions:
		  <br/><br/>
		  Sign into your NotifyVisitors.com account. Then go to the <b><a target="_blank" href="http://www.notifyvisitors.com/brand/admin/webJsIntegrationCode">NotifyVisitors Module section</a></b> and <b>copy your brandID and secretKey</b>
		  <br/></br>
		  
		  </div>
		  

        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 