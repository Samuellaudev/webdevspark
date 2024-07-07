<?php
get_template_part('template-parts/header');

$args = [
  'title' => 'All Events',
  'subtitle' => 'See what is going on in our world.'
];
pageBanner($args);
?>

<div class="container container--narrow page-section">
  <?php while (have_posts()) {
    the_post();
    get_template_part('template-parts/content', 'events');
  }

  echo paginate_links();
  ?>
  <hr class="section-break">
  <p>Looking for a recap of past events?
    <a href="<?= site_url('/past-events') ?>">Check out our past events archive.</a>
  </p>
</div>

<?php get_template_part('template-parts/footer'); ?>