<a class="blog__list-item" href="<?php the_permalink(); ?>" data-post-id="<?php echo get_the_ID(); ?>">
  <div class="blog__list-item-body">
    <div class="blog__list-item-image"></div>
    <h3 class="blog__list-item-title"><?php the_title(); ?></h3>
    <div class="blog__list-item-description"><?php the_excerpt(); ?></div>
  </div>
</a>
