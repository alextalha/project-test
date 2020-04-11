<?php

class Widget_Popular_Posts extends WP_Widget {
  public function __construct() {
    parent::__construct(
      'widget_popular_posts',
      'Posts Populares',
      array( 'description' => 'Liste os posts mais populares.' )
    );

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
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

    if ( is_single() ) {
      global $post;
      set_post_views( get_the_ID() );
    }
  }

  public function widget( $args, $instance ) {
    echo $args['before_widget'];

    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'];
      echo apply_filters( 'widget_title', $instance['title'] );
      echo $args['after_title'];
    }

    $sticky = get_option( 'sticky_posts' );
    $popular_posts = new WP_Query( array(
      'posts_per_page' => $instance['how_many_posts'],
      'meta_key'       => 'post_views_count',
      'orderby'        => 'meta_value_num',
      'order'          => 'DESC',
      'post__not_in'   => $sticky,
      // 'post_type'      => array( 'post' ),
      'paged'          => false
    ) );
    ?>
    <?php if ( $popular_posts->have_posts() ) : ?>
      <ul class="clearfix">
        <?php while ( $popular_posts->have_posts() ) : $popular_posts->the_post(); ?>
          <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>

    <?php
    echo $args['after_widget'];
  }

  public function form( $instance ) {
    if ( isset( $instance['title'] ) ) $title = $instance['title'];

    if ( isset( $instance['how_many_posts'] ) ) $how_many_posts = $instance['how_many_posts'];
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Título</label>
        <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
    </p>

    <p>
        <label for="<?php echo $this->get_field_id( 'how_many_posts' ); ?>">Número de posts a serem exibidos</label>
        <input type="number" min="1" max="10" step="1" name="<?php echo $this->get_field_name( 'how_many_posts' ); ?>" id="<?php echo $this->get_field_id( 'how_many_posts' ); ?>" value="<?php echo ( ! empty( $instance['how_many_posts'] ) ) ? esc_attr( $how_many_posts ) : 5; ?>" class="widefat">
    </p>
    <?php
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['how_many_posts'] = ( ! empty( $new_instance['how_many_posts'] ) ) ? strip_tags( $new_instance['how_many_posts'] ) : '';

    return $instance;
  }
}
add_action( 'widgets_init', function(){
  register_widget( "Widget_Popular_Posts" );
});
