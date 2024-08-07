<?php

/**
 * Outputs a page banner with optional custom title, subtitle, and background image.
 *
 * @param array $args Arguments to customize the banner.
 */
function pageBanner($args = null) {
  if (!isset($args['photo'])) {
    // Check if a custom page banner background image exists and it's not an archive or home page
    if (get_field('page_banner_background_image') && !is_archive() && !is_home()) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/programming-languages.jpg');
    }
  }

  // Set the title to the current post's title if it's not provided in the arguments
  if (!isset($args['title'])) {
    $args['title'] = get_the_title();
  }

  // Set the subtitle to the page's custom field subtitle if it's not provided in the arguments
  if (!isset($args['subtitle'])) {
    $args['subtitle']  = get_field('page_banner_subtitle');
  }


?>
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo esc_url($args['photo']) ?>)"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title pt-10"><?php echo esc_html($args['title']) ?>
    </h1>
    <div class="page-banner__intro">
      <p><?php echo esc_html($args['subtitle']) ?></p>
    </div>
  </div>
</div>
<?php
}
?>