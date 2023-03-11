<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://https://webtechsofts.com/
 * @since      1.0.0
 *
 * @package    Products_Orders_Export
 * @subpackage Products_Orders_Export/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Products_Orders_Export
 * @subpackage Products_Orders_Export/public
 * @author     Web Tech Softs <info@webtechsofts.com>
 */
class Orders_Api_Details {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->namespace = 'orders';
        $this->rest_base = 'get';

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Products_Orders_Export_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Products_Orders_Export_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/products-orders-export-public.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Products_Orders_Export_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Products_Orders_Export_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/products-orders-export-public.js', array( 'jquery' ), $this->version, false );

    }

    public function register_routes() {
        register_rest_route( $this->namespace, '/' . $this->rest_base, array(
            array(
                'methods'  => WP_REST_Server::READABLE,
                'callback' => array( $this, 'get_all_order_details' ),
            )
        ) );
    }

    function get_all_order_details(){
        $query = new WC_Order_Query( array(
            'limit' => -1,
        ) );
        $orders = $query->get_orders();
        $data = array();
        foreach ($orders as $order) {
            $order_id = $order->get_id();
            $order_number = $order->get_order_number();
            $order_total = $order->get_total();
            $order_status = $order->get_status();
            $billing_first_name = $order->get_billing_first_name();
            $billing_last_name = $order->get_billing_last_name();
            $billing_email = $order->get_billing_email();
            $billing_phone = $order->get_billing_phone();

            $order_data = array(
                'order_id' => $order_id,
                'order_number' => $order_number,
                'order_total' => $order_total,
                'order_status' => $order_status,
                'billing_first_name' => $billing_first_name,
                'billing_last_name' => $billing_last_name,
                'billing_email' => $billing_email,
                'billing_phone' => $billing_phone,
            );
            $data[] = $order_data;
        }
        return $data;
    }
}