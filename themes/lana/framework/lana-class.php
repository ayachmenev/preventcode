<?php
// Prevent direct access to the file
if( ! defined( 'ABSPATH' ) ) exit;

/**
 * Lana Class
 *
 * @since 1.0.0
 */
if( ! class_exists( 'Lana' ) ) {
	class Lana {
		
		private static $instance = null;
		
		/**
		 * Class Constructor
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			
			add_filter( 'body_class', array( $this, 'body_class' ) );
			
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
		 * Body Class
		 *
		 * @since 1.0.4
		 */
		public function body_class( $classes ) {
			
			if( get_theme_mod( 'lana_layout_style', 'boxed' ) == 'fullwidth' ) {
				$classes[] = 'layout-fullwidth';
			} else {
				$classes[] = 'layout-boxed';
			}
			
			return $classes;
		}
		
		/**
		 * Theme Logo
		 *
		 * @since 1.0.2
		 */
		public static function logo() {
			if( function_exists( 'the_custom_logo' ) ) {
				the_custom_logo();
			}
		}
		
		/**
		 * Render Menus
		 *
		 * @since 1.0.0
		 */
		public static function menu( $args ) {
			extract( $args );
			
			$args = array(
				'theme_location'	=> $theme_location,
				'container' 		=> false,
				'menu_class'		=> $menu_class,
				'echo'				=> false,
			);
		
			$menu = wp_nav_menu( apply_filters( 'lana_nav_menu_args', $args ) );
			
			return $menu;
		} 
		
		/**
		 * Render Post Navigation
		 *
		 * @since 1.0.0
		 */
		static function post_navigation() {
			$prev_post = get_adjacent_post( false, '', false );
			$next_post = get_adjacent_post( false, '', true );
			
			if( is_a( $prev_post, 'WP_Post' ) && is_a( $next_post, 'WP_Post' ) )
				$class = 'col-xs-6';
			else
				$class = 'col-xs-12';
			
			$html  = '<div class="single-navigation block">';
			$html .= '<div class="row">';
			if( is_a( $prev_post, 'WP_Post' ) ) {
				$html .= '<!-- Previous Post -->';
				$html .= '<div class="' . $class . '">';
				$html .= '<a rel="prev" href="' . esc_url( get_permalink( $prev_post ) ) . '" class="button btn-large prev full-width">';
				$html .= '<i class="fa fa-long-arrow-left"></i> ';
				$html .= '<span>' . __( 'Prev Post', 'lana' ) . '</span>';
				$html .= '</a>';
				$html .= '</div><!-- Previous Post End -->';
			}
			if( is_a( $next_post, 'WP_Post' ) ) {
				$html .= '<!-- Next Post -->';
				$html .= '<div class="' . $class . '">';
				$html .= '<a rel="next" href="' . esc_url( get_permalink( $next_post ) ) . '" class="button btn-large next full-width">';
				$html .= '<span>' . __( 'Next Post', 'lana' ) . '</span> ';
				$html .= '<i class="fa fa-long-arrow-right"></i>';
				$html .= '</a>';
				$html .= '</div><!-- Next Post End -->';
			}
			$html .= '</div>';
			$html .= '</div><!-- Post Navigation End -->';
			
			return $html;
		}
		
		public static function not_found() { ?>
		<!-- NO POSTS FOUND -->
		<article id="post-0" class="not-found">
			<div class="post-content-wrapper">
			
				<div class="details">
					<h2 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'lana' ); ?></h2>
				</div>
				
				<div class="excerpt-container">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lana' ); ?></p>
				</div>
				
			</div>
		</article><!-- NO POSTS FOUND END -->
		<?php 
		}
		
		/**
		 * Return Lana Version
		 *
		 * @since 1.0.0
		 */
		static function version() {
			return LanaCore::version();
		}
		
		/**
		 * Social Icons
		 *
		 * @since 1.0.1
		 */
		static function social_icons() {
			$icons = array(
				'RSS'			=> esc_url( get_theme_mod( 'lana_social_rss', '' ) ),
				'Facebook'		=> esc_url( get_theme_mod( 'lana_social_facebook', '' ) ),
				'Twitter'		=> esc_url( get_theme_mod( 'lana_social_twitter', '' ) ),
				'GooglePlus'	=> esc_url( get_theme_mod( 'lana_social_googleplus', '' ) )
			);
			echo '<ul class="social-icons clearfix">';
				foreach( $icons as $name => $url ):
					if( ! empty( $url ) ):
						$fa_class = strtolower( $name );
						$fa_class = str_replace( 'googleplus', 'google-plus', $fa_class );
						echo '<li class="'. strtolower( $name ) .'"><a href="'. $url .'" title="'. $name .'"><i class="fa fa-'. $fa_class .'"></i></a></li>';
					endif;
				endforeach;
			echo '</ul>';
		}
		
		/**
		 * Get All Posts Categories
		 *
		 * @since 1.0.5
		 * @used in customizer
		 * @return array [cat_ID => cat_name]
		 */
		public static function get_post_categories() {
			$categories = get_categories();
			if( is_array( $categories ) ) {
				foreach( $categories as $category ) {
					$cat[$category->cat_ID] = $category->cat_name;
				}
				return $cat;
			}
			return array( null => __( 'No Category Found', 'lana' ) );
		}
		
		/**
		 * Get all Pages
		 *
		 * @since 1.0.5
		 * @used in customizer
		 * @return array [ID => post_title]
		 */
		public static function get_all_pages() {
			$pages = get_pages();
			foreach( $pages as $page ) {
				$output[$page->ID] = $page->post_title;
			}
			return $output;
		}
		
		/**
		 * Generate Bootstrap Class
		 *
		 * @since 1.0.7
		 */
		public static function bs_class() {
			if ( is_active_sidebar( 'lana-sidebar' ) ) {
				echo esc_attr( 'col-sm-8 col-md-9' );
			} else {
				echo esc_attr( 'col-md-12' );
			}
		}
	}
	Lana::get_instance();
}