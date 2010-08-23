<?php

class gdttWalker_Terms extends Walker_Category {
    function start_el(&$output, $term, $depth, $args) {
        extract($args);

        $term_name = esc_attr( $term->name);
        $term_name = apply_filters( 'list_term_name', $term_name, $term );
        $link = '<a href="' . get_term_link( $term, $term->taxonomy ) . '" ';
        if ( !empty($link_class))
            $link .= 'class="' . $link_class . '" ';
        if ( $use_desc_for_title == 0 || empty($term->description) )
            $link .= 'title="' . sprintf(__( 'View all posts filed under %s' ), $term_name) . '"';
        else
            $link .= 'title="' . esc_attr( strip_tags( apply_filters( $taxonomy.'_description', $term->description, $term ) ) ) . '"';
        $link .= '>';
        $link .= $term_name . '</a>';

        if ( (! empty($feed_image)) || (! empty($feed)) ) {
            $link .= ' ';

            if ( empty($feed_image) ) $link .= '(';

            $link .= '<a href="' . get_term_feed_link( $term->term_id, $term->taxonomy, $feed_type ) . '"';

            if ( empty($feed) )
                $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $term_name ) . '"';
            else {
                $title = ' title="' . $feed . '"';
                $alt = ' alt="' . $feed . '"';
                $name = $feed;
                $link .= $title;
            }

            $link .= '>';

            if ( empty($feed_image) ) $link .= $name;
            else $link .= "<img src='$feed_image'$alt$title" . ' />';
            $link .= '</a>';
            if ( empty($feed_image) ) $link .= ')';
        }

        if ( isset($show_count) && $show_count ) $link .= ' (' . intval($term->count) . ')';

        if ( isset($show_date) && $show_date ) {
            $link .= ' ' . gmdate('Y-m-d', $term->last_update_timestamp);
        }

