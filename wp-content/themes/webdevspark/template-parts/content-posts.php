<?php
$post_date = new DateTime(get_the_date('Y-m-d'));
?>

<div class="post-summary">
  <a class="post-summary__date post-summary__date--beige t-center" href="<?php the_permalink(); ?>">
    <span class="post-summary__month">
      <?php echo $post_date->format('M') ?>
    </span>
    <span class="post-summary__day">
      <?php echo $post_date->format('d') ?>
    </span>
  </a>
  <div class="post-summary__content p-2 -translate-x-2 -translate-y-2 border-2 border-transparent hover:translate-x-0.5 hover:translate-y-0.5 hover:border-white rounded-md duration-200">
    <h5 class="post-summary__title headline headline--tiny cursor-pointer">
      <a href="<?php the_permalink(); ?>" class="text-white"><?php the_title() ?></a>
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