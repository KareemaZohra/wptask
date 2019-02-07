<?php
/**
 * The main template file.
 *
 * @package unite-child
 */

get_header(); ?>
<div class="content-area col-sm-12 col-md-8">
	<?php
        $args = array( 'post_type' => 'wporg_film', 'posts_per_page' => 10 );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
    ?>
          <h2><?php the_title(); ?></h2>
        <h6 style="padding: 1%; padding-top:0; color : #54397E">
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
                        echo "Release Date : ".$topics->name;
                    }
                ?>
            </h6>
          <?php
          echo '<div class="entry-content">';
        $readmore = '<br><a type="button" class="btn btn-primary" href="'.get_permalink().'">Read More ...</a>';
          echo wp_trim_words(get_the_content(),30,$readmore);
          echo '</div>';
        endwhile;
    ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
