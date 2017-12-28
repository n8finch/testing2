<?php

//* Add landing page body class to the head
add_filter( 'body_class', 'genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {
	$classes[] = 'team-page';
	return $classes;
}

//* Write the entire page
add_action( 'genesis_entry_content', 'page_content', 5 );
function page_content(){ ?>
	<!-- begin above the fold content  -->
		<?php get_template_part( 'partials/above-the-fold-with-image' ); ?>
	<!-- end above the fold content  -->
	<!-- begin team listing -->
	<section id="team-listing">
    <?php
    $just_for_fun = array();
    if( have_rows('just_for_fun') ){
      while ( have_rows('just_for_fun') ){
        the_row();
        $index = make_query_string( get_sub_field('name') );
        $just_for_fun[$index] = array(
          'name' => get_sub_field('name'),
          'titles' => get_sub_field('titles'),
          'picture' => get_sub_field('picture'),
          'description' => get_sub_field('description')
        );
      }
    }
    // echo '<pre>$just_for_fun: '.print_r($just_for_fun, true).'</pre>';

    if( have_rows('work_life') ):
      while ( have_rows('work_life') ) : the_row();
      $index = make_query_string( get_sub_field('name') );
      ?>

      <div id="<?php echo $index ?>" class="member">
				<div class="work-life row" data-current-type="work-life">
	        <div class="small-12 medium-3 columns">
	          <img src="<?php the_sub_field('picture') ?>" alt="<?php the_sub_field('name') ?>">
	        </div>
	        <div class="small-12 medium-9 columns">
	          <h4><?php the_sub_field('name') ?></h4>
	          <h5><?php the_sub_field('titles') ?></h5>
						<ul class="inline-list">
							<li><a data-name="<?php echo $index ?>" data-type="work-life" class="setting active">Work Life</a></li>
							<?php if( isset($just_for_fun[$index]) ): ?>
								<li><a data-name="<?php echo $index ?>" data-type="just-for-fun" class="setting">Just for Fun</a></li>
							<?php endif ?>
						</ul>
	          <div class="description"><?php the_sub_field('description') ?></div>
	        </div>
      	</div>
				<?php if( isset($just_for_fun[$index]) ): ?>
					<div class="just-for-fun row hide" data-current-type="just-for-fun">
		        <div class="small-12 medium-3 columns">
		          <img src="<?php echo $just_for_fun[$index]['picture'] ?>" alt="<?php the_sub_field('name') ?>">
		        </div>
		        <div class="small-12 medium-9 columns">
		          <h4><?php the_sub_field('name') ?></h4>
		          <h5><?php echo $just_for_fun[$index]['titles'] ?></h5>
							<ul class="inline-list">
								<li><a data-name="<?php echo $index ?>" data-type="work-life" class="setting">Work Life</a></li>
								<li><a data-name="<?php echo $index ?>" data-type="just-for-fun" class="setting active">Just for Fun</a></li>
							</ul>
		          <div class="description"><?php echo $just_for_fun[$index]['description'] ?></div>
		        </div>
	      	</div>
				<?php endif; ?>
			</div>
    <?php endwhile; endif; ?>
	</section>
	<!-- end team members -->
	<!-- begin disclaimer -->
		<?php get_template_part( 'partials/page-disclaimer' ); ?>
	<!-- end disclaimer -->

<?php }

//* Run the Genesis loop
genesis();
