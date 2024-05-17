<?php
/**
 * Class responsible for adding the classes responsible for the telephone fields, these classes when perceived by the JavaScript code are used 
 * to instantiate the telephone fields. The class is also responsible for saving the values ​​of the fields in the data bank.
 * 
 * @since 16/05/2024
 * @author Gabriel Filippi
 */
class CDH_International_Telephone_Number_Fields {

    public function __construct() {
        add_filter('woocommerce_billing_fields', array($this, 'cdh_intl_customize_billing_phone_field'), PHP_INT_MAX, 1 );
        add_filter('woocommerce_shipping_fields', array($this, 'cdh_intl_customize_shipping_phone_field'), PHP_INT_MAX, 1 );

        add_action('woocommerce_checkout_update_order_meta', array($this, 'cdh_intl_save_order_phone_fields'), PHP_INT_MAX);
        add_action('woocommerce_customer_save_address', array($this, 'cdh_intl_save_account_address_fields'), PHP_INT_MAX, 2);
    }

    /**
     * We have modified the Billing fields so that it is now possible to install the fields in JavaScript
     * 
     * @since 16/05/2024
     * @author Gabriel Filippi
     */
    public function cdh_intl_customize_billing_phone_field($fields) {
        if (isset($fields['billing_phone'])) {
            $fields['billing_phone']['class'][] = 'phone-number-group';
            $fields['billing_phone']['input_class'][] = 'cdh-intl-tel';
            $fields['billing_phone']['custom_attributes'] = array('type' => 'tel');
        }

        if (isset($fields['billing_cellphone'])) {
            $fields['billing_cellphone']['class'][] = 'phone-number-group';
            $fields['billing_cellphone']['input_class'][] = 'cdh-intl-tel';
            $fields['billing_cellphone']['custom_attributes'] = array('type' => 'tel');
        }
        
        /**
         * If the user has custom phone fields, simply define the constant in wp_config with the names of each custom field so that it can be 
         * instantiated in JavaScript.
         */
        if(defined("CDH_CUSTOM_BILLING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS")){
            $custom_fields_arr = CDH_CUSTOM_BILLING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS;

            foreach ($custom_fields_arr as $key => $value) {
                if(isset($fields[$key])){
                    $fields[$key]['class'][] = 'phone-number-group';
                    $fields[$key]['input_class'][] = 'cdh-intl-tel';
                    $fields[$key]['custom_attributes'] = array('type' => 'tel');
                }
            }

        }

        return $fields;
    }

    /**
     * We have modified the Shipping fields so that it is now possible to install the fields in JavaScript
     * 
     * @since 16/05/2024
     * @author Gabriel Filippi
     */
    public function cdh_intl_customize_shipping_phone_field($fields) {
        if (isset($fields['shipping_phone'])) {
            $fields['shipping_phone']['class'][] = 'phone-number-group';
            $fields['shipping_phone']['input_class'][] = 'cdh-intl-tel';
            $fields['shipping_phone']['custom_attributes'] = array('type' => 'tel');
        }

        if (isset($fields['shipping_cellphone'])) {
            $fields['shipping_cellphone']['class'][] = 'phone-number-group';
            $fields['shipping_cellphone']['input_class'][] = 'cdh-intl-tel';
            $fields['shipping_cellphone']['custom_attributes'] = array('type' => 'tel');
        }
        
        /**
         * If the user has custom phone fields, simply define the constant in wp_config with the names of each custom field so that it can be 
         * instantiated in JavaScript.
         */
        if(defined("CDH_CUSTOM_SHIPPING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS")){
            $custom_fields_arr = CDH_CUSTOM_SHIPPING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS;
            
            foreach ($custom_fields_arr as $key) {
                if(isset($fields[$key])){
                    $fields[$key]['class'][] = 'phone-number-group';
                    $fields[$key]['input_class'][] = 'cdh-intl-tel';
                    $fields[$key]['custom_attributes'] = array('type' => 'tel');
                }
            }

        }
        
        return $fields;
    }

