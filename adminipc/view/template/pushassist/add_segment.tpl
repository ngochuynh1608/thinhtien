<?php ?>
<link href="view/stylesheet/pushassist/content_base_oc.css" type="text/css" rel="stylesheet" />
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
	  
      <h1><?php echo $create_heading_title; ?></h1>
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
            <h1 class="title"><?php echo $text_new_title;?></h1>
        </div>
        <!-- End Page Header -->

       <!-- Container Start -->
        <div class="container-widget clearfix">
            <div class="alert alert-danger alert-dismissable" id="notification_error" style="display: none"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" autocomplete="off" id="create_segment_form" name="create_segment_form" enctype="multipart/form-data" action="<?php echo $add; ?>" method="post">                            
                            <div class="">
                                <input type="hidden" class="form-control" id="sites" name="sites" value="<?php //echo $result[0]['id']; ?>" />
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label form-label"><?php echo $text_segment_name;?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Segment Name" maxlength="40" required="required" />
                                    <span class="pull-right"><?php echo $text_segment_message;?></span>
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
            </div><!-- col-md-6-->
	    <div class="col-md-6 dummy-notification shadow panel panel-default">

            <p class="h5 pb15"><strong>How to Implement Segments for your Push Notification Subscribers</strong></p>

            <div class="widget shadow dummy-notification-inner-wrapper pb15">
                <p><strong>Step 1 :</strong> Create a new segment. Go to Create Segments</p>

                <p><strong>Step 2 :</strong> Copy the following JavaScript code and paste it on your site page(s).</p>

                <p class="margin-t-20"><strong>Subscribe for Single Segment</strong></p>
                <p>
                    &lt;script&gt;
                    <br>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; var _pa = [];<br>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; _pa.push('segmentname');
                    <br>
                    &lt;/script&gt;
                </p>

                <p class="margin-t-20"><strong>Subscriber for Multiple Segments</strong></p>
                <p>
                    &lt;script&gt;
                    <br>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; var _pa = [];<br>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; _pa.push('segmentname1', 'segmentname2');
                    <br>
                    &lt;/script&gt;
                </p>
            </div>
        </div>
            
        </div>
        <!-- Container End -->
</div>
    </div>
    <!-- Content End -->
  
	
  </div>
</div><!-- content close -->
<?php echo $footer; ?>