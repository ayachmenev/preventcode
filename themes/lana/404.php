<?php get_header(); ?>

<div id="main" class="<?php Lana::bs_class(); ?>">
	<div class="page">
		<div class="post-content">
			<div class="blog-infinite">
			
				<article id="post-0" class="post no-results not-found">
					<div class="post-content-wrapper">
						
						<div class="details">
						
							<h2 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'lana' ); ?></h2>
							
							<div class="excerpt-container">
								<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lana' ); ?></p>
								<?php get_search_form(); ?>
							</div>
							
						</div>
						
					</div>
				</article>
			
			</div>
		</div>
	</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>