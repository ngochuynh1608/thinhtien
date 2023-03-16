<div class="builder-sidebar">
    <?php $i=1;?>
    <?php foreach($categorys as $category){ ?>
		<div class="step ">
			<a href="<?php echo $category['href']; ?>">
			<div class="step_label">
			 <strong>Bước <?php echo $i; ?>:</strong> <br> Chọn <?php echo $category['name']; ?>
			</div>
			</a>
			<div class="step_thumb" data-step="<?php echo $category['id']; ?>">
                <?php if(isset($category['image'])) {?>
                    <img src="<?php echo $category['image'];?>" />
                <?php } ?>
			</div>
		</div>
    <?php $i=$i+1;?>
    <?php } ?>
</div>