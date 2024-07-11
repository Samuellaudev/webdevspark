<?php
if (!is_user_logged_in()) {
  wp_redirect(esc_url(site_url('/')));
  exit;
}

get_template_part('template-parts/header');

$args = [
  'subtitle' => 'Learn how the school of your dreams got started.'
];
pageBanner($args);

while (have_posts()) {
  the_post();
?>
<div class="container container--narrow page-section">
  <div class="create-note">
    <h2 class="headline headline--medium">Create New Note</h2>
    <input type="text" class="new-note-title" placeholder="Title">
    <textarea class="new-note-body" placeholder="Your note here..."></textarea>
    <span class="submit-note">Create Note</span>
    <span class="note-limit-message">
      Note limit reached: delete an existing note to make room for a new one.
    </span>
  </div>
  <ul class="min-list link-list" id='my-notes'>
    <?php
      $userNotes = new WP_Query([
        'post_type' => 'note',
        'posts_per_page' => -1,
        'author' => get_current_user_id()
      ]);

      while ($userNotes->have_posts()) {
        $userNotes->the_post();
        $formattedTitle = str_replace('Private: ', '', esc_attr(get_the_title()));
      ?>
    <li data-id='<?php the_ID() ?>'>
      <input readonly type="text" class="note-title-field" value="<?php echo $formattedTitle ?>">
      <span class="edit-note">
        <i class="fa fa-pencil" aria-hidden="true"></i> Edit
      </span>
      <span class="delete-note">
        <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
      </span>
      <textarea readonly name="" id="" cols='30' rows='10' class="note-body-field"><?php echo esc_textarea(wp_strip_all_tags(get_the_content())) ?></textarea>
      <span class="update-note btn btn--blue btn--small">
        <i class="fa fa-arrow-right" aria-hidden="true"></i> Save
      </span>
    </li>
    <?php } ?>

  </ul>
</div>

<?php
}

get_template_part('template-parts/footer');
?>