<?php
get_header();

pageBanner(['subtitle' => 'DONT FORGET TO REPLACE ME LATER']);

while (have_posts()) {
  the_post();
?>
  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link" href="<?= site_url('/blog') ?>">
          <i class="fa fa-home" aria-hidden="true"></i> Blog Home
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
  </div>
<?php
}

get_footer();
?>