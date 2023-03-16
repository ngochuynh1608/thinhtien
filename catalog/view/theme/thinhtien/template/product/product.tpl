<?php echo $header; ?>
<link href="catalog/view/theme/thinhtien/css/product.css" rel="stylesheet">
<div id="content" class="container">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="breadcum">
         <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
            <?php } ?>
         </ul>
         <div class="clear"></div>
      </div>
      <!-- End .breadcum -->             
      <div class="prod-cate">
         <article>
            <!-- End .t-prod-d -->
            <div class="col-md-12 col-sm-12">
               <div class="row">
                  <div class="col-md-4 col-sm-8 col-xs-12 ndht">
                     <div id="gallery-1" class="royalSlider rsDefault">
                        <div class="rsSlide"><img class="rsImg" src="<?php echo $thumb; ?>"/><img class="rsTmb" src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>"/></div>
                        <?php if ($images) { ?>
                        <?php foreach ($images as $image) { ?>
                        <div class="rsSlide"><img class="rsImg" src="<?php echo $image['thumb'];?>"/><img class="rsTmb" src="<?php echo $image['thumb'];?>"/></div>
                        <?php } ?>
                        <?php } ?>
                     </div>
                     <meta property="og:url" content="<?php echo $href;?>" />
                     <meta property="og:type" content="product" />
                     <meta property="og:image:alt" content="<?php echo $heading_title; ?>" />
                     <meta property="og:title" content="<?php echo $heading_title; ?>" />
                     <meta property="og:image" content="<?php echo $thumb; ?>" />
                     <meta property="og:description" content="<?php echo $sort_description;?>" />
                     <div class="clear"></div>
                     <style type="text/css">#gallery-1 {}</style>
                     <script id="addJS" type="text/javascript">
                        $(document).ready(function(){
                           $('#gallery-1').royalSlider({
                               fullscreen: {
                               enabled: true,
                               nativeFS: true,
                           },                                  
                           controlNavigation: 'thumbnails',
                           autoScaleSlider: true,
                           loop: false,
                           autoScaleSliderHeight: 534,
                           imageScaleMode: 'fit-if-smaller',
                           imageAlignCenter: true,
                           imageScalePadding: 0,
                           navigateByClick: true,
                           numImagesToPreload:2,
                           arrowsNav:true,
                           arrowsNavAutoHide: true,
                           arrowsNavHideOnTouch: true,
                           keyboardNavEnabled: true,
                           fadeinLoadedSlide: true,
                           globalCaption: false,
                           globalCaptionInside: false,
                           thumbs: {
                                   appendSpan: false,
                                   firstMargin: 0,
                                   spacing: 2,
                                   arrowsAutoHide: true
                               }
                           });
                        });
                     </script>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 side-prod">
                     <div class="tt-2prod">
                        <h1 class="product_name"><?php echo $heading_title; ?></h1>
                        <?php if ($review_status) { ?>
                        <div class="rating">
                           <p>
                              <?php for ($i = 1; $i <= 5; $i++) { ?>
                              <?php if ($rating < $i) { ?>
                              <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                              <?php } else { ?>
                              <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                              <?php } ?>
                              <?php } ?>
                              <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo $reviews; ?></a> / <a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo $text_write; ?></a>
                           </p>
                           <hr>
                        </div>
                        <?php } ?>
                        <?php if (!$special) { ?>
                        <h2 class="price-prod"><?php echo $price; ?> </h2>
                        <span>( Giá trên đã bao gồm VAT)</span>
                        <?php } else { ?>
                        <h2 class="price-prod"><?php echo $special; ?> </h2>
                        <p class="old-price" style="font-size:18px;color:#070707;">Giá:     
                           <span class="price" style="font-size:18px;color:#070707;"><?php echo $price; ?> </span><span>( Giá trên đã bao gồm VAT)</span>
                        </p>
                        <?php } ?>
                        <?php if($stock){?>
                        <strong>
                           <h3><?php echo $stock; ?></h3>
                        </strong>
                        <?php } ?>
                        <?php 
                           if(isset($gift))
                           {
                           ?>
                        <div class="area_promotion zero">
                           <strong data-count="4">Khuyến mãi</strong>
                           <div class="pro-img">
                              <ul class="t4">
                                 <li class="notapply"  data-g="Tặng" data-return="160000">
                                    <?php echo $gift; ?>
                                 </li>
                                 <li class="notapply"  data-g="Tặng" data-return="160000">
                                    <?php if($guarantee) echo '<span> Bảo hành : ' . $guarantee .'</span>';?> 
                                 </li>
                                 <li class="notapply">
                                    <?php if($accessories) echo '<div> Phụ kiện kèm theo : ' . $accessories .'</div>';?>
                                 </li>
                              </ul>
                              <?php if(!empty($url_QR)){ ?> 
                              <img src="<?php echo $url_QR; ?>">
                              <?php } ?>
                           </div>
                        </div>
                        <?php
                           }
                           ?>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12 side-prod">
                     <!-- End .social-prod-d -->
                     <?php  echo $column_right; ?>
                     <!--<div class="wrap-sp">
                        <div id="product">
                           <h4 class="tt-prod"> </h4>
                           <input type="hidden" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control" />
                           <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                           <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary btn-lg btn-block">
                           <?php echo $button_cart; ?><br />
                           </button>
                        </div>
                     </div>-->
                     <!-- End .side-prod -->
                     <div class="clear"></div>
                  </div>
               </div>
            </div>
            <!-- End .i0-cpd -->
            <div class="col-lg-12 col-xs-12 col-sm-12 col-xs-12 clearfix">
               <div class="row">
                  <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class="article_detail">
                        <h4>Bài viết sản phẩm</h4>
                        <div class="article_detail_content" id="article_detail_content" style="height: 300px">
                           <?php echo $description; ?>
                        </div>
                        <div class="readmore" id="readmore">
                           <spa>
                           Xem tiếp</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6" style="float: left;">
                     <div class="attribute">
                        <h4>Thông số kỹ thuật</h4>
                        <?php if ($attribute_groups) { ?>
                        <div class="tab-pane active" id="tab-specification">
                           <table class="table">
                              <?php foreach ($attribute_groups as $attribute_group) { ?>
                              <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                              <tr>
                                 <td><?php echo $attribute['name']; ?></td>
                                 <td><?php echo $attribute['text']; ?></td>
                              </tr>
                              <?php } ?>
                              <?php } ?>
                              <tfoot>
                                 <tr>
                                    <td>Kích thước(Dài x Rộng x Cao):</td>
                                    <?php 
                                       $len=explode('.', $length);
                                       $wid=explode('.', $width);
                                       $heg=explode('.', $height);
                                       $wei=explode('.', $weight);
                                       ?>
                                    <td><?php echo $len[0]; ?> x <?php echo $wid[0]; ?> x <?php echo $heg[0]; ?> cm</td>
                                 </tr>
                                 <tr>
                                    <td>Nặng</td>
                                    <td><?php echo round($weight,2); ?> kg</td>
                                 </tr>
                              </tfoot>
                           </table>
                        </div>
                        <?php } ?>
                     </div>
                     <?php if ($review_status) { ?>
                     <div class="tab-pane" id="tab-review">
                        <form class="form-horizontal">
                           <div id="review"></div>
                           <h2 class="title_review"><?php echo $text_write; ?></h2>
                           <?php if ($review_guest) { ?>
                           <div class="form-group required">
                              <div class="col-sm-12">
                                 <label class="control-label" for="input-name"><?php echo $entry_name; ?></label>
                                 <input type="text" name="name" value="" id="input-name" class="form-control" />
                              </div>
                           </div>
                           <div class="form-group required">
                              <div class="col-sm-12">
                                 <textarea placeholder="Mời bạn nhập bình luận..." name="text" rows="5" id="input-review" class="form-control"></textarea>
                                 <div class="help-block"><?php echo $text_note; ?></div>
                              </div>
                           </div>
                           <div class="form-group required">
                              <div class="col-sm-12">
                                 <label class="control-label"><?php echo $entry_rating; ?></label>
                                 &nbsp;&nbsp;&nbsp; <?php echo $entry_bad; ?>&nbsp;
                                 <input type="radio" name="rating" value="1"  />
                                 &nbsp;
                                 <input type="radio" name="rating" value="2" />
                                 &nbsp;
                                 <input type="radio" name="rating" value="3" />
                                 &nbsp;
                                 <input type="radio" name="rating" value="4" />
                                 &nbsp;
                                 <input type="radio" name="rating" value="5" checked=""/>
                                 &nbsp;<?php echo $entry_good; ?>
                              </div>
                           </div>
                           <?php if ($site_key) { ?>
                           <div class="form-group">
                              <div class="col-sm-12">
                                 <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="buttons clearfix">
                              <div class="pull-left">
                                 <button type="button" id="button-review" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-success"><?php echo $button_continue; ?></button>
                              </div>
                           </div>
                           <?php } else { ?>
                           <?php echo $text_login; ?>
                           <?php } ?>
                        </form>
                     </div>
                     <?php } ?>
                  </div>
               </div>
               <?php if ($products) { ?>
               <div class="col-sm-12">
                  <div class="ttcountdown_module">
                     <div class="countdown-title module-title">
                        <h3 class="title-group"><?php echo $text_related; ?></h3>
                     </div>
                     <div class="product-layout">
                        <div class="row">
                           <div class="countdown-tab-content">
                              <div class="countdown-product-inner2">
                                 <?php foreach ($products as $product) { ?>
                                 <div class="timer-item">
                                    <div class="item-inner">
                                       <div class="images-container">
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
                                          <div class="label_new"><span class="new">new</span></div>
                                          <?php }?>
                                       </div>
                                       <!-- images-container -->
                                       <div class="des-container">
                                          <div class="name">
                                             <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                                          </div>
                                          <div class="description"></div>
                                          <div class="price">
                                             <?php if($product['special']) { ?>
                                             <span class="price-new"><?php echo $product['special']; ?></span>
                                             <span class="price-old"><?php echo $product['price']; ?></span>
                                             <?php } else{ ?>
                                             <span class="price-new"><?php echo $product['price']; ?></span>
                                             <?php } ?>
                                          </div>
                                          <div class="box-button">
                                             <div class="button-group"> 
                                                <button class="btn-compare2" type="button"  title="So sánh"  onclick="compare.add('<?php echo $product['product_id']; ?>');"><?php echo $button_compare;?><em class="tooltips"><?php echo $button_compare;?></em></button>
                                             </div>
                                             <button class="btn-addtocart" type="button"  title="Add to Cart"   onclick="cart.add('<?php echo $product['product_id']; ?>');"><?php echo $button_cart;?></button>
                                          </div>
                                       </div>
                                       <!--des-container-->
                                    </div>
                                 </div>
                                 <!-- timer-item -->
                                 <?php } ?>
                              </div>
                           </div>
                           <!-- countdown-product-inner -->
                        </div>
                        <!-- countdown-tab-content -->
                     </div>
                  </div>
                  <script type="text/javascript">
                     $('.countdown-product-inner2').owlCarousel({
                       autoPlay : false,
                       items : 5,
                       itemsDesktop : [1199,4],
                       itemsDesktopSmall : [991,3],
                       itemsTablet: [767,2],
                       itemsMobile : [479,1],
                       slideSpeed : 3000,
                       paginationSpeed : 3000,
                       rewindSpeed : 3000,
                       navigation : true,
                       stopOnHover : true,
                       pagination : false,
                       scrollPerPage:true,
                       afterMove: function(){
                         x = $( ".countdown-tab-content .owl-pagination .owl-page" ).index( $( ".countdown-tab-content .owl-pagination .active" ));
                         var thumbinner = ".thumbinner"+x;
                         $(".list-thumb .thumb li").removeClass('active');
                         $(thumbinner).addClass('active');
                       }
                     });
                  </script>
               </div>
            </div>
            <?php } ?>
      </div>
   </div>
   <!-- End .info-cpd -->
   </article>
   <!-- End .cont-prod -->
