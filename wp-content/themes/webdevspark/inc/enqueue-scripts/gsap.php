<?php

function enqueue_gsap_scripts() {
  wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', array(), false, true);
  wp_enqueue_script('scroll-trigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', array('gsap'), false, true);
  wp_enqueue_script('custom-gsap', get_template_directory_uri() . '/src/custom-gsap.js', array('gsap', 'scroll-trigger'), false, true);
}

add_action('wp_enqueue_scripts', 'enqueue_gsap_scripts');
