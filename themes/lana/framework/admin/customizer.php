<?php 

// Prevent direct access to the file
if( ! defined( 'ABSPATH' ) ) exit; 

// Include Kirki Framework
get_template_part('framework/admin/kirki/kirki');

// Include Animate Class
get_template_part( 'framework/admin/animate' );

/**
 * Update Kirki Path's
 *
 * @since 1.0.1
 */
if ( ! function_exists( 'lana_theme_kirki_update_url' ) ) {
    function lana_theme_kirki_update_url( $config ) {
        $config['url_path'] = get_stylesheet_directory_uri() . '/framework/admin/kirki/';
        return $config;
    }
}
add_filter( 'kirki/config', 'lana_theme_kirki_update_url' );

/**
 * Enqueue Customize Preview JS
 *
 * @since 1.0.1
 */
if ( ! function_exists( 'lana_customize_preview_js' ) ) {
	function lana_customize_preview_js() {
		wp_register_script( 'lana-customize-preview', LANA_JS . 'customizer.js', array( 'customize-preview', 'jquery' ), rand() );
		wp_enqueue_script( 'lana-customize-preview' );
	}
}
add_action( 'customize_preview_init', 'lana_customize_preview_js' );

/**
 * Enqueue Customize Preview CSS
 *
 * @since 1.0.1
 */
if ( ! function_exists( 'lana_customize_preview_css' ) ) {
	function lana_customize_preview_css() {
		$output  = '<style type="text/css">';
		$output .= '#customize-control-lana_breadcrumb_font_style { pointer-events: none; background: rgba( 1, 183, 242, .5 ); position: relative; border: 5px solid #01B7F2; z-index: 1; }';
		$output .= '#customize-control-lana_breadcrumb_font_style:after { font-size: 20px; font-style: italic; font-weight: bold; position: absolute; content: "PREMIUM FEATURE"; top: 50%; left: 16%; color: red; z-index: 1; }';
		$output .= '</style>';
		echo $output;
	}
}
add_action( 'customize_controls_print_styles', 'lana_customize_preview_css');

/**
 * Remove WP Default Sections
 *
 * @since 1.0.1
 */
function lana_theme_customize_register( $wp_customize ) {
	$wp_customize->remove_section('colors');
}
add_action( 'customize_register', 'lana_theme_customize_register' );

