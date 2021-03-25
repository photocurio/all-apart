<?php
add_action( 'wp_enqueue_scripts', 'all_apart_enqueue_styles' );
function all_apart_enqueue_styles() {

    $parent_style = 'chaplin_style';

    wp_register_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
    wp_enqueue_script('prism-js', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.16.0/components/prism-core.min.js', null);
    wp_enqueue_script('prism-autoloader', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.16.0/plugins/autoloader/prism-autoloader.min.js');
    wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/theme-script.js', array('prism-js', 'prism-autoloader'));
    wp_enqueue_style('prism-css', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.16.0/themes/prism.min.css', array('child-style'));
}

if ( ! function_exists( 'all_apart_body_classes' ) ) {
	function all_apart_body_classes( $classes ) {
    if (is_category() || is_home()) {
			$classes[] = 'overlay-header';
    }
    return $classes;
  }
  add_action( 'body_class', 'all_apart_body_classes' );
}

function add_favicon() {
  $favicon_url = get_stylesheet_directory_uri() . '/favicon.ico';
  echo '<link rel="shortcut icon" href="' . $favicon_url . '"/>';
}

add_action('wp_head', 'add_favicon');
add_action('login_head', 'add_favicon');
add_action('admin_head', 'add_favicon');
