<?php
/**
 * The template for displaying the Our Services page
 *
 * @package mm_tw
 */

get_header();
?>

	<section id="primary" class="our-services-page py-16 bg-gray-50">
		<main id="main" class="max-w-content mx-auto px-6">

			<?php
			while ( have_posts() ) :
				the_post();
			?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?>>

					<header class="entry-header mb-12 text-left bg-white">
						<?php the_title( '<h1 class="entry-title text-6xl font-bold text-primary mb-4 uppercase tracking-wide py-8 px-6 rounded-lg">', '</h1>' ); ?>
					</header>

				</article>

			<?php endwhile; ?>

			<!-- Service Sections Component -->
			<div class="our-services-content mt-8">
				<?php get_template_part( 'template-parts/components/service-sections' ); ?>
			</div>

		</main>
	</section>

<?php
get_footer();