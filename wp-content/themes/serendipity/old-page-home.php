<?php

//* Add landing page body class to the head
add_filter( 'body_class', 'genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {
	$classes[] = 'homepage';
	return $classes;
}

//* Write the entire page
add_action( 'genesis_entry_content', 'page_content', 5 );
function page_content(){ ?>
	<?php if( have_rows('important_statement') ): ?>
	<section id="important-statement" style="background-image: url('<?php the_field('background_image'); ?>')">
    <div class="row">
      <div id="page-statement">

					<div id="header-statement">
						<?php the_field('header'); ?>
					</div>
						<?php
						while ( have_rows('header_button') ) : the_row(); ?>
						<div class="text-center">
							<a href="<?php the_sub_field('url') ?>" class="button on-dark-bg"><?php the_sub_field('text') ?></a>
						</div>
						<?php endwhile;?>
      </div>
    </div>
	</section>
	<?php endif; ?>
	<!-- begin above the fold content  -->
	<!-- <section id="above-the-fold">
    <div class="row full-width">
      <div id="page-statement" class="small-12 medium-6 large-6 columns">
				<div class="above-the-fold-faker"></div>
				<?php
					the_field('header_statement');
					if( have_rows('header_button') ):
						while ( have_rows('header_button') ) : the_row(); ?>
						<div class="text-center">
							<a href="<?php the_sub_field('url') ?>" class="button on-dark-bg"><?php the_sub_field('text') ?></a>
						</div>
						<?php endwhile;
					endif;
				?>
      </div>
    </div>
		<div id="mobile-statement-image" class="show-for-small-only">
      <?php if( get_field('mobile_image') ): ?>
				<?php echo sleepy_image( get_field('mobile_image') ) ?>
      <?php else: ?>
				<?php echo sleepy_image( get_field('image') ) ?>
      <?php endif; ?>
    </div>

    <div id="statement-image" class="hide-for-small-only lazy" style="background-image: url('<?php $img = get_field('image'); echo $img['url']?>')">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/assets/img/blank.gif" alt="">
    </div>
	</section> -->
	<!-- end above the fold content  -->

	<!-- begin mission statement -->
	<section id="mission-statement" class="row full-width">
		<div class="small-10 small-centered medium-8 columns">
			<?php
				the_field('mission_statement');
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
				if( have_rows('mission_statement_button') ):
					while ( have_rows('mission_statement_button') ) : the_row(); ?>
					<div class="text-center">
						<a href="<?php the_sub_field('url') ?>" class="button on-dark-bg"><?php the_sub_field('text') ?></a>
					</div>
					<?php endwhile;
				endif;
			?>
		</div>
	</section>
	<!-- end mission statement -->

	<!-- begin services disclaimer -->
	<section id="services-disclaimer" class="row">
		<div class="small-10 small-centered columns text-center">
			<p>Let Us Help You Transform With:</p>
		</div>
		<?php
		$args = array(
			'post_type'      => 'page',
	    'posts_per_page' => 999,
	    'page_id'    => 1514, // the services page
	    'orderby'        => 'rand'
		);
		$services_query = new WP_Query( $args );
		// echo "<pre>services_query".print_r($services_query,true)."</pre>";
    $fields = array('strategy', 'design', 'development', 'support');
		if( $services_query->have_posts() ):
			while( $services_query->have_posts() ) : $services_query->the_post();
		    foreach( $fields as $index => $field ):
		    ?>
					<div class="small-10 small-centered medium-3 medium-uncentered columns">
						<?php
						if( have_rows($field) ): ?>
						<hr />
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
		endif;?>
		<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
		<div class="small-12 columns text-center">
			<a href="/services" class="button on-light-bg">Explore Our Services</a>
		</div>
	</section>
	<!-- end services disclaimer -->

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

<?php

}
//* Run the Genesis loop
genesis();
