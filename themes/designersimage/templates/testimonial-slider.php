<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME TESTIMONIAL SLIDER                    |
 *  ##################################################
*/

$args = array(
    'post_type' => 'testimonial',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'meta_query' => array(
        array(
            'key' => '_di_testimonial_key',
            'value' => 's:8:"approved";i:1;s:8:"featured";i:1;',
            'compare' => 'LIKE'
        )
    ),
);

$query = new WP_Query( $args );

if ( $query->have_posts() ):
    $i = 1;
    echo '<div class="testimonial-slider"><button class="left" type="button">';
    get_template_part( 'img/svg/icon', 'arrowLeft.svg' );
    echo '</button>';

    while ( $query->have_posts() ) : $query->the_post();
        $name = get_post_meta( get_the_ID(), '_di_testimonial_key', true )['name'] ?? 'Anonymous';
        $company = get_post_meta( get_the_ID(), '_di_testimonial_key', true )['company'] ?? '';

        if ( $i === 1 ) {
            echo '<figure class="front">';
            get_template_part( 'img/svg/icon', 'quoteLeft.svg' );
            echo '<blockquote>
                    <p>'. get_the_content() .'</p>
                </blockquote>';
            get_template_part( 'img/svg/icon', 'quoteRight.svg' );
            echo '<figcaption>
                    <span>~ '. $name .' ~</span>
                    <cite>'. $company .'</cite>
                </figcaption>
            </figure>';
        } else {
            echo '<figure class="right">';
            get_template_part( 'img/svg/icon', 'quoteLeft.svg' );
            echo '<blockquote>
                    <p>'. get_the_content() .'</p>
                </blockquote>';
            get_template_part( 'img/svg/icon', 'quoteRight.svg' );
            echo '<figcaption>
                    <span>~ '. $name .' ~</span>
                    <cite>'. $company .'</cite>
                </figcaption>
            </figure>';
        }
        
        $i++;
    endwhile;

    echo '<button class="right" type="button">';
    get_template_part( 'img/svg/icon', 'arrowRight.svg' );
    echo '</button></div>';

endif;

wp_reset_postdata();