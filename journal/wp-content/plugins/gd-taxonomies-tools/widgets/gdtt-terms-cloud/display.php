<table class="gdsw-table">
    <tr>
        <td class="tdleft"><?php _e("Additional CSS class", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright"><input class="widefat gdsw-input-text" id="<?php echo $this->get_field_id('display_css'); ?>" name="<?php echo $this->get_field_name('display_css'); ?>" type="text" value="<?php echo $instance["display_css"]; ?>" /></td>
    </tr>
</table>
<table class="gdsw-table">
    <tr>
        <td class="tdleft"><?php _e("Font size unit", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright"><input class="widefat gdsw-input-number" id="<?php echo $this->get_field_id('unit'); ?>" name="<?php echo $this->get_field_name('unit'); ?>" type="text" value="<?php echo $instance["unit"]; ?>" /></td>
    </tr>
    <tr>
        <td class="tdleft"><?php _e("Smallest term size", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright"><input class="widefat gdsw-input-number" id="<?php echo $this->get_field_id('smallest'); ?>" name="<?php echo $this->get_field_name('smallest'); ?>" type="text" value="<?php echo $instance["smallest"]; ?>" /></td>
    </tr>
    <tr>
        <td class="tdleft"><?php _e("Largest term size", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright"><input class="widefat gdsw-input-number" id="<?php echo $this->get_field_id('largest'); ?>" name="<?php echo $this->get_field_name('largest'); ?>" type="text" value="<?php echo $instance["largest"]; ?>" /></td>
    </tr>
</table>
