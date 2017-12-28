<section id="above-the-fold" class="with-image">
  <div class="row full-width">
    <div id="page-statement" class="small-12 large-6 columns">
      <div class="above-the-fold-faker"></div>
      <h1 class="entry-title">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/assets/img/arrow.svg" alt="">
        <?php the_title() ?>
      </h1>
      <?php if( get_field('headline') ): ?>
        <h1 class="headline"><?php the_field('headline'); ?></h1>
      <?php endif ?>
      <?php if( get_field('minor_headline') ): ?>
        <h2 class="subheader"><?php the_field('minor_headline'); ?></h2>
      <?php endif ?>
      <?php the_field('mission_statement') ?>
    </div>
  </div>
  <div id="mobile-statement-image" class="hide-for-large">
    <?php if( get_field('mobile_image') ): ?>
      <?php echo sleepy_image( get_field('mobile_image') ) ?>
    <?php else: ?>
      <?php echo sleepy_image( get_field('image') ) ?>
    <?php endif; ?>
  </div>
  <div id="statement-image" class="show-for-large" style="background-image: url('<?php $img = get_field('image'); echo $img['url']?>')">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/dist/assets/img/blank.gif" alt="">
  </div>
</section>
