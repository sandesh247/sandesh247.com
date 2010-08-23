<table class="gdsw-table">
    <tr>
        <td class="tdleft"><?php _e("Display as", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright">
        <select class="widefat gdsw-input-text" id="<?php echo $this->get_field_id('display_render'); ?>" name="<?php echo $this->get_field_name('display_render'); ?>">
            <option value="list"<?php echo $instance['display_render'] == 'list' ? ' selected="selected"' : ''; ?>><?php _e("List", "gd-taxonomies-tools"); ?></option>
            <option value="drop"<?php echo $instance['display_render'] == 'drop' ? ' selected="selected"' : ''; ?>><?php _e("Drop down", "gd-taxonomies-tools"); ?></option>
        </select>
        </td>
    </tr>
    <tr>
        <td class="tdleft"><?php _e("First Option", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright">
            <input class="widefat gdsw-input-text" id="<?php echo $this->get_field_id('show_option_none'); ?>" name="<?php echo $this->get_field_name('show_option_none'); ?>" type="text" value="<?php echo $instance["show_option_none"]; ?>" />
            <br/><em><?php _e("Used only for drop down display.", "gd-taxonomies-tools"); ?></em>
        </td>
    </tr>
    <tr>
        <td class="tdleft"><?php _e("Additional CSS class", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright"><input class="widefat gdsw-input-text" id="<?php echo $this->get_field_id('display_css'); ?>" name="<?php echo $this->get_field_name('display_css'); ?>" type="text" value="<?php echo $instance["display_css"]; ?>" /></td>
    </tr>
    <tr>
        <td class="tdleft"><?php _e("Show number of posts", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright">
            <input <?php echo $instance['display_count'] == 1 ? 'checked="checked"' : ''; ?> type="checkbox" id="<?php echo $this->get_field_id('display_count'); ?>" name="<?php echo $this->get_field_name('display_count'); ?>" />
        </td>
    </tr>
</table>
