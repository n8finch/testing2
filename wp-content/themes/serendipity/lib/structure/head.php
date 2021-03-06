<?php

remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'ygf_load_stylesheets' );
/**
 * Overrides the default Genesis stylesheet with child theme specific.
 *
 * Only load these styles on the front-end.
 *
 * @since 2.0.0
 */
function ygf_load_stylesheets() {

    if( !is_admin() ) {
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), null );

		// Main theme stylesheet
    wp_enqueue_style( 'ygf', get_stylesheet_directory_uri() . '/style.css', array(), null );
    wp_enqueue_style( 'app', get_stylesheet_directory_uri() . '/dist/assets/css/app.css', array("ygf"), null );
	}
}
