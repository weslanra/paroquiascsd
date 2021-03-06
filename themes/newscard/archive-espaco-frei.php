<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NewsCard
 */

get_header();

	newscard_layout_primary(); ?>
		<main id="main" class="site-main">
			<?php if ( have_posts() ) : ?>
				<div class="row gutter-parent-14 post-wrap">
					<?php /* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'news' );

					endwhile; ?>
				</div><!-- .row .gutter-parent-14 .post-wrap-->

				<?php the_posts_pagination( array(
					'prev_text' => __( 'Previous', 'newscard' ),
					'next_text' => __( 'Next', 'newscard' ),
					)
				);

			else :

				get_template_part( 'template-parts/content', 'news-not-find' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action('newscard_sidebar');
get_footer();
