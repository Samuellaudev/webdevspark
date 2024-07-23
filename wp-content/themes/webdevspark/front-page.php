<?php
get_template_part('template-parts/header');

function getUpcomingEvents() {
  $today = date('Ymd');
  $events = new WP_Query([
    'posts_per_page' => 2,
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      )
    )
  ]);

  return $events;
}

function getBlogPosts() {
  $posts = new WP_Query([
    'posts_per_page' => 2
  ]);

  return $posts;
}

function displayUpcomingEvents() {
  $events = getUpcomingEvents();
  while ($events->have_posts()) {
    $events->the_post();
    get_template_part('template-parts/content', 'events');
  }

  wp_reset_postdata();
}

function displayBlogPosts() {
  $blog_posts = getBlogPosts();
  while ($blog_posts->have_posts()) {
    $blog_posts->the_post();
    get_template_part('template-parts/content', 'events');
  }

  wp_reset_postdata();
}
?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg') ?>)"></div>
  <div class="page-banner__content container t-center c-white">
    <h1 class="headline headline--large">Welcome!</h1>
    <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
    <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
    <a href="<?php echo get_post_type_archive_link('program') ?>" class="btn btn--large btn--blue">Find Your Major</a>
  </div>
</div>

<div class="full-width-split group">
  <div class="full-width-split__one">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
      <?php displayUpcomingEvents(); ?>
      <p class="t-center no-margin">
        <a href="<?php echo site_url('/events') ?>" class="btn btn--blue">View All Events</a>
      </p>
    </div>
  </div>
  <div class="full-width-split__two">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
      <?php displayBlogPosts(); ?>
      <p class="t-center no-margin">
        <a href="<?php echo site_url('/blog') ?>" class="btn btn--yellow">View All Blog Posts</a>
      </p>
    </div>
  </div>
</div>

<?php get_template_part('template-parts/footer'); ?>