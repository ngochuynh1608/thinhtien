
function getURLVar(key) {
	var value = [];

	var query = String(document.location).split('?');

	if (query[1]) {
		var part = query[1].split('&');

		for (i = 0; i < part.length; i++) {
			var data = part[i].split('=');

			if (data[0] && data[1]) {
				value[data[0]] = data[1];
			}
		}

		if (value[key]) {
			return value[key];
		} else {
			return '';
		}
	}
}

$(document).ready(function() {
    var wWindow = $(window).width();
    var $btn_left = $('.btn-control .btn-slide-left');
    var $btn_close = $('.btn-control .btn-close');
    var $panel_left_sp = $('.left-support');
    var wpanel_left_sp = $panel_left_sp.width();
    var move = 'left';
    var close = 0;
    function moveClick(){
        $btn_left.on('click', function(){
            if(move=='left'){
                move = 'right';
                $(this).text('<<');
                if(wWindow < 450){
                    $panel_left_sp.animate({'margin-right':'-'+wWindow+'px'}, 500);
                    $panel_left_sp.css({'width':wWindow});
                    $('.btn-control').css({'left': '-20px', 'transform':'translate(0,0)', '-moz-transform':'translate(0,0)', '-ms-transform':'translate(0,0)', '-o-transform':'translate(0,0)', '-webkit-transform':'translate(0,0)'});
                    $('.btn-control span').css({'display': 'block'});
                }
                else{
                    $panel_left_sp.animate({'margin-right':'-'+wpanel_left_sp+'px'}, 500);
                    $panel_left_sp.css({'width':'auto'});
                }
            }else{
                $panel_left_sp.animate({'margin-right':'0px'}, 500);
                move = 'left';
                $(this).text('>>');
                 if(wWindow < 450){
                    $panel_left_sp.css({'width':wWindow});
                    $('.btn-control').css({'left': '50%',  'transform':'translate(-50%,0)', '-moz-transform':'translate(-50%, 0)', '-ms-transform':'translate(-50%, 0)', '-o-transform':'translate(-50%, 0)', '-webkit-transform':'translate(-50%, 0)'});
                    $('.btn-control span').css({'display': 'inline-block'});
                }
                // else{
                //     $panel_left_sp.css({'width':'auto'});
                // }
            }
        });
    }
    
    moveClick();
    $(window).resize(function(){
        wWindow = $(this).width();
         if(wWindow < 450){
                $panel_left_sp.css({'width':wWindow});
            }else{
                $panel_left_sp.css({'width':'auto'});
            }
    });
    $btn_close.on('click', function(){
        $panel_left_sp.fadeOut(500);
        close = 1;
    });
    $('.continue').alert('close');
	//fixed top menu
	$(window).scroll(function () {if ($(this).scrollTop() > 250) {
		$('.quick-access').addClass("fix-header");
		} else {
		$('.quick-access').removeClass("fix-header");
		}
	});
    $('#close_filter').on('click', function() {
        $('.panel').slideToggle();
    });
	// zoom
	$(".thumbnails-image img").elevateZoom({
		zoomType : "window",
		cursor: "crosshair",
		gallery:'gallery_01', 
		galleryActiveClass: "active", 
		imageCrossfade: true,
		responsive: true,
		zoomWindowWidth: 360,
		zoomWindowHeight: 360,
		zoomWindowOffetx: 0,
		zoomWindowOffety: 0
	});

	//related products
	$(".view-related").owlCarousel({
		autoPlay : false,
		slideSpeed : 3000,
		paginationSpeed : 3000,
		rewindSpeed : 3000,
		navigation : true,
		stopOnHover : true,
		pagination : false,
		scrollPerPage:false,
		items : 4,
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [991,2],
		itemsTablet: [768,2],
		itemsMobile : [400,1],
	});
    //search
      $("input[name='search']").autocomplete({
        source: function(e, n) {
            $.ajax({
                url: "index.php?route=module/livesearchlite&filter_name=" + encodeURIComponent(e),
                dataType: "json",
                success: function(e) {
                    n($.map(e, function(e) {
                        return {
                            label: e.name,
                            value: e.href,
                            image: e.thumb,
                            priceitem: e.price
                            
                        }
                    })), $("#search ul li").addClass("col-sm-12")
                }
            })
        },
        select: function(e) {
            window.location = e.value
        }
        });      

 // slider 
    $(".menu-mobile-button").click(function(e) {
		$(".main-mn-m").show();
		$(".menu-mobile-button-hidden").show();
		$(".menu-mobile-button").hide();
	});
	$(".menu-mobile-button-hidden").click(function(e) {
		$(".main-mn-m").hide();
		$(".menu-mobile-button").show();
		$(".menu-mobile-button-hidden").hide();
	});
	$(".image-additional").owlCarousel({
		navigation:true,
		pagination: false,
		slideSpeed : 1000,
		goToFirstSpeed : 1500,
		autoHeight : true,
		items :4, //10 items above 1000px browser width
		itemsDesktop : [1199,4], //5 items between 1000px and 901px
		itemsDesktopSmall : [991,4], //4.3 betweem 900px and 601px
		itemsTablet: [767,3], //2 items between 600 and 0
		itemsMobile : [479,2] // itemsMobile disabled - inherit from itemsTablet option
	});	

	//filter click menu
	$('div.filter-attribute-container-title label').addClass("ttopen");
	$('div.filter-attribute-container-title label').click(function() { 
		if ($(this).hasClass('ttopen')) {
			varche = true
		} else {
			varche = false
		};

		if(varche == false) {
			$(this).addClass("ttopen");
			$(this).removeClass("ttclose");
			$(this).parent().parent().find('div.list-group-item ').slideDown();
			varche = true;
		} else {	
			$(this).removeClass("ttopen");
			$(this).addClass("ttclose");
			$(this).parent().parent().find('div.list-group-item ').slideUp();
			varche = false;
		}
	});	

    //top-cart show subnav on hover
		$('#cart').mouseenter(function() {
			$(this).find(".dropdown-menu").stop(true, true).slideDown();
		});
		//hide submenus on exit
		$('#cart').mouseleave(function() {
			$(this).find(".dropdown-menu").stop(true, true).slideUp();
		});

	//top-currency show subnav on hover
		$('#top-links .currency').mouseenter(function() {
			$(this).find(".dropdown-menu").stop(true, true).slideDown();
		});
		//hide submenus on exit
		$('#top-links .currency').mouseleave(function() {
			$(this).find(".dropdown-menu").stop(true, true).slideUp();
		});

	//top-languge show subnav on hover
		$('#top-links .form-language').mouseenter(function() {
			$(this).find(".dropdown-menu").stop(true, true).slideDown();
		});
		//hide submenus on exit
		$('#top-links .form-language').mouseleave(function() {
			$(this).find(".dropdown-menu").stop(true, true).slideUp();
		});

	// Highlight any found errors
		$('.text-danger').each(function() {
			var element = $(this).parent().parent();

			if (element.hasClass('form-group')) {
				element.addClass('has-error');
			}
		});

	// Currency
	$('#currency .currency-select').on('click', function(e) {
		e.preventDefault();

		$('#currency input[name=\'code\']').attr('value', $(this).attr('name'));

		$('#currency').submit();
	});

	// Language
	$('#language a').on('click', function(e) {
		e.preventDefault();

		$('#language input[name=\'code\']').attr('value', $(this).attr('href'));

		$('#language').submit();
	});

	/* Search */
	$('#search input[name=\'search\']').parent().find('button').on('click', function() {
		url = $('base').attr('href') + 'index.php?route=product/search';

		var value = $('header input[name=\'search\']').val();

		if (value) {
			url += '&search=' + encodeURIComponent(value);
		}

		location = url;
	});

	$('#search input[name=\'search\']').on('keydown', function(e) {
		if (e.keyCode == 13) {
			$('header input[name=\'search\']').parent().find('button').trigger('click');
		}
	});

	// Menu
	$('#menu .dropdown-menu').each(function() {
		var menu = $('#menu').offset();
		var dropdown = $(this).parent().offset();

		var i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#menu').outerWidth());

		if (i > 0) {
			$(this).css('margin-left', '-' + (i + 5) + 'px');
		}
	});

	// Product List
	$('#list-view').click(function() {
		$('#content .product-grid > .clearfix').remove();

		//$('#content .product-layout').attr('class', 'product-layout product-list col-xs-12');
		$('#content .row > .product-grid').attr('class', 'product-layout product-list col-xs-6');

		localStorage.setItem('display', 'list');
	});

	// Product Grid
	$('#grid-view').click(function() {
		// What a shame bootstrap does not take into account dynamically loaded columns
		cols = $('#column-right, #column-left').length;

		if (cols == 2) {
			$('#content .product-list').attr('class', 'product-layout product-grid col-lg-6 col-md-6 col-sm-12 col-xs-6');
		} else if (cols == 1) {
			$('#content .product-list').attr('class', 'product-layout product-grid col-lg-15 col-md-15 col-sm-6 col-xs-6');
		} else {
			$('#content .product-list').attr('class', 'product-layout product-grid col-lg-2 col-md-2 col-sm-6 col-xs-6');
		}

		 localStorage.setItem('display', 'grid');
	});

	if (localStorage.getItem('display') == 'list') {
		$('#list-view').trigger('click');
	} else {
		$('#grid-view').trigger('click');
	}

	// Checkout
	$(document).on('keydown', '#collapse-checkout-option input[name=\'email\'], #collapse-checkout-option input[name=\'password\']', function(e) {
		if (e.keyCode == 13) {
			$('#collapse-checkout-option #button-login').trigger('click');
		}
	});

	// tooltips on hover
	$('[data-toggle=\'tooltip\']').tooltip({container: 'body'});

	// Makes tooltips work on ajax generated content
	$(document).ajaxStop(function() {
		$('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
	});
});

// Cart add remove functions
var cart = {
	'add': function(product_id, quantity) {
		$.ajax({
			url: 'index.php?route=checkout/cart/add',
			type: 'post',
			data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				$('.alert, .text-danger').remove();

				if (json['redirect']) {
					location = json['redirect'];
				}

				if (json['success']) {
					$('#content').parent().before('<div class="alert alert-success thongbao"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

					// Need to set timeout otherwise it wont update the total
					setTimeout(function () {
						$('#cart > button').html('<i class="fa fa-shopping-cart"></i><span id="cart-total"> ' + json['total_product'] + '</span>');
					}, 100);

					//$('html, body').animate({ scrollTop: 0 }, 'slow');

					$('#cart > ul').load('index.php?route=common/cart/info ul li');
				}
			},
	        error: function(xhr, ajaxOptions, thrownError) {
	            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        }
		});
	},
	'update': function(key, quantity) {
		$.ajax({
			url: 'index.php?route=checkout/cart/edit',
			type: 'post',
			data: 'key=' + key + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				// Need to set timeout otherwise it wont update the total
				setTimeout(function () {
					$('#cart > button').html('<i class="fa fa-shopping-cart"></i><span id="cart-total"> ' + json['total'] + '</span>');
				}, 100);

				if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
					location = 'index.php?route=checkout/cart';
				} else {
					$('#cart > ul').load('index.php?route=common/cart/info ul li');
				}
			},
	        error: function(xhr, ajaxOptions, thrownError) {
	            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        }
		});
	},
	'remove': function(key) {
		$.ajax({
			url: 'index.php?route=checkout/cart/remove',
			type: 'post',
			data: 'key=' + key,
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				// Need to set timeout otherwise it wont update the total
				setTimeout(function () {
					$('#cart > button').html('<i class="fa fa-shopping-cart"></i><span id="cart-total"> ' + json['total'] + '</span>');
				}, 100);

				if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
					location = 'index.php?route=checkout/cart';
				} else {
					$('#cart > ul').load('index.php?route=common/cart/info ul li');
				}
			},
	        error: function(xhr, ajaxOptions, thrownError) {
	            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        }
		});
	}
}