        if ( 'list' == $args['style'] ) {
            $output .= "\t<li";
            $class = $taxonomy.'-item '.$taxonomy.'-item-'.$term->term_id.' '.$li_class;
            $output .=  ' class="'.trim($class).'"';
            $output .= ">$link\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }
}

class gdttWalker_TermsDropdown extends Walker_CategoryDropdown {
    function start_el(&$output, $term, $depth, $args) {
        $pad = str_repeat('&nbsp;', $depth * 3);

        $term_name = apply_filters('list_term_name', $term->name, $term);
        $term_url = get_term_link($term, $args["taxonomy"]);
        $output .= "\t<option class=\"level-$depth\" value=\"".$term_url."\"";
        if ( $term->term_id == $args['selected'] ) $output .= ' selected="selected"';
        $output .= '>';
        $output .= $pad.$term_name;
        if ( $args['show_count'] ) $output .= '&nbsp;&nbsp;('. $term->count .')';
        if ( $args['show_last_update'] ) {
            $format = 'Y-m-d';
            $output .= '&nbsp;&nbsp;' . gmdate($format, $term->last_update_timestamp);
        }
        $output .= "</option>\n";
    }
}

/**
* Display or retrieve the HTML dropdown list of terms for any taxonomy.
*
* @param string|array $args Optional. Override default arguments.
* @return string HTML content only if 'echo' argument is 0.
*/
function gdtt_dropdown_taxonomy_terms( $args = array() ) {
    $defaults = array(
        'show_option_all' => '', 'show_option_none' => '',
        'orderby' => 'id', 'order' => 'ASC',
        'show_last_update' => 0, 'show_count' => 0,
        'hide_empty' => 1, 'child_of' => 0,
        'exclude' => '', 'echo' => 1,
        'selected' => 0, 'hierarchical' => 0,
        'name' => 'cat', 'id' => '',
        'class' => 'postform', 'depth' => 0,
        'tab_index' => 0, 'taxonomy' => 'category',
        'hide_if_empty' => false
    );

    $r = wp_parse_args( $args, $defaults );

    if ( !isset( $r['pad_counts'] ) && $r['show_count'] && $r['hierarchical'] ) {
        $r['pad_counts'] = true;
    }

    $r['include_last_update_time'] = $r['show_last_update'];
    extract( $r );

    $tab_index_attribute = '';
    if ( (int) $tab_index > 0 ) $tab_index_attribute = " tabindex=\"$tab_index\"";

    $terms = get_terms( $taxonomy, $r );
    $name = esc_attr( $name );
    $class = esc_attr( $class );
    $id = $id ? esc_attr( $id ) : $name;

    if ( ! $r['hide_if_empty'] || ! empty($terms) ) {
        $output = "<select name='$name' id='$id' class='$class' $tab_index_attribute>\n";
    } else {
        $output = '';
    }

    if ( empty($terms) && ! $r['hide_if_empty'] && !empty($show_option_none) ) {
        $show_option_none = apply_filters( 'list_cats', $show_option_none );
        $output .= "\t<option value='-1' selected='selected'>$show_option_none</option>\n";
    }

    if ( ! empty( $terms ) ) {
        if ( $show_option_all ) {
            $show_option_all = apply_filters( 'list_cats', $show_option_all );
            $selected = ( '0' === strval($r['selected']) ) ? " selected='selected'" : '';
            $output .= "\t<option value='0'$selected>$show_option_all</option>\n";
        }

        if ( $show_option_none ) {
            $show_option_none = apply_filters( 'list_cats', $show_option_none );
            $selected = ( '-1' === strval($r['selected']) ) ? " selected='selected'" : '';
            $output .= "\t<option value='-1'$selected>$show_option_none</option>\n";
        }

        if ( $hierarchical ) $depth = $r['depth'];
        else $depth = -1;

        $r["walker"] = new gdttWalker_TermsDropdown();
        $output .= walk_category_dropdown_tree( $terms, $depth, $r );
    }

    if ( !$r['hide_if_empty'] || ! empty($terms) ) $output .= "</select>\n";
    $output = apply_filters( 'wp_dropdown_terms_'.$taxonomy, $output );
    if ( $echo ) echo $output;
    return $output;
}

/**
* Display or retrieve the HTML list of terms for any taxonomy.
*
* @param string|array $args Optional. Override default arguments.
* @return string HTML content only if 'echo' argument is 0.
*/
function gdtt_list_taxonomy_terms( $args = array() ) {
    $defaults = array(
        'show_option_all' => '', 'show_option_none' => __("No categories", "gd-taxonomies-tools"),
        'orderby' => 'name', 'order' => 'ASC',
        'show_last_update' => 0, 'style' => 'list',
        'show_count' => 0, 'hide_empty' => 1,
        'use_desc_for_title' => 1, 'child_of' => 0,
        'feed' => '', 'feed_type' => '', 'link_class' => '',
        'feed_image' => '', 'exclude' => '', 'li_class' => '',
        'exclude_tree' => '', 'current_category' => 0,
        'hierarchical' => true, 'title_li' => '',
        'echo' => 1, 'depth' => 0, 'taxonomy' => 'category'
    );

    $r = wp_parse_args( $args, $defaults );

    if ( !isset( $r['pad_counts'] ) && $r['show_count'] && $r['hierarchical'] ) {
        $r['pad_counts'] = true;
    }

    if ( isset( $r['show_date'] ) ) {
        $r['include_last_update_time'] = $r['show_date'];
    }

    if ( true == $r['hierarchical'] ) {
        $r['exclude_tree'] = $r['exclude'];
        $r['exclude'] = '';
    }

    if ( !isset( $r['class'] ) ) {
        $r['class'] = ( 'category' == $r['taxonomy'] ) ? 'categories' : $r['taxonomy'];
    }

    extract( $r );
    
    $terms = get_terms( $taxonomy, $r );

    $output = '';
    if ( $title_li && 'list' == $style ) {
        $output = '<li class="' . $class . '">' . $title_li . '<ul>';
    }

    if ( empty( $terms ) ) {
        if ( ! empty( $show_option_none ) ) {
            if ( 'list' == $style ) $output .= '<li>' . $show_option_none . '</li>';
            else $output .= $show_option_none;
        }
    } else {
        global $wp_query;

        if( !empty( $show_option_all ) )
            if ( 'list' == $style )
                $output .= '<li><a href="' .  get_bloginfo( 'url' )  . '">' . $show_option_all . '</a></li>';
            else
                $output .= '<a href="' .  get_bloginfo( 'url' )  . '">' . $show_option_all . '</a>';

        if ( empty( $r['current_category'] ) && ( is_category() || is_tax() ) )
            $r['current_category'] = $wp_query->get_queried_object_id();

        if ( $hierarchical ) $depth = $r['depth'];
        else $depth = -1;

        $r["walker"] = new gdttWalker_Terms();
        $output .= walk_category_tree( $terms, $depth, $r );
    }

    if ( $title_li && 'list' == $style ) $output .= '</ul></li>';

    $output = apply_filters( 'wp_list_terms_'.$taxonomy, $output );
    if ( $echo ) echo $output;
    else return $output;
}

?>