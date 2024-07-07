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
