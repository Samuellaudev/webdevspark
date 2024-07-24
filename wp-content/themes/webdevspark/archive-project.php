<?php
get_template_part('template-parts/header');

$args = [
  'title' => 'All Projects',
  'subtitle' => 'Explore my web development projects'
];
pageBanner($args);

function displayProjects($query = null) {
  $counter = 0;

  if (!$query) {
    global $wp_query;
    $query = $wp_query;
  }

  while ($query->have_posts()) {
    $query->the_post();
    $counter++;

    if ($counter % 2 === 0) {
      echo '<div class="event-project">';
    } else {
      echo '<div class="odd-project">';
    }
    get_template_part('template-parts/content', 'projects');
    echo '</div>';
  }
}
?>

<div class="container container--narrow page-section">
  <?php displayProjects(); ?>
  <?php echo paginate_links(); ?>
</div>

<?php get_template_part('template-parts/footer'); ?>