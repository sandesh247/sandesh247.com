<?php

/**
 * Return only public custom post types, with or without defaults.
 *
 * @param bool $with_defaults true to include default types, false to exnclude them
 * @return array list of custom post types
 */
function gdtt_get_public_post_types($with_defaults = false) {
    $options = array("public" => true);
    if (!$with_defaults) $options["_builtin"] = false;
    return get_post_types($options, "objects");
}

/**
 * Update taxonomies cache for the custom post types for the current query.
 */
function gdtt_custom_post_types_cache() {
    global $wp_query;

    $post_ids = array();
    for ($i = 0; $i < count($wp_query->posts); $i++) {
        $post_ids[] = $wp_query->posts[$i]->ID;
    }

    if (!empty($post_ids)) {
        update_object_term_cache($post_ids, get_query_var("post_type"));
    }
}

/**
 * Get list of taxonomies for any post type.
 *
 * @param string|array $post_types one or more post types to match
 * @return array list of taxonomies
 */
function gdtt_get_taxonomies_for_post_types($post_types = array()) {
    global $wp_taxonomies;
    $taxonomies = array();
    if (is_string($post_types)) $post_types = (array)$post_types;
    foreach ((array)$wp_taxonomies as $taxonomy) {
        if (array_intersect($post_types, (array)$taxonomy->object_type)) {
            $taxonomies[] = $taxonomy->name;
        }
    }
    return $taxonomies;
}

/**
 * Get the taxonomy on the taxonomy term page.
 *
 * @return object Taxonomy or null if not on taxonomy term page
 */
function gdtt_get_taxonomy() {
    if (!is_tax()) return null;
    return get_taxonomy(get_query_var('taxonomy'));
}

/**
 * Get the term on the taxonomy term page.
 *
 * @return object Term or null if not on taxonomy term page
 */
function gdtt_get_term() {
    if (!is_tax()) return null;
    return get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
}

/**
 * Get title for the term.
 *
 * @param bool $with_tax Inlcude taxonomy label as prefix
 * @return string Term title
 */
function gdtt_get_term_title($with_tax = false) {
    if (!is_tax()) return "";
    $term = gdtt_get_term();
    if ($with_tax) {
        $tax = gdtt_get_taxonomy();
        return $tax->label.": ".$term->name;
    } else return $term->name;
}

/**
 * Get description for the term.
 *
 * @return string Term description
 */
function gdtt_get_term_description() {
    if (!is_tax()) return "";
    $term = gdtt_get_term();
    return $term->description;
}

/**
 * Display term title.
 */
function gdtt_term_title() {
    echo gdtt_get_term_title();
}

/**
 * Display term description.
 */
function gdtt_term_description() {
    echo gdtt_get_term_description();
}

?>