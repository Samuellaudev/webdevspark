<?php

function university_post_types() {
  register_post_type('event', [
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'events'),
    'labels' => [
      'name' => 'Events',
      'add_new' => 'Add New Event',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event',
    ],
    'menu_icon' => 'dashicons-calendar'
  ]);
}

add_action('init', 'university_post_types');