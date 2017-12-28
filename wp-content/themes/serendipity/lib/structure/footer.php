<?php

add_filter( 'genesis_footer_creds_text', 'ygf_footer_creds_text' );

/**
 * Custom footer 'creds' text
 *
 * Note: Avoid adding <p> tags here, since it causes an HTML validation error in Genesis
 *
 * @since 2.0.0
 */
function ygf_footer_creds_text() {
	return '';
}
