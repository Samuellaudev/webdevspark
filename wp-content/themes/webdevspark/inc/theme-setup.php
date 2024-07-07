<?php 

/**
 * Adds theme support and registers navigation menus.
 */
function university_features() {
  add_theme_support('title-tag');
  register_nav_menu('headerMenuLocation', 'Header Menu Location');
  register_nav_menu('footerLocationOne', 'Footer Location One');
  register_nav_menu('footerLocationTwo', 'Footer Location Two');
}

add_action('after_setup_theme', 'university_features');

?>