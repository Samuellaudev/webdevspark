<?php

function universityLikeRoutes() {
  register_rest_route('university/v1', 'manageLike', [
    'methods' => 'POST',
    'callback' => 'createLike',
    'permission_callback' => 'is_user_logged_in'
  ]);

  register_rest_route('university/v1', 'manageLike', [
    'methods' => 'DELETE',
    'callback' => 'deleteLike',
    'permission_callback' => 'is_user_logged_in'
  ]);
}

function createLike($data) {
  if (is_user_logged_in()) {
    $professorId = sanitize_text_field($data['professorId']);

    // Check if the current user has liked this professor
    $currentUserLike = new WP_Query([
      'author' => get_current_user_id(),
      'post_type' => 'like',
      'meta_query' => [
        [
          'key' => 'liked_professor_id',
          'compare' => '=',
          'value' => get_the_ID()
        ]
      ]
    ]);

    // If the current user has not already liked this professor 
    // and professorId is of type 'professor'
    if (
      $currentUserLike->found_posts === 0 &&
      get_post_type($professorId) === 'professor'
    ) {
      $likeId = wp_insert_post(array(
        'post_type' => 'like',
        'post_status' => 'publish',
        'post_title' => 'Like for Professor ' . $professorId,
        'meta_input' => array(
          'liked_professor_id' => $professorId
        )
      ));

      return [
        'message' => 'Like created successfully',
        'like_id' => $likeId
      ];
    } else {
      die('Invalid professor Id');
    }
  } else {
    die('Only logged in users can create a like.');
  }
}

function deleteLike($data) {
  $likeId = sanitize_text_field($data['likeId']);
  $postAuthorId = intval(get_post_field('post_author', $likeId));

  // Check if the current user is the author of the post with the given likeId 
  // and if the post type is 'like'
  if (
    get_current_user_id() !== $postAuthorId &&
    get_post_type($likeId) !== 'like'
  ) {
    wp_die('You do not have permission to delete.');
  }

  wp_delete_post($likeId, true);

  return 'The like was deleted successfully';
}

add_action('rest_api_init', 'universityLikeRoutes');