<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row">
    <div id="content">
    <div class="col-md-12">
      <h1 style="    text-align: center;
    color: #f52929;
    text-transform: uppercase;"><?php echo $heading_title; ?></h1>
      <p style="    text-align: center;"><?php echo $text_error; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      </div>
    </div>
    </div>
</div>
<?php echo $footer; ?>