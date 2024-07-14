<?php

function isFormValid() {
  return isset($_POST['nonceValue']) &&
    wp_verify_nonce($_POST['nonceValue'], 'saveFilterWords') &&
    current_user_can('manage_options');
}

function updateFilterWords() {
  update_option('plugin_words_to_filter', sanitize_text_field($_POST['plugin_words_to_filter']));
}

function showSuccessMessage() { ?>
<div class="updated">
  <p>Your filtered words were saved.</p>
</div>
<?php }

function handleForm() {
  if (isFormValid()) {
    updateFilterWords();
    showSuccessMessage();
  }
}
?>