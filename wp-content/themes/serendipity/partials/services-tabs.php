<section id="services-list">
  <ul class="tabs inline-list" data-tabs id="services">
    <?php foreach( $fields as $index => $field ):
      $active = '';
      if( $index === 0 ) $active = 'is-active';  ?>
      <li class="tabs-title <?php echo $active ?>">
        <a class="button" data-id="<?php echo $field ?>" href="#<?php echo $field ?>"><?php echo ucwords($field) ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
  <div id="page-points" class="tabs-content" data-tabs-content="services">
    <?php foreach( $fields as $index => $field ):
      $active = '';
      if( $index === 0 ) $active = 'is-active';?>
      <div class="tabs-panel <?php echo $active ?>" id="<?php echo $field?>">
        <div class="row">
        <?php
          if( have_rows($field) ):
          while ( have_rows($field) ) : the_row(); ?>
          <div class="point small-12 medium-6 columns">
						<hr />
						<h3 class="point-title"><?php the_sub_field('title'); ?></h3>
						<?php the_sub_field('description'); ?>
  				</div> <!-- end .small-12.medium-6.columns -->
          <?php endwhile; endif; ?>
        </div> <!-- end .row -->
      </div> <!-- end .tabs-panel -->
      <?php endforeach; ?>
  </div> <!-- end .tabs-content -->
</section>
