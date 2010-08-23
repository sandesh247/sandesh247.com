<?php

class gdttTermsList extends gdtt_Widget {
    var $folder_name = "gdtt-terms-list";
    var $defaults = array(
        "title" => "Terms List",
        "taxonomy" => "post_tag",
        "number" => 10,
        "orderby" => "name",
        "order" => "asc",
        "hide_empty" => 1,
        "exclude" => "",
        "display_render" => "list",
        "show_option_none" => "Select Term",
        "display_count" => 1,
        "display_css" => ""
    );

    function gdttTermsList() {
        $widget_ops = array('classname' => 'widget_gdtt_termslist',
            'description' => __("Display list with taxonomy terms.", "gd-taxonomies-tools"));
        $control_ops = array('width' => 400);
        $this->WP_Widget('gdtttermslist', 'gdTT Terms List', $widget_ops, $control_ops);
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title'] = strip_tags(stripslashes($new_instance['title']));
        $instance['taxonomy'] = strip_tags(stripslashes($new_instance['taxonomy']));
        $instance['number'] = intval(strip_tags(stripslashes($new_instance['number'])));
        $instance['orderby'] = strip_tags(stripslashes($new_instance['orderby']));
        $instance['order'] = strip_tags(stripslashes($new_instance['order']));
        $instance['exclude'] = strip_tags(stripslashes($new_instance['exclude']));
        $instance['hide_empty'] = isset($new_instance['hide_empty']) ? 1 : 0;
        $instance['display_render'] = strip_tags(stripslashes($new_instance['display_render']));
        $instance['show_option_none'] = strip_tags(stripslashes($new_instance['show_option_none']));
        $instance['display_count'] = isset($new_instance['display_count']) ? 1 : 0;
        $instance['display_css'] = strip_tags(stripslashes($new_instance['display_css']));

        return $instance;
    }

    function results($instance) {
        $instance["echo"] = 0;
        $args = array();
        foreach ($instance as $name => $value) {
            if ($name != "title" && 
                $name != "display_count" &&
                $name != "display_render" &&
                $name != "display_css") {
                    $args[$name] = $value;
            }
        }

        $args["show_count"] = $instance["display_count"];
        if ($instance['display_render'] == "drop") {
            $args["name"] = "gdtt-drop-".$this->widget_id;
            return gdtt_dropdown_taxonomy_terms($args);
        } else {
            $args["link_class"] = "gdtt-url";
            return gdtt_list_taxonomy_terms($args);
        }
    }

    function add_js_code($id, $js_var) {
        $x = '<script type="text/javascript">'.GDTAXTOOLS_EOL;
        $x.= '/* <![CDATA[ */'.GDTAXTOOLS_EOL;
        $x.= 'var '.$js_var.' = document.getElementById("'.$id.'");'.GDTAXTOOLS_EOL;
        $x.= 'function onChange_'.$js_var.'() {'.GDTAXTOOLS_EOL;
        $x.= 'if ( '.$js_var.'.options['.$js_var.'.selectedIndex].value != "" ) {'.GDTAXTOOLS_EOL;
        $x.= 'location.href = '.$js_var.'.options['.$js_var.'.selectedIndex].value;'.GDTAXTOOLS_EOL;
        $x.= '}'.GDTAXTOOLS_EOL;
        $x.= '}'.GDTAXTOOLS_EOL;
        $x.= $js_var.'.onchange = onChange_'.$js_var.';'.GDTAXTOOLS_EOL;
        $x.= '/* ]]> */'.GDTAXTOOLS_EOL;
        $x.= '</script>'.GDTAXTOOLS_EOL;
        return $x;
    }

    function render($results, $instance) {
        if (is_wp_error($results)) return "";
        $render = "";
        if ($instance['display_render'] == "drop") {
            $render.= '<div class="gdtt-widget gdtt-terms-dropdown '.$instance["display_css"].'">';
            $render.= $results;
            $render.= '</div>';
            $render.= $this->add_js_code("gdtt-drop-".$this->widget_id, "gdtt_drop_".$this->widget_id);
        } else {
            $render.= '<div class="gdtt-widget gdtt-terms-list '.$instance["display_css"].'"><ul>';
            $render.= $results;
            $render.= '</ul></div>';
        }
        return $render;
    }
}

?>