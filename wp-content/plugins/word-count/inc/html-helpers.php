<?php

function checkboxHtml($args) {
  ob_start();
?>
<input type="hidden" name='<?php echo $args['theName'] ?>' value='0'>
<input type="checkbox" name='<?php echo $args['theName'] ?>' value='1' <?php checked(get_option($args['theName'], '1')) ?>>
<?php
  echo ob_get_clean();
}

function headlineHtml() {
  ob_start();
?>
<input type="text" name='wcp_headline' value='<?php echo esc_attr(get_option('wcp_headline')) ?>'>
<?php
  echo ob_get_clean();
}

function locationHTML() {
  ob_start();
?>
<select name="wcp_location" id="">
  <option value="0" <?php selected(get_option('wcp_location', '0')) ?>>Beginning of post</option>
  <option value="1" <?php selected(get_option('wcp_location', '1')) ?>>End of post</option>
</select>
<?php
  echo ob_get_clean();
}
?>