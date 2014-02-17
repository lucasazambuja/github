<?php
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
define('DB_NAME', 'anfitria');

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
define('AUTH_KEY',         '4-v74ljhqb8udMYB?Yz.3$La8o&UfA1{#z0vf#6LD(=<<dzyNOl38:)#)&U;E,a_');
define('SECURE_AUTH_KEY',  '<xi,XzA&]zhw/84bF@^<~orc]NIrUj8aWj1kbAP|d`nT<b~:!kItn^bH6]sP(nMa');
define('LOGGED_IN_KEY',    'cw+~@iLU&dN3NMZf*L/{aS/N^].Hyumla0#iibQ_F=eSYg:<}&*=;z>fXeSgLt>A');
define('NONCE_KEY',        'WFfX*%Xsq*j03p$+pwds&->D?M}l?YX]gL&/3RY20mKOCmbJ*ygQ&O8%dPI&Gjl*');
define('AUTH_SALT',        'J.%3AxLDB{]Kq3((Z+>g,A2:ch4(6Jus[8J@=HFiO2VI-H?Rj1+:}m5{>qWXA3pe');
define('SECURE_AUTH_SALT', '2Sw4zjVgc!}ctO0Xuw<UjkY(87^3V.de6W0X;_Cl2]F^5WOnxt%L]QId@WQHRx)]');
define('LOGGED_IN_SALT',   'Nq,;{R3xDa35pNIhwcBc/Wv6qwhqWlbX@&O0e6L!U{k4antEM9jy9Y@L(`s#C,z?');
define('NONCE_SALT',       'M?TrAj AJbm=<Q!x~rc IXG6f,M&:ja_Q;IhBA.a2+|^fWwLQG0dj6oA#tg.!q$`');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
