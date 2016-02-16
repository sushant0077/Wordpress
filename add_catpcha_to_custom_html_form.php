<?php
/**
	* If you have custom html form and want to add catpcha use following guidlines
	* @param query result
	* @return none
	* @author Sushant Shewane
 **/
?>
<form name="checkcaptcha">
	<img class="here_cange" src="<?php echo site_url(); ?>/wp-content/themes/YOUR-THEME-NAME/assets/php-captcha/php/newCaptcha.php" />
	<a class="refresh_image">refresh</a>
	<input type="text" value="" name="captcha" class="chk_img form-control" placeholder="Type the above text">
	<input type="submit" class="btn submit" value="Submit">
</form>
<script>
	/*make sure you have added latest jquery in you file*/
	jQuery('.refresh_image').click(function(){
	    //alert('this');
	    jQuery('.here_cange').attr("src","<?php echo site_url(); ?>/wp-content/themes/YOUR-THEME-NAME/assets/php-captcha/php/newCaptcha.php?rnd=" + Math.random());
		jQuery('.chk_img').val('');
	    
	});

	jQuery(".submit").click(function(e) {

		jQuery('.chk_img').next('span').remove();

		if(jQuery('.chk_img').val() == ''){
		    jQuery('.chk_img').addClass('error');
		    jQuery('.chk_img').after( "<span class='error'>This is required </span>" );
		    return false;
	  	}
      
      	jQuery.ajax({
           type: "POST",
           url: "<?php echo site_url(); ?>/wp-content/themes/YOUR-THEME-NAME/assets/php-captcha/php/checkCaptcha.php",
           dataType: "text",
           data: {
              "code": jQuery('.chk_img').val()
          },
          success: function(data){
             
          	//alert(data);
	       	if (data.contains('true')){

	          
	          jQuery('.chk_img').removeClass('error');
	          jQuery('.chk_img').next('span').remove();

	          jQuery('.ten').css('opacity', '1').show();
	          jQuery('.nine').css('opacity', '0').hide();

	           jQuery('.progress-count-bg h5 span').html('100<sup>%</sup>');
	           jQuery('.step-count-number').html('<span>10 </span> of 10');
	          
	          chk_done = 1;
	         

	        }else{
	           
	          jQuery('.here_cange').attr("src","<?php echo site_url(); ?>/wp-content/themes/YOUR-THEME-NAME/assets/php-captcha/php/newCaptcha.php?rnd=" + Math.random());
	         // return false;
	          jQuery('.chk_img').addClass('error');
	          jQuery('.chk_img').after( "<span class='error'>Verication code incorrect, please try again </span>" );
	          jQuery('.chk_img').val('');                          
	           
	        }
        }
  	});	    
});

</script>
<?php
/*
1.Create Folder in you current active theme "assets/php-captcha/php"
	-assets
	-php-captcha
		-php
			-newCatpcha.php
			-checkCatpcha.php
		-fonts
			PlAGuEdEaTH.ttf // Download this and paste it in fonts folder.

*/


/********************************* newCatpcha.php ****************************************************** 
* Create new file with name newCatpcha.php  and pase below code in that file.
* 
*/

session_start();

$string = '';
for ($i = 0; $i < 5; $i++) {
    $string .= chr(rand(97, 122));
}

$_SESSION['captcha'] = $string; //store the captcha

//define(CAPTCHA, $_SESSION['captcha']);

$dir = '../fonts/';
$image = imagecreatetruecolor(165, 50); //custom image size
$font = "PlAGuEdEaTH.ttf"; // custom font style
$color = imagecolorallocate($image, 113, 193, 217); // custom color
$white = imagecolorallocate($image, 255, 255, 255); // custom background color
imagefilledrectangle($image,0,0,399,99,$white);
imagettftext ($image, 30, 0, 10, 40, $color, $dir.$font, $string);

header("Content-type: image/png");
imagepng($image);

/********************************* newCatpcha.php ******************************************************/

/********************************* checkCatpcha.php ****************************************************** 
* Create new file with name checkCatpcha.php  and pase below code in that file.
* 
*/

 session_start();
    
    session_start();

    if(isset($_REQUEST['code']))
    {
        if(strtolower($_REQUEST['code']) == strtolower($_SESSION['captcha'])){
            echo "true";
        }else{
            echo "false";
        }
    }
    else
    {
        echo "false";
    }

/********************************* checkCatpcha.php ******************************************************/

?>
