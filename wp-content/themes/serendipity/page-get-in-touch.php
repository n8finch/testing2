<?php

//* Add landing page body class to the head
add_filter( 'body_class', 'genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {
	$classes[] = 'contact-page';
	return $classes;
}

//* Write the entire page
add_action( 'genesis_entry_content', 'page_content', 5 );
function page_content(){
	$contact_page = get_page_by_path('contact');
	// echo '<pre>$contact_page->ID'.print_r($contact_page->ID,true).'</pre>';
	?>

	<!-- begin contact form -->
	<section id="contact-form">

	  <div class="row">
			<div class="small-12 large-6 columns form">
				<div id="page-statement">
					<h1 class="entry-title"><img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/assets/img/arrow.svg" alt=""> <?php the_title() ?></h1>
					<h1 class="headline"><?php the_field('headline', $contact_page->ID); ?></h1>
				</div>
				<ul>
					<li>
						<?php $phone = genesis_get_option( 'phone' ) ?>
						<a href="tel:+<?php echo $phone ?>">
							<i class="fa fa-phone"></i>
							<span class="text"><?php echo substr($phone, 0, 3)."-".substr($phone, 3, 3)."-".substr($phone,6); ?></span>
						</a>
					</li>
					<?php if( have_rows('linkedin', $contact_page->ID) ):
		        while ( have_rows('linkedin', $contact_page->ID) ) : the_row(); ?>
						<li>
							<a href="<?php the_sub_field('url', $contact_page->ID) ?>">
								<i class="fa fa-linkedin"></i>
								<span class="text"><?php the_sub_field('text', $contact_page->ID) ?></span>
							</a>
						</li>
		      <?php endwhile; endif; ?>
					<li>
							<i class="fa fa-map-marker"></i>
							<div class="office-locations">
								<span class="text">
									<?php the_field('office_locations', $contact_page->ID) ?>
								</span>
							</div>

					</li>
				</ul>
	      <?php echo do_shortcode( '[contact-form-7 id="753" title="Contact Us"]' ); ?>
	    </div>

	    <div class="small-12 large-6 columns image">
				<div id="statement-image" class="show-for-medium" style="background-image: url('<?php $img = get_field('image'); echo $img['url']?>')">
			    <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/assets/img/blank.gif" alt="">
			  </div>
	    </div>
	  </div>
	</section>
	<!-- end contact form -->
<?php }

//* Run the Genesis loop
genesis();
