<?php
// Prevent direct access to the file
if( ! defined( 'ABSPATH' ) ) exit;

// Lana class
get_template_part( 'framework/lana-class' );

// Core File
get_template_part( 'framework/lana-core' );

// Customizer Files
get_template_part( 'framework/admin/customizer' );

// Widget Files
get_template_part( 'framework/widgets/widgets' );

// Framework Files
get_template_part( 'framework/lana-dynamic_css' );
get_template_part( 'framework/lana-post-slider' );
get_template_part( 'framework/lana-breadcrumb' );
get_template_part( 'framework/lana-functions' );
get_template_part( 'framework/lana-woocommerce' );
