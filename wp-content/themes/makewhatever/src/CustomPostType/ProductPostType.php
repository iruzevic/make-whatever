<?php

/**
 * File that holds class for ProductPostType custom post type registration.
 *
 * @package Makewhatever\CustomPostType
 */

declare(strict_types=1);

namespace Makewhatever\CustomPostType;

use MakewhateverVendor\EightshiftLibs\CustomPostType\AbstractPostType;

/**
 * Class ProductPostType.
 */
class ProductPostType extends AbstractPostType
{
	/**
	 * Post type slug constant.
	 *
	 * @var string
	 */
	public const POST_TYPE_SLUG = 'product';

	/**
	 * URL slug for the custom post type.
	 *
	 * @var string
	 */
	public const POST_TYPE_URL_SLUG = 'product';

	/**
	 * Rest API Endpoint slug constant.
	 *
	 * @var string
	 */
	public const REST_API_ENDPOINT_SLUG = 'products';

	/**
	 * Capability type for projects post type.
	 *
	 * @var string
	 */
	public const POST_CAPABILITY_TYPE = 'post';

	/**
	 * Location of menu in sidebar.
	 *
	 * @var int
	 */
	public const MENU_POSITION = 20;

	/**
	 * Set menu icon.
	 *
	 * @var string
	 */
	public const MENU_ICON = 'dashicons-admin-settings';

	/**
	 * Get the slug to use for the Projects custom post type.
	 *
	 * @return string Custom post type slug.
	 */
	protected function getPostTypeSlug(): string
	{
		return self::POST_TYPE_SLUG;
	}

	/**
	 * Get the arguments that configure the Projects custom post type.
	 *
	 * @return array<mixed> Array of arguments.
	 */
	protected function getPostTypeArguments(): array
	{
		return [
			// phpcs:disable SlevomatCodingStandard.Namespaces.FullyQualifiedGlobalFunctions.NonFullyQualified
			'labels' => [
				'name' => esc_html_x(
					'Product',
					'post type plural name',
					'makewhatever'
				),
				'singular_name' => esc_html_x(
					'Products',
					'post type singular name',
					'makewhatever'
				),
			],
			// phpcs:enable
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'capability_type' => self::POST_CAPABILITY_TYPE,
			'has_archive' => true,
			'rewrite' => ['slug' => static::POST_TYPE_URL_SLUG],
			'hierarchical' => false,
			'menu_icon' => static::MENU_ICON,
			'menu_position' => static::MENU_POSITION,
			'supports' => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions'],
			'show_in_rest' => true,
			'rest_base' => static::REST_API_ENDPOINT_SLUG,
		];
	}
}
