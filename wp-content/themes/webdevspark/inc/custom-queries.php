<?php

/**
 * Adjusts the main query for custom post type archives.
 *
 * @param WP_Query $query The current query object.
 */
function university_adjust_queries($query) {
  // Languages
  if (!is_admin() && is_post_type_archive('language') && $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }

  // Projects
  if (!is_admin() && is_post_type_archive('project') && $query->is_main_query()) {
    $query->set('meta_key', 'project_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'DESC');
  }
}

add_action('pre_get_posts', 'university_adjust_queries');
