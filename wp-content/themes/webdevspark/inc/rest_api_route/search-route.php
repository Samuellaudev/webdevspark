<?php

function universityRegisterSearch() {
  register_rest_route('university/v1', 'search', [
    'method' => 'GET',
    'callback' => 'universitySearchResults'
  ]);
}

function universitySearchResults($data) {
  $professors = get_posts([
    'post_type' => 'professor',
    'posts_per_page' => -1,
    's' => sanitize_text_field($data['term'])
  ]);

  $professorResults = [];

  foreach ($professors as $professor) {
    $professorResults[] = [
      'title' => $professor->post_title,
      'permalink' => get_permalink($professor),
    ];
  };

  return $professorResults;
}

add_action('rest_api_init', 'universityRegisterSearch');