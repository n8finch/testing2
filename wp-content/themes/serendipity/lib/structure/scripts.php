<?php

// Scripts
//


add_action( 'wp_enqueue_scripts', 'ygf_load_scripts' );
/**
 * Load scripts
 *
 * Only load these scripts on the front-end.
 *
 * @since 2.0.0
 */
function ygf_load_scripts() {
    if( !is_admin() ) {

       wp_dequeue_script( 'skip-links' );

       wp_deregister_script( 'jquery' );
       wp_deregister_script( 'jquery-ui' );

       // refer to bower_components/jquery/dist/jquery.min.js for version number
       wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, null, false);
       wp_enqueue_script( 'jquery');

	     wp_enqueue_script( 'app', get_stylesheet_directory_uri() . '/dist/assets/js/app.js', array( 'jquery' ), null, true );
       wp_enqueue_script( 'isotope', 'https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js', array( 'jquery' ), null, true );

       wp_enqueue_script( 'lazy', get_stylesheet_directory_uri() . '/bower_components/jquery-lazy/jquery.lazy.min.js', array( 'jquery' ), null, true );

       wp_enqueue_script( 'bower-power', get_stylesheet_directory_uri() . '/dist/assets/js/bower-power.js', array( 'isotope', 'lazy' ), null, true );


       wp_enqueue_script( 'typedit', 'https://cdn.jsdelivr.net/jquery.typeit/4.4.0/typeit.min.js', array( 'jquery' ), null, true );
       wp_enqueue_script( 'typekit', 'https://use.typekit.net/xbr0qnl.js', false, null, null);

    }
}

//Defer js scripts
//
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
function add_defer_attribute($tag, $handle) {
    if ( 'app' == $handle || 'main' == $handle ){
        $tag = str_replace( ' src', ' async="async" src', $tag );
    }
        return $tag;
}
