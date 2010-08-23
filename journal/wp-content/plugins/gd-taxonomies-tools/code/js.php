<script type="text/javascript">
function areYouSure() {
    return confirm("<?php _e("Are you sure? Operation is not reversible.", "gd-taxonomies-tools"); ?>");
}

jQuery(document).ready(function() {
    jQuery("#gdtt_tabs").tabs({fx: {height: "toggle"}});
});

function autofill_posttype() {
    var name = jQuery("#cptlabelsname").val();
    var singular_name = jQuery("#cptlabelssingular_name").val();
    if (name == "" || singular_name == "") {
        alert('<?php _e("Both name and singular name must be filled first.", "gd-taxonomies-tools") ?>');
    } else {
        jQuery("#cptlabelsadd_new").val('<?php _e("Add New", "gd-taxonomies-tools") ?>');
        jQuery("#cptlabelsedit").val('<?php _e("Edit", "gd-taxonomies-tools") ?>');
        jQuery("#cptlabelsadd_new_item").val('<?php _e("Add New", "gd-taxonomies-tools") ?> ' + singular_name);
        jQuery("#cptlabelsedit_item").val('<?php _e("Edit", "gd-taxonomies-tools") ?> ' + singular_name);
        jQuery("#cptlabelsnew_item").val('<?php _e("New", "gd-taxonomies-tools") ?> ' + singular_name);
        jQuery("#cptlabelsview_item").val('<?php _e("View", "gd-taxonomies-tools") ?> ' + singular_name);
        jQuery("#cptlabelssearch_items").val('<?php _e("Search", "gd-taxonomies-tools") ?> ' + name);
        jQuery("#cptlabelsnot_found").val('<?php _e("No", "gd-taxonomies-tools") ?> ' + name + ' <?php _e("Found", "gd-taxonomies-tools") ?>');
        jQuery("#cptlabelsnot_found_in_trash").val('<?php _e("No", "gd-taxonomies-tools") ?> ' + name + ' <?php _e("Found In Trash", "gd-taxonomies-tools") ?>');
        jQuery("#cptlabelsview").val('<?php _e("View", "gd-taxonomies-tools") ?> ' + singular_name);
        jQuery("#cptlabelsparent_item_colon").val('<?php _e("Parent", "gd-taxonomies-tools") ?> ' + name + ':');
    }
}

function autofill_taxonomy() {
    var name = jQuery("#taxlabelsname").val();
    var singular_name = jQuery("#taxlabelssingular_name").val();
    if (name == "" || singular_name == "") {
        alert('<?php _e("Both name and singular name must be filled first.", "gd-taxonomies-tools") ?>');
    } else {
        jQuery("#taxlabelsparent_item").val('<?php _e("Parent", "gd-taxonomies-tools") ?> ' + singular_name);
        jQuery("#taxlabelssearch_items").val('<?php _e("Search", "gd-taxonomies-tools") ?> ' + name);
        jQuery("#taxlabelspopular_items").val('<?php _e("Popular", "gd-taxonomies-tools") ?> ' + name);
        jQuery("#taxlabelsall_items").val('<?php _e("All", "gd-taxonomies-tools") ?> ' + name);
        jQuery("#taxlabelsedit_item").val('<?php _e("Edit", "gd-taxonomies-tools") ?> ' + singular_name);
        jQuery("#taxlabelsupdate_item").val('<?php _e("Update", "gd-taxonomies-tools") ?> ' + singular_name);
        jQuery("#taxlabelsadd_new_item").val('<?php _e("Add New", "gd-taxonomies-tools") ?> ' + singular_name);
        jQuery("#taxlabelsnew_item_name").val('<?php _e("New", "gd-taxonomies-tools") ?> ' + singular_name + ' <?php _e("Name", "gd-taxonomies-tools") ?>');
    }
}

function validate_tax_form() {
    var errors = new Array();
    if (jQuery("#taxname").val() == "") errors[errors.length] = "<?php _e("Name", "gd-taxonomies-tools"); ?>";
    if (jQuery("#taxlabel").val() == "") errors[errors.length] = "<?php _e("Label", "gd-taxonomies-tools"); ?>";
    if (errors.length > 0) {
        alert("<?php _e("Some fields are required must be filled. Check this: ", "gd-taxonomies-tools"); ?>" + errors.join(", "));
        return false;
    } else return true;
}

function validate_post_form() {
    var errors = new Array();
    if (jQuery("#cptname").val() == "") errors[errors.length] = "<?php _e("Name", "gd-taxonomies-tools"); ?>";
    if (jQuery("#cptlabel").val() == "") errors[errors.length] = "<?php _e("Label", "gd-taxonomies-tools"); ?>";
    if (errors.length > 0) {
        alert("<?php _e("Some fields are required must be filled. Check this: ", "gd-taxonomies-tools"); ?>" + errors.join(", "));
        return false;
    } else return true;
}
</script>
