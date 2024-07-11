<?php
get_template_part('template-parts/header');

pageBanner();

while (have_posts()) {
  the_post();
?>
<div class="container container--narrow page-section">
  <div class="generic-content">
    <div class="row group">
      <div class="one-third">
        <?php the_post_thumbnail('professorLandscape'); ?>
      </div>
      <div class="two-thirds">
        <?php
          // Get the like count
          $likeCount = new WP_Query([
            'post_type' => 'like',
            'meta_query' => [
              [
                'key' => 'liked_professor_id',
                'compare' => '=',
                'value' => get_the_ID()
              ]
            ]
          ]);

          $likeStatus = 'no';

          // Check if the current user has liked this professor
          $currentUserLike = new WP_Query([
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => [
              [
                'key' => 'liked_professor_id',
                'compare' => '=',
                'value' => get_the_ID()
              ]
            ]
          ]);

          if ($currentUserLike->found_posts) {
            $likeStatus = 'yes';
          }
          ?>

        <span class="like-box" data-exists="<?php echo $likeStatus ?>" data-professor="<?php the_ID() ?>">
          <i class="fa fa-heart-o" aria-hidden="true"></i>
          <i class="fa fa-heart" aria-hidden="true"></i>
          <span class="like-count"><?php echo $likeCount->found_posts; ?></span>
        </span>
        <?php the_content() ?>
      </div>
    </div>
  </div>

  <?php
    $relatedPrograms = get_field('related_programs');

    if ($relatedPrograms) { ?>
  <hr class="section-break">
  <h2 class="headline headline--medium">Subject(s) Taught</h2>
  <ul class="link-list min-list">
    <?php foreach ($relatedPrograms as $program) : ?>
    <li>
      <a href="<?= get_the_permalink($program) ?>">
        <?= get_the_title($program) ?>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php } ?>
</div>

<?php
}

get_template_part('template-parts/footer');
?>