<?php
get_header();

$args = [
  'title' => 'Past Events',
  'subtitle' => 'A recap of our past events.'
];
pageBanner($args);
?>
<div class="container container--narrow page-section">
  <?php
  $today = date('Ymd');
  $pastEvents = new WP_Query([
    'paged' => get_query_var('paged', 1),
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => [
      array(
        'key' => 'event_date',
        'compare' => '<',
        'value' => $today,
        'type' => 'numeric'
      )
    ]
  ])
  ?>

  <?php while ($pastEvents->have_posts()) { ?>
    <?php $pastEvents->the_post(); ?>
    <div class="event-summary">
      <a class="event-summary__date t-center" href="#">
        <?php $eventDate = new DateTime(get_field('event_date')) ?>
        <span class="event-summary__month">
          <?php echo $eventDate->format('M') ?>
        </span>
        <span class="event-summary__day">
          <?php echo $eventDate->format('d') ?>
        </span>
      </a>
      <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title() ?>
          </a></h5>
        <p><?= wp_trim_words(get_the_content(), 20) ?>
          <a href="<?php the_permalink() ?>" class="nu gray">Read more</a>
        </p>
      </div>
    </div>
  <?php } ?>
  <?php echo paginate_links([
    'total' => $pastEvents->max_num_pages
  ]) ?>
</div>

<?php get_footer(); ?>