<?php if( have_posts() ) : ?>

  <?php while( have_posts() ) : the_post(); ?>

    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

  <?php endwhile; ?>

<? else : ?>

  <!-- If do not have posts -->

<? endif; ?>

<?php wp_reset_postdata(); ?>
