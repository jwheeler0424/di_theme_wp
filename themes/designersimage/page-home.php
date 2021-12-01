<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME INDEX PAGE                             |
 *  ##################################################
*/

?>
<?php get_header(); ?>
    <div id="primary" class="content-area">
    
        <main id="main" class="site-main" role="main">
            <?php get_template_part( 'template-parts/theme', 'header' ); ?>

            <section class="home-hero">
                <div class="bg-title">
                    <h2><?php bloginfo( 'description' ); ?></h2>
                </div>
                <div class="bg-city1">
                    <?php get_template_part( 'img/svg/bg', 'city1.svg' ); ?>
                </div>
                <div class="bg-city2">
                    <?php get_template_part( 'img/svg/bg', 'city2.svg' ); ?>
                </div>
                <div class="bg-city3">
                    <?php get_template_part( 'img/svg/bg', 'city3.svg' ); ?>
                </div>
                <div class="bg-city4">
                    <?php get_template_part( 'img/svg/bg', 'city4.svg' ); ?>
                </div>
                <div class="bg-city5">
                    <?php get_template_part( 'img/svg/bg', 'city5.svg' ); ?>
                </div>
                <div class="bg-city6">
                    <?php get_template_part( 'img/svg/bg', 'city6.svg' ); ?>
                </div>
                <div class="bg-city7">
                    <?php get_template_part( 'img/svg/bg', 'city7.svg' ); ?>
                </div>
            </section>

            <section class="home-about">
                <div class="top-left">
                    <?php get_template_part( 'img/svg/bg', 'topLeft.svg' ); ?>
                </div>
                <div class="top-right">
                    <?php get_template_part( 'img/svg/bg', 'topRight.svg' ); ?>
                </div>
                <div class="container">
                    <h2>Welcome to Designer's Image</h2>
                    <p>We design elegant solutions for the simple or complex problems.</p>
                    <?php echo do_shortcode( '[company-links]' ) ?>
                </div>
            </section>

            <section class="home-portfolio">
                <div class="top-left">
                    <?php get_template_part( 'img/svg/bg', 'topLeft.svg' ); ?>
                </div>
                <div class="top-right">
                    <?php get_template_part( 'img/svg/bg', 'topRight.svg' ); ?>
                </div>
                <div class="container">
                    <h2>Check out our latest projects</h2>
                    <p>View our <a href="portfolio/" class="link link-home">portfolio</a> for the full collection of our work.</p>
                    <?php echo do_shortcode( '[portfolio-carousel]' ) ?>
                </div>
            </section>

            <section class="home-services">
                <div class="top-left">
                    <?php get_template_part( 'img/svg/bg', 'topLeft.svg' ); ?>
                </div>
                <div class="top-right">
                    <?php get_template_part( 'img/svg/bg', 'topRight.svg' ); ?>
                </div>
                <div class="container">
                    <h2>Take a look at what we do</h2>
                    <p>Visit our <a href="services/" class="link link-home">services</a> for the full list of the work we do.</p>
                    <?php echo do_shortcode( '[services-links]' ) ?>
                </div>
            </section>

            <section class="home-testimonials">
                <div class="top-left">
                    <?php get_template_part( 'img/svg/bg', 'topLeft.svg' ); ?>
                </div>
                <div class="top-right">
                    <?php get_template_part( 'img/svg/bg', 'topRight.svg' ); ?>
                </div>
                <div class="container">
                    <h2>Here's what our clients have to say</h2>
                    <p>Feel free to <a href="contact/" class="link link-home">contact</a> us with any questions you may have.</p>
                    <?php echo do_shortcode( '[testimonial-slider]' ) ?>
                </div>
            </section>

            <?php get_template_part( 'template-parts/theme', 'footer' ); ?>
        </main>
    </div>
<?php get_footer(); ?>