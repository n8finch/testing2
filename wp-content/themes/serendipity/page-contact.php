<?php

//* Add landing page body class to the head
add_filter( 'body_class', 'genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {
	$classes[] = 'contact-page';
	return $classes;
}

//* Write the entire page
add_action( 'genesis_entry_content', 'page_content', 5 );
function page_content(){ ?>

	<!-- begin contact form -->
	<section id="contact-form">

	  <div class="row">
			<div class="small-12 large-6 columns form">
				<div id="page-statement">
					<h1 class="entry-title"><img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/assets/img/arrow.svg" alt=""> <?php the_title() ?></h1>
					<h1 class="headline"><?php the_field('headline'); ?></h1>
				</div>
				<ul>
					<li>
						<?php $phone = genesis_get_option( 'phone' ) ?>
						<a href="tel:+<?php echo $phone ?>">
							<i class="fa fa-phone"></i>
							<span class="text"><?php echo substr($phone, 0, 3)."-".substr($phone, 3, 3)."-".substr($phone,6); ?></span>
						</a>
					</li>
					<?php if( have_rows('linkedin') ):
		        while ( have_rows('linkedin') ) : the_row(); ?>
						<li>
							<a href="<?php the_sub_field('url') ?>">
								<i class="fa fa-linkedin"></i>
								<span class="text"><?php the_sub_field('text') ?></span>
							</a>
						</li>
		      <?php endwhile; endif; ?>
					<li>
							<i class="fa fa-map-marker"></i>
							<div class="office-locations">
								<span class="text">
									<?php the_field('office_locations') ?>
								</span>
							</div>

					</li>
				</ul>
	      <?php echo do_shortcode( '[contact-form-7 id="753" title="Contact Us"]' ); ?>
	    </div>

	    <div class="small-12 large-6 columns">
				<!-- begin featured projects -->
				<section id="featured-project">
					<div class="row">
						<div class="small-12 medium-4 columns">
							<h3>
								<span class="first">Featured</span><br />
								<span class="second">Projects</span>
							</h3>
							<a class="button on-dark-bg projects-button" href="/projects">See all Projects</a>
						</div>
							<?php
							$projects = get_field('featured_projects');
							if( $projects ):
								// shuffle($projects);
								global $post; // setup_postdata does not override the global post var, do it manually
								$i = 0; ?>
						    <?php foreach( $projects as $project):
									$i++;
									$post = $project;
									setup_postdata($post);
									$client = get_field('client');?>

									<div class="small-8 small-offset-2 medium-4 medium-uncentered columns text-center">
										<figure class="imghvr-zoom-out">
											<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title()?>" />
											<figcaption>
												<h4 class="ih-fade-down ih-delay-sm"><?php the_title(); ?></h4>
												<p class="ih-zoom-in ih-delay-md">
													<strong><i class="fa fa-tag"></i> <?php the_field('type') ?></strong>
												</p>
											</figcaption>
											<a href="<?php the_permalink()?>" class="figure-effect"></a>
										</figure>
									</div>

									<!-- <ul>
					        <li>
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
										<span>Project Type: <?php the_field('type'); ?></span><br />
										<span>Project Header: <?php the_field('header'); ?></span><br />
										<span>Project Featured Image: <?php the_post_thumbnail('thumbnail'); ?></span><br />
										<span>Client Name: <?php echo $client->post_title ?></span></br >
										<span>Client URL: <?php the_permalink($client) ?></span></br >
										<hr />
					        </li></ul> -->
						    <?php
								if( $i == 2 ) break;
							 	endforeach;?>
						    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
							<?php endif; ?>
						</div>
				</section>
				<!-- end featured projects -->
	    </div>
	  </div>
	</section>
	<!-- end contact form -->
<?php }

//* Run the Genesis loop
genesis();
