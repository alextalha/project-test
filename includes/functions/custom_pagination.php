<?php
function theme_pagination() {
  global $wp_query;
  $total = $wp_query->max_num_pages;

  if ( $total > 1 ) {
    if ( ! $current_page = get_query_var( 'paged' ) ) {
      $current_page = 1;
    }

    $big = 999999999;

    $permalink_structure = get_option( 'permalink_structure' );
    $format = empty( $permalink_structure ) ? '&page=%#%' : 'page/%#%/';
    echo paginate_links( array(
      'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
      'format'    => $format,
      'current'   => $current_page,
      'total'     => $total,
      'mid_size'  => 4,
      'prev_text' => 'Anteriores',
      'next_text' => 'Próximos',
      'type'      => 'list'
    ) );
  }
}
