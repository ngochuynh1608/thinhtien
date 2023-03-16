<?php

$upgrade_url='https://'.$account_response['account_name'].'.pushassist.com/dashboard/';
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
    
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
     
    <div id="pushassist" class="content dashboard clearfix">
        <!-- Start Page Header -->
        <div class="page-header">
            <h1 class="title"><?php echo $heading_title;?>
	    
	    </h1>
	    <div style="float:right;margin-right:10px;"><span style="font-size:15px"><?php echo $account_response['subscribers_remain'];?> subscribers left</span>&nbsp;&nbsp;&nbsp;
	  <a style="background-color: #616161;border-color: #1978AB;color: #FFFFFF;padding:8px;border-radius:3px;" href="<?php echo $upgrade_url;?>" target="_blank">Upgrade to Premium</a></div>
        </div>
        <!-- End Page Header -->

        <!-- Container Start -->
        <div class="container-widget clearfix">
            <!-- Top Stats Start -->
            <div class="col-md-12">
                <ul class="topstats clearfix">
                    <li class="col-xs-6 col-lg-2">
                        <span class="title"><i class="fa fa-send"></i> <?php echo $text_total_delivered;?></span>
                        <h3><?php echo $dashboard_response['total_delivered']; ?></h3>
                        <span class="diff">
						<?php if ($dashboard_response['delivered_change'] == 'negative') { ?>
						<b class="color-down"><i class="fa fa-caret-down"></i> <?php echo $dashboard_response['delivered_percentage']; ?>
						<?php }
						if ($dashboard_response['delivered_change'] == 'positive') { ?>
						<b class="color-up"><i class="fa fa-caret-up"></i> <?php echo $dashboard_response['delivered_percentage']; ?>
							<?php } ?>%

						
						</b> <?php echo $text_last_week;?></span>
                    </li>

                    <li class="col-xs-6 col-lg-2">
                        <span class="title"><i class="fa fa-check-square-o"></i> <?php echo $text_total_clicks;?> </span>
                        <h3 class="color-up"><?php echo $dashboard_response['total_clicks']; ?></h3>
                        <span class="diff">
                            <?php if ($dashboard_response['clicks_change'] == 'negative') { ?>
                            <b class="color-down"><i class="fa fa-caret-down"></i> <?php echo $dashboard_response['clicks_percentage']; ?>
                                <?php } if ($dashboard_response['clicks_change'] == 'positive') { ?>
                                <b class="color-up"><i class="fa fa-caret-up"></i> <?php echo $dashboard_response['clicks_percentage']; ?>
                                    <?php } ?>%
                                   
                                </b> <?php echo $text_last_week;?></span>
                    </li>

                    <li class="col-xs-6 col-lg-2">
                        <span class="title"><i class="fa  fa-users"></i> <?php echo $text_total_subscribers;?> </span>
                        <h3><?php echo $dashboard_response['total_subscribers']; ?></h3>
			<span class="diff">
                            <?php if ($dashboard_response['subscribers_change'] == 'negative') { ?>
                            <b class="color-down"><i class="fa fa-caret-down"></i> <?php echo $dashboard_response['subscribers_percentage']; ?>
                                <?php } if ($dashboard_response['subscribers_change'] == 'positive') { ?>
                                <b class="color-up"><i class="fa fa-caret-up"></i> <?php echo $dashboard_response['subscribers_percentage']; ?>
                                    <?php } ?>%
                                    
                                </b> <?php echo $text_last_week;?></span>
                    </li>

                    

                    <li class="col-xs-6 col-lg-2">
                        <span class="title"><i class="fa  fa-cogs"></i> <?php echo $text_campaigns;?> </span>
                        <h3 class="color-up"><?php echo $dashboard_response['campaign_count']; ?></h3>
                        <span class="diff"><b class="color-down"></b> <?php echo $text_this_week;?></span>
                    </li>
					
                    <li class="col-xs-6 col-lg-2">
                        <span class="title"><i class="fa  fa-send"></i> <?php echo $text_segments;?> </span>
                        <h3 class="color-up"><?php echo $dashboard_response['segment_count']; ?></h3>
						<span class="diff"><b class="color-down"></b> <?php echo $text_created;?> </span>
                    </li>

                    <li class="col-xs-6 col-lg-2">
                        <span class="title"><i class="fa fa-sitemap"></i> <?php echo $text_sites;?></span>
                        <h3 class="color-up"><?php echo $dashboard_response['sites_count']; ?></h3>
						<span class="diff"><b class="color-down"></b><?php echo $text_registered;?></span>
                    </li>
                </ul>
            </div>
            <!-- Top Stats End -->

            <!-- Project Stats Start -->
	  
            <div class="col-md-12 col-lg-12">

                <div class="panel panel-widget">
		<?php if(count($dashboard_response['last_notifications']) > 0){?>
                    
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
				<td><?php echo $text_campaign;?></td>
                                
                            </tr>
                            </thead>
                            <tbody>
			    <?php $i=1;
			      foreach( $dashboard_response['last_notifications'] as $get_notifications_list){ 
				  if($get_notifications_list['total_sent'] != 0){
				      $clicked_percentage=($get_notifications_list['total_clicked']/$get_notifications_list['total_sent'])*100;
				  }else{
				      $clicked_percentage=0;
				  }
			      ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $get_notifications_list['siteURL']?></td>	
				     <td class="message">
					<div class="col-sm-10">
					    <h5 class="margin-t-0 font-bold">
						<?php echo  $get_notifications_list['title'];?> 
					    </h5>
					    <p class="margin-b-5"><?php echo  $get_notifications_list['message'];?></p>
					    <a target="_blank" href="<?php echo  $get_notifications_list['url'];?>">
						<?php echo  $get_notifications_list['url'];?>
					    </a>
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
				    <td><?php if($get_notifications_list['campaign_flag']==0){ echo "No";}else{ echo "Yes";}?></td>
                                    
                                </tr>
                              <?php 
				      $i++;
			      } ?>  
                                                             
                            </tbody>
                        </table>
                    </div>
 <?php }else{ echo "No result found.";} ?>
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
