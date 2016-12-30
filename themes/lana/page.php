<?php get_header(); ?>

<div id="main" class="<?php Lana::bs_class(); ?>">
	<div class="page">
		<div class="post-content">
			<div class="blog-infinite">
				
				<?php while( have_posts() ) : the_post(); ?>
					
					<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
						<div class="post-content-wrapper">
							
							<?php if( has_post_thumbnail() ): ?>
							<figure class="image-container">
								<a href="<?php the_permalink(); ?>" class="hover-effect">
									<?php the_post_thumbnail(); ?>
								</a>
								<!-- Entry Date -->
								<div class="entry-date">
									<?php echo get_the_date('d M'); ?>
								</div><!-- Entry Date End -->
							</figure>
							<?php endif; ?>
							
							<!-- Entry Details -->
							<div class="details">
								
								<?php if( get_theme_mod( 'lana_page_titles', true ) ): ?>
								<!-- Entry Title -->
								<h2 class="entry-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
								</h2><!-- Entry Title End -->
								<?php endif; ?>
								
								<!-- Entry Content -->
								<div class="excerpt-container">
									<?php the_content(); ?>
								</div><!-- Entry Content End -->
								
								<div class="post-meta clear">
									
									<!-- Entry Author -->
									<div class="entry-author fn">
										<i class="icon fa fa-user"></i> 
										<?php _e( 'Posted by', 'lana' ); ?>: 
										<?php the_author_posts_link(); ?>
									</div><!-- Entry Author End -->
									
									<!-- Entry Action -->
									<div class="entry-action">
										<a href="<?php the_permalink(); ?>#comments" class="button entry-comment btn-small">
											<i class="fa fa-comment"></i> 
											<?php $comments = wp_count_comments( get_the_ID() ); ?>
											<span><?php echo $comments->approved .' '. __( 'comments', 'lana' ); ?></span>
										</a>
									</div><!-- Entry Action End -->
									
								</div><!-- Post Meta End -->
								
							</div><!-- Entry Details End -->
							
						</div>
					</div>
					
					<?php comments_template(); ?>
					
				<?php endwhile; ?>
			
			</div>
		</div>
	</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>