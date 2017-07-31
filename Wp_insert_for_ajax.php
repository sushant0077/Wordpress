<?php

/*TO save registration form data
 * @ sushant 31-07-17
 @ Desc: Let's Suppose we have one HTML form with FirstName,LastName,Email,Phone,ZipCode,Address1 fields and we want to submit to database
 		table with ajax. SO, We will use ajax action wp_ajax_.

 	Syntax: add_action( 'wp_ajax_YourActionName', 'YourActionName' );
			add_action( 'wp_ajax_nopriv_YourActionName', 'YourActionName' );

	In below example my action name is saveDataForm. 

	add_action( 'wp_ajax_saveDataForm', 'saveDataForm' );
	add_action( 'wp_ajax_nopriv_saveDataForm', 'saveDataForm' );.
  -----------------------------------------------------------------------------------
  Your Ajax call In you Js file must be like this.
   <script>
    var MyAjaxUrl = {"url":"http://example.com/wp-admin/admin-ajax.php"}
   $.ajax({
          type: "GET",
          url:  MyAjaxUrl.url,
          dataType: "text",
          data:values+'&action=saveDataForm',
          success: function(data) {
            //your logic on success
          }
      });
  </script>    
*/

function saveDataForm(){
    global $wpdb;

    // Here we are getting ajax return values in the method of GET
	 $regFormfield = array('FirstName'=>$_GET['FirstName'],'LastName'=>$_GET['LastName'],'Email'=>$_GET['Email'],'Phone'=>$_GET['Phone'],'Address'=>$_GET['Address']);
    
    // $wpdb->prefix will be you wp global table prefix name.
     $wpdb->insert( $wpdb->prefix.'reg_form' , $regFormfield);

    exit();
}
add_action( 'wp_ajax_saveDataForm', 'saveDataForm' );
add_action( 'wp_ajax_nopriv_saveDataForm', 'saveDataForm' );

?>
