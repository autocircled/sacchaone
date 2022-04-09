/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
  // Site title and description.
  wp.customize("blogname", function (value) {
    value.bind(function (to) {
      $(".site-title a").text(to);
    });
  });

  wp.customize("blogdescription", function (value) {
    value.bind(function (to) {
      $(".site-description").text(to);
    });
  });
    // Header text color.
    // @todo delete this section
  wp.customize("header_textcolor", function (value) {
    value.bind(function (to) {
      if ("blank" === to) {
        $(".site-title, .site-description").css({
          clip: "rect(1px, 1px, 1px, 1px)",
          position: "absolute",
        });
      } else {
        $(".site-title, .site-description").css({
          clip: "auto",
          position: "relative",
        });
        $(".site-title a, .site-description").css({
          color: to,
        });
      }
    });
  });

  wp.customize("sacchaone_hide_site_title", function (value) {
    value.bind(function (to) {
      console.log(to);
      if ( to ) {
        $(".site-title").css({
          clip: "rect(1px, 1px, 1px, 1px)",
          position: "absolute",
        });
      } else {
        $(".site-title").css({
          clip: "auto",
          position: "relative",
        });
      }
    });
  });
  
  wp.customize("sacchaone_hide_site_desc", function (value) {
    value.bind(function (to) {
      if ( to ) {
        $(".site-description").css({
          clip: "rect(1px, 1px, 1px, 1px)",
          position: "absolute",
        });
      } else {
        $(".site-description").css({
          clip: "auto",
          position: "relative",
        });
      }
    });
  });

  wp.customize("sacchaone_container_width", function (value) {
    value.bind(function (to) {
      let selector = 'header.container, header .container, main.container, footer .container';
      let id = 'container-width';
      let property = 'max-width';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + 'px;}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + 'px;}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });

  wp.customize("sacchaone_header_width", function (value) {
    value.bind(function (to) {
      let header = '.nav-header';
      let navbar = '.navbar';
      if ( 'box' === to ) {
        if ( $( navbar ).hasClass( 'container' ) ) {
          $( navbar ).removeClass( 'container' );
        }
        $( header ).addClass( 'container' );

        if ( $( header ).hasClass( 'header-bg' ) ) {
          $( header ).removeClass( 'header-bg' );
        }
        $( navbar ).addClass( 'header-bg' );
      } else {
        if ( $( header ).hasClass( 'container' ) ) {
          $( header ).removeClass( 'container' );
        }
        $( navbar ).addClass( 'container' );

        if ( $( navbar ).hasClass( 'header-bg' ) ) {
          $( navbar ).removeClass( 'header-bg' );
        }
        $( header ).addClass( 'header-bg' );
      }
    });
  });
  
  wp.customize("sacchaone_footer_width", function (value) {
    value.bind(function (to) {
      let footer = '.footer';
      let footerInner = '.footer-inner';
      if ( 'box' === to ) {
        if ( $( footerInner ).hasClass( 'container' ) ) {
          $( footerInner ).removeClass( 'container' );
        }
        $( footer ).addClass( 'container' );
      } else {
        if ( $( footer ).hasClass( 'container' ) ) {
          $( footer ).removeClass( 'container' );
        }
        $( footerInner ).addClass( 'container' );
      }
    });
  });

  wp.customize("sacchaone_back2top", function (value) {
    value.bind(function (to) {
      if ( 1 == to ) {
        if ( $( 'body' ).hasClass( 'back2top-disabled' ) ) {
          $( 'body' ).removeClass( 'back2top-disabled' );
        }
        $( 'body' ).addClass( 'back2top-enabled' );
      } else {
        if ( $( 'body' ).hasClass( 'back2top-enabled' ) ) {
          $( 'body' ).removeClass( 'back2top-enabled' );
        }
        $( 'body' ).addClass( 'back2top-disabled' );
      }
    });
  });

  wp.customize("sacchaone_dropdown_direction", function (value) {
    value.bind(function (to) {
      let id = 'sacchaone_dropdown_direction';
      let first = 'left' === to ? '-100%' : '100%';
      let second = 'left' === to ? 'left: unset;right: 0;' : '';
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( 'li.menu-item-has-children li:hover > ul, li.menu-item-has-children li.focus > ul {left: '+ first +';} li.menu-item-has-children:hover > ul, li.menu-item-has-children.focus > ul {' + second + '}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">li.menu-item-has-children li:hover > ul, li.menu-item-has-children li.focus > ul {left: '+ first +';} li.menu-item-has-children:hover > ul, li.menu-item-has-children.focus > ul {' + second + '}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize("sacchaone_sticky_nav", function (value) {
    value.bind(function (to) {
      if ( 'enable' == to ) {
        if ( $( 'body' ).hasClass( 'sticky-nav-disabled' ) ) {
          $( 'body' ).removeClass( 'sticky-nav-disabled' );
        }
        $( 'body' ).addClass( 'sticky-nav-enabled' );
      } else {
        if ( $( 'body' ).hasClass( 'sticky-nav-enabled' ) ) {
          $( 'body' ).removeClass( 'sticky-nav-enabled' );
        }
        $( 'body' ).addClass( 'sticky-nav-disabled' );
      }
    });
  });

  // Color Controls
  wp.customize( 'body_text_color', function (value) {
    value.bind(function (to) {
      let selector = 'body';
      let id = 'body_text_color';
      let property = 'color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'body_link_color', function (value) {
    value.bind(function (to) {
      let selector = 'body a';
      let id = 'body_link_color';
      let property = 'color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'body_link_hover_color', function (value) {
    value.bind(function (to) {
      let selector = 'body a:hover, body a:focus';
      let id = 'body_link_hover_color';
      let property = 'color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'header_background_color', function (value) {
    value.bind(function (to) {
      let selector = '.header-bg';
      let id = 'header_background_color';
      let property = 'background-color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'header_site_title_color', function (value) {
    value.bind(function (to) {
      let selector = '.site-title a, .site-title a:hover, .site-title a:focus';
      let id = 'header_site_title_color';
      let property = 'color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
 
  wp.customize( 'header_tagline_color', function (value) {
    value.bind(function (to) {
      let selector = '.site-description';
      let id = 'header_tagline_color';
      let property = 'color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  // wp.customize( 'nav_background_color', function (value) {
  //   value.bind(function (to) {
  //     let selector = '.navbar-collapse';
  //     let id = 'nav_background_color';
  //     let property = 'background-color';
      
  //     if ( $( 'style#' + id ).length ) {
  //       $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
  //     } else {
  //       $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
  //       setTimeout( function() {
  //         $( 'style#' + id ).not( ':last' ).remove();
  //       }, 1000 );
  //     }
  //   });
  // });
  
  wp.customize( 'nav_hover_color', function (value) {
    value.bind(function (to) {
      let selector = '.nav>li.open>a, .nav>li:hover>a';
      let id = 'nav_hover_color';
      let property = 'background-color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'nav_active_color', function (value) {
    value.bind(function (to) {
      let selector = '.nav.navbar-nav > li.current_page_item > a, .nav.navbar-nav > li.current_page_ancestor > a';
      let id = 'nav_active_color';
      let property1 = 'background-color';
      let property2 = 'border-bottom-color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property1 + ':' + to + '30;' + property2 + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property1 + ':' + to + '30;' + property2 + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'nav_text_color', function (value) {
    value.bind(function (to) {
      let selector = '.nav.navbar-nav li a';
      let id = 'nav_text_color';
      let property = 'color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'nav_text_hover_color', function (value) {
    value.bind(function (to) {
      let selector = '.nav>li.open>a, .nav>li:hover>a';
      let id = 'nav_text_hover_color';
      let property = 'color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'nav_text_active_color', function (value) {
    value.bind(function (to) {
      let selector = '.nav.navbar-nav li.current_page_item a';
      let id = 'nav_text_active_color';
      let property = 'color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'nav_sub_bg_color', function (value) {
    value.bind(function (to) {
      let selector = '.nav li>ul';
      let id = 'nav_sub_bg_color';
      let property = 'background-color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'nav_sub_bg_hover_color', function (value) {
    value.bind(function (to) {
      let selector = '.nav li li.open>a, .nav li li:hover>a';
      let id = 'nav_sub_bg_hover_color';
      let property = 'background-color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'nav_sub_bg_active_color', function (value) {
    value.bind(function (to) {
      let selector = '.nav.navbar-nav li li.current_page_ancestor > a, .nav.navbar-nav li li.current_page_item > a';
      let id = 'nav_sub_bg_active_color';
      let property1 = 'background-color';
      let property2 = 'border-left-color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property1 + ':' + to + '30;' + property2 + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property1 + ':' + to + '30;' + property2 + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'nav_sub_text_color', function (value) {
    value.bind(function (to) {
      let selector = '.nav.navbar-nav li li a';
      let id = 'nav_sub_text_color';
      let property = 'color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'nav_sub_text_hover_color', function (value) {
    value.bind(function (to) {
      let selector = '.nav li li.open>a, .nav li li:hover>a';
      let id = 'nav_sub_text_hover_color';
      let property = 'color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });
  
  wp.customize( 'nav_sub_text_active_color', function (value) {
    value.bind(function (to) {
      let selector = '.nav.navbar-nav li li.current_page_ancestor > a, .nav.navbar-nav li li.current_page_item > a';
      let id = 'nav_sub_text_active_color';
      let property = 'color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });

  wp.customize( 'button_bg_color', function (value) {
    value.bind(function (to) {
      let selector = 'input[type="submit"], form.comment-form .form-submit input.submit, .wp-block-search__button';
      let id = 'button_bg_color';
      let property = 'background-color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });

  wp.customize( 'button_text_color', function (value) {
    value.bind(function (to) {
      let selector = 'input[type="submit"], form.comment-form .form-submit input.submit, .wp-block-search__button';
      let id = 'button_text_color';
      let property = 'color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });

  wp.customize( 'button_bg_hover_color', function (value) {
    value.bind(function (to) {
      let selector = 'input[type="submit"]:focus, input[type="submit"]:active, input[type="submit"]:hover, form.comment-form .form-submit input.submit:focus, form.comment-form .form-submit input.submit:active, form.comment-form .form-submit input.submit:hover, .wp-block-search__button:focus, .wp-block-search__button:hover, .wp-block-search__button:active';
      let id = 'button_bg_hover_color';
      let property = 'background-color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });

  wp.customize( 'button_text_hover_color', function (value) {
    value.bind(function (to) {
      let selector = 'input[type="submit"]:focus, input[type="submit"]:active, input[type="submit"]:hover, form.comment-form .form-submit input.submit:focus, form.comment-form .form-submit input.submit:active, form.comment-form .form-submit input.submit:hover, .wp-block-search__button:focus, .wp-block-search__button:hover, .wp-block-search__button:active';
      let id = 'button_text_hover_color';
      let property = 'color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });

  wp.customize( 'button_border_color', function (value) {
    value.bind(function (to) {
      let selector = 'input[type="submit"], form.comment-form .form-submit input.submit, .wp-block-search__button';
      let id = 'button_border_color';
      let property = 'border-color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });

  wp.customize( 'button_border_hover_color', function (value) {
    value.bind(function (to) {
      let selector = 'input[type="submit"]:focus, input[type="submit"]:active, input[type="submit"]:hover, form.comment-form .form-submit input.submit:focus, form.comment-form .form-submit input.submit:active, form.comment-form .form-submit input.submit:hover, .wp-block-search__button:focus, .wp-block-search__button:hover, .wp-block-search__button:active';
      let id = 'button_border_hover_color';
      let property = 'border-color';
      
      if ( $( 'style#' + id ).length ) {
        $( 'style#' + id ).html( selector + '{' + property + ':' + to + ';}' );
      } else {
        $( 'head' ).append( '<style id="' + id + '">' + selector + '{' + property + ':' + to + ';}</style>' );
        setTimeout( function() {
          $( 'style#' + id ).not( ':last' ).remove();
        }, 1000 );
      }
    });
  });

})(jQuery);
