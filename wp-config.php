<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'vidicrew_wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
	define('AUTH_KEY',         'Z?co.09n8;pkRcA `2*3inGmN4`_L?k(-3%9+c!<t1 a5,}LTvkfAp-Q{^@!KZ(`');
	define('SECURE_AUTH_KEY',  '&T$2LYAt|#$$<}!T!4?/)I6#& ,FyQX;Ow86+0uwZ>Ff@el!Y,:r0Dz|{p4e9.$%');
	define('LOGGED_IN_KEY',    'C9L97~Sn0~$(m[0@1s63D3D``j%2?xiVY*QTg4K.-C4gfx)fFA}}!OR]x%p+v)I?');
	define('NONCE_KEY',        'ZgEi*.5Z3R@ZPC_H=L_7^PNz,.>Mk>@S&nq,,i*9R-O %Fn8NI+7g$o;QV%1J$#%');
	define('AUTH_SALT',        '>{cDOqU4D_D^h;pnvrc-;|t59u|KI-mRZ/StNjXbPc_{M$s@*yq;+p{n-[Nqm42x');
	define('SECURE_AUTH_SALT', 'KB4~7KOV<c,ss|cvo5C-v!Qdb_=4|z%:+D+g<)X|Mg_cWF3zi.d#n#(-F2wy3p:-');
	define('LOGGED_IN_SALT',   'WeA%G/jj|y)6IXK!!k3v5FdOpTPB0z*eHpy|Z,t7*ewuK=m+s[u}n9_iU[.j@a-E');
	define('NONCE_SALT',       '=Qv4YOp+!%Vm#kL|Gk}/|GY{uo>`^,bMu}]TZ:R33TXK`XJWENm9` RWu&@>TuvR');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_MEMORY_LIMIT', '512M');

define('WP_MAX_MEMORY_LIMIT', '512M');