<table class="gdsw-table">
    <tr>
        <td class="tdleft"><?php _e("Taxonomy", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright">
        <select class="widefat gdsw-input-text" id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
            <?php gdtt_render_taxonomies($instance['taxonomy']); ?>
        </select>
        </td>
    </tr>
    <tr>
        <td class="tdleft"><?php _e("Sort by", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright">
        <select class="widefat gdsw-input-text" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
            <option value="name"<?php echo $instance['orderby'] == 'name' ? ' selected="selected"' : ''; ?>><?php _e("Term name", "gd-taxonomies-tools"); ?></option>
            <option value="count"<?php echo $instance['orderby'] == 'count' ? ' selected="selected"' : ''; ?>><?php _e("Posts count", "gd-taxonomies-tools"); ?></option>
        </select>
        </td>
    </tr>
    <tr>
        <td class="tdleft"><?php _e("Order", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright">
        <select class="widefat gdsw-input-text" id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
            <option value="asc"<?php echo $instance['order'] == 'asc' ? ' selected="selected"' : ''; ?>><?php _e("Ascending", "gd-taxonomies-tools"); ?></option>
            <option value="desc"<?php echo $instance['order'] == 'desc' ? ' selected="selected"' : ''; ?>><?php _e("Descending", "gd-taxonomies-tools"); ?></option>
        </select>
        </td>
    </tr>
    <tr>
        <td class="tdleft"><?php _e("Exclude", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright">
            <input class="widefat gdsw-input-text" id="<?php echo $this->get_field_id('exclude'); ?>" name="<?php echo $this->get_field_name('exclude'); ?>" type="text" value="<?php echo $instance["exclude"]; ?>" />
            <br/><em><?php _e("Comma or space separated list of term ID's.", "gd-taxonomies-tools"); ?></em>
        </td>
    </tr>
    <tr>
        <td class="tdleft"><?php _e("Hide empty", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright">
            <input <?php echo $instance['hide_empty'] == 1 ? 'checked="checked"' : ''; ?> type="checkbox" id="<?php echo $this->get_field_id('hide_empty'); ?>" name="<?php echo $this->get_field_name('hide_empty'); ?>" />
        </td>
    </tr>
</table>
<div class="gdsw-table-split"></div>
