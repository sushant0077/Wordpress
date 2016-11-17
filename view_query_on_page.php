<?php
/**
* WordPress Query View
* View all Running queries on you website use below code to check that
* @17-11-16 By sushant Shewane
*/

define('SAVEQUERIES', true); // Add this to function.php

// Add this below code in Footer.php file
if( is_admin_bar_showing()){ 
    echo get_num_queries(); 
    echo 'queries in'.timer_stop(1);
    
  if (current_user_can('administrator')){
   global $wpdb;
   echo "<pre>";
   print_r($wpdb->queries);
   echo "</pre>";
 }//Lists all the queries executed on your page
}
?>
