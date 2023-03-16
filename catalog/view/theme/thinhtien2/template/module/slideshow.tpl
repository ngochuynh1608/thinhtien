
        <div class="col-md-3 hidden-sm "></div>
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div  class="banner7">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                      <?php foreach ($banners as $banner) {?>
                            <div class="swiper-slide">
                                <a href="<?php echo $banner['link']; ?>">
                                    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>"/>
                                </a>
                            </div>
                      <?php }?>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>

    <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
        spaceBetween: 100,
        centeredSlides: true,
        autoplay: 4500,
        autoplayDisableOnInteraction: false,
        speed:1000,
    });
    </script>