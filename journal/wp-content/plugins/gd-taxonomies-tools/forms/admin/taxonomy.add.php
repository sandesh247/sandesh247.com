<?php

$editor = true;
$tax = array(
        "id" => 0,
        "name" => "",
        "public" => "yes",
        "ui" => "yes",
        "nav_menus" => "yes",
        "cloud" => "yes",
        "hierarchy" => "no",
        "rewrite" => "yes_name",
        "rewrite_custom" => "",
        "query" => "yes_name",
        "query_custom" => "",
        "active" => 1,
        "domain" => array(
            "post"),
        "labels" => array(
            "name" => "", "singular_name" => "",
            "search_items" => "", "popular_items" => "",
            "all_items" => "", "parent_item" => "",
            "edit_item" => "", "update_item" => "",
            "add_new_item" => "", "new_item_name" => ""),
        "caps" => array(
            "manage_terms" => "manage_categories",
            "edit_terms" => "manage_categories",
            "delete_terms" => "manage_categories",
            "assign_terms" => "edit_posts")
    );

if ($errors == "name") {
    gdtt_render_alert("Error", __("Name for the taxonomy is invalid. Fix before proceeding.", "gd-taxonomies-tools"));
}

if (isset($_POST["gdtt_savetax"])) {
    $this->o["force_rules_flush"] = 1;
    update_option('gd-taxonomy-tools', $this->o);

    $tax = $this->edit_tax;
    if ($errors == "") {
        $editor = false;
        gdtt_render_notice("Taxonomy", __("New taxonomy added.", "gd-taxonomies-tools"));
        ?>
        <div class="inputbutton" style="margin-top: 10px;"><a href="admin.php?page=gdtaxtools_taxs"><?php _e("Go Back", "gd-taxonomies-tools"); ?></a></div>
        <?php
    }
}

if ($editor) include(GDTAXTOOLS_PATH."forms/admin/taxonomy.form.php");

?>