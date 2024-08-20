<?php

namespace WordPressdotorg\MU_Plugins\Global_Header_Footer\Header;

use function WordPressdotorg\MU_Plugins\Global_Header_Footer\{ get_home_url, get_download_url };

defined( 'WPINC' ) || die();

/**
 * Defined in `render_global_header()`.
 *
 * @var array  $attributes
 * @var array  $menu_items
 * @var string $locale_title
 * @var string $show_search
 */



/**
 * Output menu items (`navigation-link`) & submenus (`navigation-submenu`). If a submenu, recursively iterate
 * through submenu items to output links.
 *
 * @param array   $menu_item An item from the array in `get_global_menu_items` or `get_rosetta_menu_items`.
 * @param boolean $top_level Whether the menu item is a top-level link.
 * @return string
 */
function recursive_menu( $menu_item, $top_level = true ) {
	$has_submenu = ! empty( $menu_item['submenu'] );

	if ( ! $has_submenu ) {
		return sprintf(
			'<!-- wp:navigation-link {"label":"%1$s","url":"%2$s","kind":"%3$s","isTopLevelLink":%4$s,"className":"%5$s"} /-->',
			$menu_item['title'],
			$menu_item['url'],
			$menu_item['type'],
			$top_level ? 'true' : 'false',
			$menu_item['classes'] ?? '',
		);
	}

	$output = sprintf(
		'<!-- wp:navigation-submenu {"label":"%1$s","url":"%2$s","kind":"%3$s","className":"%4$s"} -->',
		$menu_item['title'],
		$menu_item['url'],
		$menu_item['type'],
		$menu_item['classes'] ?? '',
	);

	foreach ( $menu_item['submenu'] as $submenu_item ) {
		$output .= recursive_menu( $submenu_item, false );
	}

	$output .= '<!-- /wp:navigation-submenu -->';

	return $output;
}

?>

<!-- wp:html -->
<figure class="wp-block-image global-header__wporg-logo-mark">
	<a href="<?php echo esc_url( get_home_url() ); ?>">
		<?php require __DIR__ . '/images/w-mark.svg'; ?>
	</a>
</figure>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"global-header__wporg-locale-title"} -->
<p class="global-header__wporg-locale-title">
	<span>Powering (developers to create) communities with WordPress</span>
</p>
<!-- /wp:paragraph -->

<!-- wp:navigation {"openSubmenusOnClick":true,"className":"global-header__navigation","ariaLabel":"<?php echo esc_attr_x( 'Main', 'main navigation label', 'wporg' ); ?>","layout":{"type":"flex","orientation":"horizontal"}} -->
	<?php
	/*
	* Loop though menu items and create navigation item blocks. Recurses through any submenu items to output dropdowns.
	*/
	foreach ( $menu_items as $item ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo recursive_menu( $item );
	}
	?>
<!-- /wp:navigation -->


<!-- This is the first of two Get WordPress buttons; the other is in the navigation menu.
	Two are needed because they have different DOM hierarchies at different breakpoints. -->
<!-- wp:group {"className":"global-header__desktop-get-wordpress-container"} -->
<div class="global-header__desktop-get-wordpress-container">
	<a href="<?php echo esc_url( 'https://wordpress.org/plugins/gatherpress/' ); ?>" class="global-header__desktop-get-wordpress global-header__get-wordpress">
		<?php echo esc_html_x( 'Get GatherPress', 'link anchor text', 'wporg' ); ?>
	</a>
</div> <!-- /wp:group -->
