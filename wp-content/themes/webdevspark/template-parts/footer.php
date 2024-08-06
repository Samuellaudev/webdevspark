<?php
$socialLinks = [
  [
    'class' => 'social-icon-github',
    'href' => 'https://github.com/samuellaudev',
    'src' => '/images/svg/icon-github.svg'
  ],
  [
    'class' => 'social-icon-linkedin',
    'href' => 'https://www.linkedin.com/in/samuel-cf-lau/',
    'src' => '/images/svg/icon-linkedin.svg'
  ],
  [
    'class' => 'social-icon-instagram',
    'href' => 'https://www.instagram.com/samuel_cf_lau/',
    'src' => '/images/svg/icon-instagram.svg'
  ]
]
?>


<footer class="site-footer">
  <div class="container container--narrow">
    <div class="group">
      <div class="site-footer__col-one">
        <h1 class="school-logo-text school-logo-text--alt-color">
          <a href="<?php echo site_url() ?>"><strong>WebDev</strong>Spark</a>
        </h1>
      </div>

      <div class="site-footer__col-two-three-group pt-5 sm:pt-0">
        <div class="site-footer__col-two">
          <h3 class="headline headline--small">Explore</h3>
          <nav class="nav-list">
            <?php wp_nav_menu([
              'theme_location' => 'footerLocationOne'
            ]) ?>
          </nav>
        </div>

        <div class="site-footer__col-three">
          <h3 class="headline headline--small">Get in Touch</h3>
          <nav class="nav-list">
            <?php wp_nav_menu([
              'theme_location' => 'footerLocationTwo'
            ]) ?>
          </nav>
        </div>
      </div>

      <div class="site-footer__col-four">
        <h3 class="headline headline--small">Connect</h3>
        <nav>
          <ul class="min-list social-icons-list group py-2">
            <?php foreach ($socialLinks as $item) : ?>
            <li>
              <a class="<?php echo $item['class'] ?>" href="<?php echo $item['href'] ?>">
                <img class="w-5 mx-auto sm:mx-0" alt='GitHub' src="<?php echo get_theme_file_uri($item['src']) ?>">
              </a>
            </li>
            <?php endforeach; ?>

          </ul>
        </nav>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>