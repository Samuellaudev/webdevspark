<?php

/**
 * Plugin Name: Word Count Plugin
 * Description: It provides real-time word count statistics for posts, pages, and custom post types
 * Version: 1.0
 * Author: Samuel
 * Author URI: https://github.com/samuellaudev
 */

require_once plugin_dir_path(__FILE__) . '/inc/admin-settings.php';
require_once plugin_dir_path(__FILE__) . '/inc/html-helpers.php';
require_once plugin_dir_path(__FILE__) . '/inc/utilities.php';

class WordCountPlugin {
  public function __construct() {
    add_action('admin_menu', [$this, 'adminPage']);
    add_action('admin_init', [$this, 'settings']);
    add_filter('the_content', [$this, 'wrapContentIf']);
  }

  // Add options page to WordPress admin menu
  public function adminPage() {
    add_options_page(
      'Word Count Settings', // Page title
      'Word Count', // Menu title
      'manage_options', // Capability required to access the page
      'word-count-settings-page', // Menu slug
      [$this, 'settingsPageHtml'] // Callback function to display the page content
    );
  }

  // Render settings page HTML
  public function settingsPageHtml() { ?>
    <div class="wrap">
      <h1>Word Count Settings</h1>
      <form action="options.php" method="post">
        <?php
        settings_fields('wordCountPlugin');
        do_settings_sections('word-count-settings-page');
        submit_button();
        ?>
      </form>
    </div>
<?php
  }

  // Register settings and sections
  public function settings() {
    addSettings();
  }

  // Check if content should be wrapped based on plugin settings
  public function wrapContentIf($content) {
    if (is_main_query() and is_single() and (
      get_option('wcp_wordCount', '1') or
      get_option('wcp_characterCount', '1') or
      get_option('wcp_readTime', '1')
    )) {
      return $this->wrapContent($content);
    }

    return $content;
  }

  private function wrapContent($content) {
    return createHTMLContent($content);
  }
}

$wordCountPlugin = new WordCountPlugin();
