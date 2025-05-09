<?php

/**
 * Class Blocks is the base class for Gutenberg blocks registration.
 * It provides the ability to register custom blocks using manifest.json.
 *
 * @package Makewhatever\Blocks
 */

declare(strict_types=1);

namespace Makewhatever\Blocks;

use MakewhateverVendor\EightshiftLibs\Blocks\AbstractBlocks;

/**
 * Class Blocks
 */
class Blocks extends AbstractBlocks
{
	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		// Register all custom blocks.
		\add_action('init', [$this, 'getBlocksDataFullRaw'], 10);
		\add_action('init', [$this, 'registerBlocks'], 11);

		// Remove P tags from content.
		\remove_filter('the_content', 'wpautop');

		// Create new custom category for custom blocks.
		\add_filter('block_categories_all', [$this, 'getCustomCategory'], 10, 2);

		// Register custom theme support options.
		\add_action('after_setup_theme', [$this, 'addThemeSupport'], 25);

		// Register custom project color palette.
		\add_action('after_setup_theme', [$this, 'changeEditorColorPalette'], 11);

		// Filter block content.
		\add_filter('render_block_data', [$this, 'filterBlocksContent'], 10, 2);

		// Output inline css variables.
		\add_action('wp_footer', [$this, 'outputCssVariablesInline']);

		// Limits the usage of only custom project blocks.
		\add_filter('allowed_block_types_all', [$this, 'getAllBlocksList'], 10, 2);
	}
}
