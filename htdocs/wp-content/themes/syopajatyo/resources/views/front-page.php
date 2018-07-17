<?php
/**
 * Front Page
 *
 * @package Syopajatyo
 */

// Load header/* template.
Hybrid\View\render( 'header', Hybrid\Template\hierarchy() );

// Load content template.
Hybrid\View\render( 'content', 'front-page' );

// Load footer/* template.
Hybrid\View\render( 'footer', Hybrid\Template\hierarchy() );
