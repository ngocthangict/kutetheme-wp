<?php

if ( !defined('ABSPATH')) exit;

function register_post_type_init() {
    
    $labels = array(
        'name' => __( 'Member', THEME_LANG ),
        'singular_name' => __( 'Member', THEME_LANG ),
        'add_new' => __( 'Add New', THEME_LANG ),
        'all_items' => __( 'Members', THEME_LANG ),
        'add_new_item' => __( 'Add new member', THEME_LANG ),
        'edit_item' => __( 'Edit member', THEME_LANG ),
        'new_item' => __( 'New Member', THEME_LANG ),
        'view_item' => __( 'View member', THEME_LANG ),
        'search_items' => __( 'Search member', THEME_LANG ),
        'not_found' => __( 'No member found', THEME_LANG),
        'not_found_in_trash' => __( 'No member found in Trash', THEME_LANG ),
        'parent_item_colon' => __( 'Parent member', THEME_LANG ),
        'menu_name' => __( 'Members', THEME_LANG )
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'supports' 	=> array( 'title', 'thumbnail', 'page-attributes','editor'),
        'rewrite'            => true,
        'query_var'          => true,
        'publicly_queryable' => true,
        'public'             => true
    );

    register_post_type( 'members', $args );
    /* Testimonials */
    $labels = array(
        'name' => __( 'Testimonial', THEME_LANG ),
        'singular_name' => __( 'Testimonial', THEME_LANG),
        'add_new' => __( 'Add New', THEME_LANG ),
        'all_items' => __( 'Testimonials', THEME_LANG ),
        'add_new_item' => __( 'Add New Testimonial', THEME_LANG ),
        'edit_item' => __( 'Edit Testimonial', THEME_LANG ),
        'new_item' => __( 'New Testimonial', THEME_LANG ),
        'view_item' => __( 'View Testimonial', THEME_LANG ),
        'search_items' => __( 'Search Testimonial', THEME_LANG ),
        'not_found' => __( 'No Testimonial found', THEME_LANG ),
        'not_found_in_trash' => __( 'No Testimonial found in Trash', THEME_LANG ),
        'parent_item_colon' => __( 'Parent Testimonial', THEME_LANG ),
        'menu_name' => __( 'Testimonials', THEME_LANG )
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'supports' 	=> array( 'title', 'thumbnail', 'editor' ),
        'rewrite'            => false,
        'query_var'          => false,
        'publicly_queryable' => false,
        'public'             => true

    );
    register_post_type( 'testimonial', $args );
}
add_action( 'init', 'register_post_type_init' );