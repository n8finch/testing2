<section id="disclaimer">
  <div class="row">
    <div class="small-12 columns">
      <span><?php the_field('disclaimer'); ?></span>
      <?php if( have_rows('link') ):
        while ( have_rows('link') ) : the_row(); ?>
        <br class="show-for-small-only" />
        <a href="<?php the_sub_field('url') ?>" class="button
          <?php if( !is_page('team') ): ?>
            on-dark-bg
          <?php endif ?>
          "><?php the_sub_field('text') ?></a>
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>
