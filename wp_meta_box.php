<?php
/**
 * How to create meta box in wordpress.
 * @access public
 * @param none
 * @return none
 * @author Sushant Shewane
 * @ 02-10-2015
 */

/*--------------------------------------------------------------------------------------------------------------------------------------
*
* NOTE : To create meta box for posts. 
*
* 		 You must add below code in function.php file 
*		 	                          OR 
*		 create one file (ex.text.php) and include that file in your theme function.php file
*
*---------------------------------------------------------------------------------------------------------------------------------------
*/
add_action( 'add_meta_boxes', 'create_custom_meta_box' );

/**
 * add_meta_boxes function registers a metabox with the callback create_custom_meta_box.
 * For reference: add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
 */

function create_custom_meta_box() {
    
    add_meta_box( 'your_meta_box_unique_id', 'Your Custom Meta Box', 'create_custom_meta_box_callback', 'post', 'normal', 'high' );
    
}

// ---------------------- OR you can add it all post type by the following way for all registered post types------------------------------------------


function create_custom_meta_box() {
	
	$post_types = get_post_types();
	foreach ( $post_types as $post_type ) {
    	        add_meta_box( 'meta_id', 'My Custom Meta Box', 'create_custom_meta_box_callback', $post_type, 'normal', 'high' );
	}
	
}


//--------------------------------------------------------------------------------------------------------------

public function create_custom_meta_box_callback( $post ) {

	global $post;


	// you can call the field value in two in ways below either you call first on or second one :)

	// First way to get the value by get_post_custom()
   
    $values = get_post_custom( $post->ID );

	$first_meta_field = isset($values['first_meta_field'])? $values['first_meta_field'][0] : '';
	$second_meta_field = isset($values['second_meta_field'])? $values['second_meta_field'][0] : '';

	// Second way to get the value by get_post_meta()

	$first_meta_field  = get_post_meta( $post->ID, 'first_meta_field', true );
	$second_meta_field = get_post_meta( $post->ID, 'second_meta_field', true );

 
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );

		echo '<div class="wrap">';
		echo '<label for="first_meta_field">' . _e( 'First Meta Field') . '</label> <br/>';
		echo '<input class="text" type="text" id="first_meta_field" name="first_meta_field" value="' . esc_attr( $first_meta_field ) . '"   />';
		echo '</div>';
 
		echo '<div class="wrap">';
		echo '<label for="second_meta_field">' . _e( 'Second Meta Field') . '</label>  <br/>';
		echo '<input class="text" type="text" id="second_meta_field" name="second_meta_field" value="' . esc_attr( $second_meta_field ) . '"   />';
		echo '</div>';
}


/**
 * save_meta_box_data
 * function called on save_post hook to sanitize and save the data
 */
 
public function save_meta_box_data( $post_id ){

	// Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['first_meta_field'] ) )
        update_post_meta( $post_id, 'first_meta_field', $_POST['first_meta_field']);

     // Make sure your data is set before trying to save it
    if( isset( $_POST['second_meta_field'] ) )
        update_post_meta( $post_id, 'second_meta_field', $_POST['second_meta_field']);

  }

?>