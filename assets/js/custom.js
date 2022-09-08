/**************/
// sacchaone custom.js
/**************/
(function ($) {
 "use strict";
  //nav search
  $('body').on('click', '.nav-bar-items .search-item', function(){
    if( $('.nav-search').hasClass('search-active') ){
      $('.nav-search').removeClass('search-active');
    }else{
      $('.nav-search').addClass('search-active');
    }

    if( $('.nav-bar-items .search-item').hasClass('search-btn-active') ){
      $('.nav-bar-items .search-item').removeClass('search-btn-active');
    }else{
      $('.nav-bar-items .search-item').addClass('search-btn-active');
    }
  });

  //scroll to top
    $("#scroll_to_top").hide();
    $("#scroll_to_top").on("click",function(e) {
      e.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, "slow");
    });

    $(window).on( 'scroll', function(){
      var scrollheight =400;
      if( $(window).scrollTop() > scrollheight ) {
        $("#scroll_to_top").fadeIn();
        $("#scroll-to-top").addClass("scroll-visible");
      }
      else {
        $("#scroll_to_top").fadeOut();
        $("#scroll_to_top").removeClass("scroll-visible");
      }
    });
	
    $("a[href^=\\#]").on( 'click', function(event){
        event.preventDefault();
        if( ! $(this).hasClass( SACCHA_DATA.scroll_spy_selector ) ){
          $('html,body').animate({scrollTop:($(this.hash).offset().top - 150)}, 500);
        }
    });
	
	$(window).on( 'scroll', function (event) {
		stickyNav();
	});
	$(window).on( 'load', function (event) {
		stickyNav();
	});

  function stickyNav(){
    var scrollValue = $(window).scrollTop();
		if (scrollValue > 120 && $('body').hasClass('sticky-nav-enabled')) {
			$('body').addClass('sticky-nav');
			$('.nav-header').addClass('affix');
		} else{
      $('body').removeClass('sticky-nav');
			$('.nav-header').removeClass('affix');
		}
  }
	
})(jQuery);