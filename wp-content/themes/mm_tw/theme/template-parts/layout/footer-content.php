<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mm_tw
 */

?>

<footer id="colophon" class="bg-[#F8F8F8] py-12">
	<div class="max-w-content mx-auto px-6">
		<div class="bg-[#F0F0F0] rounded-lg p-12">
			<div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
				
				<!-- Logo Section -->
				<div class="lg:col-span-1">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo home_url(); ?>/wp-content/uploads/2026/03/Logo.png" 
							 alt="<?php bloginfo( 'name' ); ?>" 
							 class="w-[250px] h-auto">
					</a>
				</div>

				<!-- Locations Section -->
				<div class="lg:col-span-1">
					<h3 class="font-bold text-[#2E2E2E] text-lg mb-4 uppercase">Locations</h3>
					<div class="space-y-2">
						<?php 

						// If not found, try 'options' (default)
						if( empty($location_content) ) {
							$location_content = get_field('location', 'options');
						}
						
						if( !empty($location_content) ): 
							$formatted_content = str_replace("\n", "<br>", $location_content);
							?>
							<div class="text-[#2E2E2E]"><?php echo wp_kses_post( $formatted_content ); ?></div>
						<?php else: ?>
						<?php endif; ?>
					</div>
				</div>

				<!-- Contact Us Section -->
				<div class="lg:col-span-1">
					<h3 class="font-bold text-[#2E2E2E] text-lg mb-4 uppercase">Contact Us</h3>
					<div class="space-y-2">
						<?php 
						
						// If not found, try 'options' (default)
						if( empty($contact_content) ) {
							$contact_content = get_field('contact', 'options');
						}
						
						if( !empty($contact_content) ): 
							$formatted_content = str_replace("\n", "<br>", $contact_content);
							?>
							<div class="text-[#2E2E2E]"><?php echo wp_kses_post( $formatted_content ); ?></div>
						<?php else: ?>
						<?php endif; ?>
					</div>
				</div>

				<!-- Follow Us Section -->
				<div class="lg:col-span-1">
					<h3 class="font-bold text-[#2E2E2E] text-lg mb-4 uppercase">Follow Us</h3>
					<div class="flex space-x-4">
						<a href="#" class="text-[#2E2E2E] hover:text-primary transition-colors">
							<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
								<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
							</svg>
						</a>
						<a href="#" class="text-[#2E2E2E] hover:text-primary transition-colors">
							<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
								<path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
							</svg>
						</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</footer><!-- #colophon -->
