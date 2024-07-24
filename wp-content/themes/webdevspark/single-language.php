<?php
get_template_part('template-parts/header');
pageBanner();

$language_id = get_the_ID();

function getRelatedProjects($language_id) {
  $projects = new WP_Query(array(
    'posts_per_page' => 2,
    'post_type' => 'project',
    'meta_key' => 'project_date',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'meta_query' => [
      array(
        'key' => 'related_languages',
        'compare' => 'LIKE',
        'value' => '"' . $language_id . '"'
      )
    ]
  ));

  return $projects;
}

while (have_posts()) :
  the_post();

  $counter = 0;

  $projects = getRelatedProjects($language_id);
?>

<div class="container container--narrow page-section">
  <div class="metabox metabox--position-up metabox--with-home-link">
    <p>
      <a class="metabox__blog-home-link cursor-pointer" href="<?= get_post_type_archive_link('language') ?>">
        <i class="fa fa-home" aria-hidden="true"></i> All Languages
      </a>
      <span class="metabox__main">
        <?php echo the_title() ?>
      </span>
    </p>
  </div>
  <div class="generic-content">
    <?php the_field('main_body_content') ?>
  </div>

  <div class="headline headline--small-plus mb-4">
    Related Project(s)
  </div>
  <?php if ($projects->have_posts()) :
      while ($projects->have_posts()) :
        $projects->the_post();
        $counter++;

        if ($counter % 2 === 0) {
          echo '<div class="event-project">';
        } else {
          echo '<div class="odd-project">';
        }
        get_template_part('template-parts/content', 'projects');
        echo '</div>';
      endwhile;
    ?>
  <?php wp_reset_postdata(); ?>
  <?php endif; ?>
</div>
<?php
endwhile;

get_template_part('template-parts/footer');
?>