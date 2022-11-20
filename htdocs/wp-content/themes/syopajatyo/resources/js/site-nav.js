/**
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
/* global SyopaJaTyoText */

/**
 * Navigation.
 */
function siteNav() {
	const test = document.querySelector( '.app' );
	console.log( test );

	const container = document.querySelector( '.menu--primary' );
	console.log( container );

	// Bail if there is no menu.
	if ( ! container ) {
		return;
	}

	const button = container.querySelector( '.js-menu-toggle' );
	if ( ! button ) {
		return;
	}

	const menu       = container.getElementsByTagName( 'ul' )[0];
	const menuSocial = document.getElementById( 'menu__items--social' );

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( ! menu.classList.contains( 'js-nav-menu' ) ) {
		menu.classList.add( 'js-nav-menu' );
	}

	button.addEventListener( 'click', function() {
		toggleMenu();
	} );

	// Close menu using Esc key.
	document.addEventListener( 'keyup', function( event ) {
		if ( 27 === event.key ) {
			if ( isMenuOpen() ) {
				toggleMenu(); // Close menu.
				button.focus();
			}
		}
	} );

	// Remove ARIA when on "desktop".
	window.addEventListener( 'resize', removeAria );

	// Get all the link elements within the menu.
	const links = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( let i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
		* Add icon to sub menu items.
		*/
	const menuSidebar = document.getElementById( 'js-menu--sidebar' );

	if ( menuSidebar ) {
		var listItems = menuSidebar.querySelectorAll( '.children li a' );
		for ( let i = 0, len = listItems.length; i < len; i++ ) {
			listItems[i].insertAdjacentHTML( 'afterbegin', SyopaJaTyoText.icon );
		}
	}

	/**
		* Add icon to sub menu items in the sidebar.
		*/
	var listItems1 = document.querySelectorAll( '.widget--nav-menu .menu__sub-menu li a' );
	if ( listItems1 ) {
		for ( let i = 0, len = listItems1.length; i < len; i++ ) {
			listItems1[i].insertAdjacentHTML( 'afterbegin', SyopaJaTyoText.icon );
		}
	}

	/**
		* Toggle menu classes and ARIA.
		*/
	function toggleMenu() {
		container.classList.toggle( 'is-toggled' );
		menu.classList.toggle( 'is-opened' );
		menuSocial.classList.toggle( 'is-opened' );

		let expanded = ( 'false' === button.getAttribute( 'aria-expanded' ) ) ? 'true' : 'false';
		button.setAttribute( 'aria-expanded', expanded );
	}

	/**
		* Is menu open.
		*
		* @returns {boolean} True or false.
		*/
	function isMenuOpen() {
		let isMenuOpen = ( 'false' === button.getAttribute( 'aria-expanded' ) ) ? false : true;
		return isMenuOpen;
	}

	/**
		* Remove ARIA on "desktop".
		*/
	function removeAria() {

		// If menu toggle button have display: none css rule, we're on desktop.
		if ( 'none' === window.getComputedStyle( button, null ).getPropertyValue( 'display' ) ) {
			button.setAttribute( 'aria-expanded', 'false' );
			menu.classList.remove( 'is-opened' );
			menuSocial.classList.remove( 'is-opened' );
		}
	}

	/**
		* Sets or removes .focus class on an element.
		*/
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .js-nav-menu.
		while ( -1 === self.className.indexOf( 'js-nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
};

export default siteNav;
