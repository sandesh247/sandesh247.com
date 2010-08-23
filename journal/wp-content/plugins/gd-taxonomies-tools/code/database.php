<?php

class gdttDB {
    function get_posts_for_term_by($element, $taxonomy, $term, $result = "post") {
        global $wpdb;

        $select = $result == "post" ? "p.*" : "tr.object_id as ID";
        $join = $result == "post" ? " inner join ".$wpdb->posts." p on p.ID = tr.object_id" : "";
        $terms = is_array($term) ? "'".join("', '", $term)."'" : "'".$term."'";

        $sql = sprintf("select %s from %s tr inner join %s tt on tt.term_taxonomy_id = tr.term_taxonomy_id inner join %s t on t.term_id = tt.term_id where t.%s in (%s) and tt.taxonomy = '%s'",
            $select, $wpdb->term_relationships, $wpdb->term_taxonomy, $wpdb->terms, $element, $terms, $taxonomy);
        $r = $wpdb->get_results($sql);
        if ($result == "post") return $r;
        $posts = array();
        foreach ($r as $o) $posts[] = $o->ID;
        return $posts;
    }

    function get_post_types_counts() {
        global $wpdb;

        $sql = sprintf("select post_type, count(*) as items from %sposts group by post_type", $wpdb->prefix);
        $raw = $wpdb->get_results($sql);
        $res = array();
        foreach ($raw as $r) {
            $res[$r->post_type] = $r->items;
        }
        return $res;
    }

    function delete_taxonomy_terms($tax) {
        global $wpdb;

        $sql = sprintf("delete %s from %sterm_taxonomy tt left join %sterm_relationships tr  on tt.term_taxonomy_id = tr.term_taxonomy_id where tt.taxonomy = '%s'", 
            gdFunctionsGDTT::mysql_pre_4_1() ? sprintf("%sterm_taxonomy, %sterm_relationships", $wpdb->prefix, $wpdb->prefix) : "tt, tr", $table_prefix, $table_prefix, $tax);
        $wpdb->query($sql);
    }
}

?>