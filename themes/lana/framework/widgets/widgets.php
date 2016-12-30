<?php 
// Prevent direct access to the file
if( ! defined( 'ABSPATH' ) ) exit; 

/**
 * Register Widgets
 *
 * @since 1.0.0
 */
if( ! class_exists( 'LanaWidgets' ) ) {
	class LanaWidgets {
		
		private static $instance = null;
		
		/**
		 * Class Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			add_action( 'widgets_init', array( $this, 'init' ) );
		}
		
		/**
		 * Creates or Returns an Instance of this Class
		 *
		 * @since 1.0.0
		 */
		public static function get_instance() {
			if( null == self::$instance ) {
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		function init() {
			register_sidebar( array(
				'name'			=> __( 'Main Sidebar', 'lana' ),
				'id'			=> 'lana-sidebar',
				'description'	=> __( 'Main Lana Theme Sidebar', 'lana' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'	=> '</aside>',
				'before_title' 	=> '<h4 class="widget-title">',
				'after_title'	=> '</h4>'
			) );
			register_sidebar( array(
				'name'			=> __( 'Footer Widget Area 1', 'lana' ), 
				'id'			=> 'lana-footer-1', 
				'before_widget'	=> '<aside id="%1$s" class="widget %2$s">', 
				'after_widget'	=> '</aside>',
				'before_title' 	=> '<h2 class="widget-title">', 
				'after_title'	=> '</h2>'
			) );
			register_sidebar( array(
				'name'			=> __( 'Footer Widget Area 2', 'lana' ), 
				'id'			=> 'lana-footer-2', 
				'before_widget'	=> '<aside id="%1$s" class="widget %2$s">', 
				'after_widget'	=> '</aside>',
				'before_title' 	=> '<h2 class="widget-title">', 
				'after_title'	=> '</h2>'
			) );
			register_sidebar( array(
				'name'			=> __( 'Footer Widget Area 3', 'lana' ), 
				'id'			=> 'lana-footer-3', 
				'before_widget'	=> '<aside id="%1$s" class="widget %2$s">', 
				'after_widget'	=> '</aside>',
				'before_title' 	=> '<h2 class="widget-title">', 
				'after_title'	=> '</h2>'
			) );
			register_sidebar( array(
				'name'			=> __( 'Footer Widget Area 4', 'lana' ), 
				'id'			=> 'lana-footer-4', 
				'before_widget'	=> '<aside id="%1$s" class="widget %2$s">', 
				'after_widget'	=> '</aside>',
				'before_title' 	=> '<h2 class="widget-title">', 
				'after_title'	=> '</h2>'
			) );
		}
	}
	LanaWidgets::get_instance();
}