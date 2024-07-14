<?php

function createHTMLContent($content) {
  $headline = esc_html(get_option('wcp_headline', 'Post Statistics'));
  $getWordCount = get_option('wcp_wordCount', '1');
  $characterCount = get_option('wcp_characterCount', '1');
  $readTime = get_option('wcp_readTime', '1');
  $location = get_option('wcp_location', '0');

  $html = '<h3>' . $headline . '</h3><p>';

  if ($getWordCount or $readTime) {
    $wordCount = str_word_count(strip_tags($content));
  }

  if ($wordCount) {
    $html .= 'This post has ' . $wordCount . ' words.<br>';
  }

  if ($characterCount) {
    $html .= 'This post has ' . strlen(strip_tags($content)) . ' characters.<br>';
  }

  if ($readTime) {
    $html .= 'This post will take about ' . round($wordCount / 225) . ' minute(s) to read.<br>';
  }

  $html .= '</p><br>';

  // Beginning of the post body
  if ($location === '0') {
    return $html . $content;
  }

  // Ending of the post body
  return $content . $html;
}