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
    add_action('init', array($this, 'adminAssets'));
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
    if (!is_admin()) {
      wp_enqueue_script('frontend', plugin_dir_url(__FILE__) . 'build/frontend.js', ['wp-element'], '1.0', true);
      wp_enqueue_style('frontend', plugin_dir_url(__FILE__) . 'build/frontend.css');
    }
    ob_start(); ?>
<div class="paying-attention-update-me"></div>
<?php return ob_get_clean();
  }
}

$testJsBlock = new TestJsBlock();