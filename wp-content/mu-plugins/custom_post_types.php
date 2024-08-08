<?php

function custom_post_types() {
  // Project Post Type
  register_post_type('project', [
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'projects'),
    'supports' => array('title', 'editor', 'excerpt'),
    'labels' => [
      'name' => 'Projects',
      'add_new' => 'Add New Project',
      'add_new_item' => 'Add New Project',
      'edit_item' => 'Edit Project',
      'all_items' => 'All Projects',
      'singular_name' => 'Project',
    ],
    'menu_icon' => 'dashicons-open-folder'
  ]);

  // Language Post Type
  register_post_type('language', [
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'languages'),
    'supports' => array('title'),
    'labels' => array(
      'name' => 'Languages',
      'add_new' => 'Add New Language',
      'add_new_item' => 'Add New Language',
      'edit_item' => 'Edit Language',
      'all_items' => 'All Languages',
      'singular_name' => 'Language'
    ),
    'menu_icon' => 'dashicons-awards'
  ]);
}

add_action('init', 'custom_post_types');