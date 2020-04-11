<?php $popular_posts = new WP_Query(
  array(
    'posts_per_page'      => 8,
    'meta_key'            => 'post_views_count',
    'orderby'             => 'meta_value_num',
    'order'               => 'DESC',
    'post_type'           => array( 'post' ),
    'paged'               => false,
    'ignore_sticky_posts' => true,
  )
); ?>
<?php if ( $popular_posts->have_posts() ) : ?>
  <div class="blog-footer__maislidas">
    <div class="blog-footer__maislidas--titulo">MAIS LIDAS</div>
    <div class="blog-footer__maislidas--posts">
      <button class="slick-bg prev" type="button">
        <i class="slick-arrow slick-prev icon icon-arrow"></i>
      </button>

      <button class="slick-bg next" type="button">
        <i class="slick-arrow slick-next icon icon-arrow"></i>
      </button>

      <div class="blog-footer__maislidas--posts-list js-slick" data-slick='{"slidesToShow": 4, "arrows": false}'>
        <?php while ( $popular_posts->have_posts ) : ?>
          <?php $popular_posts->the_post(); ?>
          <?php get_template_part( 'includes/partials/popular-post' ); ?>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
<?php endif; ?>
