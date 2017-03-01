function initWorkFilter() {
    ! function(e) {
        "use strict";
        var t;
        t = work_grid.hasClass("masonry") ? "masonry" : "fitRows", work_grid.imagesLoaded(function() {
            work_grid.isotope({
                itemSelector: ".mix",
                layoutMode: t,
                filter: fselector
            })
        }), e(".filter").click(function() {
            return e(".filter").removeClass("active"), e(this).addClass("active"), fselector = e(this).attr("data-filter"), work_grid.isotope({
                itemSelector: ".mix",
                layoutMode: t,
                filter: fselector
            }), !1
        })
    }(jQuery)
}

function init_masonry() {
        ! function(e) {
            e(".masonry").imagesLoaded(function() {
                e(".masonry").masonry()
            })
        }(jQuery)
    }! function(e) {
        "use strict";
        e(window).load(function() {
            e("#loader").delay(600).fadeOut("slow"), e("#loader-container").delay(600).fadeOut("slow"), e("body").delay(600).css({
                overflow: "visible"
            })
        }), e(function() {
            function t(e) {
                var o = parseInt(e.html(), 10);
                e.html(++o), o !== e.data("count") && setTimeout(function() {
                    t(e)
                }, 10)
            }
            e(".stat-count").each(function() {
                e(this).data("count", parseInt(e(this).html(), 10)), e(this).html("0"), t(e(this))
            })
        }), e(".bxslider").bxSlider({
            mode: "vertical",
            minSlides: 1,
            maxSlides: 1,
            slideMargin: 0,
            pager: !1,
            nextText: '<i class="fa fa-arrow-down"></i>',
            prevText: '<i class="fa fa-arrow-up"></i>',
            speed: 1e3,
            auto: !0
        }), e(function() {
            e.stellar({
                horizontalScrolling: !1,
                verticalOffset: 40
            })
        }), e("#circle1").circleProgress({
            value:jQuery("#circle1").attr('data-circle')/2,
            size: 240,
            fill: {
                color: jQuery("#circle1").attr('data-color')
            }
        }), e("#circle2").circleProgress({
            value: jQuery("#circle2").attr('data-circle')/2,
            size: 240,
            fill: {
                color: jQuery("#circle2").attr('data-color')
            }
        }), e("#circle3").circleProgress({
            value: jQuery("#circle3").attr('data-circle')/2,
            size: 240,
            fill: {
                color: jQuery("#circle3").attr('data-color')
            }
        }), e("#circle4").circleProgress({
            value: jQuery("#circle4").attr('data-circle')/2,
            size: 240,
            fill: {
                color: jQuery("#circle4").attr('data-color')
            }
        }),
		e("#circle5").circleProgress({
            value: jQuery("#circle5").attr('data-circle')/2,
            size: 240,
            fill: {
                color: jQuery("#circle5").attr('data-color')
            }
        })
		e("#circle6").circleProgress({
            value: jQuery("#circle6").attr('data-circle')/2,
            size: 240,
            fill: {
                color: jQuery("#circle6").attr('data-color')
            }
        })
		e("#circle7").circleProgress({
            value: jQuery("#circle7").attr('data-circle')/2,
            size: 240,
            fill: {
                color: jQuery("#circle7").attr('data-color')
            }
        })
		e("#circle8").circleProgress({
            value: jQuery("#circle8").attr('data-circle')/2,
            size: 240,
            fill: {
                color: jQuery("#circle8").attr('data-color')
            }
        })
		e("#circle9").circleProgress({
            value: jQuery("#circle9").attr('data-circle')/2,
            size: 240,
            fill: {
                color: jQuery("#circle9").attr('data-color')
            }
        })
		e("#circle10").circleProgress({
            value: jQuery("#circle10").attr('data-circle')/2,
            size: 240,
            fill: {
                color: jQuery("#circle10").attr('data-color')
            }
        })
		;
       
        e("#testimonials").length && (e(".testimonial-nav").each(function() {
            var t = e(this),
                o = t.children("li");
            o.sort(function() {
                var e = parseInt(8 * Math.random()),
                    t = e % 2,
                    o = e > 5 ? 1 : -1;
                return t * o
            }).appendTo(t)
        }), e("#testimonials .testimonial:eq(8),#testimonials .testimonial-nav a:eq(8)").addClass("active"), e("#testimonials .testimonial-nav a").hover(function() {
            e("#testimonials .testimonial-nav a,#testimonials .testimonial").removeClass("active"), e(this).addClass("active"), e(e(this).attr("href")).addClass("active")
        }), e("#testimonials .testimonial-nav a").click(function() {
            return !1
        })), jQuery("a[data-gal]").each(function() {
            jQuery(this).attr("rel", jQuery(this).data("gal"))
        }), jQuery("a[data-gal^='prettyPhoto']").prettyPhoto({
            animationSpeed: "slow",
            slideshow: !1,
            overlay_gallery: !1,
            theme: "light_square",
            social_tools: !1,
            deeplinking: !1
        }), new WOW({
            offset: 120
        }).init(), e(".header").affix({
            offset: {
                top: e(".header").height()
            }
        }), smoothScroll.init({
            speed: 1e3,
            easing: "easeInOutCubic",
            offset: 70,
            updateURL: !0,
            callbackBefore: function() {},
            callbackAfter: function() {}
        })
    }(jQuery), jQuery(document).ready(function() {
        jQuery(".tp-banner").show().revolution({
            dottedOverlay: "none",
            delay: 16e3,
            startwidth: 1140,
            startheight: 850,
            hideThumbs: 200,
            thumbWidth: 100,
            thumbHeight: 50,
            thumbAmount: 4,
            navigationType: "none",
            navigationArrows: "solo",
            navigationStyle: "preview1",
            touchenabled: "on",
            onHoverStop: "on",
            swipe_velocity: .7,
            swipe_min_touches: 1,
            swipe_max_touches: 1,
            drag_block_vertical: !1,
            parallax: "scroll",
            parallaxBgFreeze: "on",
            parallaxLevels: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
            keyboardNavigation: "off",
            navigationHAlign: "center",
            navigationVAlign: "bottom",
            navigationHOffset: 0,
            navigationVOffset: 20,
            soloArrowLeftHalign: "left",
            soloArrowLeftValign: "center",
            soloArrowLeftHOffset: 20,
            soloArrowLeftVOffset: 0,
            soloArrowRightHalign: "right",
            soloArrowRightValign: "center",
            soloArrowRightHOffset: 20,
            soloArrowRightVOffset: 0,
            shadow: 0,
            fullWidth: "on",
            fullScreen: "on",
            spinner: "spinner4",
            stopLoop: "off",
            stopAfterLoops: -1,
            stopAtSlide: -1,
            shuffle: "off",
            autoHeight: "off",
            forceFullWidth: "on",
            hideThumbsOnMobile: "off",
            hideNavDelayOnMobile: 1500,
            hideBulletsOnMobile: "off",
            hideArrowsOnMobile: "off",
            hideThumbsUnderResolution: 0,
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            startWithSlide: 0
        })
    }),
    function(e) {
        "use strict";
        e(document).ready(function() {
            e(window).trigger("resize"), initWorkFilter(), init_masonry(), e("#owl-slider").owlCarousel({
 
      navigation : false, // Show next and prev buttons
	  pagination : false,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
	  items : 1, 
      itemsDesktop : false,
      itemsDesktopSmall : false,
      itemsTablet: false,
      itemsMobile : false
 
  })
        })
    }(jQuery);
var fselector = 0,
    work_grid = jQuery("#masonry_grid");