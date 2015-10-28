<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}


add_action( 'rest_api_init', 'slug_register_starship' );
function slug_register_starship() {
    register_api_field( 'post',
        'gallery',
        array(
            'get_callback'    => 'slug_get_starship',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}

/**
 * Get the value of the "starship" field
 *
 * @param array $object Details of current post.
 * @param string $field_name Name of field.
 * @param WP_REST_Request $request Current request
 *
 * @return mixed
 */
function slug_get_starship( $object, $field_name, $request ) {
    // return get_post_meta( $object[ 'id' ], $field_name, true );
    // return the_field($field_name, $object[ 'id' ]);
    return get_field($field_name, $object[ 'id' ]);
    // return "brazil xxx";
}
