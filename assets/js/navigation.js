/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	const siteNavigation = document.getElementById( 'site-navigation-mobile' );
	// Return early if the navigation don't exist.
	if ( ! siteNavigation ) {
		return;
	}

	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];

	if ( ! menu.classList.contains( 'nav-menu' ) ) {
		menu.classList.add( 'nav-menu' );
	}

	// Get all the link elements within the menu.
	const links = menu.getElementsByTagName( 'a' );

	// Toggle focus each time a menu link is focused or blurred.
	for ( const link of links ) {
		link.addEventListener( 'focus', toggleFocus, true );
		link.addEventListener( 'blur', toggleFocus, true );
	}


	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus(event) {
		if ( soneGetScreenWidth() > 768 && ( event.type === 'focus' || event.type === 'blur' ) ) {
			let self = this;
			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( ! self.classList.contains( 'nav-menu' ) ) {
				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					self.classList.toggle( 'focus' );
				}
				self = self.parentNode;
			}
		}

		if ( event.type === 'touchstart' || event.type === 'click' ) {
			const menuItem = this.parentNode;
			event.preventDefault();
			for ( const link of menuItem.parentNode.children ) {
				if ( menuItem !== link ) {
					link.classList.remove( 'focus' );
				}
			}
			menuItem.classList.toggle( 'focus' );
		}
	}

	// Get all the button elements within the menu.
	const buttons = menu.getElementsByTagName( 'button' );
	for ( const btn of buttons ) {
		btn.addEventListener( 'touchstart', toggleFocus, true );
		btn.addEventListener( 'click', toggleFocus, true );
	}

	// based on window size add body class
	window.onresize = function() {
		soneScreenSize();
	}
	function soneScreenSize(){
		const body = document.getElementsByTagName( 'body' )[ 0 ];
		if( window.innerWidth > 768 ) {
			if( body.classList.contains( 'sone-tablet' ) ) {
				body.classList.remove( 'sone-tablet' );
			}
			body.classList.add( 'sone-desktop' );
		} else {
			if( body.classList.contains( 'sone-desktop' ) ) {
				body.classList.remove( 'sone-desktop' );
			}
			body.classList.add( 'sone-tablet' ); 
		}

		if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
			// true for mobile device
			if( body.classList.contains( 'touch-disabled' ) ) {
				body.classList.remove( 'touch-disabled' );
			}
			body.classList.add( 'touch-enabled' );
		}else{
			if( body.classList.contains( 'touch-enabled' ) ) {
				body.classList.remove( 'touch-enabled' );
			}
			body.classList.add( 'touch-disabled' ); 
		}
	}
	soneScreenSize();

}() );







( function() {
	const siteNavigation_desktop = document.getElementById( 'site-navigation' );
	// Return early if the navigation don't exist.
	if ( ! siteNavigation_desktop ) {
		return;
	}

	const desktop_menu = siteNavigation_desktop.getElementsByTagName( 'ul' )[ 0 ];


	if ( ! desktop_menu.classList.contains( 'nav-menu' ) ) {
		desktop_menu.classList.add( 'nav-menu' );
	}

	// Get all the link elements within the menu.
	const menu_links = desktop_menu.getElementsByTagName( 'a' );

	// Toggle focus each time a menu link is focused or blurred.
	for ( const link of menu_links ) {
		link.addEventListener( 'focus', toggleFocusDesktop, true );
		link.addEventListener( 'blur', toggleFocusDesktop, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocusDesktop(event) {
		if ( soneGetScreenWidth() > 768 && ( event.type === 'focus' || event.type === 'blur' ) ) {
			let self = this;
			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( ! self.classList.contains( 'nav-menu' ) ) {
				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					self.classList.toggle( 'focus' );
				}
				self = self.parentNode;
			}
		}

		if ( soneGetScreenWidth() <= 782 && event.type === 'touchstart' || event.type === 'click' ) {
			const menuItem = this.parentNode;
			event.preventDefault();
			for ( const link of menuItem.parentNode.children ) {
				if ( menuItem !== link ) {
					link.classList.remove( 'focus' );
				}
			}
			menuItem.classList.toggle( 'focus' );
		}
		if( ( soneGetScreenWidth() > 782 && event.type === 'click' ) || ( soneGetScreenWidth() > 782 && event.type === 'touchstart' ) ){
			const menuItem = this.parentNode;
			event.preventDefault();
			for ( const link of menuItem.parentNode.children ) {
				if ( menuItem !== link ) {
					link.classList.remove( 'active-focus' );
				}
			}
			menuItem.classList.toggle( 'active-focus' );
		}
	}

	// Get all the button elements within the menu.
	const desktop_buttons = desktop_menu.getElementsByTagName( 'button' );
	for ( const btn of desktop_buttons ) {
		btn.addEventListener( 'touchstart', toggleFocusDesktop, true );
		btn.addEventListener( 'click', toggleFocusDesktop, true );
	}
}() );

function soneGetScreenWidth(){
	return window.innerWidth; 
}
