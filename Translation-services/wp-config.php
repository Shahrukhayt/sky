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
define( 'DB_NAME', 'dbuw2aqzyh3mp4' );

/** MySQL database username */
define( 'DB_USER', 'us3gxzbdepftp' );

/** MySQL database password */
define( 'DB_PASSWORD', '7rvtpkcbysje' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'IdZ8=L3Qdlf|Dk7JvPQsce5g&`SPHuwtO&:zh2jz^.e}.lWisGzK(3}W&RraSDLJ' );
define( 'SECURE_AUTH_KEY',   'InW,|zqM02Z3l-Q,cZ<UI_}+He5S$#^N0%5e5spZP1zw/6K1,-#eFvzaK?jE@bu.' );
define( 'LOGGED_IN_KEY',     ' %&B^!qY)muu2y4mmJ}Xq9iV76i7.}u)`!|grLVDH8]HyI,&81TOc!curX<afBd2' );
define( 'NONCE_KEY',         'KZ]Hib*Z/ZJEG.Vxnm0(_1{({GCjXC>6}*P8If|CQsboDM.)v~8 7Xa@0]E-:rl>' );
define( 'AUTH_SALT',         ')?#2CON4)wdIQTfazy|b2w[okQ,5f#8%$8m yT`M!u!*]kk!Ju8r]DQ}py[ESnPE' );
define( 'SECURE_AUTH_SALT',  '2PRDCS)AfVng=]H8{,2cIilTp:ZjVB_QES<umvzNCgG,rPYpM>.I%0]<j3ajbHTI' );
define( 'LOGGED_IN_SALT',    's,W48<!U#[Zqg0NuCY kEAg&hc3Q]bb~yQEwtaP3+ingKc0>BdS>3*o5Y73pye8d' );
define( 'NONCE_SALT',        'bT(w3qsN6gq/h[vz)yRd:`(?NEf10Q7d]]c%r5qd*F/&?!AL0NetXqOKag mg&J9' );
define( 'WP_CACHE_KEY_SALT', 'sB22e?1Jy-pK:x`eJgizJAM H7Rh{[$Us#0135fNPeMiYoNEA]ibKPlbo}%^.96y' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'phe_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
