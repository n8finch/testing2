<?php
/**
* inspired from: http://www.billerickson.net/genesis-theme-options/
**/

/**
 * Register Defaults
 **/
function sc_custom_defaults( $defaults ) {
	$defaults['phone'] = '';
	$defaults['contact_url'] = '';
  $defaults['contact_text'] = '';
	return $defaults;
}
add_filter( 'genesis_theme_settings_defaults', 'sc_custom_defaults' );

/**
 * Sanitization
 * Register our two new option values with the no_html sanitization type defined within Genesis.
 **/
function sc_register_custom_sanitization_filters() {
	genesis_add_option_filter(
		'no_html',
		GENESIS_SETTINGS_FIELD,
		array(
			'phone',
			'contact_url',
      'contact_text',
		)
	);
}
add_action( 'genesis_settings_sanitizer_init', 'sc_register_custom_sanitization_filters' );

/**
 * Register additional metaboxes to Genesis > Theme Settings
 **/
function sc_register_custom_settings_box( $_genesis_theme_settings_pagehook ) {
	add_meta_box( 'sc-custom-settings', 'Custom Settings', 'sc_custom_settings_box', $_genesis_theme_settings_pagehook, 'main', 'high' );
}
add_action( 'genesis_theme_settings_metaboxes', 'sc_register_custom_settings_box' );


/**
 * Social Settings Metabox Callback
 **/
 function sc_custom_settings_box() {
	?>

	<p><?php _e( 'Phone:', 'sc-genesis-child' );?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[phone]" value="<?php echo genesis_get_option('phone') ?>" size="50" /> </p>

	<p><?php _e( 'Contact URL:', 'sc-genesis-child' );?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[contact_url]" value="<?php echo genesis_get_option('contact_url') ?>" size="50" /> </p>

  <p><?php _e( 'Contact Text:', 'sc-genesis-child' );?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[contact_text]" value="<?php echo genesis_get_option('contact_text') ?>" size="50" /> </p>

	<?php
}
?>
