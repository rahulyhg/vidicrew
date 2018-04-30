<?php
/** 
 * For more info: https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */			
	
// Theme support options
require_once(get_template_directory().'/functions/theme-support.php'); 

// WP Head and other cleanup functions
require_once(get_template_directory().'/functions/cleanup.php'); 

// Register scripts and stylesheets
require_once(get_template_directory().'/functions/enqueue-scripts.php'); 

// Register custom menus and menu walkers
require_once(get_template_directory().'/functions/menu.php'); 

// Register sidebars/widget areas
require_once(get_template_directory().'/functions/sidebar.php'); 

// Makes WordPress comments suck less
require_once(get_template_directory().'/functions/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/functions/page-navi.php'); 

// Adds support for multiple languages
require_once(get_template_directory().'/functions/translation/translation.php'); 

// Adds site styles to the WordPress editor
// require_once(get_template_directory().'/functions/editor-styles.php'); 

// Remove Emoji Support
// require_once(get_template_directory().'/functions/disable-emoji.php'); 

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/functions/related-posts.php'); 

// Use this as a template for custom post types
// require_once(get_template_directory().'/functions/custom-post-type.php');

// Customize the WordPress login menu
// require_once(get_template_directory().'/functions/login.php'); 

// Customize the WordPress admin
// require_once(get_template_directory().'/functions/admin.php');

/*

New functions by J.R. - move into plugins or refactor?

*/

// Login redirect - do not redirect subscribers to admin area

function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			//return home_url(); // Location to redirect to - should be My Account
			return get_permalink( get_page_by_path( 'my-account' ) );
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

// Add ability to show/hide menu items based on login status - requires "If Menu" plugin

function wpb_new_menu_conditions( $conditions ) {
  $conditions[] = array(
    'name'    =>  'If NOT logged in', // name of the condition
    'condition' =>  function($item) {          // callback - must return TRUE or FALSE
		if(is_user_logged_in()) {
			return false;
		} else {
			return true;
		}
    }
  );
 
  return $conditions;
}

add_filter( 'if_menu_conditions', 'wpb_new_menu_conditions' );

// Redirect failed frontend login and logout

function front_end_login_fail( $username ) {
   	$referrer = $_SERVER['HTTP_REFERER'];
   	// If there's a valid referrer, and it's not the default log-in screen
   	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
	  
	if(!strpos($referrer, 'login=failed')) {
		$append = (strpos($referrer, '?') == true) ? '&login=failed' : '?login=failed';
	} else {
		$append = '';
	}
	wp_redirect( $referrer . $append );  // let's append some information (login=failed) to the URL for the theme to use
	exit;
   	}
}

add_action( 'wp_login_failed', 'front_end_login_fail' );

function auto_redirect_after_logout(){
	$referrer = $_SERVER['HTTP_REFERER'];
	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
		wp_redirect( home_url() );
		exit();
	}
}

add_action('wp_logout','auto_redirect_after_logout');

/* filter buddypress group to read CREW on front-end
* @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext


function my_text_strings( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Group!' :
			$translated_text = __( 'CREW', 'buddypress' );
			break;
		case 'Groups' :
			$translated_text = __( 'CREWS', 'buddypress' );
			break;
		case 'group' :
			$translated_text = __( 'CREW', 'buddypress' );
			break;
		case 'groups' :
		$translated_text = __( 'CREWS', 'buddypress' );
		break;
	}
	return $translated_text;
}
add_filter( 'gettext', 'my_text_strings', 20, 3 );
*/