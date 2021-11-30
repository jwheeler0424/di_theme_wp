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
                    <nav class="about-links">
                        <a href="#" title="About our Company">
                            <?php get_template_part( 'img/svg/icon', 'about.svg' ); ?>
                            <span>About</span>
                        </a>
                        <a href="#" title="Our Strategy">
                            <?php get_template_part( 'img/svg/icon', 'strategy.svg' ); ?>
                            <span>Strategy</span>
                        </a>
                        <a href="#" title="Design Concepts">
                            <?php get_template_part( 'img/svg/icon', 'design.svg' ); ?>
                            <span>Design</span>
                        </a>
                        <a href="#" title="Usability Concepts">
                            <?php get_template_part( 'img/svg/icon', 'usability.svg' ); ?>
                            <span>Usability</span>
                        </a>
                        <a href="#" title="Innovation Concepts">
                            <?php get_template_part( 'img/svg/icon', 'innovation.svg' ); ?>
                            <span>Innovation</span>
                        </a>
                        <a href="#" title="Client Support">
                            <?php get_template_part( 'img/svg/icon', 'support.svg' ); ?>
                            <span>Support</span>
                        </a>
                        <a href="#" title="Quality Guarantee">
                            <?php get_template_part( 'img/svg/icon', 'quality.svg' ); ?>
                            <span>Quality</span>
                        </a>
                        <a href="#" title="Frequently Asked Questions">
                            <?php get_template_part( 'img/svg/icon', 'faq.svg' ); ?>
                            <span>FAQ</span>
                        </a>
                    </nav>
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
                    <div class="portfolio-carousel">
                        <button class="left" type="button">
                            <?php get_template_part( 'img/svg/icon', 'arrowLeft.svg' ); ?>
                        </button>
                        <div class="card front">1
                            <div class="card-info">
                                <h4>Company Name</h4>
                                <span>Website</span>
                            </div>
                        </div>
                        <div class="card right">2
                            <div class="card-info">
                                <h4>Company Title</h4>
                                <span>Logo</span>
                            </div>
                        </div>
                        <div class="card back hidden">3
                            <div class="card-info">
                                <h4>Company Name</h4>
                                <span>Web Application</span>
                            </div>
                        </div>
                        <div class="card back hidden">4
                            <div class="card-info">
                                <h4>Company Title</h4>
                                <span>Website</span>
                            </div>
                        </div>
                        <div class="card left">5
                            <div class="card-info">
                                <h4>Company Name</h4>
                                <span>Logo</span>
                            </div>
                        </div>
                        <button class="right" type="button">
                            <?php get_template_part( 'img/svg/icon', 'arrowRight.svg' ); ?>
                        </button>
                    </div>
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
                    <nav class="services-links">
                        <a href="#" title="Web Development">
                            <?php get_template_part( 'img/svg/icon', 'webDevelopment.svg' ); ?>
                            <span>Web Development</span>
                        </a>
                        <a href="#" title="Graphic Design">
                            <?php get_template_part( 'img/svg/icon', 'graphicDesign.svg' ); ?>
                            <span>Graphic Design</span>
                        </a>
                        <a href="#" title="Tech Support">
                            <?php get_template_part( 'img/svg/icon', 'techSupport.svg' ); ?>
                            <span>Tech Support</span>
                        </a>
                    </nav>
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