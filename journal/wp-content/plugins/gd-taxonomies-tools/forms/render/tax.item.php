<?php

if ($tax_data->name == "link_category") {
    $edit_term_url = "edit-link-categories.php";
} else {
    $edit_term_url = "edit-tags.php?taxonomy=".$tax_data->name;
    if ($tax_data->name == "category" && $wpv < 30) $edit_term_url = "categories.php";
}

$istaxtool = in_array($tax_data->name, $gdtttax);
$tt_url = "admin.php?page=gdtaxtools_taxs&tid=";

foreach ($gdtxall as $tax) {
    if (strtolower(sanitize_user($tax["name"], true)) == $tax_name) {
        $tt_url.= $tax["id"];
        break;
    }
}

?>

<tr id="tax-<?php echo $tax_name; ?>" class="<?php echo $tr_class; ?> author-self status-publish" valign="top">
    <td><?php echo $wpv < 30 ? $tax_data->object_type : join(", ", array_unique($tax_data->object_type)); ?></td>
    <td><strong style="color: #cc0000;"><?php echo $tax_data->label; ?></strong></td>
    <td><strong><?php echo $tax_data->name; ?></strong></td>
    <td style="text-align: center;"><?php echo $wpv < 30 ? $tax_data->rewrite["slug"] : ($tax_data->rewrite ? __("yes", "gd-taxonomies-tools") : __("no", "gd-taxonomies-tools")); ?></td>
    <td style="text-align: center;"><?php echo $tax_data->query_var; ?></td>
    <td style="text-align: center;"><?php echo $tax_data->hierarchical ? __("yes", "gd-taxonomies-tools") : __("no", "gd-taxonomies-tools"); ?></td>
    <td style="text-align: right;"><strong><?php echo count(get_terms($tax_data->name)); ?></strong></td>
    <td style="text-align: right;">
        <?php if (!$default && $istaxtool) { ?>
        <a onclick="return areYouSure()" class="ttoption-del" href="<?php echo $tt_url; ?>&action=deltax"><?php _e("delete", "gd-taxonomies-tools"); ?></a> |
        <a class="ttoption" href="<?php echo $tt_url; ?>&action=edit"><?php _e("edit", "gd-taxonomies-tools"); ?></a> |
        <?php } if ($tax_data->name == "nav_menu") { ?>
        <a class="ttoption" href="nav-menus.php"><?php _e("menus", "gd-taxonomies-tools"); ?></a>
        <?php } else { ?>
        <a class="ttoption" href="<?php echo $edit_term_url; ?>"><?php _e("terms", "gd-taxonomies-tools"); ?></a>
        <?php } ?>
    </td>
</tr>
<?php $tr_class = $tr_class == "" ? "alternate " : ""; ?>