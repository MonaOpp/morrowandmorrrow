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
		/**
		 * Location Accordion Component
		 * 
		 * Simple horizontal accordion component with hover effects
		 */

		// Get all locations
		$locations = get_posts([
			'post_type' => 'location',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'orderby' => 'title',
			'order' => 'ASC'
		]);

		if (empty($locations)) {
			return;
		}
		?>

		<div class="location-accordion">
			<?php foreach ($locations as $location): 
				$location_name = get_field('location_name', $location->ID);
				$location_address = get_field('location_address', $location->ID);
				$image = get_field('location_image_closed', $location->ID);
			?>
			
			<div class="location-card">
				<div class="location-header">
					<div class="location-content">
						<h2 class="location-title"><?php echo esc_html($location_name ?: $location->post_title); ?></h2>
						
						<?php if ($location_address): ?>
							<div class="location-details">
								<div class="location-address">
									<?php echo wp_kses_post(nl2br($location_address)); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
					
					<?php if ($image): ?>
						<div class="location-image">
							<img src="<?php echo esc_url($image['url']); ?>" 
								alt="<?php echo esc_attr($location_name ?: $location->post_title); ?>" />
						</div>
					<?php endif; ?>
				</div>
			</div>
			
			<?php endforeach; ?>
		</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();