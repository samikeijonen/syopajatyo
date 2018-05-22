<?php
/**
 * Front Page
 *
 * @package Syopajatyo
 */

// Load header/* template.
Hybrid\render_view( 'header', Hybrid\get_global_hierarchy() );

// Load content template.
Hybrid\render_view( 'content', 'front-page' );

// Load footer/* template.
Hybrid\render_view( 'footer', Hybrid\get_global_hierarchy() );
