<?php

require_once get_template_directory() . '/inc/rest_api_route/search-route.php';
require_once get_template_directory() . '/inc/rest_api_route/like-route.php';

function university_custom_rest() {
  register_rest_field('post', 'authorName', [
    'get_callback' => function () {
      return get_the_author();
    }
  ]);

  register_rest_field('note', 'userNoteCount', [
    'get_callback' => function () {
      return count_user_posts(get_current_user_id(), 'note');
    }
  ]);
}

add_action('rest_api_init', 'university_custom_rest');