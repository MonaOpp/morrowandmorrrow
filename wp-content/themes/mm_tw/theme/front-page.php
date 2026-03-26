<?php
/**
 * The front page template
 *
 * Displays a full-screen landing page with background image,
 * logo, and bottom navigation. No standard header or footer.
 *
 * @package mm_tw
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'home-page' ); ?>>
<?php wp_body_open(); ?>

<div class="home-landing">
	<!-- Background Image -->
	<div class="home-landing__bg">
		<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/03/morrows2.png' ); ?>"
		     alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
	</div>

	<!-- Logo -->
	<div class="home-landing__logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo esc_url( get_site_url() . '/wp-content/uploads/2026/03/Logo.png' ); ?>"
			     alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
		</a>
	</div>

	<!-- Bottom Navigation -->
	<nav class="home-landing__nav">
		<a href="<?php echo esc_url( home_url( '/who-we-are/' ) ); ?>" class="home-landing__nav-link">WHO WE ARE</a>
		<a href="<?php echo esc_url( home_url( '/our-services/' ) ); ?>" class="home-landing__nav-link">WHAT WE DO</a>
		<a href="<?php echo esc_url( home_url( '/connect/' ) ); ?>" class="home-landing__nav-link">CONNECT</a>
	</nav>
</div>

<?php wp_footer(); ?>
</body>
</html>
