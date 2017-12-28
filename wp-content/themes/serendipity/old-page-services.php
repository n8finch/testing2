<?php

//* Add landing page body class to the head
add_filter( 'body_class', 'genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {
	$classes[] = 'services-page';
	return $classes;
}

//* Write the entire page
add_action( 'genesis_entry_content', 'page_content', 5 );
function page_content(){ ?>
	<!-- begin above the fold content  -->
		<?php get_template_part( 'partials/above-the-fold-with-image' ); ?>
	<!-- end above the fold content  -->
	<!-- begin page tagline -->
		<?php get_template_part( 'partials/page-tagline' ); ?>
	<!-- end page tagline -->
	<!-- begin services list -->
  	<?php
    $fields = array('strategy', 'design', 'development', 'support');
    include( locate_template('partials/services-tabs.php') );
    ?>
	<!-- end services list -->

	<!-- begin disclaimer -->
		<?php get_template_part( 'partials/page-disclaimer' ); ?>
	<!-- end disclaimer -->
<?php }

//* Run the Genesis loop
genesis();
