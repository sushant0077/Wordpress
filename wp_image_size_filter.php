<?php 

/* 
*Add this code to your theme's functions.php file, and it will limit minimum image dimentions 
* Ref Url: https://wordpress.stackexchange.com/questions/28359/how-to-require-a-minimum-image-dimension-for-uploading
* @10-08
*/

add_filter('wp_handle_upload_prefilter','add_image_size_validation');
function add_image_size_validation($file)
{

    $tmp_name_img = getimagesize($file['tmp_name']);
    $RequiredmMinimum = array('width' => '640', 'height' => '480');

    $width= $tmp_name_img[0];
    $height =$tmp_name_img[1];

    if ($width < $RequiredmMinimum['width'] )
        return array("error"=>"Image dimensions are too small. Minimum width is {$RequiredmMinimum['width']}px. Uploaded image width is $width px");

    elseif ($height <  $RequiredmMinimum['height'])
        return array("error"=>"Image dimensions are too small. Minimum height is {$RequiredmMinimum['height']}px. Uploaded image height is $height px");
    else
        return $file; 
}

/* 
*Add this code to your theme's functions.php file, and it will limit minimum image dimentions 
* Ref Url: https://wordpress.stackexchange.com/questions/130203/limit-image-resolution-on-upload
* @10-08
*/

add_filter('wp_handle_upload_prefilter','mdu_validate_image_size');
function mdu_validate_image_size( $file ) {
    $image = getimagesize($file['tmp_name']);
    $minimum = array(
        'width' => '400',
        'height' => '400'
    );
    $maximum = array(
        'width' => '2000',
        'height' => '2000'
    );
    $image_width = $image[0];
    $image_height = $image[1];

    $too_small = "Image dimensions are too small. Minimum size is {$minimum['width']} by {$minimum['height']} pixels. Uploaded image is $image_width by $image_height pixels.";
    $too_large = "Image dimensions are too large. Maximum size is {$maximum['width']} by {$maximum['height']} pixels. Uploaded image is $image_width by $image_height pixels.";

    if ( $image_width < $minimum['width'] || $image_height < $minimum['height'] ) {
        // add in the field 'error' of the $file array the message 
        $file['error'] = $too_small; 
        return $file;
    }
    elseif ( $image_width > $maximum['width'] || $image_height > $maximum['height'] ) {
        //add in the field 'error' of the $file array the message
        $file['error'] = $too_large; 
        return $file;
    }
    else
        return $file;
}
?>
