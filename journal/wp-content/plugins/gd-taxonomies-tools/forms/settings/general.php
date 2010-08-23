<table class="form-table"><tbody>
<tr><th scope="row"><?php _e("Delete", "gd-taxonomies-tools"); ?></th>
    <td>
        <input type="checkbox" name="delete_taxonomy_db" id="delete_taxonomy_db"<?php if ($options["delete_taxonomy_db"] == 1) echo " checked"; ?> /><label style="margin-left: 5px;" for="delete_taxonomy_db"><?php _e("Delete terms from database once the taxonomy is deleted.", "gd-taxonomies-tools"); ?></label>
        <div class="gdsr-table-split"></div>
        <?php _e("If this options is not checked, after deleting taxonomy all it's terms will remain in the database.", "gd-taxonomies-tools"); ?>
    </td>
</tr>
</tbody></table>
