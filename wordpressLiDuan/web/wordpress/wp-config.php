<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'userInfoDB');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'TAOtao7836');

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
define('AUTH_KEY',         '<_??S1YU|+2}2z]6Go}@y[7$p?_c]5H+:CXw,AKYI[|QF- Yi:S`B+Hs2KS[j^t?');
define('SECURE_AUTH_KEY',  '  ~z=}Tz>ctL7Tx-1_rX_)+$j`Cnu0XG[2p]@Zn1|fCzk|VUf8Tv94hUPCKv(UVq');
define('LOGGED_IN_KEY',    '$t-9/_=H*E:}Mn`A9U+`b)6uqcjHFCa285.p6yX,6O03t+>q#nl7r;4g+!+@Hr0X');
define('NONCE_KEY',        'JAIqiQ6o/BE{[R@`:&EG,/[6X2P-k!oGt7.4%-`0@tHpla}k?%mkNpQQOI,k<[nz');
define('AUTH_SALT',        'QX2s/Gil1JSU=KsJ=ei&9OYLzMx6!>n]r:92R}@$x|72CPQE(Q,VL+|?XSivkZE{');
define('SECURE_AUTH_SALT', 'A .LW0Z8rS|7l-sF8o G^Xv]u[2Iv+AVPFvLDHF&[!A aN+sw-~:x:xy{BG6}nwB');
define('LOGGED_IN_SALT',   '-5@]+]8B#/-]g%Ni+b.j|KPQztN.4@NmUW>rCAl4qFIrn/V#*Pj(TcL~5rJ;+:Gs');
define('NONCE_SALT',       'TY>elR}xIlH,gXa?}MW}&W]KXHRg%Z2G(J?P^ZF7cA?t>rsrjCs-D5|E.PSac/e,');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
