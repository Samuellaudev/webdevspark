<?php

/**
 * Customize the URL of the WordPress logo on the login screen to link to the site's homepage.
 *
 * @return string The sanitized URL of the site's homepage.
 */
function customLoginHeaderUrl() {
  return esc_url(site_url('/'));
}

add_filter('login_headerurl', 'customLoginHeaderUrl');

/**
 * Set custom title for the login screen header.
 */
function customLoginTitle() {
  return get_bloginfo('name');
}

add_filter('login_headertext', 'customLoginTitle');

/**
 * Enqueue stylesheets for the login page.
 */
function customLoginStyles() {
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_action('login_enqueue_scripts', 'customLoginStyles');