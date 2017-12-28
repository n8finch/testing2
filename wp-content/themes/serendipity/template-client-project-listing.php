<?php
/**
 * Template Name: Client Project Listing
 */

//* Add landing page body class to the head
add_filter( 'body_class', 'genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {
	$classes[] = 'client project-listing';
	return $classes;
}

//* Write the entire page
add_action( 'genesis_entry_content', 'page_content', 5 );
function page_content(){ ?>
	<!-- begin client name declaration -->
	<section id="client-name">
		<div class="row">
			<div class="small-10 small-centered medium-8 columns text-center">
				<h5>Projects For</h5>
				<h1><?php the_title() ?></h1>
			</div>
		</div>
	</section>
	<!-- end client name declaration -->
  <!-- begin project listing -->
  <?php
	$args = array(
		'post_type'       => 'post',
    'posts_per_page'  => 3,
    "meta_key"        => "client",
	  "meta_value"      => get_the_ID(),
    'orderby'         => 'date',
  );
	// get_template_part() does not allow you to pass in vars
	include( locate_template('partials/project-listing.php') ); ?>
	<!-- end project listing -->
	<!-- start disclaimer -->
	<section id="disclaimer">
	  <div class="row">
	    <div class="small-12 columns">
	        <a href="/projects" class="button">See All Projects</a>
	    </div>
	  </div>
	</section>
	<!-- end disclaimer -->
<?php }

//* Run the Genesis loop
genesis();
