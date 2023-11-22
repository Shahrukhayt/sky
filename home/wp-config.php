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
define( 'DB_NAME', 'dbvfey8xm4hmyc' );

/** MySQL database username */
define( 'DB_USER', 'ubxaxk4c6wpu5' );

/** MySQL database password */
define( 'DB_PASSWORD', 'bu4x53ddu3nd' );

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
define( 'AUTH_KEY',          '(rOY0&[sS1J5=Lbz9r4m(p>Rw}d(eV?fkb^N~xYnPfMY}gGuRZk@&$xFsOe.?vBT' );
define( 'SECURE_AUTH_KEY',   '|l{cM5rp{Vf$#aPH<,BluaO.v$<Zqv/GNMF.md<[^y+lWXQ)^/F3wrpPj!_xB`Up' );
define( 'LOGGED_IN_KEY',     'C&Zd&M{C:VRbs[N[ L,1k;v>]*eoS%(8{Yr3iU?qzOFv1S2>y$fFB1uV!pRwT[NE' );
define( 'NONCE_KEY',         '4cG5cEDB)LVAUg}|It(kRu><Qla&h!h?lRO-,){|><4E1iFA?)I|2,dFf{h7_6Gm' );
define( 'AUTH_SALT',         'N[MZy:fZhXl@?,(`>~QV%9Tqw:y/.`l%t}ek[7F*0wh9 ao:t8:[&r8&fpRy(?Wb' );
define( 'SECURE_AUTH_SALT',  'Q3WQ$X2oJ}om_ODxIf4FOPjoQl}H{tG>K^]BmCrEtxZc |@IQwEARSM`o,VK/Gh`' );
define( 'LOGGED_IN_SALT',    '{4[lhxj009-_pppN129+}u.nKu4B/=P#W(//0?q/XVb7m>j&rb.xGR2{FTuQ2)mV' );
define( 'NONCE_SALT',        ')>0)n:x^<&Rj<ugl_Lry,l2E|Dn]J37]N:ok67ywMj^v&W%;JUNw!!|RPzp<9m4a' );
define( 'WP_CACHE_KEY_SALT', '%^sw>6nE@IPq%VrZh7se[,2BJud_ AeV27]/K4%&`>4fpI:/Q4n/`tEi6^@nW<R ' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'yjf_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
