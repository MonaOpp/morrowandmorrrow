<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mm_tw
 */

?>

<header id="masthead" class="top-0 z-50" style="background-color: #F8F8F8;">
	<!-- Desktop Header -->
	<div class="hidden lg:block max-w-content mx-auto px-6" style="padding-top: 2.5rem; padding-bottom: 3.5rem;">
		<div class="flex items-center justify-between">
			
			<!-- Logo Section -->
			<div class="custom-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php echo home_url(); ?>/wp-content/uploads/2026/03/Logo.png" 
						 alt="<?php bloginfo( 'name' ); ?>" 
						 class="h-16 w-auto">
				</a>
			</div>
			<!-- Navigation Menu -->
			<nav id="site-navigation" class="block" aria-label="<?php esc_attr_e( 'Main Navigation', 'mm_tw' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'menu_class'     => 'flex space-x-8 items-center',
						'fallback_cb'    => 'mm_tw_fallback_menu',
					)
				);
				?>
			</nav>
		</div>
	</div>

	<!-- Mobile/Tablet Header -->
	<div class="lg:hidden flex items-center justify-between px-4 py-4">
		<div class="custom-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php echo home_url(); ?>/wp-content/uploads/2026/03/Logo.png" 
					 alt="<?php bloginfo( 'name' ); ?>" 
					 class="h-12 w-auto">
			</a>
		</div>
		<button id="mobile-menu-button" 
				class="mobile-burger p-2"
				aria-controls="mobile-menu" 
				aria-expanded="false">
			<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
			</svg>
			<span class="sr-only"><?php esc_html_e( 'Toggle menu', 'mm_tw' ); ?></span>
		</button>
	</div>

	<!-- Mobile Menu Dropdown -->
	<div id="mobile-menu" class="lg:hidden hidden mobile-menu-dropdown">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'mobile-primary-menu',
				'container'      => false,
				'menu_class'     => 'flex flex-col items-center gap-2 py-4',
				'fallback_cb'    => 'mm_tw_fallback_menu',
			)
		);
		?>
	</div>
</header><!-- #masthead -->
