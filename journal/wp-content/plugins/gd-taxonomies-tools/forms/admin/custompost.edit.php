<?php

$editor = true;

if ($errors == "name") {
    gdtt_render_alert("Error", __("Name for the custom post type is invalid. Fix before proceeding.", "gd-taxonomies-tools"));
}

if (isset($_POST["gdtt_savecpt"])) {
    $this->o["force_rules_flush"] = 1;
    update_option('gd-taxonomy-tools', $this->o);

    $cpt = $this->edit_cpt;
    if ($errors == "") {
        $editor = false;
        gdtt_render_notice("Custom Post Type", __("New custom post type updated.", "gd-taxonomies-tools"));
        ?>
        <div class="inputbutton" style="margin-top: 10px;"><a href="admin.php?page=gdtaxtools_postypes"><?php _e("Go Back", "gd-taxonomies-tools"); ?></a></div>
        <?php
    }
}

if ($editor) include(GDTAXTOOLS_PATH."forms/admin/custompost.form.php");

?>