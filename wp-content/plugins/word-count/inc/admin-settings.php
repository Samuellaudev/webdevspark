<?php
// Define callback functions in the global scope

function addSettings() {
  add_settings_section('wcp_first_section', 'Settings Section', null, 'word-count-settings-page');

  // Display Location
  add_settings_field('wcp_location', 'Display Location', 'locationHTML', 'word-count-settings-page', 'wcp_first_section');
  register_setting('wordCountPlugin', 'wcp_location', [
    'sanitize_callback' => 'sanitizeLocation',
    'default' => '0'
  ]);

  // Headline Text
  add_settings_field('wcp_headline', 'Headline Text', 'headlineHtml', 'word-count-settings-page', 'wcp_first_section');
  register_setting('wordCountPlugin', 'wcp_headline', [
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'Post Statistics'
  ]);

  // Word Count
  add_settings_field('wcp_wordCount', 'Word Count', 'checkboxHtml', 'word-count-settings-page', 'wcp_first_section', ['theName' => 'wcp_wordCount']);
  register_setting('wordCountPlugin', 'wcp_wordCount', [
    'sanitize_callback' => 'sanitize_text_field',
    'default' => '1'
  ]);

  // Character Count
  add_settings_field('wcp_characterCount', 'Character Count', 'checkboxHtml', 'word-count-settings-page', 'wcp_first_section', ['theName' => 'wcp_characterCount']);
  register_setting('wordCountPlugin', 'wcp_characterCount', [
    'sanitize_callback' => 'sanitize_text_field',
    'default' => '1'
  ]);

  // Read Time
  add_settings_field('wcp_readTime', 'Read Time', 'checkboxHtml', 'word-count-settings-page', 'wcp_first_section', ['theName' => 'wcp_readTime']);
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