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



add_action( 'admin_menu', 'wporg_custom_admin_menu' );
 
function wporg_custom_admin_menu() {
    // add_options_page(
    //     'My Plugin Title',
    //     'Portfolio Settings',
    //     'manage_options',
    //     'wporg-plugin',
    //     'wporg_options_page'
    // );
    add_options_page('Global Custom Options', 
                'Global Custom Options', 
                'manage_options', 
                'functions',
                'global_custom_options');

}

function global_custom_options() {
    ?>
    <div class="wrap">
        <h2>Global Custom Options</h2>
        <form method="post" action="options.php">
            <?php wp_nonce_field('update-options') ?>
            <p>
                <strong>User Name:</strong><br />
                <input type="text" name="username" size="45" value="<?php echo get_option('username'); ?>" />
            </p>
            <p>
                <strong>github username:</strong><br />
                <input type="text" name="github_username" size="45" value="<?php echo get_option('github_username'); ?>" />
            </p>
            <p>
                <strong>linkedin username:</strong><br />
                <input type="text" name="linkedin_username" size="45" value="<?php echo get_option('linkedin_username'); ?>" />
            </p>
            <p>
                <strong>Twitter ID:</strong><br />
                <input type="text" name="twitterid" size="45" value="<?php echo get_option('twitterid'); ?>" />
            </p> 
            <p>
                <strong>Bio:</strong><br />
                <textarea name="user_bio" cols="45" ><?php echo get_option('user_bio'); ?></textarea>
            </p>
            <p><input type="submit" name="Submit" value="Store Options" /></p>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="twitterid,username,github_username,linkedin_username,user_bio" />
        </form>
    </div>
    <?php
}


