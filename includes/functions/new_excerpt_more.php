<?php

function new_excerpt_more( $more ) {
  global $post;
  return '&hellip;';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );
