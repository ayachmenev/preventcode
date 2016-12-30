<?php if( ! defined( 'ABSPATH' ) ) exit; // Prevent direct access to the file 
/**
 * LanaWooCommerce Class
 * ---------------------
 * @since 1.0.0
 */
if( ! class_exists( 'LanaWooCommerce' ) && class_exists( 'Woocommerce' ) ) {
	class LanaWooCommerce {
		
		/**
		 * Class Constructor
		 * -----------------
		 * @since 1.0.0
		 */
		function __construct() {
			
			// Remove WooCommerce Shop Page Title
			add_filter( 'woocommerce_show_page_title', '__return_false' );
			
			// Remove WooCommerce Breadcrumb
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
			
			// Unhook WooCommerce Wrappers
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
			
			// Hook Lana Theme Wrappers
			add_action('woocommerce_before_main_content', array( $this, 'wrapper_start' ), 10);
			add_action('woocommerce_after_main_content', array( $this, 'wrapper_end' ), 10);
			
		}
		
		/**
		 * Wrapper Start
		 * -------------
		 * @since 1.0.0
		 */
		function wrapper_start() {
			$HTML  = '<div id="main" class="col-sm-8 col-md-9">';
			$HTML .= '<div class="page">';
			$HTML .= '<div class="post-content">';
			$HTML .= '<div class="blog-infinite">';
			echo $HTML;
		}
		
		/**
		 * Wrapper End
		 * -----------
		 * @since 1.0.0
		 */
		function wrapper_end() {
			$HTML  = '</div>';
			$HTML .= '</div>';
			$HTML .= '</div>';
			$HTML .= '</div>';
			echo $HTML;
		}
	}
	new LanaWooCommerce;
}