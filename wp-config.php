<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'zmorrzyewd_wp777c' );

/** Database username */
define( 'DB_USER', 'zmorrzyewd_452' );

/** Database password */
define( 'DB_PASSWORD', 'eecZcGYPHPurSw2uBBy9' );

/** Database hostname */
define( 'DB_HOST', 'dedi1011.jnb2.host-h.net' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define( 'WP_HOME', 'http://morrowandmorrrow.test/' );
define( 'WP_SITEURL', 'http://morrowandmorrrow.test/' );
/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'k:3Rbk;&?P;/Dh^LGD]6#3gIc(dd&Un$ucuj$2xH*tI.4t6jD?YSYGKl|XY<ic`eHE9$5f_IzwnoX:CN' );
define( 'SECURE_AUTH_KEY',  'aAW[d(Hk,Ln72O8AZhb`g?HfS}?BrM1>hT/gH)[R!f-8O|]0KErAMkV_EgrqV)61xuC9rKH!*5)nD3E/' );
define( 'LOGGED_IN_KEY',    'Ar9C&wzl{=ur.MS;y#`H9s]l8V6]La[k%C{5Dy`qb!XIBsTo2vqc?!cFSJc6Ogxo!eYV}TkA>?PC,a!b' );
define( 'NONCE_KEY',        '[[gA;d<Z*^t!9I#]g_9!x_>0i-t<(!!{hIECj0{=0!-xKm;$r@tUwb#.N`piJ:!KxT<EZ*:HBUD;}+!S' );
define( 'AUTH_SALT',        '*`_?G?cUbT)T&P!;_#?JvusUAo:)S};)4+CpL@?.<?2BqsMRUO&vVysA_6sGrh_J>Q8wU9*+#k8pbOu)' );
define( 'SECURE_AUTH_SALT', '^97^i!l.Lc>y{I/OXffzsHc!!sG67wim2SQUEDaY]CTiu!?Y/.{0PWK.!(fHec3->f2~RC@.!=VVdynQ' );
define( 'LOGGED_IN_SALT',   's!!WP;CP05;,W=V[yI9j{!d=XyHE/@VEYuHl>NbN|`!QKdO=tHMb;sJ>L{,?ncN`jO5k:n_!$~!T%,`!' );
define( 'NONCE_SALT',       'Kq~ODGzlF0!UwBfC,TrEdZnefqSq=<m~qnj^!cFyPN|IQME_Y[/3e5)_n7fnLEY_L_0GtRh]4Lp@t,~<' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */

// Increase WordPress memory limit
define('WP_MEMORY_LIMIT', '512M');

// Increase maximum file upload size for WordPress
@ini_set('upload_max_filesize', '128M');
@ini_set('post_max_size', '128M');
@ini_set('memory_limit', '512M');
@ini_set('max_execution_time', '600');
@ini_set('max_input_time', '600');

// Additional WordPress upload settings
define('WP_MAX_MEMORY_LIMIT', '512M');

// Increase timeout for plugin operations
define('FS_TIMEOUT', 600);

// Force direct file system method (bypass FTP requirement)
define('FS_METHOD', 'direct');



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
