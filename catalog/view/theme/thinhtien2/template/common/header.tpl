
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<script src="catalog/view/theme/thinhtien/js/jquery-ui.js" type="text/javascript"></script> 
<link href="catalog/view/theme/thinhtien/javascript/jquery/css/jquery-ui.css" rel="stylesheet" media="screen" />
<link href="catalog/view/theme/thinhtien/css/opentheme/oclayerednavigation/css/oclayerednavigation.css" rel="stylesheet"> 
<script src="catalog/view/theme/thinhtien/js/oclayerednavigation2.js" type="text/javascript"></script> 
<link href="catalog/view/theme/thinhtien/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/theme/thinhtien/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/theme/thinhtien/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700&subset=latin,vietnamese,cyrillic-ext,latin-ext,cyrillic">
<link href="catalog/view/theme/thinhtien/css/opentheme/css/animate.css" rel="stylesheet" />
<link href="catalog/view/theme/thinhtien/css/stylesheet.css" rel="stylesheet">
<script src="catalog/view/theme/thinhtien/js/jquery.elevatezoom.js" type="text/javascript"></script>
<link href="catalog/view/theme/thinhtien/css/opentheme/ocslideshow/ocslideshow.css" rel="stylesheet" />
<script src="catalog/view/theme/thinhtien/js/jquery.nivo.slider.js" type="text/javascript"></script>
<script src="catalog/view/theme/thinhtien/js/opcajaxlogin.js" type="text/javascript"></script>
<link href="catalog/view/theme/thinhtien/css/opentheme/opcajaxlogin/css/opcajaxlogin.css" rel="stylesheet"/> 
<link href="catalog/view/theme/thinhtien/css/opentheme/hozmegamenu/css/custommenu.css" rel="stylesheet" />
<script src="catalog/view/theme/thinhtien/js/mobile_menu.js" type="text/javascript"></script>
<link href="catalog/view/theme/thinhtien/css/opentheme/vermegamenu/css/ocsvegamenu.css" type="text/css" rel="stylesheet" media="screen" />
<link href="catalog/view/theme/thinhtien/css/opentheme/producttab.css" type="text/css" rel="stylesheet" media="screen" />
<link href="catalog/view/theme/thinhtien/css/swiper.css" type="text/css" rel="stylesheet" media="screen" />
<link href="catalog/view/theme/thinhtien/javascript/jquery/owl-carousel/owl.carousel.css" type="text/css" rel="stylesheet" media="screen" />
<script src="catalog/view/theme/thinhtien/javascript/opentheme/vermegamenu/custommenu.js" type="text/javascript"></script>
<script src="catalog/view/theme/thinhtien/js/common.js" type="text/javascript"></script>
<script src="catalog/view/theme/thinhtien/js/jquery.plugin.js" type="text/javascript"></script>
<script src="catalog/view/theme/thinhtien/javascript/opentheme/jquery.bpopup.min.js" type="text/javascript"></script>
<script src="catalog/view/theme/thinhtien/javascript/jquery/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script src="catalog/view/theme/thinhtien/javascript/js/swiper.min.js" type="text/javascript"></script>
<meta property="fb:app_id" content="1763575740564365" />

</head>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-78034860-1', 'auto');
  ga('send', 'pageview');

