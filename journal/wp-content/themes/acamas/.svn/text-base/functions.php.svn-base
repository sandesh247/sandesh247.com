<?php

// Filter away the default scripts loaded with Thematic
function childtheme_head_scripts() {
    // Abscence makes the heart grow fonder
}
add_filter('thematic_head_scripts','childtheme_head_scripts');

// Add a link to the footer for credit
function childtheme_theme_link($themelink) {
    return '<a class="child-theme-link" href="http://themeshaper.com/acamas-theme-clarity-elegance-power/" title="Acamas Theme" rel="designer">Acamas Theme</a>';
}
add_filter('thematic_theme_link', 'childtheme_theme_link');

//Look for variant.css in wp-content/acamas-variant
function acamas_variantcss() {
    // Pre-2.6 compatibility
    if ( !defined('WP_CONTENT_URL') )
        define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
    if ( !defined('WP_CONTENT_DIR') )
        define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
    
    // Guess the location
    $variantcss_path = WP_CONTENT_DIR.'/acamas-variant/variant.css';
    $variantcss_url = WP_CONTENT_URL.'/acamas-variant/variant.css';

    if (file_exists($variantcss_path)) { ?>   
        <!-- Custom CSS -->
    	<link rel="stylesheet" type="text/css" href="<?php bloginfo('wpurl'); ?>/wp-content/acamas-variant/variant.css" />      	
    	
    <?php } elseif (file_exists($variantcss_url)) { ?>   
        <!-- Custom CSS -->
    	<link rel="stylesheet" type="text/css" href="<?php bloginfo('wpurl'); ?>/wp-content/acamas-variant/variant.css" />
    <?php }  	
} 
add_action('wp_head', 'acamas_variantcss');

// Fix IE6.
function childtheme_ieupgrade() { ?>
    <!--[if IE 6]>
    <link rel="stylesheet" type="text/css" href="<?php echo dirname( get_bloginfo('stylesheet_url') ) ?>/ie6.css" />
    <![endif]-->
<?php }
add_action('wp_head', 'childtheme_ieupgrade');

// Theme Options

$childthemename = "Acamas";
$childshortname = "acms";
$childoptions = array();

function acamas_options() {
    global $childthemename, $childshortname, $childoptions;
		$acms_categories_obj = get_categories('hide_empty=0');
		$acms_categories = array();
		foreach ($acms_categories_obj as $acms_cat) {
				$acms_categories[$acms_cat->cat_ID] = $acms_cat->cat_name;
		}
		$categories_std = array_unshift($acms_categories, "Select a category:");

		$childoptions = array (
										
				array(	"name" => "Featured Category",
								"desc" => "Select a category of posts to be uniquely featured in this theme.",
								"id" => $childshortname."_featurecategory",
								"std" => $categories_std,
								"type" => "select",
								"options" => $acms_categories),

		  );
}
add_action('init', 'acamas_options');

// Make a Theme Options Page

