<?php
get_template_part('template-parts/header');
pageBanner();

$relatedPrograms = get_field('related_programs');

while (have_posts()) :
  the_post();
?>

  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link" href="<?= get_post_type_archive_link('event') ?>">
          <i class="fa fa-home" aria-hidden="true"></i> Events Home
        </a>
        <span class="metabox__main">
          Posted by <?php the_author_posts_link() ?>
          on <?php the_time('M j, Y') ?>
          in <?= get_the_category_list(', ') ?>
        </span>
      </p>
    </div>
    <div class="generic-content">
      <?php the_content() ?>
    </div>

    <?php if ($relatedPrograms) : ?>
      <hr class="section-break">
      <h2 class="headline headline--medium">Related Programs(s)</h2>
      <ul class="link-list min-list">
        <?php foreach ($relatedPrograms as $program) : ?>
          <li>
            <a href="<?php echo get_the_permalink($program) ?>">
              <?php echo get_the_title($program) ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>

<?php
endwhile;

get_template_part('template-parts/footer');
?>