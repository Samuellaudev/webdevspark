<?php

function applyOptionsSettings() {
  add_settings_section('replacement-text-section', null, null, 'word-filter-options');

  // Field: Filtered Text
  register_setting('replacementFields', 'replacement_text');
  add_settings_field('replacement-text', 'Filtered Text', 'replacementFieldHTML', 'word-filter-options', 'replacement-text-section');
}

function replacementFieldHTML() { ?>
<input type="text" name="replacement_text" value="<?php echo esc_attr(get_option("replacement_text", "***")) ?>">
<p class="description">Leave blank to simply remove the filtered words.</p>
<?php }

function displayOptionsSubPage() { ?>
<div class="wrap">
  <h1>Word Filter Options</h1>
  <form action="options.php" method="POST">
    <?php
      settings_errors();
      settings_fields('replacementFields');
      do_settings_sections('word-filter-options');
      submit_button();
      ?>
  </form>
</div>
<?php }