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

  $mainQueryResults = performMainQuery($data);

  $results = handleRelatedQueries($mainQueryResults);

  return $results;
}

/**
 * Performs the main query to search for posts based on the given search term.
 *
 * @param array $data The data received from the REST request.
 * @return array The main query results grouped by post type.
 */
function performMainQuery($data) {
  // Main query
  $searchTerm = sanitize_text_field($data['term']);

  $mainQuery = get_posts([
    'post_type' => ['post', 'page', 'professor', 'program', 'event'],
    'posts_per_page' => -1,
    's' => $searchTerm
  ]);

  $mainQueryResults = [
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

    if ($postType === 'professor') {
      unset($result_item['authorName']);
      unset($result_item['postType']);
      $result_item['image'] = get_the_post_thumbnail_url($post, 'professorLandscape');
    };

    if ($postType === 'event') {
      $eventDate = new DateTime(get_field('event_date'));
      $description = null;

      if (has_excerpt($post)) {
        $description = get_the_excerpt($post);
      } else {
        $description = wp_trim_words(get_the_content($post), 20);
      }

      $result_item['month'] = $eventDate->format('M');
      $result_item['date'] = $eventDate->format('d ');
      $result_item['description'] = $description;
    };

    if ($postType === 'program') {
      $result_item['id'] = $post->ID;
    }

    switch ($postType) {
      case 'post':
      case 'page':
        $mainQueryResults['generalInfo'][] = $result_item;
        break;
      case 'professor':
        $mainQueryResults['professors'][] = $result_item;
        break;
      case 'program':
        $mainQueryResults['programs'][] = $result_item;
        break;
      case 'event':
        $mainQueryResults['events'][] = $result_item;
        break;
    }
  }

  wp_reset_postdata();

  return $mainQueryResults;
}

/**
 * Handles related queries based on the main query results to refine the search results.
 *
 * @param array $results The main query results.
 * @return array The refined search results with related data.
 */
function handleRelatedQueries($results) {
  // Perform secondary query for related professors based on programs
  if ($results['programs']) {
    $programMetaQuery = ['relation' => 'OR'];

    foreach ($results['programs'] as $program) {
      $programMetaQuery[] = [
        'key' => 'related_programs',
        'compare' => 'LIKE',
        'value' => $program['id']
      ];
    };

    $programAndProfessorQuery = new WP_Query([
      'post_type' => ['professor', 'event'],
      'meta_query' => $programMetaQuery
    ]);

    while ($programAndProfessorQuery->have_posts()) {
      $programAndProfessorQuery->the_post();

      if (get_post_type() === 'professor') {
        $results['professors'][] = [
          'title' => get_the_title(),
          'permalink' => get_permalink(),
          'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
        ];
      }

      if (get_post_type() === 'event') {
        $eventDate = new DateTime(get_field('event_date'));
        $description = null;

        if (has_excerpt()) {
          $description = get_the_excerpt();
        } else {
          $description = wp_trim_words(get_the_content(), 20);
        }

        $results['events'][] = [
          'title' => get_the_title(),
          'permalink' => get_permalink(),
          'month' => $eventDate->format('M'),
          'date' => $eventDate->format('d '),
          'description' => $description
        ];
      };
    };

    // Remove duplicate professors
    $results['professors'] = array_values(
      array_unique($results['professors'], SORT_REGULAR)
    );
    // Remove duplicate events
    $results['events'] = array_values(
      array_unique($results['events'], SORT_REGULAR)
    );
  }

  return $results;
}

add_action('rest_api_init', 'universityRegisterSearch');