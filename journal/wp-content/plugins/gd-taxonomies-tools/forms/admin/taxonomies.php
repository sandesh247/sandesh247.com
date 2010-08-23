<?php

global $wp_taxonomies, $gdtt;

$tax_default = array_slice($wp_taxonomies, 0, $gdtt->get_defaults_count());
$tax_custom = array_slice($wp_taxonomies, $gdtt->get_defaults_count());
$tax_inactive = $gdtt->prepare_inactive();

echo '<h3>'.__("Default Taxonomies:", "gd-taxonomies-tools").'</h3>';
include(GDTAXTOOLS_PATH."forms/render/tax.header.php");
foreach ($tax_default as $tax_name => $tax_data) {
    $default = true;
    include(GDTAXTOOLS_PATH."forms/render/tax.item.php");
}
include(GDTAXTOOLS_PATH."forms/render/tax.footer.php");

if (count($tax_custom) > 0) {
    echo '<h3>'.__("Custom Taxonomies:", "gd-taxonomies-tools").'</h3>';
    include(GDTAXTOOLS_PATH."forms/render/tax.header.php");
    foreach ($tax_custom as $tax_name => $tax_data) {
        $default = false;
        include(GDTAXTOOLS_PATH."forms/render/tax.item.php");
    }
    include(GDTAXTOOLS_PATH."forms/render/tax.footer.php");
}

if (count($tax_inactive) > 0) {
    echo '<h3>'.__("Inactive Custom Taxonomies:", "gd-taxonomies-tools").'</h3>';
    include(GDTAXTOOLS_PATH."forms/render/tax.header.php");
    foreach ($tax_inactive as $tax_name => $tax_data) {
        $default = false;
        $tax_data->object_type = array();
        include(GDTAXTOOLS_PATH."forms/render/tax.item.php");
    }
    include(GDTAXTOOLS_PATH."forms/render/tax.footer.php");
}

if (count($gdtxall) > 0) {
    $notice = $options["delete_taxonomy_db"] == 1 ?
        __("Deleting the taxonomy will also delete the relationship entries in the database. Backup your database before proceeding with any deletion operation.", "gd-taxonomies-tools") :
        __("After deleting taxonomy, terms relationships in the database will remain.", "gd-taxonomies-tools");
    $notice.= " ".__("You can change that on the settings panel.", "gd-taxonomies-tools");
    gdtt_render_notice("Warning", $notice);
}

?>

<div class="inputbutton" style="margin-top: 10px;"><a href="admin.php?page=gdtaxtools_taxs&action=addnew"><?php _e("Add New", "gd-taxonomies-tools"); ?></a></div>
