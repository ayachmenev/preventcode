<?php 
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package Theme-Vision
 * @subpackage Lana
 * @since 1.0.7
 */
	if( ! defined( 'ABSPATH' ) ) exit; // Prevent direct access to the file. ?>

	<?php if ( is_active_sidebar( 'lana-sidebar' ) ) : ?>
		<div class="sidebar col-sm-4 col-md-3">
			<?php dynamic_sidebar( 'lana-sidebar' ); ?>
		</div>
	<?php endif; ?>