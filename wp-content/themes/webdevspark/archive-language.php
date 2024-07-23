<?php
get_template_part('template-parts/header');
$args = [
  'title' => 'All Languages',
  'subtitle' => 'Programming Languages, Frameworks and Tools.'
];
pageBanner($args);
?>

<div class="container container--narrow page-section">
  <ul class="link-list min-list">
    <?php while (have_posts()) { ?>
    <?php the_post(); ?>
    <li>
      <a href="<?php the_permalink() ?>" class="cursor-pointer text-primary-500">
        <?php the_title() ?>
      </a>
    </li>
    <?php } ?>
    <?= paginate_links() ?>
  </ul>
</div>

<?php get_template_part('template-parts/footer'); ?>