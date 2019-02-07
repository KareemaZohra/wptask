<?php
/**
 * The template for displaying all single posts and attachments
 */
 
get_header(); ?>
 
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
 
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
 
            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part( 'content', get_post_format() );
            
            ?>
            <h4 style="padding: 5%; padding-top:0; color : #54397E">
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
                        echo "Release Date : ".$topics->name;
                    }
                ?>
            </h4>
            <?php
 
            // Previous/next post navigation.
            the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'unite-child' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Next post:', 'unite-child' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'unite-child' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Previous post:', 'unite-child' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
            ) );
        // End the loop.
        endwhile;
        ?>
 
        </main><!-- .site-main -->
    </div><!-- .content-area -->
 
<?php get_footer(); ?>