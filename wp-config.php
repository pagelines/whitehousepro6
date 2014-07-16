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

define('WP_DEBUG', true);
define('PL_LESS_DEV', true);
define('WP_MEMORY_LIMIT', '64M');


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'whitehousepro');

/** MySQL database username */
define('DB_USER', 'raymond');

/** MySQL database password */
define('DB_PASSWORD', 'pass123');

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
define('AUTH_KEY',         'cF72Z*C|W&l_*@+|&g`&bFt83b_!YRA]T|p_){nYiam,,##7$Dtylp&1m#-CZ.)?');
define('SECURE_AUTH_KEY',  'Wl}-V(U|_c4SEA(-`I+D.sQB/*I&u_;_`-2s}5T?ZJ mZU$*M9= AZ[mlu /9xk{');
define('LOGGED_IN_KEY',    'pEoz6jnmV~-e/MQTV_[HK/,FN6w_kS(XrI6BYc}Am*g#974ciF#z_tHO+cgH7m?|');
define('NONCE_KEY',        'i1?#6[3b*,RXH$:I*xD1Mq[9|E!B0m)NG=Te+MV[6m32+-&uR QHQL=;/:>hjX3j');
define('AUTH_SALT',        'AQ.v^ps3.q,IoW2EFAJN}u*0Tz:]o4/,Qae$VQiVI=LYRnpJ!T{mZ9q2S9C>(.Vi');
define('SECURE_AUTH_SALT', 'ch]C^W|*k_B3b6(XB8_T3Lzv>SdoM#r2~Kq!2x.~=2|e5[)G_-9D,WO7(:Rg[D:*');
define('LOGGED_IN_SALT',   '#B/UxTQ)r$r3Yw.9J[A=HS^t[eKnB-35>l|{$-Hb6K2w>$/a9,N0V@E&1:NQe? h');
define('NONCE_SALT',       '~fFE}2)F-BqkIi5sV-AA10m*CHgGuP<$]2r1&1s49/.|$<Zc+jh^v8<ea`:<~.*4');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
