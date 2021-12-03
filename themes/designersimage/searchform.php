<?php
/**
 *  @package diTheme
 *  ##################################################
 *  |   THEME SEARCH FORM                            |
 *  ##################################################
*/
?>

<form role="search" method="get" action="<?php echo home_url( '/' ); ?>" class="di-menu__search">
    <input type="search" class="form-control" placeholder="What can we help find?" value="<?php echo get_search_query() ?>" name="s" title="Search" />
    <button type="submit">
        <?php get_template_part( 'img/svg/icon', 'search.svg' ); ?>
    </button>
</form>