<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>
  
 

<section class="py-4 text-center">
  <div class="container">
    <p class="mb-0"><?php 
								printf(
									/* translators: %s: query term */
									esc_html__( 'Search Results for: %s', 'picostrap5' ),
									'<span class="text-muted">"' . get_search_query() . '"</span>'
								);
								?></p>
    <div class="lead text-muted col-md-8 offset-md-2 archive-description">
     
    </div> 
 
    <!-- <p>
      <a href="#" class="btn btn-primary my-2">Action</a>
      <a href="#" class="btn btn-secondary my-2">Secondary action</a>
    </p> -->
  </div>
</section>

<section class="album py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 g-4">
    <?php 
        if ( have_posts() ) : 
            while ( have_posts() ) : the_post();
            ?>
            <div class="col-12">
                  
                  <h3><a class="text-decoration-none text-dark" href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                  <small class="text-muted"><?php the_date() ?></small>
                  <?php the_excerpt(); ?>
                  <!--
                  <div class="d-flex justify-content-between align-items-center"> 
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                      </div>
                  </div>
                  -->
          </div>
        <?php
            endwhile;
        else :
            _e( '<span>Sorry, no articles matched your search.</span>', 'textdomain' );
        endif;
        ?>
    </div>

    <div class="row">
      <div class="col lead text-center w-100">
        <div class="d-inline-block"><?php picostrap_pagination() ?></div>
      </div><!-- /col -->
    </div <!-- /row -->
  </div>
</section>
 
<?php get_footer();
