<?php
/**
 *  @package diPlugin
 *  ##################################################
 *  |   PLUGIN COMPANY PAGE BACKGROUND ICON          |
 *  ##################################################
*/
$slug = basename(get_permalink());

echo get_template_part( 'img/svg/icon', $slug.'.svg' );
