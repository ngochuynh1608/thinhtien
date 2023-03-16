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
           <!-- Project Stats Start -->
            <div class="col-md-12 col-lg-12">
                <div class="panel panel-widget">
                 
                    <div class="panel-search">
                        <form>
                            <input type="text" class="form-control" placeholder="Search...">
                            <i class="fa fa-search icon"></i>
                        </form>
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td><?php echo $text_site_url;?></td>
                                <td><?php echo $text_chrome;?></td>
				<td><?php echo $text_firefox;?></td>
				<td><?php echo $text_safari;?></td>
                            </tr>
                            </thead>
                            <tbody>
			      <?php $i = 1;
				foreach($get_subscribers as $get_subscribers_list){?>
                                <tr>
				
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $get_subscribers_list['siteurl']?></td>
                                    <td><?php echo $get_subscribers_list['Chrome'];?></td>
				    <td><?php echo $get_subscribers_list['Firefox'];?></td>
				    <td><?php echo $get_subscribers_list['Safari'];?></td>
                                </tr>
				  
                                <?php $i++;
				  } ?>
                                                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Project Stats End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Content End -->
    </div>
	
  </div>
</div><!-- content close -->
<?php echo $footer; ?>