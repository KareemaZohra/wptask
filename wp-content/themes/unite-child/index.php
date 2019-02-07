<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package unite
 */

get_header(); ?>

	<?php
        $args = array( 'post_type' => 'wporg_film', 'posts_per_page' => 10 );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
          the_title();
          echo '<div class="entry-content">';
          the_content();
          echo '</div>';
        ?>
        <h6 style="padding: 1%; padding-top:0; color : #54397E">
                About -
                 <?php
                $topic = get_the_terms(get_the_ID(), 'Country');
                    foreach($topic as $topics){
                        echo "Country : ".$topics->name.", " ;
                    }
                $topic = get_the_terms(get_the_ID(), 'Genere');
                    foreach($topic as $topics){
                        echo "Genere : ".$topics->name.", "; 
                    }
                $topic = get_the_terms(get_the_ID(), 'price');
                    foreach($topic as $topics){
                        echo "Ticket Price : ".$topics->name.", ";
                    }
                $topic = get_the_terms(get_the_ID(), 'date');
                    foreach($topic as $topics){
                        echo "Release Date : ".$topics->name.", ";
                    }
                ?>
            </h5>
        <?php
        endwhile;
    ?>

<?php get_footer(); ?>
