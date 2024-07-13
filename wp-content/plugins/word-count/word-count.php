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

    // Display Location
    add_settings_field('wcp_location', 'Display Location', [$this, 'locationHTML'], 'word-count-settings-page', 'wcp_first_section');
    register_setting('wordCountPlugin', 'wcp_location', [
      'sanitize_callback' => [$this, 'sanitizeLocation'],
      'default' => '0'
    ]);

    // Headline Text
    add_settings_field('wcp_headline', 'Headline Text', [$this, 'headlineHtml'], 'word-count-settings-page', 'wcp_first_section');
    register_setting('wordCountPlugin', 'wcp_headline', [
      'sanitize_callback' => 'sanitize_text_field',
      'default' => 'Post Statistics'
    ]);

    // Word Count
    add_settings_field('wcp_wordCount', 'Word Count', [$this, 'checkboxHtml'], 'word-count-settings-page', 'wcp_first_section', ['theName' => 'wcp_wordCount']);
    register_setting('wordCountPlugin', 'wcp_wordCount', [
      'sanitize_callback' => 'sanitize_text_field',
      'default' => '1'
    ]);

    // Character Count
    add_settings_field('wcp_characterCount', 'Character Count', [$this, 'checkboxHtml'], 'word-count-settings-page', 'wcp_first_section', ['theName' => 'wcp_characterCount']);
    register_setting('wordCountPlugin', 'wcp_characterCount', [
      'sanitize_callback' => 'sanitize_text_field',
      'default' => '1'
    ]);

    // Read Time
    add_settings_field('wcp_readTime', 'Read Time', [$this, 'checkboxHtml'], 'word-count-settings-page', 'wcp_first_section', ['theName' => 'wcp_readTime']);
    register_setting('wordCountPlugin', 'wcp_readTime', [
      'sanitize_callback' => 'sanitize_text_field',
      'default' => '1'
    ]);
  }

  function sanitizeLocation($input) {
    if ($input != '0' and $input != '1') {
      add_settings_error('wcp_location', 'wcp_location_error', 'Display location must be either beginning or end.');
      return get_option('wcp_location');
    }

    return $input;
  }

  function checkboxHtml($args) { ?>
<input type="hidden" name='<?php echo $args['theName'] ?>' value='0'>
<input type="checkbox" name='<?php echo $args['theName'] ?>' value='1' <?php checked(get_option($args['theName'], '1')) ?>>
<?php }

  function headlineHtml() { ?>
<input type="text" name='wcp_headline' value='<?php echo esc_attr(get_option('wcp_headline')) ?>'>
<?php }

  function locationHTML() { ?>
<select name="wcp_location" id="">
  <option value="0" <?php selected(get_option('wcp_location', '0')) ?>>Beginning of post</option>
  <option value="1" <?php selected(get_option('wcp_location', '1')) ?>>End of post</option>
</select>
<?php }

  function adminPage() {
    add_options_page(
      'Word Count Settings', // Page title
      'Word Count', // Menu title
      'manage_options', // Capability required to access the page
      'word-count-settings-page', // Menu slug
      [$this, 'settingsPageHtml'] // Callback function to display the page content
    );
  }

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