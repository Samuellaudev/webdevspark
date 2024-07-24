<?php
$project_date_field = get_field('project_date');
$project_date = null;

if ($project_date_field) {
  $project_date = new DateTime($project_date_field);
} else {
  $project_date = new DateTime(get_the_date('Y-m-d'));
}
?>

<div class="project-summary">
  <div class="project-summary__content cursor-pointer space-y-2 border-b-2 pb-2">
    <h5 class="project-summary__title headline headline--small-plus rounded-md">
      <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
    </h5>
    <a class="project-summary__date flex items-center space-x-2 rounded-md text-center cursor-pointer" href="<?php the_permalink(); ?>">
      <span>Project Date:</span>
      <span class="project-summary__year">
        <?php echo $project_date->format('Y') ?>
      </span>
      <span class="project-summary__month">
        <?php echo $project_date->format('M') ?>
      </span>
    </a>
    <p class="flex flex-col">
      <?php
      if (has_excerpt()) {
        echo get_the_excerpt();
      } else {
        echo wp_trim_words(get_the_content(), 20);
      }
      ?>
      <a href="<?php the_permalink() ?>" class="nu gray cursor-pointer">Read more</a>
    </p>
  </div>
</div>