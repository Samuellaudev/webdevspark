<?php

/**
 * Plugin Name: Word Filter Plugin
 * Description: This plugin is a test plugin
 * Version: 1.0
 * Author: Samuel
 * Author URI: https://github.com/samuellaudev
 */

if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'inc/admin-page.php';
require_once plugin_dir_path(__FILE__) . 'inc/form-handler.php';

class WordFilterPlugin {
  public function __construct() {
    add_action('admin_menu', [$this, 'menu']);
  }

  function menu() {
    $mainPageHook = add_menu_page(
      'Words To Filter',
      'Word Filter',
      'manage_options',
      'word-filter',
      [$this, 'wordFilterPage'],
      'data:image/svg+xml;base64,HN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMCAyMEMxNS41MjI5IDIwIDIwIDE1LjUyMjkgMjAgMTBDMjAgNC40NzcxNCAxNS41MjI5IDAgMTAgMEM0LjQ3NzE0IDAgMCA0LjQ3NzE0IDAgMTBDMCAxNS41MjI5IDQuNDc3MTQgMjAgMTAgMjBaTTExLjk5IDcuNDQ2NjZMMTAuMDc4MSAxLjU2MjVMOC4xNjYyNiA3LjQ0NjY2SDEuOTc5MjhMNi45ODQ2NSAxMS4wODMzTDUuMDcyNzUgMTYuOTY3NEwxMC4wNzgxIDEzLjMzMDhMMTUuMDgzNSAxNi45Njc0TDEzLjE3MTYgMTEuMDgzM0wxOC4xNzcgNy40NDY2NkgxMS45OVoiIGZpbGw9IiNGRkRGOEQiLz4KPC9zdmc+',
      100
    );
    add_submenu_page('word-filter', 'Words To Filter', 'Words List', 'manage_options', 'word-filter', [$this, 'wordFilterPage']);
    add_submenu_page('word-filter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', [$this, 'optionsSubPage']);
    add_action("load-{$mainPageHook}", [$this, 'mainPageAssets']);
  }

  function mainPageAssets() {
    wp_enqueue_style('filterAdminCss', plugin_dir_url(__FILE__) . 'style.css');
  }

  function wordFilterPage() {
    displayWordFilterPage();
  }

  function optionsSubPage() { ?>
test2
<?php }
}


$wordFilterPlugin = new WordFilterPlugin();