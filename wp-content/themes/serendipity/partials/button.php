<?php
if( have_rows('button') ):
  while ( have_rows('button') ) : the_row();
  ?>
  <a class="button <?php echo $styling ?>" href="<?php the_sub_field('url') ?>">
    <span><?php the_sub_field('title') ?></span>
  </a>
<?php endwhile;
endif;
?>
