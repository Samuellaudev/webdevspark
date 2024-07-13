<?php
get_template_part('template-parts/header');
pageBanner();

$professor_id = get_the_ID();
$relatedPrograms = get_field('related_programs');

function getLikeCount($professor_id) {
  $likeCountQuery = new WP_Query([
    'post_type' => 'like',
    'meta_query' => [
      [
        'key' => 'liked_professor_id',
        'compare' => '=',
        'value' => $professor_id
      ]
    ]
  ]);

  return $likeCountQuery->found_posts;
}

function getLikeStatus($professor_id) {
  $like_status = 'no';
  $like_id = null;

  if (is_user_logged_in()) {
    // Check if the current user has liked this professor
    $currentUserLike = new WP_Query([
      'author' => get_current_user_id(),
      'post_type' => 'like',
      'meta_query' => [
        [
          'key' => 'liked_professor_id',
          'compare' => '=',
          'value' => $professor_id
        ]
      ]
    ]);

    if ($currentUserLike->found_posts) {
      $like_status = 'yes';
    }
  }

  // Find the ID of the liked post
  if (isset($currentUserLike->posts[0]->ID)) {
    $like_id = $currentUserLike->posts[0]->ID;
  }

  return [$like_status, $like_id];
}

while (have_posts()) :
  the_post();

  $like_count = getLikeCount($professor_id);
  list($like_status, $like_id) = getLikeStatus($professor_id);
?>

<div class="container container--narrow page-section">
  <div class="generic-content">
    <div class="row group">
      <div class="one-third">
        <?php the_post_thumbnail('professorLandscape'); ?>
      </div>
      <div class="two-thirds">
        <span class="like-box" data-exists="<?php echo $likeStatus ?>" data-professor="<?php the_ID() ?>" data-like="<?php echo $like_id ?>">
          <i class="fa fa-heart-o" aria-hidden="true"></i>
          <i class="fa fa-heart" aria-hidden="true"></i>
          <span class="like-count"><?php echo $like_count; ?></span>
        </span>
        <?php the_content() ?>
      </div>
    </div>
  </div>

  <?php if ($relatedPrograms) : ?>
  <hr class="section-break">
  <h2 class="headline headline--medium">Subject(s) Taught</h2>
  <ul class="link-list min-list">
    <?php foreach ($relatedPrograms as $program) : ?>
    <li>
      <a href="<?php echo get_the_permalink($program) ?>">
        <?php echo get_the_title($program) ?>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php endif ?>
</div>

<?php
endwhile;

get_template_part('template-parts/footer');
?>