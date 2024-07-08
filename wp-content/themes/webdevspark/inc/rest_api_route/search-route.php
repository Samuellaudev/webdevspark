<?php

function universityRegisterSearch() {
  register_rest_route('university/v1', 'search', [
    'method' => 'GET',
    'callback' => 'universitySearchResults'
  ]);
}

function universitySearchResults() {
  return 'test route';
}

add_action('rest_api_init', 'universityRegisterSearch');