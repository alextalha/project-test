<?php

function theme_setup() {
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );
  add_theme_support( 'menus' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'post-formats', array( 'video' ) );
  add_theme_support( 'title-tag' );
  add_theme_support( 'customize-selective-refresh-widgets' );

  // add_theme_support( 'custom-background', array() );

  add_theme_support( 'custom-logo', array(
    'width'       => 300,
    'height'      => 80,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
  ) );

  add_image_size( 'featured', 480, 300 );
  add_image_size( 'regular_post', 630, 999999 );
  add_image_size( 'small_post', 330, 180, true );
  add_image_size( 'single_post', 1800, 770, true );

  // register_nav_menus( array(
  //   'header_top'  => 'Menu Desktop Principal',
  //   'menu_btn'    => 'Menu Botão',
  // ) );

  // register_sidebar( array(
  //   'name'          => 'Main Sidebar',
  //   'id'            => 'main_sidebar',
  //   'before_widget' => '<div id="%1$s" class="widget %2$s">',
  //   'after_widget'  => '</div>',
  //   'before_title'  => '<h5 class="widget__title">',
  //   'after_title'   => '</h5>'
  // ) );
}
add_action( 'after_setup_theme', 'theme_setup' );

add_filter( 'rest_authentication_errors', function () {
  wp_set_current_user( 1 ); // replace with the ID of a WP user with the authorization you want
}, 101 );
