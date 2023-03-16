
<div class="col-sm-12">
     <div id="cmsblock-29" class="cmsblock">
		<div class='description'>
            <div class="banner-static-top"> 
            	<div class="row">
                    <?php if($banners){ ?>
                        <?php $col=12/count($banners);?>
                        <?php foreach($banners as $banner){ ?> 
                            <div class="col-md-<?php echo $col ?>  col-sm-<?php echo $col ?> col-xs-6">
                                <div class="banner-box banner-box1">
                                    <div class="box-inner"><a href="<?php echo $banner['link'];?>"><img alt="" src="<?php echo $banner['image'];?>"></a>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
