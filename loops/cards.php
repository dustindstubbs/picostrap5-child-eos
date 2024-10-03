<?php 
/*
This loop is used in the Archive and in the Home [.php] templates.
*/
?>
<div>
  <div class="card card-article h-100">
    <div class="card-img-top">
      <div class="w-100 ratio ratio-16x9 bg-gray" style="background: url('<?php
        if ( has_post_thumbnail() ) {
          the_post_thumbnail_url('medium');
        }
      ?>'); background-repeat: no-repeat; background-size: cover; background-position: center"></div>
    </div>
    
    <div class="card-body h-100">
        
        <h2 class="h4"><a class="stretched-link" href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
        <p class="card-text"><?php the_excerpt(); ?></p>
        <?php if (!get_theme_mod("singlepost_disable_date") ): ?>
          <small class="text-muted"><?php the_date() ?></small>
        <?php endif; ?>
    </div>
  </div>
</div>