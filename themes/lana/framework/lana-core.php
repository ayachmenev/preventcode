<?php
// Prevent direct access to the file
if( ! defined( 'ABSPATH' ) ) exit; 

/**
 * Lana Core
 *
 * @since 1.0.0
 */
if( ! class_exists( 'LanaCore' ) ) {
	class LanaCore {
		
		static private $instance = null;
		static private $version  = '1.0.7';
	
		/**
		 * Class Constructor
		 *
		 * @since 1.0.0
		 */
		private function __construct() {
			
			$this->defines(); // Initialize defines
			
			// Initialize Scripts 'n Styles
			add_action( 'wp_enqueue_scripts', array( $this, 'scriptsnstyles' ) );
			
		}
		
		/**
		 * Creates or returns an instance of this class.
		 *
		 * @since 1.0.0
		 */
		public static function get_instance() {
			if( null == self::$instance ) {
				self::$instance = new self;
			}
			
			return self::$instance;
		}
		
		/**
		 * Lana Defines
		 *
		 * @since 1.0.0
		 */
		private function defines() {
			if( ! defined( 'LANA_URI' ) ) {
				   define( 'LANA_URI', get_template_directory_uri() . '/' );
			}
			if( ! defined( 'LANA_DIR' ) ) {
				   define( 'LANA_DIR', get_template_directory() . '/' );
			}
			if( ! defined( 'LANA_FMW' ) ) {
				   define( 'LANA_FMW', LANA_DIR . 'framework/' );
			}
			if( ! defined( 'LANA_INC' ) ) {
				   define( 'LANA_INC', LANA_DIR . 'includes/' );
			}
			if( ! defined( 'LANA_CSS' ) ) {
				   define( 'LANA_CSS', LANA_URI . 'assets/css/' );
			}
			if( ! defined( 'LANA_CSS_MIN' ) ) {
				   define( 'LANA_CSS_MIN', LANA_URI . 'assets/css/min/' );
			}
			if( ! defined( 'LANA_JS' ) ) {
				   define( 'LANA_JS', LANA_URI . 'assets/js/' );
			}
			if( ! defined( 'LANA_JS_MIN' ) ) {
				   define( 'LANA_JS_MIN', LANA_URI . 'assets/js/min/' );
			}
			if( ! defined( 'LANA_IMG' ) ) {
				   define( 'LANA_IMG', LANA_URI . 'assets/img/' );
			}
		}
		
		/**
		 * Load Lana Scripts 'n Styles
		 *
		 * @since 1.0.0
		 */
		public function scriptsnstyles() {
			global $wp_styles, $wp_scripts;
			
			// Load latest jQuery
			wp_enqueue_script( 'jquery' );
			
			// Bootstrap v3.3.6
			wp_register_script( 'bootstrap', LANA_JS_MIN . 'bootstrap.min.js', array(), '3.3.6' );
			wp_enqueue_script( 'bootstrap' );
			
			// Waypoints
			wp_register_script( 'lana-waypoints', LANA_JS_MIN . 'jquery.waypoints.min.js', array(), '4.0.0' );
			wp_enqueue_script( 'lana-waypoints' );
			
			// CountTo
			wp_register_script( 'lana-countTo', LANA_JS_MIN . 'jquery.countTo.min.js', array(), Lana::version() );
			wp_enqueue_script( 'lana-countTo' );
			
			// Load "Lato" Google Font
			wp_register_style( 'lato', esc_url( '//fonts.googleapis.com/css?family=Lato:300,400,700' ) );
			wp_enqueue_style( 'lato' );
			
			// Load "Dancing Script" Font
			wp_register_style( 'DancingScript', esc_url( '//fonts.googleapis.com/css?family=Dancing+Script:400,700' ) );
			wp_enqueue_style( 'DancingScript' );
			
			/*
			 * Adds JavaScript to pages with the comment form to support
			 * sites with threaded comments (when in use).
			 */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );
			
			// Load Bootstrap Stylesheet
			wp_register_style( 'bootstrap', LANA_CSS_MIN . 'bootstrap.min.css', array(), '3.3.6' );
			wp_enqueue_style( 'bootstrap' );
			
			// Load FontAwesome Stylesheet
			wp_register_style( 'fontawesome', LANA_CSS_MIN . 'font-awesome.min.css', array(), '4.5.0' );
			wp_enqueue_style( 'fontawesome' );
			
			// Load Animate Stylesheet
			wp_register_style( 'animate', LANA_CSS_MIN . 'animate.min.css', array(), '3.5.0' );
			wp_enqueue_style( 'animate' );
			
			// Load Main Lana Stylesheet
			wp_register_style( 'lana-style', get_stylesheet_uri(), array(), self::$version );
			wp_enqueue_style( 'lana-style' );
			
			// Load Lana Responsive Stylesheet
			wp_register_style( 'lana-responsive', LANA_CSS . 'responsive.css', array(), self::$version );
			wp_enqueue_style( 'lana-responsive' );
			
			// Load Internet Explorer Related Stylesheet
			wp_enqueue_style( 'lana-ie', LANA_CSS_MIN . 'ie.css', array(), self::$version );
			$wp_styles->add_data( 'lana-ie', 'conditional', 'lte IE 9' );
			
			// jQuery Easing
			wp_register_script( 'lana-easing', LANA_JS_MIN . 'jquery.easing.min.js', array(), '1.3' );
			wp_enqueue_script( 'lana-easing' );
			
			// HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries
			wp_enqueue_script( 'html5', LANA_JS_MIN . 'html5.min.js', array(), '3.7.0' );
			wp_enqueue_script( 'respond', LANA_JS_MIN . 'respond.min.js', array(), self::$version );
			$wp_scripts->add_data( 'html5', 'conditional', 'lt IE 9' );
			$wp_scripts->add_data( 'respond', 'conditional', 'lt IE 9' );
			
			if( get_theme_mod( 'lana_slider_enable', true ) ) {
				wp_register_style( 'owl-carousel', LANA_CSS_MIN . 'owl.carousel.min.css', array(), '2.0.0' );
				wp_enqueue_style( 'owl-carousel' );
				
				wp_register_script( 'owl-carousel', LANA_JS_MIN . 'owl.carousel.min.js', array('jquery'), '2.0.0' );
				wp_enqueue_script( 'owl-carousel' );
			}
			
			// Load Lana Functions in Footer
			wp_register_script( 'lana-functions', LANA_JS . 'functions.js', array(), self::$version, true );
			$functions_localization = array(
				'is_admin_bar_showing'		=> esc_attr( is_admin_bar_showing() ),
				'sticky_header'				=> esc_attr( get_theme_mod( 'lana_sticky_header', true ) ),
				'primary_color'				=> esc_attr( get_theme_mod( 'lana_primary_color', '#F7655C' ) ),
				'slider_height'				=> esc_attr( get_theme_mod( 'lana_slider_height', '550' ) ),
				'slider_time'				=> esc_attr( get_theme_mod( 'lana_slider_time', '7000' ) ),
				'slider_loader'				=> esc_attr( get_theme_mod( 'lana_slider_loader', 'pie' ) ),
				'slider_loader_position'	=> esc_attr( get_theme_mod( 'lana_slider_loader_position', 'bottom' ) ),
				'slider_navigation'			=> esc_attr( get_theme_mod( 'lana_slider_navigation', true ) ),
				'slider_navigation_hover'	=> esc_attr( get_theme_mod( 'lana_slider_navigation_hover', true ) ),
				'slider_fx'					=> esc_attr( get_theme_mod( 'lana_slider_fx', 'random' ) ),
				'slider_pause'				=> esc_attr( get_theme_mod( 'lana_slider_pause', false ) ),
				'slide_1_enable'			=> esc_attr( get_theme_mod( 'lana_slide_1_enable', true ) ),
				'slide_2_enable'			=> esc_attr( get_theme_mod( 'lana_slide_2_enable', true ) )
			);
			wp_localize_script( 'lana-functions', 'lana', $functions_localization );
			wp_enqueue_script( 'lana-functions' );
			
		}
		
		/**
		 * Return Lana Version
		 *
		 * @since 1.0.0
		 */
		public static function version() {
			return self::$version;
		}
	}
	LanaCore::get_instance();
}