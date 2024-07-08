<?php

function universityRegisterSearch() {
  register_rest_route('university/v1', 'search', [
    'method' => 'GET',
    'callback' => 'universitySearchResults'
  ]);
}

function universitySearchResults($data) {
  $searchTerm = sanitize_text_field($data['term']);

  $mainQuery = get_posts([
    'post_type' => ['post', 'page', 'professor', 'program', 'event'],
    'posts_per_page' => -1,
    's' => $searchTerm
  ]);

  $results = [
    'generalInfo' => [],
    'professors' => [],
    'programs' => [],
    'events' => [],
  ];

  foreach ($mainQuery as $post) {
    setup_postdata($post);

    $postType = get_post_type($post);

    $result_item = [
      'title' => get_the_title($post),
      'permalink' => get_permalink($post),
      'postType' => $postType,
      'authorName' => get_the_author(),
    ];

    switch ($postType) {
      case 'post':
      case 'page':
        $results['generalInfo'][] = $result_item;
        break;
      case 'professor':
        $results['professors'][] = $result_item;
        break;
      case 'program':
        $results['programs'][] = $result_item;
        break;
      case 'event':
        $results['events'][] = $result_item;
        break;
    }
  }

  wp_reset_postdata();

  return $results;
}

add_action('rest_api_init', 'universityRegisterSearch');