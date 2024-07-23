<?php
get_template_part('template-parts/header');
pageBanner();

$relatedLanguages = get_field('related_languages');

while (have_posts()) :
  the_post();
?>

  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link cursor-pointer" href="<?= get_post_type_archive_link('project') ?>">
          <i class="fa fa-home" aria-hidden="true"></i> Projects Home
        </a>
        <span class="metabox__main">
          <?php echo the_title() ?>
        </span>
      </p>
    </div>
    <div class="generic-content">
      <?php the_content() ?>
    </div>

    <?php if ($relatedLanguages) : ?>
      <hr class="section-break">
      <h2 class="headline headline--small-plus">Programming Language(s) Used:</h2>
      <ul class="link-list min-list">
        <?php foreach ($relatedLanguages as $language) : ?>
          <li>
            <a href="<?php echo get_the_permalink($language) ?>" class="text-primary-500 cursor-pointer hover:text-primary-400">
              <?php echo get_the_title($language) ?>
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