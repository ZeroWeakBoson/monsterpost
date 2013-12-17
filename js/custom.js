// Zoom fix
jQuery(function(){
	// IPad/IPhone
	var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
	ua = navigator.userAgent,
	gestureStart = function(){
		viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";
	},
	scaleFix = function(){
		if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
			viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
			document.addEventListener("gesturestart", gestureStart, false);
		}
	};
	scaleFix();
});
// ---------------------------------------------------------
// Magnific Popup Init
// ---------------------------------------------------------
function magnific_popup_init(item){
	item.magnificPopup({
		delegate: 'a',
		type: 'image',
		removalDelay: 500,
		mainClass: 'mfp-zoom-in',
		callbacks: {
			beforeOpen: function(){
				// just a hack that adds mfp-anim class to markup 
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
			}
		},
		gallery: {enabled:true}
	});
}

jQuery(document).ready(function(){
	// ---------------------------------------------------------
	// Add active class (.current-menu-item) to main navigation
	// ---------------------------------------------------------
	var path = window.location;
	if (path !== undefined) {
		jQuery("ul.sf-menu")
			.find("a[href$='" + path + "']") // gets all links that match the href
			.parents('li') // gets all list items that are ancestors of the link
			.addClass('current-menu-item');
	}
	// ---------------------------------------------------------
	// Init mobile menu
	// ---------------------------------------------------------
	var viewportWidth = jQuery('body').innerWidth(),
		IE = jQuery('html').attr('class').match(/ie(6|7|8|9)/)|| false;
	if(!IE){
		jQuery(function(){
			jQuery('.sf-menu').mobileMenu();
			jQuery('#menu-footer-menu').mobileMenu();
		});
	}
	// ---------------------------------------------------------
	// Call search form
	// ---------------------------------------------------------
	var yes          = jQuery('#search-form-yes'),
		no           = jQuery('#search-form-no'),
		caller       = jQuery('#search-form-call'),
		sform        = jQuery('.search-form__h'),
		sform_txt    = jQuery('#search-header .search-form_it'),
		sform_height = jQuery('#search-header').outerHeight(),
		sticky       = jQuery('.nav-inner'),
		visible      = false;

	jQuery(window).resize(function(){
		var yes          = jQuery('#search-form-yes'),
			no           = jQuery('#search-form-no'),
			caller       = jQuery('#search-form-call'),
			sform        = jQuery('.search-form__h'),
			sform_txt    = jQuery('#search-header .search-form_it'),
			sform_height = jQuery('#search-header').outerHeight(),
			sticky       = jQuery('.nav-inner'),
			visible      = false;
		caller.click(function(){
			if (visible) {
				sform.stop().animate({height: 0}, 350, function(){
					// Animation complete.
					sticky.removeClass('up');
				}),
				yes.fadeOut(),
				no.fadeOut(),
				caller.removeAttr('disabled').removeClass('disabled');
			} else {
				sform.stop().animate({height: sform_height}, 350),
				yes.fadeIn(),
				no.fadeIn(),
				caller.attr('disabled', 'disabled').addClass('disabled'),
				sticky.addClass('up');
			}
			visible = !visible;
			sform_txt.focus();
		});
		no.click(function(){
			sform.stop().animate({height: 0}, 350, function(){
				// Animation complete.
				sticky.removeClass('up');
			}),
			yes.fadeOut(),
			no.fadeOut(),
			caller.removeAttr('disabled').removeClass('disabled');
			visible = false;
		});
	});

	caller.click(function(){
		if (visible) {
			sform.stop().animate({height: 0}, 350, function(){
				// Animation complete.
				sticky.removeClass('up');
			}),
			yes.fadeOut(),
			no.fadeOut(),
			caller.removeAttr('disabled').removeClass('disabled');
		} else {
			sform.stop().animate({height: sform_height}, 350),
			yes.fadeIn(),
			no.fadeIn(),
			caller.attr('disabled', 'disabled').addClass('disabled'),
			sticky.addClass('up');
		}
		visible = !visible;
		sform_txt.focus();
	});
	no.click(function(){
		sform.stop().animate({height: 0}, 350, function(){
			// Animation complete.
			sticky.removeClass('up');
		}),
		yes.fadeOut(),
		no.fadeOut(),
		caller.removeAttr('disabled').removeClass('disabled');
		visible = false;
	});
	// ---------------------------------------------------------
	// Call Magnific Popup
	// ---------------------------------------------------------
	jQuery(".mfc-thumbnail").each(function(){magnific_popup_init(jQuery(this))});
	// ---------------------------------------------------------
	// Back to Top
	// ---------------------------------------------------------
	jQuery(window).scroll(function(){
		if (jQuery(this).scrollTop() > 100){
			jQuery('#back-top').fadeIn();
		} else {
			jQuery('#back-top').fadeOut();
		}
	});
	jQuery('#back-top a').click(function (){
		jQuery('body,html').stop(false, false).animate({ scrollTop: 0 }, 800 );
		return false;
	});
	// ---------------------------------------------------------
	// Menu Android
	// ---------------------------------------------------------
	if(window.orientation!==undefined){
		var regM = /ipod|ipad|iphone/gi,
			result = navigator.userAgent.match(regM);
		if(!result) {
			jQuery('.sf-menu li').each(function(){
				if(jQuery('>ul', this)[0]){
					jQuery('>a', this).toggle(
						function(){
							return false;
						},
						function(){
							window.location.href = jQuery(this).attr("href");
						}
					);
				} 
			});
		}
	}
	// ---------------------------------------------------------
	// Sticky menu
	// ---------------------------------------------------------
	jQuery('.nav-inner').waypoint('sticky');
	// ---------------------------------------------------------
	// Retina images
	// ---------------------------------------------------------
	jQuery(function(){
		if ( window.devicePixelRatio === 2 ){
			var images = jQuery("img.hires");
			// loop through the images and make them hi-res
			for( var i = 0; i < images.length; i++ ) {
				// create new image name
				var imageType = images[i].src.substr(-4);
				var imageName = images[i].src.substr(0, images[i].src.length - 4);
				imageName += "@2x" + imageType;

				//rename image
				images[i].src = imageName;
			}
		}
	});
	// ---------------------------------------------------------
	// Social Sharing Buttons
	// ---------------------------------------------------------
	var	articles = jQuery('.social-buttons'), socialised = { }, win = jQuery(window), updateArticles, onUpdate, updateTimeout;
	updateArticles = function(){
		// viewport bounds
		var	wT = win.scrollTop(),
			wL = win.scrollLeft(),
			wR = wL + win.width(),
			wB = wT + win.height();
		// check which articles are visible and socialise!
		for (var i = 0; i < articles.length; i++) {
			if (socialised[i]) {
				continue;
			}
			// article bounds
			var	art = jQuery(articles[i]),
				aT = art.offset().top,
				aL = art.offset().left,
				aR = aL + art.width(),
				aB = aT + art.height();
			// vertial point inside viewport
			if ((aT >= wT && aT <= wB) || (aB >= wT && aB <= wB)) {
				// horizontal point inside viewport
				if ((aL >= wL && aL <= wR) || (aR >= wL && aR <= wR)) {
					socialised[i] = true;
					Socialite.load(articles[i]);
				}
			}
		}
	};
	onUpdate = function(){
		if (updateTimeout) {
			clearTimeout(updateTimeout);
		}
		updateTimeout = setTimeout(updateArticles, 100);
	};
	win.on('resize', onUpdate).on('scroll', onUpdate);
	setTimeout(updateArticles, 100);
	// ---------------------------------------------------------
	// FitText makes font-sizes flexible
	// ---------------------------------------------------------
	jQuery(".title-header").fitText(1.2, { minFontSize: '22px', maxFontSize: '30px' });
	jQuery("h1.post-title").fitText(1.5, { minFontSize: '26px', maxFontSize: '60px' });
	jQuery("h2.title-section-h").fitText(1, { minFontSize: '20px', maxFontSize: '30px' });
	jQuery("h2.recent-author-h").fitText(1, { minFontSize: '20px', maxFontSize: '30px' });
	jQuery("h3").fitText(1, { minFontSize: '18px', maxFontSize: '22px' });
	jQuery(".sidebar h4.wpp-title").fitText(1, { minFontSize: '15px', maxFontSize: '17px' });
	jQuery(".sf-menu").fitText(4.3, { minFontSize: '15px', maxFontSize: '17px' });
	// jQuery(".error404-holder h1").fitText(5, { minFontSize: '25px', maxFontSize: '40px' });
	jQuery(".error404-holder .or").fitText(1.2, { minFontSize: '20px', maxFontSize: '38px' });
	// ---------------------------------------------------------
	// Load followers
	// ---------------------------------------------------------
	var templateURI = jQuery('#templateURI').val();
	jQuery('#tm-followers').load(templateURI + '/followers.php');
	// ---------------------------------------------------------
	// Ladda button init (http://lab.hakim.se/ladda/)
	// ---------------------------------------------------------
	jQuery('.ladda-button').click(function(){
		var l = Ladda.create( document.querySelector( '.ladda-button' ) );
		l.start();
	});
	// ---------------------------------------------------------
	// Custom File Inputs
	// ---------------------------------------------------------
	jQuery('.wpcf7 :file').filestyle({classButton: "btn btn-primary btn-normal", buttonText: "Browse", classInput: "input-small"});
	// ---------------------------------------------------------
	// Ajax Filter
	// ---------------------------------------------------------
	jQuery('#toolbar-filter select').live('change', function(e){
		load_filters(this);
	});
	// ---------------------------------------------------------
	// Load More
	// ---------------------------------------------------------
	jQuery('#loadmore').live('click', function(e){
		load_more(this);
		return false;
	});
});
function load_filters(changed){
	var ajaxurl = jQuery('#ajaxurl').val(),
		num     = jQuery('#loadmore').data('offset'),
		offset  = 0;

	data = get_ajax_data(offset, num);

	jQuery.ajax({
		type: 'POST',
		url: ajaxurl,
		data: data,
		cache: false,
		beforeSend: function () {
			jQuery('#toolbar-filter .selectboxit-container').addClass('disabled');
			jQuery('#loadmore').addClass('hidden');
			jQuery('#allthatjunk').html("<div class='loading-wrap'><div class='loading'>Loading ...</div></div>");
		},
		success: function (response) {
			jQuery('#toolbar-filter .selectboxit-container').removeClass('disabled');
			jQuery('#allthatjunk').html(response);
			if (response) {
				jQuery('#loadmore').removeClass('hidden');
			}
		},
		dataType: 'html'
	});
}

