<?php
/**
 * Main class of the plugin, responsible for starting it and enqueuing the necessary scripts
 * 
 * @since 16/05/2024
 * @author Gabriel Filippi
 */
class CDH_Internation_Telephone_Number_Main{
    private static $instance = null;

    public static function get_instance() {
        if (null == self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'cdh_intl_enqueue_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'cdh_intl_enqueue_scripts'));
    }

    public function cdh_intl_enqueue_scripts() {
        wp_enqueue_style('cdh-intl-tel-input-css', plugins_url('../assets/intl-tel-input/css/intlTelInput.min.css', __FILE__), array(), CDH_INTL_TEL_INPUT_FRAMEWORK_VERSION);
        
        wp_enqueue_script('cdh-intl-tel-input-utils', plugins_url('../assets/intl-tel-input/js/utils.min.js', __FILE__), array('jquery'), CDH_INTL_TEL_INPUT_FRAMEWORK_VERSION, true);
        wp_enqueue_script('cdh-intl-tel-input', plugins_url('../assets/intl-tel-input/js/intlTelInput.min.js', __FILE__), array('jquery', 'cdh-intl-tel-input-utils'), CDH_INTL_TEL_INPUT_FRAMEWORK_VERSION, true);
        wp_enqueue_script_module('cdh-intl-tel-input-intances', plugins_url('../assets/js/cdh-int-tel.min.js', __FILE__), array('jquery', 'cdh-intl-tel-input-utils', 'cdh-intl-tel-input'), CDH_INTL_TEL_INPUT_PLUGIN_VERSION, true);

        if (is_account_page()) {
            // Enfileira o script apenas na página 'Minha Conta'
            wp_enqueue_script('cdh-intl-tel-input-myaccount-validation',  plugins_url('../assets/js/cdh-int-tel-woo-my-account-validation.min.js', __FILE__), array(), CDH_INTL_TEL_INPUT_PLUGIN_VERSION, true);
        }
    }

}
