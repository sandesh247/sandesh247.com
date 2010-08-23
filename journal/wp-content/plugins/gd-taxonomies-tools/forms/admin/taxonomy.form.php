<form method="post" action="" onsubmit="return validate_tax_form()">
<input type="hidden" name="tax[id]" value="<?php echo $tax["id"]; ?>" />
<table class="form-table"><tbody>
<tr><th scope="row"><?php _e("Name", "gd-taxonomies-tools"); ?></th>
    <td>
        <input<?php echo $tax["id"] > 0 ? " readonly" : ""; ?> type="text" value="<?php echo $tax["name"]; ?>" id="taxname" name="tax[name]" class="input-text-middle<?php echo $tax["id"] > 0 ? " disabled" : ""; ?>" />
        <?php if ($tax["id"] > 0 && false) { ?>
        <br /><input type="checkbox" name="tax[rename]" /><label style="margin-left: 5px;"><?php _e("Allow renaming of the taxonomy name. This will cause renaming all database entries for this taxonomy.", "gd-taxonomies-tools"); ?></label>
        <?php } ?>
        <div class="gdsr-table-split"></div>
        <div class="gdsr-major-info">
            <?php _e("This must be unique name, not used by any other taxonomy.", "gd-taxonomies-tools"); ?><br />
            <?php _e("Also, use only lower case letters and no special characters except for the underscore.", "gd-taxonomies-tools"); ?>
        </div>
    </td>