</div>
</div><!-- End .min-wrap -->
</div>
</div><!-- End .container -->
<script type="text/javascript">
   $('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
    $.ajax({
        url: 'index.php?route=product/product/getRecurringDescription',
        type: 'post',
        data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
        dataType: 'json',
        beforeSend: function() {
            $('#recurring-description').html('');
        },
        success: function(json) {
            $('.alert, .text-danger').remove();
   
            if (json['success']) {
                $('#recurring-description').html(json['success']);
            }
        }
    });
   });
   
</script>
<script type="text/javascript"><!--
   $('#button-cart').on('click', function() {
    $.ajax({
        url: 'index.php?route=checkout/cart/add',
        type: 'post',
        data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
        dataType: 'json',
        beforeSend: function() {
            $('#button-cart').button('loading');
        },
        complete: function() {
            $('#button-cart').button('reset');
        },
        success: function(json) {
            $('.alert, .text-danger').remove();
            $('.form-group').removeClass('has-error');
   
            if (json['error']) {
                if (json['error']['option']) {
                    for (i in json['error']['option']) {
                        var element = $('#input-option' + i.replace('_', '-'));
   
                        if (element.parent().hasClass('input-group')) {
                            element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                        } else {
                            element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                        }
                    }
                }
   
                if (json['error']['recurring']) {
                    $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                }
   
                // Highlight any found errors
                $('.text-danger').parent().addClass('has-error');
            }
   
            if (json['success']) {
                   window.location.href ='index.php?route=checkout/checkout';
            }
               else{
   
               }
        }
    });
   });
   //-->
