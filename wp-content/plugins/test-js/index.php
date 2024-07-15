<?php

/**
 * Plugin Name: Test JS Plugin
 * Description: Test JS Plugin
 * Version: 1.0
 * Author: Samuel
 * Author URI: https://github.com/samuellaudev
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class TestJsBlock {
  function __construct() {
    add_action('init', [$this, 'adminAssets']);
  }

  function adminAssets() {
    register_block_type(__DIR__, [
      'render_callback' => [$this, 'theHTML']
    ]);
  }

  function theHTML($attributes) {
    ob_start(); ?>
<div class="paying-attention-update-me">
  <pre style='display: none'><?php echo wp_json_encode($attributes) ?></pre>
</div>
<?php return ob_get_clean();
  }
}

$testJsBlock = new TestJsBlock();