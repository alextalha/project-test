<?php
  $image = get_field( 'post_carousel_image', get_the_ID() );
  if ( empty( $image ) ) {
    if ( has_post_thumbnail() ) {
      $thumb = get_the_post_thumbnail_url( get_the_ID(), 'featured' );
    } else {
      $thumb = '';
    }
  } else {
    $thumb = $image[ 'sizes' ][ 'featured' ];
  }
?>

<div class="blog__header-destaque-item">
  <a href="<?php the_permalink(); ?>">
    <div
      class="blog__header-destaque-item--image"
      style="background-image:url(<?php echo $thumb; ?>)"
    ></div>

    <div class="blog__header-destaque-item--description">
      <h2 class="blog__header-destaque-item--description-main">
        <?php the_title(); ?>
      </h2>

      <div class="blog__header-destaque-item--description-secondary">
        <?php the_excerpt(); ?>
        <button class="button button--ghost">Veja mais</button>
      </div>
    </div>
  </a>
</div>
