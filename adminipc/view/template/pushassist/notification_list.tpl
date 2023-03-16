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
<div class="sub_count">
            <a href="<?php echo $send_ntf_link;?>">Send New Notification</a>
        </div>
        </div>
        <!-- End Page Header -->

        <!-- Container Start -->
        <div class="container-widget clearfix">
           

            <!-- Project Stats Start -->

            <div class="col-md-12 col-lg-12">
                <div class="panel panel-widget">
		   <?php if(count($get_notifications) > 0){?>
                    
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
                                <td><?php echo $text_site;?></td>
                                <td><?php echo $text_message;?></td>
				<td><?php echo $text_sent;?></td>
                                <td><?php echo $text_delivered;?></td>
                                <td><?php echo $text_failed;?></td>
                                <td><?php echo $text_clicked;?></td>
				<td><?php echo $text_date;?></td>
                            </tr>
                            </thead>
                            <tbody>
			      <?php $i = 1;
				foreach($get_notifications as $get_notifications_list){
				
				 if($get_notifications_list['total_sent'] != 0){
				      $clicked_percentage=($get_notifications_list['total_clicked']/$get_notifications_list['total_sent'])*100;
				  }else{
				      $clicked_percentage=0;
				  }
				?>
                                <tr>
				
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $get_notifications_list['siteurl']?></td>                                   
				    <td class="message">
					<div class="col-sm-3 table_image">
						
						<img src="<?php echo $get_notifications_list['logo']?>" alt="Notification Logo">
					</div>

					<div class="col-sm-8">
					    <h5 class="margin-t-0 font-bold">
						
						  <?php echo  $get_notifications_list['title'];?>
					    </h5>
					    <p class="margin-b-5"><?php echo  $get_notifications_list['message'];?></p>
					   
					    <a target="_blank" href="<?php echo $get_notifications_list['redirecturl'];?>"><?php echo $get_notifications_list['redirecturl'];?></a>
					</div>
				    </td>
				    
				    <td><?php echo $get_notifications_list['total_sent']+$get_notifications_list['failed'];?></td>
				    <td><?php echo $get_notifications_list['total_sent']?></td>
                                    <td><?php echo $get_notifications_list['failed'];?></td>
				    <td><?php echo $get_notifications_list['total_clicked'];?> 
					<?php if($clicked_percentage>0){
					?>	
					  <b class="color-up margin-l-10"> <?php echo (int)$clicked_percentage; } else { ?> <b class="color-up margin-l-10">0 <?php } ?> %</b>
				    </td>
				    
				    <td><?php echo date("M d, Y H:i:s",strtotime($get_notifications_list['created_at']));?></td>
                                </tr>
				  
                                <?php $i++;
				  } ?>
                                                              
                            </tbody>
                        </table>
                    </div>
<?php }else{ echo "No result found."; } ?>
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