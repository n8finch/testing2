<?php

//* Add landing page body class to the head
add_filter( 'body_class', 'genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {
	$classes[] = 'project-listing';
	return $classes;
}

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );


//* Write the entire page
add_action( 'genesis_entry_content', 'page_content', 5 );
function page_content(){ ?>
	<!-- begin above the fold content  -->
		<?php get_template_part( 'partials/above-the-fold-no-image' ); ?>
	<!-- end above the fold content  -->
	<!-- begin project listing -->
  <?php
	$args = array(
    'post_type'       => 'post',
    'posts_per_page'  => -1,
    'orderby'         => 'date'
  );

	// get_template_part() does not allow you to pass in vars
	include( locate_template('partials/project-listing.php') );
	?>
	<!-- end project listing -->
<?php }

//* Run the Genesis loop
genesis();
