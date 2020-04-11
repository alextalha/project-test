<?php get_header(); ?>

<div class="blog__header">
  <div class="blog__header-section">
    <div class="blog__header-topo">
      <img src="/arquivos/topo-desktop.png" />
    </div>
  </div>

  <div class="blog__header-section">
    <?php get_template_part( 'includes/partials/blog-categories' ); ?>
  </div>

  <div class="blog__header-section">
    <!-- featured posts -->
    <?php $featured_posts = new WP_Query(
      array(
        'posts_per_page'      => 6,
        'meta_key'            => 'featured_post',
        'meta_value'          => true,
        'post_type'           => 'post',
        'ignore_sticky_posts' => true,
      )
    ); ?>
    <?php if ( $featured_posts->have_posts() ) : ?>
      <div class="blog__header-destaque js-slick" data-slick='{"slidesToShow": 1, "centerMode": true, "infinite": true, "variableWidth": true}'>
        <?php while ( $featured_posts->have_posts() ) : ?>
          <?php $featured_posts->the_post(); ?>
          <?php get_template_part( 'includes/partials/featured-post' ); ?>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
    <!-- /featured posts -->
  </div>

  <?php if ( $featured_posts->have_posts() ) : ?>
    <div class="blog__header-section">
      <h2 class="blog__header-title"><span class="blog__header-line">Last Updates</span></h2>
    </div>
  <?php endif; ?>

  <?php wp_reset_postdata(); ?>
</div>

<div class="blog__inner">
  <?php $feed = new WP_Query(
    array(
      'post_type'           => 'post',
      'posts_per_page'      => 12,
      'ignore_sticky_posts' => true,
    )
  ); ?>
  <?php if ( $feed->have_posts() ) : ?>
    <div class="blog__list">
      <?php while ( $feed->have_posts() ) : ?>
        <?php $feed->the_post(); ?>
        <?php get_template_part( 'includes/partials/post-list-item' ); ?>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>

  <?php wp_reset_postdata(); ?>
</div>

<div class="blog-footer">
  <?php get_template_part( 'includes/partials/popular-posts' ); ?>
</div>

<?php get_footer(); ?>
