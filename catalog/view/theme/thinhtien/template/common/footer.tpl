

<div class="left-support _dnw-fixed" style="display:none;margin-right: 0px; width: auto;">
     <div class="inner-support">
        <div class="title-support">TƯ VẤN &amp; ĐẶT HÀNG</div>
        <div class="hotline2">
            <span><?php echo $hotline; ?> - <?php echo $telephone; ?></span>
            <span><?php echo $address; ?></span>
        </div>
        <div class="plain">
             Giờ làm việc 7h30 - 20h30 thứ 2 -7 hàng tuần | info@thinhtien.vn
        </div>
<!--                <img class="supporter" src="/images/supporter.png" alt="">-->
    </div>
    <div class="btn-control">
        <span class="btn-slide-left">&gt;&gt;</span>
        <span class="btn-close">X</span>
    </div>
</div>
<div class="uti">
  <div class="container">
      <div class="row">
          <div class="col-sm-12">
            <div id="cmsblock-19" class="cmsblock">
  			     <div class='description'>
              <div class="support-client">
                <div class="col-sm-6 col-md-3 col-xs-6">
                    <div class="box-container times">
                        <div class="box-inner">
                            <h1>Giờ làm việc</h1>
                            <p>Giờ làm việc : thứ 2 - chủ nhật </p>

                               <p> Sáng  : 7h30 - 11h30</p>
                                
                                <p>Chiều : 13h30 - 18h30</p>
                                
                                <p>(chủ nhật làm đến 17h30 )</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 col-xs-6">
                    <div class="box-container free-shipping">
                        <div class="box-inner">
                            <h1>Giao hàng miễn phí</h1>  
                            <p>Nội thành phố Đà Nẵng</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 col-xs-6">
                    <div class="box-container money-back">
                        <div class="box-inner">
                            <h1>Hỗ trợ cài đặt</h1>
                            <p>Hỗ trợ cài đặt phần mềm trọn đời</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 col-xs-6">
                    <div class="box-container phone">
                        <div class="box-inner">
                            <h1>Cam kết</h1>
                            <p>Cam kết chỉ bán hàng chính hãng</p>
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
<div id="boxes" class="newletter-container ">
<div class="container">
    <div style="" id="dialog" class="window"> 
        <div class="box-newletter"> 
            <div class="box">
                <div class="newletter-title subscribe-title">
                    <h3 class="hidden-sm hidden-xs">Newsletter</h3>
                    <label class="hidden-sm hidden-xs">Đăng ký tin khuyến mãi:</label>
                </div>
                <div class="box-content newleter-content">
                    <div id="frm_subscribe">
                        <form name="subscribe" id="subscribe">
                            <div class="subscribe-content">
                                 <div class="input-box">
                                    <input type="text"  placeholder="Họ tên ......" name="txtname" title="Sign up for newsletter" id="subscribe_email" />
                                </div>
                                 <div class="input-box">
                                    <input type="text" placeholder="Email......" name="txtemail" title="Sign up for newsletter" id="subscribe_email" />
                                </div>
                                <div class="actions-subcribe">
                                    <a class="button" id="subscribe_button">
                                        <span><span>Gửi</span></span>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div><!-- /#frm_subscribe -->
                </div><!-- /.box-content -->
                <script type="text/javascript"><!--
                $('#subscribe_button').on('click', function() {
                	$.ajax({
                		url: 'index.php?route=module/newsletters/news',
                		type: 'post',
                		data: $('#frm_subscribe input[type=\'text\']'),
                		dataType: 'json',
                		success: function(json) {
                        if (json['message']) {
       					 $('#content').parent().before('<div class="alert alert-success thongbao"><i class="fa fa-check-circle"></i> ' + json['message'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                        }
		}

                	});
                });
                //--></script>
                <div id="notification"></div>
            </div>
        </div>
    </div>	
    <div class="link-web">
        <ul>
            <li><a class="face" target="_blank" href="https://www.facebook.com/ThinhTienComputer/">face</a></li>
            <li><a class="google" target="_blank" href="https://plus.google.com/114607418967347421775/about">google</a></li>
            <li><a class="twitter" target="_blank" href="#">twitter</a></li>
            <li><a class="youtube" target="_blank" href="https://www.youtube.com/channel/UCUSV2QehGYzBpy8Hxk9fTcg">youtube</a></li>
        </ul>
    </div>
</div>
<div class="hotline-home" style="display: none">
	<a href="tel:<?php echo $hotline; ?>" rel="nofollow" > <div class="alo-phone alo-green alo-show"> <div class="alo-ph-circle"></div> <div class="alo-ph-circle-fill"></div> <div class="alo-ph-img-circle"></div> </div></a>
</div>
<div style="width: 2000px;top:-808px; height: 2000px; display: none; opacity: 0.7;" id="mask"> </div>
<div class="bottom">&nbsp;</div>

<script type="text/javascript">
function email_subscribe(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=module/newslettersubscribe/subscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				eval(html);
			}}); 
	
	
}
function email_unsubscribe(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=module/newslettersubscribe/unsubscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				eval(html);
			}}); 
	$('html, body').delay( 1500 ).animate({ scrollTop: 0 }, 'slow'); 
	
}
</script>
<script type="text/javascript">
    $(document).ready(function() {
        
        $('#subscribe_email').keypress(function(e) {
            if(e.which == 13) {
                e.preventDefault();
                email_subscribe();
            }
        });
        
	 return ; 
        function setCookie(cname,cvalue,exdays)
        {
            var d = new Date();
            d.setTime(d.getTime()+(exdays*24*60*60*1000));
            var expires = "expires="+d.toGMTString();
            document.cookie = cname+"="+cvalue+"; "+expires;
        }
        function getCookie(cname)
        {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i=0; i<ca.length; i++)
            {
                var c = ca[i].trim();
                if (c.indexOf(name)==0) return c.substring(name.length,c.length);
            }
            return "";
        }

        //transition effect
        if(getCookie("shownewsletter") != 1){
            var id = '#dialog';
            //Get the screen height and width
            var maskHeight = $(document).height();
            var maskWidth = $(window).width();
            //Set heigth and width to mask to fill up the whole screen
            //transition effect
            //Get the window height and width
            var winH = $(window).height();
            var winW = $(window).width();
            //Set the popup window to center
            $(id).css('top',  winH/2-$(id).height()/2 -50);
            $(id).css('left', winW/2-$(id).width()/2);
            $('#mask').fadeIn(800);
            $('#mask').fadeTo("slow",0.8);
            $(id).fadeIn(500);
      
        }else {
            $('#advice-required-entry-newsletter').remove();

            $('#dialog').remove();
            $('#boxes').remove();
        }
        //if close button is clicked
        $('.window .close').click(function (e) {
            //Cancel the link behavior
            e.preventDefault();
            $('#mask').hide();
            $('.window').hide();
            setCookie("shownewsletter",'1',1);
        });

//if mask is clicked
        $('#mask').click(function () {
            $(this).preventDefault();
            $(this).hide();
            $('.window').hide();
            setCookie("shownewsletter",'1',1);
        });
    });
