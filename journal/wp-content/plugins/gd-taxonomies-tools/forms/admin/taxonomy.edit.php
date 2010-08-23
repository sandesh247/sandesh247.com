<?php

$editor = true;

if ($errors == "name") {
    gdtt_render_alert("Error", __("Name for the taxonomy is invalid. Fix before proceeding.", "gd-taxonomies-tools"));
}

if (isset($_POST["gdtt_savetax"])) {
    $this->o["force_rules_flush"] = 1;
    update_option('gd-taxonomy-tools', $this->o);

    $tax = $this->edit_tax;
    if ($errors == "") {
        $editor = false;
        gdtt_render_notice("Taxonomy", __("Taxonomy updated.", "gd-taxonomies-tools"));
        ?>
        <div class="inputbutton" style="margin-top: 10px;"><a href="admin.php?page=gdtaxtools_taxs"><?php _e("Go Back", "gd-taxonomies-tools"); ?></a></div>
        <?php
    }
}

if ($editor) include(GDTAXTOOLS_PATH."forms/admin/taxonomy.form.php");

?>