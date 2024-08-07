<?php
get_template_part('template-parts/header');
pageBanner();

$relatedLanguages = get_field('related_languages');

$githubUrl = get_field('project_github');

$projectUrl = get_field('project_url');

while (have_posts()) :
  the_post();
?>

<div class="container container--narrow page-section">
  <div class="metabox metabox--position-up metabox--with-home-link">
    <p>
      <a class="metabox__blog-home-link cursor-pointer" href="<?= get_post_type_archive_link('project') ?>">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span class="hidden sm:inline">Projects Home</span>
      </a>
      <span class="metabox__main">
        <?php echo the_title() ?>
      </span>
    </p>
  </div>
  <div class="project-info border-b-2 border-b-gray-100 pb-4">
    <div class="flex items-center space-x-4 pt-4 sm:pt-0">
      <span>GitHub Repository: </span>
      <a class="GitHub URL" href="<?php echo $githubUrl ?>" target="_blank">
        <img class="w-6 hover:cursor-pointer hover:opacity-75" alt='GitHub' src="<?php echo get_theme_file_uri('/images/svg/icon-github.svg') ?>">
      </a>
    </div>
    <?php if ($projectUrl) : ?>
    <div class="flex items-center space-x-4">
      <span>Project URL: </span>
      <a class="Project URL" href="<?php echo $projectUrl ?>" target="_blank">
        <span class="opacity-50 hover:cursor-pointer hover:opacity-30">
          <img class="w-6" alt='link' src="<?php echo get_theme_file_uri('/images/svg/icon-link.svg') ?>">
        </span>
      </a>
    </div>
    <?php endif; ?>
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