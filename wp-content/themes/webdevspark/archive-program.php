<?php
get_template_part('template-parts/header');

$args = [
  'title' => 'All Programs',
  'subtitle' => 'There is something for everyone. Have a look around.'
];
pageBanner($args);
?>

<div class="container container--narrow page-section">
  <ul class="link-list min-list">
    <?php while (have_posts()) { ?>
      <?php the_post(); ?>
      <li>
        <a href="<?php the_permalink() ?>">
          <?php the_title() ?>
        </a>
      </li>
    <?php } ?>
    <?= paginate_links() ?>
  </ul>
</div>

<?php get_template_part('template-parts/footer'); ?>