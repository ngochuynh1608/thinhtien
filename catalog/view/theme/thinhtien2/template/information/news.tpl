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
        <div id="content" class="col-sm-9 all-blog">
            <h1 style="color: #f52929; text-transform: uppercase;"><?php echo $heading_title; ?></h1>
            <div class="panel-default">
                <?php echo $description; ?>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?> 