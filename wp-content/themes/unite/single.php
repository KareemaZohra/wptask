<?php
/**
 * Template Name : films
 */

get_header(); ?>

	<div id="primary" class="content-area col-sm-12 col-md-8 <?php echo of_get_option( 'site_layout' ); ?>">
		<main id="main" class="site-main" role="main">

		<?php while ( $wporg_film->have_posts() ) : $wporg_film->the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header page-header">
                <h1 class="entry-title">
                    <?php the_title(); ?>
                </h1>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php the_content(); ?>
                <?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'unite' ),
				'after'  => '</div>',
			) );
		?>
            </div><!-- .entry-content -->
            <p>
                topics : 
                <?php
                $topic = get_the_topics(get_the_ID(),'Genere');
                foreach($topic as $topics){
                    echo $topics->name;
                }
                ?>
            </p>
        </article><!-- #post-## -->


		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>