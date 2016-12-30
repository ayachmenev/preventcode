
	<?php if( get_theme_mod( 'agama_blog_single_post_thumbnail', true ) ): ?>
	<header class="entry-header">
	<?php if ( ! post_password_required() && ! is_attachment() && get_the_post_thumbnail() && ! is_search() ) { // Attachments ?>
			
		<figure class="hover1">
			<img src="<?php echo agama_return_image_src('agama-blog-large'); ?>" class="img-responsive">
		</figure>
			
	<?php } ?>
	</header>
	<?php endif; ?>

<div class="article-entry-wrapper">

	<?php if ( is_sticky() && is_home() && ! is_paged() ) { // Sticky post ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'agama' ); ?>
		</div>
	<?php } ?>
	
	<?php
	/**
	 * agama_blog_post_date_and_format hook
	 *
	 * @hooked agama_render_blog_post_date - 10 (output HML post date & format)
	 */
	if( get_theme_mod('agama_blog_post_meta', true) ):
		do_action( 'agama_blog_post_date_and_format' ); 
	endif;
	?>
	
	<div class="entry-content">
	
		<h1 class="entry-title"><?php the_title(); ?></h1>
		
		<?php
		/**
		 * agama_blog_post_meta hook
		 *
		 * @hooked agama_render_blog_post_meta - 10  (output HTML post meta details)
		 */
		if( get_theme_mod('agama_blog_post_meta', true) ):
			echo '<p class="single-line-meta">';
			do_action( 'agama_blog_post_meta' );
			echo '</p>';
		endif;
		?>

		<?php the_content(); ?>
		
		<!-- Tags -->
		<div class="tagcloud clearfix bottommargin">
			<?php the_tags(false, false, false); ?>
		</div><!-- Tags End -->

		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'agama' ), 'after' => '</div>' ) ); ?>
		
	</div>
	
	<!-- Content Footer -->
	<footer class="entry-meta">
		
		<?php edit_post_link( __( '<i class="fa fa-edit"></i> Edit', 'agama' ), '<span class="edit-link">', '</span>' ); ?>
		
		<?php Agama::about_author(); ?>
		
	</footer><!-- .entry-meta -->
	
</div>