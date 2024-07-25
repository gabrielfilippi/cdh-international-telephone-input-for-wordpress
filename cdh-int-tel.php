<?php
/**
 * Plugin Name: CodeHive - International Telephone Number for Wordpress
 * Plugin URI: https://github.com/gabrielfilippi/cdh-International-Telephone-Input-for-Wordpress/
 * Description: Adiciona suporte para telefones internacionais nos campos de telefone do WordPress e WooCommerce usando a biblioteca "International Telephone Input".S
 * Version: 1.0.3
 * Author: CodeHive
 * Author URI: https://codehive.com.br
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: cdh_intl_tel
 * Requires at least: 4.0
 * Tested up to: 6.0
 * WC requires at least: 3.0
 * WC tested up to: 6.8
 * 
 * @package CodeHive - International Telephone Number for Wordpress
 * @category Core
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define plugin path
define('CDH_INTL_TEL_INPUT_PATH', plugin_dir_path(__FILE__));
define('CDH_INTL_TEL_INPUT_FRAMEWORK_VERSION', "23.0.4");
define('CDH_INTL_TEL_INPUT_PLUGIN_VERSION', "1.0.1");

// Include necessary files
include_once CDH_INTL_TEL_INPUT_PATH . 'includes/class-cdh-intl-main.php';
include_once CDH_INTL_TEL_INPUT_PATH . 'includes/class-cdh-intl-fields.php';

// Initialize the plugin
function cdh_intl_tel_init_plugin() {
    
    if (class_exists('CDH_Internation_Telephone_Number_Main')) {
        CDH_Internation_Telephone_Number_Main::get_instance();
    }
}
add_action('plugins_loaded', 'cdh_intl_tel_init_plugin');