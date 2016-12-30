<?php
if( ! defined( 'ABSPATH' ) ) exit;
if( ! class_exists( 'LanaDynamicCSS' ) ) {
##########################################
# DYNAMMIC CSS | @since 1.0.1
##########################################
	class LanaDynamicCSS {
		
		/**
		 * Class Constructor
		 *
		 * @since 1.0.1
		 */
		function __construct() {
			
			add_action( 'wp_head', array( $this, 'render' ) );
			
		}
		
		/**
		 * Render CSS Output
		 *
		 * @since 1.0.1
		 */
		function render() {
			$output  = '<style id="lana-dynamic-css" type="text/css">';
			
				$output .= wp_strip_all_tags( get_theme_mod( 'lana_custom_css', '' ) );
			
			$output .= '</style>';
			echo $output;
		}
	}
	new LanaDynamicCSS;
}
