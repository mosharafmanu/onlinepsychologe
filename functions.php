<?php
/**
 * Psychologe Haegermann Theme functions and definitions.
 *
 * @package Psychologe Haegermann
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue parent and child theme stylesheets.
 *
 * NOTE: Astra loads its own styles via wp_enqueue_style( 'astra-theme-css' ).
 * The child stylesheet is enqueued after and depends on it so overrides apply correctly.
 */
function psychologe_haegermann_enqueue_styles() {

	$parent_style = 'astra-theme-css'; // Astra's registered handle.

	wp_enqueue_style(
		'psychologe-haegermann-theme-css',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get( 'Version' )
	);

wp_enqueue_style(
    'psychologe-haegermann-imran-css',
    get_stylesheet_directory_uri() . '/imran-styles.css',
    array( 'psychologe-haegermann-theme-css' ),
    '2.0.0' // manual version
);

	wp_enqueue_style(
		'psychologe-haegermann-faisal-css',
		get_stylesheet_directory_uri() . '/faisal-styles.css',
		array( 'psychologe-haegermann-theme-css' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'psychologe_haegermann_enqueue_styles', 15 );

/**
 * Add your custom functions below this line.
 * -----------------------------------------------------------------------
 */

/**
 * Render the Related Articles section after the main content container
 * (outside Astra's .ast-container) so it spans the full page width.
 *
 * astra_content_after fires after </div><!-- #content --> closes,
 * before the site footer — giving us a true full-width slot.
 */
function psychologe_haegermann_related_articles() {
	if ( is_singular( 'post' ) ) {
		get_template_part( 'template-parts/related-articles' );
	}
}
add_action( 'astra_content_after', 'psychologe_haegermann_related_articles' );

