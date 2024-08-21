<?php

/**
 * Registers the REST route for university search.
 */
function universityRegisterSearch() {
  register_rest_route('university/v1', 'search', [
    'methods' => 'GET',
    'callback' => 'universitySearchResults',
    'permission_callback' => function () {
      return true;
    }
  ]);
}

/**
 * Callback function for handling university search results.
 *
 * @param array $data The data received from the REST request.
 * @return array The formatted search results.
 */
function universitySearchResults($data) {
  return performMainQuery($data);
}

/**
 * Performs the main query to search for posts based on the given search term.
 *
 * @param array $data The data received from the REST request.
 * @return array The main query results grouped by post type.
 */
function performMainQuery($data) {
  $searchTerm = sanitize_text_field($data['term']);

  $mainQuery = get_posts([
    'post_type' => ['post', 'page', 'project', 'language'],
    'posts_per_page' => -1,
    's' => $searchTerm
  ]);

  $mainQueryResults = [
    'generalInfo' => [],
    'projects' => [],
    'languages' => [],
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

    if ($postType === 'project') {
      $description = null;

      if (has_excerpt($post)) {
        $description = get_the_excerpt($post);
      } else {
        debug_log($post->post_content);
        $description = wp_trim_words($post->post_content, 20);
      }

      $result_item['description'] = $description;
    };

    switch ($postType) {
      case 'post':
      case 'page':
        $mainQueryResults['generalInfo'][] = $result_item;
        break;
      case 'project':
        $mainQueryResults['projects'][] = $result_item;
        break;
      case 'language':
        $mainQueryResults['languages'][] = $result_item;
        break;
    }
  }

  wp_reset_postdata();

  return $mainQueryResults;
}

add_action('rest_api_init', 'universityRegisterSearch');
