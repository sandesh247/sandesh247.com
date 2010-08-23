<?php

class gdtt_Widget extends WP_Widget {
    var $folder_name = "";
    var $defaults = array();
    var $widget_id;

    function gdtt_Widget() { }

    function widget($args, $instance) {
        global $gdsr, $userdata;
        extract($args, EXTR_SKIP);
        $this->widget_id = str_replace("-", "", $args["widget_id"]);
        $this->widget_id = str_replace("_", "", $this->widget_id);

        $results = $this->results($instance);
        if (count($results) == 0 && $instance["hide_empty"] == 1) return;

        echo $before_widget.$before_title.$instance["title"].$after_title;
        echo $this->render($results, $instance);
        echo $after_widget;
    }

    function simple_render($instance = array()) {
        $instance = shortcode_atts($this->defaults, $instance);
        $results = $this->results($instance);
        return $this->render($results, $instance);
    }

    function form($instance) {
        $instance = wp_parse_args((array)$instance, $this->defaults);

        include(GDTAXTOOLS_PATH.'widgets/'.$this->folder_name.'/basic.php');
        include(GDTAXTOOLS_PATH.'widgets/'.$this->folder_name.'/filter.php');
        include(GDTAXTOOLS_PATH.'widgets/'.$this->folder_name.'/display.php');
    }

    function prepare($instance, $results) {
        if (count($results) == 0) return array();
        return $results;
    }

    function update($new_instance, $old_instance) { }

    function results($instance) { }

    function render($results, $instance) { }
}

?>