document.addEventListener('DOMContentLoaded', function() {
  "use strict";

  //scroll to top
  var scrollToTopBtn = document.getElementById('scroll_to_top');
  if (scrollToTopBtn) {
    scrollToTopBtn.style.display = 'none';

    scrollToTopBtn.addEventListener('click', function(e) {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    window.addEventListener('scroll', function() {
      var scrollheight = 400;
      if (window.scrollY > scrollheight) {
        scrollToTopBtn.style.display = 'block';
        scrollToTopBtn.classList.add('scroll-visible');
      } else {
        scrollToTopBtn.style.display = 'none';
        scrollToTopBtn.classList.remove('scroll-visible');
      }
    });
  }


  // plugin hack for [accondion faq builder]
  document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
    anchor.addEventListener('click', function(event) {
      event.preventDefault();
      if (!this.classList.contains('scroll_spy_selector')) {
        var targetElement = document.querySelector(this.hash);
        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop - 150,
            behavior: 'smooth'
          });
        }
      }
    });
  });

  window.addEventListener('scroll', stickyNav);
  window.addEventListener('load', stickyNav);

  function stickyNav() {
    var scrollValue = window.scrollY;
    var body = document.body;

    if (scrollValue > 120 && body.classList.contains('sticky-nav-enabled')) {
      body.classList.add('sticky-nav');
      document.querySelector('.nav-header').classList.add('affix');
    } else {
      body.classList.remove('sticky-nav');
      document.querySelector('.nav-header').classList.remove('affix');
    }
  }

  var sacchaModal = sacchaModal || {};

  const body = document.querySelector('body');
  const menu = document.getElementById('site-navigation-mobile');
  const search = document.getElementById('search-modal');
  const openMenuModal = document.querySelector('.navbar-toggler-open');
  const openSearchModal = document.querySelector('.search-toggler-open');
  const backdrop = document.createElement('div');
  let closeBtnType = false;
  sacchaModal.popup = {
      init: function() {
          openMenuModal.addEventListener('click', this.open,);
          openSearchModal.addEventListener('click', this.open);

          const closeModalBtn = document.querySelectorAll('.saccha-btn-close');
          closeModalBtn.forEach(closeBtn => closeBtn.addEventListener('click', this.close));

          // close modal on click backdrop
          backdrop.addEventListener('click', this.close);

          menu.addEventListener('keydown', this.trapFocus);
          search.addEventListener('keydown', this.trapFocus);

          // Optional: Close modal on Escape key press
          document.addEventListener('keydown', function (event) {
              if (event.key === 'Escape') {
                  sacchaModal.popup.close();
              }
          });

      },
      open: function() {
          closeBtnType = this.getAttribute('data-target');
          backdrop.className = "modal-backdrop fade show";
          body.classList.add( 'modal-open' );
          body.style.paddingRight = "17px";
          if ( closeBtnType === '#site-navigation-mobile' ) {
              menu.classList.add( 'show' );
              menu.style.display = 'block';
              menu.focus();
          } else if ( closeBtnType === '#search-modal' ) {
              search.classList.add( 'show' );
              search.style.display = 'block';
              search.focus();
          }
          body.appendChild(backdrop);
      },

      close: function() {
          body.classList.remove('modal-open');
          menu.classList.remove('show');
          search.classList.remove('show');
          menu.style.display = 'none';
          search.style.display = 'none';
          body.style.paddingRight = "";
          closeBtnType === '#site-navigation-mobile' ? openMenuModal.focus() : closeBtnType === '#search-modal' ? openSearchModal.focus() : false;

          body.removeChild(backdrop);
      },

      /**
       * Focused on menu modal
       * @param {tab} event 
       */
      trapFocus: function(event) {
          const targetEl = closeBtnType === '#site-navigation-mobile' ? menu : search;
          const menuLinks = Array.from( targetEl.querySelectorAll( 'a, button, input' ) );
          const focusableElements = menuLinks.filter(link => !link.hasAttribute('disabled'));

          // Check if Tab key is pressed
          if (event.key === 'Tab') {
              // Prevent the default tab behavior
              event.preventDefault();

              // Find the index of the currently focused element
              const focusedIndex = focusableElements.indexOf(document.activeElement);

              // Determine the next index for focus
              const nextIndex = (focusedIndex + 1) % focusableElements.length;

              // Set focus on the next element in the array
              focusableElements[nextIndex].focus();
          }
      }
  }

  // If modal not exists we won't go funther.
  if ( ! menu || ! search ) {
      return false;
  }

  // // Now we are safe. Call our awesome modal.
  sacchaModal.popup.init();

});