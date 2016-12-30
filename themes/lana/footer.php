<?php if( ! defined( 'ABSPATH' ) ) exit; // Prevent direct access to the file ?>

				</div><!-- Row End -->
			</div><!-- Container End -->
		</section><!-- Section Content End -->
		
		<footer id="footer">
			<?php 
			if( is_active_sidebar( 'lana-footer-1' ) || 
				is_active_sidebar( 'lana-footer-2' ) || 
				is_active_sidebar( 'lana-footer-3' ) || 
				is_active_sidebar( 'lana-footer-4' ) ): ?>
			<div class="footer-wrapper">
				<div class="container">
					<div class="row">
						
						<!-- Widget Area 1 -->
						<div class="col-sm-6 col-md-3">
							<?php dynamic_sidebar( 'lana-footer-1' ); ?>
						</div><!-- Widget Area 1 End -->
						
						<!-- Widget Area 2 -->
						<div class="col-sm-6 col-md-3">
							<?php dynamic_sidebar( 'lana-footer-2' ); ?>
						</div><!-- Widget Area 2 End -->
						
						<!-- Widget Area 3 -->
						<div class="col-sm-6 col-md-3">
							<?php dynamic_sidebar( 'lana-footer-3' ); ?>
						</div><!-- Widget Area 3 End -->
						
						<!-- Widget Area 4 -->
						<div class="col-sm-6 col-md-3">
							<?php dynamic_sidebar( 'lana-footer-4' ); ?>
						</div><!-- Widget Area 4 End -->
					
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			<div class="bottom copyright">
				<div class="container">
					<div class="copyright pull-left">
						<p><?php do_action( 'lana_copyright' ); ?></p>
					</div>
					<?php if( get_theme_mod( 'lana_footer_social_icons', true ) ): ?>
					<div class="pull-right">
						<?php Lana::social_icons(); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		
		</footer>
		
	</div><!-- Page Wrapper End -->
	
	<?php wp_footer(); ?>

</html>