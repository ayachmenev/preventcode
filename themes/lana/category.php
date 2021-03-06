<?php get_header(); ?>
<div id="main" class="<?php Lana::bs_class(); ?>">
	<div class="page">
		<div class="post-content">
			<div class="blog-infinite">
				
				<?php if( have_posts() ): while( have_posts() ) : the_post(); ?>
					
					<!-- Article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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

							<div class="details">

								<h2 class="entry-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
								</h2>
								
								<div class="excerpt-container">
									<?php the_excerpt(); ?>
								</div>
								
								<div class="post-meta">

									<div class="entry-author fn">
										<i class="icon fa fa-user"></i> 
										<?php _e( 'Posted by', 'lana' ); ?>: 
										<?php the_author_posts_link(); ?>
									</div>
									
									<div class="entry-action">
										
										<a href="<?php the_permalink(); ?>#comments" class="button entry-comment btn-small">
											<i class="fa fa-comment"></i> 
											<?php $comments = wp_count_comments( get_the_ID() ); ?>
											<span><?php echo $comments->approved .' '. __( 'comments', 'lana' ); ?></span>
										</a>
										
										<span class="entry-tags">
											<i class="fa fa-folder"></i> 
											<?php echo get_the_category_list(', '); ?>
										</span>
										
									</div>
								
								</div>
							</div>
						</div>
					</article><!-- Article End -->
					
				<?php endwhile; else: ?>
				
					<?php Lana::not_found(); ?>
				
				<?php endif; ?>
			
			</div>
		</div>
	</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>