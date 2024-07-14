<?php

/**
 * Plugin Name: Word Filter Plugin
 * Description: This plugin is a test plugin
 * Version: 1.0
 * Author: Samuel
 * Author URI: https://github.com/samuellaudev
 */

if (!defined('ABSPATH')) exit;

class WordFilterPlugin {
  public function __construct() {
    add_action('admin_menu', [$this, 'menu']);
  }

  function menu() {
    $mainPageHook = add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'word-filter', array($this, 'wordFilterPage'), 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMCAyMEMxNS41MjI5IDIwIDIwIDE1LjUyMjkgMjAgMTBDMjAgNC40NzcxNCAxNS41MjI5IDAgMTAgMEM0LjQ3NzE0IDAgMCA0LjQ3NzE0IDAgMTBDMCAxNS41MjI5IDQuNDc3MTQgMjAgMTAgMjBaTTExLjk5IDcuNDQ2NjZMMTAuMDc4MSAxLjU2MjVMOC4xNjYyNiA3LjQ0NjY2SDEuOTc5MjhMNi45ODQ2NSAxMS4wODMzTDUuMDcyNzUgMTYuOTY3NEwxMC4wNzgxIDEzLjMzMDhMMTUuMDgzNSAxNi45Njc0TDEzLjE3MTYgMTEuMDgzM0wxOC4xNzcgNy40NDY2NkgxMS45OVoiIGZpbGw9IiNGRkRGOEQiLz4KPC9zdmc+', 100);
    add_submenu_page('word-filter', 'Words To Filter', 'Words List', 'manage_options', 'word-filter', array($this, 'wordFilterPage'));
    add_submenu_page('word-filter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', array($this, 'optionsSubPage'));
    add_action("load-{$mainPageHook}", array($this, 'mainPageAssets'));
  }

  function mainPageAssets() {
    wp_enqueue_style('filterAdminCss', plugin_dir_url(__FILE__) . 'style.css');
  }

  function wordFilterPage() { ?>
<div class="wrap">
  <h1>Word Filter</h1>

  <form method="POST">
    <input type="hidden" name='justsubmitted' value="true">
    <label for='plugin_words_to_filter'>
      <p>Enter a <strong>comma-separated</strong> list of words to filter from your site's content.</p>
    </label>
    <div class="word-filter__flex-container">
      <textarea name="plugin_words_to_filter" id="plugin_words_to_filter" placeholder="bad, mean, awful, horrible"><?php echo esc_textarea(get_option('plugin_words_to_filter')) ?></textarea>
    </div>
    <input type="submit" value="Save Changes" name="submit" id="submit" class="button button-primary">
  </form>
</div>
<?php }

  function optionsSubPage() { ?>
test2
<?php }
}

$wordFilterPlugin = new WordFilterPlugin();