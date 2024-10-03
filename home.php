<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>
  
 

<section class="py-4 py-lg-6 text-center">
  <div class="container">
    <h1><?php single_post_title() ?></h1>
  </div>
</section>

<section class="album py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3  g-4">
      <?php 
        if ( have_posts() ) : 
            while ( have_posts() ) : the_post();

              get_template_part('loops/cards');
                
            endwhile;
        else :
            _e( 'Sorry, no articles matched your search.', 'textdomain' );
        endif;
        ?>
    </div>

    <div class="row">
      <div class="col lead text-center w-100">
        <div class="d-inline-block"><?php picostrap_pagination() ?></div>
      </div><!-- /col -->
    </div> <!-- /row -->
  </div>
</section>
 
<?php get_footer();