var voucher = {
	'add': function() {

	},
	'remove': function(key) {
		$.ajax({
			url: 'index.php?route=checkout/cart/remove',
			type: 'post',
			data: 'key=' + key,
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				// Need to set timeout otherwise it wont update the total
				setTimeout(function () {
					$('#cart > button').html('<i class="fa fa-shopping-cart"></i><span id="cart-total"> ' + json['total'] + '</span>');
				}, 100);

				if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
					location = 'index.php?route=checkout/cart';
				} else {
					$('#cart > ul').load('index.php?route=common/cart/info ul li');
				}
			},
	        error: function(xhr, ajaxOptions, thrownError) {
	            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        }
		});
	}
}

var wishlist = {
	'add': function(product_id) {
		$.ajax({
			url: 'index.php?route=account/wishlist/add',
			type: 'post',
			data: 'product_id=' + product_id,
			dataType: 'json',
			success: function(json) {
				$('.alert').remove();

				if (json['redirect']) {
					location = json['redirect'];
				}

				if (json['success']) {
					$('#content').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}

				$('#wishlist-total span').html(json['total']);
				$('#wishlist-total').attr('title', json['total']);

				$('html, body').animate({ scrollTop: 0 }, 'slow');
			},
	        error: function(xhr, ajaxOptions, thrownError) {
	            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        }
		});
	},
	'remove': function() {

	}
}

