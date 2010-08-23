<?php

class gdttTermsCloud extends gdtt_Widget {
    var $folder_name = "gdtt-terms-cloud";
    var $defaults = array(
        "title" => "Terms Cloud",
        "taxonomy" => "post_tag",
        "number" => 45,
        "unit" => "pt",
        "smallest" => 8,
        "largest" => 22,
        "orderby" => "name",
        "order" => "asc",
        "hide_empty" => 1,
        "exclude" => "",
        "display_css" => ""
    );

    function gdttTermsCloud() {
        $widget_ops = array('classname' => 'widget_gdtt_termscloud',
            'description' => __("Display cloud with taxonomy terms.", "gd-taxonomies-tools"));
        $control_ops = array('width' => 400);
        $this->WP_Widget('gdtttermscloud', 'gdTT Terms Cloud', $widget_ops, $control_ops);
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['taxonomy'] = strip_tags(stripslashes($new_instance['taxonomy']));
        $instance['number'] = intval(strip_tags(stripslashes($new_instance['number'])));
        $instance['smallest'] = intval(strip_tags(stripslashes($new_instance['smallest'])));
        $instance['largest'] = intval(strip_tags(stripslashes($new_instance['largest'])));
        $instance['orderby'] = strip_tags(stripslashes($new_instance['orderby']));
        $instance['order'] = strip_tags(stripslashes($new_instance['order']));
        $instance['exclude'] = strip_tags(stripslashes($new_instance['exclude']));
        $instance['hide_empty'] = isset($new_instance['hide_empty']) ? 1 : 0;
        $instance['display_css'] = strip_tags(stripslashes($new_instance['display_css']));

        return $instance;
    }

    function results($instance) {
        $instance["echo"] = false;
        $args = array();
        foreach ($instance as $name => $value) {
            if ($name != "title" && $name != "display_css") $args[] = $name."=".$value;
        }
        return wp_tag_cloud(join("&", $args));
    }

    function render($results, $instance) {
        $render = '<div class="gdtt-widget gdtt-terms-cloud '.$instance["display_css"].'">';
        $render.= $results;
        $render.= '</div>';
        return $render;
    }
}

?>