<?php

/**
 * Plugin Name: First Test Plugin
 * Description: This plugin is a test plugin
 * Version: 1.0
 * Author: Samuel
 * Author URI: https://github.com/samuellaudev
 */


class WordCountPlugin {
  function __construct() {
    add_action('admin_menu', [$this, 'adminPage']);
    add_action('admin_init', [$this, 'settings']);
  }

  function settings() {
    add_settings_section('wcp_first_section', 'Settings Section', null, 'word-count-settings-page');
    add_settings_field('wcp_location', 'Display Location', [$this, 'locationHTML'], 'word-count-settings-page', 'wcp_first_section');
    register_setting('wordCountPlugin', 'wcp_location', [
      'sanitize_callback' => 'sanitize_text_field',
      'default' => '0'
    ]);
  }

  function adminPage() {
    add_options_page(
      'Word Count Settings', // Page title
      'Word Count', // Menu title
      'manage_options', // Capability required to access the page
      'word-count-settings-page', // Menu slug
      [$this, 'settingsPageHtml'] // Callback function to display the page content
    );
  }

  function locationHTML() { ?>
<select name="wcp_location" id="">
  <option value="0">Beginning of post</option>
  <option value="1">End of post</option>
</select>
<?php }

  function settingsPageHtml() { ?>
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
}

$wordCountPlugin = new WordCountPlugin();