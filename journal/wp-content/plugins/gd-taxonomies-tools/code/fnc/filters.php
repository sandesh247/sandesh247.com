<?php

/**
 * Filter posts using taxonomy terms.
 *
 * @param array $terms terms to search for in different taxonomies
 * @param string what type of result to generate: count, id, post
 * @return array results mixed
 */
function gdtt_posts_term_filter($terms = array(), $result = "count") {
    $posts = array();

    foreach ($terms as $tax => $term) {
        $t = gdttDB::get_posts_for_term_by($term["by"], $tax, $term["terms"], "ID");

        if (count($t) == 0) return array();
        if (count($posts) > 0) {
            $posts = array_intersect($posts, $t);
            if (count($posts) == 0) return array();
        } else $posts = $t;
    }
    if ($result == "count") return count($posts);
    if ($result == "id") return $posts;
}

?>