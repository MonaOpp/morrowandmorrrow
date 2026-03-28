<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the `#content` element and all content thereafter.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mm_tw
 */

?>

	</div><!-- #content -->

	<?php get_template_part( 'template-parts/layout/footer', 'content' ); ?>

</div><!-- #page -->

<!-- Scroll to Top Button -->
<button id="scroll-to-top" class="scroll-to-top" aria-label="<?php esc_attr_e( 'Scroll to top', 'mm_tw' ); ?>">
	<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
		<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
	</svg>
</button>

<?php wp_footer(); ?>

</body>
</html>
