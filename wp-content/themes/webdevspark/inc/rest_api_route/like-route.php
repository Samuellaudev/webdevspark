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

function createLike($data) {
  $professorId = sanitize_text_field($data['professorId']);

  wp_insert_post(array(
    'post_type' => 'like',
    'post_status' => 'publish',
    'post_title' => 'PHP Create Post Test',
    'meta_input' => array(
      'liked_professor_id' => $professorId
    )
  ));
}

function deleteLike() {
  return 'trying to delete a like...';
}

add_action('rest_api_init', 'universityLikeRoutes');