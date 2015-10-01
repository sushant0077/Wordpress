<?php

/** This for fetch Post Wp_query
 * @access public
 * @param none
 * @return none
 * @author Sushant Shewane
 */


//Normal post fetch with post type

$args = array( 
			'post_type' => 'your-post-type', //Note: you can pass no of post type in array ex.=> array('post','page','revision','attachment','your-post-type')
		 	'post_status' => 'publish',
		    'posts_per_page'=> 10,// Note : Use 'posts_per_page'=-1 to show all posts. Note if the query is in a feed, wordpress overwrites this parameter with the stored 'posts_per_rss' option. Treimpose the limit, try using the 'post_limits' filter, or filter 'pre_option_posts_per_rss' and return -1
		);

$my_query = new WP_Query( $args );

//Query with the texonomy for post.

$args = array( 
			'post_type' => 'your-post-type',
		 	'post_status' => 'publish',
		 	'tax_query' => array(
						array(
							'taxonomy' => 'you-taxonomy',
							'field' => 'slug',
							'terms' => array('your-category-slug')
						)
				),
			'orderby' => 'post_date',
		 	'order' => 'DESC',
		 	'posts_per_page'=> 10	
		);


$my_query = new WP_Query( $args );


//Code to show post 

if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post();
  // Do Stuff
endwhile;
endif;
// Reset Post Data
wp_reset_postdata(); // note : if we are you muliple time wp_query, we need to reset post data.
?>