<?php

/**
 * The Blog_Taxonomy specific functionality.
 *
 * @package Makewhatever\CustomTaxonomy
 */

declare(strict_types=1);

namespace Makewhatever\CustomTaxonomy;

use MakewhateverVendor\EightshiftLibs\CustomTaxonomy\AbstractTaxonomy;

/**
 * Class LocationTaxonomy
 */
class LocationTaxonomy extends AbstractTaxonomy
{
	/**
	 * Taxonomy slug constant.
	 *
	 * @var string
	 */
	public const TAXONOMY_SLUG = 'location';

	/**
	 * Taxonomy post type slug constant.
	 *
	 * @var string
	 */
	public const TAXONOMY_POST_TYPE_SLUG = 'post';

	/**
	 * Rest API Endpoint slug constant.
	 *
	 * @var string
	 */
	public const REST_API_ENDPOINT_SLUG = 'locations';

	/**
	 * Get the slug of the custom taxonomy
	 *
	 * @return string Custom taxonomy slug.
	 */
	protected function getTaxonomySlug(): string
	{
		return static::TAXONOMY_SLUG;
	}

	/**
	 * Get the post type slug(s) that use the taxonomy.
	 *
	 * @return string|array<string> Custom post type slug or an array of slugs.
	 */
	protected function getPostTypeSlug()
	{
		return self::TAXONOMY_POST_TYPE_SLUG;
	}

	/**
	 * Get the arguments that configure the custom taxonomy.
	 *
	 * @return array<mixed> Array of arguments.
	 */
	protected function getTaxonomyArguments(): array
	{
		return [
			// phpcs:disable SlevomatCodingStandard.Namespaces.FullyQualifiedGlobalFunctions.NonFullyQualified
			'labels' => [
				'name' => esc_html_x(
					'Location',
					'taxonomy plural name',
					'makewhatever'
				),
				'singular_name' => esc_html_x(
					'Locations',
					'taxonomy singular name',
					'makewhatever'
				),
			],
			// phpcs:enable
			'hierarchical' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => false,
			'public' => true,
			'show_in_rest' => true,
			'query_var' => true,
			'rest_base' => static::REST_API_ENDPOINT_SLUG,
			'rewrite' => [
				'hierarchical' => true,
				'with_front' => false,
			],
		];
	}
}
