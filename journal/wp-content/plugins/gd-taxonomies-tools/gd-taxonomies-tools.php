<?php

/*
Plugin Name: GD Custom Posts And Taxonomies Tools
Plugin URI: http://www.dev4press.com/gd-taxonomies-tools/
Description: GD Custom Posts And Taxonomies Tools is plugin for management and tools collection for working with custom posts and taxonomies.
Version: 1.2.5
Author: Milan Petrovic
Author URI: http://www.dev4press.com/

== Copyright ==

Copyright 2008-2010 Milan Petrovic (email: milan@gdragon.info)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$gdtt_dirname_basic = dirname(__FILE__);

require_once($gdtt_dirname_basic."/config.php");
require_once($gdtt_dirname_basic."/code/defaults.php");
require_once($gdtt_dirname_basic."/code/functions.php");
require_once($gdtt_dirname_basic."/code/database.php");
require_once($gdtt_dirname_basic."/code/classes.php");
require_once($gdtt_dirname_basic."/code/widget.php");
require_once($gdtt_dirname_basic."/gdragon/gd_debug.php");
require_once($gdtt_dirname_basic."/gdragon/gd_functions.php");
require_once($gdtt_dirname_basic."/gdragon/gd_wordpress.php");
require_once($gdtt_dirname_basic."/widgets/gdtt-terms-cloud.php");
require_once($gdtt_dirname_basic."/widgets/gdtt-terms-list.php");

if (!class_exists('GDTaxonomiesTools')) {
    class GDTaxonomiesTools {
        var $plugin_url;
        var $plugin_path;
        var $wp_version;
        var $admin_plugin;
        var $admin_plugin_page;
        var $script;
        var $taxes;
        var $posts;
        var $errors;
        var $edit_tax;
        var $edit_cpt;
        var $o;
        var $t;
        var $p;
        var $l;

        var $on_tinymce_main = false;

        var $default_options;
        var $default_taxonomies;

        function GDTaxonomiesTools() {
            $gdd = new GDTTDefaults();
            $this->default_options = $gdd->default_options;
            $this->default_taxonomies = $gdd->default_taxonomies;
            define('GDTAXONOMIESTOOLS_INSTALLED', $this->default_options["version"]." ".$this->default_options["status"]);

            $this->plugin_path_url();
            $this->install_plugin();
            $this->features_testing();
            $this->actions_filters();
        }

        function features_testing() {
            $this->on_tinymce_main = file_exists($this->plugin_path.'tinymce3/gdtt_main/');
        }

        function get($setting) {
            return $this->o[$setting];
        }

        function upgrade_notice() {
            if ($this->o["upgrade_to_pro"] == 1) {
                $no_thanks = add_query_arg("proupgrade", "hide");
                echo '<div class="updated">';
                _e("Thank you for using this plugin. Please, take a few minutes and check out the Pro version of this plugin and new and improved features, including premium support.", "gd-taxonomies-tools");
                echo ' <a href="http://www.dev4press.com/plugins/gd-taxonomies-tools/editions/" target="_blank">'.__("GD Custom Posts And Taxonomies Tools Pro plugin Editions", "gd-taxonomies-tools")."</a>";
                echo '. <a href="'.$no_thanks.'">'.__("Don't display this message anymore", "gd-taxonomies-tools")."</a>.";
                echo '</div>';
            }
        }

        function install_plugin() {
            global $wp_version;
            $this->wp_version = substr(str_replace('.', '', $wp_version), 0, 2);

            $this->o = get_option('gd-taxonomy-tools');
            $this->t = get_option('gd-taxonomy-tools-tax');
            $this->p = get_option('gd-taxonomy-tools-cpt');

            if (!is_array($this->o)) {
                update_option('gd-taxonomy-tools', $this->default_options);
                $this->o = get_option('gd-taxonomy-tools');
            } else if ($this->o["build"] != $this->default_options["build"] ||
                $this->o["edition"] != $this->default_options["edition"]) {
                $this->o = gdFunctionsGDTT::upgrade_settings($this->o, $this->default_options);

                $this->o["version"] = $this->default_options["version"];
                $this->o["date"] = $this->default_options["date"];
                $this->o["status"] = $this->default_options["status"];
                $this->o["build"] = $this->default_options["build"];
                $this->o["edition"] = $this->default_options["edition"];

                update_option('gd-taxonomy-tools', $this->o);
            }

            if (!is_array($this->t)) {
                $this->t = array();

                update_option('gd-taxonomy-tools-tax', $this->t);
            }

            if (!is_array($this->p)) {
                $this->p = array();

                update_option('gd-taxonomy-tools-cpt', $this->p);
            }

            $this->taxes = array();
            $this->posts = array();
            foreach ($this->t as $tx) {
                $this->taxes[] = $tx["name"];
            }
            foreach ($this->p as $pt) {
                $this->posts[] = $pt["name"];
            }

            $this->script = $_SERVER["PHP_SELF"];
            $this->script = end(explode("/", $this->script));
        }

        function plugin_path_url() {
            $this->plugin_url = plugins_url('/gd-taxonomies-tools/');
            $this->plugin_path = dirname(__FILE__)."/";

            define('GDTAXTOOLS_URL', $this->plugin_url);
            define('GDTAXTOOLS_PATH', $this->plugin_path);
        }

        function get_defaults_count() {
            return $this->default_taxonomies["wp".$this->wp_version];
        }

        function actions_filters() {
            add_action('init', array(&$this, 'init'));
            add_action('init', array(&$this, 'register_taxonomies'), 2);
            if ($this->wp_version >= 30) {
                add_action('init', array(&$this, 'register_custom_posts'), 1);
            }

            add_action('admin_init', array(&$this, 'admin_init'));
            add_action('admin_menu', array(&$this, 'admin_menu'));
            add_action('admin_head', array(&$this, 'admin_head'));
            add_action('widgets_init', array(&$this, 'widgets_init'));

            add_filter('plugin_row_meta', array(&$this, 'plugin_links'),10, 2);
            add_filter('plugin_action_links', array(&$this, 'plugin_actions'), 10, 2);
            add_action('after_plugin_row', array(&$this,'plugin_check_version'), 10, 2);
        }

        function widgets_init() {
            register_widget("gdttTermsCloud");
            register_widget("gdttTermsList");
        }

	function plugin_links($links, $file) {
            static $this_plugin;
            if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
            if ($file == $this_plugin){
                $links[] = '<a href="admin.php?page=gdtaxtools_taxs">'.__("Custom Taxonomies", "gd-taxonomies-tools").'</a>';
                if ($this->wp_version >= 30) {
                    $links[] = '<a href="admin.php?page=agdtaxtools_postypes">'.__("Custom Post Types", "gd-taxonomies-tools").'</a>';
                }
                $links[] = '<a href="http://www.dev4press.com/plugins/gd-taxonomies-tools/faq/">'.__("FAQ", "gd-taxonomies-tools").'</a>';
                $links[] = '<a target="_blank" style="color: #cc0000; font-weight: bold;" href="http://dv4p.com/gdtt">'.__("Upgrade to PRO", "gd-taxonomies-tools").'</a>';
            }
            return $links;
	}

        function plugin_actions($links, $file) {
            static $this_plugin;
            if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);

            if ($file == $this_plugin){
                $settings_link = '<a href="admin.php?page=gdtaxtools_settings">' . __("Settings", "gd-taxonomies-tools") . '</a>';
                array_unshift($links, $settings_link);
            }
            return $links;
        }

        function plugin_check_version($file, $plugin_data) {
            static $this_plugin;
            if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);

            if ($file == $this_plugin){
                $current = get_transient('update_plugins');
                if (!isset($current->response[$file])) return false;

                $url = gdFunctionsGDTT::get_update_url($this->o, get_option('home'));
                $update = wp_remote_fopen($url);
                if ($update != "") {
                    echo '<td colspan="3" class="gdr-plugin-update"><div class="gdr-plugin-update-message">';
                    echo $update;
                    echo '</div></td>';
                }
            }
        }

        function init() {
            $this->l = get_locale();
            if(!empty($this->l)) {
                $moFile = dirname(__FILE__)."/languages/gd-taxonomies-tools-".$this->l.".mo";
                if (@file_exists($moFile) && is_readable($moFile)) load_textdomain('gd-taxonomies-tools', $moFile);
            }

            if ($this->o["force_rules_flush"] == 1) {
                global $wp_rewrite;
                $wp_rewrite->flush_rules();

                $this->o["force_rules_flush"] = 0;
                update_option('gd-taxonomy-tools', $this->o);
            }
        }

        function register_custom_posts() {
            foreach ($this->p as $cpt) {
                $cpt["description"] = !isset($cpt["description"]) ? "" : $cpt["description"];
                $cpt["rewrite_slug"] = !isset($cpt["rewrite_slug"]) ? "" : $cpt["rewrite_slug"];

                $rewrite = $cpt["rewrite"] == "yes";
                if ($cpt["rewrite_slug"] != "") {
                    $rewrite = array(
                        "slug" => $cpt["rewrite_slug"],
                        "with_front" => $cpt["rewrite_front"] == "yes");
                }

                if (!isset($cpt["labels"])) {
                    $labels = array("name" => $cpt["label"],
                        "singular_name" => $cpt["label_singular"]);
                } else {
                    $labels = $cpt["labels"];
                }
                if (!isset($cpt["caps"])) {
                    $caps = array();
                } else {
                    $caps = $cpt["caps"];
                }

                $cpt["public"] = $cpt["public"] == "yes";
                $cpt["ui"] = !isset($cpt["ui"]) ? $cpt["public"] : $cpt["ui"] == "yes";
                $cpt["nav_menus"] = !isset($cpt["nav_menus"]) ? $cpt["public"] : $cpt["nav_menus"] == "yes";
                $cpt["can_export"] = !isset($cpt["can_export"]) ? $cpt["public"] : $cpt["can_export"] == "yes";
                $cpt["publicly_queryable"] = !isset($cpt["publicly_queryable"]) ? $cpt["public"] : $cpt["publicly_queryable"] == "yes";
                $cpt["exclude_from_search"] = !isset($cpt["exclude_from_search"]) ? !$cpt["public"] : $cpt["exclude_from_search"] == "yes";

                $options = array(
                    "labels" => $labels,
                    "capabilities" => $caps,
                    "description" => $cpt["description"],
                    "supports" => (array)$cpt["supports"],
                    "taxonomies" => (array)$cpt["taxonomies"],
                    "hierarchical" => $cpt["hierarchy"] == "yes",
                    "public" => $cpt["public"],
                    "show_ui" => $cpt["ui"],
                    "can_export" => $cpt["can_export"],
                    "publicly_queryable" => $cpt["publicly_queryable"],
                    "exclude_from_search" => $cpt["exclude_from_search"],
                    "show_in_nav_menus" => $cpt["nav_menus"],
                    "rewrite" => $rewrite,
                    "query_var" => $cpt["query"] == "yes",
                    "_edit_link" => $cpt["edit_link"]
                    );
                register_post_type($cpt["name"], $options);
            }
        }

        function register_taxonomies() {
            foreach ($this->t as $tax) {
                if (isset($tax["active"])) {
                    if ($this->wp_version < 30) {
                        $options = array(
                            "hierarchical" => $tax["hierarchy"] == "yes",
                            "label" => $tax["label"]
                        );
                        if ($tax["rewrite"] == "yes_custom") $options["rewrite"] = $tax["rewrite_custom"];
                        else $options["rewrite"] = $tax["rewrite"] == "yes_name";
                        if ($tax["query"] == "yes_custom") $options["query_var"] = $tax["query_custom"];
                        else $options["query_var"] = $tax["query"] == "yes_name";

                        register_taxonomy($tax["name"], "post", $options);
                    } else {
                        $rewrite = $query_var = true;
                        if ($tax["rewrite"] == "no") $rewrite = false;
                        if ($tax["rewrite"] == "yes_custom") $rewrite = array('slug' => $tax["rewrite_custom"]);
                        if ($tax["query"] == "no") $query_var = false;
                        if ($tax["query"] == "yes_custom") $query_var = $tax["query_custom"];
                        $tax["public"] = !isset($tax["public"]) ? true : $tax["public"];
                        $tax["ui"] = !isset($tax["ui"]) ? $tax["public"] : $tax["ui"] == "yes";
                        $tax["nav_menus"] = !isset($tax["nav_menus"]) ? $tax["public"] : $tax["nav_menus"] == "yes";
                        $tax["cloud"] = !isset($tax["cloud"]) ? $tax["public"] : $tax["cloud"] == "yes";
                        if (!isset($tax["labels"])) {
                            $labels = array("name" => $tax["label"],
                                "singular_name" => $tax["label_singular"]);
                        } else {
                            $labels = $tax["labels"];
                            $labels["parent_item_colon"] = $labels["parent_item"].":";
                        }
                        if (!isset($tax["caps"])) {
                            $caps = array();
                        } else {
                            $caps = $tax["caps"];
                        }

                        $options = array(
                            "labels" => $labels,
                            "capabilities" => $caps,
                            "rewrite" => $rewrite,
                            "query_var" => $query_var,
                            "public" => $tax["public"],
                            "show_ui" => $tax["ui"],
                            "show_tagcloud" => $tax["cloud"],
                            "show_in_nav_menus" => $tax["nav_menus"],
                            "hierarchical" => $tax["hierarchy"] == "yes",
                        );

                        $domains = explode(",", $tax["domain"]);
                        register_taxonomy($tax["name"], $domains, $options);
                    }
                }
            }
        }

        function is_term_valid($term, $check_empty = false) {
            if (trim($term) == "" && $check_empty) return false;
            return strtolower($term) == sanitize_title_with_dashes($term);
        }

        function is_taxonomy_valid($tax_name) {
            global $wp_taxonomies;
            $tax_names = array_keys($wp_taxonomies);
            return !in_array(strtolower($tax_name), $tax_names);
        }

        function find_taxonomy($id) {
            $found = array();
            for ($i = 0; $i < count($this->t); $i++) {
                if ($this->t[$i]["id"] == $id) {
                    $found = $this->t[$i];
                    break;
                }
            }

            return $found;
        }

        function find_postype($id) {
            $found = array();
            for ($i = 0; $i < count($this->p); $i++) {
                if ($this->p[$i]["id"] == $id) {
                    $found = $this->p[$i];
                    break;
                }
            }

            return $found;
        }

        function prepare_inactive() {
            $found = array();
            foreach ($this->t as $tax) if (!isset($tax["active"])) $found[$tax["name"]] = new gdtt_Taxonomy($tax);
            return $found;
        }

        function find_custompost_pos($id) {
            $found = -1;
            for ($i = 0; $i < count($this->p); $i++) {
                if ($this->p[$i]["id"] == $id) {
                    $found = $i;
                    break;
                }
            }

            return $found;
        }

        function find_taxonomy_pos($id) {
            $found = -1;
            for ($i = 0; $i < count($this->t); $i++) {
                if ($this->t[$i]["id"] == $id) {
                    $found = $i;
                    break;
                }
            }

            return $found;
        }

        function admin_init() {
            if (isset($_GET["page"])) {
                if (substr($_GET["page"], 0, 10) == "gdtaxtools" || $_GET["page"] == "gd-taxonomies-tools/gd-taxonomies-tools.php") {
                    $this->admin_plugin = true;
                    $this->admin_plugin_page = substr($_GET["page"], 11);
                }
            }

            if ($this->admin_plugin) {
                wp_enqueue_script('jquery');
                wp_enqueue_script('jquery-ui-core');
                wp_enqueue_script('jquery-ui-tabs');
                wp_enqueue_script('gdtt-utilities', $this->plugin_url.'js/utilities.js', array('jquery', 'jquery-ui-core'));
                wp_enqueue_style('gdtt-jquery-ui', $this->plugin_url.'css/jquery_ui17.css');
                if ($this->admin_plugin_page != "settings") $this->load_corrections();
            }

            $this->init_operations();
            $this->settings_operations();
            $this->init_savetax();
        }

        function init_operations() {
            if (isset($_GET["proupgrade"]) && $_GET["proupgrade"] == "hide") {
                $this->o["upgrade_to_pro"] = 0;
                update_option("gd-taxonomy-tools", $this->o);
                wp_redirect(remove_query_arg("proupgrade"));
                exit;
            }

            if (isset($_GET["action"])) {
                $action = $_GET["action"];
                $url = remove_query_arg("action");
                switch ($action) {
                    case "delcpt":
                        $id = $this->find_custompost_pos($_GET["pid"]);
                        if ($id > -1) {
                            unset($this->p[$id]);
                            $this->p = array_values($this->p);
                            update_option('gd-taxonomy-tools-cpt', $this->p);
                        }
                        $url = remove_query_arg("pid", $url);
                        wp_redirect($url);
                        exit;
                        break;
                    case "deltax":
                        $id = $this->find_taxonomy_pos($_GET["tid"]);
                        if ($id > -1) {
                            $tax_name = $this->t[$id]["name"];
                            unset($this->t[$id]);
                            $this->t = array_values($this->t);
                            update_option('gd-taxonomy-tools-tax', $this->t);
                            gdttDB::delete_taxonomy_terms($tax_name);
                        }
                        $url = remove_query_arg("tid", $url);
                        wp_redirect($url);
                        exit;
                        break;
                }
            }
        }

        function init_savetax() {
            if (isset($_POST["gdtt_savecpt"])) {
                $cpt = $_POST["cpt"];
                $this->errors = "";

                $cpt["name"] = strtolower(sanitize_user($cpt["name"], true));
                $cpt["supports"] = (array)$cpt["supports"];
                $cpt["taxonomies"] = (array)$cpt["taxonomies"];
                $cpt["rewrite_slug"] = trim(strip_tags($cpt["rewrite_slug"]));
                $cpt["description"] = trim(strip_tags($cpt["description"]));

                if (!$this->is_term_valid($cpt["name"])) $this->errors = "name";
                else {
                    if (trim($cpt["labels"]["name"]) == "") $cpt["labels"]["name"] = $cpt["name"];
                }

                if ($cpt["id"] == 0) {
                    if ($this->errors == "") {
                        $this->o["cpt_internal"]++;
                        $cpt["id"] = $this->o["cpt_internal"];
                        $this->p[] = $cpt;
                        update_option('gd-taxonomy-tools', $this->o);
                        update_option('gd-taxonomy-tools-cpt', $this->p);
                    }
                } else {
                    if ($this->errors == "") {
                        $id = $this->find_custompost_pos($cpt["id"]);
                        if ($id > -1) {
                            $this->p[$id] = $cpt;
                            update_option('gd-taxonomy-tools-cpt', $this->p);
                        }
                    }
                }

                $this->edit_cpt = $cpt;
            }

            if (isset($_POST["gdtt_savetax"])) {
                $tax = $_POST["tax"];
                $this->errors = "";

                $post_types = $tax["post_type"];
                if (!is_array($post_types) || empty($post_types)) $post_types = array("post");

                $tax["name"] = strtolower(sanitize_user($tax["name"], true));
                $tax["domain"] = join(",", $post_types);
                if (!isset($tax["rewrite_custom"])) $tax["rewrite_custom"] = "";
                if (!isset($tax["query_custom"])) $tax["query_custom"] = "";
                if (!isset($tax["hierarchy"])) $tax["hierarchy"] = "no";

                if ($this->wp_version < 30) {
                    $tax["label"] = strip_tags($tax["label"]);
                    if (trim($tax["label"]) == "") $tax["label"] = $tax["name"];
                } else {
                    if (trim($tax["labels"]["name"]) == "") $tax["labels"]["name"] = $tax["name"];
                }
                $tax["rewrite_custom"] = sanitize_title_with_dashes($tax["rewrite_custom"]);
                $tax["query_custom"] = sanitize_title_with_dashes($tax["query_custom"]);
                if (!$this->is_term_valid($tax["name"])) $this->errors = "name";
                else {
                    if (trim($tax["rewrite_custom"]) == "") $tax["rewrite_custom"] = $tax["name"];
                    if (trim($tax["query_custom"]) == "") $tax["query_custom"] = $tax["name"];
                }

                if ($tax["id"] == 0) {
                    if (!$this->is_taxonomy_valid($tax["name"])) $this->errors = "name";
                    if ($this->errors == "") {
                        $this->o["tax_internal"]++;
                        $tax["id"] = $this->o["tax_internal"];
                        $this->t[] = $tax;
                        update_option('gd-taxonomy-tools', $this->o);
                        update_option('gd-taxonomy-tools-tax', $this->t);
                    }
                } else {
                    $toedit = $this->t[$tax["id"]];
                    if (isset($tax["rename"]) && $toedit["name"] != $tax["name"]) {
                        if (!$this->is_taxonomy_valid($tax["name"])) $this->errors = "name";
                    }
                    if ($this->errors == "") {
                        $id = $this->find_taxonomy_pos($tax["id"]);
                        if ($id > -1) {
                            $this->t[$id] = $tax;
                            update_option('gd-taxonomy-tools-tax', $this->t);
                        }
                    }
                }

                $this->edit_tax = $tax;
            }
        }

        function settings_operations() {
            if (isset($_POST['gdtt_saving'])) {
                $this->o["delete_taxonomy_db"] = isset($_POST['delete_taxonomy_db']) ? 1 : 0;

                update_option("gd-taxonomy-tools", $this->o);
                wp_redirect(add_query_arg("settings", "saved"));
                exit();
            }
        }

        function admin_menu() {
            add_menu_page('GD CPT Tools', 'GD CPT Tools', 10, __FILE__, array(&$this,"admin_front"), plugins_url('gd-taxonomies-tools/gfx/menu.png'));
            add_submenu_page(__FILE__, 'GD CPT Tools: '.__("Front Page", "gd-taxonomies-tools"), __("Front Page", "gd-taxonomies-tools"), 10, __FILE__, array(&$this,"admin_front"));
            if ($this->wp_version >= 30) {
                add_submenu_page(__FILE__, 'GD CPT Tools: '.__("Post Types", "gd-taxonomies-tools"), __("Post Types", "gd-taxonomies-tools"), 10, "gdtaxtools_postypes", array(&$this, "admin_postypes"));
            }
            add_submenu_page(__FILE__, 'GD CPT Tools: '.__("Taxonomies", "gd-taxonomies-tools"), __("Taxonomies", "gd-taxonomies-tools"), 10, "gdtaxtools_taxs", array(&$this, "admin_taxs"));
            add_submenu_page(__FILE__, 'GD CPT Tools: '.__("Settings", "gd-taxonomies-tools"), __("Settings", "gd-taxonomies-tools"), 10, "gdtaxtools_settings", array(&$this, "admin_settings"));
        }

        function load_corrections() {
            wp_enqueue_script('gdtt-js-corrections', GDTAXTOOLS_URL."js/corrections.js", array(), $this->o["version"], true);
        }

        function admin_head() {
            if ($this->admin_plugin) {
                wp_admin_css('css/dashboard');
                echo('<link rel="stylesheet" href="'.$this->plugin_url.'css/admin_main.css" type="text/css" media="screen" />');
                include($this->plugin_path."/code/js.php");
            }

            if ($this->script == "widgets.php" || $this->script == "themes.php" || $this->script == "plugins.php") {
                echo('<link rel="stylesheet" href="'.$this->plugin_url.'css/admin_widgets.css" type="text/css" media="screen" />');
            }
        }

        function admin_front() {
            $options = $this->o;
            $gdtttax = $this->taxes;
            $errors = $this->errors;
            $wpv = $this->wp_version;

            include($this->plugin_path.'forms/shared/front.header.php');
            include($this->plugin_path.'forms/admin/front.php');
            include($this->plugin_path.'forms/shared/all.footer.php');
        }

        function admin_settings() {
            $options = $this->o;
            $gdtttax = $this->taxes;
            $errors = $this->errors;

            $page_title = __("Settings", "gd-taxonomies-tools");
            include($this->plugin_path.'forms/shared/all.header.php');
            include($this->plugin_path.'forms/admin/settings.php');
            include($this->plugin_path.'forms/shared/all.footer.php');
        }

        function admin_tools() {
            $options = $this->o;
            $gdtttax = $this->taxes;
            $errors = $this->errors;

            $page_title = __("Tools", "gd-taxonomies-tools");
            include($this->plugin_path.'forms/shared/all.header.php');
            include($this->plugin_path.'forms/admin/tools.php');
            include($this->plugin_path.'forms/shared/all.footer.php');
        }

        function admin_postypes() {
            global $wp_taxonomies;

            $post_features = array(
                "title" => __("Title", "gd-taxonomies-tools"),
                "editor" => __("Editor", "gd-taxonomies-tools"),
                "excerpt" => __("Excerpts", "gd-taxonomies-tools"),
                "trackbacks" => __("Trackbacks", "gd-taxonomies-tools"),
                "custom-fields" => __("Custom Fields", "gd-taxonomies-tools"),
                "comments" => __("Comments", "gd-taxonomies-tools"),
                "revisions" => __("Revisions", "gd-taxonomies-tools"),
                "thumbnail" => __("Post Thumbnails", "gd-taxonomies-tools"),
                "author" => __("Author", "gd-taxonomies-tools"),
                "page-attributes" => __("Page Attributes", "gd-taxonomies-tools")
            );

            $options = $this->o;
            $wpv = $this->wp_version;
            $gdcpost = $this->posts;
            $gdcpall = $this->p;
            $errors = $this->errors;
            $action = isset($_GET["action"]) ? $_GET["action"] : "list";

            if ($action == "list") {
                $page_title = __("Custom Posts", "gd-taxonomies-tools");
                include($this->plugin_path.'forms/shared/all.header.php');
                include($this->plugin_path.'forms/admin/customposts.php');
            } else if ($action == "addnew") {
                $page_title = __("Add new Custom Posts", "gd-taxonomies-tools");
                include($this->plugin_path.'forms/shared/all.header.php');
                include($this->plugin_path.'forms/admin/custompost.add.php');
            } else if ($action == "edit") {
                $page_title = __("Edit Custom Posts", "gd-taxonomies-tools");
                $cpt = $this->find_postype($_GET["pid"]);
                if (!is_array($cpt["supports"])) $cpt["supports"] = array();
                if (!is_array($cpt["taxonomies"])) $cpt["taxonomies"] = array();
                if (!isset($cpt["description"])) $cpt["description"] = "";
                if (!isset($cpt["rewrite_slug"])) $cpt["rewrite_slug"] = "";
                if (!isset($cpt["rewrite_front"])) $cpt["rewrite_front"] = "no";
                if (!isset($cpt["nav_menus"])) $cpt["nav_menus"] = "yes";
                if (!isset($cpt["exclude_from_search"])) $cpt["exclude_from_search"] = "no";
                if (!isset($cpt["publicly_queryable"])) $cpt["publicly_queryable"] = "yes";
                if (!isset($cpt["can_export"])) $cpt["can_export"] = "yes";
                if (!isset($cpt["labels"])) {
                    $cpt["labels"] = array("name" => $cpt["label"],
                        "singular_name" => $cpt["label_singular"],
                        "add_new" => "", "add_new_item" => "",
                        "edit_item" => "", "edit" => "",
                        "new_item" => "", "view_item" => "",
                        "search_items" => "", "not_found" => "",
                        "not_found_in_trash" => "", "view" => "",
                        "parent_item_colon" => "");
                }
                if (!isset($cpt["caps"])) {
                    $cpt["caps"] = array(
                        "edit_post" => "edit_post",
                        "edit_posts" => "edit_posts",
                        "edit_others_posts" => "edit_others_posts",
                        "publish_posts" => "publish_posts",
                        "read_post" => "read_post",
                        "read_private_posts" => "read_private_posts",
                        "delete_post" => "delete_post");
                }
                include($this->plugin_path.'forms/shared/all.header.php');
                include($this->plugin_path.'forms/admin/custompost.edit.php');
            }

            include($this->plugin_path.'forms/shared/all.footer.php');
        }

        function admin_taxs() {
            $options = $this->o;
            $wpv = $this->wp_version;
            $gdtttax = $this->taxes;
            $gdtxall = $this->t;
            $errors = $this->errors;
            $action = isset($_GET["action"]) ? $_GET["action"] : "list";

            if (function_exists("get_post_types") && $this->wp_version >= 30) {
                $post_types = get_post_types(array(), "objects");
            } else {
                $post_type = new stdClass();
                $post_type->name = "post";
                $post_type->label = "Posts";
                $post_types = array($post_type);
            }

            if ($action == "list") {
                $page_title = __("Taxonomies", "gd-taxonomies-tools");
                include($this->plugin_path.'forms/shared/all.header.php');
                include($this->plugin_path.'forms/admin/taxonomies.php');
            } else if ($action == "addnew") {
                $page_title = __("Add new Taxonomy", "gd-taxonomies-tools");
                include($this->plugin_path.'forms/shared/all.header.php');
                include($this->plugin_path.'forms/admin/taxonomy.add.php');
            } else if ($action == "edit") {
                $page_title = __("Edit Taxonomy", "gd-taxonomies-tools");
                $tax = $this->find_taxonomy($_GET["tid"]);
                $tax["domain"] = explode(",", $tax["domain"]);
                if (!isset($tax["nav_menus"])) {
                    $tax["nav_menus"] = "yes";
                }
                if (!isset($tax["labels"])) {
                    $tax["labels"] = array("name" => $tax["label"],
                        "singular_name" => $tax["label_singular"],
                        "search_items" => "", "popular_items" => "",
                        "all_items" => "", "parent_item" => "",
                        "edit_item" => "", "update_item" => "",
                        "add_new_item" => "", "new_item_name" => "");
                }
                if (!isset($tax["caps"])) {
                    $tax["caps"] = array(
                        "manage_terms" => "manage_categories",
                        "edit_terms" => "manage_categories",
                        "delete_terms" => "manage_categories",
                        "assign_terms" => "edit_posts");
                }
                include($this->plugin_path.'forms/shared/all.header.php');
                include($this->plugin_path.'forms/admin/taxonomy.edit.php');
            }

            include($this->plugin_path.'forms/shared/all.footer.php');
        }
    }

    $gdtt_debug = new gdDebugGDTT(GDTAXTOOLS_LOG_PATH);
    function wp_gdtt_dump($msg, $obj, $block = "none", $mode = "a+") {
        global $gdtt_debug;
        $gdtt_debug->dump($msg, $obj, $block, $mode);
    }

    $gdtt = new GDTaxonomiesTools();

    function gdtt_upgrade_notice() {
        global $gdtt;
        $gdtt->upgrade_notice();
    }

    include(GDTAXTOOLS_PATH."code/fnc/general.php");
    include(GDTAXTOOLS_PATH."code/fnc/filters.php");
    include(GDTAXTOOLS_PATH."code/fnc/display.php");
}

?>