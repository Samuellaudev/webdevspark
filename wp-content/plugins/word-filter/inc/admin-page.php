<?php

function isFormSubmitted() {
  return isset($_POST['form_was_submitted']) && $_POST['form_was_submitted'] === 'true';
}

function wordFilterForm() { ?>
<div class="wrap">
  <h1>Word Filter</h1>
  <form method="POST">
    <?php wp_nonce_field('saveFilterWords', 'nonceValue') ?>
    <input type="hidden" name='form_was_submitted' value="true">
    <label for='plugin_words_to_filter'>
      <p>Enter a <strong>comma-separated</strong> list of words to filter from your site's content.</p>
    </label>
    <div class="word-filter__flex-container">
      <textarea name="plugin_words_to_filter" id="plugin_words_to_filter" placeholder="bad, mean, awful, horrible"><?php echo esc_textarea(get_option('plugin_words_to_filter')) ?></textarea>
    </div>
    <input type="submit" value="Save Changes" name="submit" id="submit" class="button button-primary">
  </form>
</div>
<?php }

function displayWordFilterPage() {
  if (isFormSubmitted()) {
    handleForm();
  }

  wordFilterForm();
}
?>