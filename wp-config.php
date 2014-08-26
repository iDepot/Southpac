<?php
/**\
 * The base configurations of the WordPress.\
 *\
 * This file has the following configurations: MySQL settings, Table Prefix,\
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information\
 * by visiting \{@link http://codex.wordpress.org/Editing_wp-config.php Editing\
 * wp-config.php\} Codex page. You can get the MySQL settings from your web host.\
 *\
 * This file is used by the wp-config.php creation script during the\
 * installation. You don't have to use the web site, you can just copy this file\
 * to "wp-config.php" and fill in the values.\
 *\
 * @package WordPress
 * @subpackage southpac_service
 * @since Southpac Services 1.0
 */

define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', 'C:\XAMPP\htdocs\Southpac\wp-content\plugins\wp-super-cache/' ); //Added by WP-Cache Manager
//define( 'WPCACHEHOME', '/var/www/html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define('DB_NAME', 'southpac');

/** MySQL database username */\
define('DB_USER', 'root');
//define('DB_USER', 'southpac');

/** MySQL database password */\
define('DB_PASSWORD','');
//define('DB_PASSWORD', 'Mysql2014');

/** MySQL hostname */\
    define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */\
    define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */\
    define('DB_COLLATE', '');

/**#@+\
 * Authentication Unique Keys and Salts.\
 *\
 * Change these to different unique phrases!\
 * You can generate these using the \{@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service\}\
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.\
 *\
 * @since 2.6.0\
 */
define('AUTH_KEY',	   '<u(X4cu08<X7o^@*z9c-]=R;oB@mvCPn#58f`K8K\{J-D$/`[\{dC9@:Gmdt=* 00!');
define('SECURE_AUTH_KEY',  '+y#Aeh+NTULM=%FL\{yK[>@\}F\}5M]K*l\{2-|beQ@$lrd_Qy<D_5k.CilK!va89mAc');
define('LOGGED_IN_KEY',    '!^VDi|k=@*ey.YLQ.][8X;t9A)xo!v0vbYx390jElLhxq5F(b3APn%ue%&:]/+nu');
define('NONCE_KEY',	   ' hx#!C;M-u\{T.e+;yfL\}QRV6v#DhE]IEY>^~m,[tVzxx^x?>g3 7)n8s\}50cIu#$');
define('AUTH_SALT',	   'x`1I&,|\}8WCF+Y*Td-fQ-#]E#nvgMG1N,*OY7D]sP,!/ko`-|+cq9Qv#fY$v*)4@');
define('SECURE_AUTH_SALT', '/$4-Qb69p\}u6RHE+bT0so%ENV~y#6|c\}c9S?IFVn#v1P<4-G.dCuF$[x>hZL2Sb~');
define('LOGGED_IN_SALT',   'Xw=NRb?X^8;m-B(`o5|k-ky9I\{M!Ia`8GW2rU$a8lr5/9oshDRr2SheNF29Oi,T/');
define('NONCE_SALT',	   ' 6ODz&K38(dv\{(5<ct5i+W&Hc=|+Wq3X>j32 x!o-(nT?gj)7-5\{+u7A,8H+PW2t');

/**#@-*/

/**
 * WordPress Database Table prefix.\
 *\
 * You can have multiple installations in one database if you give each a unique\
 * prefix. Only numbers, letters, and underscores please!\
 */
$table_prefix  = 'sp_';

/**\
 * WordPress Localized Language, defaults to English.\
 *\
 * Change this to localize WordPress. A corresponding MO file for the chosen\
 * language must be installed to wp-content/languages. For example, install\
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German\
 * language support.\
 */\

define('WPLANG', '');

/**\
 * For developers: WordPress debugging mode.\
 *\
 * Change this to true to enable the display of notices during development.\
 * It is strongly recommended that plugin and theme developers use WP_DEBUG\
 * in their development environments.\
 */\
    define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

?>
