<?php if( ! defined( 'ABSPATH' ) ) exit; // Prevent direct access to the file ?>

<?php
/**
 * The Header template
 *
 * @package Theme-Vision
 * @subpackage Lana
 * @since 1.0.0
 */
 ?>
<!DOCTYPE html>
<!--[if IE 8]>          <html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>          <html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!-->  <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Meta Tags -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
	
	<!-- Page Wrapper -->
	<div id="page-wrapper">
		
		<!-- Header -->
		<header id="header" class="navbar-static-top">
			<div class="top_nav hidden-xs">
				<div class="container">
					
					<!-- Top Menu -->
					<nav id="top-menu" role="navigation">
						<?php echo Lana::menu( array( 'theme_location' => 'lana-top-menu', 'menu_class' => 'quick-menu pull-left' ) ); ?>
					</nav><!-- Top Menu End -->

					<!-- Social Icons -->
                    <div class="pull-right">
                        <?php Lana::social_icons(); ?>
                    </div><!-- Social Icons End -->
				</div>
			</div>
			<div class="main-header">
				
				<!-- Main Mobile Menu Toggle -->
				<a href="#mobile-menu-02" data-toggle="collapse" class="mobile-menu-toggle">
                    <?php _e( 'Mobile Menu Toggle', 'lana' ); ?>					
                </a><!-- Main Mobile Menu Toggle End -->
				
				<div class="container">
					
					<!-- Logo -->
					<h1 class="site-title logo navbar-brand<?php if( get_theme_mod('lana_logo', '') ): ?> img<?php endif; ?>" rel="home">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                            
							<?php if( has_custom_logo() ): ?>
							
								<?php Lana::logo(); ?>
								
							<?php else: bloginfo( 'name' ); endif; ?>

                        </a>
                    </h1><!-- Logo End -->
					 
					<!-- Main Menu -->
					<nav id="main-menu" role="navigation">
						<?php echo Lana::menu( array( 'theme_location' => 'lana-main-menu', 'menu_class' => 'menu' ) ); ?>
					</nav><!-- Main Menu End -->
					
				</div>
				
				<!-- Main Mobile Menu -->
				<nav id="mobile-menu-02" class="mobile-menu collapse">
					<?php echo Lana::menu( array( 'theme_location' => 'lana-main-menu', 'menu_class' => 'menu' ) ); ?>
				</nav><!-- Main Mobile Menu End -->
				
			</div>
		</header><!-- Header End -->
		
		<?php
		#################################################
		# RENDER SLIDER | @since 1.0.1
		#################################################
		do_action( 'lana_slider' );
		#################################################
		# RENDER HEADER IMAGE | @since 1.0.0
		#################################################
		do_action( 'lana_header_image' );
		#################################################
		# RENDER BREADCRUMB | @since 1.0.0
		#################################################
		do_action( 'lana_breadcrumb' ); ?>
		
		<!-- Section Content -->
		<section id="content">
			<!-- Container -->
			<div class="container">
				<!-- Row -->
				<div class="row">
				
				<?php 
				#################################################
				# RENDER FRONTPAGE BOXES | @since 1.0.1
				#################################################
				do_action( 'render_lana_frontpage_boxes' );
				#################################################
				# RENDER COUNT BOXES | @since 1.0.1
				#################################################
				do_action( 'render_lana_count_boxes' ); ?>