<tr<?php echo $first ? ' class="first"' : ''; $first = false; ?>>
    <td class="first b"><?php echo $tax->label; ?></td>
    <td class="t"><?php _e("for", "gd-taxonomies-tools"); ?> <strong><?php echo $wpv < 30 ? $tax->object_type : join(", ", array_unique($tax->object_type)); ?></strong><?php if ($tax->hierarchical == 1) echo ", ".__("hierarchical", "gd-taxonomies-tools"); ?></td>
    <td class="b options" style="font-weight: bold;"><?php echo count(get_terms($tax->name)); ?></td>
</tr>
