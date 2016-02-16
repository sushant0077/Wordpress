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

/**
  * This Function for SearchFilter
  * @param query result
  * @return none
  * @author Sushant Shewane
 **/

function SearchFilter($query) {
  if ($query->is_search) {
    $query->set('post_type', 'article');
  }
  return $query;
}

/**
  * This Function Get Post ID by meta key and meta value
  * @param query result
  * @return none
  * @author Sushant Shewane
    Date 14-01-15
 **/



 function get_post_id_by_meta_key_and_value($key, $value) {
  global $wpdb;
  $meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".$wpdb->escape($key)."' AND meta_value='".$wpdb->escape($value)."'");
  if (is_array($meta) && !empty($meta) && isset($meta[0])) {
    $meta = $meta[0];
    } 
  if (is_object($meta)) {
    return $meta->post_id;
    }
  else {
    return false;
    }
 }
 
 
 /**
  * This Function to get the hierarchy category. i.e parent->child
  * @param query result
  * @return none
  * @author Sushant Shewane
 **/

function get_cat_hierchy($parent,$args){

  $cats = get_categories($args);
  $ret = new stdClass;

  foreach($cats as $cat){
    if($cat->parent==$parent){
      $id = $cat->cat_ID;
      $ret->$id = $cat;
      $ret->$id->children = get_cat_hierchy($id,$args);
    }
  }

  return $ret;
}

$args = array(
   //'type'                     => 'post',
   'child_of'                 => 0,
   'parent'                   => '',
   'orderby'                  => 'name',
   'order'                    => 'ASC',
   'hide_empty'               => 0,
   'hierarchical'             => 1,
   'exclude'                  => '',
   'include'                  => '',
   'number'                   => '',
   'taxonomy'                 => 'tax-article',
   'pad_counts'               => false 

 ); 

 //$categories = get_categories( $args );

 $Featured_prgs = get_cat_hierchy(0,$args);
 
  /**
  * This Function to get to get image Alt text.
  * @param query result
  * @return none
  * @author Sushant Shewane
 **/
 
 function get_image_alt_text($post_thumb_id){

  $thumb_id = get_post_thumbnail_id($post_thumb_id);
  $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
  
  if(count($alt))
    return $alt;
    
}


?>