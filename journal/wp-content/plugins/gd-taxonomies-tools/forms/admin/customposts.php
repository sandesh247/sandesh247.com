<?php

$post_types = get_post_types(array(), "objects");
$post_count = gdttDB::get_post_types_counts();

echo '<h3>'.__("Default Post Types:", "gd-taxonomies-tools").'</h3>';
include(GDTAXTOOLS_PATH."forms/render/cpt.header.php");
foreach ($post_types as $cpt_data) {
    $default = true;
    $cpt_name = $cpt_data->name;
    if ($cpt_data->_builtin) {
        include(GDTAXTOOLS_PATH."forms/render/cpt.item.php");
    }
}
include(GDTAXTOOLS_PATH."forms/render/cpt.footer.php");

echo '<h3>'.__("Custom Post Types:", "gd-taxonomies-tools").'</h3>';
include(GDTAXTOOLS_PATH."forms/render/cpt.header.php");
foreach ($post_types as $cpt_data) {
    $default = false;
    $cpt_name = $cpt_data->name;
    if (!$cpt_data->_builtin) {
        include(GDTAXTOOLS_PATH."forms/render/cpt.item.php");
    }
}
include(GDTAXTOOLS_PATH."forms/render/cpt.footer.php");

?>
<div class="inputbutton" style="margin-top: 10px;"><a href="admin.php?page=gdtaxtools_postypes&action=addnew"><?php _e("Add New", "gd-taxonomies-tools"); ?></a></div>
