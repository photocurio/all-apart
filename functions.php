<?php
/**
 * The functions file for all-apart
 *
 * @package all-apart
 */

add_action( 'wp_enqueue_scripts', 'all_apart_enqueue_styles' );
add_action( 'wp_head', 'all_apart_add_favicon' );
add_action( 'login_head', 'all_apart_add_favicon' );
add_action( 'admin_head', 'all_apart_add_favicon' );
add_filter( 'chaplin_color_schemes', 'all_apart_colors' );

/**
 * Adding the these stylesheet, and prism js.
 *
 * @return void
 */
function all_apart_enqueue_styles(): void {
	$theme_version = wp_get_theme( 'all apart' )->get( 'Version' );
	$parent_style  = 'chaplin_style';

	wp_register_style(
		$parent_style,
		get_template_directory_uri() . '/style.css',
		null,
		$theme_version
	);
	wp_enqueue_style(
		'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		$theme_version
	);
	wp_enqueue_style(
		'prism-css',
		get_stylesheet_directory_uri() . '/vendor/prism.min.css',
		array( 'child-style' ),
		$theme_version
	);

	wp_enqueue_script(
		'prism-js',
		get_stylesheet_directory_uri() . '/vendor/prism-core.min.js',
		null,
		$theme_version,
		true
	);
	wp_enqueue_script(
		'prism-autoloader',
		get_stylesheet_directory_uri() . '/vendor/prism-autoloader.min.js',
		null,
		$theme_version,
		true
	);
	wp_enqueue_script(
		'theme-script',
		get_stylesheet_directory_uri() . '/theme-script.js',
		array( 'prism-js', 'prism-autoloader' ),
		$theme_version,
		true
	);
}

/**
 * Add class overlay-header to body.
 *
 * @param mixed $classes The body classes.
 * @return mixed
 */
function all_apart_body_classes( $classes ) {
	if ( is_category() || is_home() ) {
		$classes[] = 'overlay-header';
	}
	return $classes;
}
add_action( 'body_class', 'all_apart_body_classes' );


/**
 * Add favicon link.
 *
 * @return void
 */
function all_apart_add_favicon() {
	$favicon_url = get_stylesheet_directory_uri() . '/favicon.ico';
	echo "<link rel='shortcut icon' href='" . esc_url( $favicon_url ) . "'/>";
}

/**
 * Set color definitions.
 *
 * @param array $array the array of colors for the theme.
 * @return array
 */
function all_apart_colors( array $array ): array {
	$array['all-apart'] = array(
		'name'   => _x( 'All Apart', 'Color scheme name', 'chaplin' ),
		'colors' => array(
			'background_color'                          => '#ddeced',
			'chaplin_primary_text_color'                => '#062421',
			'chaplin_headings_text_color'               => '#062421',
			'chaplin_secondary_text_color'              => '#547473',
			'chaplin_accent_color'                      => '#00529b',
			'chaplin_accent_color'                      => '#00529b',
			'chaplin_buttons_background_color'          => '#00529b',
			'chaplin_buttons_text_color'                => '#FFFFFF',
			'chaplin_border_color'                      => '#84A4A5',
			'chaplin_light_background_color'            => '#94B5B5',
			'chaplin_cover_template_overlay_text_color' => '#FFFFFF',
			'chaplin_cover_template_overlay_background_color' => '#FFC3BC',
		),
	);
	return $array;
}
