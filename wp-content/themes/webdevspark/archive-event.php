<?php
get_template_part('template-parts/header');

$args = [
  'title' => 'All Events',
  'subtitle' => 'See what is going on in our world.'
];
pageBanner($args);

function displayEvents($query = null) {
  if (!$query) {
    global $wp_query;
    $query = $wp_query; // Use main query if no custom query is provided
  }

  while ($query->have_posts()) {
    $query->the_post();
    get_template_part('template-parts/content', 'events');
  }
}
?>

<div class="container container--narrow page-section">
  <?php displayEvents(); ?>
  <?php echo paginate_links(); ?>
  <hr class="section-break">
  <p>Looking for a recap of past events?
    <a href="<?= site_url('/past-events') ?>">Check out our past events archive.</a>
  </p>
</div>

<?php get_template_part('template-parts/footer'); ?>