<?php
// ================================================================
// Define server environment based on which config file is in place
// ================================================================
define( 'DB_CREDENTIALS_PATH', dirname( ABSPATH ) . '/config' ); // cache it for multiple use
define( 'WP_LOCAL_SERVER', file_exists( DB_CREDENTIALS_PATH . '/local-config.php' ) );
define( 'WP_DEV_SERVER', file_exists( DB_CREDENTIALS_PATH . '/dev-config.php' ) );
define( 'WP_STAGING_SERVER', file_exists( DB_CREDENTIALS_PATH . '/staging-config.php' ) );
// ================================================================
// Load DB credentials
// ================================================================
if ( WP_LOCAL_SERVER )
    require DB_CREDENTIALS_PATH . '/local-config.php';
elseif ( WP_DEV_SERVER )
    require DB_CREDENTIALS_PATH . '/dev-config.php';
elseif ( WP_STAGING_SERVER )
    require DB_CREDENTIALS_PATH . '/staging-config.php';
else
    require DB_CREDENTIALS_PATH . '/production-config.php';
// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');
// =====================================================
// Table prefix
// Change this if multiple installs in the same database
// =====================================================
$table_prefix  = 'wp_';
// ================================
// Language
// Leave blank for American English
// ================================
define( 'WPLANG', '' );
// =======================================================
// Control debug mode and bug logging based on environment
// =======================================================
if ( WP_LOCAL_SERVER || WP_DEV_SERVER ) {
    define( 'WP_DEBUG', true );
    define( 'WP_DEBUG_LOG', true ); // Stored in wp-content/debug.log
    define( 'WP_DEBUG_DISPLAY', true );
    define( 'SCRIPT_DEBUG', true );
    define( 'SAVEQUERIES', true );
} else if ( WP_STAGING_SERVER ) {
    define( 'WP_DEBUG', true );
    define( 'WP_DEBUG_LOG', true ); // Stored in wp-content/debug.log
    define( 'WP_DEBUG_DISPLAY', false );
} else {
    define( 'WP_DEBUG', false );
}
// ========================
// Custom Content Directory
// ========================
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/apps' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/apps' );
// ==========================
// Move the uploads directory
// ==========================
define( 'UPLOADS', '/uploads' );
// =============================
// Manually define site location
// =============================
// define('WP_SITEURL', 'http://example.com');
// define('WP_HOME', 'http://example.com');
// ===========================
// Miscellaneous handy options
// ===========================
// Increase PHP memory limit
define('WP_MEMORY_LIMIT', '64M');
// Modify AutoSave Interval (default is 60 seconds) 
define('AUTOSAVE_INTERVAL', 180 );
// Limit post revision history 
define('WP_POST_REVISIONS', 3);
// Empty trash more frequently (30 day default) 
define('EMPTY_TRASH_DAYS', 15 );
// Enable trash for media items
define('MEDIA_TRASH', true);
// Disable theme/plugin file editing 
define('DISALLOW_FILE_EDIT', true);
// Disable plugin and theme update and installation 
define('DISALLOW_FILE_MODS',true);
// Disable all automatic updates for minor releases
define( 'AUTOMATIC_UPDATER_DISABLED', false );
// Disable all automatic updates for major releases
define( 'WP_AUTO_UPDATE_CORE', false );
// Set cookie domain - The domain set in the cookies for WordPress can be specified for those with unusual domain setups. One reason is if subdomains are used to serve static content. To prevent WordPress cookies from being sent with each request to static content on your subdomain you can set the cookie domain to the non-static domain only. 
# define('COOKIE_DOMAIN', 'www.example.com');
// ======================================
// Load a Memcached config if we have one
// ======================================
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) )
    $memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );
// ===================
// Bootstrap WordPress
// ===================
// Absolute path to the WordPress directory
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');
// Sets up WordPress vars and included files
require_once(ABSPATH . 'wp-settings.php');