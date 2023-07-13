<?php
/*
 * Plugin Name: Modify WP API
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Modify the JSON response of the WP API
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Melissa Wong
 * Author URI:        https://github.com/melmai
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       modify-wp-api
 * Domain Path:       /languages
 */

add_action('rest_api_init', 'kcm_modifywpapi_register_rest_images' );
function kcm_modifywpapi_register_rest_images(){
    register_rest_field( array('post'),
        'featured_image_url',
        array(
            'get_callback'    => 'get_rest_featured_image',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}
function get_rest_featured_image( $object, $field_name, $request ) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_src( $object['featured_media'], 'large' );
        return $img[0];
    }
    return false;
}
