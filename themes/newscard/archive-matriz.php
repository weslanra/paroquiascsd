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
			<?php
				$page_id 	= get_page_by_path( 'sobre-matriz' )->ID;
				$content 	= get_post_field( 'post_content', $page_id );
				$title 		= get_post_field( 'post_title', $page_id );
			?>

			<header class="page-header">
				<h1 class="page-title"><?= $title ?></h1>
			</header><!-- .page-header -->
			<div class="w-100 post content-community">
				<?= $content ?>
			</div>

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