###################################################################################
# GENERAL SETTINGS
###################################################################################
	Kirki::add_section( 'lana_general_section', array(
		'title'			=> __( 'General', 'lana' ),
		'description'	=> __( 'General section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'priority'		=> 30
	) );
	// -> Page Titles
	Kirki::add_field( 'lana_page_titles', array(
		'label'			=> __( 'Page Titles', 'lana' ),
		'description'	=> __( 'Enable pages & single posts titles ?', 'lana' ),
		'section'		=> 'lana_general_section',
		'settings'		=> 'lana_page_titles',
		'type'			=> 'switch',
		'default'		=> true
	) );
###################################################################################
# HEADER SETTINGS
###################################################################################
	Kirki::add_panel( 'lana_header_panel', array(
		'title'			=> __( 'Header', 'lana' ),
		'description'	=> __( 'Header settings.', 'lana' ),
		'priority'		=> 40
	) );
	// -> Header General Section
	Kirki::add_section( 'lana_header_general_section', array(
		'title'			=> __( 'General', 'lana' ),
		'description'	=> __( 'Lana header general settings.', 'lana' ),
		'priority'		=> 10,
		'capability'	=> 'edit_theme_options',
		'panel'			=> 'lana_header_panel'
	) );
	// -> Header Image Section
	Kirki::add_section( 'header_image', array(
		'title'			=> __( 'Header Image', 'lana' ),
		'description'	=> __( 'Header image section.', 'lana' ),
		'priority'		=> 20,
		'panel'			=> 'lana_header_panel'
	) );
	// -> Sticky Header
	Kirki::add_field( 'lana_sticky_header', array(
		'label'			=> __( 'Sticky Header', 'lana' ),
		'description'	=> __( 'Enable sticky header ?', 'lana' ),
		'section'		=> 'lana_header_general_section',
		'settings'		=> 'lana_sticky_header',
		'type'			=> 'switch',
		'default'		=> true
	) );
	// -> Logo Max-Width
	Kirki::add_field( 'lana_logo_max_width', array(
		'settings'			=> 'lana_logo_max_width',
		'label'				=> __( 'Logo Max-Width', 'lana' ),
		'description'		=> __( 'Set logo max-width.', 'lana' ),
		'section'			=> 'lana_header_general_section',
		'type'				=> 'slider',
		'choices'			=> array(
			'min'			=> '1',
			'max'			=> '350',
			'step'			=> '1'
		),
		'default'			=> '150',
		'output'			=> array(
			array(
				'element'	=> '#header .logo a img',
				'property'	=> 'max-width',
				'units'		=> 'px'
			)
		)
	) );
	// -> Logo Color
	Kirki::add_field( 'lana_logo_color', array(
		'settings'		=> 'lana_logo_color',
		'label'			=> __( 'Logo Color', 'lana' ),
		'description'	=> __( 'Works only with non-image logo.', 'lana' ),
		'section'		=> 'lana_header_general_section',
		'type'			=> 'color',
		'default'		=> '#2d3e52',
		'output'		=> array(
			array(
				'element'	=> '#header .logo a',
				'property'	=> 'color'
			)
		)
	) );
###################################################################################
# LAYOUT SETTINGS
###################################################################################
	Kirki::add_section( 'lana_layout_section', array(
		'title'			=> __( 'Layout', 'lana' ),
		'description'	=> __( 'Layout section.', 'lana' ),
		'priority'		=> 50
	) );
	Kirki::add_field( 'lana_layout_style', array(
		'label'			=> __( 'Layout Style', 'lana' ),
		'description'	=> __( 'Select layout style.', 'lana' ),
		'section'		=> 'lana_layout_section',
		'settings'		=> 'lana_layout_style',
		'type'			=> 'select',
		'choices'		=> array(
			'boxed'		=> __( 'Boxed', 'lana' ),
			'fullwidth'	=> __( 'FullWidth', 'lana' )
		),
		'default'		=> 'boxed'
	) );
###################################################################################
# SLIDER SETTINGS
###################################################################################
	Kirki::add_section( 'lana_slider_section', array(
		'title'			=> __( 'Posts Slider', 'lana' ),
		'description'	=> __( 'Posts slider section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'priority'		=> 60
	) );
	Kirki::add_field( 'lana_slider_enable', array(
		'label'			=> __( 'Enable Slider', 'lana' ),
		'description'	=> __( 'Enable slider feature ?', 'lana' ),
		'section'		=> 'lana_slider_section',
		'settings'		=> 'lana_slider_enable',
		'type'			=> 'switch',
		'default'		=> true
	) );
	Kirki::add_field( 'lana_slider_homepage', array(
		'label'			=> __( 'Display on Homepage ?', 'lana' ),
		'description'	=> __( 'Enable slider on homepage / frontpage ?', 'lana' ),
		'section'		=> 'lana_slider_section',
		'settings'		=> 'lana_slider_homepage',
		'type'			=> 'switch',
		'default'		=> true
	) );
	Kirki::add_field( 'lana_slider_featured_cat', array(
		'label'			=> __( 'Post Category', 'lana' ),
		'description'	=> __( 'Select slider post category.', 'lana' ),
		'section'		=> 'lana_slider_section',
		'settings'		=> 'lana_slider_featured_cat',
		'type'			=> 'select',
		'choices'		=> Lana::get_post_categories(),
		'default'		=> 1
	) );
	Kirki::add_field( 'lana_slider_pages', array(
		'label'			=> __( 'Display on Pages', 'lana' ),
		'description'	=> __( 'Display slider on selected pages.', 'lana' ),
		'tooltip'		=> __( 'You can select multiple pages.', 'lana' ),
		'section'		=> 'lana_slider_section',
		'settings'		=> 'lana_slider_pages',
		'type'			=> 'select',
		'multiple'		=> 30,
		'choices'		=> Lana::get_all_pages(),
		'default'		=> ''
	) );
###################################################################################
# BREADCRUMB SETTINGS
###################################################################################	
	Kirki::add_section( 'lana_breadcrumb_section', array(
		'title'			=> __( 'Breadcrumb', 'lana' ),
		'description'	=> __( 'Lana breadcrumb section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'priority'		=> 70
	) );
	// -> Enable Breadcrumb
	Kirki::add_field( 'lana_breadcrumb', array(
		'settings'			=> 'lana_breadcrumb',
		'label'				=> __( 'Breadcrumb', 'lana' ),
		'description'		=> __( 'Enable theme breadcrumb ?', 'lana' ),
		'section'			=> 'lana_breadcrumb_section',
		'type'				=> 'switch',
		'default'			=> true
	) );
	// -> Breadcrumb Size
	Kirki::add_field( 'lana_breadcrumb_height', array(
		'settings'			=> 'lana_breadcrumb_height',
		'label'				=> __( 'Height', 'lana' ),
		'description'		=> __( 'Set breadcrumb height.', 'lana' ),
		'section'			=> 'lana_breadcrumb_section',
		'type'				=> 'slider',
		'default'			=> '80',
		'choices'			=> array(
			'min'			=> '56',
			'max'			=> '150',
			'step'			=> '1'
		),
		'output'			=> array(
			array(
				'element'	=> '.page-title-container',
				'property'	=> 'height',
				'units'		=> 'px'
			),
			array(
				'element'	=> '.page-title-container .page-title .entry-title',
				'property'	=> 'line-height',
				'units'		=> 'px'
			),
			array(
				'element'	=> '.page-title-container .breadcrumbs li',
				'property'	=> 'line-height',
				'units'		=> 'px'
			)
		)
	) );
	// -> Breadcrumb Background Image
	Kirki::add_field( 'lana_breadcrumb_bg_image', array(
		'settings'			=> 'lana_breadcrumb_bg_image',
		'label'				=> __( 'Background Image', 'lana' ),
		'description'		=> __( 'Set breadcrumb background image.', 'lana' ),
		'section'			=> 'lana_breadcrumb_section',
		'type'				=> 'image',
		'default'			=> '',
		'output'			=> array(
			array(
				'element'	=> '.page-title-container',
				'property'	=> 'background-image'
			)
		)
	) );
	// -> Breadcrumb Background Color
	Kirki::add_field( 'lana_breadcrumb_bg_color', array(
		'settings'			=> 'lana_breadcrumb_bg_color',
		'label'				=> __( 'Background Color', 'lana' ),
		'description'		=> __( 'Set breadcrumb background color.', 'lana' ),
		'section'			=> 'lana_breadcrumb_section',
		'type'				=> 'color',
		'default'			=> '#32373c',
		'output'			=> array(
			array(
				'element'	=> '.page-title-container',
				'property'	=> 'background'
			)
		)
	) );
	// -> Breadcrumb Font Style
	Kirki::add_field( 'lana_breadcrumb_font_style', array(
		'settings'			=> 'lana_breadcrumb_font_style',
		'label'				=> __( 'Font Style', 'lana' ),
		'description'		=> __( 'Set breadcrumb font style.', 'lana' ),
		'section'			=> 'lana_breadcrumb_section',
		'type'				=> 'typography',
		'default'			=> '',
		'choices'			=> array(
			'font-style'	=> true,
			'font-family'	=> true,
			'font-size'		=> true,
			'line-height'	=> false,
			'font-weight'	=> true,
		),
		'output'			=> array(
			array(
				'element'	=> '.page-title-container'
			)
		)
	) );
	// -> Breadcrumb Font Color
	Kirki::add_field( 'lana_breadcrumb_font_color', array(
		'settings'			=> 'lana_breadcrumb_font_color',
		'label'				=> __( 'Font Color', 'lana' ),
		'description'		=> __( 'Set breadcrumb font color.', 'lana' ),
		'section'			=> 'lana_breadcrumb_section',
		'type'				=> 'color',
		'default'			=> '#fff',
		'output'			=> array(
			array(
				'element'	=> '.page-title-container .page-title .entry-title',
				'property'	=> 'color'
			),
			array(
				'element'	=> '.page-title-container .breadcrumbs li a',
				'property'	=> 'color'
			),
			array(
				'element'	=> '.page-title-container .breadcrumbs li:after',
				'property'	=> 'color'
			)
		)
	) );
	// -> Breadcrumb Font Hover Color
	Kirki::add_field( 'lana_breadcrumb_link_hover_color', array(
		'settings'			=> 'lana_breadcrumb_link_hover_color',
		'label'				=> __( 'Link Hover', 'lana' ),
		'description'		=> __( 'Set breadcrumb links hover color.', 'lana' ),
		'section'			=> 'lana_breadcrumb_section',
		'type'				=> 'color',
		'default'			=> '#F7655C',
		'output'			=> array(
			array(
				'element'	=> '.page-title-container .breadcrumbs li a:hover',
				'property'	=> 'color'
			)
		)
	) );
	// -> Breadcrumb Font Active Color
	Kirki::add_field( 'lana_breadcrumb_link_active_color', array(
		'settings'			=> 'lana_breadcrumb_active_font_color',
		'label'				=> __( 'Link Active', 'lana' ),
		'description'		=> __( 'Set breadcrumb active link color.', 'lana' ),
		'section'			=> 'lana_breadcrumb_section',
		'type'				=> 'color',
		'default'			=> '#F7655C',
		'output'			=> array(
			array(
				'element'	=> '.page-title-container .breadcrumbs li.active',
				'property'	=> 'color'
			)
		)
	) );
###################################################################################
# BLOG SETTINGS
###################################################################################
	Kirki::add_section( 'lana_blog_section', array(
		'title'			=> __( 'Blog', 'lana' ),
		'description'	=> __( 'Blog section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'priority'		=> 80
	) );
	Kirki::add_field( 'lana_blog_single_featured_thumb', array( 
		'label'			=> __( 'Single Post Thumbnails', 'lana' ),
		'description'	=> __( 'Enable featured thumbnails on single post pages ?', 'lana' ),
		'section'		=> 'lana_blog_section',
		'settings'		=> 'lana_blog_single_featured_thumb',
		'type'			=> 'switch',
		'default'		=> false
	) );
###################################################################################
# SOCIAL ICONS SETTINGS
###################################################################################
	Kirki::add_section( 'lana_social_icons_section', array(
		'title'			=> __( 'Social Icons', 'lana' ),
		'description'	=> __( 'Social icons section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'priority'		=> 90
	) );
	Kirki::add_field( 'lana_social_rss', array(
		'label'			=> __( 'RSS URL', 'lana' ),
		'description'	=> __( 'Set your rss page url.', 'lana' ),
		'section'		=> 'lana_social_icons_section',
		'settings'		=> 'lana_social_rss',
		'type'			=> 'text',
		'default'		=> ''
	) );
	Kirki::add_field( 'lana_social_facebook', array(
		'label'			=> __( 'Facebook URL', 'lana' ),
		'description'	=> __( 'Set your facebook page url.', 'lana' ),
		'section'		=> 'lana_social_icons_section',
		'settings'		=> 'lana_social_facebook',
		'type'			=> 'text',
		'default'		=> ''
	) );
	Kirki::add_field( 'lana_social_twitter', array(
		'label'			=> __( 'Twitter URL', 'lana' ),
		'description'	=> __( 'Set your twitter page url.', 'lana' ),
		'section'		=> 'lana_social_icons_section',
		'settings'		=> 'lana_social_twitter',
		'type'			=> 'text',
		'default'		=> ''
	) );
	Kirki::add_field( 'lana_social_googleplus', array(
		'label'			=> __( 'Google+ URL', 'lana' ),
		'description'	=> __( 'Set your google+ page url.', 'lana' ),
		'section'		=> 'lana_social_icons_section',
		'settings'		=> 'lana_social_googleplus',
		'type'			=> 'text',
		'default'		=> ''
	) );
###################################################################################
# STYLING SETTINGS
###################################################################################
	Kirki::add_panel( 'lana_styling_panel', array(
		'title'			=> __( 'Styling', 'lana' ),
		'description'	=> __( 'Styling section.', 'lana' ),
		'priority'		=> 100
	) );
	// -> General
	Kirki::add_section( 'lana_styling_general_section', array(
		'title'			=> __( 'General', 'lana' ),
		'description'	=> __( 'Styling general section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'panel'			=> 'lana_styling_panel'
	) );
	// -> Primary Color
	Kirki::add_field( 'lana_primary_color', array(
		'label'			=> __( 'Primary Color', 'lana' ),
		'description'	=> __( 'Select theme primary color.', 'lana' ),
		'help'			=> __( 'All main elements will use this color.', 'lana' ),
		'section'		=> 'lana_styling_general_section',
		'settings'		=> 'lana_primary_color',
		'type'			=> 'color',
		'default'		=> '#F7655C'
	) );
	// -> Body Background Image Section
	Kirki::add_section( 'background_image', array(
		'title'			=> __( 'Body Background', 'lana' ),
		'description'	=> __( 'Body background settings.', 'lana' ),
		'panel'			=> 'lana_styling_panel'
	) );
	Kirki::add_section( 'lana_custom_css_section', array(
		'title'			=> __( 'Custom CSS', 'lana' ),
		'description'	=> __( 'Custom css section.', 'lana' ),
		'panel'			=> 'lana_styling_panel'
	) );
	Kirki::add_field( 'lana_custom_css', array(
		'label'				=> __( 'Custom CSS', 'lana' ),
		'description'		=> __( 'Add custom CSS code.', 'lana' ),
		'section'			=> 'lana_custom_css_section',
		'settings'			=> 'lana_custom_css',
		'type'				=> 'code',
		'choices'			=> array(
			'language'		=> 'css',
			'theme'			=> 'monokai',
			'height'		=> '250'
		),
		'default'			=> '',
		'sanitize_callback'	=> 'wp_strip_all_tags'
	) );
###################################################################################
# FOOTER SETTINGS
###################################################################################
	Kirki::add_section( 'lana_footer_section', array(
		'title'			=> __( 'Footer', 'lana' ),
		'description'	=> __( 'Footer section.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'priority'		=> 110
	) );
	Kirki::add_field( 'lana_footer_social_icons', array(
		'label'			=> __( 'Social Icons', 'lana' ),
		'description'	=> __( 'Enable social icons in footer area ?', 'lana' ),
		'section'		=> 'lana_footer_section',
		'settings'		=> 'lana_footer_social_icons',
		'type'			=> 'switch',
		'default'		=> true
	) );
	Kirki::add_field( 'lana_footer_copyright', array(
		'label'			=> __( 'Copyright', 'lana' ),
		'description'	=> __( 'Add custom footer copyright.', 'lana' ),
		'section'		=> 'lana_footer_section',
		'settings'		=> 'lana_footer_copyright',
		'type'			=> 'textarea',
		'default'		=> __( 'Lana WordPress Theme by Theme-Vision.com', 'lana' )
	) );
###################################################################################
# LANA SUPPORT SETTINGS
###################################################################################
	// -> Support Section
	Kirki::add_section( 'lana_support_section', array(
		'title'			=> __( 'Lana Support', 'lana' ),
		'description'	=> __( 'Hey! Buy us a cofee and we shall come with new features and updates.', 'lana' ),
		'capability'	=> 'edit_theme_options',
		'priority'		=> 140
	) );
	
/**
 * Lana Upgrade to PRO
 *
 * @since 1.0.1
 */
function lana_upgrade_to_pro() {
	wp_register_script( 'lana_customizer_script', LANA_JS . 'customizer.js', array('jquery'), uniqid(), true );
    wp_enqueue_script( 'lana_customizer_script' );
    wp_localize_script( 'lana_customizer_script', 'themevision', array(
        'URL'   => esc_url( 'http://theme-vision.com/lana-pro/' ),
        'Label' => __( 'Upgrade to PRO', 'lana' ),
    ) );
}
add_action( 'customize_controls_enqueue_scripts', 'lana_upgrade_to_pro' );

/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @since 1.0.1
 *
 */
function lana_customize_support_register( $wp_customize ){
	class Lana_Customize_Lana_Support extends WP_Customize_Control {
		public function render_content() { ?>
		<div class="theme-info"> 
			<a title="<?php esc_attr_e( 'Donate', 'lana' ); ?>" href="<?php echo esc_url( 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=BR55TPNQEK28L' ); ?>" target="_blank">
			<?php _e( 'Donate', 'lana' ); ?>
			</a>
			<a title="<?php esc_attr_e( 'Review Lana', 'lana' ); ?>" href="<?php echo esc_url( 'http://wordpress.org/support/view/theme-reviews/lana' ); ?>" target="_blank">
			<?php _e( 'Rate Lana', 'lana' ); ?>
			</a>
			<a href="<?php echo esc_url( 'https://wordpress.org/support/theme/lana' ); ?>" title="<?php esc_attr_e( 'Support Forum', 'lana' ); ?>" target="_blank">
			<?php _e( 'Support Forum', 'lana' ); ?>
			</a>
		</div>
		<?php
		}
	}
}
add_action('customize_register', 'lana_customize_support_register');

/**
 * Customize Register
 *
 * @since 1.0.1
 */
function lana_customize_register( $wp_customize ) {
	###################################################################################
	# LANA SUPPORT
	###################################################################################
	$wp_customize->add_setting( 'lana_support', array(
		'default'			=> false,
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control(
		new Lana_Customize_Lana_Support(
			$wp_customize,'lana_support', array(
				'label'		=> __('Lana Upgrade', 'lana'),
				'section'	=> 'lana_support_section',
				'settings'	=> 'lana_support',
			)
		)
	);
}
add_action( 'customize_register', 'lana_customize_register' );

/**
 * Styling Lana Support Section
 *
 * @since 1.0.1
 */
function lana_customize_styles_support( $input ) { ?>
	<style type="text/css">
		#customize-theme-controls #accordion-section-lana_support_section .accordion-section-title:after {
			color: #fff;
		}
		#customize-theme-controls #accordion-section-lana_support_section .accordion-section-title {
			background-color: rgba(247, 101, 92, 0.9);
			color: #fff;
		}
		#customize-theme-controls #accordion-section-lana_support_section .accordion-section-title:hover {
			background-color: rgba(247, 101, 92, 1);
		}
		#customize-theme-controls #accordion-section-lana_support_section .theme-info a {
			padding: 10px 8px;
			display: block;
			border-bottom: 1px solid #eee;
			color: #555;
		}
		#customize-theme-controls #accordion-section-lana_support_section .theme-info a:hover {
			color: #222;
			background-color: #f5f5f5;
		}
		.lana-customize-heading h3 {
			border: 1px dashed #4A73AA;
			font-weight: 600;
			text-align: center;
			color: #4A73AA;
		}
	</style>
<?php }
add_action( 'customize_controls_print_styles', 'lana_customize_styles_support');