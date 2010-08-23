<?php

$editor = true;
$cpt = array(
        "id" => 0,
        "name" => "",
        "description" => "",
        "public" => "yes",
        "ui" => "yes",
        "nav_menus" => "yes",
        "hierarchy" => "no",
        "rewrite" => "yes",
        "rewrite_slug" => "",
        "rewrite_front" => "no",
        "exclude_from_search" => "no",
        "publicly_queryable" => "yes",
        "can_export" => "yes",
        "query" => "yes",
        "edit_link" => "post.php?post=%d",
        "supports" => array(
            "title", "editor", "excerpts",
            "trackbacks", "custom-fields",
            "comments", "revisions",
            "post-thumbnails"),
        "taxonomies" => array(
            "category", "post_tag"),
        "labels" => array(
            "name" => "", "singular_name" => "",
            "add_new" => "", "add_new_item" => "",
            "edit_item" => "", "edit" => "",
            "new_item" => "", "view_item" => "",
            "search_items" => "", "not_found" => "",
            "not_found_in_trash" => "", "view" => "",
            "parent_item_colon" => ""),
        "caps" => array(
            "edit_post" => "edit_post",
            "edit_posts" => "edit_posts",
            "edit_others_posts" => "edit_others_posts",
            "publish_posts" => "publish_posts",
            "read_post" => "read_post",
            "read_private_posts" => "read_private_posts",
            "delete_post" => "delete_post")
    );

if ($errors == "name") {
    gdtt_render_alert("Error", __("Name for the custom post type is invalid. Fix before proceeding.", "gd-taxonomies-tools"));
}

if (isset($_POST["gdtt_savecpt"])) {
    $this->o["force_rules_flush"] = 1;
    update_option('gd-taxonomy-tools', $this->o);

    $cpt = $this->edit_cpt;
    if ($errors == "") {
        $editor = false;
        gdtt_render_notice("Custom Post Type", __("New custom post type added.", "gd-taxonomies-tools"));
        ?>
        <div class="inputbutton" style="margin-top: 10px;"><a href="admin.php?page=gdtaxtools_postypes"><?php _e("Go Back", "gd-taxonomies-tools"); ?></a></div>
        <?php
    }
}

if ($editor) include(GDTAXTOOLS_PATH."forms/admin/custompost.form.php");

?>