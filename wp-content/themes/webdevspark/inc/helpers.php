<?php

/**
 * Prints a readable format of arrays or objects
 *
 * @param mixed $variable The variable to be printed
 */
function debug_print($variable) {
  echo '<pre>';
  print_r($variable);
  echo '</pre>';
}

/**
 * Prints detailed debugging information about a variable
 *
 * @param mixed $variable The variable to be dumped
 */
function debug_dump($variable) {
  echo '<pre>';
  var_dump($variable);
  echo '</pre>';
}

/**
 * Logs debug data to the WordPress debug log.
 *
 * @param mixed $data The data to be logged.
 * @param string $label Optional. A label to prefix the log entry with. Default is 'DEBUG'.
 */
function debug_log($data, $label = 'DEBUG') {
  if (defined('WP_DEBUG') && WP_DEBUG) {
    $log_entry = $label . ': ' . print_r($data, true);
    error_log($log_entry);
  }
}