</script>
</div>
</div><!-- /.box -->

      <!-- Your customer chat code -->
<!--       <div class="fb-customerchat"
  attribution=setup_tool
  page_id="468921926532659"
  logged_in_greeting="Chào bạn, chúng tôi có thể giúp gì cho bạn?"
  logged_out_greeting="Chào bạn, chúng tôi có thể giúp gì cho bạn?">
</div> -->
<footer>
  <div class="top-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 ">
          <div class="f-col f-col1">
            <div class="footer-title">
              <h2>THINHTIEN.VN</h2>
            </div>
            <div class="footer-content">
                <div class="fb-page" data-href="https://www.facebook.com/ThinhTienComputer" data-tabs="timeline" data-width="300" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
                  <?php foreach ($informations as $information) { ?>
                  <?php if ($information['sort']==1){ ?>
                    <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                  <?php } ?>
                  <?php } ?>
                </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 ">
          <div class="f-col f-col2">
            <div class="footer-title">
              <h2>Hỗ trợ khách hàng</h2>
            </div>
            <div class="footer-content">
              <ul>
                  <?php foreach ($informations as $information) { ?>
                  <?php if ($information['sort']==2){ ?>
                    <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                  <?php } ?>
                  <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 ">
          <div class="f-col f-col3">
            <div class="footer-title">
              <h2>GIỜ LÀM VIỆC</h2>
            </div>
            <div class="footer-content">
                <?php 
                if(isset($chinhsach['description'])){
                    echo html_entity_decode($chinhsach['description'], ENT_QUOTES, 'UTF-8');
                } ?>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 ">
          <div class="footer-title">
            <h2>Liên hệ với chúng tôi</h2>
          </div>
          <div class="footer-content box-information">
          <ul>
            <li>
              <i class="fa fa-home"></i>
              <p><?php echo $name ?> - <?php echo $address; ?></p>
            </li>
            <!--<li>
              <i class="fa fa-home"></i>
              <p>Hoàng Sports: Số 10 Hàm Nghi - Thanh Khê - Đà Nẵng</p>
            </li>-->
            <li>
              <i class="fa fa-envelope-o"></i>
              <a href="#"><p><?php echo $email; ?></p></a>
            </li>
            <li>
              <i class="fa fa-phone"></i>
              <p><?php echo $hotline; ?> - <?php echo $telephone; ?> </p>
            </li>
            <li>
                <a href="http://online.gov.vn/CustomWebsiteDisplay.aspx?DocId=47888" target="_blank" ><img style="max-width: 200px;" src="catalog/view/theme/thinhtien/image/bocongthuong.png"/></a>
            </li>
          </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="end-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <p class="powered-footer">Copyright © Thịnh Tiến Computer All rights reserved.<br />
                Công ty TNHH Thịnh Tiến - GPKD số 0400406639 - Sở KH & ĐT TP Đà Nẵng cấp ngày: 18/12/2001 
                <br />
                Địa Chỉ: 61 Hoàng Hoa Thám, P. Tân Chính, Q. Thanh khê, Tp. Đà Nẵng
                </p>
              <span><a href="#"></a></span>
              <div class="design" style="float:right;">
                <span>Desgin by <a href="http://ionsite.vn/" target="_blank">IONSITE</a></span>
              </div>
          </div>
        </div>
    </div>
  </div>
</footer>

<script type="text/javascript" src="https://secure.skypeassets.com/i/scom/js/skype-uri.js"></script>

<script type="text/javascript" src="https://secure.skypeassets.com/i/scom/js/skype-uri.js">
<div id="back-top" class="hidden-xs"></div>
<script type="text/javascript">
    $(document).ready(function(){
     // hide #back-top first
     $("#back-top").hide();
     // fade in #back-top
     $(function () {
      $(window).scroll(function () {
       if ($(this).scrollTop() > 300) {
        $('#back-top').fadeIn();
       } else {
        $('#back-top').fadeOut();
       }
      });
      // scroll body to 0px on click
      $('#back-top').click(function () {
       $('body,html').animate({
        scrollTop: 0
       }, 800);
       return false;
      });
     });
    });
</script>
<script class="rs-file" src="catalog/view/theme/thinhtien/javascript/royalslider/assets/royalslider/jquery.royalslider.min.js"></script>
<link class="rs-file" href="catalog/view/theme/thinhtien/javascript/royalslider/assets/royalslider/royalslider.css" rel="stylesheet">
<link class="rs-file" href="catalog/view/theme/thinhtien/javascript/royalslider/assets/royalslider/skins/default/rs-default.css" rel="stylesheet">  
<script src="catalog/view/theme/thinhtien/javascript/opentheme/vermegamenu/custommenu.js" type="text/javascript"></script>
<script src="catalog/view/theme/thinhtien/javascript/common.js" type="text/javascript"></script>
<script src="catalog/view/theme/thinhtien/javascript/jquery.plugin.js" type="text/javascript"></script>
<script src="catalog/view/theme/thinhtien/javascript/opentheme/jquery.bpopup.min.js" type="text/javascript"></script>
<script src="catalog/view/theme/thinhtien/javascript/jquery/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script src="catalog/view/theme/thinhtien/javascript/js/swiper.min.js" type="text/javascript"></script> 
</body>
</html>