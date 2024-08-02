<?php
get_template_part('template-parts/header');
pageBanner();

while (have_posts()) :
  the_post();
?>
  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link" href="<?= site_url('/blog') ?>">
          <i class="fa fa-home" aria-hidden="true"></i>
          <span class="hidden sm:inline">Blog Home</span>
        </a>
        <span class="metabox__main">
          <span class="hidden sm:inline">Posted by <?php the_author_posts_link() ?></span>
          <span class="hidden sm:inline">on</span> <?php the_time('M j, Y') ?>
          in <?= get_the_category_list(', ') ?>
        </span>
      </p>
    </div>
    <div class="generic-content py-5 md:py-0">
      <?php the_content() ?>
    </div>
  </div>
<?php
endwhile;

get_template_part('template-parts/footer');
?>