function load_more(clicked){
	var ajaxurl = jQuery('#ajaxurl').val(),
		offset  = jQuery(clicked).data('offset'),
		num     = 4;
		num += offset;

	data = get_ajax_data(offset, num);

	jQuery.ajax({
		type: 'POST',
		url: ajaxurl,
		data: data,
		cache: false,
		beforeSend: function () {
			jQuery('.loadmore-wrap').html("<div class='loading-wrap'><div class='loading'>Loading ...</div></div>");
		},
		success: function (response) {
			if (response) {
				jQuery('#allthatjunk').append(response);
				jQuery('.loadmore-wrap').html('<a class="btn btn-normal btn-primary" id="loadmore" href="#" data-offset="'+num+'">Load More</a>');
			} else {
				jQuery('.loadmore-wrap').html('<a class="btn btn-normal btn-primary hidden" id="loadmore" href="#" data-offset="'+num+'">Load More</a>');
			}
		},
		dataType: 'html'
	});
}

function get_ajax_data(offset, num) {
	var query = jQuery('#toolbar-filter').serializeArray(),
		res   = [];

	for (var i = 0, len = query.length; i < len; i++) {
		res[query[i]['name']] = query[i]['value'];
	};

	var data = {
		action: 'get_monster_free_template',
		type: res['type'],
		cat: res['cat'],
		offset: offset,
		num: num
	};

	return data;
}