var compare = {
	'add': function(product_id) {
		$.ajax({
			url: 'index.php?route=product/compare/add',
			type: 'post',
			data: 'product_id=' + product_id,
			dataType: 'json',
			success: function(json) {
				$('.alert').remove();

				if (json['success']) {
					$('#content').parent().before('<div class="alert alert-success thongbao"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

					$('#compare-total').html(json['total']);

					//$('html, body').animate({ scrollTop: 0 }, 'slow');
				}
			},
	        error: function(xhr, ajaxOptions, thrownError) {
	            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        }
		});
	},
	'remove': function() {

	}
}

/* Agree to Terms */
$(document).delegate('.agree', 'click', function(e) {
	e.preventDefault();

	$('#modal-agree').remove();

	var element = this;

	$.ajax({
		url: $(element).attr('href'),
		type: 'get',
		dataType: 'html',
		success: function(data) {
			html  = '<div id="modal-agree" class="modal">';
			html += '  <div class="modal-dialog">';
			html += '    <div class="modal-content">';
			html += '      <div class="modal-header">';
			html += '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
			html += '        <h4 class="modal-title">' + $(element).text() + '</h4>';
			html += '      </div>';
			html += '      <div class="modal-body">' + data + '</div>';
			html += '    </div';
			html += '  </div>';
			html += '</div>';

			$('body').append(html);

			$('#modal-agree').modal('show');
		}
	});
});

// Autocomplete */
(function($) {
	$.fn.autocomplete = function(option) {
		return this.each(function() {
			this.timer = null;
			this.items = new Array();

			$.extend(this, option);

			$(this).attr('autocomplete', 'off');

			// Focus
			$(this).on('focus', function() {
				this.request();
			});

			// Blur
			$(this).on('blur', function() {
				setTimeout(function(object) {
					object.hide();
				}, 200, this);
			});

			// Keydown
			$(this).on('keydown', function(event) {
				switch(event.keyCode) {
					case 27: // escape
						this.hide();
						break;
					default:
						this.request();
						break;
				}
			});

			// Click
			this.click = function(event) {
				event.preventDefault();

				value = $(event.target).parent().attr('data-value');

				if (value && this.items[value]) {
					this.select(this.items[value]);
				}
			}

			// Show
			this.show = function() {
				var pos = $(this).position();

				$(this).siblings('ul.dropdown-menu').css({
					top: pos.top + $(this).outerHeight(),
					//left: pos.left
				});

				$(this).siblings('ul.dropdown-menu').show();
			}

			// Hide
			this.hide = function() {
				$(this).siblings('ul.dropdown-menu').hide();
			}

			// Request
			this.request = function() {
				clearTimeout(this.timer);

				this.timer = setTimeout(function(object) {
					object.source($(object).val(), $.proxy(object.response, object));
				}, 200, this);
			}

			// Response
			this.response = function(json) {
				html = '';

				if (json.length) {
					for (i = 0; i < json.length; i++) {
						this.items[json[i]['value']] = json[i];
					}

					for (i = 0; i < json.length; i++) {
						if (!json[i]['category']) {
							html += '<li data-value="' + json[i]['value'] + '"><a href="#" class="itemsearch"><img src="' + json[i]['image'] + '" />' + json[i]['label'] + '</a><br/><strong>' + json[i]['priceitem'] + '</strong></li>';
						}
					}

					// Get all the ones with a categories
					var category = new Array();

					for (i = 0; i < json.length; i++) {
						if (json[i]['category']) {
							if (!category[json[i]['category']]) {
								category[json[i]['category']] = new Array();
								category[json[i]['category']]['name'] = json[i]['category'];
								category[json[i]['category']]['item'] = new Array();
							}

							category[json[i]['category']]['item'].push(json[i]);
						}
					}

					for (i in category) {
						html += '<li class="dropdown-header">' + category[i]['name'] + '</li>';

						for (j = 0; j < category[i]['item'].length; j++) {
							html += '<li data-value="' + category[i]['item'][j]['value'] + '"><a href="#" class="itemsearch">&nbsp;&nbsp;&nbsp;' + category[i]['item'][j]['label'] + '</a></li>';
						}
					}
				}

				if (html) {
					this.show();
				} else {
					this.hide();
				}

				$(this).siblings('ul.dropdown-menu').html(html);
			}

			$(this).after('<ul class="dropdown-menu searchajax"></ul>');
			$(this).siblings('ul.dropdown-menu').delegate('a', 'click', $.proxy(this.click, this));

		});

	}
})(window.jQuery);
