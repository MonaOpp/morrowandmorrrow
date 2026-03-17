<?php
/**
 * Navigation related functions
 *
 * @package mm_tw
 */

/**
 * Fallback menu for header navigation
 */
function mm_tw_fallback_menu() {
	$menu_items = array(
		array(
			'title' => 'WHO WE ARE',
			'url'   => home_url( '/who-we-are/' ),
		),
		array(
			'title' => 'WHAT WE DO',
			'url'   => home_url( '/what-we-do/' ),
		),
		array(
			'title' => 'CONNECT',
			'url'   => home_url( '/connect/' ),
		),
	);

	echo '<ul class="flex space-x-8 items-center">';
	foreach ( $menu_items as $item ) {
		echo '<li>';
		echo '<a href="' . esc_url( $item['url'] ) . '" class="text-primary font-semibold uppercase tracking-wide text-sm hover:bg-primary hover:text-white px-4 py-2 rounded transition-colors duration-200">';
		echo esc_html( $item['title'] );
		echo '</a>';
		echo '</li>';
	}
	echo '</ul>';
}