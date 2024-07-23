<?php
get_template_part('template-parts/header');

$args = [
  'title' => 'All Projects',
  'subtitle' => 'Explore my web development projects'
];
pageBanner($args);

function displayProjects($query = null) {
  if (!$query) {
    global $wp_query;
    $query = $wp_query;
  }

  while ($query->have_posts()) {
    $query->the_post();
    get_template_part('template-parts/content', 'projects');
  }
}
?>

<div class="container container--narrow page-section">
  <?php displayProjects(); ?>
  <?php echo paginate_links(); ?>
</div>

<?php get_template_part('template-parts/footer'); ?>