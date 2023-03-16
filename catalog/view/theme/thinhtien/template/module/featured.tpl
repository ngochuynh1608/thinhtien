<div id="content" class="col-sm-12">

<script type="text/javascript">

$(document).ready(function() {
      $(".owl-demo-tabproduct").owlCarousel({
    	autoPlay: true,  //Set AutoPlay to 3 seconds
    	items : 5,
    	slideSpeed : 2000,
    	navigation : true,
    	paginationNumbers : true,
    	pagination : false,
    	stopOnHover : false,
    	itemsDesktop : [1199,4],
    	itemsDesktopSmall : [991,3],
    	itemsTablet: [767,2],
    	itemsMobile : [479,1],
      margin:1,
      });
});

</script>
<div class="product-tabs-container-slider">
  <div class="row">
    <div class="col-md-12"><h3 class="title-group"><?php echo $heading_title; ?></h3></div>
  </div>
	<div class="row">
    <div class="col-md-12">
		<div class="tab_container"> 
		      <div class="tab_content">
				<ul class="owl-demo-tabproduct">
                  <?php foreach ($products as $product) { ?>
				    <li class='row_item'><ul>		
                        <li class="item item-inner">
				            <div class="image">
    							<a href="<?php echo $product['href']; ?>">
    								<img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" />
    							</a>
    						</div>
                             <?php if($product['sort_description']){ ?>
                             <a href="<?php echo $product['href']; ?>">
                    			 <div class="more_info">
                                    <?php echo $product['sort_description']; ?>
                                 </div>
                             </a>
                             <?php } ?>
                            <?php if($product['percent']!=100){?>
							<div class="sale-off">
							     <div class="sale-percent">-<?php echo $product['percent']; ?>%</div>
							</div>
                            <?php } ?>

                <?php 
                     $now = time(); // or your date as well
                     $your_date = strtotime($product['date_added']);
                     $datediff = $now - $your_date;
                     $days=floor($datediff/(60*60*24));
                     if($days < 7){
                 ?>
                    <div class="label_new"><span class="new">Mới ra mắt</span></div>
                  <?php }?>
							<div class="caption des-container">


                <div class="name">
                  <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                </div>		
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
                    <button class="btn-compare2" type="button"  title="So sánh"  onclick="compare.add('<?php echo $product['product_id']; ?>');"><?php echo $button_compare;?><em class="tooltips"><?php echo $button_compare;?></em></button>
                    <button class="btn-addtocart" type="button"  title="Giỏ hàng"   onclick="cart.add('<?php echo $product['product_id']; ?>');"><?php echo $button_cart;?></button>
                  </div>					
    							</div>
    						</div>-->
    					</li>
					</ul></li>
                  <?php } ?>
				    </ul>
				</ul>
			</div> <!-- end new products -->
      </div>
		</div> <!-- .tab_container -->
	</div>
</div> <!-- End New Product -->
</div>