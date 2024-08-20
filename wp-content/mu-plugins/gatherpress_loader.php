<?php

namespace GatherPress\DevHub;

use WordPressdotorg\Theme\Parent_2021;


/**
 * Filter the version which is in charge for the ...
 * which is used here to prepare the stuff.
 * gatherpress-wporg-developer-theme/source/wp-content/themes/wporg-developer-2023/inc/template-tags.php
 *
 * Filters the value of an existing option before it is retrieved.
 * 
 * @param mixed  $pre_option    The value to return instead of the option value. This differs from <code>$default_value</code>, which is used as the fallback value in the event the option doesn't exist elsewhere in get_option(). Default false (to skip past the short-circuit).
 * @param string $option        Option name.
 * @param mixed  $default_value The fallback value to return if the option does not exist. Default false.
 * @return mixed The value to return instead of the option value. This differs from <code>$default_value</code>, which is used as the fallback value in the event the option doesn't exist elsewhere in get_option(). Default false (to skip past the short-circuit).
 */
add_filter( 'pre_option_wp_parser_imported_wp_version',function( $pre_option, string $option, $default_value ) {
    return '1.0.0';
}, 10, 3 );



/**
* Filters the value of an existing option before it is retrieved.
* 
* @param mixed  $pre_option    The value to return instead of the option value. This differs from <code>$default_value</code>, which is used as the fallback value in the event the option doesn't exist elsewhere in get_option(). Default false (to skip past the short-circuit).
* @param string $option        Option name.
* @param mixed  $default_value The fallback value to return if the option does not exist. Default false.
* @return mixed The value to return instead of the option value. This differs from <code>$default_value</code>, which is used as the fallback value in the event the option doesn't exist elsewhere in get_option(). Default false (to skip past the short-circuit).

add_filter( 'pre_option_wp_parser_root_import_dir',function( $pre_option, string $option, $default_value ) {
    return WP_PLUGIN_DIR;
}, 10, 3 );*/



/**
 * Replaces the 'theme_support' function from
 * themes/wporg-parent-2021-build/functions.php
 *
 * Fires after the theme is loaded.
 * 
 */
add_action( 'after_setup_theme', function() : void {
    remove_action( 'after_setup_theme', 'WordPressdotorg\Theme\Parent_2021\theme_support', 9 );
    add_action( 'after_setup_theme', __NAMESPACE__ . '\theme_support', 9 );
}, 0 );
/**
 * Register theme support.
 */
function theme_support() {
	// Alignwide and alignfull classes in the block editor.
	add_theme_support( 'align-wide' );

	// Add support for responsive embedded content.
	// https://github.com/WordPress/gutenberg/issues/26901
	add_theme_support( 'responsive-embeds' );

	// Add support for editor styles.
	$suffix = is_rtl() ? '-rtl' : '';
	add_theme_support( 'editor-style' );

    // THIS DEACTIVATION IS THE ONLY CHANGE // FOR GATHERPRESS DEVHUB //
	// add_editor_style( get_font_stylesheet_url() ); // Calling this leaded to FATALS in the past.
    // THIS DEACTIVATION IS THE ONLY CHANGE // FOR GATHERPRESS DEVHUB //

    add_editor_style( "/build/editor{$suffix}.css" );

	// Add support for post thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Declare that there are no <title> tags and allow WordPress to provide them
	add_theme_support( 'title-tag' );

	// Experimental support for adding blocks inside nav menus
	add_theme_support( 'block-nav-menus' );

	// Remove the default margin-top added when the admin bar is used, this is
	// handled by the theme, in `_site-header.scss`.
	add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

	register_block_pattern_category(
		'wporg',
		array(
			'label' => __( 'WordPress.org', 'wporg' ),
		)
	);
}