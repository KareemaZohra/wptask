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
                               'name'          => __('films'),
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

//new code for price and date
register_taxonomy('price','wporg_film', array(
    'labels' => array(
        'name'=>'Ticket Price'
    ),
    'public' => true
));
register_taxonomy('date','wporg_film', array(
    'labels' => array(
        'name'=>'Release Date'
    ),
    'public' => true
));


//shortcode for 5 films
function five_film( $atts ) {
   
        $args = array( 'post_type' => 'wporg_film', 'posts_per_page' => 5 );
        $loop = new WP_Query( $args );
        $counter = 0;
        $max = 5;
        while ( $loop->have_posts() and $counter<$max ) : $loop->the_post(); ?>
          <h4><?php the_title(); ?></h4>
          <?php
          echo '<div class="entry-content">';
        $readmore = '<br><a href="'.get_permalink().'">Read More ...</a>';
          echo wp_trim_words(get_the_content(),5,$readmore);
        
        endwhile;
    
}
add_shortcode( 'film5', 'five_film' );

?>






