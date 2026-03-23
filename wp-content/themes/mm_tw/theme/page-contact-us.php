<?php
/**
 * Template Name: Contact Us
 * 
 * The template for displaying the Contact Us page
 *
 * @package mm_tw
 */

get_header();
?>

	<section id="primary" class="contact-page py-16 bg-gray-50">
		<main id="main" class="max-w-content mx-auto px-6">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-lg shadow-sm p-12 mb-8' ); ?>>

					<header class="entry-header mb-12 text-center">
						<?php the_title( '<h1 class="entry-title text-5xl font-bold text-primary mb-4 uppercase tracking-wide py-8 rounded-lg">', '</h1>' ); ?>
					</header><!-- .entry-header -->

					<?php mm_tw_post_thumbnail(); ?>

					<div <?php mm_tw_content_class( 'entry-content prose prose-lg max-w-none mb-8' ); ?>>
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

			<?php endwhile; // End of the loop. ?>

			<!-- Location Accordion Component - Shows Addresses -->
			<div class="locations-section">
				<div class="text-center mb-8">
					<h2 class="text-3xl font-bold text-primary uppercase tracking-wide">Our Locations</h2>
					<p class="text-lg text-gray-700 mt-2">Visit us at one of our convenient locations</p>
				</div>

				<?php get_template_part('template-parts/components/location-accordion', null, [
					'context' => 'contact'
				]); ?>
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();