<?php

//* Add landing page body class to the head
add_filter( 'body_class', 'genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {
	$classes[] = 'about-page';
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
	<!-- begin page points -->
	<section id="page-points">
		<div class="row">
			<?php if( have_rows('bullet_points') ):
				while ( have_rows('bullet_points') ) : the_row(); ?>
				<div class="point small-12 medium-6 large-4 columns">
					<hr />
					<h3 class="point-title"><?php the_sub_field('title'); ?></h3>
					<?php the_sub_field('point'); ?>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</section>
	<!-- end page points -->
	<!-- begin testimonials -->
	<?php
	$args = array(
		'post_type'      => 'page',
    'posts_per_page' => 999,
    'post_parent'    => 702, // the client's page
    'orderby'        => 'rand' # get this to work
	);
	$testimonials_query = new WP_Query( $args );
	// echo '<pre>$testimonials_query: '.print_r($testimonials_query, true).'</pre>';
	?>

	<?php if( $testimonials_query->have_posts() ): ?>
		<section id="testimonials" >
			<div class="row full-width">
				<?php while( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); ?>
					<?php if( have_rows('testimonials') ):
					$testimonials = get_field('testimonials');
					 // randomize the testimonial you display
					foreach($testimonials as $testimonial):
					?>
					<div class="slide" itemscope itemtype="http://schema.org/Review">
							<div itemprop="itemReviewed" itemscope itemtype="http://schema.org/Service">
								<a href="http://<?php the_field('website') ?>" target="_blank">
									<img itemprop="image" src="<?php the_field('logo') ?>" alt="<?php the_title() ?>" class="client-logo" />
								</a>
								<span itemprop="name" class="hide">Services provided to <?php the_title() ?></span>
							</div>
							<span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
						    <span itemprop="ratingValue" class="hide">5</span>
						  </span>
							<blockquote itemprop="reviewBody">
								<?php echo $testimonial['quote']; ?>
							</blockquote>
							<cite itemprop="author" itemscope itemtype="http://schema.org/Person">
								<span itemprop="name" class="name"><?php echo $testimonial['author']; ?></span>
								<i class="fa fa-circle"></i>
								<span class="position"><?php echo $testimonial['author_company_position']; ?></span>
							</cite>
							<div itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
						    <meta itemprop="name" content="<?php the_title() ?>">
						  </div>
					</div>
			<?php endforeach; endif; // end repeater field data ?>
			<?php endwhile; // end $testimonials_query loop ?>
			</div>
		</section>
	<?php endif; ?>

	<!-- end testimonials -->
	<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	<!-- begin disclaimer -->
		<?php get_template_part( 'partials/page-disclaimer' ); ?>
	<!-- end disclaimer -->
<?php }

//* Run the Genesis loop
genesis();
