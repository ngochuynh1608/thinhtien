<?php echo $header; ?>
<div class="container">
<div class="row">
<div class="col-md-12">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  
</div>

</div>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">

      <?php if ($products) { ?>
      <div class="row">
        <div class="col-md-12">
          <?php echo $content_top; ?>
        </div>
        <div class="col-md-7"  style="display:none;">
          <div class="btn-group hidden-xs">
            <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
            <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_grid; ?>"><i class="fa fa-th"></i></button>
          </div>
        </div>

        <div class="col-md-3 text-right right" style="float:right;">
          <select id="input-sort" class="form-control" onchange="location = this.value;">
            <?php foreach ($sorts as $sorts) { ?>
            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
            <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-2 text-right right" style="float:right;">
          <label class="control-label" for="input-sort" style="font-size:14px; margin-top:6px;"><?php echo $text_sort; ?></label>
        </div>
      </div>
      <br />
      <div class="row">
        <div class="col-md-12">
          <div class="homeproduct">
          <?php foreach ($products as $product) { ?>
          <div class="product-layout product-list col-xs-15" >
          		<div class="item-inner">
          			<div class="images-container">
          				<div class="image">
  							<a href="<?php echo $product['href']; ?>">
  								<img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" />
  							</a>
      					</div>
                          <a href="<?php echo $product['href']; ?>">


                          </a>
                                                    <?php 
                               $now = time(); // or your date as well
                               $your_date = strtotime($product['date_added']);
                               $datediff = $now - $your_date;
                               $days=floor($datediff/(60*60*24));
                               if($days < 7){
                           ?>
                                <div class="label_new"><span class="new">Mới ra mắt</span></div>
                        <?php }?>
          			</div><!-- images-container -->

          			<div class="des-container">				
          			 <div class="name">
          				<a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
          			 </div>
                       <?php if($product['sort_description']){ ?>
                       <a href="<?php echo $product['href']; ?>">
              			 <div class="more_info">
                              <?php echo $product['sort_description']; ?>
                           </div>
                       </a>
                       <?php } ?>
                			 <div class="price">
                        <?php if($product['special']) { ?>
                				        <span class="price-new"><?php echo $product['special']; ?></span>
                				        <span class="price-old"><?php echo $product['price']; ?></span>
                        <?php } else{ ?>
                                <span class="price-new"><?php echo $product['price']; ?></span>
                        <?php } ?>

                			</div>
                       <div class="description">
                          <?php if(isset($product['sale_off'])){ ?>
                            <span class="sale_off">Giảm <?php echo $product['sale_off']; ?></span>
                          <?php } ?>

                          <?php echo $product['gift']; ?>
                       </div>
                			<!--<div class="box-button">
                			  <div class="button-group">	
                					<button class="btn-compare2" type="button"  title="Compare this Product"  onclick="compare.add('<?php echo $product['product_id']; ?>');"><?php echo $button_compare;?><em class="tooltips"><?php echo $button_compare;?></em>
                          </button>
                				  <button class="btn-addtocart" type="button"  title="Add to Cart"   onclick="cart.add('<?php echo $product['product_id']; ?>');"></i><?php echo $button_cart;?></button>
              					  
                        </div>
                			</div>-->
          			</div><!--des-container-->
          		</div>
          </div>
          <?php } ?>

          </div>
        </div>
      </div>
      <div class="row">
        
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div>
      <?php } ?>

      <?php if (!$categories || !$products) { ?>
      <div class="row">
        <div class="col-md-12">
          <?php echo $content_top; ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h3><?php echo $text_empty; ?></h3>
          <div class="buttons">
            <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
          </div>
        </div>
      </div>
      <?php } ?>

      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
