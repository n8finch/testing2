<?php
$project_query = new WP_Query( $args );
if( $project_query->have_posts() ):
  $current_types = array(); ?>
  <section id="projects" >
    <div class="row">
      <?php
        while( $project_query->have_posts() ) : $project_query->the_post();
          $current_types[] = get_field('type');
        endwhile;
        $current_types = array_unique($current_types);
        ?>
        <ul class="filter-projects">
          <li><a class="filter active" data-filter="*">Show All</a></li>
          <?php foreach( $current_types as $type) : ?>
            <li><a class="filter" data-filter=".<?php echo make_query_string($type) ?>">
              <?php
              if( strtolower($type) == 'website' ){
                echo $type.'s';
              }else{
                echo $type;
              }
              ?>
            </a></li>
          <?php endforeach ?>
        </ul>
    </div>
    <div class="row">
      <div class="grid">
        <?php while( $project_query->have_posts() ) : $project_query->the_post(); ?>
          <div class="small-6 medium-3 columns grid-item <?php echo make_query_string( get_field('type') ) ?>">
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
    </div>
  </section>
<?php endif; wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
