<?php
get_template_part('template-parts/header');
pageBanner();

$theParent = wp_get_post_parent_id(get_the_ID());

// Retrieve an array of child pages of the current post
$childPageData = get_pages([
  'child_of' => get_the_ID()
]);

while (have_posts()) :
  the_post(); ?>
  <div class="container container--narrow page-section">
    <?php if ($theParent) : ?>
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent) ?>">
            <i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent) ?>
          </a>
          <span class="metabox__main"><?php echo the_title() ?>
          </span>
        </p>
      </div>
    <?php endif; ?>

    <!-- Check if the current post has a parent or if it has child pages -->
    <?php if ($theParent || $childPageData) : ?>
      <div class="page-links">
        <h2 class="page-links__title">
          <a href="<?php echo site_url('about') ?>"><?php echo get_the_title($theParent) ?></a>
        </h2>
        <ul class="min-list">
          <!-- Determine the ID of the post whose children should be listed -->
          <?php
          if ($theParent) {
            $findChildrenOf = $theParent;
          } else {
            $findChildrenOf = get_the_ID();
          }

          // List child pages of the determined post
          wp_list_pages([
            'title_li' => null,
            'child_of' => $findChildrenOf,
            'sort_column' => 'menu_order'
          ])
          ?>
        </ul>
      </div>
    <?php endif; ?>

    <div class="generic-content">
      <?php the_content() ?>
    </div>
  </div>

<?php
endwhile;

get_template_part('template-parts/footer');
?>