<?php
get_template_part('template-parts/header');

pageBanner();

while (have_posts()) {
  the_post();
?>
  <div class="container container--narrow page-section">
    <div class="generic-content">
      <div class="row group">
        <div class="one-third">
          <?php the_post_thumbnail('professorLandscape'); ?>
        </div>
        <div class="two-thirds">
          <?php the_content() ?>
        </div>
      </div>
    </div>

    <?php
    $relatedPrograms = get_field('related_programs');

    if ($relatedPrograms) { ?>
      <hr class="section-break">
      <h2 class="headline headline--medium">Subject(s) Taught</h2>
      <ul class="link-list min-list">
        <?php foreach ($relatedPrograms as $program) : ?>
          <li>
            <a href="<?= get_the_permalink($program) ?>">
              <?= get_the_title($program) ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php } ?>
  </div>

<?php
}

get_template_part('template-parts/footer');
?>