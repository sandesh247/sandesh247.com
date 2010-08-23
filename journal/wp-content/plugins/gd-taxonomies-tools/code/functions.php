<?php

function gdtt_render_taxonomies($tax = "") {
    global $wp_taxonomies;
    foreach ($wp_taxonomies as $taxonomy => $cnt) {
        $current = $tax == $taxonomy ? ' selected="selected"' : $current = '';
        echo "\t<option value='".$taxonomy."'".$current.">".$cnt->label."</option>\r\n";
    }
}

function gdtt_render_alert($title, $content) {
    ?>
    <div class="ui-widget">
        <div class="ui-state-error ui-corner-all" style="padding: 0pt 0.7em; margin: 10px 0;">
            <p>
                <span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-alert"></span>
                <strong><?php echo $title; ?>:</strong> <?php echo $content; ?>
            </p>
        </div>
    </div>
    <?php
}

function gdtt_render_notice($title, $content) {
    ?>
    <div class="ui-widget">
        <div class="ui-state-highlight ui-corner-all" style="padding: 0pt 0.7em; margin: 10px 0;">
            <p>
                <span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>
                <strong><?php echo $title; ?>:</strong> <?php echo $content; ?>
            </p>
        </div>
    </div>
    <?php
}

?>