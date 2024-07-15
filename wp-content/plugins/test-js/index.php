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
    add_action('enqueue_block_editor_assets', array($this, 'adminAssets'));
  }

  function adminAssets() {
    wp_register_style('quizEditCss', plugin_dir_url(__FILE__) . 'build/index.css');
    wp_register_script('newBlockType', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor'));
    register_block_type('js-plugin/test-js-plugin', array(
      'editor_style' => 'quizEditCss',
      'editor_script' => 'newBlockType',
      'render_callback' => array($this, 'theHTML')
    ));
  }

  function theHTML($attributes) {
    ob_start(); ?>
<h3>
  Today the sky is <?php echo esc_html($attributes['skyColor']) ?> and the grass is <?php echo esc_html($attributes['grassColor']) ?>!!!
</h3>
<?php return ob_get_clean();
  }
}

$testJsBlock = new TestJsBlock();