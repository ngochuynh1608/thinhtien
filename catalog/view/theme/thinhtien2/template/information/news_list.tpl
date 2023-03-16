<?php echo $header; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <?php $i=0; foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php if($i == 0){ ?><i class="fa fa-home"></i><?php } ?><?php echo $breadcrumb['text']; ?></a></li>
                <?php $i++; } ?>
            </ul>
        </div>
        <?php echo $column_left; ?>
        <div class="col-md-9">
                    <?php foreach ($all_news as $news) { ?>
                    <div class="wow fadeInLeft" data-wow-offset="200" data-wow-delay="200ms">
                        <div class="recent-post alt">
                            <div class="media">
                                <a class="media-link" href="<?php echo $news['view']; ?>">
                                    <img src="<?php echo $news['image']; ?>" alt="Blogs" title="Blogs" class="img-thumbnail" />
                                    
                                    <i class="fa fa-plus"></i>
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="<?php echo $news['view']; ?>"><?php echo $news['title']; ?></a></h4>
                                    <span><?php echo $news['date_added']; ?></span>
                                    <div class="media-excerpt">
                                        <p><span style="text-align: justify;"><?php echo $news['description']; ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <?php }?>
        </div>
    </div>
</div>
<?php echo $footer; ?> 