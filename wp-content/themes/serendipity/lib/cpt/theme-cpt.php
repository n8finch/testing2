<?php

// Register Custom Post Type
// If you need any help doing this, just go on https://generatewp.com/post-type/
function custom_post_type() {

    $labels = array(
        'name'                => _x( 'Post Types', 'Post Type General Name', 'foundy-genesix' ),
        'singular_name'       => _x( 'Post Type', 'Post Type Singular Name', 'foundy-genesix' ),
        'menu_name'           => __( 'Post Type', 'foundy-genesix' ),
        'name_admin_bar'      => __( 'Post Type', 'foundy-genesix' ),
        'parent_item_colon'   => __( 'Parent Item:', 'foundy-genesix' ),
        'all_items'           => __( 'All Items', 'foundy-genesix' ),
        'add_new_item'        => __( 'Add New Item', 'foundy-genesix' ),
        'add_new'             => __( 'Add New', 'foundy-genesix' ),
        'new_item'            => __( 'New Item', 'foundy-genesix' ),
        'edit_item'           => __( 'Edit Item', 'foundy-genesix' ),
        'update_item'         => __( 'Update Item', 'foundy-genesix' ),
        'view_item'           => __( 'View Item', 'foundy-genesix' ),
        'search_items'        => __( 'Search Item', 'foundy-genesix' ),
        'not_found'           => __( 'Not found', 'foundy-genesix' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'foundy-genesix' ),
    );
    $args = array(
        'label'               => __( 'Post Type', 'foundy-genesix' ),
        'description'         => __( 'Post Type Description', 'foundy-genesix' ),
        'labels'              => $labels,
        'supports'            => array( ),
        'taxonomies'          => array( 'category', 'post_tag' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'post_type', $args );

}
add_action( 'init', 'custom_post_type', 0 );
