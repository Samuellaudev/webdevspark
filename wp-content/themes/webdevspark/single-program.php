<?php
get_template_part('template-parts/header');
pageBanner(['subtitle' => 'DONT FORGET TO REPLACE ME LATER']);

$program_id = get_the_ID();

function getRelatedProfessors($program_id) {
  $professors = new WP_Query(([
    'posts_per_page' => -1,
    'post_type' => 'professor',
    'orderby' => 'title',
    'order' => 'ASC',
    'meta_query' => [
      [
        'key' => 'related_programs',
        'compare' => 'LIKE',
        'value' => '"' . $program_id . '"'
      ]
    ]
  ]));

  return $professors;
}

function getUpcomingEvents($program_id) {
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
        'key' => 'related_programs',
        'compare' => 'LIKE',
        'value' => '"' . $program_id . '"'
      )
    ]
  ));

  return $events;
}

while (have_posts()) :
  the_post();

  $related_professors = getRelatedProfessors($program_id);
  $upcoming_events = getUpcomingEvents($program_id);
?>

<div class="container container--narrow page-section">
  <div class="metabox metabox--position-up metabox--with-home-link">
    <p>
      <a class="metabox__blog-home-link" href="<?= get_post_type_archive_link('program') ?>">
        <i class="fa fa-home" aria-hidden="true"></i> All Programs
      </a>
      <span class="metabox__main">
        Posted by <?php the_author_posts_link() ?>
        on <?php the_time('M j, Y') ?>
        in <?= get_the_category_list(', ') ?>
      </span>
    </p>
  </div>
  <div class="generic-content">
    <?php the_field('main_body_content') ?>
  </div>

  <?php if ($related_professors->have_posts()) : ?>
  <hr class="section-break">
  <h3 class="headline headline--small-plus">
    <?php get_the_title() ?> Professors
  </h3>
  <ul class="professor-cards">
    <?php while ($related_professors->have_posts()) :
          $related_professors->the_post(); ?>
    <li class="professor-card__list-item">
      <a class="professor-card" href="<?php the_permalink() ?>">
        <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorPortrait') ?>" alt="">
        <span class="professor-card__name"><?php the_title() ?></span>
      </a>
    </li>
    <?php endwhile; ?>
  </ul>
  <?php wp_reset_postdata(); ?>
  <?php endif; ?>

  <?php if ($upcoming_events->have_posts()) : ?>
  <hr class="section-break">
  <h3 class="headline headline--small-plus">
    Upcoming <?php get_the_title() ?> Events
  </h3>

  <?php
      while ($upcoming_events->have_posts()) :
        $upcoming_events->the_post();
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