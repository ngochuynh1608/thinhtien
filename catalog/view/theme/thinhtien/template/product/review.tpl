<?php if ($reviews) { ?>
<?php foreach ($reviews as $review) { ?>
<div class="review">
  <div class="row">
      <div class="col-md-6">
        <h4><strong><?php echo $review['author']; ?></strong></h4>
      </div>
      <div class="col-md-6">
        <i><?php echo $review['date_added']; ?></i>
      </div>
      <div class="col-md-12">
        <p><?php echo $review['text']; ?></p>
        <?php for ($i = 1; $i <= 5; $i++) { ?>
        <?php if ($review['rating'] < $i) { ?>
        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
        <?php } else { ?>
        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
        <?php } ?>
        <?php } ?>
      </div>
  </div>

</div>

<?php } ?>
<div class="text-right"><?php echo $pagination; ?></div>
<?php } else { ?>
<p><?php echo $text_no_reviews; ?></p>
<?php } ?>
