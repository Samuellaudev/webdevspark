<?php

function universityLikeRoutes() {
  register_rest_route('university/v1', 'manageLike', [
    'methods' => 'POST',
    'callback' => 'createLike'
  ]);

  register_rest_route('university/v1', 'manageLike', [
    'methods' => 'DELETE',
    'callback' => 'deleteLike'
  ]);
}

function createLike() {
  return 'trying to create a like...';
}

function deleteLike() {
  return 'trying to delete a like...';
}

add_action('rest_api_init', 'universityLikeRoutes');