<?php

  if ( ! isset( $_GET[ 'getContent' ] ) ) {
    if ( isset( $_GET[ 'homolog' ] ) ) {
      $base_url = 'homolog-animale.vtexcommercestable';
    }
    else {
      $base_url = 'www.animale';
    }

    if ( is_single() ) {
      $directory = 'post';
    }
    // elseif ( is_category() ) {
    //   $directory = '';
    // }
    else {
      $directory = '';
    }

    header( "Location: https://$base_url.com.br/inside-animale/$directory#!$_SERVER[REQUEST_URI]" );
    exit();
  } else {
    if ( is_single() ) {
      function set_post_views( $postID ) {
        $count_key = 'post_views_count';
        $count = get_post_meta( $postID, $count_key, true );
        if ( $count == '' ) {
          $count = 0;
          delete_post_meta( $postID, $count_key );
          add_post_meta( $postID, $count_key, '0' );
        } else {
          $count++;
          update_post_meta( $postID, $count_key, $count );
        }
      }
      global $post;
      set_post_views( get_the_ID() );
    }
  }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <?php wp_head(); ?>
</head>
<body>
  <div id="ajax-content">
