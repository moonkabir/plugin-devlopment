<?php
/*
Plugin Name: Custom Post Recipe
Plugin URI: https://github.com/moonkabir/plugin-devlopment/tree/master/wp-content/plugins
Description: WordPress custompost-recipe
Version: 1.0
Author: Moon Kabir
Author URI: https://moonkabir.xyz
License: GPLv2 or later
Text Domain: custompost-recipe
Domain Path: /languages/
*/

// function cptr_load_textdomain()
// {
//     load_plugin_textdomain('custompost-recipe', false, dirname(__FILE__) . "/languages");
// }
// add_action('plugins_loaded', 'cptr_load_textdomain');

function cptdemo_register_cpt_recipe()
{
    /**
     * Post Type: Recipe.
     */
    $labels = array(
        "name"          => __("Recipes", "custompost-recipe"),
        "singular_name" => __("Recipe", "custompost-recipe"),
        "all_items"     => __("My Recipes", "custompost-recipe"),
        "add_new"       => __("New Recipes", "custompost-recipe"),
    );
    $args = array(
        "label"                 => __("Recipes", "custompost-recipe"),
        "labels"                => $labels,
        "description"           => "",
        "public"                => true,
        "publicly_queryable"    => true,
        "show_ui"               => true,
        "show_in_rest"          => false,
        "rest_base"             => "",
        "has_archive"           => "recipes",
        "show_in_menu"          => true,
        "show_in_nav_menu"      => true,
        "exclude_from_search"   => false,
        "capability_type"       => "post",
        "map_meta_cap"          => true,
        "hierarchical"          => false,
        "query_var"             => true,
        "menu_position"         => 6,
        "menu_icon"             => "dashicons-book-alt",
        "supports"              => array("title", "editor", "thumbnail", "excerpt"),
        "taxonomies"            => array("category"),
    );
    register_post_type("recipe", $args);
}
add_action('init', 'cptdemo_register_cpt_recipe');

function cptdemo_recipe_template($file)
{
    global $post;
    if ("recipe" == $post->post_type) {
        $file_path = plugin_dir_path(__FILE__) . "cpt-templates/single-recipe.php";
        $file = $file_path;
    }
    return $file;
}

add_filter('single_template', 'cptdemo_recipe_template');
