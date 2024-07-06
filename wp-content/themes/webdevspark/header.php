<!DOCTYPE html>
<!-- outputs the language attributes for the HTML tag based on the language settings configured in WordPress -->
<html <?php language_attributes() ?>>

<head>
  <!-- Set the character set to match the WordPress installation -->
  <meta charset="<?php bloginfo('charset') ?>">
  <!-- Set the viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<!-- adds various CSS classes to the body element based on the context of the current page.  -->

<body <?php body_class() ?>>
  <header class="site-header">
    <div class="container">
      <h1 class="school-logo-text float-left">
        <a href="<?php echo site_url() ?>"><strong>Fictional</strong> University</a>
      </h1>
      <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <ul>
            <li <?php if (is_page('about-us') || wp_get_post_parent_id(get_the_ID()) === 5) echo 'class="current-menu-item"' ?>>
              <a href="<?= site_url('/about-us') ?>">About Us</a>
            </li>
            <li <?php if (is_page('programs') || wp_get_post_parent_id(get_the_ID()) === 5) echo 'class="current-menu-item"' ?>>
              <a href="<?= site_url('/programs') ?>">Programs</a>
            </li>
            <li <?php if (is_page('events') || wp_get_post_parent_id(get_the_ID()) === 5) echo 'class="current-menu-item"' ?>>
              <a href="<?= site_url('/events') ?>">Events</a>
            </li>
            <li <?php if (is_page('campuses') || wp_get_post_parent_id(get_the_ID()) === 5) echo 'class="current-menu-item"' ?>>
              <a href="<?= site_url('/campuses') ?>">Campuses</a>
            </li>
            <li <?php if (get_post_type() === 'post') echo 'class="current-menu-item"' ?>>
              <a href="<?= site_url('/blog') ?>">Blog</a>
            </li>
          </ul>
        </nav>
        <div class="site-header__util">
          <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
          <a href="#" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
          <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
      </div>
    </div>
  </header>