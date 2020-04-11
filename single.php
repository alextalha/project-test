<?php get_header(); ?>

<?php the_post(); ?>

<div class="blog-post__header">
  <div class="blog-post__header-section">
    <?php get_template_part( 'includes/partials/blog-categories' ); ?>
  </div>
  <?php if ( ( has_post_format( 'video' ) && get_field( 'video_url' ) ) || get_field( 'post_top_image' ) ) : ?>
    <div class="blog-post__header-section">
      <div class="blog-post__header-topo">
        <?php if ( has_post_format( 'video' ) && get_field( 'video_url' ) ) : ?>
          <?php /* shrugs */ ?>
        <?php elseif ( get_field( 'post_top_image' ) ) : ?>
          <img src="<?php the_field( 'post_top_image' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="blog-post__header-section">
    <div class="blog-post__header-breadcrumb">
      <?php custom_breadcrumb(); ?>
    </div>
  </div>
</div>

<div class="blog-post__content">
  <div class="blog-post__arrows">
    <div class="blog-post__arrow prev">
      <?php previous_post_link( '%link', '', true ); ?>
      <i class="icon icon-arrow"></i>
    </div>

    <div class="blog-post__arrow next">
      <?php next_post_link( '%link', '', true ); ?>
      <i class="icon icon-arrow"></i>
    </div>
  </div>

  <div class="blog-post__body">
    <div class="blog-post__body--title">
      <h1><?php the_title(); ?></h1>
      <?php if ( get_field( 'subtitle' ) ) : ?>
        <span><?php the_field( 'subtitle' ); ?></span>
      <?php endif; ?>
    </div>

    <div class="blog-post__body--content">
      <?php the_content(); ?>

      <div class="blog-post__share">
        <h5 class="blog-post__share-title">Compartilhe:</h5>

        <?php
          $postUrl = preg_replace( '/inside.animale.com.br/', 'www.animale.com.br/inside-animale/post#!', get_permalink() );
        ?>

        <ul class="blog-post__share-list">
          <li class="blog-post__share-item">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" class="blog-post__share-link blog-post__share-link--facebook" target="_blank" rel="noopener noreferrer">
              <i class="icon-facebook"></i>
            </a>
          </li>
          <li class="blog-post__share-item">
            <a href="https://twitter.com/home?status=<?php echo $postUrl; ?>" class="blog-post__share-link blog-post__share-link--twitter" target="_blank" rel="noopener noreferrer">
              <i class="icon-twitter"></i>
            </a>
          </li>
          <li class="blog-post__share-item">
            <a href="https://pinterest.com/pin/create/button/?url=<?php echo $postUrl; ?>&media=<?php echo get_the_post_thumbnail_url( get_the_ID() ); ?>&description=<?php esc_attr( the_title() . ' - Inside Animale' ); ?>" class="blog-post__share-link blog-post__share-link--pinterest" target="_blank" rel="noopener noreferrer">
              <i class="icon-pinterest"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
