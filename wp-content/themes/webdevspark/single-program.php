<?php
get_header();

while (have_posts()) {
  the_post(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?= get_theme_file_uri('images/ocean.jpg') ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title() ?>
      </h1>
      <div class="page-banner__intro">
        <p>DONT FORGET TO REPLACE ME LATER</p>
      </div>
    </div>
  </div>

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
      <?php the_content() ?>
    </div>

    <?php
    // Query related professors
    $relatedProfessors = new WP_Query(([
      'posts_per_page' => -1,
      'post_type' => 'professor',
      'orderby' => 'title',
      'order' => 'ASC',
      'meta_query' => [
        [
          'key' => 'related_programs',
          'compare' => 'LIKE',
          'value' => get_the_ID()
        ]
      ]
    ]))
    ?>

    <?php if ($relatedProfessors->have_posts()) { ?>
      <hr class="section-break">
      <h3 class="headline headline--small-plus">
        <?php get_the_title() ?> Professors
      </h3>

      <ul class="professor-cards">
        <?php while ($relatedProfessors->have_posts()) {
          $relatedProfessors->the_post(); ?>
          <li class="professor-card__list-item">
            <a class="professor-card" href="<?php the_permalink() ?>">
              <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorPortrait') ?>" alt="">
              <span class="professor-card__name"><?php the_title() ?></span>
            </a>
          </li>
        <?php } ?>
      </ul>
      <?php wp_reset_postdata(); ?>
    <?php } ?>

    <?php
    // Query upcoming events related to the current program
    $today = date('Ymd');
    $homepageEvents = new WP_Query(array(
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
          'value' => get_the_ID()
        )
      ]
    ));
    ?>

    <?php if ($homepageEvents->have_posts()) { ?>
      <hr class="section-break">
      <h3 class="headline headline--small-plus">
        Upcoming <?php get_the_title() ?> Events
      </h3>

      <?php while ($homepageEvents->have_posts()) {
        $homepageEvents->the_post(); ?>

        <div class="event-summary">
          <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
            <?php $eventDate = new DateTime(get_field('event_date')) ?>
            <span class="event-summary__month">
              <?php echo $eventDate->format('M') ?>
            </span>
            <span class="event-summary__day">
              <?php echo $eventDate->format('d') ?>
            </span>
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny">
              <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
            </h5>
            <p>
              <?php
              if (has_excerpt()) {
                echo get_the_excerpt();
              } else {
                echo wp_trim_words(get_the_content(), 20);
              }
              ?>
              <a href="<?php the_permalink() ?>" class="nu gray">Read more</a>
            </p>
          </div>
        </div>

      <?php }
      wp_reset_postdata();
      ?>
    <?php } ?>
  </div>

<?php }

get_footer();
?>