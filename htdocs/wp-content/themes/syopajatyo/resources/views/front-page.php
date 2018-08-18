<?php
/**
 * Front Page
 *
 * @package Syopajatyo
 */

// Load header/* template.
Hybrid\View\display( 'header', Hybrid\Template\hierarchy() );

// Load content template.
Hybrid\View\display( 'content', 'front-page' );

// Load footer/* template.
Hybrid\View\display( 'footer', Hybrid\Template\hierarchy() );