function childtheme_add_admin() {

    global $childthemename, $childshortname, $childoptions;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($childoptions as $childvalue) {
                    update_option( $childvalue['id'], $_REQUEST[ $childvalue['id'] ] ); }

                foreach ($childoptions as $childvalue) {
                    if( isset( $_REQUEST[ $childvalue['id'] ] ) ) { update_option( $childvalue['id'], $_REQUEST[ $childvalue['id'] ]  ); } else { delete_option( $childvalue['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($childoptions as $childvalue) {
                delete_option( $childvalue['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($childthemename." Options", "$childthemename Options", 'edit_themes', basename(__FILE__), 'childtheme_admin');

}

function childtheme_admin() {

    global $childthemename, $childshortname, $childoptions;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$childthemename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$childthemename.' settings reset.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $childthemename; ?> Options</h2>

<form method="post">

<table class="form-table">

<?php foreach ($childoptions as $childvalue) { 
	
	switch ( $childvalue['type'] ) {
		case 'text':
		?>
		<tr valign="top"> 
		    <th scope="row"><?php echo $childvalue['name']; ?>:</th>
		    <td>
		        <input name="<?php echo $childvalue['id']; ?>" id="<?php echo $childvalue['id']; ?>" type="<?php echo $childvalue['type']; ?>" value="<?php if ( get_settings( $childvalue['id'] ) != "") { echo get_settings( $childvalue['id'] ); } else { echo $childvalue['std']; } ?>" />
			    <?php echo $childvalue['desc']; ?>
		    </td>
		</tr>
		<?php
		break;
		
		case 'select':
		?>
		<tr valign="top"> 
	        <th scope="row"><?php echo $childvalue['name']; ?>:</th>
	        <td>
	            <select name="<?php echo $childvalue['id']; ?>" id="<?php echo $childvalue['id']; ?>">
	                <?php foreach ($childvalue['options'] as $option) { ?>
	                <option<?php if ( get_settings( $childvalue['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $childvalue['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
	                <?php } ?>
	            </select>
			    <?php echo $childvalue['desc']; ?>
	        </td>
	    </tr>
		<?php
		break;
		
		case 'textarea':
		$ta_options = $childvalue['options'];
		?>
		<tr valign="top"> 
	        <th scope="row"><?php echo $childvalue['name']; ?>:</th>
	        <td>
			    <?php echo $childvalue['desc']; ?>
				<textarea name="<?php echo $childvalue['id']; ?>" id="<?php echo $childvalue['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php 
				if( get_settings($childvalue['id']) != "") {
						echo stripslashes(get_settings($childvalue['id']));
					}else{
						echo $childvalue['std'];
				}?></textarea>
	        </td>
	    </tr>
		<?php
		break;

		case "radio":
		?>
		<tr valign="top"> 
	        <th scope="row"><?php echo $childvalue['name']; ?>:</th>
	        <td>
	            <?php foreach ($childvalue['options'] as $key=>$option) { 
				$radio_setting = get_settings($childvalue['id']);
				if($radio_setting != ''){
		    		if ($key == get_settings($childvalue['id']) ) {
						$checked = "checked=\"checked\"";
						} else {
							$checked = "";
						}
				}else{
					if($key == $childvalue['std']){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
				}?>
	            <input type="radio" name="<?php echo $childvalue['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />
	            <?php } ?>
	        </td>
	    </tr>
		<?php
		break;
		
		case "checkbox":
		?>
			<tr valign="top"> 
		        <th scope="row"><?php echo $childvalue['name']; ?>:</th>
		        <td>
		           <?php
						if(get_settings($childvalue['id'])){
							$checked = "checked=\"checked\"";
						}else{
							$checked = "";
						}
					?>
		            <input type="checkbox" name="<?php echo $childvalue['id']; ?>" id="<?php echo $childvalue['id']; ?>" value="true" <?php echo $checked; ?> />
		            <?php  ?>
			    <?php echo $childvalue['desc']; ?>
		        </td>
		    </tr>
			<?php
		break;

		default:

		break;
	}
}
?>

</table>

<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

<p><?php _e('For more information about this theme, <a href="http://themeshaper.com">visit ThemeShaper</a>. If you have any questions, visit the <a href="http://themeshaper.com/forums/">ThemeShaper Forums</a>.', 'thematic'); ?></p>

<?php
}

add_action('admin_menu' , 'childtheme_add_admin');
 

// Create a featured content area on the home page

function acamas_featured_content() {
    if (is_home()) { ?>
        
        <?php
            global $childoptions;
            foreach ($childoptions as $childvalue) {
            if (get_settings( $childvalue['id'] ) === FALSE) { $$childvalue['id'] = $childvalue['std']; }
            else { $$childvalue['id'] = get_settings( $childvalue['id'] ); }
            }
        ?>
        
        <div id="home-insert">
                           
            <!-- The featured content only appears on the front of this blog -->
            <div id="featured-content" class="featured">
    
                <div id="latest-feature">
                    <h3 class="feature-header"><?php _e('Latest Feature', 'thematic') ?></h3>
                <?php $my_query = new WP_Query("category_name=$acms_featurecategory&showposts=1"); ?>            
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <?php $do_not_duplicate = $post->ID; ?>
                    <div id="feature-content">            
                    	<?php the_excerpt(''.__('Read More <span class="meta-nav">&raquo;</span>', 'thematic').'') ?>
                	</div>
                	<h2 id="latest-feature-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?><span class="meta-nav"> &raquo;</span></a></h2>
                <?php endwhile; ?>            
                </div><!-- #latest-feature -->
    
                <div id="recent-features">
                    <h3 class="feature-header"><?php _e('Recent Features', 'thematic') ?></h3>
                    <ul>                
                        <?php $recentPosts = new WP_Query(); $recentPosts->query("category_name=$acms_featurecategory&showposts=5&offset=1"); ?>            
                        <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
                        <li class="recent-feature-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'thematic'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></li>                    
                        <?php endwhile; ?>                    
                    <?php $acms_featurecategory = get_cat_id($acms_featurecategory); ?>
                        <li id="feature-archives-link"><a href="<?php echo get_category_link($acms_featurecategory);?>" title ="<?php _e('Feature Archives', 'thematic') ?>" rel="nofollow"><?php _e('Browse the feature archives', 'thematic') ?><span class="meta-nav"> …</span></a></li>
                    </ul>
                </div><!-- #recent-features -->          
    
            </div><!-- #featured-content -->
            
        </div><!-- #home-insert -->

        
        
    <?php }
}
add_action('thematic_belowheader','acamas_featured_content');

// Remove featured post category from home page loop
function myHomePostsFilter($query) {
    // Get my theme options
    global $childoptions;
    foreach ($childoptions as $childvalue) {
    if (get_settings( $childvalue['id'] ) === FALSE) { $$childvalue['id'] = $childvalue['std']; }
    else { $$childvalue['id'] = get_settings( $childvalue['id'] ); }
    }
    // Set my query
    $acms_featurecategory = '-' . get_cat_id($acms_featurecategory);
    if ($query->is_home) {
        $query->set('cat', $acms_featurecategory);
    }
    return $query;
}
add_filter('pre_get_posts','myHomePostsFilter');

?>