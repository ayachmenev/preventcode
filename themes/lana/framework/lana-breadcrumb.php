<?php if( ! defined( 'ABSPATH' ) ) exit; // Prevent direct access to the file 
/**
 * Render Breadcrumb
 *
 * @since 1.0.0
 */
add_action( 'lana_breadcrumb', 'lana_render_breadcrumb' );
if( ! function_exists( 'lana_render_breadcrumb' ) ) {
	function lana_render_breadcrumb() {
		global $post;
		if( get_theme_mod( 'lana_breadcrumb', true ) ) {
			$h2 = '';
			$marker = '';
			$output = '';

			if( is_single() ) {
				$h2 	= sprintf( '<h2 class="entry-title">%s</h2>', $post->post_title );
				$marker = sprintf( '<li><a href="' . esc_url( get_permalink() ) . '">%s</a></li>', __( 'Single', 'lana' ) );
				$output = sprintf( '<li class="active">%s</li>', $post->post_title );
			}
			
			if( is_page() ) {
				$h2 	= sprintf( '<h2 class="entry-title">%s</h2>', $post->post_title );
				$marker = sprintf( '<li><a href="' . esc_url( get_permalink() ) . '">%s</a></li>', __( 'Page', 'lana' ) );
				$output = sprintf( '<li class="active">%s</li>', $post->post_title );
			}
			
			if( is_archive() ) {
				$marker = sprintf( '<li><a href="' . get_post_type_archive_link( false ) . '">%s</a><li>', __( 'Archive', 'lana' ) );
				
				if ( is_day() ) :
					$h2 	= sprintf( '<h2 class="entry-title">%s</h2>', __( 'Daily Archives', 'lana' ) );
					$output	= sprintf( '<li class="active">%s</li>', get_the_date() );
				elseif ( is_month() ) :
					$h2 	= sprintf( '<h2 class="entry-title">%s</h2>', __( 'Monthly Archives', 'lana' ) );
					$output	= sprintf( '<li class="active">%s</li>', get_the_date( _x( 'F Y', 'monthly archives date format', 'lana' ) ) );
				elseif ( is_year() ) :
					$h2		= sprintf( '<h2 class="entry-title">%s</h2>', __( 'Yearly Archives', 'lana' ) );
					$output	= sprintf( '<li class="active">%s</li>', get_the_date( _x( 'Y', 'yearly archives date format', 'lana' ) ) );
				endif;
			}
			
			if( is_category() ) {
				$span = '';
				
				if( category_description() ) {
					$cat_desc 	= strip_tags( category_description() );
					$span		= sprintf( '<span>%s</span>', $cat_desc );
				}
				
				$marker = sprintf( '<li><a href="' . get_category_link( false ) . '">%s</a></li>', __( 'Category', 'lana' ) );
				
				$category	= get_the_category();
				$cat_ID		= $category[0]->cat_ID;
				$h2			= sprintf( '<h2 class="entry-title">%s</h2>', ucfirst( single_cat_title( '', false ) ) ) . $span;
				$output		= sprintf( '<li class="active">%s</li>', single_cat_title( '', false ) );
			}
			
			
			if( is_tag() ) {
				$h2		= sprintf( '<h2 class="entry-title">%s</h2>', __( 'Tag', 'lana' ) );
				$marker = sprintf( '<li><a href="#">%s</a></li>', __( 'Tag', 'lana' ) );
				$output	= sprintf( '<li class="active">%s</li>', single_tag_title('', false) );
			}
			
			if( is_404() ) {
				$h2		= sprintf( '<h2 class="entry-title">%s</h2>', __( 'Page not Found', 'lana' ) );
				$marker = sprintf( '<li><a href="#">%s</a></li>', __( 'Error', 'lana' ) );
				$output	= sprintf( '<li class="active">%s</li>', __( 'Page not Found', 'lana' ) );
			}
			
			if( is_search() ) {
				$h2		= sprintf( '<h2 class="entry-title">%s: <span style="color:#fdb714;">%s</span></h2>', __( 'Search keyword', 'lana' ), get_search_query() );
				$marker = sprintf( '<li><a href="#">%s</a></li>', __( 'Search', 'lana' ) );
				$output = sprintf( '<li class="active">%s</li>', get_search_query() );
			}
			
			// is WooCommerce
			if( class_exists('Woocommerce') ) {
				
				$shop_page_url = esc_url( get_permalink( woocommerce_get_page_id( 'shop' ) ) );
				
				if( is_shop() ) {
					$h2		= sprintf( '<h2 class="entry-title">%s</h2>', __( 'Shop', 'lana' ) );
					$marker = sprintf( '<li><a href="' . $shop_page_url . '">%s</a></li>', __( 'Page', 'lana' ) );
					$output	= sprintf( '<li class="active">%s</li>', __( 'Shop', 'lana' ) );
				}
				if( is_product() ) {
					$h2		= sprintf( '<h2 class="entry-title">%s</h2>', $post->post_title );
					$marker = sprintf( '<li><a href="' . $shop_page_url . '">%s</a></li>', __( 'Shop', 'lana' ) );
					$output = sprintf( '<li class="active">%s</li>', $post->post_title );
				}
				if( is_product_tag() ) {
					$h2		= sprintf( '<h2 class="entry-title">%s</h2>', $post->post_title );
					$marker = sprintf( '<li><a href="#">%s</a></li>', __( 'Product Tag', 'lana' ) );
					$output = sprintf( '<li class="active">%s</li>', $post->post_title );
				}
				if( is_cart() ) {
					$marker = sprintf( '<li><a href="' . $shop_page_url . '">%s</a></li>', __( 'Shop', 'lana' ) );
					$output = sprintf( '<li class="active">%s</li>', __( 'Cart', 'lana' ) );
				}
				if( is_checkout() ) {
					$marker = sprintf( '<li><a href="' . $shop_page_url . '">%s</a></li>', __( 'Shop', 'lana' ) );
					$output = sprintf( '<li class="active">%s</li>', __( 'Checkout', 'lana' ) );
				}
			}
			
			if( is_home() || is_front_page() ) {
				$h2 	= sprintf( '<h2 class="entry-title">%s</h2>', __( 'Homepage', 'lana' ) );
				$output	= sprintf( '<li class="active">%s</li>', __( 'Homepage', 'lana' ) );
			}
			
			$HTML  = '<div class="page-title-container">';
			$HTML .= '<div class="container">';
			$HTML .= '<div class="page-title pull-left">';
			$HTML .= $h2;
			$HTML .= '</div>';
			$HTML .= '<ul class="breadcrumbs pull-right">';
			$HTML .= '<li><a href="'. esc_url( home_url( '/' ) ) .'">' . __( 'Home', 'lana' ) . '</a></li>';
			$HTML .= $marker;
			$HTML .= $output;
			$HTML .= '</ul>';
			$HTML .= '</div>';
			$HTML .= '</div>';
			
			echo $HTML;
		}
	}
}