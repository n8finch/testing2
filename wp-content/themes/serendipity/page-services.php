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

    <section id="services-sections">
      <?php
      $fields = array('strategy', 'design', 'development', 'support');
      $i = 0;
      foreach( $fields as $index => $field ):
        if ($i % 2 == 0) {
          $class = 'even';
        }else{
          $class = 'odd';
        }
      ?>
        <div class="service-section <?php echo $class ?>">
          <div class="row">
            <div class="point small-12 medium-4 columns">
              <img src="<?php the_field($field . "_icon"); ?>" alt="<?php echo ucwords($field) ?>" />
            </div>
            <?php if( have_rows($field) ):
              ?>
              <div class="point small-12 medium-offset-1 medium-7 columns">
                <h3 class="section-title"><?php echo ucwords($field) ?></h3>
              <?php while ( have_rows($field) ) : the_row(); ?>
                <div class="row">
                  <div class="columns description">
                    <h4 class="point-title"><?php the_sub_field('title'); ?></h4>
        						<?php the_sub_field('description'); ?>
                  </div>
                </div>
            <?php  endwhile; ?>
            </div> <!-- end .small-12.medium-6.columns -->
          <?php endif; ?>
          </div> <!-- end .row -->
        </div> <!-- end .service-section -->
      <?php
      $i++;
    endforeach; ?>
    </section>
	<!-- end services list -->
<?php }

//* Run the Genesis loop
genesis();
