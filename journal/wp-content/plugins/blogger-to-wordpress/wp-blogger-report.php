<div class="wrap">
<h2>Imported posts from blogger.</h2>
<?php 
	global $wpdb;
	$blogUrl = $_REQUEST['blogUrl'];
	($_REQUEST['pageNo'])?$pageNo=$_REQUEST['pageNo']:$pageNo=1;
	$offset = (($pageNo-1)*10);
	
	$totalPosts = getNoOfImportedPosts();
	$totalPages = ($totalPosts+10)/10;
	$sql = "SELECT
			post_id
			FROM
			{$wpdb->prefix}postmeta
			WHERE
			meta_key =  'blogger_permalink'
			LIMIT {$offset},10
			";
	$postIds = $wpdb->get_col($sql);
	if(!empty($postIds)){
		?>
		<ul>
		<?php 
		$j = $offset;
		foreach ($postIds as $postId){
			$j++;
			$postUrl =  get_permalink($postId);
			$postDetails = get_post($postId); 
			$postTitle = $postDetails->post_title;
			if($postTitle){
			?>
				<li><?php echo $j ?> | <a href="<?php echo $postUrl;?>" title="<?php echo $postTitle; ?>"><?php echo $postTitle; ?></a></li>
			<?php
			} else {
				?>
				<li><?php echo $j ?> | Error!</li>
			<?php
			}
		}
		?>
		</ul>
		<div class="paging">
		Page: 
		<?php 
		for ($i = 1;$i<=$totalPages;$i++){
			if($pageNo !=$i){
				?>
				<a style="text-decoration:none;" href="<?php echo site_url();?>/wp-admin/options-general.php?page=blogger-to-wordpress/wp-blogger-to-wordpress.php&pageNo=<?php echo $i ?>" title="Import"><?php echo $i ?> | </a>
				<?php
			} else {
				echo " ".$i." | ";
			}
		}
		?>
		</div>
		<?php 
	} else {	?>
	<p>Sorry! No valid posts found. <a href="<?php echo site_url();?>/wp-admin/admin.php?import=blogger" title="Import">Import posts from Blogger</a></p>
	<?php } ?>
</div>