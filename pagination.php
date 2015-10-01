<?php

/*
* @ Auther : Sushant shewane
* @ Date   : 01-10-2015
*  Below code for custom pagination.
*  please add below code in function.php for custom pagination
*/

 function pagination($pages,$offsets='',$limit,$pageid,$url)
{ 
     $range =$limit;
     $showitems = round($pages/$limit); 
 
     global $offsets;
     if(empty($offsets)) $offsets = 1;
 
         
         if(!$pages)
         {
             $pages = 1;
         }

     if(1 != $pages)
     {

         $pagination= "<div class='pagination'>";
     $pagination.="<ul class='page-numbers'>";
         if($offsets > 2 && $offsets > $range+1 && $showitems < $pages){
      $pagination.= "<li><a href='".$url."?pages=1'>&laquo; First</a></li>";
     }
         if($offsets > 1 && $showitems < $pages){
       $preoffsets=$offsets-1;
       $pagination.= "<li><a href='".$url."?pages=".$preoffsets."'>&lsaquo; Previous</a></li>";
     }

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $offsets+$range-1 || $i <= $offsets-$range+1) || $pages <= $showitems ))
             {
         $pagination.=($offsets == $i)?"<li class='active'><a class='current' href='javascript:void(0);'>".$i."</a></li>":"<li><a href='".$url."?pages=".$i."'>".$i."</a></li>";
             }
         }
 
         if ($offsets < $pages && $showitems < $pages){
       $offsets=$offsets+1;
      $pagination.= "<li><a href='".$url."?pages=".$offsets."'>Next &rsaquo;</a></li>"; 
     }
         if ($offsets < $pages-1 &&  $offsets+$range-1 < $pages && $showitems < $pages){
      $pagination.= "<li><a href='".$url."?pages=".$pages."'>Last &raquo;</a></li>";
     }
         $pagination.="</ul>";
       echo  $pagination.= "</div>\n";
     }

}


?>

<?php


/*
* @ Auther : Sushant shewane
* @ Date   : 01-10-2015
*  Below code for custom pagination.
*  please add below code in you file ro template and replace your arguments for custom pagination
*/



$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

@$offsets=($_GET['pages']!='')?$_GET['pages']:1;

$limit  = 5; // you can change as per you requirement.

$nws_revw_post_right_content = ''; // empty variable to content the html or php value.

// add you post type
$type = "your-post-type";



$offset = ($offsets!='')?$offsets-1:1;

$offset = $offset * $limit;


$args=array(
  'post_type' => $type,
  'offset' => $offset,
  'post_status' => 'publish',
  'orderby' => 'ID',
  'order' => 'DESC',
  'posts_per_page' => $limit,
 
  );

$my_query = null;

$my_query = new WP_Query($args);

if( $my_query->posts ) {
 
 // in foreach loop you can change you dispaly logic as per you HTML.

 foreach ($my_query->posts  as $nws_revw_post) {

      $get_NR_read_more = (strpos($nws_revw_post->post_content,"<!--more-->"))? strpos($nws_revw_post->post_content,"<!--more-->") : 400;  

       $nws_revw_post_right_content .= '<li class="clearfix">
          <div class="text">
            <h2>'.$nws_revw_post->post_title.'</h2>
            '.wpautop(substr($nws_revw_post->post_content,0,$get_NR_read_more)).'<a href="'.get_permalink($nws_revw_post->ID).'">MORE</a>
          </div>
          <div class="image">
              '.get_the_post_thumbnail( $nws_revw_post->ID ,'small-thumb_175x110' ).'
          </div>
        </li>';
    } 
  
}

wp_reset_query(); 
?>

         
<h1><?php the_title(); ?></h1>
<div class="grayout clearfix">
    <ul id="news">
        <?php echo $nws_revw_post_right_content; ?>
    </ul>
</div>
 <?php 

 /*
 * Below Code for pagination
 * @ 01-10-15
 */

  if (function_exists("pagination")) {
      
      $url=get_permalink(get_the_ID());
      pagination($my_query->max_num_pages,$offsets,$limit,get_the_ID(),$url); // this function will call from your function.php file

      //Note: you can change your display pagination html in  ---function pagination()---  in function.php file
   }
?>