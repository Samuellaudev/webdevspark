<?php
get_template_part('template-parts/header');

$args = [
  'title' => 'Everything about web development',
  'subtitle' => 'Recent Updates and Stories'
];
pageBanner($args);

$counter = 0;
?>
<div class="container container--narrow page-section">
  <?php while (have_posts()) :
    the_post();
    $counter++;

    if ($counter % 2 === 0) {
      echo '<div class="event-post">';
    } else {
      echo '<div class="odd-post">';
    }
  ?>
    <div class="post-item">
      <h2 class="headline headline--medium headline--post-title">
        <a href="<?= get_permalink() ?>"><?php the_title() ?></a>
      </h2>
      <div class="metabox">
        <p class="inner-content">
          <span class="hidden sm:inline hover:cursor-pointer">Posted by <?php the_author_posts_link() ?></span>
          <span class="hidden sm:inline">on</span> <?php the_time('M j, Y') ?>
          in <span class="hover:cursor-pointer"><?= get_the_category_list(', ') ?></span>
        </p>
      </div>
      <div class="generic-content flex flex-col space-y-4">
        <?php the_excerpt() ?>
        <p class="btn-redirect">
          <a class="btn bg-primary-400 hover:bg-primary-500" href="<?php the_permalink() ?>">Continue reading &raquo;</a>
        </p>
      </div>
    </div>
  <?php
    echo '</div>';
  endwhile;
  echo paginate_links();
  ?>
</div>

<?php get_template_part('template-parts/footer'); ?>