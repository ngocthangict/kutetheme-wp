<?php
/*
  Plugin Name: Kutetheme toolkit
  Plugin URI: http://kutethemes.com/demo/kuteshop/
  Description: A Toolkit for Kute theme
  Author: AngelsIT
  Version: 1.0.0
  Author URI: http://kutethemes.com/demo/kuteshop/
 */

//Mailchimp
require_once trailingslashit( plugin_dir_path(__FILE__) ).'mailchimp/mailchimp.php';

// Woocommerce products filter
require_once trailingslashit( plugin_dir_path(__FILE__)).'woocommerce-products-filter/index.php';

// Post types
require_once trailingslashit( plugin_dir_path(__FILE__)).'post-types/post-types.php';

//Shortcodes
require_once trailingslashit( plugin_dir_path(__FILE__)).'shortcodes.php';