<?php
// Prevent direct access to the file
if( ! defined( 'ABSPATH' ) ) exit; 

if ( ! isset( $content_width ) ) 
	 $content_width = 1200;

/**
 * After Setup Theme
 *
 * @since 1.0.0
 */
add_action( 'after_setup_theme', 'lana_after_setup_theme' );
function lana_after_setup_theme() {
	global $wp_version;
	
	load_theme_textdomain( 'lana', LANA_DIR . 'languages' );
	
	$header_args = array(
		'width'  => '1920',
		'height' => '960'
	);
	
	add_theme_support( 'custom-logo', array(
		'height'		=> '65',
		'width'			=> '300',
		'flex-height'	=> true,
		'flex-width'	=> true,
		'header-text'	=> array( 'site-title', 'site description' )
	) );
	
	add_theme_support( 'title-tag' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'custom-header', $header_args );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	
	set_post_thumbnail_size( 1170, 9999 ); // Unlimited height, soft crop
	
	register_nav_menu( 'lana-top-menu', __( 'Top Menu', 'lana' ) );
	register_nav_menu( 'lana-main-menu', __( 'Main Menu', 'lana' ) );
	
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
	) );
	
}

/**
 * Override default wp_nav_menu args 
 *
 * @since 1.0.2
 */
add_filter( 'lana_nav_menu_args', 'lana_filter_nav_menu_args' );
function lana_filter_nav_menu_args( $args ) {
	$args['container'] 	= 'ul';
	$args['menu_class'] = 'menu';
	$args['echo']		= false;
	
	return $args;
}

/**
 * Header Image
 *
 * @since 1.0.0
 */
add_action( 'lana_header_image', 'lana_render_header_image' );
if( ! function_exists( 'lana_render_header_image' ) ) {
	function lana_render_header_image() {
		if( get_header_image() ) {
			$HTML  = '<a href="' . esc_url( home_url( '/' ) ) . '">';
			$HTML .= '<img src="' . esc_url( get_header_image() ) . '" 
						class="header-image" 
						width="' . esc_attr( get_custom_header()->width ) . '" 
						height="' . esc_attr( get_custom_header()->height ) . '" 
						alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';
			$HTML .= '</a>';
			echo $HTML;
		}
	}
}

/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since 1.0.0
 */
add_action( 'render_lana_blog_pagination', 'lana_blog_pagination' );
if ( ! function_exists( 'lana_blog_pagination' ) )  {
	function lana_blog_pagination( $html_id ) {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav id="<?php echo esc_attr( $html_id ); ?>" class="navigation clearfix" role="navigation">
				<h3 class="assistive-text"><?php _e( 'Post navigation', 'lana' ); ?></h3>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'lana' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'lana' ) ); ?></div>
			</nav><!-- .navigation -->
		<?php endif;
	}
}

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own lana_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'lana_comment' ) ) :
function lana_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments. ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		
		<p><?php _e( 'Pingback:', 'lana' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'lana' ), '<span class="edit-link">', '</span>' ); ?></p>
	
	<?php break; default : global $post; ?>
		
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="the-comment">
			
			<div class="avatar">
				<?php echo get_avatar( $comment, 72 ); ?>
			</div>

			<div class="comment-box">
				<div class="comment-author">
					
					<?php // Reply Link
					$comment_reply_link = get_comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'lana' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 
					echo str_replace( 'comment-reply-link', 'button btn-mini pull-right', $comment_reply_link ); ?>
					
					<h4 class="box-title">
					<?php
					printf( '<a href="%1$s">%2$s %3$s</a>', esc_url( get_permalink() ), get_comment_author_link(),
								// If current post author is also comment author, make it known visually.
								( $comment->user_id === $post->post_author ) ? '<cite>' . __( 'author', 'lana' ) . '</cite>' : ''
					);
					printf( '<small><a href="%1$s"><time datetime="%2$s">%3$s</time></a></small>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'lana' ), get_comment_date('M d Y'), get_comment_time() )
					);
					?>
					</h4>
				</div>
				
				<div class="comment-text">
					<?php comment_text(); ?>
				</div>
				
				<?php //edit_comment_link( __( '<i class="fa fa-edit"></i> Edit', 'lana' ), '<p class="edit-link">', '</p>' ); ?>
				
			</div><!-- .comment-content -->
			
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'lana' ); ?></p>
			<?php endif; ?>
			
		</div><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/**
 * Check if requested option is enabled or not
 *
 * @since 1.0.1
 */
