<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();




if ( have_posts() ) : 
    while ( have_posts() ) : the_post();
    
    ?>

    <div class="container-fluid g-0">
        <?php if ( get_post_type(get_the_ID()) == 'sermon' ):
            $youtube_id = get_post_meta( get_the_ID(), 'sermon_youtube_id', true );
            if (!empty(get_the_terms( get_the_ID(), "series"))){
                $sermon_series = get_the_terms( get_the_ID(), "series")[0];
            }
            if (!empty(get_the_terms( get_the_ID(), "speaker"))){
                $sermon_speaker = get_the_terms( get_the_ID(), "speaker")[0];
            }
            if ( !empty($youtube_id) ): ?>
                <div class="bg-black mb-3">
                    <div class="container container-post g-0">
                        <iframe class="d-block ratio" style="aspect-ratio:16 / 9" src="https://www.youtube.com/embed/<?php echo $youtube_id ?>?modestbranding=1&color=white" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div id="container-content-single" class="container container-post bg-white py-3 p-md-3">
            <div class="row text-center">
                
                <div class="col-md-12">

                    <?php if (!get_theme_mod("singlepost_disable_date") && get_post_type(get_the_ID()) != 'event' ): ?>
                        <div class="py-3">
                            <small class="text-muted post-date"><?php echo date('F d, Y', strtotime(get_the_date())); ?> </small>
                        </div>
                        <h1 class="text-responsive-h1"><?php the_title(); ?></h1>
                        <small class="text-muted"><?php echo (!empty($sermon_series)) ? "Series: <a class='text-muted' href='/series/$sermon_series->slug'>".$sermon_series->name."</a>" : ""; echo (!empty($sermon_speaker)) ? " | Speaker: <a class='text-muted' href='/speaker/$sermon_speaker->slug'>".$sermon_speaker->name."</a>" : "";?> </small>
                        <?php  ?>

                    <?php else: ?>

                        <h1 class="text-responsive-h1 mb-1"><?php the_title(); ?></h1>

                        <?php
                        
                        // If event, display the event date and time
                        $event_date = get_post_meta( get_the_ID(), 'snow_day_date', true );
                        if ( $event_date != null ) {
                            $event_date = date("l,\&\\n\b\s\p\;M.\&\\n\b\s\p\;jS", strtotime( $event_date ) );
                        }else{
                            $event_date = '';
                        }
                        $event_time = get_post_meta( get_the_ID(), 'snow_day_time', true );
                        if ( $event_time != null ) {
                            if ( date( "i", strtotime( $event_time ) ) == '00' ) {
                                $event_time = ' at '. date( "ga", strtotime( $event_time ) );
                            }else{
                                $event_time = ' at '. date( "g:ia", strtotime( $event_time ) );
                            }
                        }else{
                            $event_time = '';
                        }

                        ?>

                        <div class="py-3 mb-5">
                            <span class="post-date"><?php echo $event_date . $event_time ?> </span>
                        </div>    
                        
                    <?php endif;?>
                    
                    <?php if (!get_theme_mod("singlepost_disable_date") OR !get_theme_mod("singlepost_disable_author")  ): ?>
                        <div class="post-meta" id="single-post-meta">
                            <p class="lead text-secondary">

                                <?php if (!get_theme_mod("singlepost_disable_author") ): ?>
                                    <span class="text-secondary post-author"> <?php _e( 'by', 'picostrap5' ) ?> <?php the_author(); ?></span>
                                <?php endif; ?>
                            </p>
                        </div> 
                    <?php endif; ?>

                </div><!-- /col -->
            </div>
            <div class="row">
                <div class="single-post prose">
                    <?php 
                    
                    the_content();
                    
                    if( get_theme_mod("enable_sharing_buttons")) {
                    ?>
                        <div class="picostrap-sharing-buttons mb-5 mt-4" >
		
                        <!-- Basic Share Links -->
                        <span class="d-block mb-3 h4"><?php _e( 'Share this', 'picostrap5' ); ?>: &nbsp; </span>
                    
                        <!-- Facebook (url) -->
                        <a class="btn btn-outline-dark mb-2 btn-sm btn-facebook" href="https://www.facebook.com/sharer.php?u=<?php echo get_page_link() ?>" target="_blank" rel="nofollow" title="Share on Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="2em" height="2em" lc-helper="svg-icon" fill="currentColor">
                            <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                        </svg>
                            <span> Facebook</span>
                        </a>
                    
                        <!-- Email (subject, body) --> 
                        <a class="btn btn-outline-dark mb-2  btn-sm btn-email" href="mailto:?subject=<?php echo esc_attr(get_the_title()) . ' - ' . get_bloginfo( 'name' ) ?>&amp;body=<?php echo get_page_link() ?>" target="_blank" rel="nofollow" title="Share via Email">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="2em" height="2em" viewBox="0 0 24 24" lc-helper="svg-icon" fill="currentColor">
                                <path d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6M20 6L12 11L4 6H20M20 18H4V8L12 13L20 8V18Z"></path>
                            </svg>
                            <span> Email</span>
                        </a>

                        <!-- Text (subject, body) --> 
                        <a class="btn d-lg-none btn-outline-dark mb-2 align-items-center btn-sm btn-email" href="sms:?subject=<?php echo esc_attr(get_the_title()) ?>&amp;body=<?php echo get_page_link() ?>" target="_blank" rel="nofollow" title="Share via Email">
                            <svg class="pt-1" width="2em" height="2em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 9C6.28333 9 6.521 8.904 6.713 8.712C6.905 8.52 7.00067 8.28267 7 8C7 7.71667 6.904 7.479 6.712 7.287C6.52 7.095 6.28267 6.99934 6 7C5.71667 7 5.479 7.096 5.287 7.288C5.095 7.48 4.99933 7.71734 5 8C5 8.28334 5.096 8.521 5.288 8.713C5.48 8.905 5.71733 9.00067 6 9ZM10 9C10.2833 9 10.521 8.904 10.713 8.712C10.905 8.52 11.0007 8.28267 11 8C11 7.71667 10.904 7.479 10.712 7.287C10.52 7.095 10.2827 6.99934 10 7C9.71667 7 9.479 7.096 9.287 7.288C9.095 7.48 8.99933 7.71734 9 8C9 8.28334 9.096 8.521 9.288 8.713C9.48 8.905 9.71733 9.00067 10 9ZM14 9C14.2833 9 14.521 8.904 14.713 8.712C14.905 8.52 15.0007 8.28267 15 8C15 7.71667 14.904 7.479 14.712 7.287C14.52 7.095 14.2827 6.99934 14 7C13.7167 7 13.479 7.096 13.287 7.288C13.095 7.48 12.9993 7.71734 13 8C13 8.28334 13.096 8.521 13.288 8.713C13.48 8.905 13.7173 9.00067 14 9ZM0 20V2C0 1.45 0.196 0.979002 0.588 0.587002C0.98 0.195002 1.45067 -0.000664969 2 1.69779e-06H18C18.55 1.69779e-06 19.021 0.196002 19.413 0.588002C19.805 0.980002 20.0007 1.45067 20 2V14C20 14.55 19.804 15.021 19.412 15.413C19.02 15.805 18.5493 16.0007 18 16H4L0 20Z" fill="currentcolor"/>
                            </svg>
                            <span> Text</span>
                        </a>
                    
                    </div>
                    <?php
                    }
                    
                    edit_post_link( __( 'Edit this post', 'picostrap5' ), '<p class="text-end">', '</p>' );
                    
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (!get_theme_mod("singlepost_disable_comments")) if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                    
                    ?>

                </div><!-- /col -->
            </div>
        </div>
    </div>

<?php
    endwhile;
 else :
     _e( 'Sorry, no posts matched your criteria.', 'picostrap5' );
 endif;
 ?>


 

<?php get_footer();
