<?php
get_template_part('template-parts/header');
pageBanner();

$language_id = get_the_ID();

// To be modified
function getRelatedProjects($language_id) {
  $today = date('Ymd');
  $events = new WP_Query(array(
    'posts_per_page' => 2,
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => [
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      ),
      array(
        'key' => 'related_languages',
        'compare' => 'LIKE',
        'value' => '"' . $language_id . '"'
      )
    ]
  ));

  return $events;
}

while (have_posts()) :
  the_post();

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
        get_template_part('template-parts/content', 'events');
      endwhile;
    ?>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
  </div>
<?php
endwhile;

get_template_part('template-parts/footer');
?>