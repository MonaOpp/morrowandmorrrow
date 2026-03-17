<?php
/**
 * Enqueue scripts and styles
 *
 * @package mm_tw
 */

/**
 * Enqueue scripts and styles.
 */
function mm_tw_scripts() {
	wp_enqueue_style( 'mm_tw-style', get_stylesheet_uri(), array(), MM_TW_VERSION );
	wp_enqueue_script( 'mm_tw-script', get_template_directory_uri() . '/js/script.min.js', array(), MM_TW_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mm_tw_scripts' );

/**
 * Enqueue the block editor script.
 */
function mm_tw_enqueue_block_editor_script() {
	$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

	if (
		$current_screen &&
		$current_screen->is_block_editor() &&
		'widgets' !== $current_screen->id
	) {
		wp_enqueue_script(
			'mm_tw-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			MM_TW_VERSION,
			true
		);
		wp_add_inline_script( 'mm_tw-editor', "tailwindTypographyClasses = '" . esc_attr( MM_TW_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'mm_tw_enqueue_block_editor_script' );