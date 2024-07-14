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
    add_menu_page('Words To Filter', 'Word Filter', 'manage_options', 'word-filter', array($this, 'wordFilterPage'), 'dashicons-smiley', 100);
    add_submenu_page('word-filter', 'Words to Filter', 'Words List', 'manage_options', 'word-filter', array($this, 'wordFilterPage'));
    add_submenu_page('word-filter', 'Word Filter Options', 'Options', 'manage_options', 'word-filter-options', array($this, 'optionsSubPage'));
  }

  function wordFilterPage() { ?>
test1
<?php }

  function optionsSubPage() { ?>
test2
<?php }
}

$wordFilterPlugin = new WordFilterPlugin();