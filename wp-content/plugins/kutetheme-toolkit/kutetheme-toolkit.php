<?php
/*
  Plugin Name: Kutetheme toolkit
  Plugin URI: http://kutethemes.com/demo/kuteshop/
  Description: A Toolkit for Kute theme
  Author: AngelsIT
  Version: 1.0.0
  Author URI: http://kutethemes.com/demo/kuteshop/
 */
define("KUTETHEME_PLUGIN_PATH", trailingslashit( plugin_dir_path(__FILE__) ) );
define("KUTETHEME_PLUGIN_URL", trailingslashit( plugin_dir_url(__FILE__) ) );
if( ! defined('THEME_LANG')){
    define('THEME_LANG', 'kutetheme');
}
//Mailchimp
//require_once KUTETHEME_PLUGIN_PATH.'mailchimp/mailchimp.php';

//CMB2
require_once KUTETHEME_PLUGIN_PATH .'cmb2/init.php';
require_once KUTETHEME_PLUGIN_PATH .'cmb2/kt_header_field_type.php';
require_once KUTETHEME_PLUGIN_PATH .'cmb2/kt_page_field_type.php';
require_once KUTETHEME_PLUGIN_PATH.'option_post_type.php';
require_once KUTETHEME_PLUGIN_PATH .'cmb2/admin.php';

// Woocommerce products filter
require_once KUTETHEME_PLUGIN_PATH.'woocommerce-products-filter/index.php';

// Post types
require_once KUTETHEME_PLUGIN_PATH.'post-types/post-types.php';

//Shortcodes
require_once KUTETHEME_PLUGIN_PATH.'shortcodes.php';