<?php

function universityRegisterSearch() {
  register_rest_route('university/v1', 'search', [
    'method' => 'GET',
    'callback' => 'universitySearchResults'
  ]);
}

function universitySearchResults() {
  $professors = get_posts([
    'post_type' => 'professor',
    'posts_per_page' => -1
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