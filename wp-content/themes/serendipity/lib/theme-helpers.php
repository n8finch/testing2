<?php
add_filter('show_admin_bar', '__return_false');

/*
* @param: $image - takes ACF WP image array
*/
function sleepy_image( $image, $alt = null, $placeholder = null ){

  if( empty($placeholder) ){
    $placeholder = "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==";
  }

  $image_output = '
  <img class="lazy"
   src='.$placeholder.'
   '.make_lazy_strings( $image ).'
   alt="'.$alt.'"
  />';

  return $image_output;
}

function make_image_string( $dir_uri, $name, $ext ){
  return $dir_uri . '/' . $name . '.' .$ext;
}

/*
* @param: $image - takes ACF WP image array
*/
function make_lazy_strings( $image ){

  $ext      = pathinfo($image['filename'], PATHINFO_EXTENSION);
  $name     = pathinfo($image['filename'], PATHINFO_FILENAME);
  $dir_uri  = dirname($image['url']);
  $dir_path = wp_upload_dir();

  $normal_image     = make_image_string($dir_uri, $name, $ext);
  $potential_retina = make_image_string($dir_uri, $name."@2x", $ext);

  if( file_exists ( $dir_path['path'] . '/' . $name . "@2x" . '.' . $ext) ){
    $retina_image = 'data-retina="'.$potential_retina.'"';
  }else{
    $retina_image = '';
  }

  $image_string =  'data-src="'.$normal_image.'" '.$retina_image;

  return $image_string;

}

function make_query_string( $string ){
    return preg_replace('/\W+/', '-', strtolower( $string ));
}

function show_clients_only( $args, $field, $post_id ) {
    $args['post_parent'] = 702;
    return $args;
}
add_filter('acf/fields/post_object/query/name=client', 'show_clients_only', 10, 3);

// allow for svgs
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

//* Remove navigation
remove_theme_support( 'genesis-menus' );

//* Remove article entry title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove footer widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );

//* Display a custom favicon
add_filter( 'genesis_pre_load_favicon', 'sp_favicon_filter' );
function sp_favicon_filter( $favicon_url ) {
	return get_stylesheet_directory_uri().'/dist/assets/img/icons/favicon.ico';
}

/****************************************
Theme Helpers
*****************************************/

function the_slug($echo=true){
  $slug = basename(get_permalink());
  do_action('before_slug', $slug);
  $slug = apply_filters('slug_filter', $slug);

  if( $echo ) echo $slug;
	  do_action('after_slug', $slug);

  return $slug;

}


/**
 * Add capabilities for a custom post type
 */
function ygf_add_capabilities( $posttype ) {
	// gets the author role
	$role = get_role( 'administrator' );

	// adds all capabilities for a given post type to the administrator role
	$role->add_cap( 'edit_' . $posttype . 's' );
	$role->add_cap( 'edit_others_' . $posttype . 's' );
	$role->add_cap( 'publish_' . $posttype . 's' );
	$role->add_cap( 'read_private_' . $posttype . 's' );
	$role->add_cap( 'delete_' . $posttype . 's' );
	$role->add_cap( 'delete_private_' . $posttype . 's' );
	$role->add_cap( 'delete_published_' . $posttype . 's' );
	$role->add_cap( 'delete_others_' . $posttype . 's' );
	$role->add_cap( 'edit_private_' . $posttype . 's' );
	$role->add_cap( 'edit_published_' . $posttype . 's' );
}

/**
 * Shortcode to display current year and company name for copyright
 */
function ygf_shortcode_copyright() {
	$copyright = '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' );
	return $copyright;
}
add_shortcode( 'copyright', 'ygf_shortcode_copyright' );
