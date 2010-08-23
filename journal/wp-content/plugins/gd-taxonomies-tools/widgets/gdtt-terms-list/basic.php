<table class="gdsw-table">
    <tr>
        <td class="tdleft"><?php _e("Title", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright"><input class="widefat gdsw-input-text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance["title"]; ?>" /></td>
    </tr>
    <tr>
        <td class="tdleft"><?php _e("Maximum terms to show", "gd-taxonomies-tools"); ?>:</td>
        <td class="tdright"><input class="widefat gdsw-input-number" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $instance["number"]; ?>" /></td>
    </tr>
</table>
<div class="gdsw-table-split"></div>
