<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

//post type
function wporg_custom_post_type()
{
    register_post_type('wporg_film',
                       array(
                           'labels'      => array(
                               'name'          => __('All films'),
                               'singular_name' => __('film'),
                           ),
                           'public'      => true,
                           'has_archive' => true,
                           'rewrite'     => array( 'slug' => 'film' ),
                       )
    );
}
add_action('init', 'wporg_custom_post_type');

//custom taxonomies
// Genere
function wporg_register_taxonomy_genere()
{
    $labels = [
        'name'              => _x('Genere', 'taxonomy general name'),
        'singular_name'     => _x('Genere', 'taxonomy singular name'),
        'search_items'      => __('Search Genere'),
        'all_items'         => __('All Generes'),
        'parent_item'       => __('Parent Genere'),
        'parent_item_colon' => __('Parent Genere:'),
        'edit_item'         => __('Edit Genere'),
        'update_item'       => __('Update Genere'),
        'add_new_item'      => __('Add New Genere'),
        'new_item_name'     => __('New Genere Name'),
        'menu_name'         => __('Genere'),
        ];
        $args = [
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'genere'],
        ];
        register_taxonomy('Genere', ['wporg_film'], $args);
}
add_action('init', 'wporg_register_taxonomy_genere');

//Country
function wporg_register_taxonomy_country()
{
    $labels = [
        'name'              => _x('Country', 'taxonomy general name'),
        'singular_name'     => _x('Country', 'taxonomy singular name'),
        'search_items'      => __('Search Country'),
        'all_items'         => __('All Countries'),
        'parent_item'       => __('Parent Country'),
        'parent_item_colon' => __('Parent Country:'),
        'edit_item'         => __('Edit Country'),
        'update_item'       => __('Update Country'),
        'add_new_item'      => __('Add New Country'),
        'new_item_name'     => __('New Country Name'),
        'menu_name'         => __('Country'),
        ];
        $args = [
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'country'],
        ];
        register_taxonomy('Country', ['wporg_film'], $args);
}
add_action('init', 'wporg_register_taxonomy_country');

//Year
function wporg_register_taxonomy_year()
{
    $labels = [
        'name'              => _x('Year', 'taxonomy general name'),
        'singular_name'     => _x('Year', 'taxonomy singular name'),
        'search_items'      => __('Search Year'),
        'all_items'         => __('All Years'),
        'parent_item'       => __('Parent Year'),
        'parent_item_colon' => __('Parent Year:'),
        'edit_item'         => __('Edit Year'),
        'update_item'       => __('Update Year'),
        'add_new_item'      => __('Add New Year'),
        'new_item_name'     => __('New Year'),
        'menu_name'         => __('Year'),
        ];
        $args = [
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'year'],
        ];
        register_taxonomy('Year', ['wporg_film'], $args);
}
add_action('init', 'wporg_register_taxonomy_year');

//Actors
function wporg_register_taxonomy_actors()
{
    $labels = [
        'name'              => _x('Actors', 'taxonomy general name'),
        'singular_name'     => _x('Actors', 'taxonomy singular name'),
        'search_items'      => __('Search Actors'),
        'all_items'         => __('All Actors'),
        'parent_item'       => __('Parent Actors'),
        'parent_item_colon' => __('Parent Actors:'),
        'edit_item'         => __('Edit Actors'),
        'update_item'       => __('Update Actors'),
        'add_new_item'      => __('Add New Actors'),
        'new_item_name'     => __('New Actors Name'),
        'menu_name'         => __('Actors'),
        ];
        $args = [
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'actors'],
        ];
        register_taxonomy('Actors', ['wporg_film'], $args);
}
add_action('init', 'wporg_register_taxonomy_actors');

//input box for ticket price & release date
function wporg_add_custom_box()
{
    $screens = ['wporg_film', 'wporg_cpt'];
    foreach ($screens as $screen) {
        add_meta_box(
            'wporg_box_id',           // Unique ID
            'Price and Release Date',  // Box title
            'wporg_custom_box_html',  // Content callback, must be of type callable
            $screen                   // Post type
        );
    }
}
add_action('add_meta_boxes', 'wporg_add_custom_box');

function wporg_custom_box_html($wporg_film)
{
    $value = get_post_meta($wporg_film->ID, '_wporg_meta_key', true);
    ?>
    <label for="wporg_field">Ticket Price</label>
    <input type="text" name="wporg_field" id="wporg_field" class="postbox" <?php selected($value, 'something'); ?>>
    <label for="wporg_field2">Release Date</label>
    <input type="text" name="wporg_field" id="wporg_field2" class="postbox" <?php selected($value, 'something'); ?>>
    <?php
}

function wporg_save_postdata($post_id)
{
    if (array_key_exists('wporg_field', $_POST)) {
        update_post_meta(
            $post_id,
            '_wporg_meta_key',
            $_POST['wporg_field']
        );
    }
    if (array_key_exists('wporg_field2', $_POST)) {
        update_post_meta(
            $post_id,
            '_wporg_meta_key',
            $_POST['wporg_field2']
        );
    }
}
add_action('save_post', 'wporg_save_postdata');

?>






