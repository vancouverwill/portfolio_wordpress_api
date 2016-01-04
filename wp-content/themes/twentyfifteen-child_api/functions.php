<?php

// add new content type project
function create_post_type() {
  register_post_type( 'portfolio_project',
    array(
      'labels' => array(
        'name' => __( 'Projects' ),
        'singular_name' => 'Project',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Project',
        'all_items'          => 'All Projects',
        'search_items'       => 'Search Projects',
        'not_found'          => 'No Projects Found',
        'not_found_in_trash' => 'No Projects Found in Trash'
      ),
      'show_in_nav_menus'   => true,
      'show_in_menu'        => true,
      'public' => true,
      'has_archive' => true,
      'show_in_admin_bar' => true,
      'show_in_rest' => true,
      'show_in_rest'       => true,
      'rest_base'          => 'projects'
    )
  );
}

add_action( 'init', 'create_post_type' );


// intialize new theme as child theme
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}


add_action( 'rest_api_init', 'slug_register_api' );

function slug_register_api() {
    register_api_field( 'portfolio_project',
        'gallery_set',
        array(
            'get_callback'    => 'slug_get_api_field',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    register_api_field( 'portfolio_project',
        'project_short_description',
        array(
            'get_callback'    => 'slug_get_api_field',
            'update_callback' => null,
            'schema'          => null,
        )
    );

    register_api_field( 'portfolio_project',
        'font_color',
        array(
            'get_callback'    => 'slug_get_api_field',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}


/**
 * Get the value of the api field
 *
 * @param array $object Details of current post.
 * @param string $field_name Name of field.
 * @param WP_REST_Request $request Current request
 *
 * @return mixed
 */
function slug_get_api_field( $object, $field_name, $request ) {
    return get_field($field_name, $object[ 'id' ]);
}



