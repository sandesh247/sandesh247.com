<?php

$tt_url = "admin.php?page=gdtaxtools_postypes&pid=";

foreach ($gdcpall as $cpt) {
    if (strtolower(sanitize_user($cpt["name"], true)) == $cpt_name) {
        $tt_url.= $cpt["id"];
        break;
    }
}

?>

<tr id="cpt-<?php echo $cpt_name; ?>" class="<?php echo $tr_class; ?> author-self status-publish" valign="top">
    <td><strong style="color: #cc0000;"><?php echo $cpt_data->label; ?></strong></td>
    <td><strong><?php echo $cpt_data->name; ?></strong></td>
    <td style="text-align: center;">
        <?php echo $cpt_data->public ? __("yes", "gd-taxonomies-tools") : __("no", "gd-taxonomies-tools"); ?> /
        <?php echo $cpt_data->show_ui ? __("yes", "gd-taxonomies-tools") : __("no", "gd-taxonomies-tools"); ?>
    </td>
    <td style="text-align: center;"><?php echo $cpt_data->rewrite ? __("yes", "gd-taxonomies-tools") : __("no", "gd-taxonomies-tools"); ?></td>
    <td style="text-align: center;"><?php echo $cpt_data->hierarchical ? __("yes", "gd-taxonomies-tools") : __("no", "gd-taxonomies-tools"); ?></td>
    <td><?php echo $cpt_data->capability_type; ?></td>
    <td style="text-align: right;"><?php echo intval($post_count[$cpt_data->name]); ?></td>
    <td style="text-align: right;">
        <?php if (!$default) { ?>
        <a onclick="return areYouSure()" class="ttoption-del" href="<?php echo $tt_url; ?>&action=delcpt"><?php _e("delete", "gd-taxonomies-tools"); ?></a> |
        <a class="ttoption" href="<?php echo $tt_url; ?>&action=edit"><?php _e("edit", "gd-taxonomies-tools"); ?></a> |
        <?php } ?>
        <?php if ($cpt_data->public && $cpt_name != "attachment") { ?>
        <a class="ttoption" href="edit.php?post_type=<?php echo $cpt_data->name; ?>"><?php _e("open", "gd-taxonomies-tools"); ?></a>
        <?php } ?>
    </td>
</tr>
<?php $tr_class = $tr_class == "" ? "alternate " : ""; ?>