</tr>
<?php if ($wpv < 30) { ?>
<tr><th scope="row"><?php _e("Label", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" style="vertical-align: top;">
                    <?php _e("Standard", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top" colspan="3">
                    <input type="text" id="taxlabel" value="<?php echo $tax["label"]; ?>" name="tax[label]" class="input-text-middle" />
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("This is the display name for the taxonomy. WordPress 3.0 uses different model for labels.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<?php } else { ?>
<tr><th scope="row"><?php _e("Labels", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" style="vertical-align: top;"><?php _e("Name", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxlabelsname" value="<?php echo $tax["labels"]["name"]; ?>" name="tax[labels][name]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150" style="vertical-align: top;"><?php _e("Singular Name", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxlabelssingular_name" value="<?php echo $tax["labels"]["singular_name"]; ?>" name="tax[labels][singular_name]" class="input-text-middle" />
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <div class="inputbutton"><a href="javascript:autofill_taxonomy()"><?php _e("Auto fill rest", "gd-taxonomies-tools"); ?></a></div>
        <div class="gdsr-table-split"></div>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" style="vertical-align: top;"><?php _e("Parent Item", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxlabelsparent_item" value="<?php echo $tax["labels"]["parent_item"]; ?>" name="tax[labels][parent_item]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150" style="vertical-align: top;"><?php _e("Search Items", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxlabelssearch_items" value="<?php echo $tax["labels"]["search_items"]; ?>" name="tax[labels][search_items]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150" style="vertical-align: top;"><?php _e("Popular Items", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxlabelspopular_items" value="<?php echo $tax["labels"]["popular_items"]; ?>" name="tax[labels][popular_items]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150" style="vertical-align: top;"><?php _e("All Items", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxlabelsall_items" value="<?php echo $tax["labels"]["all_items"]; ?>" name="tax[labels][all_items]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150" style="vertical-align: top;"><?php _e("New Item Name", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxlabelsnew_item_name" value="<?php echo $tax["labels"]["new_item_name"]; ?>" name="tax[labels][new_item_name]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150" style="vertical-align: top;"><?php _e("Edit Item", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxlabelsedit_item" value="<?php echo $tax["labels"]["edit_item"]; ?>" name="tax[labels][edit_item]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150" style="vertical-align: top;"><?php _e("Update Item", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxlabelsupdate_item" value="<?php echo $tax["labels"]["update_item"]; ?>" name="tax[labels][update_item]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150" style="vertical-align: top;"><?php _e("Add New Item", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxlabelsadd_new_item" value="<?php echo $tax["labels"]["add_new_item"]; ?>" name="tax[labels][add_new_item]" class="input-text-middle" />
                </td>
            </tr>
        </table>
    </td>
</tr>
<?php } ?>
<tr><th scope="row"><?php _e("Post Types", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" style="vertical-align: top;">
                    <?php _e("Select", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top" colspan="3">
                    <select name="tax[post_type][]" class="drop-sel-checks" multiple>
                    <?php
                        echo sprintf('<option value="(all)">%s</option>', __("(all)", "gd-taxonomies-tools"));
                        foreach ($post_types as $pt) {
                            echo sprintf('<option%s value="%s">%s [%s]</option>',
                                    in_array($pt->name, $tax["domain"]) ? ' selected="selected"' : "",
                                    $pt->name, $pt->label, $pt->name);
                        }
                    ?>
                    </select>
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("At least one type must be selected. If not, Posts type will be added by default.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<?php if ($wpv > 29) { ?>
<tr><th scope="row"><?php _e("Visibility", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" valign="top">
                    <?php _e("Public", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top">
                    <select name="tax[public]" class="input-text-middle">
                        <option value="yes"<?php echo $tax["public"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $tax["public"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
                <td style="width: 20px;"></td>
                <td width="150" valign="top">
                    <?php _e("Show UI", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top">
                    <select name="tax[ui]" class="input-text-middle">
                        <option value="yes"<?php echo $tax["ui"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $tax["ui"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150" valign="top">
                    <?php _e("Tag Cloud Widget", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top">
                    <select name="tax[cloud]" class="input-text-middle">
                        <option value="yes"<?php echo $tax["cloud"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $tax["cloud"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
                <td style="width: 20px;"></td>
                <td width="150" valign="top">
                    <?php _e("Navigation Menus", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top">
                    <select name="tax[nav_menus]" class="input-text-middle">
                        <option value="yes"<?php echo $tax["nav_menus"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $tax["nav_menus"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("Public setting set to NO will hide taxonomies from the admin UI.", "gd-taxonomies-tools"); ?><br/>
        <?php _e("Tag cloud option set to NO will exclude this taxonomy from default Tag Cloud widget. Same goes for Navigation Menus.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<?php } ?>
<tr><th scope="row"><?php _e("Settings", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" valign="top">
                    <?php _e("Hierarchical", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top" colspan="4">
                    <select<?php echo $wpv < 30 ? " disabled" : ""; ?> name="tax[hierarchy]" class="input-text-middle">
                        <option value="no"<?php echo $tax["hierarchy"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                        <option value="yes"<?php echo $tax["hierarchy"] == "yes" ? ' selected="selected"' : ''; ?>><?php _e("Yes", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="150" valign="top">
                    <?php _e("Rewrite", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top">
                    <select name="tax[rewrite]" class="input-text-middle">
                        <option value="yes_name"<?php echo $tax["rewrite"] == "yes_name" ? ' selected="selected"' : ''; ?>><?php _e("Yes, using name", "gd-taxonomies-tools"); ?></option>
                        <?php if ($wpv > 29) { ?><option value="yes_custom"<?php echo $tax["rewrite"] == "yes_custom" ? ' selected="selected"' : ''; ?>><?php _e("Yes, custom value", "gd-taxonomies-tools"); ?></option><?php } ?>
                        <option value="no"<?php echo $tax["rewrite"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
                <td style="width: 20px;"></td>
                <td width="150" valign="top">
                    <?php _e("Custom", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top">
                    <input<?php echo $wpv < 30 ? " disabled" : ""; ?> type="text" value="<?php echo $tax["rewrite_custom"]; ?>" name="tax[rewrite_custom]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150" valign="top">
                    <?php _e("Query Variable", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top">
                    <select name="tax[query]" class="input-text-middle">
                        <option value="yes_name"<?php echo $tax["query"] == "yes_name" ? ' selected="selected"' : ''; ?>><?php _e("Yes, using name", "gd-taxonomies-tools"); ?></option>
                        <option value="yes_custom"<?php echo $tax["query"] == "yes_custom" ? ' selected="selected"' : ''; ?>><?php _e("Yes, custom value", "gd-taxonomies-tools"); ?></option>
                        <option value="no"<?php echo $tax["query"] == "no" ? ' selected="selected"' : ''; ?>><?php _e("No", "gd-taxonomies-tools"); ?></option>
                    </select>
                </td>
                <td style="width: 20px;"></td>
                <td width="150" valign="top">
                    <?php _e("Custom", "gd-taxonomies-tools"); ?>:
                </td>
                <td valign="top">
                    <input type="text" value="<?php echo $tax["query_custom"]; ?>" name="tax[query_custom]" class="input-text-middle" />
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("For rewrite and query custom variables use only lower case letters and no special characters except for the underscore.", "gd-taxonomies-tools"); ?><br />
        <?php if ($wpv < 30) _e("With WP 2.8.x and WP 2.9.x not all options work, and they are disabled. Once the WordPress starts supporting this option, they will be enabled.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<?php if ($wpv > 29) { ?>
<tr><th scope="row"><?php _e("Capabilities", "gd-taxonomies-tools"); ?></th>
    <td>
        <table cellpadding="0" cellspacing="0" class="previewtable">
            <tr>
                <td width="150" style="vertical-align: top;"><?php _e("Manage terms", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxcapsmanage_terms" value="<?php echo $tax["caps"]["manage_terms"]; ?>" name="tax[caps][manage_terms]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150" style="vertical-align: top;"><?php _e("Edit terms", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxcapsedit_terms" value="<?php echo $tax["caps"]["edit_terms"]; ?>" name="tax[caps][edit_terms]" class="input-text-middle" />
                </td>
            </tr>
            <tr>
                <td width="150" style="vertical-align: top;"><?php _e("Delete terms", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxcapsdelete_terms" value="<?php echo $tax["caps"]["delete_terms"]; ?>" name="tax[caps][delete_terms]" class="input-text-middle" />
                </td>
                <td style="width: 20px;"></td>
                <td width="150" style="vertical-align: top;"><?php _e("Assign terms", "gd-taxonomies-tools"); ?>:</td>
                <td valign="top">
                    <input type="text" id="taxcapsassign_terms" value="<?php echo $tax["caps"]["assign_terms"]; ?>" name="tax[caps][assign_terms]" class="input-text-middle" />
                </td>
            </tr>
        </table>
        <div class="gdsr-table-split"></div>
        <?php _e("Do not change any of these if you are not sure what they are.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
<?php } ?>
<tr><th scope="row"><?php _e("Status", "gd-taxonomies-tools"); ?></th>
    <td>
        <input<?php if (isset($tax["active"])) echo " checked"; ?> type="checkbox" name="tax[active]" /><label style="margin-left: 5px;"><?php _e("Taxonomy is set to active.", "gd-taxonomies-tools"); ?></label>
    </td>
</tr>
</tbody></table>
<input type="submit" class="inputbutton" value="<?php _e("Save Taxonomy", "gd-taxonomies-tools"); ?>" name="gdtt_savetax" style="margin-top: 10px;" />
</form>
