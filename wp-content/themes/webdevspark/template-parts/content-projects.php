<?php
$project_date_field = get_field('project_date');
$project_date = null;

if ($project_date_field) {
  $project_date = new DateTime($project_date_field);
} else {
  $project_date = new DateTime(get_the_date('Y-m-d'));
}

$changeBorderColor = !is_front_page() ? 'hover:border-black' : 'hover:border-white';
?>

<div class="project-summary">
  <div class='project-summary__content space-y-2 p-2 -translate-x-2 -translate-y-2 border-2 border-transparent hover:translate-x-0.5 hover:translate-y-0.5 rounded-md duration-200 <?php echo $changeBorderColor ?>'>
    <h5 class="project-summary__title headline headline--small-plus rounded-md cursor-pointer <?php if (is_front_page()) echo 'p-0'; ?>">
      <a href="<?php the_permalink(); ?>" class="hover:text-white"><?php the_title() ?></a>
    </h5>
    <?php if (!is_front_page()) : ?>
    <a class="project-summary__date flex items-center space-x-1 rounded-md text-center cursor-pointer" href="<?php the_permalink(); ?>">
      <span class="text-base">Project Date:</span>
      <span class="project-summary__year">
        <?php echo $project_date->format('Y') ?>
      </span>
      <span class="project-summary__month">
        <?php echo $project_date->format('M') ?>
      </span>
    </a>
    <?php endif; ?>

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