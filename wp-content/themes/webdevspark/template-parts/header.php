<!DOCTYPE html>
<html <?php language_attributes() ?>>

<head>
  <meta charset="<?php bloginfo('charset') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
  <header class="site-header fixed mx-auto border border-[#33353F] bg-[#121212] bg-opacity-80 backdrop-blur-md backdrop-opacity-80 z-[100]">
    <div class="container">
      <h1 class="school-logo-text float-left">
        <a href="<?php echo site_url() ?>"><strong>WebDev</strong>Spark</a>
      </h1>
      <!-- mobile menu -->
      <span class="js-search-trigger site-header__search-trigger pt-1"><i class="fa fa-search" aria-hidden="true"></i></span>
      <div class="block sm:hidden">
        <i class="site-header__menu-trigger fa fa-bars mt-1" aria-hidden="true"></i>
      </div>
      <!-- desktop menu -->
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <ul>
            <li <?php if (is_page('about') || wp_get_post_parent_id(get_the_ID()) === 5) echo 'class="current-menu-item"' ?>>
              <a href="<?= site_url('/about') ?>">About</a>
            </li>
            <li <?php if (get_post_type() === 'project') echo 'class="current-menu-item"' ?>>
              <a href="<?php echo get_post_type_archive_link('project') ?>">Projects</a>
            </li>
            <li <?php if (get_post_type() === 'language') echo 'class="current-menu-item"' ?>>
              <a href="<?php echo get_post_type_archive_link('language') ?>">Languages</a>
            </li>
            <li <?php if (get_post_type() === 'post') echo 'class="current-menu-item"' ?>>
              <a href="<?= site_url('/blog') ?>">Blog</a>
            </li>
          </ul>
        </nav>
        <div class="site-header__util">
          <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
      </div>
    </div>
  </header>