</script>
<body class="common-home">

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5VS9ZP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5VS9ZP');</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=1763575740564365";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<header>
  <div class="header-container">
    <div class="header-mobile">
        <div class="container">
            <div class="row">
                <div class="col-xs-1 col-sm-1">
                    <a class="menu-mobile-button" href="javascript:void(0)">
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
        <div class="main-mn-m" style="display:none;">
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
          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 ">
            <div id="logo">
              <?php if ($logo) { ?>
              <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
              <?php } else { ?>
              <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
              <?php } ?>
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
                    </script>

                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-2 col-xs-12">
        
            <div class="hotline">
                <h4><?php echo $telephone; ?> - <?php echo $hotline; ?></h4>
            </div>
            <div class="top-cart">
                <div id="cart" class="btn-group btn-block">
                    <a href="<?php echo $cart; ?>">
                    <button type="button"  data-loading-text="Loading..." class="btn btn-inverse btn-block btn-lg dropdown-toggle">
                        <i class="fa fa-shopping-cart"></i>
                        <span id="cart-total"><?php echo $text_items; ?></span>
                    </button>
                    </a>
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
   <div class="col-md-3 hidden-sm "><div class="vermagemenu visible-lg visible-md">
    <div class="content-vermagemenu"> 
        <div class="title-vermgemenu">
            <h2>Danh mục sản phẩm</h2>
        </div>
        <div class="navleft-container " <?php if(in_array($template, array('common/home','product/landingpage'))) echo 'style="display:block;"'; else{echo 'style="display:none;"';} ?> >
            <div id="pt_vmegamenu" class="pt_vmegamenu">
                <?php $i=0;?>
                <?php foreach ($categories as $category) { ?>
                    <div id="pt_ver_menu18" class="pt_ver_menu nav-4 <?php if($category['filter']) echo 'had-child';?>">
                        <div class="parentMenu">
                            <a href="<?php echo $category['href']?>">
                            <span><img src="<?php echo $category['thumb'];?>"/> <?php echo $category['name']?> </span>
                            </a>
                        </div>
                        
                        <div id="popup20" class="popup <?php if($i>2 && count($category['children'])>5) echo 'margin-top';?>" style="display: none; width:865px">
                            <div class="content-popup"><div class="arrow-left-menu"></div>
                            <div class="block1" id="block120">
                                <?php if(count($category['filter'])!=0){ ?>
                                <?php $y=1;?>                        
                                <?php foreach ($category['filter'] as $filter_group) { ?>
                                    <?php if($y%2!=0) echo '<div class="column first col'.$y.'">'; ?>
                                        <div class="itemMenu level1">
                                            <a class="itemMenuName level0 actParent" href="#"><span><?php echo $filter_group['name'];?></span></a>
                                            <div class="itemSubMenu level0">
                                                <div class="itemMenu level1">
                                                    <?php foreach ($filter_group['filter'] as $filter) { ?>
                                                        <input type="checkbox" name="filter[]" value="<?php echo $filter['filter_id']; ?>"/> <?php echo $filter['name']; ?><br/>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        
                                        <?php if($y%2==0 || $y==count($category['filter'])) echo '</div>'; ?>
                                        <?php $y=$y+1;?>
                                    </div>
                                <?php } ?>
                                
                                <div class="column first col2">
                                <input type="hidden" name="<?php echo $i;?>" value="" />
                                  <div class="text-right">
                                    <button type="button" id="button-filter<?php echo $i;?>" class="btn btn-primary">Lọc sản phẩm</button>
                                  </div>
                                </div>
                                <script type="text/javascript"><!--
                                $('#button-filter<?php echo $i;?>').on('click', function() {
                                	filter = [];
                                
                                	$('input[name^=\'filter\']:checked').each(function(element) {
                                		filter.push(this.value);
                                	});
                                
                                	location = 'index.php?route=product/category&path=<?php echo $category['category_id'] ?>&filter=' + filter.join(',');
                                });
                                //--></script>
                                <?php } else{ ?>
                                    <?php $y=1;?>
                                                           
                                    <?php foreach ($category['children'] as $childs) { ?>
                                    <?php if($childs['child']){?>
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
                                        <?php } else{ ?>
                                            <div class="level2" style="width:250px;">
                                                <a class="itemMenuName level0 actParent" href="<?php echo $childs['href'];?>"><span><i class="fa fa-caret-right"></i> <?php echo $childs['name'];?></span></a>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php }?>
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
                        <li><span class=" button-view<?php echo $i;?> collapse<?php echo $i;?>"><a href="<?php echo $category['href'];?>"><?php echo $category['name'];?></a></span>
                        <?php if($category['children']){?>
                            <ul class="level2">
                                <?php foreach ($category['children'] as $childs) { ?>
                                    <li><span class="button-view2   collapse<?php echo $i;?>"><a href="<?php echo $childs['href'];?>"><?php echo $childs['name'];?></a></span></li>
                                <?php } ?>
                            </ul>
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
        			<div id="pt_menu_home" class="pt_menu"><div class="parentMenu"><a href="<?php echo $home; ?>"><span  data-hover="home">Trang chủ</span></a></div></div>
                    <div id ="pt_menu_link258" class ="pt_menu pt_menu_link"><div class="parentMenu" ><a href="<?php echo $information_href; ?>"><span data-hover="">Giới thiệu</span></a></div></div>
                    <div id ="pt_menu_link268" class ="pt_menu pt_menu_link"><div class="parentMenu" ><a href="<?php echo $news_href; ?>"><span data-hover="">Tin tức</span></a></div></div>
                    <div id ="pt_menu_link262" class ="pt_menu pt_menu_link"><div class="parentMenu" ><a href="<?php echo $landing_href; ?>"><span data-hover="">Sản phẩm khuyến mãi</span></a></div></div>
                    <div id ="pt_menu_link262" class ="pt_menu pt_menu_link"><div class="parentMenu" ><a href="<?php echo $guide_href; ?>"><span data-hover="">Hướng dẫn mua hàng</span></a></div></div>
                    <div id ="pt_menu_link262" class ="pt_menu pt_menu_link"><div class="parentMenu" ><a href="<?php echo $contact_href; ?>"><span data-hover="">Liên hệ</span></a></div></div>
    			</div>
    		</div>
    	</div>
    </div>
</div>


</div>  
    

</header>