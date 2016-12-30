<?php 
if( ! defined( 'ABSPATH' ) ) exit;

add_action( 'lana_slider', 'lana_slider_action' );
if( ! function_exists( 'lana_slider_action' ) ) {
	function lana_slider_action() {
		global $post;
		
		$slider['enabled'] 		= esc_attr( get_theme_mod( 'lana_slider_enable', true ) );
		$slider['on_homepage']	= esc_attr( get_theme_mod( 'lana_slider_homepage', true ) );
		$slider['on_pages']		= array_map( 'esc_attr', get_theme_mod( 'lana_slider_pages' ) );
		
		if( 
			$slider['enabled'] && $slider['on_homepage'] && is_home() || 
			$slider['enabled'] && $slider['on_homepage'] && is_front_page() || 
			$slider['enabled'] && ! empty( $slider['on_pages'] ) && is_page( $slider['on_pages'] ) ) {
			
			$cat_ID 		= esc_attr( get_theme_mod( 'lana_slider_featured_cat', 1 ) );
			$slider_query 	= new WP_Query( array( 'category__in' => $cat_ID ) ); ?>
			
			<div id="lana-slider" class="owl-carousel owl-theme">
			<?php if( $slider_query->have_posts() ): while( $slider_query->have_posts() ): $slider_query->the_post(); ?>
			<div id="post-<?php the_ID(); ?>" class="lana-post-slider-item">
			
				<?php if( has_post_thumbnail() ): ?>
					
					<?php the_post_thumbnail(); ?>
					
				<?php else: ?>
				
					<img src="<?php echo esc_url( LANA_IMG . 'slider-placeholder.png' ); ?>" alt="<?php esc_attr_e( 'No Image', 'lana' ); ?>">
				
				<?php endif; ?>
				
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			
			</div>
			<?php endwhile; wp_reset_postdata(); endif; ?>
			</div>
		<?php	
		}
		
	}
}
