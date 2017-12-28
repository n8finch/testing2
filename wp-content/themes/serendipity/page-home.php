<?php

//* Add landing page body class to the head
add_filter( 'body_class', 'genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {
	$classes[] = 'homepage';
	return $classes;
}

//* Write the entire page
add_action( 'genesis_entry_content', 'page_content', 5 );
function page_content(){
  if( have_rows('above_the_fold') ):
    while ( have_rows('above_the_fold') ) : the_row(); ?>
      <section id="homepage-starter" style="background-image: url(<?php the_sub_field('image') ?>)">
				<img src="<?php the_sub_field('image') ?>" alt="">
				<div class="full-wrapper">
	        <div class="row">
	          <div id="float-above">
	            <h1><?php the_sub_field('tagline') ?></h1>
	            <div id="your-words">your <span></span></div>
							<div id="words">
		            <?php
		            if( have_rows('your_words') ):
		              while ( have_rows('your_words') ) : the_row(); ?>
		                <div class="word" style="display: none"><?php the_sub_field('word') ?></div>
		            <?php endwhile;
		            endif;
		            ?>
							</div>
	          </div>
	          <div id="homepage-mission-content">
	            <div class="medium-9 large-8 columns statement">
	              <?php the_sub_field('mission_statement') ?>
	            </div>
	            <div class="medium-3 large-4 columns">
	              <?php
	              $styling = "on-light-bg";
	              include( locate_template('partials/button.php') );
	              ?>
	            </div>
	          </div>
	        </div>
				</div>
      </section>
    <?php
    endwhile;
  endif; ?>
  <!-- begin case study -->
  <?php
  if( have_rows('featured_case_study') ):
    while ( have_rows('featured_case_study') ) : the_row(); ?>
    <section id="above-the-fold" class="with-image">
      <div class="row full-width">
        <?php
        $img = get_sub_field('image');
        ?>
				<div id="mobile-statement-image" class="hide-for-medium">
	        <?php if( $img ): ?>
	          <?php echo sleepy_image( $img ) ?>
	        <?php endif; ?>
	      </div>
        <div id="statement-image" class="show-for-medium left" style="background-image: url('<?php echo $img['url'] ?>')">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/assets/img/blank.gif" alt="">
        </div>
        <div id="page-statement" class="small-12 medium-6 end columns">
          <div id="case-study">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/assets/img/icons/arrow-down-dark.svg" alt="">
            <h5>Case Study</h5>
            <hr>
          </div>
          <h1 class="entry-title">
            <?php the_sub_field('title') ?>
          </h1>
          <?php the_sub_field('description') ?>
          <?php
          $styling = "on-dark-bg";
          include( locate_template('partials/button.php') );
          ?>
        </div>
      </div>
    </section>
    <?php
    endwhile;
  endif; ?>
  <!-- end case study -->
  <!-- begin other projects -->
  <?php if( have_rows('other_projects') ): ?>
  <div id="homepage-other-projects">
    <div class="row">
  <?php
    $i = 0;
    while ( have_rows('other_projects') ) : the_row();
    $project  = get_sub_field('project');
    $image    = get_sub_field('image');
    ?>

      <div class="other-project medium-<?php if( $i == 0 ){ echo '5'; } else { echo '7'; }?> columns">
				<div class="image-container" style="background-image: url('<?php echo $image['url'] ?>')">
					<img src="<?php echo $image['url'] ?>" alt="<?php echo $project->post_title ?>">
				</div>
        <div class="content-container">
					<a href="<?php the_permalink($project->ID) ?>" class="full-link hide-from-small-only"><span></span></a>
          <div class="type"><?php echo get_field('type',$project->ID) ?></div>
          <h4><a href="<?php the_permalink($project->ID) ?>"><?php echo $project->post_title ?></a></h4>
          <p><?php echo get_field('client',$project->ID)->post_title ?></p>
          <?php
          // echo '<pre>$project->ID: '.print_r($project->ID,true).'</pre>';
          // echo '<pre>get_permalink: '.print_r(get_permalink($project->ID),true).'</pre>';
          // echo '<pre>type: '.print_r(get_field('type',$project->ID),true).'</pre>';
          // echo '<pre>client: '.print_r(get_field('client',$project->ID)->post_title,true).'</pre>';
          // echo '<pre>$project->post_title: '.print_r($project->post_title,true).'</pre>';
          // echo '<pre>$image[url]: '.print_r($image['url'],true).'</pre>';
          ?>
        </div>

      </div>

    <?php
    $i++;
  endwhile; ?>
    </div>
  </div>
  <?php endif; ?>
  <!-- end other projects -->

	<!-- begin project hype -->
	<section id="project-hype">
		<div class="row">
			<div class="columns">
				<?php
				$args = array(
			    'post_type'       => 'post',
			    'posts_per_page'  => -1,
			    'orderby'         => 'date'
			  );
				$project_query = new WP_Query( $args );
				if( $project_query->have_posts() ):
				  $current_types = array();
	        while( $project_query->have_posts() ) : $project_query->the_post();
	          $current_types[] = get_field('type');
	        endwhile;
	        $current_types = array_unique($current_types);
	        ?>
	        <ul class="filter-projects inline-list">
	          <li><a href="/projects/" class="button on-dark-bg">See More Projects</a></li>
	          <?php foreach( $current_types as $type) : ?>
	            <li class="filter-container"><a class="filter" data-filter="/projects/.<?php echo make_query_string($type) ?>"><?php echo $type ?></a></li>
	          <?php endforeach ?>
	        </ul>
				<?php endif ?>
			</div>
		</div>
	</section>
	<!-- end project hype -->
	<!-- begin services disclaimer -->
	<section id="services-disclaimer" class="row">
		<div class="small-10 small-centered columns text-center">
			<p>Let Us Help You Transform With:</p>
		</div>
		<?php
		$args = array(
			'post_type'      => 'page',
	    'posts_per_page' => 999,
	    'page_id'    			=> 1514, // the services page
	    'orderby'        => 'rand'
		);
		$services_query = new WP_Query( $args );
    $fields = array('strategy', 'design', 'development', 'support');
		if( $services_query->have_posts() ):
			while( $services_query->have_posts() ) : $services_query->the_post();

		    foreach( $fields as $index => $field ):
		    ?>
					<div class="small-10 small-centered medium-3 medium-uncentered columns">
						<?php
						if( have_rows($field) ): ?>
						<!-- <div class="text-center"> -->
							<img src="<?php the_field($field.'_icon') ?>" alt="<?php echo ucwords($field); ?>">
						<!-- </div> -->
						<h3 class="title"><?php echo ucwords($field); ?></h3>
							<ul>
								<?php while ( have_rows($field) ) : the_row(); ?>
									<li><?php the_sub_field('title'); ?></li>
								<?php endwhile; ?>
							</ul>
						<?php endif; ?>
					</div>
			<?php endforeach;
			endwhile;
		endif;
		wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
		<div class="small-12 columns text-center">
			<a href="/services" class="button on-light-bg">Explore Our Services</a>
		</div>
	</section>
	<!-- end services disclaimer -->

  <!-- begin standout clients -->
  <?php
  if( have_rows('important_clients') ):
    while ( have_rows('important_clients') ) : the_row(); ?>
  	<section id="mission-statement" class="row full-width">
  		<div class="small-10 small-centered medium-8 columns">
        <p><strong>
          <?php the_sub_field('description') ?>
        </strong></p>
  			<?php
  				$logo_dir   = get_stylesheet_directory_uri().'/dist/assets/img/';
  				$taf_logo 	= $logo_dir.'bw-taf-logo.svg';
  				$tah_logo 	= $logo_dir.'bw-tah-logo.svg';
  				$usaid_logo = $logo_dir.'bw-usaid-logo.svg';
  				$neamb_logo = $logo_dir.'bw-neamb-logo.svg';
  				$aai_logo 	= $logo_dir.'bw-aai-logo.svg';
  			?>
  		</div>
  		<div class="small-12 columns">
  			<ul>
  				<li id="taf-logo"><a href="/clients/the-asia-foundation/"><img src="<?php echo $taf_logo ?>" alt="The Asia Foundation"></a></li>
  				<li id="tah-logo"><a href="/clients/tahirih-justice-center/"><img src="<?php echo $tah_logo ?>" alt="Tahirih Justice Center"></a></li>
  				<li id="usaid-logo"><a href="/clients/usaid/"><img src="<?php echo $usaid_logo ?>" alt="USAID"></a></li>
  				<li id="neamb-logo"><a href="/clients/neamb/"><img src="<?php echo $neamb_logo ?>" alt="NEA (National Education Association) Member Benefits"></a></li>
  				<li id="aai-logo"><a href="/clients/aai/"><img src="<?php echo $aai_logo ?>" alt="The Africa-America Institute"></a></li>
  			</ul>
        <?php
        // $styling = "on-dark-bg";
        // include( locate_template('partials/button.php') );
        ?>
  		</div>
  	</section>
    <?php
    endwhile;
  endif; ?>
	<!-- end standout clients -->

<?php

}
//* Run the Genesis loop
genesis();
