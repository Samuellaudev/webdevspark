<?php
get_template_part('template-parts/header');

$args = [
  'title' => 'Past Events',
  'subtitle' => 'A recap of our past events.'
];
pageBanner($args);

$pastEvents = getPastEvents();

function getPastEvents() {
  $today = date('Ymd');
  $pastEvents = new WP_Query([
    'paged' => get_query_var('paged', 1),
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => [
      array(
        'key' => 'event_date',
        'compare' => '<',
        'value' => $today,
        'type' => 'numeric'
      )
    ]
  ]);

  return $pastEvents;
}

function displayPastEvents($pastEvents) {
  while ($pastEvents->have_posts()) {
    $pastEvents->the_post();
    get_template_part('template-parts/content', 'events');
  };
}
?>
<div class="container container--narrow page-section">
  <?php displayPastEvents($pastEvents); ?>
  <?php
  echo paginate_links([
    'total' => $pastEvents->max_num_pages
  ]);
  ?>
</div>

<?php get_template_part('template-parts/footer'); ?>