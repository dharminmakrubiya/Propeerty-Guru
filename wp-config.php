<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'propertygurugroup' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '{ee}=Sx6rZ24z6~yKIM)P@|IDo2,ydh72o*n}&b$lp$s2E.=z6rgr??:geu04fto' );
define( 'SECURE_AUTH_KEY',  ')Zz[kUp`ndObb=D[owF*$yF,^bH,;UiP3%&RVp(e*nzGOE@;f0[=UnQI 0S2j/Ec' );
define( 'LOGGED_IN_KEY',    'o~pA!Mnf0I}<T.^XX^vOMm+|`JhWtx`3R=6N|>l,0^rvnU+nfiNl7r_Lw2A&}w1;' );
define( 'NONCE_KEY',        'zyhso(]-yc4T?i#U{t57uEQ:!+B%+[:+V:9o3bE8ltkm$oQQqnZ >]Zf{{_Uxj^D' );
define( 'AUTH_SALT',        'f*o;_/8czS07!nl[FQ$h)I5afNbBYI6WjkO9Bu*PY@iyLH}: #7_dxRl/6n`q.^)' );
define( 'SECURE_AUTH_SALT', '5L!:X<1wGf+4d1-5$cBQ&ybFZ^#d#j/<R5u3*DEh+~CuwMXGbdRHT3!:#IAi|4#T' );
define( 'LOGGED_IN_SALT',   '~`K2:35roXWf{r8vwlnvv82q-(+9n;sk/g[<<~s/no65)~2=8``m7x=8%FvdA~58' );
define( 'NONCE_SALT',       ')lkebj!Yjy`x&GC`lOge6}#!^?E;#qA?&K k{]Z=9RR:x,wi6), wMM??..:ym?Y' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define( 'UPLOADS', 'wp-content/uploads' );

