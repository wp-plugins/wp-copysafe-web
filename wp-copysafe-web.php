<?php
/*
Plugin Name: CopySafe Web
Plugin URI: http://www.artistscope.com/copysafe_web_protection_wordpress_plugin.asp
Description: Add copy protection from Print Screen and screen capture. Copysafe Web uses encrypted images and domain lock to extend copy protection for all media displayed on a web page.
Author: ArtistScope
Version: 0.4
Author URI: http://www.artistscope.com/

	Copyright 2012 ArtistScope Pty Limited


	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// ================================================================================ //
//                                                                                  //
//  WARNING : DONT CHANGE ANYTHING BELOW IF YOU DONT KNOW WHAT YOU ARE DOING        //
//                                                                                  //
// ================================================================================ //

# set script max execution time to 5mins
set_time_limit(300);

// ============================================================================================================================
# register WordPress menus
function wpcsw_admin_menus() {
    add_menu_page( 'CopySafe Web', 'CopySafe Web', 'publish_posts', 'wpcsw_list' );
    add_submenu_page( 'wpcsw_list', 'CopySafe Web List Files', 'List Files', 'publish_posts', 'wpcsw_list', 'wpcsw_admin_page_list' );
    add_submenu_page( 'wpcsw_list', 'CopySafe Web Settings', 'Settings', 'publish_posts', 'wpcsw_settings', 'wpcsw_admin_page_settings' );
}

// ============================================================================================================================
# "List" Page
function wpcsw_admin_page_list() {
    $files = _get_wpcsw_uploadfile_list();
    
	foreach ($files as $file) {
		$link = "<div class='row-actions'>
					<span><a href='admin.php?page=wpcsw_list&cswfilename={$file["filename"]}&action=cswdel' title=''>Delete</a></span>											
				</div>" ;
        // prepare table row
        $table.= "<tr><td></td><td>{$file["filename"]} {$link}</td><td>{$file["filesize"]}</td><td>{$file["filedate"]}</td></tr>";
	}
		
	if( !$table ){
		 $table.= '<tr><td colspan="3">'.__('No file uploaded yet.').'</td></tr>';
	}
	?>
	<div class="wrap">
	    <div class="icon32" id="icon-file"><br /></div>
	    <?php echo $msg; ?>
	    <h2>List Class Files</h2>
	    <div id="col-container" style="width:700px;">        
            <div class="col-wrap">
                <h3>Uploaded Class Files</h3>
                <table class="wp-list-table widefat">
                    <thead>
                        <tr><th width="5px">&nbsp;</th><th>File</th><th>Size</th><th>Date</th></tr>
                    </thead>
                    <tbody>
                    	<?php echo $table; ?>
                    </tbody>
                    <tfoot>
                        <tr><th>&nbsp;</th><th>File</th><th>Size</th><th>Date</th></tr>
                    </tfoot>
                </table>
            </div>        
	    </div>
	    <div class="clear"></div>
	</div>
<?php
}

// ============================================================================================================================
# "Settings" page
function wpcsw_admin_page_settings() {
    $msg='';
    if ( !empty( $_POST ) ) {
    	$wpcsw_options = get_option( 'wpcsw_settings' ); 
    	extract( $_POST, EXTR_OVERWRITE );
    	
    	if( !$upload_path )$upload_path = 'wp-content/uploads/copysafe-web/';
    	$upload_path = str_replace( "\\", "/", stripcslashes($upload_path)) ;    	
    	if(substr($upload_path, -1) != "/")$upload_path .= "/" ;
    	    	
        $wpcsw_options['settings'] = array(
                                        'upload_path'	=> $upload_path ,
        				'max_size'	=> (int)$max_size,
                                        'mode'		=> $mode,
                                        'ie'		=> $ie,
                                        'ff'		=> $ff,
                                        'ch'		=> $ch,
        				'nav'	   	=> $nav,
                                        'op'		=> $op,
                                        'sa'		=> $sa
                                    );       
        
        $upload_path = ABSPATH . $upload_path ;
        if( !is_dir($upload_path) )mkdir($upload_path, 0, true)	;
        
        update_option( 'wpcsw_settings', $wpcsw_options );
       	$msg = '<div class="updated"><p><strong>'.__( 'Settings Saved' ).'</strong></p></div>';
    }

    $wpcsw_options = get_option( 'wpcsw_settings' );
   	if( $wpcsw_options["settings"] )
   		extract( $wpcsw_options["settings"], EXTR_OVERWRITE );
   	$select = '<option value="demo">Demo Mode</option><option value="licensed">Licensed</option><option value="debug">Debugging Mode</option>';
   	$select = str_replace( 'value="'.$mode.'"','value="'.$mode.'" selected', $select);

?>
<div class="wrap">
    <div class="icon32" id="icon-settings"><br /></div>
    <?php echo $msg; ?>
    <h2>Settings</h2>
    <form action="" method="post">
	    <table class="form-table">
	        <p><strong>Default settings applied to all protected pages:</strong></p>
	    	<tbody>
	            <tr>
	    		  <th align="left"><label>Upload Folder:</label></th>
	    		  <td align="left"> <input value="<?php echo $upload_path; ?>" name="upload_path" class="regular-text code" type="text"></td>
	    	    </tr>
	    	    <tr>
	    		  <th align="left"><label>Maximum upload size:</label></th>
	    		  <td align="left"> <input value="<?php echo $max_size; ?>" name="max_size" class="regular-text" style="width:70px;text-align:right;" type="text">&nbsp;KB</td>
	    	    </tr>
	        	<tr>
	        		<th align="left"><label>Mode</label></th>
	        		<td align="left"> <select name="mode"><?php echo $select; ?></select></td>
	        	</tr>
	            <tr>
	    		  <th align="left"><label>Allow IE:</label></th>
	    		  <td align="left"> <input name="ie" type="checkbox" value="checked" <?php echo $ie; ?>></td>
	    	    </tr>
	            <tr>
	    		  <th align="left"><label>Allow Firefox:</label></th>
	    		  <td align="left"> <input name="ff" type="checkbox" value="checked" <?php echo $ff; ?>></td>
	    	    </tr>
	            <tr>
	    		  <th align="left"><label>Allow Chrome:</label></th>
	    		  <td align="left"> <input name="ch" type="checkbox" value="checked" <?php echo $ch; ?>></td>
	    	    </tr>
	    	    <tr>
		    		<th align="left"><label>Allow Navigator:</label></th>
		    		<td align="left"><input name="nav" type="checkbox" value="checked" <?php echo $nav; ?>></td>
		    	 </tr>
	            <tr>
	    		  <th align="left"><label>Allow Opera:</label></th>
	    		  <td align="left"> <input name="op" type="checkbox" value="checked" <?php echo $op; ?>></td>
	    	    </tr>
	            <tr>
	    		  <th align="left"><label>Allow Safari:</label></th>
	    		  <td align="left"> <input name="sa" type="checkbox" value="checked" <?php echo $sa; ?>></td>
	    	    </tr>
	    	</tbody>
	    </table>
	    <p class="submit">
	        <input type="submit" value="Save Settings" class="button-primary" id="submit" name="submit">
	    </p>
    </form>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<?php
}

// ============================================================================================================================
# convert shortcode to html output
function wpcsw_shortcode( $atts ) {
    global $post ;
	$postid = $post->ID ;
    $filename = $atts["name"] ;	
    
	if( !file_exists( WPCSW_UPLOAD_PATH . $filename ) )
		return "<div style='padding:5px 10px;background-color:#fffbcc'><strong>File($filename) don't exist</strong></div>" ;
	
	$settings = wpcsw_get_first_class_settings() ;
	
	
	// get plugin options
    $wpcsw_options = get_option( 'wpcsw_settings' );
	if( $wpcsw_options["settings"] )
		$settings = wp_parse_args( $wpcsw_options["settings"], $settings );
	
	if( $wpcsw_options["classsetting"][$postid][$filename] )
		$settings = wp_parse_args( $wpcsw_options["classsetting"][$postid][$filename], $settings );
		
	$settings = wp_parse_args( $atts, $settings );
	
	extract( $settings ) ;
    
	if ($ch == "checked") {$chrome = '1';}
	if ($ff == "checked") {$firefox = '1';}
	if ($nav == "checked") {$navigator = '1';}
	if ($op == "checked") {$opera = '1';}
	if ($sa == "checked") {$safari = '1';}
	if ($ie == "checked") {$msie = '1';}
	// $nav = ( $navigator == "checked" ) ? true : false ;

	if( $key_safe == "checked" )$key_safe = 1 ;
	if( $capture_safe == "checked" )$capture_safe = 1 ;
	if( $menu_safe == "checked" )$menu_safe = 1 ;
	if( $remote_safe == "checked" )$remote_safe = 1 ;
	
	$plugin_url = WPCSW_PLUGIN_URL ;
	$plugin_path = WPCSW_PLUGIN_PATH ;
	$upload_path = WPCSW_UPLOAD_PATH ;
	$upload_url = WPCSW_UPLOAD_URL ;

        // display output
        $output = <<<html
	<NOSCRIPT><meta http-equiv="refresh" content="0;url={$plugin_url}download_javascript.html"></NOSCRIPT>
	<script type="text/javascript">
		var wpcsw_plugin_url = "$plugin_url" ;
		var wpcsw_upload_url = "$upload_url" ;
	</script>
	 <script type="text/javascript">
		// hide JavaScript from non-JavaScript browsers
		var m_bpDebugging = false;
		var m_szMode = "$mode";
		var m_szClassName = "$name";
		var m_szImageFolder = "$upload_url";		//  path from root with / on both ends
		var m_bpKeySafe = "$key_safe";
		var m_bpCaptureSafe = "$capture_safe";
		var m_bpMenuSafe = "$menu_safe";
		var m_bpRemoteSafe = "$remote_safe";
		var m_bpWindowsOnly = true;	
		var m_bpProtectionLayer = false;		//this page does not use layer control

		var m_bpChrome = "$chrome";	
		var m_bpFx = "$firefox";			// all firefox browsers from version 5 and later
		var m_bpNav = "$navigator";
		var m_bpOpera = "$opera";
		var m_bpSafari = "$safari";
		var m_bpMSIE = "$msie";

		var m_szDefaultStyle = "ImageLink";
		var m_szDefaultTextColor = "$text_color";
		var m_szDefaultBorderColor = "$border_color";
		var m_szDefaultBorder = "$border";
		var m_szDefaultLoading = "$loading_message";
		var m_szDefaultLabel = "";
		var m_szDefaultLink = "$hyperlink";
		var m_szDefaultTargetFrame = "$target";
		var m_szDefaultMessage = "";

		if (m_szMode == "debug") {
			m_bpDebugging = true;
		}
		
		if ((m_bpCaptureSafe == "1") && (m_bpKeySafe == "1")) {
			var cswbody = document.getElementsByTagName("body")[0];
			cswbody.setAttribute("onselectstart", "return false;");
			cswbody.setAttribute("ondragstart", "return false");
			cswbody.setAttribute("onmousedown", "if (event.preventDefault){event.preventDefault();}");
			cswbody.setAttribute("onBeforePrint", "document.body.style.display = '';");
			cswbody.setAttribute("onContextmenu", "return false;");
			cswbody.setAttribute("onClick", "if(event.button==2||event.button==3){event.preventDefault();event.stopPropagation();return false;}");
		}
		else if ((m_bpCaptureSafe == "1") && (m_bpKeySafe != "1")) {
			var cswbody = document.getElementsByTagName("body")[0];
			cswbody.setAttribute("onselectstart", "return false;");
			cswbody.setAttribute("ondragstart", "return false");
		//	cswbody.setAttribute("onmousedown", "if (event.preventDefault){event.preventDefault();}");
			cswbody.setAttribute("onBeforePrint", "document.body.style.display = '';");
			cswbody.setAttribute("onContextmenu", "return false;");
			cswbody.setAttribute("onClick", "if(event.button==2||event.button==3){event.preventDefault();event.stopPropagation();return false;}");
		}		
	 </script>	 
	 <script src="{$plugin_url}wp-copysafe-web.js" type="text/javascript"></script>
     <div>
		 <script type="text/javascript">
			//hide JavaScript from non-JavaScript browsers
			if ((m_szMode == "licensed") || (m_szMode == "debug")) {
				insertCopysafeWeb("$name");
			}
			else {
				document.writeln("<img src='{$plugin_url}images/copysafebutton.png' border='0' alt='Demo mode'>");
			}			
		 </script>	
     </div>
html;

       return $output;
   
}

// ============================================================================================================================
# delete short code
function wpcsw_delete_shortcode() {
    // get all posts
    $posts_array = get_posts();
    foreach ( $posts_array as $post ) {
        // delete short code
        $post->post_content = wpcsw_deactivate_shortcode( $post->post_content );
        // update post
        wp_update_post( $post );
    }
}

// ============================================================================================================================
# deactivate short code
function wpcsw_deactivate_shortcode( $content ) {
    // delete short code
    $content = preg_replace( '/\[copysafe name="[^"]+"\]\[\/copysafe\]/s', '', $content );
	return $content;
}

// ============================================================================================================================
# search short code in post content and get post ids
function wpcsw_search_shortcode( $file_name ) {
    // get all posts
    $posts = get_posts();
    $IDs   = false;
    foreach ( $posts as $post ) {
        $file_name = preg_quote( $file_name,'\\' );
        preg_match( '/\[copysafe name="'.$file_name.'"\]\[\/copysafe\]/s', $post->post_content, $matches );
        if ( is_array($matches) && isset( $matches[1] ) ) {
            $IDs[] = $post->ID;
        }
    }
    return $IDs;
}


// ============================================================================================================================
# delete file options
function wpcsw_delete_file_options( $file_name ) {
    $file_name = trim($file_name) ;
   	$wpcsw_options = get_option( 'wpcsw_settings' );
   	foreach ($wpcsw_options["classsetting"] as $k => $arr) {
   		if($wpcsw_options["classsetting"][$k][$file_name]){
   			unset($wpcsw_options["classsetting"][$k][$file_name]) ;
   			if( !count($wpcsw_options["classsetting"][$k]) )
   				unset($wpcsw_options["classsetting"][$k]) ;
   		}   			
   	}
   	update_option( 'wpcsw_settings', $wpcsw_options );
}

// ============================================================================================================================
# install media buttons
function wpcsw_media_buttons ( $context ) {
    global $post_ID;
    // generate token for links
    $token = wp_create_nonce( 'wpcsw_token' );
    $url = plugin_dir_url( __FILE__ ).'media-upload.php?post_id='.$post_ID. '&wpcsw_token='.$token.'&TB_iframe=1';
    $url = site_url('wp-load.php?wpcsw-popup=copysafe&post_id=' . $post_ID) ;
    return $context.="<a href='$url' class='thickbox' id='wpcsw_link' title='CopySafe Web'><img src='".plugin_dir_url( __FILE__ )."/images/copysafebutton.png'></a>";
}


// ============================================================================================================================
# browser detector js file
function wpcsw_load_js() {
    // load custom JS file
	// wp_enqueue_script( 'wpcsw-browser-detector', plugins_url( '/browser_detection.js', __FILE__), array( 'jquery' ) );
}

// ============================================================================================================================
# admin page scripts
function wpcsw_admin_load_js() {
    // load jquery suggest plugin
    wp_enqueue_script( 'suggest' );
}

// ============================================================================================================================
# admin page styles
function wpcsw_admin_load_styles() {
    // register custom CSS file & load
    wp_register_style( 'wpcsw-style', plugins_url( 'wp-copysafe-web.css', __FILE__ ) );
	wp_enqueue_style( 'wpcsw-style' );
}

function wpcsw_is_admin_postpage(){
	$chk = false ;
	$ppage = end(explode("/", $_SERVER["SCRIPT_NAME"])) ;
	if($ppage == "post-new.php" || $ppage == "post.php" )return true ;
}
function wpcsw_includecss_js(){
	if(!wpcsw_is_admin_postpage())return ;
	global $wp_popup_upload_lib ;
	if( $wp_popup_upload_lib )return ;
	$wp_popup_upload_lib = true ;
	echo "<link rel='stylesheet' href='http://code.jquery.com/ui/1.9.2/themes/redmond/jquery-ui.css' type='text/css' />" ;
	echo "<link rel='stylesheet' href='" . WPCSW_PLUGIN_URL . "lib/uploadify/uploadify.css' type='text/css' />" ;
	echo "<script type='text/javascript' src='" . WPCSW_PLUGIN_URL . "lib/uploadify/jquery.min.js'></script>" ;
	echo "<script type='text/javascript' src='" . WPCSW_PLUGIN_URL . "lib/uploadify/jquery.uploadify.min.js'></script>" ;
	echo "<script type='text/javascript' src='" . WPCSW_PLUGIN_URL . "lib/jquery.json-2.3.js'></script>" ;	
	
}
// ============================================================================================================================
# setup plugin
function wpcsw_setup () {
    //----add codding---- 
	$options = get_option("wpcsw_settings");	
    define( 'WPCSW_PLUGIN_PATH', str_replace("\\", "/", plugin_dir_path(__FILE__) ) ); //use for include files to other files
	define( 'WPCSW_PLUGIN_URL' , plugins_url( '/', __FILE__ ) );
	define( 'WPCSW_UPLOAD_PATH', str_replace("\\", "/", ABSPATH . $options["settings"]["upload_path"] ) ); //use for include files to other files
	define( 'WPCSW_UPLOAD_URL' , site_url( $options["settings"]["upload_path"] ) );
	include(WPCSW_PLUGIN_PATH . "function.php") ; 
	add_action('admin_head', 'wpcsw_includecss_js') ; 
	add_action('wp_ajax_wpcsw_ajaxprocess', 'wpcsw_ajaxprocess' );
	
	if ( $_GET['page'] == 'wpcsw_list' && $_GET['cswfilename'] && $_GET['action'] == 'cswdel' ) {
        wpcsw_delete_file_options( $_GET['cswfilename'] );
        if( file_exists( WPCSW_UPLOAD_PATH . $_GET['cswfilename'] ) )unlink ( WPCSW_UPLOAD_PATH . $_GET['cswfilename'] );
        wp_redirect( 'admin.php?page=wpcsw_list' ) ;
	}
		
	if( isset($_GET['wpcsw-popup']) && $_GET["wpcsw-popup"] == "copysafe" ){			
		require_once( WPCSW_PLUGIN_PATH . "popup_load.php" );
	}	
	//=============================	
	
	// load js file
    add_action( 'wp_enqueue_scripts', 'wpcsw_load_js' );

    // load admin CSS
    add_action( 'admin_print_styles', 'wpcsw_admin_load_styles' );

    // add short code
    add_shortcode( 'copysafe', 'wpcsw_shortcode' );

    // if user logged in
    if ( is_user_logged_in() ) {
        // install admin menu
        add_action( 'admin_menu', 'wpcsw_admin_menus' );

        // check user capability
        if ( current_user_can( 'edit_posts' ) ) {
            // load admin JS
            add_action( 'admin_print_scripts', 'wpcsw_admin_load_js' );
            // load media button
            add_action( 'media_buttons_context', 'wpcsw_media_buttons' );
        }
    }
}

// ============================================================================================================================
# runs when plugin activated
function wpcsw_activate () {
     // if this is first activation, setup plugin options
    if ( !get_option( 'wpcsw_settings' ) ) {
        // set plugin folder
	    $upload_dir = 'wp-content/uploads/copysafe-web/';
	    	    
        // set default options
        $wpcsw_options['settings'] = array(
                                        'upload_path'	=> $upload_dir,
        				'max_size'	=> 100,
                                        'mode'          => "demo",
                                        'ie'            => "checked",
                                        'ff'            => "checked",
                                        'ch'            => "checked",
        				'nav'		=> "checked",
                                        'op'            => "checked",
                                        'sa'            => "checked"
                                    );

        update_option( 'wpcsw_settings' , $wpcsw_options );
        
        $upload_dir = ABSPATH . $upload_dir ;
        if ( !is_dir( $upload_dir ) ) mkdir( $upload_dir, 0, true );
        // create upload directory if it is not exist
    }
}

// ============================================================================================================================
# runs when plugin deactivated
function wpcsw_deactivate () {
    // remove text editor short code
    remove_shortcode( 'copysafe' );
}

// ============================================================================================================================
# runs when plugin deleted.
function wpcsw_uninstall () {
	// delete all uploaded files
    $default_upload_dir = ABSPATH . 'wp-content/uploads/copysafe-web/';
    if( is_dir($default_upload_dir) ){
	    $dir = scandir( $default_upload_dir );
	    foreach ( $dir as $file ) {
	        if ( $file != '.' || $file != '..' ) {
	            unlink( $default_upload_dir.$file );
	        }
	    }
	    rmdir( $default_upload_dir );
    }    

    // delete upload directory    
    $options = get_option("wpcsw_settings");
    
    if( $options["settings"]["upload_path"] ){    	
    	$upload_path = ABSPATH . $options["settings"]["upload_path"] ;    
	    if( is_dir($upload_path) ){
	    	$dir = scandir( $upload_path );
		    foreach ( $dir as $file ) {
		        if ( $file != '.' || $file != '..' ) {
		            unlink( $upload_path . '/'.$file );
		        }
		    }	
		    // delete upload directory
		    rmdir( $upload_path );
	    }    
    }    

    // delete plugin options
    delete_option( 'wpcsw_settings' );

    // unregister short code
    remove_shortcode( 'copysafe' );

    // delete short code from post content
    wpcsw_delete_shortcode();
}

// ============================================================================================================================
# register plugin hooks
register_activation_hook( __FILE__, 'wpcsw_activate' ); // run when activated
register_deactivation_hook( __FILE__, 'wpcsw_deactivate' ); // run when deactivated
register_uninstall_hook( __FILE__, 'wpcsw_uninstall' ); // run when uninstalled

add_action( 'init', 'wpcsw_setup' );
?>