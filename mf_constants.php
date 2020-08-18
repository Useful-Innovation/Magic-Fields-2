<?php
global $wpdb, $blog_id;

//useful for get quickly the path for  images/javascript files and css files
//return something like: http://wordpress.local/wp-content/plugins/Magic-Fields/
define('MF_BASENAME', plugins_url() . '/' . str_replace(basename(__FILE__), "", plugin_basename(__FILE__)));
define('MF_URL', MF_BASENAME);

//return something like: /Users/user/sites/wordpres/wp-content/plugins/Magic-Fields
define("MF_PATH", dirname(__FILE__));

define("PHPTHUMB", MF_URL . "thirdparty/phpthumb/phpThumb.php");

define('MF_FILES_NAME', 'files_mf');
define('MF_CACHE_NAME', 'cache');
$multiPrefix = DS . 'sites' . DS . $blog_id;
if ($blog_id == 1) {
    $multiPrefix = '';
}
define('MF_FILES_DIR', WP_CONTENT_DIR . DS . 'uploads' . $multiPrefix . DS . MF_FILES_NAME . DS);
define('MF_FILES_URL', WP_CONTENT_URL . DS . 'uploads' . $multiPrefix . DS . MF_FILES_NAME . DS);

define('MF_CACHE_DIR', MF_FILES_DIR . MF_CACHE_NAME . DS);
define('MF_CACHE_URL', MF_FILES_URL . MF_CACHE_NAME . '/');

//detect if install MF on mode normal
if (mf_mu_alone()) {
    $mf_prefix = $wpdb->prefix;
} else {
    $mf_prefix = $wpdb->base_prefix;
}

define('MF_TABLE_POSTTYPES', $mf_prefix . 'mf_posttypes');
define('MF_TABLE_CUSTOM_TAXONOMY', $mf_prefix . 'mf_custom_taxonomy');
define('MF_TABLE_CUSTOM_FIELDS', $mf_prefix . 'mf_custom_fields');
define('MF_TABLE_CUSTOM_GROUPS', $mf_prefix . 'mf_custom_groups');
define('MF_TABLE_POST_META', $wpdb->prefix . 'mf_post_meta');

//define name for settings MF
define('MF_SETTINGS_KEY', 'mf_settings');
define('MF_DB_VERSION_KEY', 'mf_db_version');
define('MF_DB_VERSION', 3);