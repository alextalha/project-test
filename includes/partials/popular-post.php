<a class="blog-footer__maislidas--posts-item" href="<?php the_permalink(); ?>">
  <div class="blog-footer__maislidas--posts-item-image" style="background-image:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'small_post' ); ?>)"></div>

  <div class="blog-footer__maislidas--posts-item-description">
    <strong><?php the_title(); ?></strong>
    <?php the_excerpt(); ?>
  </div>
</a>
