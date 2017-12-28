<section id="above-the-fold" class="no-image">
  <div class="row full-width">
    <div id="page-statement">
      <div class="small-12 columns">
        <h1 class="entry-title"><img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/assets/img/arrow.svg" alt=""> <?php the_title() ?></h1>
      </div>
      <div class="small-12 medium-5 large-4 columns">
        <?php if( get_field('headline') ): ?>
          <h1 class="headline"><?php the_field('headline'); ?></h1>
        <?php endif ?>
      </div>
      <div class="small-12 medium-7 large-8 columns">
        <?php if( get_field('minor_headline') ): ?>
          <h2 class="subheader"><?php the_field('minor_headline'); ?></h2>
        <?php endif ?>
        <?php the_field('mission_statement') ?>
      </div>
    </div>
  </div>
</section>
