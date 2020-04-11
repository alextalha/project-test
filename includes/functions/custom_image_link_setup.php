<?php

function custom_imagelink_setup() {
  $image_set = get_option( 'image_default_link_type' );

  if ( $image_set !== 'none' ) {
    update_option( 'image_default_link_type', 'none' );
  }
}
add_action( 'admin_init', 'custom_imagelink_setup', 10 );
