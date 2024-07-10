<?php

/**
 * Redirects subscribers to the front page if they try to access the admin area.
 */
function redirectSubsToFrontpage() {
  $currentUser = wp_get_current_user();

  if (
    count($currentUser->roles) === 1 &&
    in_array('subscriber', $currentUser->roles, true)
  ) {
    wp_redirect(site_url('/'));
    exit;
  }
}

add_action('admin_init', 'redirectSubsToFrontpage');

/**
 * Removes the admin bar for subscribers.
 */
function removeAdminBar() {
  $currentUser = wp_get_current_user();

  if (
    count($currentUser->roles) === 1 &&
    in_array('subscriber', $currentUser->roles, true)
  ) {
    show_admin_bar(false);
  }
}

add_action('wp_loaded', 'removeAdminBar');