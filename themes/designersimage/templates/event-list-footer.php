<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME COMMUNITY EVENTS LIST - FOOTER         |
 *  ##################################################
*/

$args = array(
    'post_type' => 'event',
    'post_status' => 'publish',
    'posts_per_page' => 2,
    'meta_query' => array(
        array(
            'key' => '_di_event_key',
            'value' => 's:8:"approved";i:1;s:8:"featured";i:1;',
            'compare' => 'LIKE'
        )
    ),
);

$query = new WP_Query( $args );
?>
<div class="event_list">
    <div class="event">
        <a href="#">Concert In The Park After Dark</a>
        <div class="datetime">
            <div class="icon">
                <?php get_template_part( 'img/svg/icon', 'calendar.svg' ); ?>
            </div>
            <span>11/25/21 @ 6:00 PM</span>
        </div>
        <div class="location">
            <div class="icon">
                <?php get_template_part( 'img/svg/icon', 'location.svg' ); ?>
            </div>
            <span>Woodward Park</span>
        </div>
    </div>
    <div class="event">
        <a href="#">Karaoke Night</a>
        <div class="datetime">
            <div class="icon">
                <?php get_template_part( 'img/svg/icon', 'calendar.svg' ); ?>
            </div>
            <span>11/30/21 @ 9:00 PM</span>
        </div>
        <div class="location">
            <div class="icon">
                <?php get_template_part( 'img/svg/icon', 'location.svg' ); ?>
            </div>
            <span>Goldsteins</span>
        </div>
    </div>
    <a href="#" class="view-all">View All</a>
</div>

<?php
wp_reset_postdata();