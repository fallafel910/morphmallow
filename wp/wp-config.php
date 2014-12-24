<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** Enable W3 Total Cache Edge Mode */
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'morphmallow_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'XK|B;j_r2(eu/chJ6%x:5H I@*y>L;Y2*v~[DQn0JP<zk|?A9:owSX_1i<`kxJ;>');
define('SECURE_AUTH_KEY',  '5OIt]}:7I9fZoLvyNj+?X]mjFdf-w~mtgJv,&sABv)$GD-:cZ2feotxCc|x^9UFt');
define('LOGGED_IN_KEY',    'r1p2[Q1I7<[c<>D-TgZ@byM>f +SSgf4e9|*F48>bX:_fD#dX3`f/#Uu7)cdIq|?');
define('NONCE_KEY',        '}[ye{{8t7U@XR>V??~q1B|qgKmBS #148F8oo865v%c}z48xPK~N{JJp,/(XGda-');
define('AUTH_SALT',        '+]GB5vky%=*_pf:(o+LZ<*>Sn4$Wu067+wQ*;%/`JU[.n[/a-0s]2EbHCzyK8d-=');
define('SECURE_AUTH_SALT', '.g+Apxi[!~$K1obz2Xh#R,z9DzS+<8a5[EdO::AdtP*P(V((;q.bMI|,S8,gRh%<');
define('LOGGED_IN_SALT',   'i<>D7`8uLGs2,DyH*=Q[U`]*$hu+^{ &]Ll)xIbAXK_;w&2~A2v,y L?g.  YVGk');
define('NONCE_SALT',       '..eKU|!0/ .J|g82{N>UQUJBcHib!xMKtv~o_zcsVf_r+Q=E>I!@OX-v3hSO+&>>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
//define('WP_DEBUG', true);

define ('WPCF7_VERIFY_NONCE', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
/**
define('WP_HOME','http://sukkahlights.com/nextrendz/blog');
define('WP_SITEURL','http://sukkahlights.com/nextrendz/blog');
**/
