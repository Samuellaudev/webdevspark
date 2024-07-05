<?php
get_header();

while (have_posts()) {
  the_post(); ?>
  <h1>This is index.php</h1>
  <h2>
    <a href="<? the_permalink() ?>"><?php the_title() ?></a>
  </h2>
  <?php the_content() ?>
  <hr>
<?php
}

get_footer()
?>