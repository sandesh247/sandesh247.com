<?php

global $gdtt, $wp_taxonomies;
$defaults = array("category", "post_tag", "link_category");

$tax_default = array_slice($wp_taxonomies, 0, $gdtt->get_defaults_count());
$tax_custom = array_slice($wp_taxonomies, $gdtt->get_defaults_count());

if ($wpv >= 30) {
    $post_types = get_post_types(array(), "objects");
    $post_count = gdttDB::get_post_types_counts();
    $custom_pt = 0;

?>

    <div id="gdpt_server" class="postbox gdrgrid frontright">
        <h3 class="hndle"><span><?php _e("Basic Custom Posts Statistics", "gd-taxonomies-tools"); ?></span></h3>
        <div class="inside">
            <p class="sub"><?php _e("Default Posts Types", "gd-taxonomies-tools"); ?></p>
            <div class="table">
                <table><tbody>
                <?php $first = true;
                    foreach ($post_types as $cpt_data) {
                        if ($cpt_data->_builtin) {
                            include(GDTAXTOOLS_PATH."forms/render/cpt.front.php");
                            $first = false;
                        } else $custom_pt++;
                    } ?>
                </tbody></table>
            </div>
            <p class="sub"><?php _e("Custom Posts Types", "gd-taxonomies-tools"); ?></p>
            <?php if ($custom_pt > 0) { ?>
                <div class="table">
                    <table><tbody>
                    <?php $first = true;
                        foreach ($post_types as $cpt_data) {
                            if (!$cpt_data->_builtin) {
                                include(GDTAXTOOLS_PATH."forms/render/cpt.front.php");
                                $first = false;
                            }
                        } ?>
                    </tbody></table>
                </div>
            <?php } else _e("No custom post types found.", "gd-taxonomies-tools"); ?>
        </div>
    </div>

<?php } ?>

<div id="gdpt_server" class="postbox gdrgrid frontright">
    <h3 class="hndle"><span><?php _e("Basic statistics", "gd-taxonomies-tools"); ?></span></h3>
    <div class="inside">
        <p class="sub"><?php _e("Default Taxonomies", "gd-taxonomies-tools"); ?></p>
        <div class="table">
            <table><tbody>
                <?php $first = true;
                    foreach ($tax_default as $short => $tax) {
                        include(GDTAXTOOLS_PATH."forms/render/tax.front.php");
                        $first = false;
                    } ?>
            </tbody></table>
        </div>
        <p class="sub"><?php _e("Custom Taxonomies", "gd-taxonomies-tools"); ?></p>
        <?php if (count($wp_taxonomies) > $gdtt->get_defaults_count()) { ?>
	        <div class="table">
	            <table><tbody>
	            <?php $first = true;
	                foreach ($tax_custom as $short => $tax) {
	                    include(GDTAXTOOLS_PATH."forms/render/tax.front.php");
	                    $first = false;
	                } ?>
	            </tbody></table>
	        </div>
        <?php } else _e("No custom taxonomies found.", "gd-taxonomies-tools"); ?>
    </div>
</div>
