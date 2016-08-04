<?php

/* *********************************************************
* use this code to your wp_config.php file to Enable Live site WP_DEBUG mode to true.
* To check error just append in your 
* Url : www.example.com/?wpdebug=1 
* Url : www.example.com/?wpdebug=2 
* Url : www.example.com/?wpdebug=3 
* @Sushant Shewane
* Referenc site : http://www.hongkiat.com/blog/wordpress-tips-tricks-2015/
* ***********************************************************/
if ( isset($_GET['wpdebug']) && $_GET['wpdebug'] == '1' ) {
    // enable the reporting of notices during development - E_ALL
    define('WP_DEBUG', true);
} elseif ( isset($_GET['wpdebug']) && $_GET['wpdebug'] == '2' ) {
    // must be true for WP_DEBUG_DISPLAY to work
    define('WP_DEBUG', true);
    // force the display of errors
    define('WP_DEBUG_DISPLAY', true);
} elseif ( isset($_GET['wpdebug']) && $_GET['wpdebug'] == '3' ) {
    // must be true for WP_DEBUG_LOG to work
    define('WP_DEBUG', true);
    // log errors to debug.log in the wp-content directory
    define('WP_DEBUG_LOG', true);
}else{
	define('WP_DEBUG', false);
}
