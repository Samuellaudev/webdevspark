<?php

function applyFilterLogic($content) {
  $badWords = explode(',', get_option('plugin_words_to_filter'));
  $badWordsTrimmed = array_filter(array_map('trim', $badWords));
  $replacementText = esc_html(get_option('replacement_text', '****'));

  return str_replace($badWordsTrimmed, $replacementText, $content);
}