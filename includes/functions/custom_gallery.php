<?php
function custom_gallery() {
  $output = $images_ids = '';

  if ( function_exists( 'get_post_galleries' ) ) {
    $galleries = get_post_galleries( get_the_ID(), false );

    if ( empty( $galleries ) ) {
      return false;
    }

    if ( isset( $galleries[0]['ids'] ) ) {
      foreach ( $galleries as $gallery ) {
        $images_ids .= ( '' !== $images_ids ? ',' : '' ) . $gallery['ids'];
      }

      $attachments_ids = explode( ',', $images_ids );
      $attachments_ids = array_unique( $attachments_ids );
    } else {
      $attachments_ids = get_posts( array(
        'fields'         => 'ids',
        'numberposts'    => 999,
        'order'          => 'ASC',
        'orderby'        => 'menu_order',
        'post_mime_type' => 'image',
        'post_parent'    => get_the_ID(),
        'post_type'      => 'attachment'
      ) );
    }
  } else {
    $pattern = get_shortcode_regex();
    preg_match( "/$pattern/s", get_the_content(), $match );
    $atts = shortcode_parse_atts( $match[3] );

    if ( isset( $atts['ids'] ) ) {
      $attachments_ids = explode( ',', $atts['ids'] );
    } else {
      return false;
    }
  }

  echo '<div class="gallery-slider flexslider">';
  echo '  <ul class="gallery-slides">';
  if ( !is_single() ) {
    foreach ( $attachments_ids as $attachment_id ) {
      printf(
        '<li class="gallery-slide"><a href="%s">%s</a></li>',
        esc_url( get_permalink() ),
        wp_get_attachment_image( $attachment_id, 'gallery_wide' )
      );
    }
  } else {
    foreach ( $attachments_ids as $attachment_id ) {
      printf(
        '<li class="gallery-slide">' . wp_get_attachment_image( $attachment_id, 'gallery_wide' ) . '</li>'
      );
    }
  }
  echo '  </ul>';
  echo '</div>';

  return $output;
}
