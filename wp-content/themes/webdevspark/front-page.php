<?php
get_template_part('template-parts/header');

$items = [
  [
    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /> </svg>',
    'title' => 'Custom Web Design and Development',
    'text' => 'Designing and developing custom websites tailored to client specifications, including responsive layouts, modern UI/UX design, and interactive elements',
  ],
  [
    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>',
    'title' => 'WordPress - Custom CMS Integration',
    'text' => 'Easily manage content with custom CMS integration. Tailored WordPress themes and plugin setups ensure your site remains updated and functional with minimal effort'
  ],
  [
    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /> </svg>',
    'title' => 'Interactive Features and Widgets',
    'text' => 'Interactive features and widgets enhance user engagement with dynamic, responsive elements like sliders, carousels, form validations, and real-time data updates',
  ]
];

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

<section class="page-banner">
  <div class="container flex flex-col sm:flex-row bg-top md:bg-cover bg-no-repeat" style="background-image: url(<?php echo get_theme_file_uri('/images/hero-image.webp') ?>)">
    <div class="relative z-0 page-banner__content container t-center c-white flex flex-col py-16 md:pl-10 w-full xl:py-24">
      <div class="z-20 backdrop-blur-sm backdrop-brightness-75 rounded-md p-2 py-4">
        <h1 class="headline text-5xl sm:text-7xl ">Hi, I&rsquo;m Samuel Lau!</h1>
        <h2 class="headline text-3xl sm:text-4xl py-7">WebDevSpark, a website primarily focused on topics related to React and WordPress.</h2>
        <h3 class="headline text-xl sm:text-2xl">Explore the various projects I've completed.</h3>
        <div class='mt-10'>
          <a href="<?php echo get_post_type_archive_link('project') ?>" class="btn btn--large py-2 px-4 bg-primary-500 hover:-translate-y-2 duration-200">My Projects</a>
        </div>
      </div>
    </div>
    <div class="cards-section w-full z-0 md:pt-20 p-10 md:p-0">
      <div class="card card-left translate-x-12 md:translate-x-64 z-10 bg-cover border-2 border-white shadow-lg shadow-stone-500" style="background-image: url(<?= get_theme_file_uri('images/card-image/image-1.webp') ?>)"></div>
      <div class="card card-center z-20 bg-cover border-2 border-white shadow-lg shadow-stone-500" style="background-image: url(<?= get_theme_file_uri('images/card-image/image-3.webp') ?>)"></div>
      <div class="card card-right -translate-x-16 md:-translate-x-60 z-10 bg-cover border-2 border-white shadow-lg shadow-stone-500" style="background-image: url(<?= get_theme_file_uri('images/card-image/image-2.webp') ?>)"></div>
    </div>
  </div>
</section>

<section class="full-width-split group bg-black text-white py-10">
  <div class="full-width-split__one">
    <div class="full-width-split__inner py-10 px-6 flex flex-col h-full border border-white rounded-md">
      <h2 class="headline headline--small-plus t-center mx-auto px-4 py-2 mt-2 mb-10 border-2 border-white rounded-md">Recent Projects</h2>
      <?php displayRecentProjects(); ?>
      <p class="mt-auto self-center">
        <a href="<?php echo site_url('/projects') ?>" class="btn bg-primary-500 hover:-translate-y-2 duration-200">View All Projects</a>
      </p>
    </div>
  </div>

  <div class="full-width-split__two">
    <div class="full-width-split__inner py-10 px-6 flex flex-col h-full border border-white rounded-md">
      <h2 class="headline headline--small-plus t-center mx-auto px-4 py-2 mt-2 mb-10 border-2 border-white rounded-md">Latest Posts</h2>
      <?php displayBlogPosts(); ?>
      <p class="mt-auto self-center">
        <a href="<?php echo site_url('/blog') ?>" class="btn bg-secondary-700 hover:-translate-y-2 duration-200">View All Posts</a>
      </p>
    </div>
  </div>
</section>

<section class="bg-neutral-900 relative">
  <div class="container mx-auto px-6 py-28 z-10">
    <h1 class="text-4xl font-semibold text-center text-white capitalize">Services</h1>
    <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-16 md:grid-cols-2 xl:grid-cols-3">
      <?php foreach ($items as $item) : ?>
        <div class="flex flex-col items-center p-6 space-y-3 text-center bg-black rounded-xl">
          <span class="inline-block p-3 text-white bg-primary-500 rounded-full">
            <?php echo $item['icon'] ?>
          </span>
          <h1 class="text-xl font-semibold text-white capitalize px-4">
            <?php echo $item['title'] ?>
          </h1>
          <p class="text-gray-300">
            <?php echo $item['text'] ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="absolute inset-0 bg-cover bg-center bg-no-repeat z-0 opacity-30" style="background-image: url(<?php echo get_theme_file_uri('/images/services.webp') ?>)"></div>
</section>



<?php get_template_part('template-parts/footer'); ?>