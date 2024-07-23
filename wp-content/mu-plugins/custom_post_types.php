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

  // Professor Post Type
  register_post_type('professor', [
    'public' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'professors'),
    'supports' => array('title', 'editor', 'thumbnail'),
    'labels' => array(
      'name' => 'Professors',
      'add_new' => 'Add New Professor',
      'add_new_item' => 'Add New Professor',
      'edit_item' => 'Edit Professor',
      'all_items' => 'All Professors',
      'singular_name' => 'Professor'
    ),
    'menu_icon' => 'dashicons-welcome-learn-more'
  ]);

  // Note Post Type
  register_post_type('note', [
    'public' => false,
    'show_in_rest' => true,
    'supports' => array('title', 'editor'),
    'labels' => array(
      'name' => 'Notes',
      'add_new' => 'Add New Note',
      'add_new_item' => 'Add New Note',
      'edit_item' => 'Edit Note',
      'all_items' => 'All Notes',
      'singular_name' => 'Note'
    ),
    'menu_icon' => 'dashicons-welcome-write-blog',
    "show_ui" => true,
    'capability_type' => 'note',
    'map_meta_cap' => true
  ]);

  // Like Post Type
  register_post_type('like', [
    'public' => false,
    'supports' => array('title'),
    'labels' => array(
      'name' => 'Likes',
      'add_new' => 'Add New Like',
      'add_new_item' => 'Add New Like',
      'edit_item' => 'Edit Like',
      'all_items' => 'All Likes',
      'singular_name' => 'Like'
    ),
    'menu_icon' => 'dashicons-heart',
    "show_ui" => true,
  ]);

  // --------------------------------
  // // Program Post Type
  // register_post_type('program', [
  //   'public' => true,
  //   'show_in_rest' => true,
  //   'has_archive' => true,
  //   'rewrite' => array('slug' => 'programs'),
  //   'supports' => array('title'),
  //   'labels' => array(
  //     'name' => 'Programs',
  //     'add_new' => 'Add New Program',
  //     'add_new_item' => 'Add New Program',
  //     'edit_item' => 'Edit Program',
  //     'all_items' => 'All Programs',
  //     'singular_name' => 'Program'
  //   ),
  //   'menu_icon' => 'dashicons-awards'
  // ]);

  // Event Post Type
  // register_post_type('event', [
  //   'public' => true,
  //   'show_in_rest' => true,
  //   'has_archive' => true,
  //   'rewrite' => array('slug' => 'events'),
  //   'supports' => array('title', 'editor', 'excerpt'),
  //   'labels' => [
  //     'name' => 'Events',
  //     'add_new' => 'Add New Event',
  //     'add_new_item' => 'Add New Event',
  //     'edit_item' => 'Edit Event',
  //     'all_items' => 'All Events',
  //     'singular_name' => 'Event',
  //   ],
  //   'menu_icon' => 'dashicons-calendar',
  //   'capability_type' => 'event',
  //   'map_meta_cap' => true
  // ]);
}

add_action('init', 'custom_post_types');