    /**
     * When save order, this function is responsible for saving the complete (international) value of each telephone number, ]
     * overwriting the national value of each field.
     */
    public function cdh_intl_save_order_phone_fields($order_id) {
        /**
         * Woocommerce billing default fields
         */
        if (isset($_POST["billing_phone_full_number"]) && !empty($_POST['billing_phone_full_number'])) {
            update_post_meta($order_id, '_billing_phone', sanitize_text_field($_POST['billing_phone_full_number']));
        }

        if (isset($_POST["billing_cellphone_full_number"]) && !empty($_POST['billing_cellphone_full_number'])) {
            update_post_meta($order_id, '_billing_cellphone', sanitize_text_field($_POST['billing_cellphone_full_number']));
        }

        /**
         * Woocommerce shipping default fields
         */
        if (isset($_POST["shipping_phone_full_number"]) && !empty($_POST['shipping_phone_full_number'])) {
            update_post_meta($order_id, '_shipping_phone', sanitize_text_field($_POST['shipping_phone_full_number']));
        }

        if (isset($_POST["shipping_cellphone_full_number"]) && !empty($_POST['shipping_cellphone_full_number'])) {
            update_post_meta($order_id, '_shipping_cellphone', sanitize_text_field($_POST['shipping_cellphone_full_number']));
        }

        /**
         * Custom Woocommerce billing phones
         */
        if(defined("CDH_CUSTOM_BILLING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS")){
            $custom_fields_arr = CDH_CUSTOM_BILLING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS;
            
            foreach ($custom_fields_arr as $key) {
                if(isset($_POST[$key + "_full_number"]) && !empty($_POST[$key + "_full_number"])){
                    update_post_meta($order_id, $key, sanitize_text_field($_POST[$key + "_full_number"]));
                }
            }

        }

        /**
         * Custom Woocommerce shipping phones
         */
        if(defined("CDH_CUSTOM_SHIPPING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS")){
            $custom_fields_arr = CDH_CUSTOM_SHIPPING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS;
            
            foreach ($custom_fields_arr as $key) {
                if(isset($_POST[$key]) && !empty($_POST[$key])){
                    update_post_meta($order_id, $key, sanitize_text_field($_POST[$key . "_full_number"]));
                }
            }

        }
    }

    /**
     * When save account address, this function is responsible for saving the complete (international) value of each telephone number, ]
     * overwriting the national value of each field.
     */
    public function cdh_intl_save_account_address_fields($user_id, $load_address) {
        /**
         * Woocommerce billing default fields
         */
        if (isset($_POST["billing_phone_full_number"]) && $load_address === 'billing' && !empty($_POST['billing_phone_full_number'])) {
            update_user_meta($user_id, 'billing_phone', sanitize_text_field($_POST['billing_phone_full_number']));
        }

        if (isset($_POST["billing_cellphone_full_number"]) && $load_address === 'billing' && !empty($_POST['billing_cellphone_full_number'])) {
            update_user_meta($user_id, 'billing_cellphone', sanitize_text_field($_POST['billing_cellphone_full_number']));
        }

        /**
         * Woocommerce shipping default fields
         */
        if (isset($_POST["shipping_phone_full_number"]) && $load_address === 'shipping' && !empty($_POST['shipping_phone_full_number'])) {
            update_user_meta($user_id, 'shipping_phone', sanitize_text_field($_POST['shipping_phone_full_number']));
        }

        if (isset($_POST["shipping_cellphone_full_number"]) && $load_address === 'shipping' && !empty($_POST['shipping_cellphone_full_number'])) {
            update_user_meta($user_id, 'shipping_cellphone', sanitize_text_field($_POST['shipping_cellphone_full_number']));
        }

        /**
         * Custom Woocommerce billing phones
         */
        if(defined("CDH_CUSTOM_BILLING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS")){
            $custom_fields_arr = CDH_CUSTOM_BILLING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS;
            
            foreach ($custom_fields_arr as $key) {
                if(isset($_POST[$key + "_full_number"]) && $load_address === 'billing' && !empty($_POST[$key + "_full_number"])){
                    update_user_meta($user_id, $key, sanitize_text_field($_POST[$key + "_full_number"]));
                }
            }

        }

        /**
         * Custom Woocommerce shipping phones
         */
        if(defined("CDH_CUSTOM_SHIPPING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS")){
            $custom_fields_arr = CDH_CUSTOM_SHIPPING_INTERNATIONAL_TALEPHONE_NUMBER_FIELDS;
            
            foreach ($custom_fields_arr as $key) {
                if(isset($_POST[$key]) && $load_address === 'shipping' && !empty($_POST[$key])){
                    update_user_meta($user_id, $key, sanitize_text_field($_POST[$key . "_full_number"]));
                }
            }

        }
    }

}

new CDH_International_Telephone_Number_Fields();
