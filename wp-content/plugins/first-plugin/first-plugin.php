<?php

/**
 * Plugin Name: First Test Plugin
 * Description: This plugin is a test plugin
 * Version: 1.0
 * Author: Samuel
 * Author URI: https://github.com/samuellaudev
 */

function addToEndOfPost($content) {
  return '<p>It\'s cool!</>' . $content . '<p>My name is Samuel.</>';
}

add_filter('the_content', 'addToEndOfPost');