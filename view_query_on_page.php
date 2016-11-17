<?php
/**
* WordPress Query View
* View all Running queries on you website use below code to check that
* @17-11-16 By sushant Shewane
*/

define('SAVEQUERIES', true); // Add this to function.php
?>
<?php 
if( is_admin_bar_showing()){ 
  echo get_num_queries(); ?>  <?php echo 'queries in'.timer_stop(1); 
  
  if (current_user_can('administrator')){
   global $wpdb;
   echo "<pre>";
   print_r($wpdb->queries);
   echo "</pre>";
 }//Lists all the queries executed on your page
}

/**
* WordPress files check
* here we can check which files are included
* @17-11-16 By sushant Shewane
*/

$included_files = get_included_files();
echo "<pre>";
print_r($included_files);
echo "</pre>";



?>
