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

/**
 * Filter callback to make 'note' post type posts private before insertion.
 *
 * @param array $data An array of slashed post data.
 * @param array $postarr An array of sanitized (and slashed) but otherwise unmodified post data.
 * @return array Modified post data.
 */
function makeNotePrivate($data, $postarr) {
  if ($data['post_type'] === 'note') {
    if ($data['post_status'] !== 'trash') {
      $data['post_status'] = 'private';
    }

    // To check the amount of ‘note’ the current user posted, and 
    // to check if we can find the post ID (return false for new note)
    if (
      count_user_posts(get_current_user_id(), 'note') > 4 &&
      !$postarr['ID']
    ) {
      die('You have reached your note limit');
    }

    $data['post_title'] = sanitize_text_field($data['post_title']);
    $data['post_content'] = sanitize_textarea_field($data['post_content']);
  }

  return $data;
}

add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);