function lana_enabled( $option ) {
	if( $option == 'count_boxes' ) {
		if( 
			get_theme_mod( 'lana_count_box_1_enable', true ) || 
			get_theme_mod( 'lana_count_box_2_enable', true ) || 
			get_theme_mod( 'lana_count_box_3_enable', true ) || 
			get_theme_mod( 'lana_count_box_4_enable', true ) 
		)   { return true; } else { return false; }
	}
	else
	if( $option == 'frontpage_boxes' ) {
		if(
			get_theme_mod( 'lana_frontpage_box_1_enable', true ) || 
			get_theme_mod( 'lana_frontpage_box_2_enable', true ) || 
			get_theme_mod( 'lana_frontpage_box_3_enable', true ) || 
			get_theme_mod( 'lana_frontpage_box_4_enable', true ) 
		)   { return true; } else { return false; }
	}
	else
	if( $option == 'slider' ) {
		if( 
			get_theme_mod( 'lana_slide_1_enable', true ) || 
			get_theme_mod( 'lana_slide_2_enable', true ) 
		)	{ return true; } else { return false; }
	}
}

/**
 * Comment form default fields
 *
 * @since 1.0.5
 */
add_filter( 'comment_form_default_fields', 'lana_comment_form_fields' );
function lana_comment_form_fields( $fields ) {
	
	// Get the current commenter if available
    $commenter = wp_get_current_commenter();
	
	// Core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html_req = ( $req ? " required='required'" : '' );
	
	// Edit fields
	$fields['author'] 	= '<div class="form-group row"><div class="col-xs-4">' . '<label for="author">' . __( 'Name', 'lana' ) . '*</label>' . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" class="input-text full-width"' . $aria_req . ' /></div>';
	$fields['email']	= '<div class="col-xs-4">' . '<label for="email">' . __( 'Email', 'lana' ) . '*</label> ' . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" class="input-text full-width"' . $aria_req . ' /></div>';
	$fields['url']		= '<div class="col-xs-4">' . '<label for="url">' . __( 'Website', 'lana' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_url( $commenter['comment_author_url'] ) . '" class="input-text full-width" /></div></div>';
	
	return $fields;
}

/**
 * Comment form defaults
 *
 * @since 1.0.5
 */
add_filter( 'comment_form_defaults', 'lana_comment_form_defaults' );
function lana_comment_form_defaults( $defaults ) {
	global $current_user;
	
	// Edit fields
	$defaults['logged_in_as']			= '<div class="form-group logged-in-as">' . sprintf( '%s <a href="%s">%s</a>. <a href="%s" title="%s">%s</a>', __('Logged in as', 'lana'), admin_url( 'profile.php' ), $current_user->display_name, wp_logout_url( apply_filters( 'the_permalink', esc_url( get_permalink() ) ) ), __( 'Log out of this account', 'lana' ), __( 'Log out?', 'lana' ) ) . '</div>';
	$defaults['comment_field'] 			= '<div class="form-group col-xs-12">' . '<label for="comment">' . __( 'Comment', 'lana' ) . '*</label>' . '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="input-text full-width"></textarea></div>';
	$defaults['comment_notes_after']	= '<div class="form-group col-xs-12" style="margin-top: 15px; margin-bottom: 15px;">' . sprintf( '%s <abbr title="HyperText Markup Language">HTML</abbr> %s: %s', __( 'You may use these', 'lana' ), __( 'tags and attributes', 'lana' ), '<code>' . allowed_tags() . '</code>' ) . '</div>';
	$defaults['class_submit']			= 'btn-large full-width';
	
	return $defaults;
}

/**
 * Lana Copyright
 *
 * @since 1.0.1
 */
add_action( 'lana_copyright', 'lana_render_copyright' );
if( ! function_exists( 'lana_render_copyright' ) ) {
	function lana_render_copyright() {
		$copyright = esc_html( get_theme_mod( 'lana_footer_copyright', __( 'Lana WordPress Theme by Theme-Vision.com', 'lana' ) ) );
		if( ! empty( $copyright ) ) {
			echo $copyright;
		}
	}
}