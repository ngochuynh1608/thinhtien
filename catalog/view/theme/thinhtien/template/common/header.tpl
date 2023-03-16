<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?php echo $title; ?></title>
      <base href="<?php echo $base; ?>" />
      <?php if ($description) { ?>
      <meta name="description" content="<?php echo $description; ?>" />
      <?php } ?>
      <?php if ($keywords) { ?>
      <meta name="keywords" content= "<?php echo $keywords; ?>" />
      <?php } ?>

      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <?php if ($icon) { ?>
      <link href="<?php echo $icon; ?>" rel="icon" />
      <?php } ?>
      <?php foreach ($links as $link) { ?>
      <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
      <?php } ?>
      <script type="text/javascript">
         //<![CDATA[
         var CUSTOMMENU_POPUP_EFFECT = 1;
         var CUSTOMMENU_POPUP_TOP_OFFSET = 20;//]]>
      </script>
      <script src="catalog/view/theme/thinhtien/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
      <script src="catalog/view/theme/thinhtien/javascript/jquery/jquery-ui.js" type="text/javascript"></script> 
      <link href="catalog/view/theme/thinhtien/javascript/jquery/css/jquery-ui.css" rel="stylesheet" media="screen" />
      <link href="catalog/view/theme/thinhtien/css/opentheme/oclayerednavigation/css/oclayerednavigation.css" rel="stylesheet">
      <script src="catalog/view/theme/thinhtien/javascript/opentheme/oclayerednavigation/oclayerednavigation2.js" type="text/javascript"></script> 
      <link href="catalog/view/theme/thinhtien/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
      <script src="catalog/view/theme/thinhtien/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=vietnamese" rel="stylesheet">
      <link href="catalog/view/theme/thinhtien/css/opentheme/css/animate.css" rel="stylesheet" />
      <link href="catalog/view/theme/thinhtien/css/stylesheet.css" rel="stylesheet">
      <script src="catalog/view/theme/thinhtien/javascript/jquery/elevatezoom/jquery.elevatezoom.js" type="text/javascript"></script>
      <link href="catalog/view/theme/thinhtien/css/opentheme/ocslideshow/ocslideshow.css" rel="stylesheet" />
      <script src="catalog/view/theme/thinhtien/javascript/opentheme/ocslideshow/jquery.nivo.slider.js" type="text/javascript"></script>
      <script src="catalog/view/theme/thinhtien/javascript/opentheme/opcajaxlogin/opcajaxlogin.js" type="text/javascript"></script>
      <link href="catalog/view/theme/thinhtien/css/opentheme/opcajaxlogin/css/opcajaxlogin.css" rel="stylesheet"/>
      <link href="catalog/view/theme/thinhtien/css/opentheme/hozmegamenu/css/custommenu.css" rel="stylesheet" />
      <script src="catalog/view/theme/thinhtien/javascript/opentheme/hozmegamenu/mobile_menu.js" type="text/javascript"></script>
      <script src="catalog/view/theme/thinhtien/javascript/opentheme/hozmegamenu/custommenu.js" type="text/javascript"></script>
      <link href="catalog/view/theme/thinhtien/css/opentheme/vermegamenu/css/ocsvegamenu.css" rel="stylesheet" />
      <script src="catalog/view/theme/thinhtien/javascript/opentheme/owl-carousel/owl.carousel.js" type="text/javascript"></script>
      <link href="catalog/view/theme/thinhtien/css/opentheme/css/owl.carousel.css" rel="stylesheet" />
      <link href="catalog/view/theme/thinhtien/css/opentheme/vermegamenu/css/ocsvegamenu.css" type="text/css" rel="stylesheet" media="screen" />
      <link href="catalog/view/theme/thinhtien/javascript/jquery.countdown.css" type="text/css" rel="stylesheet" media="screen" />
      <link href="catalog/view/theme/thinhtien/css/opentheme/producttab.css" type="text/css" rel="stylesheet" media="screen" />
      <link href="catalog/view/theme/thinhtien/css/swiper.css" type="text/css" rel="stylesheet" media="screen" />
      <link href="catalog/view/theme/thinhtien/javascript/jquery/owl-carousel/owl.carousel.css" type="text/css" rel="stylesheet" media="screen" />
      <script src="catalog/view/theme/thinhtien/javascript/opentheme/vermegamenu/custommenu.js" type="text/javascript"></script>
      <script src="catalog/view/theme/thinhtien/javascript/common.js" type="text/javascript"></script>
      <script src="catalog/view/theme/thinhtien/javascript/jquery.plugin.js" type="text/javascript"></script>
      <script src="catalog/view/theme/thinhtien/javascript/opentheme/jquery.bpopup.min.js" type="text/javascript"></script>
      <script src="catalog/view/theme/thinhtien/javascript/jquery/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
      <script src="catalog/view/theme/thinhtien/javascript/js/swiper.min.js" type="text/javascript"></script>
      <meta property="fb:app_id" content="1763575740564365" />
      
   <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      
      ga('create', 'UA-78034860-1', 'auto');
      ga('send', 'pageview');
      
   </script>
   <body class="common-home">


   </head>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=1073484599365702&autoLogAppEvents=1"></script>

      <div class="order-mb">
         <h3><a href="tel:<?php echo $telephone; ?>"> <?php echo $telephone; ?></a></h3>
      </div>
      <!-- Google Tag Manager -->
      <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5VS9ZP"
         height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
         new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
         j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
         '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
         })(window,document,'script','dataLayer','GTM-5VS9ZP');
      </script>
      <header>
         <div class="header-container">
            <div class="header-mobile">
               <div class="container">
                  <div class="row">
                     <div class="col-xs-1 col-sm-1">
                        <a class="menu-mobile-button" href="javascript:void(0)" data-toggle="collapse" data-target="#mm-menu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        </a>
                        <a class="menu-mobile-button-hidden" href="javascript:void(0)" style="display:none;">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                     </div>
                     <div class="col-sm-2 col-xs-3 col-sp-4">
                        <div id="logo-mobile">
                          <?php if ($logo) { ?>
                           <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
                           <?php } else { ?>
                           <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
                           <?php } ?> 
                           <!-- <a href="<?php echo $home; ?>"><img src="catalog/view/theme/thinhtien/image/ttc_2020.png" title="Thịnh Tiến Computer" alt="Thịnh Tiến Computer" class="img-responsive" /></a> -->
                        </div>
                     </div>
                     <div class="col-sm-9 col-xs-8 col-sp-12">
                        <div class="quick-access">
                           <div id="search-by-category" class="input-group">
                              <div class="search-container">
                                 <input type="text" name="search" id="text-search" value="" placeholder="Tìm kiếm sản phẩm mong muốn..." class="form-control input-lg"  />
                                 <span id="sp-btn-search" class="input-group-btn">
                                 <button type="button" id="btn-search-category" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
                                 </span>
                                 <script type="text/javascript"><!--
                                    $('#btn-search-category').bind('click', function() {
                                      url = 'index.php?route=product/search';
                                    
                                      var search = $('.search-container input[name=\'search\']').prop('value');
                                    
                                      if (search) {
                                        url += '&search=' + encodeURIComponent(search);
                                      }
                                      var category_id = $('.search-container select[name=\'category_id\']').prop('value');
                                    
                                      if (category_id > 0) {
                                        url += '&category_id=' + encodeURIComponent(category_id);
                                      }
                                    
                                      var sub_category = $('.search-container input[name=\'sub_category\']:checked').prop('value');
                                    
                                      if (sub_category) {
                                        url += '&sub_category=true';
                                      }
                                      location = url;
                                    });
                                 </script>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="main-mn-m" id="mm-menu">
                  <ul class="ul-mf-m">
                     <?php foreach ($categories as $category) { ?>
                     <li class="mobile_menu_item menu-block">
                        <a href="<?php echo $category['href'];?>">
                        <img class="icon-mn" src="<?php echo $category['thumb'];?>" alt=" <?php echo $category['name'];?>">
                        <span><?php echo $category['name'];?></span>
                        </a>
                     </li>
                     <?php } ?>  
                  </ul>
                  <div class="clear"></div>
               </div>
            </div>
            <div class="container hidden-xs hidden-md2">
               <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 brand ">
                     <div id="logo">
                        <?php if ($logo) { ?>
                        <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
                        <?php } else { ?>
                        <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
                        <?php } ?> 
                        <!-- <a href="<?php echo $home; ?>"><img src="catalog/view/theme/thinhtien/image/ttc_2020.png" title="Thịnh Tiến Computer" alt="Thịnh Tiến Computer" class="img-responsive" /></a> -->
                     </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-xs-12 col-sm-7 ">
                     <div class="quick-access">
                        <div id="search-by-category" class="input-group">
                           <div class="search-container">
                              <div class="categories-container">
                                 <div class="hover-cate">
                                    <select name="category_id" class="form-control" style="width:100%;border:none;box-shadow:none;">
                                       <option value="0"><?php echo $text_category; ?></option>
                                       <?php foreach ($categories as $category_1) { ?>
                                       <option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                              </div>
                              <input type="text" name="search" id="text-search-value" value="" placeholder="Tìm kiếm sản phẩm mong muốn..." class="form-control input-lg"  />
                              <span id="sp-btn-search" class="input-group-btn">
                              <button type="button" id="btn-search" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
                              </span>
                              <script type="text/javascript"><!--
                                 $('#btn-search').bind('click', function() {
                                  url = 'index.php?route=product/search';
                                 
                                  var search = $('#text-search-value').val();
                                 
                                  if (search) {
                                    url += '&search=' + encodeURIComponent(search);
                                  }

                                  var category_id = $('.search-container select[name=\'category_id\']').prop('value');
                                 
                                  if (category_id > 0) {
                                    url += '&category_id=' + encodeURIComponent(category_id);
                                  }
                                 
                                  var sub_category = $('.search-container input[name=\'sub_category\']:checked').prop('value');
                                 
                                  if (sub_category) {
                                    url += '&sub_category=true';
                                  }
                                  location = url;
                                 });
                                 $('#search-by-category input[name=\'search\']').on('keydown', function(e) {
                                  if (e.keyCode == 13) {
                                    url = 'index.php?route=product/search';
                                 
                                  var search = $('#text-search-value').val();
                                 
                                  if (search) {
                                    url += '&search=' + encodeURIComponent(search);
                                  }

                                  var category_id = $('.search-container select[name=\'category_id\']').prop('value');
                                 
                                  if (category_id > 0) {
                                    url += '&category_id=' + encodeURIComponent(category_id);
                                  }
                                 
                                  var sub_category = $('.search-container input[name=\'sub_category\']:checked').prop('value');
                                 
                                  if (sub_category) {
                                    url += '&sub_category=true';
                                  }
                                  location = url;
                                  }
                                });
                              </script>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-2 col-xs-12">
                     <div class="top-cart">
                        <div id="cart" class="btn-group btn-block">
                           <a href="<?php echo $cart; ?>">
                              <button type="button"  data-loading-text="Loading..." class="btn dropdown-toggle">
                                 <i class="fa fa-shopping-cart"></i>
                                 <span id="cart-total"><?php echo $text_items; ?></span>
                                 <h5>Giỏ hàng của bạn</h5>
                                 <span>Giao hàng toàn quốc</span>
                              </button>
                           </a>
                           <ul>
                              <div class="cart-view">
                                 <li></li>
                              </div>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-9">
                     <ul class="info_header">
                        <li><i class="fa fa-home"> </i> <?php echo $address; ?></li>
                        <li><i class="fa fa-clock-o"> </i> <?php echo $open; ?></li>
                        <li><i class="fa fa-envelope-o"> </i> <?php echo $email; ?></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="block-menu2 hidden-xs hidden-md2">
           <div class="container">
                <div class="row">
                 <div class="col-md-3 hidden-sm ">
                    <div class="vermagemenu visible-lg visible-md">
                       <div class="content-vermagemenu">
                          <div class="title-vermgemenu">
                             <h2>Danh mục sản phẩm</h2>
                          </div>
                          <div class="navleft-container " <?php if(in_array($template, array('common/home','product/landingpage'))) echo 'style="display:block;"'; else{echo 'style="display:none;"';} ?> >
                             <div id="pt_vmegamenu" class="pt_vmegamenu">
                                <?php $i=0;?>
                                <?php foreach ($categories as $category) { ?>
                                <div id="pt_ver_menu18" class="pt_ver_menu nav-4 <?php if($category['children']) echo 'had-child';?>">
                                   <div class="parentMenu">
                                      <a href="<?php echo $category['href']?>">
                                      <span><?php echo $category['name']?> </span>
                                      </a>
                                   </div>
                                   <div id="popup20" class="popup" style="display: none; width:865px">
                                      <div class="content-popup">
                                         <div class="arrow-left-menu"></div>
                                         <div class="block1" id="block120">
                                            <?php $y=1;?>
                                            <?php foreach ($category['children'] as $childs) { ?>
                                            <div class="column2 first col<?php echo $y; ?>">
                                               <div class="itemMenu level1">
                                                  <a class="itemMenuName level0 actParent" href="<?php echo $childs['href'];?>"><span><?php echo $childs['name'];?></span></a>
                                                  <div class="itemSubMenu level0">
                                                     <div class="itemMenu level1">
                                                        <?php foreach ($childs['child'] as $child) { ?>
                                                        <a href="<?php echo $child['href'];?>"> <?php echo $child['name']; ?></a>
                                                        <?php } ?>
                                                     </div>
                                                  </div>
                                               </div>
                                            </div>
                                            <?php $y=$y+1;?>
                                            <?php } ?>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                                <?php $i=$i+1;?>
                                <?php }?>
                             </div>
                          </div>
                       </div>
                    </div>
                    <script type="text/javascript">
                       $('.vermagemenu h2').click(function () {
                           $( ".navleft-container" ).slideToggle("slow");
                       });
                    </script>
                    <script type="text/javascript">
                       $(function () {
                            $(window).scroll(function () {
                             if ($(this).scrollTop() > 250) {
                              $('.block-menu2').addClass("fix-nav");
                              <?php if($template =='common/home' || $template =='product/landingpage') echo '$( ".navleft-container" ).slideUp("slow");'; ?>
                             } else {
                              $('.block-menu2').removeClass("fix-nav");
                              <?php if($template =='common/home' || $template =='product/landingpage') echo '$( ".navleft-container" ).slideDown("slow");'; ?>
                             }
                            });
                           });
                       $(function () {
                            $(window).scroll(function () {
                             if ($(this).scrollTop() > 250) {
                              $('.quick-access').addClass("fix-header");
                             } else {
                              $('.quick-access').removeClass("fix-header");
                             }
                            });
                           });
                    </script>
                 </div>
                 <div class="col-md-9 col-sm-12">
                    <div class="ma-nav-mobile-container hidden-lg hidden-md visible-sm visible-xs">
                       <div class="">
                          <div class="hozmenu">
                             <div class="navbar">
                                <div id="navbar-inner" class="navbar-inner navbar-inactive">
                                   <div class="menu-mobile">
                                      <a class="btn btn-navbar navbar-toggle">
                                      <span class="icon-bar"></span>
                                      <span class="icon-bar"></span>
                                      <span class="icon-bar"></span>
                                      </a>
                                      <span class="brand navbar-brand">Danh mục sản phẩm</span>
                                   </div>
                                   <div id="wrap-ma-mobilemenu" class="mobilemenu nav-collapse collapse">
                                      <ul id="ma-mobilemenu" class="mobilemenu nav-collapse collapse">
                                         <?php $i=1;?>
                                         <?php foreach ($categories as $category) { ?>
                                         <li>
                                            <span class=" button-view<?php echo $i;?> collapse<?php echo $i;?>"><a href="<?php echo $category['href'];?>"><?php echo $category['name'];?></a></span>
                                            <?php if($category['children']){ ?>
                                            <ul class="level2">
                                               <?php foreach ($category['children'] as $childs) { ?>
                                               <li><span class="button-view2   collapse<?php echo $i;?>"><a href="<?php echo $childs['href'];?>"><?php echo $childs['name'];?></a></span></li>
                                               <?php } ?>
                                            </ul>
                                          </li>
                                            <?php } ?>
                                            <?php   } ?>
                                      </ul>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="nav-container visible-lg visible-md hidden-sm hidden-xs">
                       <div class="">
                          <div class="nav1">
                             <div class="nav2">
                                <div id="pt_custommenu" class="pt_custommenu">
                                   <div id="pt_menu_home" class="pt_menu">
                                      <div class="parentMenu"><a href="<?php echo $home; ?>"><span  data-hover="home">Trang chủ</span></a></div>
                                   </div>
                                   <div id ="pt_menu_link258" class ="pt_menu pt_menu_link">
                                      <div class="parentMenu" ><a href="<?php echo $information_href; ?>"><span data-hover="">Giới thiệu</span></a></div>
                                   </div>
                                   <div id ="pt_menu_link268" class ="pt_menu pt_menu_link">
                                      <div class="parentMenu" ><a href="<?php echo $news_href; ?>"><span data-hover="">Tin tức</span></a></div>
                                   </div>
                                   <div id ="pt_menu_link262" class ="pt_menu pt_menu_link">
                                      <div class="parentMenu" ><a href="<?php echo $landing_href; ?>"><span data-hover="">Săn khuyến mãi</span></a></div>
                                   </div>
                                   <div id ="pt_menu_link262" class ="pt_menu pt_menu_link">
                                      <div class="parentMenu" ><a href="<?php echo $guide_href; ?>"><span data-hover="">Hướng dẫn mua hàng</span></a></div>
                                   </div>
                                   <div id ="pt_menu_link262" class ="pt_menu pt_menu_link">
                                      <div class="parentMenu" ><a href="<?php echo $contact_href; ?>"><span data-hover="">Liên hệ</span></a></div>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
                </div>
            </div>
         </div>
      </header>