</script>
<script type="text/javascript"><!--
   $('button[id^=\'button-upload\']').on('click', function() {
    var node = this;
   
    $('#form-upload').remove();
   
    $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');
   
    $('#form-upload input[name=\'file\']').trigger('click');
   
    if (typeof timer != 'undefined') {
        clearInterval(timer);
    }
   
    timer = setInterval(function() {
        if ($('#form-upload input[name=\'file\']').val() != '') {
            clearInterval(timer);
   
            $.ajax({
                url: 'index.php?route=tool/upload',
                type: 'post',
                dataType: 'json',
                data: new FormData($('#form-upload')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(node).button('loading');
                },
                complete: function() {
                    $(node).button('reset');
                },
                success: function(json) {
                    $('.text-danger').remove();
   
                    if (json['error']) {
                        $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
                    }
   
                    if (json['success']) {
                        alert(json['success']);
   
                        $(node).parent().find('input').attr('value', json['code']);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    }, 500);
   });
   //-->
</script>
<script type="text/javascript"><!--
   $('#review').delegate('.pagination a', 'click', function(e) {
     e.preventDefault();
   
       $('#review').fadeOut('slow');
   
       $('#review').load(this.href);
   
       $('#review').fadeIn('slow');
   });
   
   $('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');
   
   $('#button-review').on('click', function() {
    $.ajax({
        url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
        type: 'post',
        dataType: 'json',
        data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : ''),
        beforeSend: function() {
            $('#button-review').button('loading');
        },
        complete: function() {
            $('#button-review').button('reset');
        },
        success: function(json) {
   
            $('.alert-success, .alert-danger').remove();
   
            if (json['error']) {
                $('#review').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
            }
   
            if (json['success']) {
                $('#review').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
   
                $('input[name=\'name\']').val('');
                $('textarea[name=\'text\']').val('');
                $('input[name=\'rating\']:checked').prop('checked', false);
            }
        }
    });
   });
   
   $('#readmore').on('click', function(){
      $('#article_detail_content').css('height','auto');
      $(this).css('display','none');
   });
   //-->
</script>
</div>
</div>
<?php echo $footer; ?>