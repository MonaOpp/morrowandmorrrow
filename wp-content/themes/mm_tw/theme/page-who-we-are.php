<?php
/**
 * The template for displaying the Who We Are page
 *
 * @package mm_tw
 */

get_header();
?>

	<section id="primary" class="who-we-are-page py-16 bg-gray-50">
		<main id="main" class="max-w-content mx-auto px-6">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?>>

					<header class="entry-header mb-12 text-left bg-white">
						<?php the_title( '<h1 class="entry-title text-5xl font-bold text-primary mb-4 uppercase tracking-wide py-8 px-6 rounded-lg">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<?php mm_tw_post_thumbnail(); ?>

					<div <?php mm_tw_content_class( 'entry-content prose prose-lg max-w-none' ); ?>>
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="mt-8 text-center text-gray-600">' . __( 'Pages:', 'mm_tw' ),
								'after'  => '</div>',
							)
						);
						?>
					</div><!-- .entry-content -->

					<?php if ( get_edit_post_link() ) : ?>
						<footer class="entry-footer">
							<?php
							edit_post_link(
								sprintf(
									wp_kses(
										/* translators: %s: Name of current post. Only visible to screen readers. */
										__( 'Edit <span class="sr-only">%s</span>', 'mm_tw' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									wp_kses_post( get_the_title() )
								),
								'<span class="edit-link">',
								'</span>'
							);
							?>
						</footer><!-- .entry-footer -->
					<?php endif; ?>

				</article><!-- #post-<?php the_ID(); ?> -->

				<?php
				// If comments are open, or we have at least one comment, load
				// the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

			endwhile; // End of the loop.
			?>

			<!-- Location Accordion Component -->
			<div class="our-locations-section mt-16">
				<?php get_template_part('template-parts/components/location-accordion'); ?>
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();