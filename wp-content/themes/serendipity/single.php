<?php

//* Add landing page body class to the head
add_filter( 'body_class', 'genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {
	$classes[] = 'project-post';
	return $classes;
}

//* Remove the entry meta in the entry header (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the entry footer markup (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

//* Remove the post content (requires HTML5 theme support)
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

//* Write the entire page
add_action( 'genesis_entry_content', 'page_content', 5 );
function page_content(){ ?>
	<!-- begin gallery  -->
    <section id="gallery">
			<div id="scroll-down" class="up-or-down shown">
				<a href="#project-details" class="scroller">
					<i class="fa fa-chevron-down" aria-hidden="true"></i>
				</a>
			</div>
			<div id="scroll-up" class="up-or-down hidden">
				<a href="#top-of-page" class="scroller">
					<i class="fa fa-chevron-up" aria-hidden="true"></i>
				</a>
			</div>
      <div class="row full-width">
        <div class="small-12 columns">
          <ul class="inline-list crumbs">
            <li>
							<a href="/projects">Projects</a>
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/assets/img/arrow.svg" alt="">
						</li>
            <li>
							<a href="/projects/#filter=.<?php echo make_query_string( get_field('type') ) ?>"><?php the_field('type') ?></a>
						</li>
          </ul>
          <h2><?php the_field('header') ?></h2>
        </div>
      </div>
      <?php
      $images = get_field('gallery');
      if( $images ): ?>
        <div class="row full-width slides">
          <?php foreach( $images as $image ): ?>
            <div class="slide lazy">
							<?php echo sleepy_image( $image, $image['alt']) ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>
	<!-- end gallery  -->
  <!-- begin project details  -->
  <section id="project-details">
    <div class="row">

      <?php if( have_rows('highlights') ): ?>
				<div id="highlights" class="small-12 medium-4 large-3 columns">
					<h4>Highlights</h4>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/assets/img/arrow-down.svg" class="arrow" />
					<?php $row_count = count( get_field('highlights') );
					$i = 0;
          while ( have_rows('highlights') ) : the_row(); $i++;?>
	          <?php
						the_sub_field('text');
						if( $row_count != $i ): ?>
	          	<span class="break">+</span>
						<?php
						endif;
					endwhile; ?>
				</div>
      <?php endif; ?>
      <div id="details" class="small-12 medium-8 large-9 columns">
				<div class="detail">
					<?php $client = get_field('client'); ?>
	        <h5 class="subheader">Client</h5>
	        <?php echo $client->post_title ?>
				</div>
				<?php if( !empty( get_the_content() ) ): ?>
	        <div class="detail">
						<h5 class="subheader">Description</h5>
		        <?php the_content() ?>
					</div>
				<?php endif ?>
        <?php if( get_field('website') ):?>
          <div class="detail">
  					<h5 class="subheader">URL</h5>
  	        <a href="http://<?php echo the_field('website') ?>" target="_blank" class="button">
  	          <?php echo the_field('website') ?>
  	        </a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <!-- end project details  -->
  <!-- begin listing of other projects that belong to the same client -->
	<section id="other-projects" >
  <?php
  $args = array(
    'post_type'       => 'post',
    'posts_per_page'  => 999,
    "meta_key"        => "client",
	  "meta_value"      => "$client->ID",
    'orderby'         => 'rand',
    'post__not_in'    => array(get_the_ID())
  );
  $project_query = new WP_Query( $args );
  // echo '<pre>$testimonials_query: '.print_r($testimonials_query, true).'</pre>';
  if( $project_query->have_posts() ): ?>
			<div class="row">
				<div class="small-12 text-center columns">
					<h3>More projects for</h3>
				  <h5><?php echo $client->post_title ?></h5>


					<img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/assets/img/arrow-down-white.svg" class="arrow" />
				</div>
			</div>
      <div class="row image-collection">
				<?php while( $project_query->have_posts() ) : $project_query->the_post(); ?>
					<div class="small-12 medium-3 text-center columns">
						<figure class="imghvr-zoom-out">
							<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title()?>" />
							<figcaption>
								<h4 class="ih-fade-down ih-delay-sm"><?php the_title()?></h4>
								<p class="ih-zoom-in ih-delay-md">
									<strong><i class="fa fa-tag"></i> <?php the_field('type') ?></strong>
								</p>
							</figcaption>
							<a href="<?php the_permalink()?>" class="figure-effect"></a>
						</figure>
					</div>
				<?php endwhile; ?>
      </div>

  <?php endif; wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
	<div class="row">
		<div class="small-12 text-center columns">
			<a href="/projects" class="button">Back to all projects</a>
		</div>
	</div>
	</section>
  <!-- end listing of other projects -->
<?php

}
//* Run the Genesis loop
genesis();
