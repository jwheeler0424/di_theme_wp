<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME PORTFOLIO CAROUSEL                     |
 *  ##################################################
*/

$args = array(
    'post_type' => 'portfolio',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'meta_query' => array(
        array(
            'key' => '_di_portfolio_key',
            'value' => 's:8:"approved";i:1;s:8:"featured";i:1;',
            'compare' => 'LIKE'
        )
    ),
);

$query = new WP_Query( $args );

// if ( $query->have_posts() ):
//     $i = 1;
//     echo '<div class="testimonial-slider"><button class="left" type="button">';
//     get_template_part( 'img/svg/icon', 'arrowLeft.svg' );
//     echo '</button>';

//     while ( $query->have_posts() ) : $query->the_post();
//         $name = get_post_meta( get_the_ID(), '_di_testimonial_key', true )['name'] ?? 'Anonymous';
//         $company = get_post_meta( get_the_ID(), '_di_testimonial_key', true )['company'] ?? '';

//         if ( $i === 1 ) {
//             echo '<figure class="front">';
//             get_template_part( 'img/svg/icon', 'quoteLeft.svg' );
//             echo '<blockquote>
//                     <p>'. get_the_content() .'</p>
//                 </blockquote>';
//             get_template_part( 'img/svg/icon', 'quoteRight.svg' );
//             echo '<figcaption>
//                     <span>~ '. $name .' ~</span>
//                     <cite>'. $company .'</cite>
//                 </figcaption>
//             </figure>';
//         } else {
//             echo '<figure class="right">';
//             get_template_part( 'img/svg/icon', 'quoteLeft.svg' );
//             echo '<blockquote>
//                     <p>'. get_the_content() .'</p>
//                 </blockquote>';
//             get_template_part( 'img/svg/icon', 'quoteRight.svg' );
//             echo '<figcaption>
//                     <span>~ '. $name .' ~</span>
//                     <cite>'. $company .'</cite>
//                 </figcaption>
//             </figure>';
//         }
        
//         $i++;
//     endwhile;

//     echo '<button class="right" type="button">';
//     get_template_part( 'img/svg/icon', 'arrowRight.svg' );
//     echo '</button></div>';

// endif;

echo '<div class="portfolio-carousel">';
    echo '<button class="left" type="button">';
        get_template_part( 'img/svg/icon', 'arrowLeft.svg' );
    echo '</button>';
    ?>
    <div class="card front">
        <div class="card-img">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home_page.png" />
        </div>
        <div class="card-info">
            <h4>Company Name</h4>
            <span>Website</span>
            <a href="#" class="project-link">View Project</a>
        </div>
    </div>
    <div class="card right">
        <div class="card-img">
            <img src="<?php echo get_template_directory_uri(); ?>/img/logo.jpg" />
        </div>
        <div class="card-info">
            <h4>Company Title</h4>
            <span>Logo</span>
            <a href="#" class="project-link">View Project</a>
        </div>
    </div>
    <div class="card back hidden">
        <div class="card-img">
        <img src="<?php echo get_template_directory_uri(); ?>/img/fwapper_logo.jpg" />
        </div>
        <div class="card-info">
            <h4>Company Name</h4>
            <span>Web Application</span>
            <a href="#" class="project-link">View Project</a>
        </div>
    </div>
    <div class="card back hidden">
        <div class="card-img">
            <?php get_template_part( 'img/svg/logo', 'di_logo.svg' ); ?>
        </div>
        <div class="card-info">
            <h4>Company Title</h4>
            <span>Website</span>
            <a href="#" class="project-link">View Project</a>
        </div>
    </div>
    <div class="card left">
        <div class="card-img">
            <?php get_template_part( 'img/svg/logo', 'di_logo.svg' ); ?>
        </div>
        <div class="card-info">
            <h4>Company Name</h4>
            <span>Logo</span>
            <a href="#" class="project-link">View Project</a>
        </div>
    </div>
    <?php
    echo '<button class="right" type="button">';
        get_template_part( 'img/svg/icon', 'arrowRight.svg' );
    echo '</button>';
echo '</div>';

wp_reset_postdata();