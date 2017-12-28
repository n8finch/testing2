<?php

//* Add landing page body class to the head
add_filter( 'body_class', 'genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {
	$classes[] = 'client-page';
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
				<div class="point small-12 medium-6 columns">
					<?php if( get_sub_field('image') ): ?>
					<div class="row">
						<div class="small-4 columns">
							<img src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('title'); ?>">
						</div>
						<div class="small-8 columns point-text">
							<hr />
							<h3 class="point-title"><?php the_sub_field('title'); ?></h3>
							<?php the_sub_field('point'); ?>
						</div>
					</div>
				<?php else: ?>
					<hr />
					<h3 class="point-title"><?php the_sub_field('title'); ?></h3>
					<?php the_sub_field('point'); ?>
				<?php endif; ?>

				</div>
			<?php endwhile; endif; ?>
		</div>
	</section>
	<!-- end page points -->
  <!-- start client list -->
	<section id="client-list">
		<div class="row">
			<div class="small-10 medium-8 small-centered text-center columns">
				<h3><?php echo the_field('client_hype_disclaimer') ?></h3>
			</div>
		</div>
		<div class="row items">
			<div class="small-12 medium-8 medium-centered">

				<div class="small-12 medium-6 list-section columns">
				<?php
				$args = array(
					'post_parent' => get_the_ID(),
					'post_type'   => 'page',
					'numberposts' => -1
				);
				$clients = get_children($args);
				$index_to_break_on = round(count($clients)/2, 0, PHP_ROUND_HALF_UP);
				$index = 0;
				foreach($clients as $clients):
					if($index == $index_to_break_on ): ?>
						</div>
						<div class="small-12 medium-6 list-section columns">
						<?php endif ?>
					<div class="item">
						<a href="<?php the_permalink($clients->ID) ?>" target="_blank"><?php echo $clients->post_title ?></a>
					</div>
					<?php $index++; // if you call index in the foreach you get the post id
		  	endforeach; ?>
				</div>


			</div>
		</div>
	</section>
  <!-- end client list -->

<?php }

//* Run the Genesis loop
genesis();
