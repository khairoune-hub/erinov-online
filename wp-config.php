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
define( 'DB_NAME', 'wcanvcvwdr' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
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
define( 'AUTH_KEY',         'ehweyvregvorojgt3wmuzqozil9ujt3ntmvyfaehbgvftadqqc2oe1eshztbhuvh' );
define( 'SECURE_AUTH_KEY',  'xy5ko7siqepqg9ssmesesqquwmtafsh8mexs00lofdc4jlnflzuippffatntgqno' );
define( 'LOGGED_IN_KEY',    'sikx11lhi4peezwjlxv3iwxavxjpaogygtmkoleuyxg3occ5nrvgvrpclnfebpk0' );
define( 'NONCE_KEY',        'ygz9cw4qw5monqr6hues61gsoysqzr1kr5fxcjuh5r3lqyli3kgfa4ks26iznhen' );
define( 'AUTH_SALT',        'tvkolgmj3hngdiegtzlkbcclbxkt2eqkibhped8rrozslgbvr1wsvwumxrnc1joc' );
define( 'SECURE_AUTH_SALT', 'v9zgzpdivwwlnhoznzqgoizh2fyej9eop3x8yvmos0w3lp1thpgwittpbjaszusl' );
define( 'LOGGED_IN_SALT',   'sxfkrzczfcleiolewa5r6dqv8p9nddsws0rbm9c6ovyb8qucmj1teqlxtkph21ky' );
define( 'NONCE_SALT',       'jkrsm8tdhfhetizax8zrbt93cmscxmqjphgcqlhbzvq3tkohzjeqqzswhtiwd6st' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp4v_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


define('WP_HOME', 'http://localhost/');
define('WP_SITEURL', 'http://localhost/');
