<?php

/**
 * Plugin Name:       Custom Multiple Blocks
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Samuel Lau
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       customMultipleBlocks
 *
 * @package custom-multiple-blocks
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class CustomMultipleBlocks {
	function __construct() {
		add_action('init', [$this, 'custom_multiple_blocks_init']);
	}

	function custom_multiple_blocks_init() {
		register_block_type(__DIR__ . '/build/hoverCardDemo');
		register_block_type(__DIR__ . '/build/accordionDemo');
	}
}

$customMultipleBlocks = new CustomMultipleBlocks();
