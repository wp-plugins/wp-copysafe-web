<?php 
	$timestamp = time();
	$token = md5('unique_salt' . $timestamp);

	$post_id = $_GET["post_id"] ;
	$wpcsw_options = get_option("wpcsw_settings") ;
	$max_size = ($wpcsw_options["settings"]["max_size"]) ? $wpcsw_options["settings"]["max_size"] : 100 ;
	$upload_path = $wpcsw_options["settings"]["upload_path"] ;
	$_SESSION['token']=$token;

	$session_id = session_id();
	$token_session = "{$token}-{$session_id}";

	$admin_only = $wpcsw_options["settings"]["admin_only"];
	$allow_uploads= true;
	if( $admin_only )
	{
		global $current_user;
		$allow_uploads = false;
		$user_roles = "|".implode("|",$current_user->roles)."|";
		if( strpos($user_roles,"administrator")>0 ) { $allow_uploads=true; }
	}

?>

<div class="wrap" id="wpcsw_div" title="SecureImage">
	<div id="wpcsw_message"></div>
	<div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
		<?php if( $allow_uploads ) { ?>
			<li class="ui-state-default ui-corner-top ui-state-active"><a href="#" class="ui-tabs-anchor" id="tabs-1-bt" >Add New</a></li>
		<?php } ?>
			<li class="ui-state-default ui-corner-top <?php echo ($allow_uploads)?"":"ui-state-active"; 

?>"><a href="#" class="ui-tabs-anchor" id="tabs-2-bt">Search</a></li>
			<li class="ui-state-default ui-corner-top"><a href="#" class="ui-tabs-anchor" id="tabs-3-bt">Existing Files</a></li>
		</ul>
		
		<?php if( $allow_uploads ) { ?>
		<div id="tabs-1" class="wpcsw_addnew ui-tabs-panel ui-widget-content ui-corner-bottom">
			<div class="icon32" id="icon-addnew"><br /></div>
			<h2>Add New Class File</h2>						
			<div class="wpcsw_upload_content">
				<div id="upload-queue"></div>
				<table> 
					<tr> 
						<td>
							<div class="wpcsw_fileupload">
								<div class="wpcsw_file_select"><input type="file" id="file_select" name="wpcsw_file"/></div>
								<div id="custom-queue">No file chosen</div>
							</div>
						</td>
						<td> 
							<input type="button" value="Upload" class="button button-primary" id="upload"   />
							<a class="button-secondary" onclick="try{top.tb_remove();}catch(e){}; return false;" href="#" id="close1">Close</a>
						</td>
					</tr>
				</table>								
			</div>
			<p>Maximum upload size: <?php echo $max_size?>KB</p>
			<p>You can choose file options after file is uploaded.</p>
			<p>If you use same name with uploaded class file, it will be overwritten.</p>
			<input type="hidden" value="<?php echo $post_id;?>" name="postid" id="postid" />				
			<input type="hidden" value="<?php echo WPCSW_PLUGIN_URL;?>" id="plugin-url" />
			<input type="hidden" value="<?php echo WPCSW_PLUGIN_PATH;?>" id="plugin-dir" />	
			<input type="hidden" value="<?php echo WPCSW_UPLOAD_PATH;?>" id="upload-path" />
			<input type="hidden" value="<?php echo $max_size;?>" id="upload-max-size" />		
			<input type="hidden" value="<?php echo $timestamp;?>" id="token_timestamp" />
			<input type="hidden" value="<?php echo $token_session;?>" id="token" />
			
			<div class="clear"></div>
		</div>
		<?php } ?>
		<div id="tabs-2" class="wpcsw_search ui-tabs-panel ui-widget-content ui-corner-bottom"  <?php echo ($allow_uploads)?"style=\"display:none;\"":""; ?> >
			<div class="icon32" id="icon-search"><br /></div>
			<h2>Search File</h2>
			<p>
				File name : <input type="text" id="wpcsw_searchfile" name="wpcsw_searchfile" class="regular-text"  />
				<input type="hidden" value="$post_id" name="postid" id="postid" />
				<input type="button" value="Search" class="button button-primary" id="search" name="search" />
				<a class="button-secondary" onclick="try{top.tb_remove();}catch(e){}; return false;" href="#" id="close2">Close</a>
			</p>
			<div id="file_details"></div>
			<div class="clear"></div>
		</div>
		
		<div id="tabs-3" class="wpcsw_filelist ui-tabs-panel ui-widget-content ui-corner-bottom" style="display:none;">
			<div class="icon32" id="icon-file"><br /></div>
			<h2>Uploaded Class Files</h2>
			<table class="wp-list-table widefat">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>File</th>
						<th>Size</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody id="wpcsw_upload_list">
					<?php echo get_wpcsw_uploadfile_list();?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>File</th>
						<th>Size</th>
						<th>Date</th>
					</tr>
				</tfoot>
			</table>
			<div class="clear"></div>
		</div>
	</div>
	
	<div id="wpcsw_ajax_process"><div class="wpcsw_ajax_process"></div></div>
</div>