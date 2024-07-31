<?php
get_template_part('template-parts/header');

function getRecentProjects() {
  $projects = new WP_Query([
    'posts_per_page' => 2,
    'post_type' => 'project',
    'meta_key' => 'project_date',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
  ]);

  return $projects;
}

function getBlogPosts() {
  $posts = new WP_Query([
    'posts_per_page' => 2
  ]);

  return $posts;
}

function displayRecentProjects() {
  $projects = getRecentProjects();
  while ($projects->have_posts()) {
    $projects->the_post();
    get_template_part('template-parts/content', 'projects');
  }

  wp_reset_postdata();
}

function displayBlogPosts() {
  $blog_posts = getBlogPosts();
  while ($blog_posts->have_posts()) {
    $blog_posts->the_post();
    get_template_part('template-parts/content', 'posts');
  }

  wp_reset_postdata();
}
?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/hero-image.jpg') ?>)"></div>
  <div class="page-banner__content container t-center c-white flex flex-col">
    <h1 class="headline headline--large">Hi, I&rsquo;m Samuel Lau!</h1>
    <h2 class="headline headline--medium">WebDevSpark, a website primarily focused on topics related to React and WordPress.</h2>
    <h3 class="headline headline--small">Explore the various projects I've completed.</h3>
    <div class='mt-10'>
      <a href="<?php echo get_post_type_archive_link('project') ?>" class="btn btn--large bg-primary-500 hover:-translate-y-2 duration-200">My Projects</a>
    </div>
  </div>
</div>

<div class="full-width-split group bg-black text-white">
  <div class="full-width-split__one">
    <div class="full-width-split__inner py-4 px-6 flex flex-col h-full border border-white rounded-md">
      <h2 class="headline headline--small-plus t-center mx-auto px-4 py-2 mt-2 mb-4 border-2 border-white rounded-md">Recent Projects</h2>
      <?php displayRecentProjects(); ?>
      <p class="mt-auto self-center">
        <a href="<?php echo site_url('/projects') ?>" class="btn bg-primary-500 hover:-translate-y-2 duration-200">View All Projects</a>
      </p>
    </div>
  </div>

  <div class="full-width-split__two">
    <div class="full-width-split__inner py-4 px-6 flex flex-col h-full border border-white rounded-md">
      <h2 class="headline headline--small-plus t-center mx-auto px-4 py-2 mt-2 mb-4 border-2 border-white rounded-md">Latest Posts</h2>
      <?php displayBlogPosts(); ?>
      <p class="mt-auto self-center">
        <a href="<?php echo site_url('/blog') ?>" class="btn bg-secondary-700 hover:-translate-y-2 duration-200">View All Posts</a>
      </p>
    </div>
  </div>
</div>

<?php get_template_part('template-parts/footer'); ?>