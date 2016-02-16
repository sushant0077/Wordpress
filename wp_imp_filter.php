<?php
/**
  * This Function Remove query strings from static resources
  * @param query result
  * @return none
  * @Sushant Shewane
 **/
 
function _remove_script_query_string( $src ){
    $parts = explode( '?ver', $src );
        return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_query_string', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_query_string', 15, 1 );

/**
  * This Function Add all your header script to Footer
  * @param query result
  * @return none
  * @Sushant Shewane
 **/

function remove_head_scripts() {
  remove_action('wp_head', 'wp_print_scripts');
  remove_action('wp_head', 'wp_print_head_scripts', 9);
  remove_action('wp_head', 'wp_enqueue_scripts', 1);

  add_action('wp_footer', 'wp_print_scripts', 5);
  add_action('wp_footer', 'wp_enqueue_scripts', 5);
  add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );

?>
