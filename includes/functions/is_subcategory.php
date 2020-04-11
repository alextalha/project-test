<?php

function is_subcategory() {
  $cat = get_query_var( 'cat' );
  $category = get_category( $cat );
  $category->parent;
  return ( $category->parent == '0' ) ? false : true;
}
