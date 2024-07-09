<?php

function universityRegisterSearch() {
  register_rest_route('university/v1', 'search', [
    'methods' => 'GET',
    'callback' => 'universitySearchResults'
  ]);
}

function universitySearchResults($data) {
  // Main query
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

  // Second query
  $programAndProfessorQuery = new WP_Query([
    'post_type' => 'professor',
    'meta_query' => [
      [
        'key' => 'related_programs',
        'compare' => 'LIKE',
        'value' => 77,
      ]
    ]
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
  };

  $results['professors'] = array_values(
    array_unique($results['professors'], SORT_REGULAR)
  );

  return $results;
}

add_action('rest_api_init', 'universityRegisterSearch');