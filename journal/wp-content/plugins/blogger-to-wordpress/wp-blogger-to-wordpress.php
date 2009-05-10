<?php
/*
Plugin Name: Blogger to Wordpress
Plugin URI: http://arunmvishnu.com/blogger-to-wordpress
Description: Blogger to Wordpress helps you to redirect from your blogspot post to the corresponding wordpress post(Imported from blogger).
Version: 1.1
Author: Arun Vishnu
Author URI: http://arunmvishnu.com
*/
?>
<?php
/*  Copyright 2009  ARUN VISHNU  (email : arunmvishnu@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
	add_action('admin_menu', 'wpBloggerToWordpress');
	
	add_action('init', 'redirectMigratedPost');
	
	function redirectMigratedPost(){
		if(isset($_REQUEST['bloggerURL']) && $_REQUEST['bloggerURL']!=''){
			global $wpdb;
			$blogUrl = $_REQUEST['bloggerURL'];
			$wpdb->escape($blogUrl);
			$sql = "SELECT
					post_id
					FROM
					{$wpdb->prefix}postmeta
					WHERE
					meta_key =  'blogger_permalink' AND
					meta_value =  '{$blogUrl}'
					";
			$postId = $wpdb->get_var($sql);
			if($postId){
				$postUrl =  get_permalink($postId);
				header("location:{$postUrl}");
				exit;
			}
		}
	}
	
	function wpBloggerToWordpress() {
	  add_options_page('Blogger to Wordpress', 'Blogger to Wordpress', 8, __FILE__, 'bloggerToWordpressOptions');
	}
	
	function getNoOfImportedPosts(){
		global $wpdb;
		$blogUrl = $_REQUEST['blogUrl'];
		$wpdb->escape($blogUrl);
		$sql = "SELECT
				COUNT(post_id)
				FROM
				{$wpdb->prefix}postmeta
				WHERE
				meta_key =  'blogger_permalink' 
				";
		$noOfPosts = $wpdb->get_var($sql);
		return $noOfPosts;
	}
	
	function bloggerToWordpressOptions() {
		$noOfPosts = getNoOfImportedPosts();
		?>
	 <div class="wrap">
	 <p></p>
	 <h3>Blogger to Wordpress</h3>
	 <ul>
	 <?php 
	 	if(!$noOfPosts){
	 		?>
			<li> <h4>You have 0 posts imported from your Blogger account. <a href="<?php echo site_url();?>/wp-admin/admin.php?import=blogger" title="Import">Import posts from Blogger</a><h4></li>
			<?php
	 	} else {
			$noOfPostMsg = "You have ".$noOfPosts." posts imported from your Blogger account.";
			?>
<script type="text/javascript">
function validateForm(){
	var frm = document.frmWpBlogger;
	if(frm.txtBlogger.value==''){
		alert("Please enter your blogger url");
		frm.txtBlogger.focus()
		return false;
	}if(frm.newUrl.value==''){
		alert("Please enter new wordpress url");
		frm.newUrl.focus()
		return false;
	}
	return true;
}
</script>
			<li><h4> You seems to have <?php echo $noOfPosts ?> posts imported from your Blogger account. You can check the <a target="_blank" href="<?php echo site_url();?>/wp-admin/options-general.php?page=wp-blogger-to-wordpress/wp-blogger-report.php" title="Import">Report</a>.</h4></li>
			<li>You need to put a JavaScript code in your blogger template header to redirect to your new site. Enter the details and get the Javascript.
			</li>
			<li>
			<form target="_blank" name='frmWpBlogger' action="http://arunmvishnu.com/get-redirection-script" method="GET" onsubmit="return validateForm();">
			Your blogger blog name <input type="text" name="txtBlogger" value="" />(eg:- enter "<i><b>arunmvishnu</b></i>" if your blogger blog address is http://www.<b>arunmvishnu</b>.blogspot.com)<br />
			<input type="submit" value="Generate Script">
			<input type="hidden" name="newUrl" value="<?php echo site_url();?>" />
			</form>
			<li>
			<?php
		} 
	?>
	 </ul>
  </div>
	  <?php
	}
?>